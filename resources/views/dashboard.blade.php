@extends('layouts.app')
@section('title','Dashboard')

@section('content')
{{-- Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
    {{-- Card 1: New Employees Today --}}
    <div class="bg-white rounded-2xl shadow-xl p-5 flex items-center justify-between hover:bg-brand-600 group transition">
        <div>
            <div class="text-3xl font-semibold text-brand-600 group-hover:text-white">{{ number_format("0") }}</div>
            <div class="text-slate-500 group-hover:text-white/90">New Employees Today</div>
        </div>
        <ion-icon name="person-add-outline" class="text-4xl text-slate-400 group-hover:text-white/90"></ion-icon>
    </div>

    {{-- Card 2: Total Managers --}}
    <div class="bg-white rounded-2xl shadow-xl p-5 flex items-center justify-between hover:bg-brand-600 group transition">
        <div>
            <div class="text-3xl font-semibold text-brand-600 group-hover:text-white">{{ number_format("0") }}</div>
            <div class="text-slate-500 group-hover:text-white/90">Total Managers</div>
        </div>
        <ion-icon name="people-outline" class="text-4xl text-slate-400 group-hover:text-white/90"></ion-icon>
    </div>

    {{-- Card 3: Active Employees --}}
    <div class="bg-white rounded-2xl shadow-xl p-5 flex items-center justify-between hover:bg-brand-600 group transition">
        <div>
            <div class="text-3xl font-semibold text-brand-600 group-hover:text-white">{{ number_format("0") }}</div>
            <div class="text-slate-500 group-hover:text-white/90">Active Employees</div>
        </div>
        <ion-icon name="checkmark-circle-outline" class="text-4xl text-slate-400 group-hover:text-white/90"></ion-icon>
    </div>

    {{-- Card 4: Inactive Employees --}}
    <div class="bg-white rounded-2xl shadow-xl p-5 flex items-center justify-between hover:bg-brand-600 group transition">
        <div>
            <div class="text-3xl font-semibold text-brand-600 group-hover:text-white">{{ number_format("0") }}</div>
            <div class="text-slate-500 group-hover:text-white/90">Inactive Employees</div>
        </div>
        <ion-icon name="remove-circle-outline" class="text-4xl text-slate-400 group-hover:text-white/90"></ion-icon>
    </div>
</div>


@endsection
