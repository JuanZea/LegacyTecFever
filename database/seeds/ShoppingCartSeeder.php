<?php

use Illuminate\Database\Seeder;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($idx = 1; $idx <= 30; $idx++) {
            factory(App\ShoppingCart::class)->create([
                'user_id' => $idx
            ]);
        }
    }
}
