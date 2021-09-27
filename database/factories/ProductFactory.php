<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $products = ['stickOS Drive-64GB', 'stickOS Drive-128GB', 'stickOS Drive-256GB', 'stickOS - TVPC', 'stickOS - TVPC Bundle'];
        $name = $this->faker->unique()->randomElement($products);
        $slug = Str::slug($name);
        if(strpos($name, 'TVPC')) {
            $category_id = Category::where('name', '=', 'stickOS-TVPC')->first()->id;
        } else {
            $category_id = Category::where('name', '!=', 'stickOS-TVPC')->first()->id;
        }
        return [
            'name'  => $name,
            'slug'  => $slug,
            'desc'  => $this->faker->text(100),
            'image' => "assets/images/products/$name.png",
            'price' => $this->faker->numberBetween(20, 60),
            'stock_status'  => $this->faker->randomElement(['instock', 'outstock']),
            'quantity'      => $this->faker->numberBetween(12, 30),
            'category_id'   => $category_id,
        ];
    }
}
