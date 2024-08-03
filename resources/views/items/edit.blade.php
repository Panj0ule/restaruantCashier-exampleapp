<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Edit Menu Item') }}
      </h2>
  </x-slot>

  <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a href="{{ route('items.index') }}" class="mb-4 inline-block px-4 py-2 bg-gray-500 text-white rounded">Back to List</a>

      <!-- Update Form -->
      <form method="POST" action="{{ route('items.update', $item) }}">
          @csrf
          @method('PUT')

          <div class="bg-white shadow-md rounded-lg p-6">
              <div class="mb-4">
                  <label for="name" class="block text-gray-700">Name</label>
                  <input type="text" name="name" id="name" class="mt-1 block w-full" value="{{ old('name', $item->name) }}" required>
              </div>

              <div class="mb-4">
                  <label for="price" class="block text-gray-700">Price</label>
                  <input type="number" name="price" id="price" class="mt-1 block w-full" step="0.01" value="{{ old('price', $item->price) }}" required>
              </div>

              <div class="mb-4">
                  <label for="desc" class="block text-gray-700">Description</label>
                  <textarea name="desc" id="desc" class="mt-1 block w-full">{{ old('desc', $item->desc) }}</textarea>
              </div>

              <div class="flex items-center justify-end">
                  <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update Item</button>
              </div>
          </div>
      </form>

      <!-- Delete Form -->
      <form method="POST" action="{{ route('items.destroy', $item) }}" class="mt-4">
          @csrf
          @method('DELETE')
          <div class="flex items-center justify-end">
              <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Delete Item</button>
          </div>
      </form>

      @if (session('success'))
          <div class="mt-4 text-green-500">
              {{ session('success') }}
          </div>
      @endif
  </div>
</x-app-layout>
