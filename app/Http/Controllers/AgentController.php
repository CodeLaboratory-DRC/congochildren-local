<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::select('users.id', 'users.access', 'users.state', 'agents.nom', 'agents.phone', 'agents.email', 'agents.adresse', 'agents.activite')
            ->join('users', 'users.id', 'agents.users_id')
            ->get();
        return view('users.UserList', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $users_id)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'phone' => 'required|unique:agents',
            'email' => 'email|required|unique:agents',
            'adresse' => 'required|string',
            'activite' => 'required',
        ]);

        $validated['users_id'] = $users_id;

        return Agent::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($agent)
    {
        $agent = Agent::select('users.id', 'users.access', 'users.state', 'agents.nom', 'agents.phone', 'agents.email', 'agents.adresse', 'agents.activite')
            ->join('users', 'users.id', 'agents.users_id')
            ->where('agents.id', $agent)
            ->first();

        return view('users.user_detail', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $users_id)
    {
        $agent = Agent::where('users_id', $users_id)->first();

        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => "required|unique:agents,phone,$agent->id",
            'email' => 'required|email',
            'adresse' => 'required|string',
            'activite' => 'required',
        ]);


        if ($agent) {
            return $agent->update([
                'nom' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'adresse' => $request->adresse,
                'activite' => $request->activite
            ]);
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($agent)
    {
        $agent = Agent::findOrFail($agent);
        $agent->delete();
        return redirect('UserList')->with('alert', 'l\'utilisateur a été supprimé');
    }
}
