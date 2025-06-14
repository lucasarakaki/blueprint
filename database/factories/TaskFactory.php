<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $tasks = [
            'Complete project report',
            'Attend team meeting',
            'Review pull requests',
            'Update documentation',
            'Fix bugs in the application',
            'Prepare for presentation',
            'Conduct user testing',
            'Plan next sprint',
            'Refactor codebase',
            'Deploy to production',
        ];
        $taskName = $this->faker->randomElement( $tasks );

        return [
            'title'       => $taskName,
            'description' => fake()->text(),
            'completed'   => fake()->boolean(),
            'due_date'    => fake()->dateTime(),
            'user_id'     => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
