<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Users') }}
      </h2>
  </x-slot>

  <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a href="{{ route('users.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded">Add New User</a>

      @if (session('success'))
          <div class="mb-4 text-green-500">
              {{ session('success') }}
          </div>
      @endif

      <div class="bg-white shadow-md rounded-lg p-6">
          <table class="w-full border-collapse">
              <thead>
                  <tr>
                      <th class="border px-4 py-2">Name</th>
                      <th class="border px-4 py-2">Email</th>
                      <th class="border px-4 py-2">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                      <tr>
                          <td class="border px-4 py-2">{{ $user->name }}</td>
                          <td class="border px-4 py-2">{{ $user->email }}</td>
                          <td class="border px-4 py-2">
                              <a href="{{ route('users.edit', $user) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                              <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline-block ml-2">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                              </form>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
</x-app-layout>
