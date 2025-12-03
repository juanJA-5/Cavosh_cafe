<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ClienteService
{
    public function getCliente($request)
    {
        $correo = $request->correo;
        $passwordd = $request->passwordd;

        // Retorna un array de objetos (equivalente a rows[0][0])
        $rows = DB::select("CALL sp_getCliente(?, ?)", [
            $correo,
            $passwordd
        ]);

        return $rows;
    }

    public function setCliente($request)
    {
        $rows = DB::select("CALL sp_setCliente(?, ?, ?, ?)", [
            $request->id,
            $request->correo,
            $request->passwordd,
            $request->nombre
        ]);

        // Caso insert
        if ($request->id == 0 && isset($rows[0]->insertID)) {
            return [
                "id" => $rows[0]->insertID,
                "correo" => $request->correo,
                "passwordd" => $request->passwordd,
                "nombre" => $request->nombre
            ];
        }

        // Error
        if (isset($rows[0]->error)) {
            return [ "error" => $rows[0]->error ];
        }

        // Update exitoso
        return [ "update" => true ];
    }

    public function generarCodigo($request)
    {
        $rows = DB::select("CALL sp_getClienteCodigo(?)", [
            $request->correo
        ]);

        return $rows;
    }
}
