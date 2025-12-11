<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Bookings Management</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Booking ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Customer
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Service
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Booking Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
    Mode of Payment
</th>
<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
    Receipt
</th>

                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                #{{ $booking->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $booking->service->name }}</div>
                                <div class="text-sm text-gray-500">₱{{ number_format($booking->service->price, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    {{ $booking->mop ?? '-' }}
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    @if($booking->receipt)
        @php
            $ext = pathinfo($booking->receipt, PATHINFO_EXTENSION);
        @endphp

        @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
            <img src="{{ asset('storage/' . $booking->receipt) }}" alt="Receipt" class="h-16 w-16 object-cover rounded-md">
        @else
            <a href="{{ asset('storage/' . $booking->receipt) }}" target="_blank"
               class="text-blue-600 hover:underline text-sm">
                View Receipt
            </a>
        @endif
    @else
        <span class="text-gray-500">No receipt</span>
    @endif
</td>



                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($booking->status == 'approved') bg-green-100 text-green-800
                                    @elseif($booking->status == 'declined') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>


                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    @if($booking->status == 'pending')
                                        <button wire:click="approveBooking({{ $booking->id }})"
                                            class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 transition text-sm">
                                            Approve
                                        </button>
                                        <button wire:click="declineBooking({{ $booking->id }})"
                                            class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition text-sm">
                                            Decline
                                        </button>
                                    @else
                                        <span class="text-gray-400 text-sm">No actions available</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bookings->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</div>
