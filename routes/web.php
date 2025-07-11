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
use App\Http\Controllers\RequeteController;
use App\Http\Controllers\ForumReponseController;
use App\Http\Controllers\FormateurController;
 use App\Http\Controllers\RequeteFormateurController;
 use App\Http\Controllers\QuestionController;

 use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\AdminController; // Assure-toi d'utiliser le bon contrôleur
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProgressionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserTestController;
use App\Http\Controllers\ControllerCertification;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;


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



Route::post('/desactive/formateur', [App\Http\Controllers\AdminController::class, 'destroy']);
Route::post('/active/formateur', [App\Http\Controllers\AdminController::class, 'restore']);

Route::post('/desactive', [App\Http\Controllers\AdminController::class, 'destroy']);
Route::post('/active', [App\Http\Controllers\AdminController::class, 'restore']);

//front

Route::post('/', [PartnerRequestController::class, 'store']); // La route POST doit être définie en premier
Route::get('/',  [HomeController::class, 'index'])->name('home'); // À commenter ou supprimer

/* Route::get('/', function () {
    $latestFormations = \App\Models\Formation::orderBy('created_at', 'desc')->take(8)->get();
    return view('front.index', compact('latestFormations'));
}); */
Route::get('/', function () {
    $latestFormations = \App\Models\Formation::where('status', '!=', 'Archiver')->orderBy('created_at', 'desc')->take(8)->get();
    $teachers = \App\Models\User::where('role_id', 2)->get();
    return view('front.index', compact('latestFormations', 'teachers'));
})->name('home');
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

// Pour l'inscription à une formation
Route::post('/apprenant/inscription', [App\Http\Controllers\UserFormationController::class, 'store'])->name('apprenant.inscription');


/** Chapitre */
Route::post('/note-du-chapitre', [ResumeController::class, 'update'], );
Route::match(['get', 'post'],'/chapitre/{slug}', [ResumeController::class, 'chapitre']);

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
Route::get('/profile', [App\Http\Controllers\UserController::class, 'index'])->name('profile.success');

 Route::get('/formateur/profil', [UserController::class, 'showFormateurProfile'])->name('formateur.profile');
/*  Route::post('/formateur/update-profile', [UserController::class, 'updateFormateur'])->middleware('auth')->name('update.formateur.profile');
 */


 Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/formateur/requetes', [RequeteController::class, 'indexFormateur'])->name('formateur.requetes.index');
    Route::post('/formateur/reponse', [RequeteController::class, 'storeReponse'])->name('formateur.reponse.store');
    Route::get('/requete/{slug}', [RequeteController::class, 'show'])->name('requete.show');
    Route::post('/forum-response', [RequeteController::class, 'storeOrUpdateResponse'])->name('reponse.storeOrUpdate');
    Route::put('/reponse/{id}', [RequeteController::class, 'updateReponse'])->name('reponse.update');
    Route::delete('/reponse/{id}', [RequeteController::class, 'deleteReponse'])->name('reponse.delete');
    Route::get('/formateur/apprenants', [FormateurController::class, 'apprenants'])->name('formateur.apprenants');
});
Route::post('/formateur/update-profile', [UserController::class, 'updateFormateur'])->middleware('auth')->name('formateur.update-profile');




    Route::get('/stats/views', [FormateurController::class, 'statsViews'])->name('formateur.stats.views');
    Route::post('/stats/views/delete', [FormateurController::class, 'deleteViews'])->name('formateur.stats.views.delete');
    Route::get('/stats/learners', [FormateurController::class, 'statsLearners'])->name('formateur.stats.learners');
    Route::post('/stats/learners/delete', [FormateurController::class, 'deleteLearners'])->name('formateur.stats.learners.delete');
    Route::get('/stats/questions', [FormateurController::class, 'statsQuestions'])->name('formateur.stats.questions');
    Route::post('/stats/questions/delete', [FormateurController::class, 'deleteQuestions'])->name('formateur.stats.questions.delete');
    

   

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/formateur/messages', [RequeteFormateurController::class, 'index'])->name('formateur.messages.index');
    Route::get('/formateur/messages/create', [RequeteFormateurController::class, 'create'])->name('formateur.messages.create');
    Route::post('/formateur/messages', [RequeteFormateurController::class, 'store'])->name('formateur.messages.store');
    Route::get('/formateur/message/{slug}', [RequeteFormateurController::class, 'show'])->name('formateur.messages.show');
    Route::delete('/formateur/messages', [RequeteFormateurController::class, 'destroy'])->name('formateur.messages.destroy');
    Route::post('/formateur/messages/response', [RequeteFormateurController::class, 'storeOrUpdateResponse'])->name('formateur.messages.storeOrUpdateResponse');
    Route::delete('/formateur/messages/reponse/{id}', [RequeteFormateurController::class, 'deleteReponse'])->name('message.reponse.delete');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/questions', [QuestionController::class, 'index'])->name('formateur.questions.index');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('formateur.questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('formateur.questions.store');
    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('formateur.questions.edit');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('formateur.questions.update');
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('formateur.questions.destroy');
});

