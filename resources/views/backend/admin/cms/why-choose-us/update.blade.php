@extends('backend.admin.app')
@section('title', 'CMS | Home')
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style settings-card-1 mb-30">
                    <div class="profile-info">
                        <div class="card card-body mt-4">
                            <h2 class="h5 fw-semibold mb-4 text-center">Update Why Choose Us Card</h2>
                            <form method="post" action="{{ route('cms.home.why-choose-us.update', $choose->id ?? '') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mt-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" id="title" name="title"
                                        value="{{ old('title') ?? ($choose->title ?? '') }}" class="form-control"
                                        placeholder="Title">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="mt-3">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control">{{ old('description') ?? ($choose->description ?? '') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                {{-- <div class="mt-3">
                                    <label class="form-label" for="image">Icon</label>
                                    <input
                                        data-default-file="{{ isset($choose->image) ? asset($choose->image) : asset('backend/images/placeholder/image_placeholder.png') }}"
                                        type="file" class="dropify form-control" id="image" name="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}
        
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush