<?php

use Illuminate\Database\Seeder;

class CondicionesPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('condiciones_pago')->insert([
            ['id' => '1', 'nombre' => 'Acuse de Recibo', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'nombre' => 'Contra Orden de Compra', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'nombre' => 'Contra Entrega', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'nombre' => '30 días', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'nombre' => '60 días', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'nombre' => '120 días', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

        ]);
    }
}
