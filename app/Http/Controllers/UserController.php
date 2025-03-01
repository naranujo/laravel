<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {
    public function __construct() {
        $this->lang = $_GET['lang'] ?? 'es';

        // Check if user is logged in
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            // No puede acceder a la página de administración si no es un administrador
            // Redirect to intranet
            header('Location: /intranet?lang=' . $this->lang);
            exit;
        }
    }
}
