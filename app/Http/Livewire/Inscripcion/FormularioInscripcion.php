<?php

namespace App\Http\Livewire\Inscripcion;

use Livewire\Component;

class FormularioInscripcion extends Component
{
    public $categorias = [];
    public $selectedCat = [];
    public $coursesSelected = [];
    public $coursesInSession = [];

    public $email = "";
    public $password = "";
    public $name = "";
    public $phone = "";
    public $country = "";

    public $errorFields = ['name'=> false,'email'=> false,'password'=> false,'phone'=> false];

    public $listeners = ['repetido'];



    public function mount()
    {
        $this->categorias = \App\Categoria::all();
        $this->email = session('email') == null ? '':session('email');
        $this->password = session('password') == null ? '':session('password');
        $this->country = session('country');
        if (session('courses')) {
            $this->coursesSelected = session('courses');
        }
    }

    public function repetido()
    {
        # code...
    }

    public function updateSelectedCat($cat)
    {
        $flag = false;

        foreach ($this->selectedCat as $key => $value) {
            if($value['id'] == $cat['id']){
                unset($this->selectedCat[$key]);
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            $categoria = \App\Categoria::find($cat['id']);

            $this->selectedCat[] = ['id'=>$cat['id'],'data'=>$categoria->courses];
            

        }
    }

    public function updateSelectedCourse($id)
    {
        $flag = false;

        foreach ($this->coursesSelected as $key => $value) {
            if($value == $id){
                unset($this->coursesSelected[$key]);
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            $this->coursesSelected[] = $id;

        }
    }

    public function validateFields()
    {      

        $this->errorFields['name'] =  ($this->name == '') ? true:false;
        $this->errorFields['email'] =  ($this->email == '') ? true:false;
        $this->errorFields['phone'] =  ($this->phone == '') ? true:false;
        $this->errorFields['password'] =  ($this->password == '') ? true:false;
            
        foreach ($this->errorFields as $key => $error) {
            if (!$error) {
                return 0;
            }
        }

    }

    public function register()
    {
        
        $this->validateFields();
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
        $datosUser->telefono = $this->phone;
        $datosUser->provincia =  @$dataIp->geoplugin_region;
        $datosUser->country = $this->country;
        $datosUser->save();


        $userTest = new \App\UserTest;
        $userTest->user_id = $user->id;
        $userTest->save();

        foreach ($this->coursesSelected as $curso) {
            if ($curso != null) {
                $user->courses()->attach($curso);
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
    

    public function render()
    {
        return view('livewire.inscripcion.formulario-inscripcion');
    }
}