//pour archiver et restaurer page formateur
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('users');

    Route::get('/formateurs', [AdminController::class, 'index'])->name('formateurs.index');
    Route::post('/formateurs', [AdminController::class, 'store'])->name('formateurs.store')->middleware('auth');   
    Route::post('/formateurs/destroy', [AdminController::class, 'destroy'])->name('formateurs.destroy');
    Route::post('/formateurs/restore', [AdminController::class, 'restore'])->name('formateurs.restore');
    Route::post('/users', [AdminController::class, 'store'])->name('users.store');
});




// Routes pour les utilisateurs
Route::get('/users', [AdminController::class, 'users']);
 Route::post('/desactive/formateur', [AdminController::class, 'destroy']);
Route::post('/active/formateur', [AdminController::class, 'restore']); 

// Routes pour les catégories
Route::get('/admin/categories/creer', function () {
    $categories = App\Models\Category::all(); 
    return view('Admin.category', compact('categories')); 
})->name('admin.categories.creer');
Route::post('/admin/categories/store', [CategorieController::class, 'categorieCreer'])->name('admin.categories.store');
Route::get('/categorie', [CategorieController::class, 'categories'])->name('admin.categories')->middleware(['web', 'auth']);
Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('admin.categories.update')->middleware(['web', 'auth']);
Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('admin.categories.destroy')->middleware(['web','auth']);
Route::get('/admin/categories/{id}', [CategorieController::class, 'show'])->name('admin.categories.show');



// Routes pour la réinitialisation de mot de passe
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');



//Etre partenaire page d'acceil
Route::post('/', [PartnerRequestController::class, 'store']); 
Route::post('/partner-requests', [PartnerRequestController::class, 'store'])->name('partner-requests.store');


//Route utiliser lorsque c'est l'admin qui crée un formateur
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/partner-requests', [PartnerRequestController::class, 'index'])->name('admin.partner-requests.index');
    Route::get('/partner-requests/{id}', [PartnerRequestController::class, 'show'])->name('admin.partner-requests.show');
    Route::post('/partner-requests/{id}/approve', [PartnerRequestController::class, 'approve'])->name('admin.partner-requests.approve');
    Route::post('/partner-requests/{id}/reject', [PartnerRequestController::class, 'reject'])->name('admin.partner-requests.reject');
    Route::get('/notification', [PartnerRequestController::class, 'allRequests'])->name('admin.notifications');
    Route::get('/formations/categorie-selection', [FormationController::class, 'showCategories'])->name('formations.categorieSelection');

});

//Ce que j'ai ajoutée dans le controlleur formation
Route::post('formation/destroy', [FormationController::class, 'destroy'])->name('formation.destroy');
Route::post('formation/archive', [FormationController::class, 'archive'])->name('formation.archive');
Route::post('formation/unarchive', [FormationController::class, 'unarchive'])->name('formation.unarchive');
//pour le TB
Route::get('/formations/categorie/{id}', [FormationController::class, 'formationsParCategorie'])->name('formations.parCategorie');




//Route pour les message formateur et admin
Route::get('/message', [RequeteController::class, 'adminMessages'])->name('admin.messages');
Route::get('/admin/request/{slug}', [App\Http\Controllers\RequeteController::class, 'adminShow'])->name('admin.request.show');
Route::post('/admin/request/{id}/reponse', [RequeteController::class, 'storeReponse'])->name('admin.reponse.store');//ajouter nouvellement

