<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-bold text-gray-700 mb-4">Approved Bookings</h2>

    <table class="w-full text-left text-sm">
        <thead>
            <tr class="border-b bg-gray-100 text-gray-700">
                <th class="p-2">Client Name</th>
                <th class="p-2">Package</th>
                <th class="p-2">Booking Date</th>
                <th class="p-2">Created At</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($bookings as $booking)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $booking->user->name ?? 'Unknown' }}</td>
                    <td class="p-2">{{ $booking->service->name ?? 'N/A' }}</td>
                    <td class="p-2">{{ $booking->booking_date }}</td>
                    <td class="p-2">{{ $booking->created_at->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 p-3">
                        No approved bookings yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
