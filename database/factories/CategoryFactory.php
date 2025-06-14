<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
     */
    public function definition(): array
    {
        $categorys = [
            'Technology',
            'Health',
            'Finance',
            'Education',
            'Entertainment',
            'Lifestyle',
            'Travel',
            'Food',
            'Sports',
            'Fashion',
        ];
        $categoryName = $this->faker->randomElement( $categorys );

        return [
            'name'    => $categoryName,
            'user_id' => User::factory(),
        ];
    }
}
