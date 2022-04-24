 <?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeriodoAcademicoController;
use App\Http\Controllers\GraficoController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\Das001Controller;
use App\Http\Controllers\EncuestaAsignaturaController;
use App\Http\Controllers\ContenidoEncuestaController;
use App\Http\Controllers\RespuestaController;
use App\Http\Controllers\Asignatura;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraficoAyudanteController;
use App\Http\Controllers\Encuesta;
use App\Http\Controllers\AyudanteController;

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

//AL INICIAR NUESTRA PÁGINA WEB PODREMOS ACCEDER A ESTA VISTA, POR LA CUAL PODREMOS NAVEGAR ENTRE ELLA



Route::get('/', function () {
  return view('bienvenido');
});

Route::get('graficoayudante',[GraficoAyudanteController::class, 'index']);

Route::get('seleccionarAsignatura',[AyudanteController::class, 'seleccion']);

Route::get('verPreguntasDas/{nrc}/desplegar',[Das001Controller::class, 'DesplegarPreguntas'])->name('Das4');
Route::get('verGrafico/{nrc}/desplegar',[Das001Controller::class, 'cargarGrafico'])->name('Das4_grafico');


Route::get('ayudante/{id}/AsignaturasDas', [Das001Controller::class , 'seleccionDas'])->name('Das5');//ya se usa
Route::get('ayudante/{id}/Preguntas', [Das001Controller::class , 'DesplegarPreguntasAyudantes'])->name('DAS5');
Route::get('graficoDas/{id}/{nrc}',[Das001Controller::class, 'cargarGraficoAyudantes'])->name('yapo');
Route::get('consolidado/{id}',[Das001Controller::class, 'cargarPeriodos'])->name('mostrarPeriodos');
Route::get('consolidado/{id}/periodo', [Das001Controller::class, 'cargarEncuestas'])->name('mostrarEncuestas');
Route::get('consolidado/{id}/preguntas', [Das001Controller::class, 'cargarPreguntas'])->name('cargarPreguntas');
Route::get('consolidado/{id}/graficas', [Das001Controller::class, 'ConsolidadoGrafica'] )->name('consolidadoGrafico');

Route::resource('responder', RespuestaController::class)->except(['store']);  
Route::post('/responder/{id}/store}', [RespuestaController::class, 'store'])->name('responder.store');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::middleware(['auth'])->group(function() {

    //Rutas para ser accedidas por usuarios REGISTRADOS
    Route::get('/administrador', [AdminController::class, 'index'])->name('admin_index');
    Route::get('/alumno', [AlumnoController::class, 'index'])->name('alumno_index');
    Route::get('/docente', [ProfesorController::class, 'index'])->name('docente_index');


    //cambiar Clave (necesito que el usuario esté logueado) ACCESO PARA TODOS LOS USUARIOS MENOS ADMIN
    Route::get('/cambiarC',[UserController::class,'cambiarPass'])->name('cambioClave');
    Route::patch('/cambiarPass',[UserController::class, 'cambiarP'])->name('cambiarP');

});


//GRUPO DE ACCESO PARA EL ADMIN
Route::group(['middleware' => 'admin'], function(){

    //CRUD USUARIO
    //Route::get('/reseteo', [App\Http\Controllers\UserController::class,'reseteo')];
    Route::patch('/usuario/{id}/password-reset', [UserController::class, 'reseteo'])->name('restablecercontrasenia');
    Route::resource('usuario', UserController::class);
    //VISTA ADMIN
    Route::get('Admin-home', function () {
    return view('usuario.Administrador-home');
    });

});

//GRUPO DE ACCESO PARA EL ALUMNO
Route::group(['middleware' => 'alumno'], function(){

    //VISTA ALUMNO
    Route::get('encuesta', function () {
    return view('asignatura.Encuesta');
    });

    //VISTA ALUMNO
    Route::get('Alumno-home', function () {
    return view('usuario.Alumno-home');
    });


    
});

//OBTENEMOS LA VISTA Grafico A TRAVES DEL INDEX
Route::get('graficos', [GraficoController::class, 'index'])->name('tamoslocos');

