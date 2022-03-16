<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function form_login()
    {
        return view('login');
    }

    public function register()
    {
        $request = [
            'name' => 'vander otis',
            'email' => 'info@vanotis720.tech',
            'access' => 'adminCentral',
            'password' => bcrypt(1234),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $userId = User::insertGetId($request);

        $agent = new AgentController();
        if ($userId) {

            if (Agent::create([
                'nom' => 'vander otis',
                'email' => 'info@vanotis720.tech',
                'phone' => '243974944879',
                'users_id' => $userId,
                'adresse' => 'lubumbashi',
                'created_at' => date('Y-m-d H:i:s'),
            ])) {
                return redirect('/login');
            } 
            else {
                return redirect(
                    route('register')
                )->with('error', 'Erreur lors de la création de l\'agent');
            }
        }

        return redirect()->back()->with(
            'error',
            'User not created'
        );
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $remember = $request->has('remember') ? true : false;
        $credential = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credential, $remember)) {

            $request->session()->regenerate();
            return $this->verifyAuthorization();
        }

        return redirect()->back()->withInput($request->only('email'))->withError('Les informations d\'identification fournies ne correspondent pas à nos enregistrements.');
    }

    public function getUser()
    {
        $user = Agent::select(
            'agents.nom',
            'agents.phone',
            'agents.email',
            'agents.adresse',
            'agents.activite',
            'users.province'
        )->join('users', 'users.id', 'agents.users_id')
        ->where('users_id', auth()
        ->user()->id)
        ->first();
        return view('profil', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->withSuccess('Deconnection reussi! A la prochaine!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function form_update_password($destination = null)
    {
        return view('auth.password_update', compact('destination'));
    }

    public function update_password(Request $request, $url = 'profil')
    {
        $validatedData = $request->validate([
            'password' => 'required|confirmed'
        ]);

        try {
            $user = User::findOrFail(auth()->user()->id);
            $user->password = Hash::make($validatedData['password']);
            $user->isFirstTime = false;
            $user->update();

            return redirect($url)->withAlert('Votre mot de passe a été changé avec succès');
        } catch (\Throwable $th) {
            return redirect()->back()->withAlert('une erreur s\'est produite');
        }
    }

    protected function verifyAuthorization()
    {
        if (auth()->user()->state != 'active') {
            Auth::logout();
            return redirect('/login')->withMsg('Vous compte a été bloqué par votre administrateur');
        }
        if (auth()->user()->access == 'agentTerrain' || auth()->user()->access == 'adminLocal' ) {
            Auth::logout();
            return redirect('/login')->withMsg('Vous n\'avez pas l\'acces necessaire pour acceder a cette ressource');
        }

        return $this->verifyFirstLogin();
    }

    public function verifyFirstLogin()
    {
        if (auth()->user()->isFirstTime) {
            return redirect()->route('password', ['destination' => 'home'])->withMsg('Vous devez mettre a jour votre mot de passe');
        }
        return redirect('/');
    }
}
