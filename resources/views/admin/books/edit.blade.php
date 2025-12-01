@extends('layouts.app')

@section('page-title','Edit Book')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <h3 class="text-lg font-semibold mb-4">Edit Book #{{ $book->id }}</h3>

  @include('admin.books._form')
</div>
@endsection
