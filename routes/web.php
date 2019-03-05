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

Route::get('/', 'FrontController@index');


Route::get('/admin', 'DashboardController@index');
Route::get('/admin/users', 'UsersController@listUsers');
Route::get('/admin/enterprises', 'EnterpriseController@listEnterprises');
Route::get('/admin/offers', 'JobOfferController@listOffers');
Route::get('/admin/newsletters', 'NewsletterController@listNewsletters');
Route::get('/admin/studies/{id}/specialties', 'StudyController@specialties');
Route::get('/admin/province/{id}/concellos', 'ProvinceController@concellos');
/*Route::get('/', function () {
    return redirect()->route('panel/index');
});*/
Route::group(['prefix' => 'panel'/*,  'middleware' => 'auth'*/], function() {

    Route::post('/admin/cursos/busquedaAvanzada', 'CursoController@index');
    Route::get('/admin/cursos/{curso_id}/inscripcion', 'CursoController@inscripcion');
    Route::post('/admin/cursos/{curso_id}/inscribirme', 'CursoController@inscribirme');
    Route::resource('admin', 'DashboardController');
    Route::resource('cursos', 'CursoController');
    Route::resource('empresas', 'EnterpriseController');
    Route::resource('boletin-ofertas', 'NewsletterController');
    Route::get('/admin/empresas/{id}/remove', 'EnterpriseController@remove');
    Route::get('/admin/boletin-ofertas/{id}/remove', 'NewsletterController@remove');
    Route::get('/admin/ofertas/{id}/remove', 'JobOfferController@remove');
    Route::get('/admin/contratos/{id}/remove', 'ContractController@remove');
    Route::get('/admin/noticias/{id}/remove', 'NoticiaController@remove');
    Route::get('/admin/estudios/{id}/remove', 'EstudioController@remove');
    Route::get('/admin/especialidades/{id}/remove', 'SpecialtyController@remove');
    Route::get('/admin/permisos-conducir/{id}/remove', 'DrivingPermitController@remove');
    Route::get('/admin/usuarios/{id}/remove', 'UsersController@remove');
    Route::resource('sectores', 'SectorController');
    Route::resource('puestos', 'PuestoController');
    Route::resource('contratos', 'ContractController');
    Route::resource('noticias', 'NoticiaController');
    Route::resource('estudios', 'EstudioController');
    Route::resource('especialidades', 'SpecialtyController');
    Route::resource('permisos-conducir', 'DrivingPermitController');
    Route::resource('ofertas', 'JobOfferController');
    Route::resource('usuarios', 'UsersController');
    //Route::get('/admin', 'HomeController@index')->name('admin');

});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
