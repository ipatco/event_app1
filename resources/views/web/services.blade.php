@extends('web')
@section('title', 'Services')

@section('css')
@endsection

@section('page')

@if (count($services) > 0)
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
    <h1 class="h3 mb-0 text-gray-800">Services dddd</h1>
</div>
<div class="row">
    {{-- services --}}
    @foreach ($services as $service)
    <div class="col-xl-3 col-lg-3 col-12 col-sm-6 col-md-4 showBtns">
        <div class="card shadow mb-4">
            <img class="img-fluid m-3 imgg" src="{{ asset('uploads/services/'.$service->image) }}" alt="">
            <div class="detail-btn">
                <a href="{{ route('service.detail', $service->slug) }}" class="btn btn-primary btn-sm center-of-card-img">Detail</a>
            </div>
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1 trim-text">{{ $service->title }}</div>
                        @if($service->price == 0)
                            <div class="h5 mb-0 font-weight-bold text-gray-800 mb-2">Free</div>
                        @else
                            <div class="h5 mb-0 font-weight-bold text-gray-800 mb-2">${!! ($service->sale_price > 0) ? '<s class="mr-3">'.$service->price.'</s>' . '$'.$service->sale_price : $service->price !!}  {{ $service->sale_price_type }}</div>
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
