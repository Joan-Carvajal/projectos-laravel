<?php

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
use App\Post;
Route::get('/eloquent', function () {
$posts = Post::where('id', '>=', '20')->orderby('id','desc')->get();
foreach($posts as $post){
    echo "$post->id $post->title <br>";
}
});

Route::get('/post', function () {
  $posts= Post::get();
    foreach($posts as $post){
        echo "$post->id 
       <strong> {$post->user->name} </strong>
        $post->get_title <br>";
    }
    });
    use App\User;
    Route::get('/users', function () {
  $users= User::get();
    foreach($users as $user){
        echo "$user->id 
       <strong> $user->ger_name </strong>
        {$user->posts->count()} <br>";
    }
    });

Route::get('collections', function () {
    $users = User::get();

    //dd($users);
    //dd($users->contains('4'));
    //dd($users->except([1,2,3]));
    //dd($users->only(4));
    //dd($users->find(4)); //Busca solamente el id 4
    dd($users->load('posts'));//Cargar la relación con post definida en el modelo
});

Route::get('serialization', function () {
    $users = User::all();

    /* 
        toArray()->Get the collection of items as a plain array.
        toJson()->Convert the model instance to JSON.
    */

    // dd($users->toArray());
    $user = $users->find(1);
    // dd($user);
    dd($user->toJson());
});