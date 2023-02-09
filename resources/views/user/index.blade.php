@extends('layouts.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables/datatables.min.css') }}" />
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url()->full() }}",
                pageLength: 25,
                autoWidth: false,
                scrollX: "100%",
                scrollCollapse: false,
                columnDefs: [{
                        targets: [0, 2, 3, ],
                        className: "text-center",
                    },
                    {
                        targets: 0,
                        width: "15px"
                    },
                ],
                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        title: '#',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        title: 'Nama'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        title: 'Email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        title: 'Aksi',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
@section('content-header-left')
    Management Pengguna
@endsection
@section('content-header-right')
    <a class="btn btn-sm btn-primary modal-button float-right" href="Javascript:void(0)" data-target="ModalForm" data-url="{{ action('UserController@create') }}" data-toggle="tooltip" data-placement="top" title="Edit">Tambah</a>
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <table class="table table-striped" id="dataTable">
                    </table>

                </div>
            </div><!-- /.card -->
        </div>
    </div>
@endsection
