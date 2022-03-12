<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
Auth::routes();

Route::get('/sss',function(){
  return view('layouts.validadorTarjeta');
});

Route::get('/ingreso-alternativo', 'PaginasController@ingresoAlternativo');

//REDIRRIGE AL INICIO DE CADA TIPO DE USER

Route::post('/tienda/contacto/{course?}', 'TiendaController@cargarDato')->name('Tienda.contacto');

Route::get('/add-course/{Course}', 'PaginasController@addCourse')->name('addCourse');

Route::match(['get', 'post'],'/inscripcion', 'PaginasController@inscripcionTemprana')->name('inscripcionTemprana');
Route::get('/inscripcion/cursos', 'PaginasController@coursesView')->name('Intro.Cursos');
Route::post('/cargarDatosAltaTemprana', 'PaginasController@cargarUser')->name('cargarInscripcionTemprana');

Route::get('/selectCountry', 'PaginasController@preIntro')->name('PreIntro');
Route::get('/intro/{country?}', 'PaginasController@intro')->name('intro');

Route::get('/show-course/{Course}/{origin?}', 'PaginasController@showCourse')->name('Intro.ShowCourse');

Route::get('/','PaginasController@index')->middleware('redireccion');
Route::view('login', 'PaginasController@index')->middleware('redireccion');

Route::get('/back-mp/{id}/{precio?}', 'PaymentController@backMp');

