@extends('layouts.app')

@section('page-title','Create Category')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <h3 class="text-lg font-semibold mb-4">Create Category</h3>
  @include('admin.categories._form')
</div>
@endsection
