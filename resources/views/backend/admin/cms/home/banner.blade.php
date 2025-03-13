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
                <h2 class="h5 fw-semibold mb-4 text-center">CMS Site Information</h2>

                <form action="" method="POST" class="row g-3" enctype="multipart/form-data">
                    @csrf

                    <!-- Site Name -->
                    <div class="col-12">
                        <label class="form-label">Title</label>
                        <input type="text" name="site_name" class="form-control" required>
                    </div>

                    <!-- Address -->
                    <div class="col-12">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="address" class="form-control">
                    </div>

                    <!-- Banner Image -->
                    <div class="col-12">
                        <label class="form-label">Banner Image</label>
                        <input name="file1" type="file" class="dropify" class="form-control" />
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
@endpush
