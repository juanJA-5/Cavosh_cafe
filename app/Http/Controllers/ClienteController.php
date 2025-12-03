<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClienteService;

class ClienteController extends Controller
{
    protected $service;

    public function __construct(ClienteService $service)
    {
        $this->service = $service;
    }

    public function getCliente(Request $request)
    {
        $rows = $this->service->getCliente($request);

        $success = isset($rows[0]) ? true : false;
        $data    = $success ? $rows[0] : null;
        $message = $success ? "Cliente registrado" : "Cliente no registrado";

        return response()->json([
            "success" => $success,
            "data"    => $data,
            "message" => $message
        ]);
    }

    public function setCliente(Request $request)
    {
        $result = $this->service->setCliente($request);

        $success =
            isset($result['id']) ||
            ($result['update'] ?? false);

        $data = $result['id'] ?? null;

        $message =
            isset($result['id']) ? "Cliente registrado" :
            (($result['update'] ?? false) ? "Cliente actualizado" :
            ($result['error'] ?? "No se pudo registrar el cliente"));

        return response()->json([
            "success" => $success,
            "data"    => $data,
            "message" => $message
        ]);
    }

    public function generarCodigo(Request $request)
    {
        $rows = $this->service->generarCodigo($request);

        $success = isset($rows[0]->id);
        $message = $rows[0]->error ?? ($success ? "Código generado" : "Error al generar código");

        return response()->json([
            "success" => $success,
            "data"    => $success ? $rows[0] : null,
            "message" => $message
        ]);
    }
}
