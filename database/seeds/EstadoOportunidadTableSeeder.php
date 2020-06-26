<?php

use Illuminate\Database\Seeder;

class EstadoOportunidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_oportunidad')->insert([
            ['id' => '1', 'nombre' => 'Frío','class'=>'badge badge-success', 'class_tablero' => 'info-element',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'nombre' => 'Tibio','class'=>'badge badge-primary', 'class_tablero' => 'success-element',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'nombre' => 'Caliente','class'=>'badge badge-warning', 'class_tablero' => 'warning-element',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'nombre' => 'Cierre Inminente','class'=>'badge badge-danger', 'class_tablero' => 'danger-element',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
