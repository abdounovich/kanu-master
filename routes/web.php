<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request; 

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






Route::get('/add','AppointmentController@AddPFunction');

Auth::routes();
Route::match(['get', 'post'], '/botman', 'BotManController@handle');

Route::get('/botman/tinker', 'BotManController@tinker');
Route::get('/rdv','AppointmentController@index')->middleware('auth');
Route::get('/client/{slug}','ClientController@index');
Route::get('/clients','ClientController@show')->middleware('auth');
Route::post('/client/edit/{id}','ClientController@update')->name("client.editpoints");

Route::get('/delete','AppointmentController@deleteFunction')->middleware('auth');
Route::post('/addAppoint','AppointmentController@store');

Route::post('/types','TypeController@store')
->middleware('auth');
Route::get('/types','TypeController@index')
->middleware('auth');
Route::get('/test/{type}/D1/{username}/{Cid}','testController@today')
;
Route::get('/test/{type}/D2/{username}/{Cid}','testController@tomorrow')
;
Route::get('/test/{type}/D3/{username}/{Cid}','testController@afterTomorrow')
;
Route::get('/settings','SettingController@index')
->middleware('auth');
Route::post('/settings','SettingController@store')
->middleware('auth');
Route::post('/settings/{id}','SettingController@update')
->middleware('auth');




Route::post('/test2','testController@sendTextMessage')
;

Route::get('/tester','testController@func')
;

Route::get('/delete/{id}','TypeController@supprimer')
->middleware('auth');
Route::get('/edit/{id}','TypeController@edit')
->middleware('auth');
Route::post('/types_edit/{id}','TypeController@update')
->middleware('auth');
Route::get('/actif/{id}/{num}','AppointmentController@actif')
;
Route::post('/annuler','AppointmentController@Annuler')
;
Route::get('/annulerByAdmin/{id}','AppointmentController@AnnulerByAdmin')
;


Route::get('/','HomeController@index')
->middleware('auth');

Route::get('/commande', function () {
    return view('commande') ;
});




Route::post('/parametres/update/', function (Request $request) {
    $anglais = ['Saturday' ,'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];  
 
    for ($i = 0; $i < 7; $i++){
    $debut=$request->get($anglais[$i].'-debut');
       
    $fin=$request->get($anglais[$i]."-fin"); 
     

   $debut_repos=$request->get($anglais[$i]."-debut-repos"); 
      

     $fin_repos=$request->get($anglais[$i]."-fin-repos"); 
     

     $active=$request->get($anglais[$i]."-active"); 
       


 

    Setting::set($anglais[$i], [
        'debut'=>$debut,
        'fin'=> $fin,
        'active' => $active,
        'debut-repos' => $debut_repos,
        'fin-repos' =>$fin_repos
            ]);
        }
        return back()->with("success"," لقد تم حفظ البيانات بنجاح");
    });

Route::get('/l', function () {
    
    Setting::set('Saturday', [
        'debut'=> '08:00',
        'fin'=> '21:00',
        'active' => '1',
        'debut-repos' => '12:00',
        'fin-repos' => '13:00',
        ]);
    Setting::set('Sunday', [
        'debut'=> '08:00',
        'fin'=> '21:00',
        'active' => '1',
        'debut-repos' => '12:00',
        'fin-repos' => '13:00',
         ]);

    Setting::set('Monday', [
        'debut'=> '08:00',
        'fin'=> '21:00',
        'active' => '1',
        'debut-repos' => '12:00',
        'fin-repos' => '13:00',
         ]);
    Setting::set('Tuesday', [
        'debut'=> '08:00',
        'fin'=> '21:00',
        'active' => '0',
        'debut-repos' => '12:00',
        'fin-repos' => '13:00',
        ]);
    Setting::set('Wednesday', [
            'debut'=> '08:00',
            'fin'=> '21:00',
            'active' => '1',
            'debut-repos' => '12:00',
            'fin-repos' => '13:00',
            ]);
     Setting::set('Thursday', [
            'debut'=> '08:00',
            'fin'=> '21:00',
            'active' => '1',
            'debut-repos' => '12:00',
            'fin-repos' => '13:00',
            ]);
    Setting::set('Friday', [
            'debut'=> '08:00',
            'fin'=> '21:00',
            'active' => '1',
            'debut-repos' => '12:00',
            'fin-repos' => '13:00',
                ]);
    


        
echo "ok";
return;
    
});

Route::get('/abcd','TestController@try');
Route::post('/sendMsg/{id}','ClientController@sendMessageToClient');
Route::get('/sendMsg/{id}','ClientController@sendMessageToClientView');

Route::post('/parametres/{id}','SettingController@update');






Route::get('/home', 'HomeController@index')->name('home');


