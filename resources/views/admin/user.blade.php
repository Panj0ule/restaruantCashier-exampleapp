<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Manage Users') }}
      </h2>
  </x-slot>

  <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if(session('success'))
          <div class="bg-green-500 text-white p-4 rounded">
              {{ session('success') }}
          </div>
      @endif

      <h3>Users List</h3>
      <ul>
          @foreach($users as $user)
              <li>
                  <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                      @csrf
                      @method('POST')
                      <input type="text" name="name" value="{{ $user->name }}" required>
                      <input type="email" name="email" value="{{ $user->email }}" required>
                      <input type="checkbox" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
                      <button type="submit">Update</button>
                  </form>
              </li>
          @endforeach
      </ul>
  </div>
</x-app-layout>
