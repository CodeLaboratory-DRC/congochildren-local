<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\YoungController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MiniereController;
use App\Http\Controllers\AgricoleController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\LocaliteController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MiningZoneController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\AgrobusinessController;
use App\Http\Controllers\EnqueteController;
use App\Http\Controllers\OuvrageCommunautaireController;
use App\Http\Controllers\ScolariteController;
use App\Http\Controllers\DownloadController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', [AuthController::class, 'register']); //to remove
Route::get('/province/{province}', [DashboardController::class, 'countProvince']); //to remove


Route::post('login', [AuthController::class, 'login'])->name('login.post');

Route::get('children/{id}/page', [PrintController::class, 'page'])->name('children.page');


Route::middleware('auth')->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('profil', [AuthController::class, 'getUser'])->name('profil');

    Route::get('password_change/{destination?}', [AuthController::class, 'form_update_password'])->name('password');
    Route::post('password_change/{url?}', [AuthController::class, 'update_password'])->name('password.store');

    Route::get('update-profil', [UserController::class, 'form_update_info'])->name('profil.update');
    Route::post('update-profil', [UserController::class, 'update_info'])->name('profil.store');

    Route::get('/', [DashboardController::class, 'home'])->name('home');
    Route::get('home', [DashboardController::class, 'home']);


    Route::get('province/{name}', [ProvinceController::class, 'index'])->name('province.index');


    Route::get('user', [UserController::class, 'create'])->name('user');
    Route::post('user', [UserController::class, 'store'])->name('user.post');
    Route::get('users/{id}/state', [UserController::class, 'update'])->name('agent.state');

    Route::get('agents', [AgentController::class, 'index'])->name('agent.list');

    Route::get('agent/{id}/detail', [AgentController::class, 'show'])->name('agent.show');

    // Route::get('agent/{id}/update', [AgentController::class, 'update'])->name('agent.update');

    Route::get('agent/{id}/delete', [AgentController::class, 'destroy'])->name('agent.destroy');


    Route::get('children', [ChildrenController::class, 'index'])->name('children.list');
    Route::get('children/{id}/fiche', [ChildrenController::class, 'show'])->name('children.show');
    Route::get('children/{id}/delete', [ChildrenController::class, 'destroy'])->name('children.delete');
    Route::get('children/recycle', [ChildrenController::class, 'bin'])->name('children.bin');
    Route::get('children/{id}/restore', [ChildrenController::class, 'restore'])->name('children.restore');
    Route::get('children/{id}/remove', [ChildrenController::class, 'destroyDef'])->name('children.remove');
    Route::get('children/{id}/update', [ChildrenController::class, 'edit'])->name('children.edit');
    Route::post('children/{id}/update', [ChildrenController::class, 'update'])->name('children.update');


    Route::get('young', [YoungController::class, 'index'])->name('young.list');
    Route::get('young/{id}/fiche', [YoungController::class, 'show'])->name('young.show');
    Route::get('young/{id}/delete', [YoungController::class, 'destroy'])->name('young.delete');
    Route::get('young/recycle', [YoungController::class, 'bin'])->name('young.bin');
    Route::get('young/{id}/restore', [YoungController::class, 'restore'])->name('young.restore');
    Route::get('young/{id}/remove', [YoungController::class, 'destroyDef'])->name('young.remove');
    Route::get('young/{id}/update', [YoungController::class, 'edit'])->name('young.edit');
    Route::post('young/{id}/update', [YoungController::class, 'update'])->name('young.update');

    Route::get('family/{id}/update', [FamilyController::class, 'edit'])->name('family.edit');
    Route::post('family/{id}/update', [FamilyController::class, 'update'])->name('family.update');


    Route::get('scolarite/{id}/update', [ScolariteController::class, 'edit'])->name('scolarite.edit');
    Route::post('scolarite/{id}/update', [ScolariteController::class, 'update'])->name('scolarite.update');

    Route::get('enquete/{id}/update', [EnqueteController::class, 'edit'])->name('enquete.edit');
    Route::post('enquete/{id}/update', [EnqueteController::class, 'update'])->name('enquete.update');


    Route::get('localite', [LocaliteController::class, 'index'])->name('localite.list');
    Route::get('sites', [SiteController::class, 'index'])->name('site.list');

    Route::get('localite/{id}', [MiningZoneController::class, 'index'])->name('mining.list');

    Route::get('fournisseur/{type}', [FournisseurController::class, 'index'])->name('fournisseur.list');
    Route::get('fournisseur/{id}/delete', [FournisseurController::class, 'destroy'])->name('fournisseur.delete');
    Route::get('fournisseur/recycle/{type}', [FournisseurController::class, 'bin'])->name('fournisseur.bin');
    Route::get('fournisseur/{id}/restore', [FournisseurController::class, 'restore'])->name('fournisseur.restore');
    Route::get('fournisseur/{id}/remove', [FournisseurController::class, 'destroyDef'])->name('fournisseur.remove');
    Route::get('fournisseur/{id}/update', [FournisseurController::class, 'edit'])->name('fournisseur.edit');
    Route::post('fournisseur/{id}/update', [FournisseurController::class, 'update'])->name('fournisseur.update');

    // Route::get('mining', [MiningZoneController::class, 'index'])->name('mining.list');
    Route::get('site/{id}', [MiningZoneController::class, 'show'])->name('mining.show');


    Route::get('mine', [MiniereController::class, 'index'])->name('mine.list');
    Route::get('mine/{id}/fiche', [MiniereController::class, 'show'])->name('mines.show');
    Route::get('mine/{id}/delete', [MiniereController::class, 'destroy'])->name('mine.delete');
    Route::get('mines/recycle', [MiniereController::class, 'bin'])->name('mine.bin');
    Route::get('mine/{id}/restore', [MiniereController::class, 'restore'])->name('mine.restore');
    Route::get('mine/{id}/remove', [MiniereController::class, 'destroyDef'])->name('mine.remove');
    Route::get('mine/{id}/update', [MiniereController::class, 'edit'])->name('mine.edit');
    Route::post('mine/{id}/update', [MiniereController::class, 'update'])->name('mine.update');


    Route::get('agricole', [AgricoleController::class, 'index'])->name('agricole.list');
    Route::get('agricole/{id}/fiche', [AgricoleController::class, 'show'])->name('agricole.show');
    Route::get('agricole/{id}/delete', [AgricoleController::class, 'destroy'])->name('agricole.delete');
    Route::get('agricole/recycle', [AgricoleController::class, 'bin'])->name('agricole.bin');
    Route::get('agricole/{id}/restore', [AgricoleController::class, 'restore'])->name('agricole.restore');
    Route::get('agricole/{id}/remove', [AgricoleController::class, 'destroyDef'])->name('agricole.remove');
    Route::get('agricole/{id}/update', [AgricoleController::class, 'edit'])->name('agricole.edit');
    Route::post('agricole/{id}/update', [AgricoleController::class, 'update'])->name('agricole.update');


    Route::get('recherche', [SearchController::class, 'index'])->name('recherche');
    Route::get('search', [SearchController::class, 'search'])->name('search');

    Route::get('children/{id}/print', [PrintController::class, 'cardPrint'])->name('children.print');


    Route::get('younger/{id}/print', [PrintController::class, 'cardPrint'])->name('children.print');

    Route::get('localiteprint', [PrintController::class, 'localitePrint'])->name('localite.print');

    Route::get('site-print/{localite}', [PrintController::class, 'sitePrint'])->name('site.print');

    Route::get('childrenprint', [PrintController::class, 'childrenPrint'])->name('children.print');

    Route::get('youngerprint', [PrintController::class, 'youngPrint'])->name('younger.print');

    Route::get('mineprint', [PrintController::class, 'minePrint'])->name('mine.print');

    Route::get('agricoleprint', [PrintController::class, 'agroPrint'])->name('agricole.print');

    Route::get('menageprint', [PrintController::class, 'menagePrint'])->name('menage.print');

    Route::get('enfant/jeune/print', [PrintController::class, 'enfantYoungPrint'])->name('enfantYoung.print');

    Route::get('fournisseurprint/{type}', [PrintController::class, 'fournisseurPrint'])->name('fournisseur.print');

    // menages
    Route::get('menages', [FamilyController::class, 'index'])->name('menage.list');
    Route::get('menages/{id}', [FamilyController::class, 'show'])->name('menage.show');

    //export
    Route::get('site/export/{localite}', [SiteController::class, 'export'])->name('site.export');

    Route::get('child/export', [ChildrenController::class, 'export'])->name('child.export');
    Route::get('child/site/{id}/export', [ChildrenController::class, 'exportBySite'])->name('child.site.export');

    Route::get('younger/export', [YoungController::class, 'export'])->name('younger.export');

    Route::get('agricole/export', [AgricoleController::class, 'export'])->name('agricole.export');

    Route::get('mine/export', [MiniereController::class, 'export'])->name('mine.export');

    Route::get('localite/export', [LocaliteController::class, 'export'])->name('localite.export');

    Route::get('menage/export', [FamilyController::class, 'export'])->name('menage.export');

    Route::get('fournisseur/export/{type}', [FournisseurController::class, 'export'])->name('fournisseur.export');


    Route::get('card/localite/{localite}/part/{part}/download', [DownloadController::class, 'exportCardByLocalite'])->name('card.downpart');
});
