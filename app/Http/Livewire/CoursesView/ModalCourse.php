<?php

namespace App\Http\Livewire\CoursesView;

use Livewire\Component;
use App\Course;

class ModalCourse extends Component
{
    public $course;
    public $selected_id;

    protected $listeners = ['setCourse'];

    public function mount()
    {
        $this->course = Course::first();
        $this->selected_id = $this->course->id;
    }

    public function setCourse($id)
    {
        $this->selected_id = $id;
        $this->course = Course::find($id);
    }

    public function render()
    {
        return view('livewire.courses-view.modal-course');
    }
}
