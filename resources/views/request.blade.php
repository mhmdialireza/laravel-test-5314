@extends('app')

@php
    use App\Enums\Importance;
@endphp

@section('content')
    <div>
        <div>
            <span>موضوع درخواست:</span>
            <span>{{ $request->subject }}</span>
        </div>
        <div>
            <span>فوریت:</span>
            <span>{{ Importance::from($request->imspanortance)->getLabel() }}</span>
        </div>
        <div>
            <span>توضیحات:</span>
            <span>{{ $request->description }}</span>
        </div>

        @foreach ($request->files as $file)
            @if ($file->type == 'png')
                <img src="{{ asset($file->path) }}" alt="">
            @elseif ($file->type == 'mp3')
                <audio controls>
                    <source src="{{ asset($file->path) }}" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>
            @elseif($file->type == 'mp4')
                <video width="320" height="240" controls>
                    <source src="{{ asset($file->path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
        @endforeach
    </div>

    @if ($request->has_supervisor_approved == 1)
        <p class="text-success">توسط سرپرست تایید شده است.</p>
    @endif
    @if ($request->has_manager_approved == 1)
        <p class="text-success">توسط مدیر تایید شده است.</p>
    @endif

    @if (auth()->user()->role == 1 && $request->has_supervisor_approved == 0)
        <form method="post" action="{{ route('supervisor-approve-request', $request->id) }}">
            @method('put')
            @csrf
            <button type="submit" class="btn btn-primary">تایید
                سرپرست</button>
        </form>
    @elseif (auth()->user()->role == 2 && $request->has_manager_approved == 0 && $request->has_supervisor_approved == 1)
        <form method="post" action="{{ route('manager-approve-request', $request->id) }}">
            @method('put')
            @csrf
            <button type="submit" class="btn btn-primary">تایید
                مدیر</button>
        </form>
    @elseif (auth()->user()->role == 2 && $request->has_manager_approved == 0 && $request->has_supervisor_approved == 0)
        <p class="text-danger">نیاز به تایید سرپرست</p>
    @endif
@endsection
