@extends('layouts.app')

@section('content')
<div class="welcome-header">
    Welcome to Home Page
</div>

@can('manage-users')
    <a href="{{ route('users.index') }}">إدارة المستخدمين</a>
@endcan
@endsection 