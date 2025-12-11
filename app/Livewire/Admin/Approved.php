<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use Livewire\Component;

class Approved extends Component
{
    public function render()
    {
        return view('livewire.admin.approved', [
            'bookings' => Booking::where('status', 'approved')->latest()->get()
        ]);
    }
}
