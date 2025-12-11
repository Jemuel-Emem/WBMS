<?php

namespace App\Livewire\User;

use App\Models\Services as Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Packages extends Component
{
    use WithFileUploads; // for file uploads

    public $isModalOpen = false;
    public $isReviewModalOpen = false;
    public $selectedServiceId = null;
    public $selectedService;
    public $booking_date;
    public $mop;
    public $receipt;

protected $rules = [
    'booking_date' => 'required|date|after:today',
    'mop' => 'required|string',
    'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
];


    public function openModal($id)
    {
        $this->selectedServiceId = $id;
        $this->selectedService = Service::find($id);

        if ($this->selectedService) {
            $this->isModalOpen = true;
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedServiceId = null;
        $this->selectedService = null;
        $this->booking_date = null;
        $this->mop = null;
        $this->receipt = null;
    }

    public function openReviewModal($id)
    {
        $this->selectedServiceId = $id;
        $this->selectedService = Service::with(['ratings.user'])->find($id);

        if ($this->selectedService) {
            $this->isReviewModalOpen = true;
        }
    }

    public function closeReviewModal()
    {
        $this->isReviewModalOpen = false;
        $this->selectedServiceId = null;
        $this->selectedService = null;
    }

    public function saveBooking()
    {
        $this->validate();

        $service = Service::find($this->selectedServiceId);

        if (!$service) {
            session()->flash('error', 'Service not found.');
            return;
        }



        $receiptPath = $this->receipt->store('receipts', 'public');

        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $service->id,
            'booking_date' => $this->booking_date,
            'mop' => $this->mop,
            'receipt' => $receiptPath,
            'status' => 'pending',
        ]);

        $this->closeModal();
        session()->flash('message', 'Booking saved successfully!');
    }

    public function render()
    {
        return view('livewire.user.packages', [
            'services' => Service::withCount('ratings')
                                ->withAvg('ratings', 'rating')
                                ->get()
        ]);
    }
}
