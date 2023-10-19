<?php

namespace App\Livewire;

use Livewire\Component;

class Paises extends Component
{
    public $open = true;

    public $paises = [
        'Perú',
        'Colombia',
        'Argentina'
    ];

    public $active;

    public $pais;

    public $count;

    public function increment(){
        $this->count++;
    }

    public function changeActive($pais){
        $this->active = $pais;
    }


    public function save(){
        array_push($this->paises, $this->pais);

        $this->reset(['pais']);
    }

    public function delete($index){
        unset($this->paises[$index]);
    }

    public function render()
    {
        return view('livewire.paises');
    }
}
