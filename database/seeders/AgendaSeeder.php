<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Agenda::factory(60)->make()->each(function ($agenda) use ($users) {
            $agenda->created_by = $users->random()->id;
            $agenda->save();
        });
    }
}
