<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','rol','tipo_pago',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function datosUser(){
      return $this->hasOne('App\DatosUser');
    }

    public function datosKit(){
      return $this->hasOne('App\Kit');
    }

    public function coursesUser(){
      return $this->belongsToMany('App\Course')->get();
    }

    public function courses()
    {
      return $this->belongsToMany('App\Course')->withPivot('unities', 'type');
    }

    public function isCourseOnTest()
    {
      # code...
    }


    public function premiums(): HasMany
    {
        return $this->hasMany(Premium::class, 'user_id', 'id');
    }

    public function coursesTest()
    {
      $courses =$this->belongsToMany('App\Course')->withPivot('unities', 'type')->get();

      $tests = [];
      foreach ($courses as $key => $cur) {
        if ($cur->pivot->type == 'test') {
          $tests[]= $cur;
        }
      }

      return $tests;
    }

    public function isPremiumCourse($course_id)
    {
        $premium = \App\Premium::where([['user_id',$this->id],['course_id',$course_id]])->get();

        return $premium;
    }

    public function tpresueltoUser(){
      return $this->hasMany('App\Tpresuelto')->get();
    }

    public function scoreUser(){
      return $this->hasMany('App\Score')->get();
    }

    public function scoreCorrection(){
      return $this->hasMany('App\Score')->where('nota','corrigiendo');
    }
    

    public function examsUser(){
      return $this->hasMany('App\Exam')->get();
    }

    
    public function anuncio()
    {
        return $this->hasOne('App\Anuncio');
    }
    public function scoreVF()
    {
        return $this->hasMany('App\ScoreTpVf');
    }
    public function novedades()
    {
        return $this->hasMany('App\Novedad');
    }

    public function recibidas()
    {
        return $this->hasMany('App\Recibido');
    }

    /**FUNCIONES TIENDA */
    public function carritoAc()
    {
      $carrito = Carrito::where([['user_id', $this->id], ['estado', 'abierto']])->first();

      return $carrito;
    }

    public function carritoEstado($estado)
    {
      $carrito = Carrito::where([['user_id', $this->id], ['estado', $estado]])->first();

      return $carrito;
    }

    /**FUNCIONES COBRANZA **************************************/
    
    public function cobros()
    {
        return $this->hasMany('App\Cobro');
    }
    public function infoFac()
    {
        return $this->hasOne('App\InfoFac');
    }
    public function venta()
    {
        return $this->hasOne('App\Venta', 'alumno', 'id');
    }
    public function adicionales()
    {
        return $this->hasMany('App\Adicional');
    }
    public function infoPago()
    {
        return $this->hasOne('App\AvisoPago');
    }
    /**
     * envio la ip del user autenticado y me devuelve data geopolitica
     */
    public static function getDataIp()
    {
      $dataSolicitud = (object) [];
        try {
          $informacionSolicitud = file_get_contents("http://www.geoplugin.net/json.gp?ip=".\Request::ip());
          $dataSolicitud = json_decode($informacionSolicitud);
          //session()->put('country',$dataSolicitud->geoplugin_countryCode);
          session()->put('conversion',$dataSolicitud->geoplugin_currencyConverter);
          
        } catch (\Throwable $th) {
          session()->put('country','SD');
        }

          
        return $dataSolicitud;

        /**
         * ["geoplugin_city"]=> string(0) ""  ciudad
         * ["geoplugin_region"]=> string(0) "" provincia
         * ["geoplugin_regionCode"]=> string(0) "" 
         * ["geoplugin_regionName"]=> string(0) "" provincia tmb xd
         * ["geoplugin_areaCode"]=> string(0) "" 
         * ["geoplugin_dmaCode"]=> string(0) "" 
         * ["geoplugin_countryCode"]=> string(2) "PY" 
         * ["geoplugin_countryName"]=> string(8) "Paraguay" 
         * ["geoplugin_inEU"]=> int(0) 
         * ["geoplugin_euVATrate"]=> bool(false) 
         * ["geoplugin_continentCode"]=> string(2) "SA" 
         * ["geoplugin_continentName"]=> string(13) "South America" 
         * ["geoplugin_latitude"]=> string(3) "-23" 
         * ["geoplugin_longitude"]=> string(3) "-58" 
         * ["geoplugin_locationAccuracyRadius"]=> string(2) "50" 
         * ["geoplugin_timezone"]=> string(16) "America/Asuncion" 
         * ["geoplugin_currencyCode"]=> string(3) "PYG" 
         * ["geoplugin_currencySymbol"]=> string(2) "Gs" 
         * ["geoplugin_currencySymbol_UTF8"]=> string(2) "Gs" 
         * ["geoplugin_currencyConverter"]=> float(7045.551)
         */
    }
    
    /************************************************************/

    /**FUNCIONES DEL FORO */
    public function postNotis()
    {
        return $this->hasMany('App\PostNotification')->where('visto',0)->get();
    }
    /********************************************************* */
}
