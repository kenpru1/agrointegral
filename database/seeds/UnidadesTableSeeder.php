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
            ['id' => '1', 'nombre' => 'Kilogramos', 'nomenclatura' => 'Kilogramos', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'nombre' => 'Metros Cúbicos', 'nomenclatura' => 'Metros Cúbicos', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'nombre' => 'Litros', 'nomenclatura' => 'Litros', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

            ['id' => '4', 'nombre' => 'Centímetros cúbicos', 'nomenclatura' => 'Centímetros cúbicos', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'nombre' => 'Metros', 'nomenclatura' => 'Metros', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'nombre' => 'Vines', 'nomenclatura' => 'Vines', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '7', 'nombre' => 'Pallet', 'nomenclatura' => 'Pallet', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '8', 'nombre' => 'Cajas', 'nomenclatura' => 'Cajas', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '9', 'nombre' => 'Toneladas', 'nomenclatura' => 'Toneladas', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '10', 'nombre' => 'Unidades', 'nomenclatura' => 'Unidades', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => '11', 'nombre' => 'Otro', 'nomenclatura' => 'Otro', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

        ]);
    }
}
