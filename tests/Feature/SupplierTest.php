<?php

namespace Tests\Feature;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\City;
use App\Domains\Vendor\Models\Country;
use App\Domains\Vendor\Models\State;
use Carbon\Carbon;
use Database\Factories\CurrencyFactory;
use Database\Factories\SupplierFactory;
use Database\Factories\UserFactory;
use Database\Factories\VendorFactory;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    protected User $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->user = User::first();
        $this->actingAs($this->user);
        $this->withoutExceptionHandling();
    }
    public function test_create_supplier()
    {
        CurrencyFactory::times(5)->create();
        $currency = Currency::first();
        $supplierData = [
            'name' => 'ahmed abdullah',
            'email' => fake()->unique()->safeEmail(),
            'contact' => $this->faker->regexify('/^(010|011|012)[0-9]{8}$/'),
            'address' => 'address:mostafa al-nahas',
            'zip_code' => $this->faker->numberBetween(10000, 20000),
            'currency_id' => $currency->id,
            'city_id' => City::first()->id,
            'state_id' => State::first()->id,
            'country_id' => Country::first()->id,
            'parent_account_id' => Account::first()->id,
        ];
        $response = $this->postJson('/api/supplier/create', $supplierData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('suppliers', [
            'name' => $supplierData['name'],
            'contact' => $supplierData['contact'],
            'email' => $supplierData['email'],
        ]);
    }

    public function test_can_list_all_suppliers()
    {
        SupplierFactory::times(5)->create(['name' => 'supplier']);
        $response = $this->get('/api/supplier/');
        $this->assertCount(5, Supplier::all());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    "code",
                    "name",
                    "contact",
                    "email",
                    "currency",
                    "currency_id",
                    "account_code",
                    "parent_account_id",
                    "address" => [],
                    "created_at",
                    "updated_at",
                ],
            ],
        ]);
        $response->assertJsonFragment(['name' => 'supplier']);

    }
    public function test_supplier_fillter()
    {
        SupplierFactory::times(5)->create(['created_at' => Carbon::now()->subDays(3)]);
        SupplierFactory::times(6)->create(['name' => 'Ali']);
        $queryParams = [
            'from' => Carbon::now()->subDays(4)->toDateString(),
            'to' => Carbon::now()->toDateString(),
            'search' => 'Ali',
            'limit' => 10,
        ];

        $response = $this->get('/api/supplier/', $queryParams);
        $this->assertCount(11, Supplier::all());
        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Ali']);
    }
    public function test_can_delete_supplier(): void
    {
        SupplierFactory::times(1)->create(['name' => 'Ali']);
        $supplier = Supplier::first();
        $this->assertCount(1, Supplier::all());
        $this->delete('/api/supplier/' . $supplier->id);
        $this->assertSoftDeleted($supplier);
        return;
    }
    public function test_update_supplier_effect_on_Database()
    {
        CurrencyFactory::times(5)->create();
        $currency = Currency::first();
        SupplierFactory::times(1)->create();
        $supplier = Supplier::first();
        $updatedData = [
            'name' => 'Ali Ahmed',
            'contact' => $this->faker->regexify('/^(010|011|012)[0-9]{8}$/'),
            'email' => fake()->unique()->safeEmail(),
            'zip_code' => $this->faker->numberBetween(10000, 20000),
            'address' => 'address:mostafa al-nahas',
            'currency_id' => $currency->id,
            'state_id' => State::first()->id,
            'country_id' => Country::first()->id,
            'city_id' => City::first()->id,
            'parent_account_id' => Account::first()->id,
        ];
        $response = $this->postJson('/api/supplier/update/' . $supplier->id, $updatedData);
        $response->assertStatus(200);
        $response->assertSee('updated successfully');
        $this->assertDatabaseHas('suppliers', [
            'name' => $updatedData['name'],
            'contact' => $updatedData['contact'],
            'email' => $updatedData['email'],
        ]);
    }
    public function test_supplier_validation()
    {
        SupplierFactory::times(1)->create();
        $supplier = Supplier::first();

        $requestData = [
            //invalid contact number
            'contact' => '25230123',
            //not valid email
            'email' => 'testexample.com',
            //not valid email
            'currency_id' => 20,
            //not exist
            'address' => 'address:mostafa al-nahas',
        ];
        $DataToValidate = [
            'name',
            'email',
            'contact',
            'zip_code',
            'currency_id',
            'state_id',
            'country_id',
            'city_id',
            'parent_account_id',
        ];
        $updateResponse = $this->postJson('/api/supplier/update/' . $supplier->id, $requestData);
        $updateResponse->assertStatus(422);
        $updateResponse->assertJsonValidationErrors($DataToValidate, 'errors');

        $createResponse = $this->postJson('/api/supplier/create/', $requestData);
        $createResponse->assertStatus(422);
        $createResponse->assertJsonValidationErrors($DataToValidate, 'errors');
    }
    public function test_supplier_pagination()
    {
        $suppliers = SupplierFactory::times(12)->create();
        $lastOne = $suppliers->last();
        $firstOne = $suppliers->first();
        $response = $this->get('/api/supplier/');
        $response->assertSee($firstOne->name);
        $response->assertDontSee($lastOne->name);
    }
    public function test_admin_can_list_suppliers()
    {
        $suppliers = SupplierFactory::times(5)->create();
        $lastOne = $suppliers->last();
        $response = $this->get('/api/supplier/');
        $response->assertSee($lastOne->name);
    }
    public function test_non_admin_cannot_list_suppliers()
    {
        $suppliers = SupplierFactory::times(5)->create();
        $user = UserFactory::times(2)->create();
        $lastOne = $suppliers->last();
        $user = $user->first();
        $response = $this->actingAs($user)->get('/api/supplier/');
        $response->assertStatus(403);
        $response->assertDontSee($lastOne->name);

    }
}
