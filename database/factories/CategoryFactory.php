<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $category = $this->faker->unique()->randomElement(['stickOS Drives', 'stickOS-TVPC']);
        $slug = Str::slug($category);
        if ($category === 'stickOS Drives'){
            $image = 'assets/images/categories/stickOS-Drive-64GB.webp';
        } else {
            $image = 'assets/images/categories/stickOS-TVPC.webp';
        }
        return [
            'name'  => $category,
            'slug'  => $slug,
            'image' => $image,
        ];
    }
}
