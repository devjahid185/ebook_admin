@extends('layouts.app')

@section('page-title','Create Book')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <h3 class="text-lg font-semibold mb-4">Add New Book</h3>

  @include('admin.books._form')
</div>
@endsection
