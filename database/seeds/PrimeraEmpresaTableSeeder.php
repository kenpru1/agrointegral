<?php

use Illuminate\Database\Seeder;

class PrimeraEmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([

        	['id'=>'1','nombre' => 'Proterra','rut_dni' => '123','direccion' => 'N/A','comuna' => 'N/A','ciudad' => 'N/A','pais_id' => '46','codigo_postal' => 'N/A','plan_id' => '100','email_facturacion' => '0', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

        ]);
    }
}
