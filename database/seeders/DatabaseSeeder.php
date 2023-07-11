<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\RentProduct;
use App\Models\SoldProduct;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(3)->create();
        $this->command->info('Users seeded');
        Product::factory()->count(10)->create();
        $this->command->info('Products seeded');
        RentProduct::factory()->count(10)->create();
        $this->command->info('RentProduct seeded');
        SoldProduct::factory()->count(10)->create();
        $this->command->info('SoldProduct seeded');
    }
}
