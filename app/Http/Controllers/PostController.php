<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller {
    
    public function __construct() {
        $this->lang = $_GET['lang'] ?? 'es';
    }

    public function intranet() {
        if (session('user') == null) {
            return redirect()->route('view.login', ['lang' => $this->lang]);
        } else {
            $this->loggedIn = true;
            $this->role = session('user')->role;

            $this->homeLabel = [
                'es' => 'Inicio',
                'en' => 'Home',
                'pt' => 'Início'
            ];

            $this->newPostLabel = [
                'es' => 'Nuevo posteo',
                'en' => 'New post',
                'pt' => 'Nova postagem'
            ];

            $this->greetings = [
                'es' => 'Hola ' . session('user')->first_name . ", bienvenido",
                'en' => 'Hello ' . session('user')->first_name . ", welcome",
                'pt' => 'Olá ' . session('user')->first_name . ", bem-vindo"
            ];

            $this->profileLabel = [
                'es' => 'Perfil',
                'en' => 'Profile',
                'pt' => 'Perfil'
            ];

            $this->logoutLabel = [
                'es' => 'Cerrar sesión',
                'en' => 'Logout',
                'pt' => 'Sair'
            ];
    
            $this->usersAdminLabel = [
                'es' => 'Administración de usuarios',
                'en' => 'Users management',
                'pt' => 'Administração de usuários'
            ];
        }

        $this->title = [
            'es' => 'Intranet',
            'en' => 'Intranet',
            'pt' => 'Intranet'
        ];

        $this->description = [
            'es' => 'Bienvenido a la intranet de la empresa.',
            'en' => 'Welcome to the company\'s intranet.',
            'pt' => 'Bem-vindo à intranet da empresa.'
        ];

        $this->back = [
            'es' => 'Salir',
            'en' => 'Exit',
            'pt' => 'Sair'
        ];

        return view('intranet.home', [
            'lang' => $this->lang ?? 'es',
            'title' => $this->title[$this->lang],
            'description' => $this->description[$this->lang],
            'loggedIn' => $this->loggedIn,
            'role' => $this->role,
            'back' => $this->back[$this->lang],
            'homeLabel' => $this->homeLabel[$this->lang],
            'newPostLabel' => $this->newPostLabel[$this->lang],
            'greetings' => $this->greetings[$this->lang],
            'profileLabel' => $this->profileLabel[$this->lang],
            'logoutLabel' => $this->logoutLabel[$this->lang],
            'usersAdminLabel' => $this->usersAdminLabel[$this->lang]
        ]);
    }
}
