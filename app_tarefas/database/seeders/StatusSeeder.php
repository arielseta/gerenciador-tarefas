<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['descricao' => 'Pendente', 'created_at' => now(), 'updated_at' => now()],
            ['descricao' => 'Em Andamento', 'created_at' => now(), 'updated_at' => now()],
            ['descricao' => 'Concluído', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}
