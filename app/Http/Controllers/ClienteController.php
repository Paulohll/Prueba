<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteModel;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    //


    public function getClientes(Request $request)
    {

        if (!$request->ajax()) return redirect('/');
        $clientes    =   ClienteModel::all();
        return [
            'clientes' => $clientes,
        ];
    }

    public function putClientes(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $file = fopen(storage_path("fichero.txt"), 'r');
        if (!$file) {
            exit("Error abriendo archivo");
        } else {
            while (!feof($file)) {
                $content = fgets($file);

                $id = mb_substr($content, 0, 2);
                $nombres = mb_substr($content, 2, 15);
                $apellidos = mb_substr($content, 17, 15);
                $telefono = mb_substr($content, 32, 7);
                $saldo = mb_substr($content, 39, 9);

                if ($id !== '00') {
                    $cliente = new ClienteModel;
                    $cliente->id = $id;
                    $cliente->nombres = $nombres;
                    $cliente->apellidos = $apellidos;
                    $cliente->telefono = $telefono;
                    $cliente->saldo = $saldo;
                    $cliente->save();
                }
            }
        }

        fclose($file);
    }

    public function delClientes(Request $request)
    {
        $cliente    =   ClienteModel::truncate();
     
    }
}
