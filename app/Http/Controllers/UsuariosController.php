<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;


class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('id', 'asc')->get();

        return view('usuarios.index', ['usuarios' => $usuarios, 'pagina' => 'usuarios']);
    }

    public function create()
    {
        return view('usuarios.create', ['pagina' => 'usuarios']);
    }

    public function insert(Request $form)
    {
        $usuario = new Usuario();

        $usuario->name = $form->name;
        $usuario->email = $form->email;
        $usuario->username = $form->username;
        $usuario->password = Hash::make($form->password);

        $usuario->save();

        event(new Registered($usuario));
        
        Auth::login($usuario);

        return redirect()->route('verification.notice');
    }
    // Ações de login
    public function login(Request $form)
    {
        // Está enviando o formulário
        if ($form->isMethod('POST')) {

            $credenciais = $form->validate([
                'username' => ['required'],
                'password' => ['required'],
            ]);


            if (Auth::attempt($credenciais,$form->remember_me)) {

                session()->regenerate();
                return redirect()->route('home');
                
            } else {

                // Login deu errado (usuário ou senha inválidos)
                return redirect()->route('login')->with('erro','Usuário ou senha inválidos.');

            }
        }

        return view('usuarios.login');
    }

    public function profile(){
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
