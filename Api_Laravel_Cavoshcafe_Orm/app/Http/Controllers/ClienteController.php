<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function crear(Request $request)
    {
        $data = $request->only(['nombre', 'email', 'password']);
        $cliente = new Cliente($data['nombre'], $data['email'], $data['password']);
        $cliente->save();
        return response()->json([
            'id' => $cliente->id,
            'nombre' => $cliente->nombre,
            'email' => $cliente->email
        ], 201);
    }

    public function login(Request $request)
    {
        $cliente = Cliente::findByEmail($request->email);
        if ($cliente && password_verify($request->password, $cliente->password)) {
            return response()->json([
                'id' => $cliente->id,
                'nombre' => $cliente->nombre,
                'email' => $cliente->email
            ]);
        }
        return response()->json(['error' => 'Credenciales inválidas'], 401);
    }

    public function modificar(Request $request)
    {
        $cliente = Cliente::findByEmail($request->email);
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        if ($request->nombre) $cliente->nombre = $request->nombre;
        if ($request->password) $cliente->password = password_hash($request->password, PASSWORD_DEFAULT);

        return response()->json([
            'id' => $cliente->id,
            'nombre' => $cliente->nombre,
            'email' => $cliente->email
        ]);
    }

    public function generarCodigo(Request $request)
    {
        $cliente = Cliente::findByEmail($request->email);
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $cliente->generarCodigo();
        return response()->json([
            'email' => $cliente->email,
            'codigo' => $cliente->codigo
        ]);
    }
}