//Pour les formateurs archiver et restaurer
Route::post('/users/{id}/archive', [UserController::class, 'archive'])->name('users.archive');
Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
//Pour les apprenants active et desactive
Route::post('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
Route::post('/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
//page apprenant
Route::post('/activate', [UserController::class, 'activate'])->name('user.activate');
Route::post('/deactivate', [UserController::class, 'deactivate'])->name('user.deactivate');

// Authentification
Auth::routes();
/* Route::get('/home', [App\Http\Controllers\UserFormationController::class, 'index'])->name('home');
 */
// Route pour la connexion
Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('/students/data', [UserController::class, 'getStudents'])->name('admin.students.data');
Route::get('/users/datatables', [UserController::class, 'getUsers'])->name('users.datatables');// Route pour récupérer les utilisateurs via AJAX
Route::get('/users/data', [AdminController::class, 'getUsers'])->name('admin.users.data');
Route::get('/admin/students', [AdminController::class, 'getStudents'])->name('admin.students');
Route::post('/apprenant', [UserController::class, 'store'])->name('admin.apprenant.store');
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/questions', [QuestionController::class, 'index'])->name('formateur.questions.index');
    Route::get('/questions/{formation}', [QuestionController::class, 'show'])->name('formateur.questions.show');
    Route::get('/questions/{formation}/create', [QuestionController::class, 'create'])->name('formateur.questions.create');
    Route::post('/questions/{formation}', [QuestionController::class, 'store'])->name('formateur.questions.store');
    Route::get('/questions/{formation}/{question}/edit', [QuestionController::class, 'edit'])->name('formateur.questions.edit');
    Route::put('/questions/{formation}/{question}', [QuestionController::class, 'update'])->name('formateur.questions.update');
    Route::delete('/questions/{formation}/{question}', [QuestionController::class, 'destroy'])->name('formateur.questions.destroy');
});
Route::get('/get-progression', [ProgressionController::class, 'getProgression'])->name('get.progression');
Route::post('/progression-chapitre', [ProgressionController::class, 'updateProgression'])->name('update.progression');

//CE QUE JE VIENS DE FAIRE POUR LES FORMATEURS ET ADMIN
//Route pour les message formateur et admin

Route::get('/message', [RequeteFormateurController::class, 'adminIndex'])->name('admin.messages');
Route::get('/admin/request/{slug}', [RequeteFormateurController::class, 'adminShow'])->name('admin.request.show');
Route::post('/admin/request/{id}/reponse', [RequeteFormateurController::class, 'adminStoreOrUpdateResponse'])->name('admin.reponse.store');
Route::delete('/admin/reponse/{id}', [RequeteFormateurController::class, 'adminDeleteReponse'])->name('admin.reponse.delete');
Route::post('/admin/reponse/update/{id}', [RequeteFormateurController::class, 'updateResponse'])->name('admin.reponse.update');

Route::post('/update-progression', [UserFormationController::class, 'updateProgression'])->name('update.progression');

Route::post('/formation/{formation}/test', [TestController::class, 'submit'])->name('formation.test.submit');

Route::get('/formation/{formation}/test', [TestController::class, 'show'])->name('formation.test');

Route::post('/store-test-result', [UserTestController::class, 'store'])->middleware('auth');

//Ce que je viens d'ajouter
// Cette route doit être EN DEHORS du groupe 'auth'
Route::get('/certification/{certificate_id}', [ControllerCertification::class, 'show'])
    ->name('certification.view')
    ->middleware('signed');

// La génération du certificat peut rester protégée
Route::middleware('auth')->group(function () {
    Route::post('/certification/generate/{formation}', [ControllerCertification::class, 'store'])->name('certification.generate');
});

Route::get('/certification/verify', [ControllerCertification::class, 'verify'])->name('certification.verify');

Route::get('/get-chapitre-note', [ResumeController::class, 'getChapitreNote']);

Route::get('/ajax/formations-by-category/{id}', [App\Http\Controllers\FormationController::class, 'ajaxByCategory']);

//POUR LES PAIEMENT
  Route::prefix('payment')->group(function () {
    Route::post('initialize', [PaymentController::class, 'initialize']);
    Route::post('callback', [PaymentController::class, 'callback']);
    Route::get('return', [PaymentController::class, 'return']);
});

Route::middleware(['auth'])->group(function () {
  
    // Routes pour le paiement
    Route::post('/payment/initialize', [PaymentController::class, 'initialize'])->name('payment.initialize');
    Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    Route::get('/payment/return', [PaymentController::class, 'return'])->name('payment.return');
    Route::post('/paiement/kkiapay/callback', [PaymentController::class, 'handleKkiaPayCallback'])->name('paiement.kkiapay.callback');
    Route::get('/payment/verifying', [PaymentController::class, 'showVerificationPage'])->name('payment.verifying');
});

Route::post('/paiement/kkiapay/callback', [PaymentController::class, 'handleKkiaPayCallback'])->name('paiement.kkiapay.callback');
Route::post('/paiement/fedapay/callback', [PaymentController::class, 'handleFedaPayCallback'])->name('paiement.fedapay.callback');
Route::get('/payment/verifying', [PaymentController::class, 'showVerificationPage'])->name('payment.verifying');

Route::get('/formateur/apprenants/{id}/formations', [FormateurController::class, 'apprenantFormations'])->name('formateur.apprenant.formations');


