@php
    $user = $user ?? null;
    $isEdit = $user && $user->id;
@endphp

<form method="POST"
      action="{{ $isEdit ? route('admin.users.update', $user) : route('admin.users.store') }}"
      enctype="multipart/form-data"
      class="space-y-4">

  @csrf
  @if($isEdit)
    @method('PUT')
  @endif

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <!-- Name -->
    <div>
      <label class="text-sm font-medium">Full Name</label>
      <input name="name"
             value="{{ old('name', $user->name ?? '') }}"
             class="w-full px-3 py-2 border rounded" />
      @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <!-- Phone -->
    <div>
      <label class="text-sm font-medium">Phone</label>
      <input name="phone"
             value="{{ old('phone', $user->phone ?? '') }}"
             class="w-full px-3 py-2 border rounded" />
      @error('phone')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <!-- Email -->
    <div>
      <label class="text-sm font-medium">Email</label>
      <input name="email"
             value="{{ old('email', $user->email ?? '') }}"
             class="w-full px-3 py-2 border rounded" />
      @error('email')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <!-- DOB -->
    <div>
      <label class="text-sm font-medium">Date of Birth</label>
      <input type="date"
             name="date_of_birth"
             value="{{ old('date_of_birth', optional($user)->date_of_birth?->format('Y-m-d')) }}"
             class="w-full px-3 py-2 border rounded" />
      @error('date_of_birth')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <!-- Address -->
    <div class="md:col-span-2">
      <label class="text-sm font-medium">Address</label>
      <textarea name="address"
                class="w-full px-3 py-2 border rounded"
                rows="3">{{ old('address', $user->address ?? '') }}</textarea>
      @error('address')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <!-- Gender -->
    <div>
      <label class="text-sm font-medium">Gender</label>
      <select name="gender" class="w-full px-3 py-2 border rounded">
        <option value="">Select</option>
        <option value="Male" {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ old('gender', $user->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
      </select>
      @error('gender')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <!-- Profile Image -->
    <div>
      <label class="text-sm font-medium">Profile Image</label>
      <input type="file" name="profile_image" class="w-full" />

      @if(!empty($user->profile_image))
      <div class="mt-2">
        <img src="{{ asset('storage/'.$user->profile_image) }}"
             class="w-20 h-20 object-cover rounded">
      </div>
      @endif

      @error('profile_image')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <!-- Password -->
    <div class="md:col-span-2">
      <label class="text-sm font-medium">
        Password {{ $isEdit ? '(leave blank to keep current)' : '' }}
      </label>
      <input name="password" type="password"
             class="w-full px-3 py-2 border rounded" />
      @error('password')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

  </div>

  <!-- Buttons -->
  <div class="flex flex-col sm:flex-row justify-end gap-2">
    <a href="{{ route('admin.users.index') }}"
       class="px-4 py-2 border rounded text-gray-700 text-center">
       Cancel
    </a>

    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded text-center">
      {{ $isEdit ? 'Update' : 'Create' }}
    </button>
  </div>

</form>
