<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
{
    $userId = auth()->id(); // o el id que quieras filtrar

    $sales = Sale::with([
        'client',            // cliente = usuario con idClient
        'user',              // quien registró la venta
        'details.fertilizer' // detalles y productos
    ])
    ->where('idUser', $userId) // filtrar por idUser
    ->latest()
    ->get();

    return view('user.sales.index', compact('sales'));
}

    public function create()
    {
        // Obtener usuarios con rol de cliente
        $clients = User::where('role', 'client')->get();
        return view('sales.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $sale = Sale::create([
            'idUser' => auth()->id(),
            'idClient' => $request->idClient,
            'pay' => $request->pay,
            'total' => $request->total,
            'state' => 1,
            'updated_by' => auth()->id(),
        ]);

        // Aquí podrías guardar detalles si los recibes

        return redirect()->route('sales.index')->with('success', 'Venta registrada correctamente');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Venta eliminada');
    }
}
