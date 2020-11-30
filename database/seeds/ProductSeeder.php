<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 400;
        factory(App\Product::class, $count)->create();

        // Assign reports
        for ($idx = 1; $idx <= $count; $idx++) {
            factory(App\Report::class)->create([
                'product_id' => $idx
            ]);
        }
    }
}
