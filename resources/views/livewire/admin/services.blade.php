<div>


    <div class="mt-6 flex justify-end">
        <button wire:click="openModal"
            class="px-4 py-2 bg-pink-700 text-white rounded-md hover:bg-pink-800 transition">
            <i class="ri-add-circle-fill mr-1"></i> Add Service
        </button>
    </div>


    @if ($showModal)
        <div class="fixed inset-0 bg-black/40 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6">

                <h3 class="text-xl font-bold text-gray-800 mb-4">Add New Service</h3>

                <form wire:submit.prevent="saveService">

                    <div class="mb-3">
                        <label class="text-sm font-semibold text-gray-700">Service Name</label>
                        <input type="text" wire:model="name" class="w-full border-gray-300 rounded-md"
                               placeholder="Enter service name">
                        @error('name') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-sm font-semibold text-gray-700">Price</label>
                        <input type="number" wire:model="price" class="w-full border-gray-300 rounded-md"
                               placeholder="Enter price">
                        @error('price') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-sm font-semibold text-gray-700">Description</label>
                        <textarea wire:model="description" class="w-full border-gray-300 rounded-md"
                                  rows="3" placeholder="Enter description"></textarea>
                        @error('description') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                            Cancel
                        </button>

                        <button type="submit"
                            class="px-4 py-2 bg-pink-700 text-white rounded-md hover:bg-pink-800 transition">
                            Save Service
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endif

    <!-- Success message -->
    @if (session('message'))
        <div class="mt-4 bg-green-100 text-green-700 p-2 rounded-md">
            {{ session('message') }}
        </div>
    @endif


    <!-- Services Table -->
    <div class="mt-6 bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-bold text-gray-700 mb-3">Available Services</h2>

        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="p-2 text-left">Name</th>
                    <th class="p-2 text-left">Price</th>
                    <th class="p-2 text-left">Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr class="border-b">
                        <td class="p-2">{{ $service->name }}</td>
                        <td class="p-2">₱{{ number_format($service->price, 2) }}</td>
                        <td class="p-2">{{ $service->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-2 text-center text-gray-500">No services added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
