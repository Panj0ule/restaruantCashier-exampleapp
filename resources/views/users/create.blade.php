<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Add New User') }}
      </h2>
  </x-slot>

  <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a href="{{ route('users.index') }}" class="mb-4 inline-block px-4 py-2 bg-gray-500 text-white rounded">Back to List</a>

      <form method="POST" action="{{ route('users.store') }}">
          @csrf

          <div class="bg-white shadow-md rounded-lg p-6">
              <div class="mb-4">
                  <label for="name" class="block text-gray-700">Name</label>
                  <input type="text" name="name" id="name" class="mt-1 block w-full" value="{{ old('name') }}" required>
              </div>

              <div class="mb-4">
                  <label for="email" class="block text-gray-700">Email</label>
                  <input type="email" name="email" id="email" class="mt-1 block w-full" value="{{ old('email') }}" required>
              </div>

              <div class="mb-4">
                  <label for="password" class="block text-gray-700">Password</label>
                  <input type="password" name="password" id="password" class="mt-1 block w-full" required>
              </div>

              <div class="mb-4">
                  <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full" required>
              </div>

              <div class="flex items-center justify-end">
                  <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add User</button>
              </div>
          </div>
      </form>
  </div>
</x-app-layout>
