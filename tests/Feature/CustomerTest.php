<?php

namespace Tests\Feature;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\Customer\Models\Customer;
use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\City;
use App\Domains\Vendor\Models\Country;
use App\Domains\Vendor\Models\State;
use Carbon\Carbon;
use Database\Factories\CurrencyFactory;
use Database\Factories\CustomerFactory;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_customer()
    {
        $this->seed(DatabaseSeeder::class);
        CurrencyFactory::times(5)->create();
        $Currency = Currency::first();
        $user = User::first();
        $city = City::first();
        $country = Country::first();
        $state = State::first();

        $data = [
            'name' => 'Test Customer',
            'code' => '1123',
            'contact' => '01125230123',
            'email' => 'test@example.com',
            'currency_id' => $Currency->id,
            'address' => 'address:mostafa al-nahas',
            'state_id' => $state->id,
            'country_id' => $country->id,
            'city_id' => $city->id,
            'zip_code' => '11033',
            'is_same_shipping_address' => 1,
            'parent_account_id' => Account::first()->id,
            'creator_id' => User::first()->id,
        ];

        $response = $this->actingAs($user)->postJson('/api/customer/create', $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('customers', [
            'name' => $data['name'],
            'contact' => $data['contact'],
            'email' => $data['email'],
        ]);
    }

    public function test_can_list_all_customers()
    {
        $this->withExceptionHandling();

        $this->seed(DatabaseSeeder::class);
        $creator = User::first();
        $this->actingAs($creator);

        CustomerFactory::times(5)->create(['name' => 'customer']);
        $queryParams = [
            'creator_id' => $creator->id,
            'from' => Carbon::now()->subDays(7)->toDateString(),
            'to' => Carbon::now()->toDateString(),
            'limit' => 10,
        ];

        $response = $this->get('/api/customer/', $queryParams);
        $this->assertCount(5, Customer::all());
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
        $response->assertJsonFragment(['name' => 'customer']);

    }
    public function test_customer_fillter()
    {
        $this->withExceptionHandling();
        $this->seed(DatabaseSeeder::class);
        $creator = User::first()->id;
        CustomerFactory::times(2)->create(['creator_id' => $creator, 'created_at' => Carbon::now()->subDays(3)]);
        CustomerFactory::times(9)->create(['creator_id' => null]);
        $queryParams = [
            'creator_id' => $creator,
            'from' => Carbon::now()->subDays(4)->toDateString(),
            'to' => Carbon::now()->toDateString(),
            'limit' => 10,
        ];

        $response = $this->get('/api/customer/', $queryParams);
        $this->assertCount(11, Customer::all());
        $response->assertStatus(200);
        $response->assertJsonFragment(['creator_id' => $creator]);

    }
    public function test_can_delete_Customer(): void
    {
        $this->withoutExceptionHandling();
        $this->seed(DatabaseSeeder::class);
        $user = User::first();
        CustomerFactory::times(1)->create(['name' => 'customer']);
        $customer = Customer::first();

        $this->assertCount(1, Customer::all());
        $this->actingAs($user)->delete('/api/customer/' . $customer->id);
        $this->assertSoftDeleted($customer);
        return;
    }
    public function test_update_customer_effect_on_Database()
    {
        $this->withoutExceptionHandling();
        $this->seed(DatabaseSeeder::class);
        $this->actingAs(User::first());
        CurrencyFactory::times(5)->create();
        $currency = Currency::first();
        $city = City::first();
        $country = Country::first();
        $state = State::first();
        $account = Account::first();

        CustomerFactory::times(1)->create();
        $customer = Customer::first();

        $updatedData = [
            'name' => 'Updated Test Customer',
            'code' => '1123',
            'contact' => '01125230123',
            'email' => 'UpdatedTestEmail@example.com',
            'currency_id' => $currency->id,
            'address' => 'address:mostafa al-nahas',
            'state_id' => $state->id,
            'country_id' => $country->id,
            'city_id' => $city->id,
            'zip_code' => '11033',
            'is_same_shipping_address' => 1,
            'parent_account_id' => $account->id,
            'creator_id' => User::first()->id,
        ];
        $response = $this->postJson('/api/customer/update/' . $customer->id, $updatedData);
        $response->assertStatus(200);
        $response->assertSee('Updated Successfully');
        $this->assertDatabaseHas('customers', [
            'name' => $updatedData['name'],
            'contact' => $updatedData['contact'],
            'email' => $updatedData['email'],
        ]);
    }
    public function test_customer_validation()
    {
        $this->seed(DatabaseSeeder::class);
        $this->actingAs(User::first());
        CustomerFactory::times(1)->create();
        $customer = Customer::first();

        $requestData = [
            //invalid contact number
            'contact' => '25230123',
            //not valid email
            'email' => 'testexample.com',
            //not valid email
            'currency_id' => 20,
            //not exist
            'address' => 'address:mostafa al-nahas',
            // invalid number
            'is_same_shipping_address' => 3,
        ];
        $DataToValidate = [
            'name',
            'currency_id',
            'state_id',
            'country_id',
            'city_id',
            'parent_account_id',
            'contact',
            'email',
            'zip_code',
            'is_same_shipping_address',
        ];
        $updateResponse = $this->postJson('/api/customer/update/' . $customer->id, $requestData);
        $updateResponse->assertStatus(422);
        $updateResponse->assertJsonValidationErrors($DataToValidate, 'errors');

        $createResponse = $this->postJson('/api/customer/create/', $requestData);
        $createResponse->assertStatus(422);
        $createResponse->assertJsonValidationErrors($DataToValidate, 'errors');
    }

}