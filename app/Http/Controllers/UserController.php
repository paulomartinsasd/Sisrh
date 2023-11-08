<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /* Verificar se o Usuário está logado no sistema */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /* Verifica se o usuário é admin através do GATE */
        if(Gate::allows('tipo-user')){
            $users = User::where('name', 'like','%'.$request->busca.'%')->orderBy('name', 'asc')->paginate(10);

            $totalUsers = User::all()->count();

            return view('users.index', compact('users', 'totalUsers'));
        }else{
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::allows('tipo-user')){
            return view('users.create');
        }else{
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Gate::allows('tipo-user')){
            $input = $request->all();
            User::create($input);

            return redirect()->route('users.index')->with('sucesso','Usuário cadastrado com sucesso');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return back();
        }

        if(auth()->user()->id == $user['id'] || auth()->user()->type == 'admin') {
            return view('users.edit', compact('user'));
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();

        $user = User::find($id);


        if($request->password){
            $input['password'] = bcrypt($input['password']);
        } else {
            $input['password'] = $user['password'];
        }



        if($user->tipo == "admin"){
            return redirect()->route('users.index')->with('sucesso','Usuário alterado com sucesso!');
        } else{
            return redirect()->route('users.edit', $user->id)->with('sucesso','Usuário alterado com sucesso!');
        }
        $user->fill($input);
        $user->save();


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
