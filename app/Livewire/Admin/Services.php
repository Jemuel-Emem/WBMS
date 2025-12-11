<?php

namespace App\Livewire\Admin;

use App\Models\Services as Service;
use Livewire\Component;

class Services extends Component
{
    public $name, $price, $description;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
    ];

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset();
    }

    public function saveService()
    {
        $this->validate();

        Service::create([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        $this->reset();
         session()->flash('message', 'Service added successfully!');
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.admin.services', [
            'services' => Service::latest()->get()
        ]);
    }
}
