<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tarefa;
use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarefa>
 */
class TarefaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Tarefa::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'descricao' => $this->faker->paragraph,
            'vencimento' => $this->faker->dateTimeBetween('now', '+10 days')->format('Y-m-d'),
            'status_id' => Status::inRandomOrder()->first()?->id ?? Status::factory(),
        ];
    }
}
