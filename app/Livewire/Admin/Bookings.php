<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;

class Bookings extends Component
{
    use WithPagination;

    public function approveBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $booking->update([
            'status' => 'approved'
        ]);

        session()->flash('success', 'Booking #' . $bookingId . ' has been approved successfully!');
    }

    public function declineBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $booking->update([
            'status' => 'declined'
        ]);

        session()->flash('success', 'Booking #' . $bookingId . ' has been declined.');
    }

    public function render()
    {
        return view('livewire.admin.bookings', [
            'bookings' => Booking::with(['user', 'service'])
                ->latest()
                ->paginate(10)
        ]);
    }
}
