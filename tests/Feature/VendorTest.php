<?php

namespace Tests\Feature;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\Address;
use App\Domains\Vendor\Models\City;
use App\Domains\Vendor\Models\Country;
use App\Domains\Vendor\Models\State;
use App\Domains\Vendor\Models\Vendor;
use Carbon\Carbon;
use Database\Factories\CurrencyFactory;
use Database\Factories\UserFactory;
use Database\Factories\VendorFactory;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class VendorTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    protected User $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->user = User::first();
        $this->actingAs($this->user);
        // $this->withoutExceptionHandling();

    }
    public function test_create_vendor()
    {
        CurrencyFactory::times(5)->create();
        $currency = Currency::first();
        $vendorData = [
            'name' => $this->faker->name(),
            'code' => $this->faker->numberBetween(1, 2023),
            'contact' => $this->faker->regexify('/^(010|011|012)[0-9]{8}$/'),
            'email' => fake()->unique()->safeEmail(),
            'zip_code' => $this->faker->numberBetween(10000, 20000),
            'is_same_shipping_address' => 1,
            'address' => 'address:mostafa al-nahas',
            'currency_id' => $currency->id,
            'state_id' => State::first()->id,
            'country_id' => Country::first()->id,
            'city_id' => City::first()->id,
            'creator_id' => User::first()->id,
            'address_id' => Address::first()->id,
            'billing_address_id' => Address::first()->id,
            'parent_account_id' => Account::first()->id,
        ];
        $response = $this->postJson('/api/vendor/create', $vendorData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('vendors', [
            'name' => $vendorData['name'],
            'contact' => $vendorData['contact'],
            'email' => $vendorData['email'],
        ]);
    }

    public function test_can_list_all_vendors()
    {
        VendorFactory::times(5)->create(['name' => 'vendor']);
        $response = $this->get('/api/vendor/');
        $this->assertCount(5, Vendor::all());
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
                    "creator",
                    "address" => [],
                    "billing_address" => [],
                    "created_at",
                    "updated_at",
                ],
            ],
        ]);
        $response->assertJsonFragment(['name' => 'vendor']);

    }
    public function test_vendor_fillter()
    {
        $this->withoutExceptionHandling();
        VendorFactory::times(2)->create(['creator_id' => $this->user->id, 'created_at' => Carbon::now()->subDays(3)]);
        VendorFactory::times(9)->create(['creator_id' => null]);
        $queryParams = [
            'creator_id' => $this->user->id,
            'from' => Carbon::now()->subDays(4)->toDateString(),
            'to' => Carbon::now()->toDateString(),
            'limit' => 10,
        ];
        $response = $this->get('/api/vendor/', $queryParams);
        // $this->assertCount(11, Vendor::all());
        $response->assertStatus(200);
        $response->assertJsonFragment(['creator_id' => $this->user->id]);
    }
    public function test_can_delete_vendor(): void
    {
        VendorFactory::times(1)->create(['name' => 'customer']);
        $vendor = Vendor::first();
        $this->assertCount(1, Vendor::all());
        $this->delete('/api/vendor/' . $vendor->id);
        $this->assertSoftDeleted($vendor);
        return;
    }
    public function test_update_vendor_effect_on_Database()
    {
        CurrencyFactory::times(5)->create();
        $currency = Currency::first();
        VendorFactory::times(1)->create();
        $vendor = Vendor::first();
        $updatedData = [
            'name' => $this->faker->name(),
            'code' => $this->faker->numberBetween(1, 2023),
            'contact' => $this->faker->regexify('/^(010|011|012)[0-9]{8}$/'),
            'email' => fake()->unique()->safeEmail(),
            'zip_code' => $this->faker->numberBetween(10000, 20000),
            'is_same_shipping_address' => 1,
            'address' => 'address:mostafa al-nahas',
            'currency_id' => $currency->id,
            'state_id' => State::first()->id,
            'country_id' => Country::first()->id,
            'city_id' => City::first()->id,
            'creator_id' => User::first()->id,
            'address_id' => Address::first()->id,
            'billing_address_id' => Address::first()->id,
            'parent_account_id' => Account::first()->id,
        ];
        $response = $this->postJson('/api/vendor/update/' . $vendor->id, $updatedData);
        $response->assertStatus(200);
        $response->assertSee('Updated Successfully');
        $this->assertDatabaseHas('vendors', [
            'name' => $updatedData['name'],
            'contact' => $updatedData['contact'],
            'email' => $updatedData['email'],
        ]);
    }
    public function test_vendor_validation_request()
    {
        VendorFactory::times(1)->create();
        $vendor = Vendor::first();
        //Empty data that should return validation error
        $requestData = [
        ];
        $DataToValidate = [
            'name',
            'contact',
            'email',
            'currency_id',
            'state_id',
            'country_id',
            'city_id',
            'parent_account_id',
            'zip_code',
            'address',
            'is_same_shipping_address',
        ];
        $updateResponse = $this->postJson('/api/vendor/update/' . $vendor->id, $requestData);
        $updateResponse->assertStatus(422);
        $updateResponse->assertJsonValidationErrors($DataToValidate);

        $createResponse = $this->postJson('/api/vendor/create/', $requestData);
        $createResponse->assertStatus(422);
        $createResponse->assertJsonValidationErrors($DataToValidate);
    }
    public function test_vendor_pagination()
    {
        $vendors = VendorFactory::times(11)->create();
        $lastOne = $vendors->last();
        $firstOne = $vendors->first();
        $response = $this->get('/api/vendor/');
        $response->assertSee($firstOne->name);
        $response->assertDontSee($lastOne->name);
        /*
        $stringToCheck = $lastOne->email;
        $response->assertStringNotContainsString($stringToCheck, $response->getContent());
        */
    }
    public function test_admin_can_list_vendors()
    {
        $vendors = VendorFactory::times(5)->create();
        $lastOne = $vendors->last();
        $response = $this->get('/api/vendor/');
        $response->assertSee($lastOne->name);
    }
    public function test_non_admin_cannot_list_vendors()
    {
        $vendors = VendorFactory::times(5)->create();
        $user = UserFactory::times(2)->create();
        $lastOne = $vendors->last();
        $user = $user->first();
        $response = $this->actingAs($user)->get('/api/vendor/');
        $response->assertStatus(403);
        $response->assertDontSee($lastOne->name);

    }
}
