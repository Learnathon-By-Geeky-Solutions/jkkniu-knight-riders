@extends('backend.admin.app')

@section('title', 'CMS | Why Choose Us Cards')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .swal2-confirm.custom-confirm-button,
        .swal2-cancel.custom-cancel-button {
            color: #fff !important;
            border: none !important;
            padding: 8px 20px !important;
            font-weight: 600 !important;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            border-radius: 4px !important;
        }

        .swal2-confirm.custom-confirm-button {
            background-color: #04AA6D !important;
        }

        .swal2-confirm.custom-confirm-button:hover {
            background-color: #04AA6D !important;
            transform: translateY(-1px);
        }

        .swal2-cancel.custom-cancel-button {
            background-color: #f72213 !important;
        }

        .swal2-cancel.custom-cancel-button:hover {
            background-color: #e61e0d !important;
            transform: translateY(-1px);
        }

        /* Keep spacing between buttons */
        .swal2-actions .custom-confirm-button {
            margin-right: 10px;
        }

        .swal2-actions .swal2-styled {
            display: inline-block !important;
        }



        /* Toastr customization */
        .toast {
            font-size: 14px;
            padding: 15px;
        }

        .toast-success {
            background-color: #28a745 !important;
        }

        .toast-error {
            background-color: #dc3545 !important;
        }

        #toast-container>.toast {
            min-width: 300px;
        }

        /* Table styling */
        .table-responsive {
            overflow-x: auto;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <h2 class="h5 fw-semibold mb-4 text-center">Why Choose Us Cards</h2>
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('cms.home.why-choose-us.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add New
                            </a>
                        </div>
                        <div class="table-responsive mt-4 p-4">
                            <table class="table table-hover" id="data-table" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">SI</th>
                                        <th width="20%">Title</th>
                                        <th width="45%">Description</th>
                                        <th width="15%">Status</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000"
        };

        $(document).ready(function() {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('cms.whyChooseUs') }}',
                    type: 'GET',
                    error: function(xhr, error, thrown) {
                        if (xhr.status === 500) {
                            showToast('error', 'Server error occurred. Please try again later.');
                        }
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true,
                language: {
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    lengthMenu: "Show _MENU_ entries",
                    loadingRecords: "Loading...",
                    processing: "Processing...",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                }
            });

            @if (Session::has('toast_success'))
                showToast('success', '{{ Session::get('toast_success') }}');
            @endif
            @if (Session::has('toast_error'))
                showToast('error', '{{ Session::get('toast_error') }}');
            @endif
        });


        function showStatusChangeAlert(id) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update the status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusChange(id);
                }
            });
        }

        function statusChange(id) {
            let url = "{{ route('cms.home.why-choose-us.status', ':id') }}".replace(':id', id);

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    $('#data-table').DataTable().ajax.reload();

                    if (response.success) {
                        showToast('success', response.message);
                    } else {
                        showToast('error', response.message || 'Status update failed');
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'An error occurred while updating status.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    showToast('error', errorMsg);
                }
            });
        }

        function showDeleteConfirm(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'custom-confirm-button',
                    cancelButton: 'custom-cancel-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id);
                }
            });
        }

        function deleteItem(id) {
            let url = "{{ route('cms.home.why-choose-us.destroy', ':id') }}".replace(':id', id);

            $.ajax({
                type: "DELETE",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#data-table').DataTable().ajax.reload();

                    if (response.success) {
                        Swal.fire(
                            'Deleted!',
                            response.message || 'Item deleted successfully.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error!',
                            response.message || 'Failed to delete item.',
                            'error'
                        );
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'An error occurred while deleting.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    Swal.fire(
                        'Error!',
                        errorMsg,
                        'error'
                    );
                }
            });
        }

        function showToast(type, message) {
            if (typeof toastr === 'undefined') {
                console.log(type + ': ' + message);
                return;
            }

            toastr[type](message);
        }
    </script>
@endpush
