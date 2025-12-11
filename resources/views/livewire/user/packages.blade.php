<div class="mt-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Wedding Packages</h1>

    {{-- Success Message --}}
    @if (session('message'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    {{-- Packages Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($services as $service)
            <div class="bg-white border border-gray-200 shadow-md rounded-lg p-5 hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-pink-700">{{ $service->name }}</h3>
                <p class="text-gray-700 font-semibold mt-2">₱{{ number_format($service->price, 2) }}</p>
                <p class="text-gray-600 mt-2 text-sm">{{ $service->description }}</p>

                {{-- Ratings Summary --}}
                @if($service->ratings_count > 0)
                    <div class="mt-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-yellow-500 text-lg">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= round($service->ratings_avg_rating))
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </span>
                            <span class="ml-2 text-sm text-gray-600">
                                ({{ round($service->ratings_avg_rating, 1) }}/5)
                            </span>
                        </div>
                        <button wire:click="openReviewModal({{ $service->id }})"
                            class="text-sm text-pink-700 hover:underline">
                            View Reviews ({{ $service->ratings_count }})
                        </button>
                    </div>
                @else
                    <p class="text-sm text-gray-500 mt-3">No ratings yet.</p>
                @endif

                <div class="mt-4 flex justify-end">
                    <button wire:click="openModal({{ $service->id }})"
                        class="px-3 py-2 bg-pink-700 text-white rounded-md hover:bg-pink-800 transition">
                        Book Now
                    </button>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">No packages available.</p>
        @endforelse
    </div>

    {{-- Booking Modal --}}
    @if($isModalOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-black/40 z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    Book: {{ $selectedService->name }}
                </h2>
                <p class="text-gray-600 mb-4">
                    Price: ₱{{ number_format($selectedService->price, 2) }}
                </p>

                <label class="text-sm font-semibold text-gray-700">Booking Date:</label>
                <input type="date" wire:model="booking_date" class="w-full border-gray-300 rounded-md">
                @error('booking_date')
                    <p class="text-red-600 text-xs">{{ $message }}</p>
                @enderror
<label class="text-sm font-semibold text-gray-700">Mode of Payment:</label>
<select wire:model="mop" class="w-full border-gray-300 rounded-md mb-2">
    <option value="">Select Payment Method</option>
    <option value="Cash">Cash</option>
    <option value="GCash">GCash</option>
    <option value="Bank Transfer">Bank Transfer</option>
</select>
@error('mop') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
<label class="text-sm font-semibold text-gray-700">Upload Receipt:</label>
<input type="file" wire:model="receipt" class="w-full mb-2">
@error('receipt') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror

@if ($receipt)
    <p class="text-green-600 text-sm mt-1">Selected File: {{ $receipt->getClientOriginalName() }}</p>
@endif

                <div class="flex justify-end gap-2 mt-4">
                    <button wire:click="closeModal"
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button wire:click="saveBooking"
                        class="px-4 py-2 bg-pink-700 text-white rounded-md hover:bg-pink-800 transition">
                        Confirm Booking
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Reviews Modal --}}
    @if($isReviewModalOpen && $selectedService)
        <div class="fixed inset-0 flex items-center justify-center bg-black/40 z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-3">
                    Reviews for {{ $selectedService->name }}
                </h2>

                @if($selectedService->ratings->count() > 0)
                    <div class="space-y-3 max-h-80 overflow-y-auto">
                        @foreach($selectedService->ratings as $rate)
                            <div class="border-b pb-2">
                                <div class="flex items-center justify-between">
                                    <strong>{{ $rate->user->name ?? 'User' }}</strong>
                                    <span class="text-yellow-500 text-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $rate->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                </div>
                                <p class="text-gray-700 text-sm mt-1">
                                    {{ $rate->comment ?? 'No comment' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center">No reviews yet for this service.</p>
                @endif

                <div class="flex justify-end mt-4">
                    <button wire:click="closeReviewModal"
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
