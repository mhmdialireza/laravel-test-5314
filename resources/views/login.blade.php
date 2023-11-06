@extends('app')

@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">نام کاربری:</label>
            <input type="text" class="form-control" id="username" name="username" autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">رمز عبور:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
