@extends('backend.admin.app')
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css">
    <style>
        .dropify-wrapper {
            text-align: center !important;
        }

        .dropify-preview {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dropify-render img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
        }
    </style>
@endpush
@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="p-10 pt-4">
            <div class="bg-white shadow-sm rounded-lg p-4 text-dark pl-5">
                <h2 class="h5 fw-semibold mb-4 text-center">ADD Department</h2>
                <!-- success message -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <form action="{{ route('medical.departments.index') }}" method="POST" class="row g-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Title -->
                    <div class="col-12">
                        <label class="form-label">Department Name</label>
                        <input type="text" name="title" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label class="form-label">Department Description</label>
                        <textarea type="text" name="description" class="form-control" id="ckeditor" rows="5"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Banner Image -->
                    <div class="col-12">
                        <label class="form-label">Department Banner Image</label>
                        <input name="image" type="file" class="dropify" class="form-control"
                            data-default-file="" />
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#ckeditor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
