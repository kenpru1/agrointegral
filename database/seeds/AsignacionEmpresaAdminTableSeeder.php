<?php

use Illuminate\Database\Seeder;

class AsignacionEmpresaAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresa_user')->insert([

        	['id'=>'1','empresa_id' => '1','user_id' => '1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

        ]);
    }
}
