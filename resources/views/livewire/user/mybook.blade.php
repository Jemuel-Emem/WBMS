<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-bold text-gray-700 mb-2">My Bookings</h2>

    <div class="mb-4 p-3 bg-yellow-100 border-l-4 border-yellow-500 text-sm text-gray-700 rounded">
        <strong>Note:</strong> Payment must be made in the physical store.
        The payment should be paid <strong>one week before the booking date</strong>.
    </div>

    @if (session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full text-left text-sm">
        <thead>
            <tr class="border-b bg-gray-100 text-gray-700">
                <th class="p-2">Package</th>
                <th class="p-2">Booking Date</th>
                <th class="p-2">Status</th>
                <th class="p-2 text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($bookings as $book)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $book->service->name ?? 'N/A' }}</td>
                    <td class="p-2">{{ $book->booking_date }}</td>
                    <td class="p-2">
                        @if($book->status == 'approved')
                            <span class="text-green-600 font-semibold">Approved</span>
                        @elseif($book->status == 'pending')
                            <span class="text-yellow-500 font-semibold">Pending</span>
                        @else
                            <span class="text-red-500 font-semibold">Declined</span>
                        @endif
                    </td>
                    <td class="p-2 text-center">
                        @if($book->status == 'approved')
                            <button
                                wire:click="openModal({{ $book->id }})"
                                class="bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700">
                                Rate
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 p-3">
                        You have no bookings yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Rating Modal --}}
    @if($showModal)
        <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h2 class="text-lg font-semibold mb-4 text-gray-700">
                    Rate your booking: {{ $selectedBooking->service->name ?? '' }}
                </h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Rating (1–5)</label>
                    <input type="number" wire:model="rating" min="1" max="5"
                        class="border border-gray-300 rounded w-full px-3 py-2 mt-1">
                    @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Comment</label>
                    <textarea wire:model="comment" rows="3"
                        class="border border-gray-300 rounded w-full px-3 py-2 mt-1"></textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <button wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                    <button wire:click="submitRating" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
