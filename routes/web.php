<?php

use GuzzleHttp\Middleware;
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

//1 - Rota padrão do barramento de teste2.com.br

Route::get('/', function () {
    return view('welcome');
});

// pegando dentro de uma pasta

Route::get('/outro', function () {
    return view('site.andre');
});


// retornando texto

Route::get('/contato', function () {
    return 'Contato';
});

Route::get('/empresa', function () {
    return 'empresa';
});  

// route com passagem de variavel
Route::get('/categorias/{flag}', function ($prm) {
    return "Produtos da Categoria: {$prm}";
});

//route com passagem de variavel e complemento // tem que ser com o mesmo nome de variavel

Route::get('/categoria/{flag}/posts', function ($flag) {
    return "Posts da Categoria: {$flag}";
});    

// com parametros não obrigatórios

Route::get('/produtos/{idproduto?}', function ($idproduto = '') {
    return "Produto(s) : {$idproduto}";
}); 

// redirecionamento de rotas 1/2 - dois links comuns

Route::get('redirect1', function () {
    return "redirect1";
});

Route::get('redirect2', function () {
    return "redirect2";
}); 

/// redirecionamento de rota 2/2 - o tratamento.

 Route::get('redirect1', function () {
     return redirect ('/redirect2');
 });

// outra forma de fazer o redirect:

Route::get('redirect3', function () {
    return "redirect3";
});
    
Route::get('redirect4', function () {
    return "redirect4";
}); 

Route::redirect('/redirect3', '/redirect4');

// rotas nomeadas - ->name

Route::get('redirect5', function () {
    return redirect()->route('url.name');
}); 

Route::get('/nome-url', function() {
    return 'teste de nomeação de rota';
})->name('url.name');

// Funcionou perfeitamente

// Grupos de rotas no laravel
//-> middleware('auth'); está pronto -  redireciona para /login
// -> prefix('prefixo')
// Grupos de rotas no laravel

Route::get('/login', function() {
    return 'Login';
})->name('login');

//'auth'
Route::middleware([])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('/dashboard', function (){
            return 'Home Admin';
        });
        
        Route::get('/financeiro', function (){
            return 'Financeiro Admin';
        });
        
        Route::get('/produtos', function (){
            return 'Produtos Admin';
        });
        
        Route::get('/', function (){
            return 'Admin';
        });

    });
});

/// teste de controller....retirado o argumento de middleware para testar
/*
Route::middleware([])->group(function(){
    Route::prefix('painel')->group(function(){
        Route::namespace('App\Http\Controllers\Admin')->group(function(){
            route::name('admin.')->group(function(){

                Route::get('/dashboard', 'TesteController@teste')->name('dashboards');
               
                Route::get('/financeiro', 'TesteController@teste')->name('financeiros');
                
                Route::get('/produtos', 'TesteController@teste')->name('produto');
                
                Route::get('/', function(){
                    return redirect()->route('admin.dashboards');
                })->name('home');
            });
        }); 
    });
});

*/

Route::group([
    'Middleware' => [],
    'prefix' => 'painel',
    'namespace' => 'App\Http\Controllers\Admin',
    'name' => 'admin.'
], function() {
        Route::get('/dashboard', 'TesteController@teste')->name('dashboards');
        Route::get('/financeiro', 'TesteController@teste')->name('financeiros');
        Route::get('/produtos', 'TesteController@teste')->name('produto');
        Route::get('/', function(){
            return redirect()->route('admin.dashboards');
        })->name('home');
    });

    // Route::get('redirect5', function () {
    //     return redirect()->route('url.name');
    // }); 











