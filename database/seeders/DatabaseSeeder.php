<?php

namespace Database\Seeders;

// use App\Http\Controllers\Transaksi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            View::class,
            NonTransaksi::class,
            Transaksi::class,
            Trigger::class,
            View::class
        ]);
    }
}
