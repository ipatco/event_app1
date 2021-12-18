@extends('web')
@section('title', 'Events')

@section('css')
@endsection

@section('page')

@if (count($events) > 0)
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
    <h1 class="h3 mb-0 text-gray-800">Events</h1>
</div>
<div class="row">
    {{-- Events --}}
    @foreach ($events as $event)
    <div class="col-xl-3 col-lg-3 col-12 col-sm-6 col-md-4 showbtn">
        <div class="card shadow mb-4">
            <img class="img-fluid m-3 imgg" src="{{ asset('uploads/events/'.$event->image) }}" alt="">
            <div class="detail-btn">
                <a href="{{ route('event.detail', $event->slug) }}" class="btn btn-primary btn-sm center-of-card-img">Detail</a>
            </div>
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1 trim-text">{{ $event->title }}</div>
                        @if($event->price == 0)
                            <div class="h5 mb-0 font-weight-bold text-gray-800 mb-2">Free</div>
                        @else
                            <div class="h5 mb-0 font-weight-bold text-gray-800 mb-2">${!! ($event->sale_price > 0) ? '<s class="mr-3">'.$event->price.'</s>' . '$'.$event->sale_price : $event->price !!} per Ticket</div>
                        @endif
                        @if($event->start_date == $event->end_date)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $event->start_date }}</div>
                        @else
                            <div class="text-sm mb-0 font-weight-bold text-gray-800"><i class="fas fa-calendar-alt"></i> {{ $event->start_date . ' - ' . $event->end_date }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection

@section('js')
@endsection