Route::middleware('rol')->group(function(){

  //SUPERVISOR
  Route::middleware('supervisor')->group(function(){

    Route::get('/buscador', 'AdminController@verBuscador')->name('Admin.Buscador');

        /** */
        Route::get('/mostrarAlumno/{data}/{searchDatosUser}', 'UserController@mostrarAlumno');
        Route::get('/verAlumnos','UserController@index')->name('User.index');
        Route::get('/modificarAlumno','UserController@modificarAlumno')->name('User.modificarAlumno');
        Route::get('/modificar-hab/{id}', 'UserController@modificarHab');
        Route::get('ver-no-hab', 'UserController@verNoHabilitados')->name('VerNoHabilitados');
        Route::post('habilitar-unity', 'UserController@habilitarUnidad')->name('habilitarUnidad');
        Route::post('/Course/setType/{course}/{user_id}', 'CourseController@setType')->name('Course.setType');

        Route::get('/agregarAlumno','CourseController@agregarAlumno')->name('Curso.agregarAlumno');

        Route::get('modificar-alta-venta', 'VentaController@modificarAlta')->name('Venta.modificarAlta');
        Route::post('/modificar-estado-venta', 'VentaController@modificarEstado')->name('Venta.modificarEstado');
  });


  //ADMIN****************************************************************
  Route::middleware('admin')->group(function(){

    Route::resource('VideosYT', 'VideosYTController');
    Route::resource('Objetivo', 'ObjetivoController');
    Route::resource('Cupon', 'CuponController');
    Route::resource('Cuenta', 'CuentaController');
    
    Route::resource('Tip', 'TipController');
    

    /**Foro routes */
    Route::get('/Foro/ver-no-hab', 'ForoController@verNoHab')->name('Foro.verNoHab');
    Route::get('/Post/mod-hab/{Post}', 'PostController@modHab')->name('Post.modHab');
    Route::get('/Post/{Post}/delete', 'PostController@delete')->name('Post.delete');
    /**PerfilVendedora routes */
    Route::get('/show-vendedora/{id}/{mes?}', 'VendedorController@index')->name('Vendedor.perfil');
    /**Problems routes */
    Route::resource('Problem', 'ProblemController');
    Route::get('/Problem/{id}/delete', 'ProblemController@destroy')->name('Problem.eliminar');
    Route::post('/Problem/{id}/update', 'ProblemController@update')->name('Problem.actualizar');
    Route::get('/Problem/{Problem}/show-steps', 'ProblemController@showSteps')->name('Problem.showSteps');
    Route::get('/Problem/{Step}/destroy', 'ProblemController@destroyStep')->name('Problem.destroyStep');
    Route::post('/Problem/{Problem}/add-step', 'ProblemController@addStep')->name('Problem.addStep');
    Route::get('/Problem/{Step}/show-step', 'ProblemController@showSteptoEdit')->name('Problem.showSteptoEdit');
    Route::post('/Problem/{Step}/edit-step', 'ProblemController@editStep')->name('Problem.editStep');
    Route::post('/Problem/{Step}/add-img-to-step', 'ProblemController@addImgtoStep')->name('Problem.addImgtoStep');
    Route::get('/Problem/{ImgStep}/delete-img-step', 'ProblemController@deleteImgStep')->name('Problem.deleteImgStep');
    
    /**Novedades routes */
    Route::post('/Novedad/{novedad}', 'NovedadController@update')->name('Novedad.actualizar');
    Route::get('/Novedad/{novedad}', 'NovedadController@destroy')->name('Novedad.eliminar');
    Route::get('/New-novedad', 'NovedadController@create')->name('Novedad.crear');
    
    /**CourseTest routes */
    Route::resource('CourseTest', 'CourseTestController');
    Route::get('/mod-course-test/{case}/{id}', 'CourseTestController@modificar')->name('CourseTest.modificar');
    Route::post('/editCantUnities/{id}', 'CourseTestController@editCantUnities')->name('CourseTest.editCantUnities');
    Route::post('/Curso/edit/{course}', 'CourseController@editar')->name('Curso.editar');

    /**AdminController routes */
    Route::resource('Admin', 'AdminController');
    Route::get('/ver-ventas-mes/{mes?}', 'AdminController@verVentasMes')->name('Admin.verVentasMes');
    Route::get('/ver-user-test', 'AdminController@verUserTest')->name('Admin.verUserTest');
    
   

    /**Tienda Routes */
    Route::get('/tienda-acceso-admin', 'TiendaController@accesoAdmin')->name('Tienda.admin');
    Route::resource('Categoria', 'CategoriaController');
    Route::get('/Categoria-delete/{categoria}', 'CategoriaController@delete')->name('Categoria.delete');
    Route::post('/Set-Cat-Course', 'CategoriaController@setCatCourse')->name('Categoria.setCatCourse');
    Route::get('/Delete-Cat-Course/{categoria}/{course}', 'CategoriaController@deleteCatCourse')->name('Categoria.deleteCatCourse');
    route::post('/Set-Order/{categoria}', 'CategoriaController@setOrder')->name('Categoria.setOrder');
    Route::post('/Set-Course-Info/{course}', 'TiendaController@setCourseInfo')->name('Tienda.setCourseInfo');

    /**Diplomas routes */
    Route::get('/send-diploma', 'AdminController@habilitarDiploma')->name('Admin.sendDiploma');
    Route::get('/delete-diploma/{Recibido}', 'AdminController@deleteDiploma')->name('Admin.deleteDiploma');


    
    /**Kits routes */
    Route::resource('Kit', 'KitController');
    Route::resource('KitType', 'KitTypeController');
    Route::get('/delete-kit-type/{KitType}', 'KitTypeController@destroy')->name('KitType.delete');
    Route::get('/mod-kit/{User}/{kit}', 'UserController@modificarKit')->name('User.modificarKit');
    Route::get('/ver-kits', 'KitController@showKits')->name('Kit.showAll');
    
    
    
    Route::get('/ver-vendedoras', 'AdminController@verVendedoras')->name('Admin.verVendedoras');
    Route::post('/datos-user/change-country/{user_id}', 'DatosUserController@changeCountry')->name('DatosUser.changeCountry');
    
    Route::get('/habiztar', 'EstadoController@habiztar')->name('Estado.habiztar');

    Route::post('Objetivo/update', 'ObjetivoController@update')->name('Objetivo.update');
    Route::get('Objetivo/custom/{custom}', 'ObjetivoController@deleteCustom')->name('Objetivo.deleteCustom');

    Route::get('modificar-hab-cupon/{id}', 'CuponController@modificarHab');
    Route::post('modificar-cupon', 'CuponController@update')->name('Cupon.ModificarCupon');
    Route::get('eliminar-cupon/{id}', 'CuponController@destroy');
    Route::get('ver-consultas', 'ConsultaController@index')->name('verConsultas');


    Route::get('/get-vendedoras/{mes?}', 'AdminController@getVendedoras');

    /**API cobranza routes */
    Route::get('/get-cobros-mes/{mes?}', 'CobranzaController@getCobrosMes');
    Route::get('/get-cobros-hechos/{mes?}', 'CobranzaController@getCobrosHechos');
    Route::get('/get-users-month/{mes?}', 'UserController@getUserMes');
    Route::get('/get-cuentas', 'CuentaController@getCuentas');
    Route::get('/get-user/{id}', 'UserController@getUser');

//**me lleve lo q estaba aca a supervisor */

    Route::get('/cargar-factura/{id}/{factura?}', 'CobranzaController@cargarFactura');
    Route::get('/modificar-fondos/{id}', 'CobranzaController@modificarFondos');
    Route::post('/edit-cobro', 'CobranzaController@editCobro');
    Route::get('/get-ventas-por-dia/{mes?}', 'CobranzaController@getVentasPorDia');
    Route::get('/download-cobros/{mes}', 'CobranzaController@downloadCobros');
    Route::any('/ventas-view', 'CobranzaController@verVentasRango')->name('Cobranza.verVentasRango');

    /**Adicionales routes */
    Route::post('/adicional/create', 'CobranzaController@adicionalCreate')->name('Adicional.store');
    Route::get('/adicional/delete/{Adicional}', 'CobranzaController@adicionalDelete')->name('Adicional.delete');

    Route::get('/ver-rotulo/{User}', 'AdminController@verRotulo')->name('User.verRotulo');
    Route::post('/cargar-productos/{User}', 'AdminController@cargarProductos')->name('User.cargarProductos');
    Route::post('/ver-comprobante/{User}', 'AdminController@verComprobante')->name('User.verComprobante');

    Route::get('/modificar-cobrable/{id}/{case?}', 'CobranzaController@modificarCobrable')->name('Cobranza.modificarCobrable');
    Route::get('/envio-cupon/{id}/{case}', 'CobranzaController@sendCuotaMail')->name('Cobranza.sendCuotaMail');

    Route::view('/form-envio-cadena', 'admin.form-cadena-mail')->name('Admin.CadenaMail');
    Route::post('/envio-cadena-mail', 'AdminController@envioCadenaMail')->name('Admin.envioCadena');

    Route::get('/tip-visible', 'TipController@modificarVisible')->name('Tip.visible');

    Route::get('/delete-resolucion', 'ScoreController@borrarResuelto')->name('Tpresuelto.borrarResuelto');
  });
//**************************************************************************

//**Supervisor ******************************************************************/
Route::middleware('supervisor')->group(function(){

  Route::get('cargar-vendedor', 'AdminController@cargarVendedor')->name('CargarVendedor');
  Route::get('/buscador', 'AdminController@verBuscador')->name('Admin.Buscador');

      /** */
      Route::get('/mostrarAlumno/{data}/{searchDatosUser}', 'UserController@mostrarAlumno');
      Route::get('/verAlumnos','UserController@index')->name('User.index');
      Route::get('/modificarAlumno','UserController@modificarAlumno')->name('User.modificarAlumno');
      Route::get('/modificar-hab/{id}', 'UserController@modificarHab');
      Route::get('ver-no-hab', 'UserController@verNoHabilitados')->name('VerNoHabilitados');
      Route::post('habilitar-unity', 'UserController@habilitarUnidad')->name('habilitarUnidad');
      Route::post('/Course/setType/{course}/{user_id}', 'CourseController@setType')->name('Course.setType');

      /**cobros */
      Route::get('/modificar-info-facturacion/{user_id}', 'CobranzaController@formModificarInfoFac')->name('Cobranza.formModificarInfoFac');
      Route::post('/Info-fac/update', 'CobranzaController@modificarInfoFac')->name('Cobranza.modificarInfoFac');
      Route::post('/cargar-cobro', 'CobranzaController@cargarCobro');
      Route::resource('Cobro', 'CobranzaController');

});

  //Alumno********************************************************************
  Route::middleware('alumno')->group(function(){

    Route::resource('Novedad', 'NovedadController');
    Route::resource('Post', 'PostController');
    
    Route::get('/VerCurso/{id}','CourseController@show')->name('Curso.show');
    Route::get('/baja','CourseController@baja')->name('Curso.baja');

    Route::get('/Unity/ver/{unity}', 'UnityController@showUser')->name('Unity.showUser');

    Route::post('/Cargar-Tp-Final', 'TpresueltoController@storeTpFinal')->name('cargarTpFinal') ;

    Route::get('/User/{id}/{case?}',[
          'as' => 'User.show',
          'uses' => 'UserController@show'
          ]);

    Route::post('/User/{user_id}',[
      'as' => 'User.update',
      'uses' => 'UserController@update'
    ]);

    Route::get('/Exam/index/{unity_id}/{user_id}',[
      'as' => 'Exam.index',
      'uses' => 'ExamController@index'
    ]);
    Route::get('/user', 'UserController@index')->name('user_perfil');

    Route::get('faq-view', function(){
      return view('alumno.faq-alumno');
    });
    Route::get('/TpVf-show/{id}/{data?}', 'TpVfController@show')->name('TpVf.showw');

    Route::get('/Kit/confirm/{id}', 'KitController@confirmData');
    Route::get('/Kit/received/{id}', 'KitController@kitReceived');

    Route::get('/select-courses', 'UserController@selectCourses')->name('User.selectCourses');

    Route::get('/informar-pago', 'UserController@informarPago')->name('User.informarPago');

    Route::post('load-consulta', 'ConsultaController@loadConsulta');
    Route::get('get-cursos-user', 'CourseController@getCursosUser');
    Route::get('/get-info-kit', 'KitController@getInfo');
    
    Route::post('/correction-tp-vf/{tp_id}', 'ScoreController@corregirTpVf')->name('Score.CorrectionTpVf');
    Route::get('/Problem/{Course}/show-problems', 'ProblemController@showProblemsCourse')->name('Problem.showProblems');
    Route::get('/Problem/{Problem}/show-problem', 'ProblemController@showProblemUser')->name('Problem.showProblemUser');
    Route::get('/see-diplom/received/{course_id}', 'UserController@sendDiploma');

    /**Practice routes */
    Route::get('/Practice/{Course}/show-practices', 'PracticeController@showPracticeCourse')->name('Practice.showPractices');
    Route::get('/Practice/{Practice}/show-practice', 'PracticeController@showPracticeUser')->name('Practice.showPracticeUser');
    Route::post('/Practice/{practice_id}/load-msj', 'ConversationController@loadMsj')->name('Conversation.loadMsj');

    /**Tienda routes */
    Route::get('/tienda-worknow/{catSeleccionada?}', 'TiendaController@accesoUser')->name('Tienda.user');
    Route::get('/tienda-confirm/{Carrito}', 'TiendaController@confirmCompra')->name('Tienda.confirmCompra');
    Route::get('/tienda-add-prod/{Product}', 'CarritoController@addProd')->name('Carrito.addProd');
    Route::get('/tienda-add-cant-prod/{ProdPedido}', 'CarritoController@addCant')->name('Carrito.addCant');
    Route::get('/tienda-desc-cant-prod/{ProdPedido}', 'CarritoController@descCant')->name('Carrito.descCant');
    Route::get('/get-info-tienda', 'TiendaController@getInfoTienda');
    Route::get('/Carrito/delete/{Carrito}', 'CarritoController@delete')->name('Carrito.delete');
    Route::get('/agregarAlumno','CourseController@agregarAlumno')->name('Curso.agregarAlumno');
    
    Route::any('/encuesta-response/{case?}', 'EncuestaController@cargarVoto')->name('Encuesta.cargarVoto');
    /**Foro routes */
    Route::get('/Foro', 'ForoController@index')->name('Foro.index');
    Route::get('/Foro/ver-notificaciones', 'ForoController@verNotificaciones')->name('Foro.verNotificaciones');

    /**PAYMENT ROUTES */
    Route::get('/paypal/pay', 'PaymentController@payWithPayPal')->name('PayPal.pay');
    Route::get('/paypal/status', 'PaymentController@payPalStatus');
    Route::get('/mercadopago/pay', 'PaymentController@payWithMp')->name('Mp.pay');
  });
//***********************************************************************************

//POSTVENTA* ***********************************************************************
  Route::middleware('postventa')->group(function(){
    Route::get('/CrearUser','UserController@create')->name('User.create');
    Route::get('/Agregando','UserController@addDatos')->name('User.addDatos');
    Route::post('/CargarUser','UserController@store')->name('User.store');
    Route::get('/VerCursos','CourseController@index')->name('Curso.index');
    Route::get('/HabilitarTps','TpController@index')->name('Tp.index');
    Route::get('/aprobarTps','TpController@aprobarTps')->name('Tp.aprobarTps');
    Route::get('/re-send-alta/{id}', 'UserController@sendAlta')->name('User.sendAlta');
    Route::get('/VerCursoAd/{id}',[
          'as' => 'Curso.showAdmin',
          'uses' => 'CourseController@showAdmin'
          ]);

    Route::get('/VerCursoPost/{id}',[
      'as' => 'Curso.showPostVenta',
      'uses' => 'CourseController@showPostVenta'
    ]);

    Route::get('/Unidad','UnityController@index')->name('Unidad.index');

    Route::get('/postventa', 'PostventaController@index');
    Route::get('/postventa/{Conver}/{user_id}/show-practice', 'PostventaController@showPracticeUser')->name('Postventa.showPracticeUser');
    Route::post('/Practice/{practice_id}/{user_id}/load-msj-admin', 'ConversationController@loadMsj')->name('Conversation.loadMsjAdmin');

    Route::get('/downloading','TpresueltoController@download')->name('Tpresuelto.download');

    Route::post('/aprobar','ScoreController@aprobar')->name('Score.aprobar');
    Route::get('/corrigiendo-tp-final', 'ScoreController@corregirTpFinal')->name('Score.corregirTpFinal');

    
    Route::get('/desaprobar','ScoreController@desaprobar')->name('Score.desaprobar');
    Route::get('/crear_alumno','UserController@create')->name('crearAlumno');

    Route::resource('Score','ScoreController');

    Route::get('/verAlumnos','UserController@index')->name('User.index');
    

  });
//*************************************************************************************

  //DESARROLLO**********************************************************************
  Route::middleware('desarrollo')->group(function(){
    Route::view('/desarrollo', 'desarrollo');
    Route::get('/Crearcurso','CourseController@create')->name('Crearcurso');
    Route::POST('/Curso','CourseController@store')->name('Curso.store');
    Route::post('/Curso/videoMuestra/{id}', 'CourseController@setVideoMuestra')->name('Curso.setVideoMuestra');
    Route::get('/Unidad/create','UnityController@create')->name('Unidad.create');
    Route::get('/verUnidades','UnityController@verUnidades')->name('Unidad.verUnidades');
    Route::post('/Unidad','UnityController@store')->name('Unidad.store');
    Route::get('/Unidad/Eliminar/{Unity}','UnityController@delete')->name('Unidad.eliminar');
    Route::get('/Unidad/Editar','UnityController@verEditar')->name('Unidad.verEditar');
    Route::post('/Unidad/Editar/{id}','UnityController@editar')->name('Unidad.editar');
    Route::get('/Exam/create','ExamController@create')->name('Exam.create');
    Route::post('/CargarExamen','ExamController@cargarEx');
    Route::get('/Delete', 'CourseController@destroy')->name('Curso.destroy');
    Route::get('/Cursos', 'CourseController@verCursos')->name('Curso.verCursos');
    Route::get('/VerCursoDes/{id}',[
      'as' => 'Curso.showDes',
      'uses' => 'CourseController@show'
    ]);
    
    Route::get('/Confirmation', 'CourseController@confirmar_delete')->name('Curso.confirmar_delete');
    Route::post('/Agregando','UnityController@addTP')->name('Unidad.addTP');
    Route::get('/Deleteando','TpController@delete')->name('Tp.delete');
    Route::get('/DeleteandoM','ModuleController@delete')->name('Modulo.delete');
    Route::post('/AgregandoModulo','ModuleController@add')->name('Modulo.addModulo');
    Route::post('/Module/edit/{Module}', 'ModuleController@update')->name('Moudule.updatee');
    Route::post('/cargandoVideo', 'VideoController@store')->name('Video.store');
    Route::get('/cargarVideo', 'VideoController@index')->name('Video.index');
    Route::get('/cargarEstado', 'EstadoController@store')->name('Estado.store');
    Route::get('/aprobarTP', 'TpController@aprobar')->name('Tp.aprobar');

    Route::post('/adding-final-tp', 'UnityController@addTpFinal')->name('Unity.addTpFinal');
    Route::get('/deleting-final-tp/{id}', 'UnityController@deleteTpFinal')->name('Unity.deleteTpFinal');

    /**Practice Routes */
    Route::resource('Practice', 'PracticeController');
    Route::post('/practice/addStep/{practice_id}', 'PracticeController@addStep')->name('Practice.addStep');
    Route::post('/practice/{Practice}/update', 'PracticeController@update')->name('Practice.update');
    Route::get('/practice/{Practice}/delete', 'PracticeController@delete')->name('Practice.delete');
    Route::post('/practice/{StepPractice}/update/step', 'PracticeController@editStep')->name('Practice.editStep');
    Route::get('/practice/{StepPractice}/delete/step', 'PracticeController@deleteStep')->name('Practice.deleteStep');
    Route::post('/practice/add-practice/{practice_id}', 'PracticeController@addImg')->name('Practice.addImg');
    Route::get('/practice/{ResourcePractice}/delete-img', 'PracticeController@deleteImg')->name('Practice.deleteImg');
    Route::post('/practice/add-step-practice/{step_id}/{practice_id}', 'PracticeController@addImgtoStep')->name('Practice.addImgtoStep');
    Route::get('/practice/{ResourceStepPractice}/delete-img-to-step', 'PracticeController@deleteImgStep')->name('Practice.deleteImgStep');

    /**Verdadero y falso routes */
    Route::resource('TpVf', 'TpVfController');
    Route::get('/TpVf-destroy/{id}', 'TpVfController@destroy')->name('TpVf.destroy');
    Route::post('/TpVf-new-Af', 'TpVfController@newAfirmation')->name('TpVf.newAfirmation');
    Route::get('/delete-afirmation', 'TpVfController@deleteAf')->name('TpVf.deleteAf');


    Route::get('/get-all-cursos', 'CourseController@getAllCursos');
    Route::get('/verExams', 'ExamController@verExams')->name('Exam.verExams');
    Route::get('/edit-exam/{id}', 'ExamController@editExam')->name('Exam.editExam');
    Route::post('/Answer/editAnswer', 'AnswerController@editAnswer')->name('Answer.editAnswer');
    Route::post('/Question/editQuestion', 'QuestionController@editQuestion')->name('Question.editQuestion');
    Route::get('/Question/delete/{id}', 'QuestionController@delete')->name('Question.delete');

    Route::post('/VideosYTs/edit', 'VideosYTController@update')->name('VideosYT.updateV');
    Route::get('/VideosYTs/{id}', 'VideosYTController@destroy')->name('VideosYT.destroyy');
  });
//************************************************************************************************************ */

//VENDEDOR********************************************************************
Route::middleware('vendedor')->group(function(){

    Route::get('/vendedor', 'VendedorController@inicio');
    Route::get('/crear_alumno','UserController@create')->name('crearAlumno');
    Route::post('/create-user', 'Auth\RegisterController@register')->name('User.reg');
    Route::resource('DatosUser','DatosUserController');
    Route::resource('Venta','VentaController');
    Route::get('alumno-pendiente/{id}', 'VendedorController@alumnoPendiente');
    Route::post('DatosUser/editar', 'DatosUserController@editar')->name('DatosUser/editar');
    Route::resource('DatosUser','DatosUserController');
    Route::resource('Pendiente', 'PendienteController');
    Route::get('Vendedor/envio-mail/{case}', 'VendedorController@formEnvioMail')->name('Vendedor.enviarMail');
    Route::match(['get', 'post'],'Vendedor/envio-mail', 'VendedorController@envioMail')->name('envioMail');

    Route::get('Vendedor/ver-mails-enviados', 'VendedorController@verMailsEnviados')->name('Vendedor.verMailsEnviados');
    Route::get('/get-vendedoras/{mes?}', 'AdminController@getVendedoras');
    Route::post('/envio-wpp', 'VendedorController@envioMsjWpp')->name('Vendedor.envioWpp');

    Route::get('/ver-precio-cursos', 'VendedorController@verPrecios')->name('Vendedor.verPrecios');

    Route::get('/ver-historial/{vendedora?}', 'VendedorController@verHistorialVentas')->name('vendedor.historial');

});
//***********************************************************************************

  Route::resource('Tpresuelto','TpresueltoController');
  Route::get('/home', 'HomeController@index')->name('home')->middleware('rol');


  Route::resource('Tp','TpController');

  Route::resource('Exam','ExamController');

  Route::resource('Unidad','UnityController');

  Route::resource('Modulo', 'ModuleController');
  Route::resource('Score', 'ScoreController');

});

Route::middleware('rol', 'throttle:1000,1000')->group(function () {
    Route::resource('Exam','ExamController');
});

Route::get('/a', function(){
  //
});


