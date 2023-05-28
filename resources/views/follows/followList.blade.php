@extends('layouts.login')

@section('content')
@foreach ($following as $user)
    <p>{{ $user->name }}</p>
@endforeach
@endsection
