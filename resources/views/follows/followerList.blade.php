@extends('layouts.login')

@section('content')
@foreach ($followers as $user)
    <p>{{ $user->name }}</p>
@endforeach
@endsection
