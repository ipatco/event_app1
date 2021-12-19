@extends('web')
@section('title', $service->title)

@section('css')
@endsection

@section('page')

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary m-auto h2">{{ $service->title }}</h6>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p>{{ $service->description }}</p>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <h6><span class="dlbl">Service Category:
                                        </span>{{ $service->category->name }}</h6>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <h6><span class="dlbl">Service Price:</span>
                                        @if($service->price == 0)
                                            Free
                                        @else
                                            ${{ ($service->sale_price > 0) ? $service->sale_price : $service->price }}  {{ $service->sale_price_type }}
                                        @endif
                                        @if($service->booking_status == 1)
                                            <a href="{{ route('service.booking', $service->id) }}" class="btn btn-primary">
                                                Book this service
                                            </a>
                                        @else
                                            <div class="alert alert-danger">
                                                <strong>Booking is not available for this service</strong>
                                            </div>
                                            <a href="#" class="btn btn-primary" disabled>
                                                Book this service
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset('uploads/services/'.$service->image) }}" class="img-fluid mb-4 w-100" alt="">
                                @if($service->video != '')
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $service->video }}" allowfullscreen></iframe>
                                    </div>
                                @endif
                            </div>
                        </div>


                    </div>


                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
@endsection