//GRUPO DE ACCESO PARA EL DOCENTE
Route::group(['middleware' => 'docente'], function(){

    //VISTA DOCENTE
    Route::get('edit', function () {
    return view('asignatura.form');
    });

    //CARGA MASIVA ASIGNATURA FALTA PONERLO EN VISTA DE DOCENTE
    Route::get('import-asignatura',[App\Http\Controllers\AsignaturaController::class,'importForm']);
    Route::post('import-asignatura',[App\Http\Controllers\AsignaturaController::class,'import'])->name('asignatura.import');

    //CARGA MASIVA ALUMNO FALTA PONERLO EN VISTA DE DOCENTE
    Route::get('import-alumno',[App\Http\Controllers\AlumnoController::class,'importForm']);
    Route::post('import-alumno',[App\Http\Controllers\AlumnoController::class,'import'])->name('alumno.import');
    Route::get('import-alumno',[App\Http\Controllers\AlumnoController::class,'desplegarAlumnos']);




    //CARGA MASIVA AYUDANTE FALTA PONERLO EN VISTA DE DOCENTE
    Route::get('import-ayudante',[App\Http\Controllers\AyudanteController::class,'importForm']);
    Route::post('import-ayudante',[App\Http\Controllers\AyudanteController::class,'import'])->name('ayudante.import');
    Route::get('import-ayudante',[App\Http\Controllers\AyudanteController::class,'desplegarAyudantes']);

    //CARGA MASIVA CONTENEDOR ASIGNATURA FALTA PONERLO EN VISTA DE DOCENTE
    Route::get('import-contenedor-asignatura',[App\Http\Controllers\Contenedor_AsignaturaController::class,'importForm']);
    Route::post('import-contenedor-asignatura',[App\Http\Controllers\Contenedor_AsignaturaController::class,'import'])->name('Contenedor_Asignatura.import');
    Route::get('import-contenedor-asignatura',[App\Http\Controllers\Contenedor_AsignaturaController::class,'desplegarContenedorAsignaturas']);

    //ABRIR VISTA DOCENTE
    Route::get('docente-home',[App\Http\Controllers\ProfesorController::class,'vistaDocente']);

    //CRUD ASIGNATURA VISTA DOCENTE
   
    Route::resource('asignatura', AsignaturaController::class);

    //CRUD PERIODO ACADEMICO VISTA DOCENTE
    Route::resource('periodo', PeriodoAcademicoController::class);
    Route::get('/per/deshabilitar',[PeriodoAcademicoController::class, 'deshab'])->name('deshabilitar');

    //crear encuesta
    Route::get('encuesta/crear', [EncuestaController::class, 'index'])->name('encuestacrear');
    Route::post('encuesta/crear', [EncuestaController::class, 'store'])->name('agregarEncuesta');
    Route::delete('encuesta/{id_encuesta}/eliminar',[EncuestaController::class, 'destroy'])->name('eliminarEncuesta');

    //asociar encuesta
    Route::get('encuesta/asociar', [EncuestaAsignaturaController::class, 'index'])->name('encuestasociar');
    Route::post('encuesta/asociar', [EncuestaAsignaturaController::class, 'store'])->name('guardarasociacion');


    //contenido encuestas
    Route::resource('/preguntas', ContenidoEncuestaController::class, ['names' => [
        'index' => 'PreguntasMalvadas',
        'edit' => 'verPreguntas'
    ]]);
    
});



//GRUPO DE ACCESO PARA EL AYUDANTE
Route::group(['middleware' => 'ayudante'], function(){


    //VISTA AYUDANTE
    Route::get('Ayudante-home', function () {
        return view('usuario.ayudante-home');
    });

    Route::get('ayudante/{id}/detalles', [GraficoAyudanteController::class , 'DesplegarPreguntas'])->name('Desplegar');

    Route::get('grafico/{id}/cargar',[GraficoAyudanteController::class, 'cargarGrafico'])->name('cargar');
    
});