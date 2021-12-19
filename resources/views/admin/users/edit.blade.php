@extends('admin')
@section('title', 'Edit Event')

@section('css')
@endsection


@section('page')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Event</h1>
        <a href="{{ route('admin.events') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>
            Back
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Event</h6>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.events.update', ['id'=>$event->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $event->title }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $event->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="text" class="form-control" id="start_date" name="start_date" value="{{ $event->start_date }}">
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="text" class="form-control" id="end_date" name="end_date" value="{{ $event->end_date }}">
                </div>
                <div class="form-group">
                    <label for="location">Venue Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Venue Location" value="{{ $event->location }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ $event->price }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                        <option value="">Select Category</option>
                        @if(count($categories) > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="organizer_name">Organizer Name</label>
                    <input type="text" class="form-control" id="organizer_name" name="organizer_name" placeholder="Organizer Name" value="{{ $event->o_name }}">
                </div>
                <div class="form-group">
                    <label for="organizer_phone">Organizer Phone</label>
                    <input type="text" class="form-control" id="organizer_phone" name="organizer_phone" placeholder="Organizer Phone" value="{{ $event->o_phone }}">
                </div>
                <div class="form-group">
                    <label for="organizer_email">Organizer Email</label>
                    <input type="text" class="form-control" id="organizer_email" name="organizer_email" placeholder="Organizer Email" value="{{ $event->o_email }}">
                </div>
                <div class="form-group">
                    <label for="organizer_website">Organizer Website</label>
                    <input type="text" class="form-control" id="organizer_website" name="organizer_website" placeholder="Organizer Website" value="{{ $event->o_website }}">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $event->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
