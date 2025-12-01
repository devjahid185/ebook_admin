@extends('layouts.app')

@section('title','Users')
@section('page-title','Users')
@section('page-subtitle','Manage all registered users')

@section('content')

<div class="mb-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">

  <!-- Search & Filter -->
  <form method="GET" class="flex flex-col sm:flex-row items-start sm:items-center gap-2 w-full sm:w-auto">
    <input name="q"
           value="{{ request('q') }}"
           type="search"
           placeholder="Search name, email, phone"
           class="px-3 py-2 border rounded w-full sm:w-80" />

    <button class="px-4 py-2 bg-blue-600 text-white rounded w-full sm:w-auto">
      Search
    </button>

    <a href="{{ route('admin.users.index') }}"
       class="text-sm text-gray-500">
       Reset
    </a>
  </form>

  <!-- Add New User -->
  <a href="{{ route('admin.users.create') }}"
     class="px-4 py-2 bg-green-600 text-white rounded w-full sm:w-auto text-center">
     Add New User
  </a>

</div>

<div class="bg-white shadow rounded overflow-hidden">

  <!-- Table wrapper for horizontal scroll on small screens -->
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y border">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-sm text-gray-600">#</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600">User</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600">Phone / Email</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600 hidden md:table-cell">DOB</th>
          <th class="px-4 py-3 text-right text-sm text-gray-600">Actions</th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y">
        @forelse($users as $user)
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-3 text-sm">{{ $user->id }}</td>

          <!-- User Info -->
          <td class="px-4 py-3 text-sm">
            <div class="flex items-center gap-3">
              <!-- Avatar -->
              <div class="w-10 h-10 rounded-full bg-gray-100 overflow-hidden flex-shrink-0">
                @if($user->profile_image)
                  <img src="{{ asset('storage/'.$user->profile_image) }}" class="w-full h-full object-cover" />
                @else
                  <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                  </div>
                @endif
              </div>
              <!-- Name + Address -->
              <div class="break-words">
                <div class="font-medium text-gray-800">{{ $user->name }}</div>
                <div class="text-xs text-gray-500 truncate max-w-xs sm:max-w-sm md:max-w-md">{{ $user->address }}</div>
              </div>
            </div>
          </td>

          <!-- Contact -->
          <td class="px-4 py-3 text-sm">
            <div>{{ $user->phone }}</div>
            <div class="text-xs text-gray-500 break-words">{{ $user->email }}</div>
          </td>

          <!-- DOB -->
          <td class="px-4 py-3 text-sm hidden md:table-cell">
            {{ $user->date_of_birth?->format('d M, Y') ?? '-' }}
          </td>

          <!-- Actions -->
          <td class="px-4 py-3 text-sm text-right whitespace-nowrap">
            <div class="flex justify-end gap-2 flex-wrap">
              <a href="{{ route('admin.users.edit', $user) }}"
                 class="px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200">
                 Edit
              </a>

              <form action="{{ route('admin.users.destroy', $user) }}"
                    method="POST"
                    class="inline-block"
                    onsubmit="return confirm('Are you sure to delete this user?');">
                @csrf
                @method('DELETE')
                <button class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200">
                  Delete
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-4 py-6 text-center text-gray-500">
            No users found.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-4">
  {{ $users->links() }}
</div>

@endsection
