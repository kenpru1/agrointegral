<?php

use Illuminate\Database\Seeder;

class TipoActividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trabajos')->insert([
            ['id' => '1', 'nombre' => 'Abonar', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'nombre' => 'Cosechar o Recolectar', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
           
            ['id' => '3', 'nombre' => 'Otros Trabajos de Cultivo', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'nombre' => 'Preparar el Terreno', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'nombre' => 'Sembrar o Plantar', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'nombre' => 'Tratamiento Fitosanitario', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '7', 'nombre' => 'Tratamiento Fitosanitario a Almacén', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '8', 'nombre' => 'Tratamiento Fitosanitario a Medio de Transporte', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '9', 'nombre' => 'Tratamiento Fitosanitario a Postcosecha', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '10', 'nombre' => 'Tratamiento Fitosanitario a Semilla', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '11', 'nombre' => 'Tratamiento no Químico', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '12', 'nombre' => 'Otros Trabajos', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],



           

        ]);
    }
}
