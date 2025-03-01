<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MiCorreo;

class TestMailController extends Controller
{
    // Muestra el formulario
    public function mostrarFormulario() {
        return view('correo.formulario');
    }

    // Procesa el formulario y envía el email
    public function enviarCorreo(Request $request) {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        $token = bin2hex(random_bytes(64));

        Mail::to($email)->send(new MiCorreo('Recuperar contraseña', $token));

        return redirect()->back()->with('success', 'Correo enviado correctamente.');
    }
}
