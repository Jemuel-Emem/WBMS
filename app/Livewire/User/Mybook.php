<?php

namespace App\Livewire\User;

use App\Models\Booking;
use App\Models\Rating;
use Livewire\Component;

class Mybook extends Component
{
    public $showModal = false;
    public $selectedBooking;
    public $rating;
    public $comment;

    public function openModal($bookingId)
    {
        $this->selectedBooking = Booking::find($bookingId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->reset(['showModal', 'selectedBooking', 'rating', 'comment']);
    }

    public function submitRating()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        Rating::create([
            'booking_id' => $this->selectedBooking->id,
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->closeModal();
        session()->flash('success', 'Thank you for your feedback!');
    }

    public function render()
    {
        return view('livewire.user.mybook', [
            'bookings' => Booking::where('user_id', auth()->id())->latest()->get()
        ]);
    }
}
