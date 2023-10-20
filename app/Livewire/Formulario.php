<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Formulario extends Component
{

    public $categories, $tags;

    public $postCreate = [
        'title' => '',
        'content' => '',
        'category_id' => '',
        'tags' => []
    ];


    public $posts;
    public $postEditId = '';
    public $open = false;

    public $postEdit = [
        'title' => '',
        'content' => '',
        'category_id' => '',
        'tags' => [],
    ];




    //METODOS QUE ME RETORNAN MIS VALIDACIONES, CON MIS PERSONALIZACIONES 
    public function rules(){
        return [
        'postCreate.title' => 'required',
        'postCreate.content' => 'required',
        'postCreate.category_id' => 'required|exist:category_id',
        'postCreate.tags' => 'required|array'
        ];
    }


    public function messages(){

        return [
            'postCreate.title' => 'El campo titulo es requerido'
        ];

    }

    public function ValidationAttributes()
    {

        return [
            'postCreate.category_id' => 'categoria'
        ];

    }//FIN DE METODOS QUE ME DEVUELVEN MIS VALIDACIONES



    // METODO EDITAR
    public function edit($postId)
    {
        $this->resetValidation();

        $this->open = true;
        $this->postEditId = $postId; //capturamos el id del post para llevarlo al metodo update
        $post = Post::find($postId);
        // reemplazamos los datos que encontramos 
        $this->postEdit['category_id'] = $post->category_id;
        $this->postEdit['title'] = $post->title;
        $this->postEdit['content'] = $post->content;
        $this->postEdit['tags'] = $post->tags->pluck('id')->toArray();
    }


    //METODO ACTUALIZAR
    public function update()
    {
        $this->validate([
            'postEdit.title' => 'required',
            'postEdit.content' => 'required',
            'postEdit.category_id' => 'required',//Primer array colocas las reglas
            'postEdit.tags' => 'required|array'
        ]);
        
        $post = Post::find($this->postEditId);
        $post->update([
            'category_id' => $this->postEdit['category_id'],
            'content' => $this->postEdit['content'],
            'title' => $this->postEdit['title'],
        ]);
        $post->tags()->sync($this->postEdit['tags']);
        $this->reset(['postEditId', 'postEdit', 'open']);
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

        $this->validate(); 

        // $post = Post::create([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        // ]);

        // PRIMERA FORMA DE VALIDAR 
        // $this->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        //     'category_id' => 'required|exist:category_id',//Primer array colocas las reglas
        //     'selectedTags' => 'required|array'
        // ],
        // [
        //     'title.required' => 'El campo titulo es requerido',//segundo array modificas los mensajes
        // ],
        // [
        //     'category_id'=> 'categoria'//Tercer array modificas los atributos
        // ]);



        $post = Post::create([
        'category_id' => $this->postCreate['category_id'],
        'title' => $this->postCreate['title'],
        'content' => $this->postCreate['content'], 
        ]);

        $post->tags()->attach($this->postCreate['tags']);
        $this->reset(['postCreate']);
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
