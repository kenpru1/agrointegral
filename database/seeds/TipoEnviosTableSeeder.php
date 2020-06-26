<?php

use Illuminate\Database\Seeder;

class TipoEnviosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_envios')->insert([
            ['id' => '1', 'descripcion' => 'Retiro en mi ubicación',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'descripcion' => 'Radio 5 KM',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'descripcion' => 'Radio 10 KM',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'descripcion' => 'Dentro de la comuna',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'descripcion' => 'Dentro de la provincia',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'descripcion' => 'Envío a todo el país',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '7', 'descripcion' => 'Acordar con el comprador',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

        ]);
    }
}
