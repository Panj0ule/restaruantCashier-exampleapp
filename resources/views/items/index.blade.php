<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Menu Items') }}
      </h2>
  </x-slot>

  <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-md rounded-lg p-6">
          <div class="flex justify-end mb-4">
              <a href="{{ route('items.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Add New Item</a>
          </div>

          <table class="min-w-full lg bg-white border border-gray-200">
              <thead>
                  <tr>
                      <th class="py-2 px-4 border-b">Name</th>
                      <th class="py-2 px-4 border-b">Price</th>
                      <th class="py-2 px-4 border-b">Description</th>
                      <th class="py-2 px-4 border-b">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($items as $item)
                      <tr>
                          <td class="py-2 px-4 border-b">{{ $item->name }}</td>
                          <td class="py-2 px-4 border-b">{{ number_format($item->price, 2) }}</td>
                          <td class="py-2 px-4 border-b">{{ $item->desc }}</td>
                          <td class="py-2 px-4 border-b">
                              <a href="{{ route('items.edit', $item) }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-yellow-600">
                                Edit
                              </a>

                              <form method="POST" action="{{ route('items.destroy', $item) }}" class="inline-block ml-2">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                              </form>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>

          @if (session('success'))
              <div class="mt-4 text-green-500">
                  {{ session('success') }}
              </div>
          @endif
      </div>
  </div>
</x-app-layout>
