<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $open = false;

    public $title, $content, $image, $identificador;
    

    public function render()
    {
        return view('livewire.create-post');
    }

    public function mount()
    {
        $this->identificador = rand();
    }

    protected $rules = [
        'title' => 'required|max:100',
        'content' => 'required',
        'image' => 'image'
    ];


    public function save()
    {

        $image = $this->image->store('posts');

        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image
        ]);

        $this->reset(['open', 'title', 'content', 'image']);

        $this->identificador = rand();

        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'el post se creo con exito');
    }

    

}
