@extends('operator.layout.app')
@section('title', 'Akun')
@section('content')
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-custom">
                    <div class="table-responsive">
                        <table class="table" id="users-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('libs/table/datatable/datatables-light.css') }}">
    <!-- DataTables CSS -->
@endpush

@push('script')
    <script src="{{ asset('libs/table/datatable/datatables.js') }}"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('operator.akun.data') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'id',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                        <a href="/users/${data}/edit" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                        <button class="btn btn-sm btn-danger" onclick="deleteUser(${data})">
                            Hapus
                        </button>
                    `;
                        }
                    }
                ]
            });
        });
    </script>
@endpush
