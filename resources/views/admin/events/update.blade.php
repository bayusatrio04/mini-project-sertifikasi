@extends('layouts.app-admin')

@section('title', 'Update Event')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/filter_multi_select.css') }}">
    <div class="container mt-5">
        <h2>Update Event</h2>

        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" value={{ $event->title }} name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" value={{ $event->description }}rows="3" required></textarea>

                {{-- <textarea name="description" id="editor" class="form-control"  rows="4" cols="50" required></textarea> --}}

            </div>

            <div class="mb-3" >
                <label for="Type Category" class="form-label">Termasuk dalam  <span class="fw-bold"> Category</span> apa?</label>
                <select multiple name="category_events[]" id="languages" class="form-control">
                    @foreach ($categories as $category )

                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach


                </select>
            </div>



            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="datetime-local" class="form-control" value={{ $event->start_date }} id="start_date" name="start_date" required>
                    </div>

                </div>
                <div class="col-md-6">
                 <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="datetime-local" class="form-control" id="end_date" value={{ $event->end_date }} name="end_date" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" value={{ $event->location }} name="location" required>
            </div>
            <div class="mb-3">
                <label for="ticket_price" class="form-label">Ticket Price</label>
                <input type="number" class="form-control" id="ticket_price"  value={{ $event->ticket_price }} name="ticket_price" required>
            </div>
            <div class="mb-3">
                <label for="total_tickets" class="form-label">Total Tickets</label>
                <input type="number" class="form-control" id="total_tickets" name="total_tickets" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" value={{ $event->image_path }} id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>
    </div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



<script src="{{ asset('assets/js/filter-multi-select-bundle.min.js') }}"></script>

<script>
    const languages = $('#languages').filterMultiSelect();


  </script>

@endsection
