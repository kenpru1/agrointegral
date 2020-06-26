<?php

use Illuminate\Database\Seeder;

class PlanesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planes')->insert([

        	['nombre' => 'Estándar','costo' => '1000', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        	['nombre' => 'Monitoreo','costo' => '2000', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        	['nombre' => 'Predictivo','costo' => '5000', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
