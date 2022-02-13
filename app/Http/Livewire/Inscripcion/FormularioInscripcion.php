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

    public $listeners = ['repetido'];



    public function mount()
    {
        $this->categorias = \App\Categoria::all();
        $this->email = session('email') == null ? '':session('email');
        $this->password = session('password') == null ? '':session('password');
        $this->country = session('country');
        if (session('courses')) {
            $this->coursesInSession = session('courses');
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

            foreach ($categoria->courses as $j => $curso) {
                $curso->selected = 0;
                foreach ($this->coursesInSession as $i => $value) {
                    if ($curso->id == $value) {
                        $curso->selected = 1;
                        $this->updateSelectedCourse($value);
                        break;
                    }
                }
            }

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

    public function register()
    {

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
