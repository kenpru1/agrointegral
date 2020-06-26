<?php

use Illuminate\Database\Seeder;

class EtapaOportunidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etapa_oportunidad')->insert([
            ['id' => '1', 'nombre' => 'Registrada','class'=>'10',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'nombre' => 'Contacto establecido','class'=>'20',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'nombre' => 'Cliente potencial','class'=>'30',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'nombre' => 'Presupuestada','class'=>'50',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'nombre' => 'Negociación','class'=>'75',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'nombre' => 'Aprobada','class'=>'100',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '7', 'nombre' => 'Perdida','class'=>'0',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
