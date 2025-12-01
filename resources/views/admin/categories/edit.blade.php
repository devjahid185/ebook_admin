@extends('layouts.app')

@section('page-title','Edit Category')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <h3 class="text-lg font-semibold mb-4">Edit Category #{{ $category->id }}</h3>
  @include('admin.categories._form')
</div>
@endsection
