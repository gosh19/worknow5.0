<?php

namespace App\Http\Livewire\Inscripcion;

use Livewire\Component;

class Form extends Component
{
    public $cursos = [];
    public $categorias = [];
    public $debug = '';
    public $selected = [];

    public $name = '';
    public $email = '';
    public $password = '';
    public $confpassword = '';
    public $country='';

    protected $listeners = ['addCourse','campos','password','cursos','repetido'];

    public function mount($country)
    {
        $this->cursos = \App\Course::orderBy('nombre','asc')->get();
        $this->categorias = \App\Categoria::orderBy('order','asc')->get();
        $this->country = $country;
    }


    public function addCourse()
    {
        //
    }

    public function campos()
    {
        # code...
    }
    public function password()
    {
        # code...
    }
    public function cursos()
    {
        # code...
    }
    public function repetido()
    {
        # code...
    }

    public function register()
    {
        if (($this->name == '') || ($this->email == '') || ($this->password == '')) {
            $this->emit('campos');
            return 0;
        }else if($this->password != $this->confpassword ){
            $this->emit('password');
            return 0;
        }else if(!session()->has('selected')){
            $this->emit('cursos');
            return 0;
        }else if(count(session('selected')) == 0){
            $this->emit('cursos');
            return 0;
        }

        $search = \App\User::where('email',$this->email)->get();
        if (count($search) != 0) {
            $this->emit('repetido');
            return 0;
        }

        $user = new \App\User;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = \Illuminate\Support\Facades\Hash::make($this->password);
        $user->rol = 'alumno';
        $user->tipo_pago = 'test';
        $user->save();

        $dataIp =$user->getDataIp();

        $datosUser = new \App\DatosUser;
        $datosUser->user_id = $user->id;
        $datosUser->ciudad =  @$dataIp->geoplugin_city;
        $datosUser->provincia =  @$dataIp->geoplugin_region;
        $datosUser->country = session()->has('country') ? session('country'):'SD';
        $datosUser->save();


        $userTest = new \App\UserTest;
        $userTest->user_id = $user->id;
        $userTest->save();

        foreach (session('selected') as $curso) {
            if ($curso != null) {
                $user->courses()->attach($curso['id']);
            }
        }
        foreach ($user->courses as  $course) {
            if ($course->info != null) {
                if ($course->info->free) {
                    $course->pivot->type = 'free';
                    $course->pivot->save();
                }
            }
        }
        \Illuminate\Support\Facades\Auth::loginUsingId($user->id);

        return redirect()->to('/intro');
    }

    public function deleteCourse($index)
    {
        if (session()->has('selected.'.$index)) {
            $this->emit('unSelect',session('selected.'.$index.'.id'));
            session()->forget('selected.'.$index);
        }

    }

    public function render()
    {
        return view('livewire.inscripcion.form');
    }
}
