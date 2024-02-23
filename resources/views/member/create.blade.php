@extends('layouts.app')

@section('title', 'Create a member')

@section('content')
    <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
        @csrf


        <br>
        <input type="submit" value="Create">
    </form>
@endsection
