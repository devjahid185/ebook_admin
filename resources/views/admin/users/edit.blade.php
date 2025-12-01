@extends('layouts.app')

@section('page-title','Edit User')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <h3 class="text-lg font-semibold mb-4">Edit User #{{ $user->id }}</h3>
  @include('admin.users._form')
</div>
@endsection

