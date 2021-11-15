<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

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
            'description' => $this->faker->paragraph(),
            'photo' => $this->faker->imageUrl('60', '60'),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'condition' => $this->faker->randomElement(['banner', 'promo']),
        ];
    }
}
