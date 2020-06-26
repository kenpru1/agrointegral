<?php

namespace App\Imports;

use App\Models\Provincia;
use App\Models\Comuna;
use App\Models\Paises;
use App\Models\ClienteProveedor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;

class ClientesProveedoresImport implements ToCollection
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
                $proveedor = 0;
                $cliente = 0;
                
                if($row[7] == 'si')
                {
                    $proveedor = 1;
                }
                if ($row[8] == 'si') 
                {
                    $cliente = 1;
                }

                $pais = Paises::where('nombre', $row[11])->first();
                $provincia = Provincia::where('nombre', $row[9])->first();

                if ($provincia != null && $pais != null) 
                {
                    $comuna = Comuna::where('provincia_id', $provincia->id)->where('nombre', $row[10])->first();

                    if($comuna != null) 
                    {
                        ClienteProveedor::create([
                            'nombre_razon' => $row[0],
                            'rut' => $row[1],
                            'email' => $row[2],
                            'telefono' => $row[3],
                            'direccion' => $row[4],
                            'codigo_postal' => $row[5],
                            'web' => $row[6],
                            'proveedor' => $proveedor,
                            'cliente' => $cliente,
                            'provincia_id' => $provincia->id,
                            'comuna_id' => $comuna->id,
                            'pais_id' => $pais->id,
                            'observacion' => $row[12],
                            'empresa_id' => $empresaUser->id, 
                        ]);
                    }

                }
            }
        }
    }
}
