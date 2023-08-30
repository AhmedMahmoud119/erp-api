<?php

namespace Tests\Feature;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\Customer\Models\Customer;
use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\City;
use App\Domains\Vendor\Models\Country;
use App\Domains\Vendor\Models\State;
use Database\Factories\CurrencyFactory;
use Database\Factories\CustomerFactory;
use Database\Seeders\DatabaseSeeder;
use App\Domains\Vendor\Models\Address;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $this->seed(DatabaseSeeder::class);
        CustomerFactory::times(5)->create(['name' => 'customer']);
        $this->withExceptionHandling();
        $user = User::first();
        $response = $this->actingAs($user)->get('/api/customer/');
        $response->assertStatus(200);
        $response->assertSee('customer');
    }
    public function test_can_delete_Customer(): void
    {
        $this->seed(DatabaseSeeder::class);
        $user = User::first();
        CustomerFactory::times(1)->create(['name' => 'customer']);
        $customer = Customer::first();
        $this->actingAs($user)->delete(url('/api/customer/{customer}', $customer->id));

        $this->assertDatabaseCount('customers', 0);
    }
}