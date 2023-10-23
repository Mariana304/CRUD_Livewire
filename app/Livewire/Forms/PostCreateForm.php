<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PostCreateForm extends Form
{

    #[Rule('required')]
    public $title;

    #[Rule('required')]
    public $content ;

    #[Rule('required|exists:categories,id')]
    public $category_id = '';

    #[Rule('required|array')]
    public $tags = [];

 

    public function save(){

        $this->validate();

        $user = auth()->user();
        // $post = Post::create(
        //     $this->only('title','content','category_id', 'tags', 'user_id')
        //     // Asigna el ID del usuario
        // );

        $post = new Post;
        $post->title = $this->title;
        $post->content = $this->content;
        $post->category_id = $this->category_id;
        $post->user_id = $user->id; // Asigna la variable $miVariable al campo user_id
        $post->save();


        $post->tags()->attach($this->tags);
        $this->reset();
    }



}
