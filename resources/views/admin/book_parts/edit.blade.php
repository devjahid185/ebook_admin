@extends('layouts.app')

@section('title','Edit Part')
@section('page-title','Edit Part for '.$book->title)

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-4">Edit Part #{{ $part->id }}</h3>

    @include('admin.book_parts._form')
</div>
@endsection
