<?php

namespace Database\Seeders;

use App\Models\Detail_transaki;
use App\Models\DetailOrders;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Order;
use Database\Factories\MejaFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Meja::factory(9)->create();
        // Menu::factory(2)->create();
        // Order::factory(4)->create();
        // DetailOrders::factory(2)->create();
    }
}
