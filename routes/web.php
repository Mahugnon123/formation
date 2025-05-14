<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PlanifierController;
use \App\Http\Controllers\ResumeController;
use \App\Http\Controllers\UserFormationController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ControllerFormation;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AvisController;


use App\Models\Formation;
use App\Http\Controllers\PartnerRequestController; // Assurez-vous d'importer votre contrôleur


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

//admin

// Les routes d'authentification de Laravel
Auth::routes(); // Cela inclut les routes pour login, register, reset password, etc.


Route::get('/admin', function () {
    return view('Admin.use');
});
Route::get('login', function () {
    return view('auth.login');
});
Route::get('/categories', function () {
    return view('Admin.category');
});
Route::post('/formateur/create', [App\Http\Controllers\AdminController::class, 'store']);
Route::post('/formation-status', [App\Http\Controllers\AdminController::class, 'status']);
Route::post('/creer-categorie', [App\Http\Controllers\AdminController::class, 'categorieCreate']);
Route::post('/modifier-categorie', [App\Http\Controllers\AdminController::class, 'categorieModifier']);
Route::get('/delete-categorie/{slug}', [App\Http\Controllers\AdminController::class, 'categorieDelete']);
Route::get('/categorie', [App\Http\Controllers\AdminController::class, 'categories']);


Route::get('/users', [App\Http\Controllers\AdminController::class, 'users']);

Route::post('/desactive/formateur', [App\Http\Controllers\AdminController::class, 'destroy']);
Route::post('/active/formateur', [App\Http\Controllers\AdminController::class, 'restore']);

Route::post('/desactive', [App\Http\Controllers\AdminController::class, 'destroy']);
Route::post('/active', [App\Http\Controllers\AdminController::class, 'restore']);

//front

Route::post('/', [PartnerRequestController::class, 'store']); // La route POST doit être définie en premier
Route::get('/',  [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    $latestFormations = \App\Models\Formation::orderBy('created_at', 'desc')->take(8)->get();
    return view('front.index', compact('latestFormations'));
});
Route::get('/about', function () {
    return view('front.about');
});
Route::get('/blog', function () {
    return view('front.blog');
});
Route::get('/blog-single', function () {
    return view('front.blog-single');
});
Route::get('/event-single', function () {
    return view('front.event-single');
});

Route::get('/events', function () {
    return view('front.events');
});
Route::get('/contact', function () {
    return view('front.contact');
});
Route::get('/course-single/{slug}', [App\Http\Controllers\FormationController::class, 'show'], );

Route::get('/courses', [FormationController::class, 'index'])->name('courses.index');

Route::get('/courses/category/{slug}', [FormationController::class, 'showCategory'])->name('courses.category');

Route::get('/notice', function () {
    return view('front.notice');
});
Route::get('/notice-single', function () {
    return view('front.notice-single');
});
Route::get('/research', function () {
    return view('front.research');
});
Route::get('/scholarship', function () {
    return view('front.scholarship');
});
Route::get('/teacher', function () {
    return view('front.teacher');
});
Route::get('/teacher-single', function () {
    return view('front.teacher-single');
});

Route::post('/contact', [ContactController::class, 'handleContactForm'])->name('contact.store');


Route::get('/calender', [PlanifierController::class, 'index']);
Route::post('/calender/action', [PlanifierController::class, 'action']);


Route::get('/planifier', function () {
    return view('Apprenant.register');
}); 

//apprenant
Route::get('/voire', function () {
    return view('Apprenant.voire');
});
/**Forum prives */ 
Route::get('/apprenant-forum', [App\Http\Controllers\RequeteController::class, 'index']);
Route::post('/apprenant-requete', [App\Http\Controllers\RequeteController::class, 'store']);
Route::post('/requete', [App\Http\Controllers\RequeteController::class, 'destroy']);
Route::get('/requete/{slug}', [App\Http\Controllers\RequeteController::class, 'show']);
Route::post('/forum-response', [App\Http\Controllers\ForumReponseController::class, 'store']);
Route::post('/update-profile', [App\Http\Controllers\UserController::class, 'update']);
Route::get('/profile', [App\Http\Controllers\UserController::class, 'index']);
Route::post('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update.password');
Route::post('/update-email', [App\Http\Controllers\UserController::class,'updateEmail'])->name('update.email');
Route::get('/delete-compte', [App\Http\Controllers\UserController::class, 'delete']);

Route::post('/submit-avis', [AvisController::class, 'store'])->name('avis.store');



Route::get('/apprenant-suivi', [App\Http\Controllers\UserFormationController::class, 'suivis']);
Route::post('/progression-chapitre', [App\Http\Controllers\UserFormationController::class, 'progress']);

Route::get('/apprenant-formation', [App\Http\Controllers\UserFormationController::class, 'formation']);
Route::get('/apprenant-suivi/{slug}', [App\Http\Controllers\UserFormationController::class, 'chapitre']);
Route::post('/suivi', [App\Http\Controllers\UserFormationController::class, 'chapitre_detail']);

Route::post('/apprenant', [App\Http\Controllers\UserFormationController::class, 'store']);


/** Chapitre */
Route::post('/note-du-chapitre', [ResumeController::class, 'update'], );
Route::match(['get', 'post'],'/chapitre/{slug}', [ResumeController::class, 'chapitre'], );

/*Route::get('/chapitre', [ResumeController::class, 'chapitre'], );*/
Route::post('/save-chapitre', [ResumeController::class, 'store'], );

/** */

Route::get('/apprenant-resume', [ResumeController::class, 'index'], );
Route::match(['delete', 'post'],'/apprenant-resume', [ResumeController::class, 'supChapitre'], );
/*Route::get('/show-user', [UserController::class, 'index'], );
Route::post('/show-user', [UserController::class, 'update'], );*/
//Route::get('/apprenant-forum', [RequeteController::class, 'index'], );

///



// ----------------------------- Formateur --------------------------------------//
Route::resource('/formations', App\Http\Controllers\ControllerFormation::class);
Route::get('/course-detail/{slug}', [ControllerFormation::class, 'course_detail'], );
Route::get('/apprenant-course-detail/{slug}', [App\Http\Controllers\FormationController::class, 'show'], );

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'index'])->name('profile.success');

 Route::get('/formateur/profil', [UserController::class, 'showFormateurProfile'])->name('formateur.profile');

