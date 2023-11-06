@extends('app')

@php
    use App\Enums\Urgency;
@endphp

@section('content')
    <form action="{{ route('create-request') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="subject" class="form-label">موضوع:</label>
            <input type="text" class="form-control" id="subject" name="subject" autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">توضیحات:</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <select class="form-select" name="urgency">
            @foreach (Urgency::values() as $value)
                <option {{ $loop->iteration == 1 ? 'selected' : '' }} value="{{ $value }}">
                    {{ Urgency::from($value)->getLabel() }}
                </option>
            @endforeach
        </select>
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
