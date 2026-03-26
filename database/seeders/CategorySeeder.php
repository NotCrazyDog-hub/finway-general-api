<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Alimentação', 'type' => 'expense'],
            ['name' => 'Transporte', 'type' => 'expense'],
            ['name' => 'Moradia', 'type' => 'expense'],
            ['name' => 'Lazer', 'type' => 'expense'],
            ['name' => 'Salário', 'type' => 'income'],
            ['name' => 'Investimentos', 'type' => 'income'],
            ['name' => 'Outros', 'type' => 'both'],
        ]);
    }
}
