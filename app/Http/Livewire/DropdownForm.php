<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DropdownForm extends Component
{
    public $selectedOption = null;
    public $hiInput = '';
    public $helloInput = '';

    public function render()
    {
        return view('livewire.dropdown-form');
    }
}
