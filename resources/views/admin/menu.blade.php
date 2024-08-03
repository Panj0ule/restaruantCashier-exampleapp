<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Manage Menu') }}
      </h2>
  </x-slot>

  <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if(session('success'))
          <div class="bg-green-500 text-white p-4 rounded">
              {{ session('success') }}
          </div>
      @endif

      <form method="POST" action="{{ route('admin.menu.store') }}">
          @csrf
          <div>
              <label for="name">Name</label>
              <input type="text" id="name" name="name" required>
          </div>
          <div>
              <label for="price">Price</label>
              <input type="number" id="price" name="price" step="0.01" required>
          </div>
          <div>
              <label for="desc">Description</label>
              <textarea id="desc" name="desc" required></textarea>
          </div>
          <button type="submit">Add Menu Item</button>
      </form>

      <h3 class="mt-6">Existing Menu Items</h3>
      <ul>
          @foreach($items as $item)
              <li>{{ $item->name }} - ${{ $item->price }} - {{ $item->desc }}</li>
          @endforeach
      </ul>
  </div>
</x-app-layout>
