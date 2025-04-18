<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PasswordReset;

use App\Http\Controllers\MailController;

class AuthController extends Controller {
    public function __construct() {
        $this->lang = $_GET['lang'] ?? 'es';

        // Check if user is logged in
        if (session('user')) {
            $this->loggedIn = true;
            $this->role = session('user')->role;
        } else {
            $this->loggedIn = false;
            $this->role = null;
        }
    }
    
    // REGISTRO CHECK :)
    public function showRegister() {
        $this->title = [
            'es' => 'Registrarse',
            'en' => 'Register',
            'pt' => 'Registrar-se'
        ];
    
        $this->description = [
            'es' => 'Si no tenés cuenta, completá el siguiente formulario para registrarte.',
            'en' => 'If you don\'t have an account, fill out the following form to register.',
            'pt' => 'Se você não tem uma conta, preencha o formulário a seguir para se registrar.'
        ];

        $this->back = [
            'es' => 'Salir',
            'en' => 'Exit',
            'pt' => 'Sair'
        ];

        $this->cuilLabel = [
            'es' => 'CUIL',
            'en' => 'CUIL',
            'pt' => 'CUIL'
        ];

        $this->firstNameLabel = [
            'es' => 'Nombre',
            'en' => 'First Name',
            'pt' => 'Nome'
        ];

        $this->lastNameLabel = [
            'es' => 'Apellido',
            'en' => 'Last Name',
            'pt' => 'Sobrenome'
        ];
    
        $this->emailLabel = [
            'es' => 'Correo Electrónico',
            'en' => 'Email',
            'pt' => 'E-mail'
        ];
    
        $this->passwordLabel = [
            'es' => 'Contraseña',
            'en' => 'Password',
            'pt' => 'Senha'
        ];

        $this->loginLabel0 = [
            "es" => "Si ya tenés cuenta, ",
            "en" => "If you already have an account, ",
            "pt" => "Se você já tem uma conta, "
        ];

        $this->loginLabel1 = [
            "es" => "iniciá sesión",
            "en" => "log in",
            "pt" => "entre"
        ];
        
        return view('intranet.register', [
            'lang' => $this->lang,
            'title' => $this->title[$this->lang],
            'description' => $this->description[$this->lang],
            'loggedIn' => $this->loggedIn,
            'role' => $this->role,
            'back' => $this->back[$this->lang],
            'cuilLabel' => $this->cuilLabel[$this->lang],
            'firstNameLabel' => $this->firstNameLabel[$this->lang],
            'lastNameLabel' => $this->lastNameLabel[$this->lang],
            'emailLabel' => $this->emailLabel[$this->lang],
            'passwordLabel' => $this->passwordLabel[$this->lang],
            'loginLabel0' => $this->loginLabel0[$this->lang],
            'loginLabel1' => $this->loginLabel1[$this->lang]
        ]);
    }

    // FUNCIONA, PERO HAY QUE REVISAR LAS VERIFICACIONES DE SEGURIDAD
    public function processRegister(Request $request) {
        $existEmail = [
            'es' => 'El correo electrónico ya existe. Intenta iniciar sesión',
            'en' => 'Email already exists. Try to log in',
            'pt' => 'O e-mail já existe. Tente fazer login'
        ];

        $existEmailSuspended = [
            'es' => 'El correo electrónico ya existe. Contacta a tu administrador',
            'en' => 'Email already exists. Contact your administrator',
            'pt' => 'O e-mail já existe. Entre em contato com seu administrador'
        ];

        $notAuthorized = [
            'es' => 'No está autorizado a registrarse',
            'en' => 'You are not authorized to register',
            'pt' => 'Você não está autorizado a se registrar'
        ];

        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $firstName = filter_var($request->input('firstName'), FILTER_SANITIZE_STRING);
        $lastName = filter_var($request->input('lastName'), FILTER_SANITIZE_STRING);
        $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);
        $password = filter_var($request->input('password'), FILTER_SANITIZE_STRING);

