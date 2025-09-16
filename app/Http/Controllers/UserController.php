<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserReference;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Elocuent;
use App\Http\Controllers\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        $user = User::all();
        
        return view('admin.gestionUser', compact('user'));
    }

    public function dashboardAdmin()
    {
        // Obtener el usuario autenticado
        $user = Auth::User();
        
        return view('admin.inicio', [
            'userV' => $user
        ]);
    }

    public function dashboardUser()
    {
        // Obtener el usuario autenticado
        $user = Auth::User();
        
        return view('user.inicio', [
            'userV' => $user
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::User();
        return view('admin.create', ['userV' => $user]);
    }

     public function vistaEditar()
    {
        $user = User::all();
        return view('admin.edit', ['userV' => $user]);
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $userV = Auth::User();
        return view('admin.edit', compact('user', 'userV'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        /*
        $request->validate([
            'name' => 'required|string',
            'email' => "required|email|unique:users",
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:6',
        ]);*/

        $user->name = $request->name;
        //$user->firstLastName = $request->name;
        //$user->secondLastName = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->save();

        return redirect()->route('gU')->with('success', 'Usuario actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->update(['estado' => 0]);
        return redirect()->route('gU')->with('success', 'Usuario eliminado.');
    }

    public function cambiarContrasenia(Request $request)
    {
        $userV = Auth::User();
        return view('user.cambiarContrasenia', compact('userV'));
    }
    public function actualizarContrasenia(Request $request)
    {
        function validarContrasenia($contrasenia) {
        return (
            strlen($contrasenia) >= 8 &&
            preg_match('/[a-z]/', $contrasenia) &&       // minúscula
            preg_match('/[A-Z]/', $contrasenia) &&       // mayúscula
            preg_match('/\d/', $contrasenia) &&          // número
            preg_match('/[\W_]/', $contrasenia)          // carácter especial
        );
        }
        $usuario = Auth::user();
        $newC = $request->input('Ncontra');
        $confirm = $request->input('Ccontra');
        $oldC = $request->input('Acontra');
        $oldCH = bcrypt($oldC);
        $newCH = bcrypt($newC);

        if (Hash::check($oldC, $usuario->password) && $newC == $confirm){
            if(validarContrasenia($newC))
            {
                // Actualizar la contraseña en la base de datos
            DB::table('users')
                ->where('id', $usuario->id)
                ->update(['password' => $newCH]);

            return redirect()->back()->with('success', 'Contraseña actualizada con éxito');
            }
            else
            {
                return redirect()->back()->with('error', 'La nueva contraseña debe tener al menos 8 caracteres, una minuscula, mayuscula, numero y caracter especial');
            }
            
        } else {
            return redirect()->back()->with('error', 'La contraseña actual es incorrecta');
        }
    }

    //Archivos php Api -- Android
    public function loginApi(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (empty($email) || empty($password)) {
            return response()->json([
                'success' => false,
                'message' => 'Faltan parámetros'
            ]);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ]);
        }

        if (Hash::check($password, $user->password)) {
            return response()->json([
                'success' => true,
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta'
            ]);
        }
    }

    public function getLastReadingApi(Request $request)
    {
        $idUser = $request->query('idUser');

        if (!$idUser) {
            return response()->json([
                'success' => false,
                'message' => 'Falta parámetro idUser'
            ]);
        }

        $reading = DB::table('readings')
            ->select(
                'temperature',
                'humidity',
                'ds18b20_temp',
                'soil_moisture',
                'mq135',
                'ammonia',
                'co2',
                'co',
                'benzene',
                'alcohol',
                'smoke'
            )
            ->where('idUser', $idUser)
            ->orderByDesc('id')
            ->limit(1)
            ->first();

        if ($reading) {
            // Convertimos a float (Laravel usa stdClass por defecto)
            $formatted = [];
            foreach ($reading as $key => $value) {
                $formatted[$key] = floatval($value);
            }

            return response()->json([
                'success' => true,
                'data' => $formatted
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron datos'
            ]);
        }
    }

    public function getHistoricalReadingsApi(Request $request)
    {
        $idUser = intval($request->query('idUser'));


        $readings = DB::table('readings')
            ->select(
                'temperature',
                'humidity',
                'ds18b20_temp',
                'soil_moisture',
                'mq135',
                DB::raw("CONCAT(date, ' ', time) AS datetime")
            )
            ->where('idUser', $idUser)
            ->orderByDesc('id')
            ->limit(10)
            ->get();

        if ($readings->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron registros'
            ]);
        }

        // Formateamos los datos como array de float + datetime
        $data = $readings->map(function ($row) {
            return [
                'temperature' => floatval($row->temperature),
                'humidity' => floatval($row->humidity),
                'ds18b20_temp' => floatval($row->ds18b20_temp),
                'soil_moisture' => floatval($row->soil_moisture),
                'mq135' => floatval($row->mq135),
                'datetime' => $row->datetime
            ];
        })->reverse()->values(); // orden cronológico ascendente

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function updateUserApi(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:100',
            'firstLastName' => 'required|string|max:100',
            'secondLastName' => 'required|string|max:100',
            'username' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6'
        ]);

        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
        }

        $user->name = $request->name;
        $user->firstLastName = $request->firstLastName;
        $user->secondLastName = $request->secondLastName;
        $user->username = $request->username;
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Error al actualizar el usuario'], 500);
        }
    }

    public function getUserByIdApi(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:users,id',
        ]);

        $user = \App\Models\User::select('id', 'name', 'firstLastName', 'secondLastName', 'username', 'email')
            ->find($request->id);

        if ($user) {
            return response()->json(['success' => true, 'data' => $user]);
        } else {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
        }
    }

    
}
