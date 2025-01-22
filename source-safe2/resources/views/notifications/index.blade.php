@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: -20px;">

     <!-- زر تحديد الكل كمقروء -->
     <form action="{{ route('markAllAsRead') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-sm btn-success">تحديد الكل كمقروء</button>
        
    </form>
<div><br>
</div>
    <ul class="list-group">
        @forelse ($notifications as $notification)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $notification->data['title'] }}</strong>
                    <p class="mb-0">{{ $notification->data['message'] }}</p>
                </div>
                <a href="{{ $notification->data['url'] }}" class="btn btn-primary btn-sm">عرض التفاصيل</a>
            </li>

            <br>
        @empty
            <li class="list-group-item text-center">لا توجد إشعارات جديدة.</li>
        @endforelse
    </ul>
</div>
@endsection
