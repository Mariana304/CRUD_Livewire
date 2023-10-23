<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Formulario extends Component
{


    public $categories, $tags;

    public PostCreateForm $postCreate;


    public $posts;

    public $open = false;


    public PostEditForm $postEdit;

    // METODO EDITAR -> esta en postEditForm
    public function edit($postId)
    {
        $this->resetValidation();
        $this->postEdit->edit($postId);
    }


    //METODO ACTUALIZAR
    public function update()
    {
        $this->postEdit->update();
        $this->posts = Post::all();
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        $this->posts = Post::all();
    }


    
    public function openModalCreate(){
        $this->open = true;
    }


    //METODO GUARDAR
    public function save()
    {
        $this->postCreate->save();
        $this->posts = Post::all(); //despues de que lo creo compacto nuevmente el modelo, para que se actualice
        $this->reset('open');
    }


    //Metodo que se ejecuta cada vez que se reenderice a este componente, seria el equivalente al constructor en POO
    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::all();
    }


    public function render()
    {
        
        $user = auth()->user();

        if ($user) {
            $posts = Post::where('user_id', $user->id)->get();
        } else {
            $posts = collect(); // Si el usuario no está autenticado, crea una colección vacía
        }

        $this->posts = $posts;

        return view('livewire.formulario');
    }
}
