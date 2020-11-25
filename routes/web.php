<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('welcome');
});

*/

Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('admin', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');

Route::post('admin', [App\Http\Controllers\Admin\LoginController::class, 'login']);

Route::get('admin/home', [App\Http\Controllers\Admin\AdminController::class, 'index']);


Route::get('/nouvel utilisateur', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('creeruser');

Route::resource('Textes/categorieslois', App\Http\Controllers\Textes\CategoriesLoisController::class);
Route::resource('Textes/lois', App\Http\Controllers\Textes\LoisController::class);

Route::resource('Auth', App\Http\Controllers\Auth\ListeUtilisateursController::class);

Route::resource('Processus/typesprocessus', App\Http\Controllers\Processus\TypesProcessusController::class);

Route::resource('Processus/processus', App\Http\Controllers\Processus\ProcessusController::class);

Route::resource('Fonctions/fonctions', App\Http\Controllers\Fonctions\FonctionsController::class);

Route::resource('Indicateurs/indicateurs', App\Http\Controllers\Indicateurs\IndicateursController::class);

Route::resource('Planactions/planactions', App\Http\Controllers\Planactions\PlanactionsController::class);

Route::resource('TypeMoyen/typemoyen', App\Http\Controllers\TypeMoyen\TypeMoyenController::class);

Route::resource('Taches/taches', App\Http\Controllers\Taches\TachesController::class);

Route::resource('IndicateursParProcessus/indicateursparprocessus', App\Http\Controllers\IndicateursParProcessus\IndicateursParProcessusController::class);

Route::resource('Processus/sousprocessus', App\Http\Controllers\Processus\SousProcessusController::class);

Route::resource('PartiesInteressees/niveauimportance', App\Http\Controllers\PartiesInteressees\NiveauImportanceController::class);
Route::resource('PartiesInteressees/niveaurelation', App\Http\Controllers\PartiesInteressees\NiveauRelationController::class);
Route::resource('PartiesInteressees/cotation', App\Http\Controllers\PartiesInteressees\CotationController::class);
Route::resource('PartiesInteressees/partiesinteressees', App\Http\Controllers\PartiesInteressees\PartiesInteresseesController::class);

Route::resource('AnalysesRisques/probabilite', App\Http\Controllers\AnalysesRisques\ProbabiliteController::class);
Route::resource('AnalysesRisques/gravite', App\Http\Controllers\AnalysesRisques\GraviteController::class);
Route::resource('AnalysesRisques/detection', App\Http\Controllers\AnalysesRisques\DetectionController::class);
Route::resource('AnalysesRisques/criticite', App\Http\Controllers\AnalysesRisques\CriticiteController::class);
Route::resource('AnalysesRisques/analyserisques', App\Http\Controllers\AnalysesRisques\AnalyseRisquesController::class);

Route::resource('Societe/societe', App\Http\Controllers\Societe\SocieteController::class);

Route::resource('Messages/messages', App\Http\Controllers\Messages\MessagesController::class);