        $user = User::where('email', $email)->first();

        if ($user && $user->status == 'inactive') {
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->email = $email;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->status = 'active';
            $user->save();

            return redirect()->route('view.login');
        } else if ($user && $user->status == 'active') {
            return redirect()->back()->with('error', $existEmail[$this->lang]);
        } else if ($user && $user->status == 'suspended') {
            return redirect()->back()->with('error', $existEmailSuspended[$this->lang]);
        } else {
            return redirect()->back()->with('error', $notAuthorized[$this->lang]);
        }
    }

    // LOGIN CHECK :)
    public function showLogin() {
        // head
        $this->title = [
            'es' => 'Iniciar Sesión',
            'en' => 'Log In',
            'pt' => 'Entrar'
        ];
    
        $this->description = [
            'es' => 'Si no podés ingresar porque <span class="text-secondary" style="text-decoration:underline;">olvidaste tu contraseña</span> o <span class="text-secondary" style="text-decoration:underline;">no tenés cuenta</span> comunicate con tu administrador.',
            'en' => 'If you can\'t log in because you <span class="text-secondary" style="text-decoration:underline;">forgot your password</span> or <span class="text-secondary" style="text-decoration:underline;">don\'t have an account</span> contact your administrator.',
            'pt' => 'Se você não consegue entrar porque <span class="text-secondary" style="text-decoration:underline;">esqueceu sua senha</span> ou <span class="text-secondary" style="text-decoration:underline;">não tem uma conta</span> entre em contato com seu administrador.'
        ];
    
        // header
        $this->back = [
            'es' => 'Salir',
            'en' => 'Exit',
            'pt' => 'Sair'
        ];

        // form
        $this->emailLabel = [
            'es' => 'Correo Electrónico',
            'en' => 'Email',
            'pt' => 'E-mail'
        ];
    
        $this->passwordLabel = [
            'es' => 'Contraseña',
            'en' => 'Password',
            'pt' => 'Senha'
        ];

        $this->forgotPasswordLabel = [
            "es" => "¿Olvidaste tu contraseña?",
            "en" => "Forgot your password?",
            "pt" => "Esqueceu sua senha?"
        ];
        
        $this->registerLabel0 = [
            "es" => "Si todavía no tenés cuenta, ",
            "en" => "If you don't have an account yet, ",
            "pt" => "Se você ainda não tem uma conta, "
        ];

        $this->registerLabel1 = [
            "es" => "registrate",
            "en" => "register",
            "pt" => "registre-se"
        ];

        return view('intranet.login', [
            'lang' => $this->lang,
            'title' => $this->title[$this->lang],
            'description' => $this->description[$this->lang],
            'loggedIn' => $this->loggedIn,
            'role' => $this->role,
            'back' => $this->back[$this->lang],
            'emailLabel' => $this->emailLabel[$this->lang],
            'passwordLabel' => $this->passwordLabel[$this->lang],
            'forgotPasswordLabel' => $this->forgotPasswordLabel[$this->lang],
            'registerLabel0' => $this->registerLabel0[$this->lang],
            'registerLabel1' => $this->registerLabel1[$this->lang],
        ]);
    }

    // FUNCIONA, PERO HAY QUE REVISAR LAS VERIFICACIONES DE SEGURIDAD
    public function processLogin(Request $request) {

        $emailOrPasswordIncorrect = [
            'es' => 'Email o contraseña incorrectos',
            'en' => 'Email or password incorrect',
            'pt' => 'E-mail ou senha incorretos'
        ];
        
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);
        $password = filter_var($request->input('password'), FILTER_SANITIZE_STRING);

        $user = User::where('email', $email)->first();

        if ($user) {
            // Check if password is correct
            if (password_verify($password, $user->password)) {

                User::where('email', $email)->update(['last_login' => now()]);

                $user = User::where('email', $email)->first();

                session(['user' => $user]);
                
                return redirect()->route('view.intranet');
            }
        }

        return redirect()->back()->with('error', $emailOrPasswordIncorrect[$this->lang]);
    }

    public function logout() {
        session()->forget('user');
        return redirect()->route('view.login');
    }

    public function showForgotPassword() {
        // head
        $this->title = [
            'es' => 'Olvidé mi Contraseña',
            'en' => 'Forgot Password',
            'pt' => 'Esqueci minha Senha'
        ];

        $this->description = [
            'es' => 'Ingresá tu correo electrónico para recibir un enlace para restablecer tu contraseña.',
            'en' => 'Enter your email to receive a link to reset your password.',
            'pt' => 'Digite seu e-mail para receber um link para redefinir sua senha.'
        ];

        // header
        $this->back = [
            'es' => 'Salir',
            'en' => 'Exit',
            'pt' => 'Sair'
        ];

        // form
        $this->emailLabel = [
            'es' => 'Correo Electrónico',
            'en' => 'Email',
            'pt' => 'E-mail'
        ];        

        $this->loginLabel0 = [
            "es" => "Si recordás tu contraseña, ",
            "en" => "If you remember your password, ",
            "pt" => "Se você se lembra da sua senha, "
        ];

        $this->loginLabel1 = [
            "es" => "iniciá sesión",
            "en" => "log in",
            "pt" => "entre"
        ];

        return view('intranet.forgot_password', [
            'lang' => $this->lang,
            'title' => $this->title[$this->lang],
            'description' => $this->description[$this->lang],
            'loggedIn' => $this->loggedIn,
            'role' => $this->role,
            'back' => $this->back[$this->lang],
            'emailLabel' => $this->emailLabel[$this->lang],
            'loginLabel0' => $this->loginLabel0[$this->lang],
            'loginLabel1' => $this->loginLabel1[$this->lang],
        ]);
    }

    public function processForgotPassword(Request $request) {
        $subject = [
            'es' => 'Recuperar contraseña',
            'en' => 'Recover password',
            'pt' => 'Recuperar senha'
        ];

        $successMessage = [
            'es' => 'Si el correo electrónico ingresado existe, recibirás un enlace para restablecer tu contraseña.',
            'en' => 'If the entered email exists, you will receive a link to reset your password.',
            'pt' => 'Se o e-mail inserido existir, você receberá um link para redefinir sua senha.'
        ];

        // Validate
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        // Sanitize
        $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);

        // Check if email exists
        $user = User::where('email', $email)->first();

        if ($user) {
            // Send email with link to reset password
            PasswordReset::where('email', $email)->delete();

            $token = bin2hex(random_bytes(16));
            $subject = "Recuperación de Contraseña";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Greenock Trust <webmaster@greenocktrust.com>" . "\r\n";
            $message = '
                <!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <title>Recuperación de Contraseña</title>
                        <style>
                            body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
                            .container { max-width: 600px; margin: 20px auto; background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
                            .header { text-align: center; padding-bottom: 20px; }
                            .button { display: inline-block; padding: 10px 20px; margin: 20px 0; font-size: 16px; color: #ffffff; background-color: #007bff; text-decoration: none; border-radius: 5px; }
                            .footer { font-size: 12px; color: #666; text-align: center; margin-top: 20px; }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="header">
                                <h2>Recuperación de Contraseña</h2>
                            </div>
                            <p>Hola, ' . $user->first_name . ' ' . $user->last_name . '</p>
                            <p>Recibimos una solicitud para restablecer tu contraseña. Haz clic en el botón de abajo para continuar:</p>
                            <p style="text-align: center;">
                                <a href="' . url('https://greenocktrust.com/intranet/password/reset?token=' . $token . '&email=' . $email) . '" class="button">Restablecer Contraseña</a>
                            </p>
                            <p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
                            <p><strong>Nota:</strong> Este código es válido solo por 30 minutos. Después de ese tiempo, necesitarás solicitar un nuevo código.</p>
                            <p>Saludos,<br>El equipo de Greenock Trust</p>
                            <div class="footer">
                                <p>Este es un mensaje automático, por favor no respondas.</p>
                            </div>
                        </div>
                    </body>
                </html>
            ';
            
            DB::beginTransaction();

            try {
                $passwordReset = new PasswordReset();
                $passwordReset->email = $email;
                $passwordReset->token = $token;
                $passwordReset->save();

                // Send email
                mail($email, $subject, $message, $headers);

                // Commit transaction
                DB::commit();

                return redirect()->back()->with('success', $successMessage[$this->lang]);

            } catch (\Exception $e) {
                DB::rollBack();
                // Handle error
                return redirect()->back()->with('error', 'Error al enviar el correo electrónico. Intenta nuevamente más tarde.');
            }
        } else {
            return redirect()->back()->with('error', $successMessage[$this->lang]);
        }

    }

    public function showResetPassword() {

        // get token and email from url
        $token = $_GET['token'] ?? null;
        $email = $_GET['email'] ?? null;

        if (!$token || !$email) {
            return redirect()->route('view.error', ['lang' => 'es', 'status_code' => 400]);
        }

        // si la sesión está activa, redirigir a la página de inicio
        if ($this->loggedIn) {
            return redirect()->route('view.intranet');
        }

        // head
        $this->title = [
            'es' => 'Restablecer Contraseña',
            'en' => 'Reset Password',
            'pt' => 'Redefinir Senha'
        ];

        $this->description = [
            'es' => 'Ingresá tu nueva contraseña.',
            'en' => 'Enter your new password.',
            'pt' => 'Digite sua nova senha.'
        ];

        // header
        $this->back = [
            'es' => 'Salir',
            'en' => 'Exit',
            'pt' => 'Sair'
        ];

        // form
        $this->emailLabel = [
            'es' => 'Correo Electrónico',
            'en' => 'Email',
            'pt' => 'E-mail'
        ];

        $this->passwordLabel = [
            'es' => 'Contraseña',
            'en' => 'Password',
            'pt' => 'Senha'
        ];

        $this->confirmPasswordLabel = [
            'es' => 'Confirmar Contraseña',
            'en' => 'Confirm Password',
            'pt' => 'Confirmar Senha'
        ];

        $this->confirmPasswordLabel = [
            'es' => 'Confirmar Contraseña',
            'en' => 'Confirm Password',
            'pt' => 'Confirmar Senha'
        ];

        return view('intranet.reset_password', [
            'lang' => $this->lang,
            'title' => $this->title[$this->lang],
            'description' => $this->description[$this->lang],
            'loggedIn' => $this->loggedIn,
            'role' => $this->role,
            'back' => $this->back[$this->lang],
            'emailLabel' => $this->emailLabel[$this->lang],
            'passwordLabel' => $this->passwordLabel[$this->lang],
            'confirmPasswordLabel' => $this->confirmPasswordLabel[$this->lang],
            'token' => $token,
            'email' => $email
        ]);
    }

    public function processResetPassword(Request $request, $token) {
        // Validate
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        // Sanitize
        $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);
        $password = filter_var($request->input('password'), FILTER_SANITIZE_STRING);
        $confirm_password = filter_var($request->input('confirm_password'), FILTER_SANITIZE_STRING);

        // Check if token exists
        $passwordReset = PasswordReset::where('email', $email)->where('token', $token)->first();

        if ($passwordReset) {
            // Check if password and confirm password match
            if ($password === $confirm_password) {
                // Update user password
                $user = User::where('email', $email)->first();
                $user->password = password_hash($password, PASSWORD_DEFAULT);
                $user->save();

                // Delete token
                $passwordReset->delete();

                return redirect()->route('view.login')->with('success', 'Contraseña restablecida con éxito.');
            } else {
                return redirect()->back()->with('error', 'Las contraseñas no coinciden.');
            }
        } else {
            return redirect()->back()->with('error', 'Token inválido o expirado.');
        }
    }
}
