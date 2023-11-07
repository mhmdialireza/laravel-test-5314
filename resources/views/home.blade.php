@extends('app')

@php
    use App\Enums\Urgency;
    use Morilog\Jalali\Jalalian;
@endphp

@section('content')
    <div>
        <a href="{{ route('logout') }}" type="button" class="btn btn-danger">خروج</a>
        <a href="{{ route('create-request-form') }}" type="button" class="btn btn-success">درخواست جدید</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">تاریخ ثبت نام</th>
                <th scope="col">درخواست کننده</th>
                <th scope="col">موضوع درخواست</th>
                <th scope="col">فوریت</th>
                <th scope="col">سرپرست</th>
                <th scope="col">مدیرعامل</th>
                @if (auth()->user()->role != 0)
                    <th scope="col">عملیات</th>
                @endif

            </tr>
        </thead>
        <tbody class="table-group-divider">
            @forelse ($requests as $request)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ Jalalian::fromCarbon($request->created_at)->format('Y/m/d') }}</td>
                    <td>{{ $request->user->username }}</td>
                    <td>{{ $request->subject }}</td>
                    <td>{{ Urgency::from($request->importance)->getLabel() }}</td>
                    <td>{{ $request->has_supervisor_approved == false ? '-' : '✅' }}</td>
                    <td>{{ $request->has_manager_approved == false ? '-' : '✅' }}</td>
                    @if (auth()->user()->role != 0)
                        <td><a href="{{ route('show-request', $request->id) }}" type="button"
                                class="btn btn-primary">مشاهده</a></td>
                    @endif
                </tr>
            @empty
                <p>هیچ درخواستی وجود ندارد.</p>
            @endforelse
        </tbody>
    </table>
    {{ $requests->links() }}
@endsection
