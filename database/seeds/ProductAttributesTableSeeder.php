<?php

use App\Entities\ProductAttribute;
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
        factory(ProductAttribute::class, 10)->create();
    }
}
