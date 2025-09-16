<?php

namespace App\Http\Controllers;

use App\Models\UserReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class UserReferenceController extends Controller
{
    // Controlador
    public function index()
    {
        $references = UserReference::with(['user'])->paginate(10); // 👈 Esto permite usar links()
        return view('admin.user_references.gestionUserReferences', compact('references'));
    }


    public function create()
    {
        $usuarios = User::all();
        return view('admin.user_references.create', compact('usuarios'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'idUser' => 'required|exists:users,id',
        'phone' => 'nullable|string|max:255',
        'contact_email' => 'nullable|email|max:100',
        'whatsapp_link' => 'nullable|url|max:255',
        'facebook_link' => 'nullable|url|max:255',
        'instagram_link' => 'nullable|url|max:255',
        'youtube_link' => 'nullable|url|max:255',
        'tiktok_link' => 'nullable|url|max:255',
        'qr_image' => 'nullable|image|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('qr_image')) {
        $file = $request->file('qr_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/qr_images';

        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        if ($file->move($destination, $filename)) {
            $imagePath = 'uploads/qr_images/' . $filename;
        }
    }

    $validated['qr_image'] = $imagePath;
    $validated['updated_by'] = Auth::id();

    UserReference::create($validated);

    return redirect()->route('user_references.create')->with('success', 'Referencia creada correctamente.');
}


    public function edit(UserReference $user_reference)
    {
        $usuarios = User::all(); // Si necesitas mostrar algo del usuario
        return view('admin.user_references.edit', compact('user_reference', 'usuarios'));
    }


    public function update(Request $request, UserReference $user_reference)
{
    $validated = $request->validate([
        'phone' => 'nullable|string|max:255',
        'contact_email' => 'nullable|email|max:100',
        'whatsapp_link' => 'nullable|url|max:255',
        'facebook_link' => 'nullable|url|max:255',
        'instagram_link' => 'nullable|url|max:255',
        'youtube_link' => 'nullable|url|max:255',
        'tiktok_link' => 'nullable|url|max:255',
        'qr_image' => 'nullable|image|max:2048',
    ]);

    // Mantener la imagen actual por defecto
    $imagePath = $user_reference->qr_image;

    if ($request->hasFile('qr_image')) {
        // Eliminar imagen anterior si existe
        if ($imagePath) {
            $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $imagePath;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $file = $request->file('qr_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/qr_images';

        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        if ($file->move($destination, $filename)) {
            $imagePath = 'uploads/qr_images/' . $filename;
        }
    }

    // Asignar la ruta de la imagen y usuario que actualiza
    $validated['qr_image'] = $imagePath;
    $validated['updated_by'] = Auth::id();

    $user_reference->update($validated);

    return redirect()->route('user_references.edit', $user_reference->id)
        ->with('success', 'Referencia actualizada correctamente.');
}


   public function updateProfile(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Validación básica de perfil
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'firstLastName' => 'required|string|max:255',
        'secondLastName' => 'nullable|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'current_password' => 'nullable|string',
        'new_password' => 'nullable|string|confirmed', // Se confirma con new_password_confirmation
    ]);

    $validated['updated_by'] = $user->id;

    // Actualizar datos básicos
    $user->update($validated);

    // Función para validar la nueva contraseña
    function validarContrasenia($contrasenia) {
        return (
            strlen($contrasenia) >= 8 &&
            preg_match('/[a-z]/', $contrasenia) &&       // minúscula
            preg_match('/[A-Z]/', $contrasenia) &&       // mayúscula
            preg_match('/\d/', $contrasenia) &&          // número
            preg_match('/[\W_]/', $contrasenia)          // carácter especial
        );
    }

    // Si el usuario ingresa contraseña actual y nueva
    if ($request->filled('current_password') && $request->filled('new_password')) {

        // Verificar que la contraseña actual sea correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'La contraseña actual es incorrecta');
        }

        // Validar la nueva contraseña
        if (!validarContrasenia($request->new_password)) {
            return redirect()->back()->with('error', 'La nueva contraseña debe tener al menos 8 caracteres, una minúscula, una mayúscula, un número y un carácter especial');
        }

        // Guardar la nueva contraseña
        $user->password = Hash::make($request->new_password);
        $user->save();
    }

    return redirect()->back()->with('success', 'Perfil actualizado correctamente.');

}
    public function addressReferences(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'phone' => 'nullable|string|max:20',
        'contact_email' => 'nullable|email|max:255',
        'whatsapp_link' => 'nullable|url|max:255',
        'facebook_link' => 'nullable|url|max:255',
        'instagram_link' => 'nullable|url|max:255',
        'youtube_link' => 'nullable|url|max:255',
        'tiktok_link' => 'nullable|url|max:255',
        'qr_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Buscar referencia existente
    $reference = UserReference::where('idUser', $user->id)->first();

    // Mantener imagen anterior por defecto
    $imagePath = $reference ? $reference->qr_image : null;

    if ($request->hasFile('qr_image')) {
        // Eliminar imagen anterior si existe
        if ($imagePath) {
            $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $imagePath;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $file = $request->file('qr_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/qr_images';

        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        if ($file->move($destination, $filename)) {
            $imagePath = 'uploads/qr_images/' . $filename;
        }
    }

    // Asociar al usuario y guardar datos
    $validated['idUser'] = $user->id;
    $validated['qr_image'] = $imagePath;

    UserReference::updateOrCreate(
        ['idUser' => $user->id],
        $validated
    );

    return redirect()->back()->with('success', 'Referencias guardadas correctamente.');
}


}
