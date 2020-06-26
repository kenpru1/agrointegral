<?php

use Illuminate\Database\Seeder;

class TipoMovimientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_movimientos')->insert([
            ['id' => '1', 'descripcion' => 'Entrada', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'descripcion' => 'Salida', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
        ]);
    }
}
