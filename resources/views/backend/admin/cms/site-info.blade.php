@extends('backend.admin.app')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endpush
@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="p-10 pt-4">
            <div class="bg-white shadow-sm rounded-lg p-4 text-dark pl-5">
                <h2 class="h5 fw-semibold mb-4 text-center">CMS Site Information</h2>

                <form action="" method="POST" class="row g-3">
                    @csrf

                    <!-- Site Name -->
                    <div class="col-12">
                        <label class="form-label">Site Name</label>
                        <input type="text" name="site_name" class="form-control" required>
                    </div>

                    <!-- Address -->
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control">
                    </div>

                    <!-- Copyright Text -->
                    <div class="col-12">
                        <label class="form-label">Copyright Text</label>
                        <input type="text" name="copyright_text" class="form-control">
                    </div>

                    <!-- Email -->
                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <!-- Phone -->
                    <div class="col-12">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <!-- Social Media Links (Dynamic) -->
                    <div class="col-12" x-data="{ socials: [{ name: '', link: '' }] }">
                        <label class="form-label">Social Media</label>

                        <template x-for="(social, index) in socials" :key="index">
                            <div class="d-flex gap-2 mt-2">
                                <select x-model="social.name" name="socials[][name]" class="form-select w-25">
                                    <option value="">Select Social</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="YouTube">YouTube</option>
                                </select>
                                <input type="url" x-model="social.link" name="socials[][link]"
                                    placeholder="Social Media Link" class="form-control flex-grow-1">
                                <button type="button" @click="socials.splice(index, 1)" class="btn btn-danger"
                                    x-show="socials.length > 1">Remove</button>
                            </div>
                        </template>

                        <button type="button" @click="socials.push({name: '', link: ''})" class="btn btn-primary mt-2">+
                            Add Social</button>
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
