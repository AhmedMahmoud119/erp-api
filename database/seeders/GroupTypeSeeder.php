<?php

namespace Database\Seeders;

use App\Domains\Account\Models\Account;
use App\Domains\Group\Models\Group;
use App\Domains\GroupType\Models\GroupType;
use App\Domains\User\Models\User;
use Database\Factories\AccountFactory;
use Database\Factories\GroupFactory;

use Illuminate\Database\Seeder;

class GroupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupType::create([
            'code' => '1',
            'name' => 'Assets',
            'is_fixed' => 1,
            'creator_id'=>1
        ]);
        GroupType::create([
            'code' => '2',
            'name' => 'Liabilities',
            'is_fixed' => 1,
            'creator_id'=>1
        ]);
        GroupType::create([
            'code' => '3',
            'name' => 'Equity',
            'is_fixed' => 1,
            'creator_id'=>1
        ]);
        GroupType::create([
            'code' => '4',
            'name' => 'Revenue',
            'is_fixed' => 1,
            'creator_id'=>1
        ]);
        GroupType::create([
            'code' => '5',
            'name' => 'Expenses',
            'is_fixed' => 1,
            'creator_id'=>1
        ]);
        GroupFactory::new()->count(10)->create();
        Account::create([
            'id'=> 1,
            'name' => 'Parent-Account',
            'code' => Group::first()->code.'0001',
            'creator_id' => User::inRandomOrder()->first()->id,
            'group_id' => Group::first()->id,
            'account_type' => null,
            'opening_balance' => 0,
            'parent_id' => null,
            'is_parent' => 1,
        ]);
        AccountFactory::new()->count(10)->create();
    }
}
