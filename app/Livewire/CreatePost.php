<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePost extends Component
{
    //Livewire me permite almacenar los siguientes datos primitivos arrays, strings, integer, boolean, float, null
    //collecion, models, datetime, etc


    public $user;


    public function mount($user){// este metodo, va a ser el primero que se ejecute, cuando el componente se renderice, es como el constructor 
        $this->user = Auth::user();
        // $this->user = User::find($user);//Buscar aque usuario cuyo id coinsida con el valor que le hemos pasado como parametro

    }
    


    public function render()
    {
        return view('livewire.create-post');
    }
}
