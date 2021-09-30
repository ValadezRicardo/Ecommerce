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




Route::get('error',function(){
    abort('404');
});

Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('login', 'Auth\LoginController@showLoginForm')->middleware('guest');
Route::post('login','Auth\LoginController@login')->name('login');

Route::get('registro', 'RegistroController@index')->name('registro');
Route::post('registro', 'RegistroController@store')->name('registro.store');


Route::get('/','ClienteController@index')->name('inicio');
Route::get('panel/paginas/inicio','InicioController@index')->name('admin.inicio');
Route::patch('panel/paginas/inicio','InicioController@guardar')->name('admin.inicio.store');

Route::get('contacto','ContactoController@contacto')->name('index.contacto');
Route::post('contacto','ContactoController@send_contacto')->name('send_contacto.contacto');

Route::get('menu/{menu}','ClienteController@menu_single')->name('menu_single');
Route::get('ordenar-online','ClienteController@ordenar_online')->name('ordenar_online');
Route::get('ordenar-online/{idalimento}','ClienteController@add_cart')->name('add_cart');


Route::get('faq','ClienteController@faq')->name('faq');

Route::get('cuenta/historial','ClienteController@ordenes')->name('ordenes');
Route::get('cuenta/hoy','ClienteController@hoy')->name('hoy');
Route::get('ofertas','ClienteController@ofertas')->name('ofertas');

Route::get('cuenta/carrito','ClienteController@open_carrito')->name('open_carrito');
Route::delete('cuenta/carrito/{id}','ClienteController@destroy_carrito')->name('destroy_carrito');
Route::get('cuenta/pedido/{nombre}/{productos}/{iduser}/{direccion}/{telefono}/{correo}/{de}/{para}/{fecha}/{horario}/{mensaje}/{total}/{token}/{codigoCupon}/{metodo}','ClienteController@generar_pedido')->name('generar_pedido');
Route::get('carrito','CarritoController@index')->name('carrito');

Route::get('panel/mensajes','MensajeController@index')->name('index.mensaje');
Route::delete('panel/mensajes/{id}','MensajeController@destroy')->name('destroy.mensaje');

Route::get('panel/configuraciones/general','ConfigController@index')->name('admin.general');
Route::patch('panel/configuraciones/general','ConfigController@guardar')->name('admin.general.store');
Route::get('panel/configuraciones/validateCode/{codigoCupon}','ClienteController@validateCode')->name('admin.general.validateCode');

Route::get('panel/data/productos','ProductoController@index')->name('admin.producto');
Route::get('panel/data/productos/registrar','ProductoController@create')->name('registrar.producto');
Route::post('panel/data/productos/registrar','ProductoController@store')->name('store.producto');

Route::get('panel/data/producto/{id}','ProductoController@edit')->name('edit.producto');
Route::patch('panel/data/producto/{id}','ProductoController@update')->name('update.producto');
Route::patch('panel/data/producto/estado/{id}','ProductoController@estado')->name('estado.producto');
Route::delete('panel/data/producto/{id}','ProductoController@eliminar')->name('eliminar.producto');
Route::patch('panel/data/producto/oferta/{id}','ProductoController@oferta')->name('oferta.producto');
Route::get('panel/data/productos/ofertas','ProductoController@index_oferta')->name('index_oferta.producto');
Route::patch('panel/data/productos/ofertas_portada/{id}','ProductoController@update_portada')->name('update_portada.producto');

Route::get('panel/configuraciones/menu','MenuController@index')->name('index.menu');
Route::get('panel/configuraciones/menu/create','MenuController@create')->name('create.menu');
Route::post('panel/configuraciones/menu/registrar','MenuController@store')->name('store.menu');
Route::get('panel/configuraciones/menu/{id}','MenuController@edit')->name('edit.menu');
Route::patch('panel/configuraciones/menu/{id}','MenuController@update')->name('update.menu');
Route::delete('panel/configuraciones/menu/{id}','MenuController@destroy')->name('destroy.menu');

Route::get('panel/configuraciones/seccion_uno','SeccionUnoController@index')->name('index.seccion_uno');
Route::get('panel/configuraciones/seccion_uno/{id}','SeccionUnoController@edit')->name('edit.seccion_uno');
Route::patch('panel/configuraciones/seccion_uno/{id}','SeccionUnoController@update')->name('update.seccion_uno');

Route::get('panel/configuraciones/seccion_tres','SeccionTresController@index')->name('index.seccion_tres');
Route::get('panel/configuraciones/seccion_tres/{id}','SeccionTresController@edit')->name('edit.seccion_tres');
Route::patch('panel/configuraciones/seccion_tres/{id}','SeccionTresController@update')->name('update.seccion_tres');

Route::get('panel/configuraciones/faq','FaqController@index')->name('index.faq');
Route::get('panel/configuraciones/faq/registrar','FaqController@create')->name('create.faq');
Route::post('panel/configuraciones/faq/registrar','FaqController@store')->name('store.faq');
Route::get('panel/configuraciones/faq/{id}','FaqController@edit')->name('edit.faq');

Route::get('panel/ventas/pedidos','VentasController@index')->name('index.ventas');
Route::get('panel/ventas/pedidos/{id}','VentasController@detalle')->name('detalle.ventas');
Route::patch('panel/ventas/pedidos/{id}','VentasController@estado')->name('estado.ventas');

Route::get('panel/configuraciones/galeria','GaleriaController@index')->name('index.galeria');
Route::post('panel/configuraciones/galeria','GaleriaController@store')->name('store.galeria');
Route::delete('panel/configuraciones/galeria/{id}','GaleriaController@eliminar')->name('eliminar.galeria');

Route::get('panel/configuraciones/slider','SliderController@index')->name('index.slider');
Route::get('panel/configuraciones/slider/crear','SliderController@create')->name('create.slider');
Route::post('panel/configuraciones/slider/crear','SliderController@store')->name('store.slider');
Route::get('panel/configuraciones/slider/{id}','SliderController@edit')->name('edit.slider');
Route::patch('panel/configuraciones/slider/{id}','SliderController@update')->name('update.slider');
Route::delete('panel/configuraciones/slider/{id}','SliderController@destroy')->name('destroy.slider');

Route::get('panel/navegacion','NavController@index')->name('index.nav');
Route::get('panel/navegacion/crear','NavController@create')->name('create.nav');
Route::post('panel/navegacion/crear','NavController@store')->name('store.nav');
Route::get('panel/navegacion/{id}','NavController@edit')->name('edit.nav');
Route::patch('panel/navegacion/{id}','NavController@update')->name('update.nav');
Route::delete('panel/navegacion/{id}','NavController@destroy')->name('destroy.nav');

Route::get('panel/usuario','UsuarioController@index')->name('index.usuario');
Route::get('panel/usuario/crear','UsuarioController@create')->name('create.usuario');
Route::post('panel/usuario/crear','UsuarioController@store')->name('store.usuario');
Route::get('panel/usuario/{id}','UsuarioController@edit')->name('edit.usuario');
Route::patch('panel/usuario/{id}','UsuarioController@update')->name('update.usuario');
Route::delete('panel/usuario/{id}','UsuarioController@destroy')->name('destroy.usuario');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');