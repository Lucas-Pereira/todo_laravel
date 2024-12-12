<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
    public function definition(): array
    {
        return [
                'name' => fake()->name(),
                'descricao' => fake()->text(),
                'completo' => fake()->boolean(),
                'prioridade' => Str::random(3),
                'user_id' => Str::random(5),
                'projeto_id' => Str::random(5),
        ];
    }
}
