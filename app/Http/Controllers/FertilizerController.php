<?php

namespace App\Http\Controllers;

use App\Models\Fertilizer;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Models\Location;

class FertilizerController extends Controller
{
    public function index()
    {
        $userV = Auth::User();
        $fertilizers = Fertilizer::with(['location', 'user'])
            ->where('state', 1)
            ->where('idUser', $userV->id)
            ->paginate(10); // Esto reemplaza LIMIT y OFFSET automáticamente

        return view('user.vistaProductos', compact('fertilizers', 'userV'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::User();
        return view('admin.create', ['userV' => $user]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'address' => 'required|string',
            'link' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $enlace = $request->link;
        $lat = $lng = null;

        if (
            preg_match('/[?&]q=(-?\d+\.\d+),(-?\d+\.\d+)/', $enlace, $matches) ||   // ?q=lat,lng
            preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $enlace, $matches) ||       // @lat,lng
            preg_match('/(-?\d+\.\d+),(-?\d+\.\d+)/', $enlace, $matches)           // cualquier lat,lng
        ) {
            $lat = number_format((float)$matches[1], 8, '.', '');
            $lng = number_format((float)$matches[2], 8, '.', '');
        } else {
            return back()->with('error', 'No se pudo extraer latitud y longitud del enlace.');
        }
        DB::beginTransaction();
        try {
            $imagePath = null;
           if ($request->hasFile('image')) {
                $file = $request->file('image');
                // Genera un nombre único para evitar colisiones
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/fertilizers';
                // Mueve el archivo directamente a la carpeta pública uploads/fertilizers
                $file->move($destination, $filename);
                // Guardamos la ruta relativa en la BD
                $imagePath = 'uploads/fertilizers/' . $filename;
            }


            $fertilizer = Fertilizer::create([
                'idUser' => Auth::User()->id,
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'amount' => $request->amount,
                'stock' => $request->stock,
                'price' => $request->price,
                'image' => $imagePath
            ]);

            Location::create([
                'idFertilizer' => $fertilizer->id,
                'latitude' => $lat,
                'longitude' => $lng,
                'address' => $request->address,
                'link_google_maps' => $enlace
            ]);

            DB::commit();
            return redirect()->route('vista')->with('success', 'Producto creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('vista')->with('error', 'Error al guardar: ' . $e->getMessage());
        }

    }

   
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:100',
        'description' => 'nullable|string',
        'type' => 'required|string',
        'amount' => 'required|numeric|min:0',
        'stock' => 'required|numeric|min:0',
        'address' => 'required|string',
        'link' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|max:2048',
    ]);

    $fertilizer = Fertilizer::findOrFail($id);

    $enlace = $request->link;
    $lat = $lng = null;

    if (
        preg_match('/[?&]q=(-?\d+\.\d+),(-?\d+\.\d+)/', $enlace, $matches) ||
        preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $enlace, $matches) ||
        preg_match('/(-?\d+\.\d+),(-?\d+\.\d+)/', $enlace, $matches)
    ) {
        $lat = number_format((float)$matches[1], 8, '.', '');
        $lng = number_format((float)$matches[2], 8, '.', '');
    } else {
        return back()->with('error', 'No se pudo extraer latitud y longitud del enlace.');
    }

    DB::beginTransaction();
    try {
        // Mantener la imagen actual por defecto
        $imagePath = $fertilizer->image;

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $fertilizer->image;
            if ($fertilizer->image && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/fertilizers';

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            if ($file->move($destination, $filename)) {
                $imagePath = 'uploads/fertilizers/' . $filename;
            }
        }

        // Actualizar datos del fertilizante
        $fertilizer->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'amount' => $request->amount,
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        // Actualizar ubicación relacionada
        $location = Location::where('idFertilizer', $fertilizer->id)->first();
        if ($location) {
            $location->update([
                'latitude' => $lat,
                'longitude' => $lng,
                'address' => $request->address,
                'link_google_maps' => $enlace
            ]);
        } else {
            Location::create([
                'idFertilizer' => $fertilizer->id,
                'latitude' => $lat,
                'longitude' => $lng,
                'address' => $request->address,
                'link_google_maps' => $enlace
            ]);
        }

        DB::commit();
        return redirect()->route('vista')->with('success', 'Producto actualizado correctamente.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('vista')->with('error', 'Error al actualizar: ' . $e->getMessage());
    }
}



public function destroy($id)
{
    $fertilizer = Fertilizer::findOrFail($id);

    // Eliminar imagen física si existe
    // if ($fertilizer->image && File::exists(public_path($fertilizer->image))) {
    //     unlink(public_path($fertilizer->image));
    // }

   $fertilizer->update([
    'state' => 0,
    'featured' => 0,
]);

    return redirect()->route('vista')->with('success', 'Producto eliminado exitosamente.');
}



public function starw($id)
{
    $user = Auth::user();
    $plan = UserPlan::where('idUser', $user->id)
                ->where('active', 1)
                ->firstOrFail();

    $post = match ($plan->idPlan) {
        1 => 1,
        2 => 3,
        3 => 6,
        default => 0,
    };

    $fertilizer = Fertilizer::findOrFail($id);

    $rest = Fertilizer::where('idUser', $user->id)
                      ->where('featured', 1)
                      ->count();

    if ($fertilizer->featured == 1) {
        // Si ya está destacado, desmarcarlo sin límite
        $fertilizer->featured = 0;
        $fertilizer->save();
        return redirect()->route('vista')->with('success', 'Producto desmarcado correctamente.');
    } else {
        // Si quiere marcarlo, verifica que no exceda límite
        if ($rest < $post) {
            $fertilizer->featured = 1;
            $fertilizer->save();
            return redirect()->route('vista')->with('success', 'Producto marcado como destacado correctamente.');
        } else {
            return redirect()->route('vista')->with('error', 'Adquiera un plan mejorado para poder marcar más productos destacados.');
        }
    }
}


}

    
