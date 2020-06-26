<?php

use Illuminate\Database\Seeder;

class EstadoFacturaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_factura')->insert([
            ['id' => '1', 'nombre' => 'Por Pagar','class'=>'badge badge-primary',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'nombre' => 'Pagado','class'=>'badge badge-success',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'nombre' => 'Anulado','class'=>'badge badge-danger',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'nombre' => 'Recibido','class'=>'badge badge-primary',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'nombre' => 'Vencido','class'=>'badge badge-danger',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

        ]);
    }
}
