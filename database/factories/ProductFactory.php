<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'title' => $this->faker->word(3),
            'slug' => $this->faker->slug(3),
            'description' => $this->faker->text,
            'summary' => $this->faker->text,
            'stock' => $this->faker->numberBetween(2, 10),
            'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
            'cat_id' => $this->faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'child_cat_id' => $this->faker->randomElement(Category::where('is_parent',0)->pluck('id')->toArray()),
            'photo' => $this->faker->imageUrl('400','300'),
            'price' => $this->faker->numberBetween(100,1000),
            'offer_price' => $this->faker->numberBetween(0,100),
            'discount' => $this->faker->numberBetween(0,99),
            'size' => $this->faker->randomElement(['XS','S', 'M', 'L','XS','XLL']),
            'condition' => $this->faker->randomElement(['new', 'popular', 'winter']),
            'vendor_id' => $this->faker->randomElement(User::where('role','vendor')->pluck('id')->toArray()),
            'status' => $this->faker->randomElement(['active','inactive'])

        ];
    }
}
