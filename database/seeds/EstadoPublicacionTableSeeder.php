<?php

use Illuminate\Database\Seeder;

class EstadoPublicacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_publicacion')->insert([
            ['id' => '1', 'descripcion' => 'Publicado',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'descripcion' => 'Vendida',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'descripcion' => 'Cancelada',  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
        ]);
    }
}
