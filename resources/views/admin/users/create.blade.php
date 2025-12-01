@extends('layouts.app')

@section('page-title','Create User')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <h3 class="text-lg font-semibold mb-4">Create New User</h3>
  @include('admin.users._form')
</div>
@endsection
