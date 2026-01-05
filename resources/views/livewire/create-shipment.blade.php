<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <form class="space-y-6" wire:submit="submit">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Title
            </label>
            <input wire:model.live.debounce="title" type="text" placeholder="Enter a title"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    From City
                </label>
                <input wire:model="from_city" type="text" placeholder="Enter from city"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    From Country
                </label>
                <input wire:model="from_country" type="text" placeholder="Enter from country"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >
                @error('from_country')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    To City
                </label>
                <input wire:model="to_city" type="text" placeholder="Enter to city"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >
                @error('to_city')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    To Country
                </label>
                <input wire:model="to_country" type="text" placeholder="Enter to country"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >
                @error('to_country')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Price
                </label>
                <input wire:model="price" type="number" placeholder="Enter price"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >
                @error('price')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Client
                </label>
                <input wire:model="clientId" wire:blur="validateUser" type="number" placeholder="Enter client id"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >
                @error('clientId')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Status
            </label>
            <select wire:model="status" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
            >
                @foreach($statuses as $singleStatus)
                    <option value="{{ $singleStatus }}">
                        {{ $singleStatus }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Documents
            </label>
            <input type="file" wire:model="documents" multiple
                   class="block w-full text-sm text-gray-600
                       file:mr-4 file:py-2 file:px-4
                       file:rounded-lg file:border-0
                       file:text-sm file:font-semibold
                       file:bg-indigo-50 file:text-indigo-700
                       hover:file:bg-indigo-100"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Details
            </label>
            <textarea wire:model="details" rows="4" placeholder="Enter details"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
            ></textarea>
            @error('details')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full md:w-auto px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg
                       hover:bg-indigo-700 transition"
            >
                Create shipment
            </button>
        </div>

    </form>
</div>

