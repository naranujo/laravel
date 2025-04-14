<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Section;

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

        $sinNovedades = [
            'es' => 'No hay novedades',
            'en' => 'No news'
        ];

        $posts = Post::orderBy('created_at', 'desc')
            ->get();

        foreach ($posts as $post) {
            $post->setAttribute('title', ucfirst(strip_tags($post->title)));

            // format date DD/MM/AAAA
            $date = date('d/m/Y', strtotime($post->created_at));
            $post->setAttribute('formatted_created_at', $date); // No modificar 'created_at'

            // capitalize status
            $post->setAttribute('status', ucfirst($post->status));
        }

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
            'usersAdminLabel' => $this->usersAdminLabel[$this->lang],
            'posts' => $posts,
        ]);
    }

    public function showCreatePost() {
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
            'es' => 'Nuevo posteo',
            'en' => 'New post',
            'pt' => 'Nova postagem'
        ];

        $this->description = [
            'es' => 'Crea un nuevo posteo.',
            'en' => 'Create a new post.',
            'pt' => 'Crie uma nova postagem.'
        ];

        return view('intranet.create_post', [
            'lang' => $this->lang ?? 'es',
            'title' => $this->title[$this->lang],
            'description' => $this->description[$this->lang],
            'loggedIn' => $this->loggedIn,
            'role' => $this->role,
            'homeLabel' => $this->homeLabel[$this->lang],
            'newPostLabel' => $this->newPostLabel[$this->lang],
            'greetings' => $this->greetings[$this->lang],
            'profileLabel' => $this->profileLabel[$this->lang],
            'logoutLabel' => $this->logoutLabel[$this->lang],
            'usersAdminLabel' => $this->usersAdminLabel[$this->lang]
        ]);
    }

    public function storePost(Request $request) {

        $allowedImages = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'];

        // validar los datos
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'resume' => 'required|string',
            'image' => 'required|string|max:255|in:' . implode(',', $allowedImages),
            'category_name' => 'required|string|max:255',
            'sections' => 'required|array',
            'sections.*.subtitle' => 'required|string|max:255',
            'sections.*.content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación: ' . $validator->errors()->first()
            ]);
        }

        DB::beginTransaction();

        try {

            $uuid = (string) Str::uuid();

            $post = new Post();
            $post->id = $uuid; // Asignar el UUID al post
            $post->title = $request->input('title');
            $post->resume = $request->input('resume');
            $post->image = $request->input('image');
            $post->category_name = $request->input('category_name');
            $post->author = "nicolas.araujo@apbrand.com.ar";
            $post->status = 'draft';
    
            $post->save(); // Guarda el post
    
            foreach ($request->input('sections') as $index => $section_data) {
                $section = new Section();
                $section->id = (string) Str::uuid(); // Convertir UUID a string
                $section->post_id = $uuid; // Asignar el ID del post
                $section->title = $section_data['subtitle'];
                $section->content = $section_data['content'];
                $section->order = $index;
                $section->save();
            }
    
            DB::commit();

            // Redirect a la vista de posteo /intranet/post/{id}
            return redirect()->route('view.post', ['lang' => $this->lang, 'id' => $uuid]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Mostrar mensaje de error
            // Recargar la vista con el mensaje de error sin borrar el formulario
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error al guardar el post: ' . $e->getMessage()]);
        }
    }

    public function showPost($id) {
        $lang = $this->lang ?? 'es';

        $post = Post::where('id', $id)
            ->with('sections')
            ->first();

        if (!$post) {
            return redirect()->route('view.error', ['lang' => $this->lang, 'status_code' => 404]);
        }

        $loggedIn = session('user') != null;
        
        $role = $loggedIn ? session('user')->role : null;
        
        $homeLabel = [
            'es' => 'Inicio',
            'en' => 'Home',
            'pt' => 'Início'
        ];

        $newPostLabel = [
            'es' => 'Nuevo posteo',
            'en' => 'New post',
            'pt' => 'Nova postagem'
        ];

        $greetings = [
            'es' => 'Hola ' . session('user')->first_name . ", bienvenido",
            'en' => 'Hello ' . session('user')->first_name . ", welcome",
            'pt' => 'Olá ' . session('user')->first_name . ", bem-vindo"
        ];

        $profileLabel = [
            'es' => 'Perfil',
            'en' => 'Profile',
            'pt' => 'Perfil'
        ];

        $logoutLabel = [
            'es' => 'Cerrar sesión',
            'en' => 'Logout',
            'pt' => 'Sair'
        ];

        $usersAdminLabel = [
            'es' => 'Administración de usuarios',
            'en' => 'Users management',
            'pt' => 'Administração de usuários'
        ];

        $title = [
            'es' => 'Posteo',
            'en' => 'Post',
            'pt' => 'Postagem'
        ];

        $description = [
            'es' => 'Detalle del posteo.',
            'en' => 'Post details.',
            'pt' => 'Detalhes do post.'
        ];

        $post->setAttribute('title', str_replace('<p>', '', $post->title));
        $post->setAttribute('title', str_replace('</p>', '', $post->title));
        $post->setAttribute('resume', str_replace('<p>', '', $post->resume));
        $post->setAttribute('resume', str_replace('</p>', '', $post->resume));

        foreach ($post->sections as $section) {
            $section->setAttribute('title', str_replace('<p>', '', $section->title));
            $section->setAttribute('title', str_replace('</p>', '', $section->title));
            $section->setAttribute('content', str_replace('<p>', '', $section->content));
            $section->setAttribute('content', str_replace('</p>', '', $section->content));
            $section->setAttribute('content', str_replace('<ul>', '<ul class="text-justify ml-2" style="line-height: 2;">', $section->content));
            $section->setAttribute('content', str_replace('<ol>', '<ol class="text-justify ml-2" style="line-height: 2;">', $section->content));
        }

        $sections = [];

        // Agregar acá
        $ordered = $post->sections->sortBy('order')->values()->all();

        $n = count($ordered);
        $half = intdiv($n, 2);

        $left = array_slice($ordered, 0, $half);
        $right = array_slice($ordered, $half);

        for ($i = 0; $i < $half; $i++) {
            $sections[] = $left[$i];
            if (isset($right[$i])) {
                $sections[] = $right[$i];
            }
        }

        if ($n % 2 !== 0) {
            $sections[] = $right[$half];
        }
        
        $post->setRelation('sections', $sections);
        
        return view('intranet.post', [
            'lang' => $lang,
            'title' => $title[$this->lang],
            'description' => $description[$this->lang],
            'loggedIn' => $loggedIn,
            'role' => $role,
            'homeLabel' => $homeLabel[$this->lang],
            'newPostLabel' => $newPostLabel[$this->lang],
            'greetings' => $greetings[$this->lang],
            'profileLabel' => $profileLabel[$this->lang],
            'logoutLabel' => $logoutLabel[$this->lang],
            'usersAdminLabel' => $usersAdminLabel[$this->lang],
            'post' => $post
        ]);
    }

    public function changeStatus(Request $request, $id) {
        
        $status = $request->input('status');

        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('view.error', ['lang' => $this->lang, 'status_code' => 404]);
        }

        try {
            $post->status = $status;
            $post->save();
            return redirect()->route('view.post', ['lang' => $this->lang, 'id' => $post->id]);
        } catch (\Exception $e) {
            return redirect()->route('view.error', ['lang' => $this->lang, 'status_code' => 500]);
        }
    }

    public function showEditPost($id) {
        $lang = $this->lang ?? 'es';

        $post = Post::with('sections')
            ->find($id);

        if (!$post) {
            return redirect()->route('view.error', ['lang' => $this->lang, 'status_code' => 404]);
        }

        $loggedIn = session('user') != null;
        
        $role = $loggedIn ? session('user')->role : null;
        
        $homeLabel = [
            'es' => 'Inicio',
            'en' => 'Home',
            'pt' => 'Início'
        ];

        $newPostLabel = [
            'es' => 'Nuevo posteo',
            'en' => 'New post',
            'pt' => 'Nova postagem'
        ];

        $greetings = [
            'es' => 'Hola ' . session('user')->first_name . ", bienvenido",
            'en' => 'Hello ' . session('user')->first_name . ", welcome",
            'pt' => 'Olá ' . session('user')->first_name . ", bem-vindo"
        ];

        $profileLabel = [
            'es' => 'Perfil',
            'en' => 'Profile',
            'pt' => 'Perfil'
        ];

        $logoutLabel = [
            'es' => 'Cerrar sesión',
            'en' => 'Logout',
            'pt' => 'Sair'
        ];

        $usersAdminLabel = [
            'es' => 'Administración de usuarios',
            'en' => 'Users management',
            'pt' => 'Administração de usuários'
        ];

        $title = [
            'es' => 'Editar posteo',
            'en' => 'Edit post',
            'pt' => 'Editar postagem'
        ];

        $description = [
            'es' => 'Edita el posteo.',
            'en' => 'Edit the post.',
            'pt' => 'Edite a postagem.'
        ];
                
        return view('intranet.edit_post', [
            'lang' => $lang,
            'title' => $title[$this->lang],
            'description' => $description[$this->lang],
            'loggedIn' => $loggedIn,
            'role' => $role,
            'homeLabel' => $homeLabel[$this->lang],
            'newPostLabel' => $newPostLabel[$this->lang],
            'greetings' => $greetings[$this->lang],
            'profileLabel' => $profileLabel[$this->lang],
            'logoutLabel' => $logoutLabel[$this->lang],
            'usersAdminLabel' => $usersAdminLabel[$this->lang],
            'post' => $post
        ]);
    }

    public function updatePost(Request $request, $id) {}

    public function destroyPost($id) {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('view.error', ['lang' => $this->lang, 'status_code' => 404]);
        }

        try {
            $post->delete();
            return redirect()->route('view.intranet', ['lang' => $this->lang])->with('success', 'Post eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('view.error', ['lang' => $this->lang, 'status_code' => 500]);
        }
    }

    public function downloadPost($id) {
        $post = Post::find($id)
            ->with('sections')
            ->first();
        
        if (!$post) {
            // redirect to error page
            return redirect()->route('view.error', ['lang' => $this->lang, 'status_code' => 404]);
        };

        $lang = $this->lang ?? 'es';

        $loggedIn = session('user') != null;
        
        $role = $loggedIn ? session('user')->role : null;
        
        $homeLabel = [
            'es' => 'Inicio',
            'en' => 'Home',
            'pt' => 'Início'
        ];

        $newPostLabel = [
            'es' => 'Nuevo posteo',
            'en' => 'New post',
            'pt' => 'Nova postagem'
        ];

        $greetings = [
            'es' => 'Hola ' . session('user')->first_name . ", bienvenido",
            'en' => 'Hello ' . session('user')->first_name . ", welcome",
            'pt' => 'Olá ' . session('user')->first_name . ", bem-vindo"
        ];

        $profileLabel = [
            'es' => 'Perfil',
            'en' => 'Profile',
            'pt' => 'Perfil'
        ];

        $logoutLabel = [
            'es' => 'Cerrar sesión',
            'en' => 'Logout',
            'pt' => 'Sair'
        ];

        $usersAdminLabel = [
            'es' => 'Administración de usuarios',
            'en' => 'Users management',
            'pt' => 'Administração de usuários'
        ];

        $title = [
            'es' => 'Posteo',
            'en' => 'Post',
            'pt' => 'Postagem'
        ];

        $description = [
            'es' => 'Detalle del posteo.',
            'en' => 'Post details.',
            'pt' => 'Detalhes do post.'
        ];

        $months = array(
            'es' => array(
                '01' => 'Enero',
                '02' => 'Febrero',
                '03' => 'Marzo',
                '04' => 'Abril',
                '05' => 'Mayo',
                '06' => 'Junio',
                '07' => 'Julio',
                '08' => 'Agosto',
                '09' => 'Septiembre',
                '10' => 'Octubre',
                '11' => 'Noviembre',
                '12' => 'Diciembre'
            ),
            'en' => array(
                '01' => 'January',
                '02' => 'February',
                '03' => 'March',
                '04' => 'April',
                '05' => 'May',
                '06' => 'June',
                '07' => 'July',
                '08' => 'August',
                '09' => 'September',
                '10' => 'October',
                '11' => 'November',
                '12' => 'December'
            ),
            'pt' => array(
                '01' => 'Janeiro',
                '02' => 'Fevereiro',
                '03' => 'Março',
                '04' => 'Abril',
                '05' => 'Maio',
                '06' => 'Junho',
                '07' => 'Julho',
                '08' => 'Agosto',
                '09' => 'Setembro',
                '10' => 'Outubro',
                '11' => 'Novembro',
                '12' => 'Dezembro'
            )
        );

        // formated date
        $date = date('d-m-Y', strtotime($post->created_at));
        $month = substr($date, 3, 2);
        $year = substr($date, 6, 4);
        $month_name = $months[$lang][$month] ?? $month; // Evita errores si $lang no está definido
        $post->setAttribute('formatted_created_at', $month_name . ' de ' . $year); // No modificar 'created_at'

        $post->setAttribute('title', str_replace('<p>', '', $post->title));
        $post->setAttribute('title', str_replace('</p>', '', $post->title));

        foreach ($post->sections as $section) {
            $section->setAttribute('title', str_replace('<p>', '', $section->title));
            $section->setAttribute('title', str_replace('</p>', '', $section->title));
            $section->setAttribute('content', str_replace('<p>', '', $section->content));
            $section->setAttribute('content', str_replace('</p>', '', $section->content));
            $section->setAttribute('content', str_replace('<ul>', '<ul class="text-justify ml-2" style="line-height: 2;">', $section->content));
        }

        $sections = [];

        // Agregar acá
        $ordered = $post->sections->sortBy('order')->values()->all();

        $n = count($ordered);
        $half = intdiv($n, 2);

        $left = array_slice($ordered, 0, $half);
        $right = array_slice($ordered, $half);

        for ($i = 0; $i < $half; $i++) {
            $sections[] = $left[$i];
            if (isset($right[$i])) {
                $sections[] = $right[$i];
            }
        }

        if ($n % 2 !== 0) {
            $sections[] = $right[$half];
        }
        
        $post->setRelation('sections', $sections);

        return view('intranet.download_post', [
            'lang' => $lang,
            'title' => $title[$this->lang],
            'description' => $description[$this->lang],
            'loggedIn' => $loggedIn,
            'role' => $role,
            'homeLabel' => $homeLabel[$this->lang],
            'newPostLabel' => $newPostLabel[$this->lang],
            'greetings' => $greetings[$this->lang],
            'profileLabel' => $profileLabel[$this->lang],
            'logoutLabel' => $logoutLabel[$this->lang],
            'usersAdminLabel' => $usersAdminLabel[$this->lang],
            'post' => $post
        ]);
    }

}
