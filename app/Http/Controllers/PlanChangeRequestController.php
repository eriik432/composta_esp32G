<?php

namespace App\Http\Controllers;

use App\Models\PlanChangeRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPlan;
use App\Models\Plan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PlanChangeRequestController extends Controller
{
    public function index()
    {
        $change_plans = PlanChangeRequest::with(['user', 'plan'])
            ->where('state', '>', 0)
            ->paginate(10);

        return view('admin.change_plans.gestionChangePlans', compact('change_plans'));
    }

    public function edit($id)
    {
        $change_plan = PlanChangeRequest::findOrFail($id);
        $users = User::where('state', '>', 0)->get();
        $plans = Plan::where('state', '>', 0)->get();
        return view('admin.change_plans.edit', compact('change_plan', 'users', 'plans'));
    }

    public function update(Request $request, $id)
    {
        
        $change_plan = PlanChangeRequest::findOrFail($id);

        $request->validate([
            'observations' => 'nullable|string',
            'state' => 'required|in:0,1,2',
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($change_plan->image && file_exists(public_path($change_plan->image))) {
                unlink(public_path($change_plan->image));
            }

            // Subir nueva imagen
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/vouchers'), $filename);

            // Guardar ruta relativa en la base de datos
            $change_plan->image = 'uploads/vouchers/' . $filename;
        }

        $change_plan->observations = $request->observations;
        $change_plan->state = $request->state;
        $change_plan->updated_by = Auth::id();
        $change_plan->save();

        if ($request->state == 2)
        {
            // 🔹 Desactivar cualquier plan activo anterior
            UserPlan::where('idUser', $change_plan->idUser)
                ->where('active', 1)
                ->update(['active' => 0]);

            // 🔹 Buscar si ya existe el plan solicitado
            if ($activePlan = UserPlan::where('idUser', $change_plan->idUser)
                        ->where('idPlan', $change_plan->idPlan)
                        ->first())
            {
                $activePlan->active = 1;
                $activePlan->started_at = now();
                $activePlan->updated_at = now();
                $activePlan->expires_at = now()->addDays(30); // asegúrate de actualizar la fecha de expiración también
                $activePlan->save();
            }
            else
            {
                UserPlan::create([
                    'idUser'     => $change_plan->idUser,
                    'idPlan'     => $change_plan->idPlan,
                    'started_at' => now(),
                    'created_at' => now(),
                    'expires_at' => now()->addDays(30),
                    'active'     => 1,
                ]);
            }
        }

        return redirect()->route('change_plans.edit', $change_plan->id)->with('success', '✅ Comprobante actualizado.');
    }


    public function delete()
    {
        $change_plans = PlanChangeRequest::with(['user', 'plan'])->where('state', 0)->paginate(10);
        return view('admin.change_plans.delete', compact('change_plans'));
    }

    public function activate($id)
    {
        $change_plan = PlanChangeRequest::findOrFail($id);
        $change_plan->state = 1;
        $change_plan->save();

        return redirect()->route('change_plans.delete')->with('success', '✅ Comprobante reactivado.');
    }
}
