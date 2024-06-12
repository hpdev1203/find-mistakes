@extends('layouts.master')

@section('title', 'Mini Game | Find Mistakes')

@section('content')
<div class="bg-orange-50 rounded-xl py-6 m-auto md:px-4 lg:px-8 mt-20 h-full content-center">
    @livewire('find-mistake')
</div>
@endsection