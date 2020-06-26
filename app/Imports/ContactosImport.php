<?php

namespace App\Imports;

use App\Models\EmpresaContacto;
use App\Models\ClienteProveedor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;

class ContactosImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $empresaUser = Auth::user()->empresaUser();

        foreach ($rows as $index => $row) 
        {
            if($index > 0)
            {
                $cliente = ClienteProveedor::where('nombre_razon', $row[4])->where('empresa_id', $empresaUser->id)->first();

                if($cliente != null)
                {
                    EmpresaContacto::create([
                    'nombres' => $row[0],
                    'apellidos' => $row[1],
                    'foto' => '', //hay que validar?
                    'email' => $row[2],
                    'celular' => $row[3],
                    'cliente_proveedor_id' => $cliente->id, //validado
                    ]);
                }
            }
        }
    }
}
