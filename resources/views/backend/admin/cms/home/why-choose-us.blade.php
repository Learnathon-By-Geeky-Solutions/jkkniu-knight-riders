@extends('backend.admin.app')
@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="p-10 pt-4">
            <div class="bg-white shadow-sm rounded-lg p-4 text-dark pl-5">
                <h2 class="h5 fw-semibold mb-4 text-center">Home Banner Why Choose Us Section</h2>
                <!-- success message -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <form action="{{ route('cms.home.banner.why-choose-us.update') }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                    <!-- Title -->
                    <div class="col-12">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $why_choose_us->title }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea type="text" name="description" class="form-control" id="ckeditor" rows="5">{{ $why_choose_us->description }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Btn Text -->
                    <div class="col-12">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="btn_text" class="form-control" value="{{ $why_choose_us->btn_text }}">
                        @error('btn_text')
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
<script>
    ClassicEditor
        .create( document.querySelector( '#ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
