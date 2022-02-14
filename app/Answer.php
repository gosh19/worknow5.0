<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  public function question()
  {
      return $this->belongsTo('App\Question');
  }
  //http://siptrunkar.net2phone.com/    PROXY
  //https://www.myaccountcenter.net/account/reseller/english/login.asp?plid=    GESTION DE LA CUENTA
  //
}
