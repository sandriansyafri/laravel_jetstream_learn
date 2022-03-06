<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Index extends Component
{

    public $isOpen = false;
    public $isEdit = false;
    public $isNotif = false;

    public  $postId;
    public  $title;
    public  $desc;

    protected $rules = [
        'title' => 'required',
        'desc' => 'required',
    ];

    public function create()
    {
        $this->resetForm();

        $this->showModal();
        $this->isEdit = false;
    }

    public function showModal()
    {
        $this->isOpen = true;
    }

    public function hideModal()
    {
        $this->isOpen = false;
    }

    public function hideNotif()
    {
        $this->isNotif = false;
    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $posts  = Post::latest()->get();
        return view('livewire.post.index', compact(['posts']));
    }

    public function edit(Post $post)
    {
        $this->isEdit = true;
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->desc = $post->desc;

        $this->showModal();
    }

    public function submit()
    {
        $validatedData = $this->validate();
        Post::updateOrCreate(['id' => $this->postId], $validatedData);
        session()->flash('success', $this->postId ? 'Updated Successfully' : 'Created Successfully');
        $this->isNotif = true;
        $this->resetForm();
        $this->hideModal();
    }

    public function delete(Post $post)
    {
        $post->delete();
        $this->hideModal();
    }

    public function resetForm()
    {
        $this->postId = "";
        $this->title = "";
        $this->desc = "";
    }
}
