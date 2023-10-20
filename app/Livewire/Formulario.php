<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Formulario extends Component
{

    public $categories, $tags;

    public PostCreateForm $postCreate ;


    public $posts;
    

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

    public function destroy($postId){
        $post = Post::find($postId);
        $post->delete();
        $this->posts = Post::all();

    }


    //METODO GUARDAR
    public function save()
    {
        $this->postCreate->save(); 
        $this->posts = Post::all(); //despues de que lo creo compacto nuevmente el modelo, para que se actualice
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
        return view('livewire.formulario');
    }
}
