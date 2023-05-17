<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    /**
     * @var int
     */
    protected static int $priority = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$priority++;

        return [
            'name' => $this->faker->name,
            'priority' => self::$priority,
            'project_id' => Project::pluck('id')->random(),
        ];
    }
}
