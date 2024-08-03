<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Add New Menu Item') }}
      </h2>
  </x-slot>

  <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form method="POST" action="{{ route('items.store') }}">
          @csrf

          <div class="bg-white shadow-md rounded-lg p-6">
              <div class="mb-4">
                  <label for="name" class="block text-gray-700">Name</label>
                  <input type="text" name="name" id="name" class="mt-1 block w-full" required>
              </div>

              <div class="mb-4">
                  <label for="price" class="block text-gray-700">Price</label>
                  <input type="number" name="price" id="price" class="mt-1 block w-full" step="0.01" required>
              </div>

              <div class="mb-4">
                  <label for="desc" class="block text-gray-700">Description</label>
                  <textarea name="desc" id="desc" class="mt-1 block w-full"></textarea>
              </div>

              <div class="flex items-center justify-end">
                  <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add Item</button>
              </div>
          </div>

          @if (session('success'))
              <div class="mt-4 text-green-500">
                  {{ session('success') }}
              </div>
          @endif
      </form>
  </div>
</x-app-layout>
