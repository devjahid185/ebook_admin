@extends('layouts.app')

@section('title','Add New Part')
@section('page-title','Add Part for '.$book->title)

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-4">Create New Part</h3>

    @include('admin.book_parts._form')
</div>
@endsection
