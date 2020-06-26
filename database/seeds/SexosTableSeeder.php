<?php

use Illuminate\Database\Seeder;

class UnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidades')->insert([
            ['id' => '1', 'nombre' => 'Macho', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'deleted_at' => null],
            ['id' => '2', 'nombre' => 'Hembra', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'deleted_at' => null],
           
        ]);
    }
}
