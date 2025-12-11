<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $bookings, $approved, $users, $months = [], $income = [];

    public function mount()
    {

        $this->bookings = Booking::count();


        $this->approved = Booking::where('status', 'approved')->count();


        $this->users = User::where('is_admin', 0)->count();

$monthly = Booking::join('services', 'bookings.service_id', '=', 'services.id')
    ->select(
        DB::raw("MONTH(bookings.created_at) as month"),
        DB::raw("SUM(services.price) as total")
    )
    ->where('bookings.status', 'approved')
    ->groupBy('month')
    ->orderBy('month')
    ->get();


        for ($i = 1; $i <= 12; $i++) {
            $this->months[] = Carbon::create()->month($i)->format('M');
            $this->income[] = optional($monthly->firstWhere('month', $i))->total ?? 0;
        }
    }

    public function render()
    {
        return view('livewire.admin.index', [
            'bookings' => $this->bookings,
            'approved' => $this->approved,
            'users'    => $this->users,
            'months'   => $this->months,
            'income'   => $this->income,
        ]);
    }
}
