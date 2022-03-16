<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $agent;

    public function __construct(AgentController $agent) {
        $this->agent = $agent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('users.UserList');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.user_ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'phone' => 'required|max:12',
            'email' => 'email|required|unique:users',
            'adresse' => 'required|string',
            'activite' => 'required',
            'access' => 'required',
        ]);

        $userId = User::insertGetId([
            'name' => $request->nom,
            'email' => $request->email,
            'access' => $request->access,
            'province' => $request->province,
            'password' => bcrypt($request->password),
        ]);

        if($userId) {

            $this->agent->store($request,$userId);

            return redirect('/agents')->withSuccess('Utilisateur crée avec succès');
        }

        return redirect()->back()->withInput()->withError('une erreur s\'est produite');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($user)
    {
        $user = User::find($user);
        $user->state = ($user->state == 'active') ? 'blocked' : 'active';
        $user->save();
        return redirect()->back()->withSuccess('l\'action a été effecutée avec succès');
    }

    public function form_update_info()
    {
        $user = User::select('users.name','users.email','agents.phone','agents.adresse',
            'agents.activite')
            ->join('agents', 'agents.users_id', 'users.id')
            ->where('users.id', auth()->user()->id)
            ->first();

        return view('profil_update', compact('user'));
    }

    public function update_info(Request $request)
    {
        // return $request->all();
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => "required|email|unique:users,email,$request->users_id",
            'adresse' => 'required',
            'activite' => 'required',
            'users_id' => 'required',
        ]);

        $user = User::find($request->users_id);

        if($user) {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $agent = $this->agent->update($request, $user->id);
            
            if ($agent) {
                return redirect('/profil')->withSuccess('Profil mis a jour avec succès');
            }
        }

        return redirect()->back()->withInput()->withError('une erreur s\'est produite');

    }
}
