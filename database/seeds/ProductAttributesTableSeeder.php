<?php

use App\Entities\ProductAttributes;
use Illuminate\Database\Seeder;

class ProductAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductAttributes::class, 10)->create();
    }
}
