<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FullCalenderController;
/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/userinfo', function () {
    return view('userinfo');
})->middleware(['auth'])->name('userinfo');

Route::middleware(['auth:sanctum', 'verified'])->get('/aggiorna', function () {
    return view('aggiorna');
})->middleware(['auth'])->name('aggiorna');


Route::middleware(['auth:sanctum', 'verified'])->get('/aggiornalab', function () {
    return view('aggiornalab');
})->middleware(['auth'])->name('aggiornalab');


Route::middleware(['auth:sanctum', 'verified'])->get('/aggiornadoc', function () {
    return view('aggiornadoc');
})->middleware(['auth'])->name('aggiornadoc');


Route::middleware(['auth:sanctum', 'verified'])->get('/dbdoc', function () {
    return view('dbdoc');
})->middleware(['auth'])->name('dbdoc');

Route::middleware(['auth:sanctum', 'verified'])->get('/dbdoclab', function () {
    return view('dbdoclab');
})->middleware(['auth'])->name('dbdoclab');

Route::middleware(['auth:sanctum', 'verified'])->get('/newdoc', function () {
    return view('newdoc');
})->middleware(['auth'])->name('newdoc');

Route::middleware(['auth:sanctum', 'verified'])->get('/dbstudio', function () {
    return view('dbstudio');
})->middleware(['auth'])->name('dbstudio');

Route::middleware(['auth:sanctum', 'verified'])->get('/ricerca', function () {
    return view('ricerca');
})->middleware(['auth'])->name('ricerca');

Route::middleware(['auth:sanctum', 'verified'])->get('/agenda', function () {
    return view('agenda');
})->middleware(['auth'])->name('agenda');

Route::middleware(['auth:sanctum', 'verified'])->get('/doc', function () {
    return view('doc');
})->middleware(['auth'])->name('doc');

Route::middleware(['auth:sanctum', 'verified'])->get('/send', function () {
    return view('send');
})->middleware(['auth'])->name('send');





Route::middleware('auth:sanctum')->get('/chat/rooms', [ChatController::class , 'rooms']);
Route::middleware('auth:sanctum')->get('/chat/room/{roomId}/messages', [ChatController::class , 'messages']);
Route::middleware('auth:sanctum')->post('/chat/room/{roomId}/message', [ChatController::class , 'newMessage']);



Route::middleware(['auth:sanctum', 'verified'])->post('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('full-calender', [FullCalenderController::class , 'index']);

Route::post('full-calender/action', [FullCalenderController::class , 'action']);

Route::get('send-mail', 'MailSend@mailsend');

Route::get('mysitemap', function(){

    // create new sitemap object
    $sitemap = App::make("sitemap");

    // add items to the sitemap (url, date, priority, freq)
    $sitemap->add(URL::to(), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
    $sitemap->add(URL::to('page'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

    // get all posts from db
    $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();

    // add every post to the sitemap
    foreach ($posts as $post)
    {
        $sitemap->add($post->slug, $post->modified, $post->priority, $post->freq);
    }

    // generate your sitemap (format, filename)
    $sitemap->store('xml', 'mysitemap');
    // this will generate file mysitemap.xml to your public folder

});