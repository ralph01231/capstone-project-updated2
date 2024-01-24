@extends('layouts.app')


@section('header')

@section('title')
@endsection

@endsection

@section('content')
<div class="wrapper">

    {{-- sidebar here --}}

    @include('layouts.admin_sidebar')

    <div class="main">

        @include('layouts.admin_nav')
        {{-- navigation bar --}}

        <main class="content px-3 py-2">

            <div class="container-fluid mt-3">
                <div class="row ">
                    <div class="col-12 text-start">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route('admin_dashboard') }}" class="text-muted"> Dashboard   > </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route('users.index') }}" class="text-muted"> Accepted Reports </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container-fluid ">
                <div class="card">
                    <div class="card-header">
                        <h3>Accepted Reports</h3>
                    </div>
                    <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered" id="accptreport-table">
                                <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Timestamp</th>
                                        <th>Emergency Type</th>
                                        <th>Resident Name</th>
                                        <th>Location</th>
                                        <th class="no-export text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                    </div>
                </div>
            </div>


        </main>

        <!-- Modal -->
       
        <!--End modals-->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-start">
                        <p class="mb-0">
                            <a href="#" class="text-muted">
                                <strong>E-Ligtas</strong>
                            </a>
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">Contact</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">About Us</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">Terms</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</div>
@endsection

@section('scripts')


<script>
    $(document).ready(function() {
        var hotlinesTable = $('#accptreport-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "{{ route('accepted_reports') }}",
                "data": function(d) {
                    if (d.buttons) {
                        d.action = 'export';
                    }
                }
            },
            "columns": [{
                    data: 'report_id',
                    name: 'report_id'
                },
                {
                    data: 'dateandTime',
                    name: 'dateandTime'
                },
                {
                    data: 'emergency_type',
                    name: 'emergency_type'
                },
                {
                    data: 'resident_name',
                    name: 'resident_name'
                },
                {
                    data: 'locationName',
                    name: 'locationName'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                                <a href="#" class="text-success dropdown-item edit-hotline" data-bs-toggle="modal" data-bs-target="#updateContactModal" data-id="${row.reports}">
                                    <i class="bi bi-pencil-square w-2"></i>
                                    view
                                </a>
                    `;
                    },
                    orderable: false
                }
            ],
            buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                }
            ],
            "scrollY": "400px",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "paging": true,
            "lengthChange": true,
            "dom": '<"d-flex justify-content-between align-items-center mb-5"lB<"d-flex align-items-center">f>t<"d-flex justify-content-end mt-3">p',
        });

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
</script>

@endsection
