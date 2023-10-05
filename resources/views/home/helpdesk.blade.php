@extends('layouts.master')
@section('library')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
@endsection
@section('content')
    <div class="row py-5">


        <div class="col-11 border border-1 border-dark mx-auto" style="background-color: #AEFAA9">

            <div class="row">
                <div class="col-2">
                    <div class="pt-3">
                        <a href="/" class="btn btn-lg btn-primary">Home</a>
                    </div>
                </div>
                <div class="col-8 pt-4 text-center">
                    <h2>Helpdesk</h2>
                </div>
                <div class="text-center my-5">
                    <h2>Buat Tiket Insiden/Request</h2>
                    <a href="/create-tiket" class="btn btn-lg btn-primary">Create Ticket</a>
                </div>
            </div>
        </div>

        <div class="col-11 border border-1 border-dark mx-auto">

            <div class="row">
                <div class="text-center my-5">
                    <h2>Daftar Tiket Submitted</h2>
                    <table id="ticket-display" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Tipe Tiket</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Subkategori</th>
                                <th class="text-center">Item kategori</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Tipe Matriks/SLA</th>
                                <th class="text-center">Pembuat Tiket</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="text-center my-5">
                    <h2>Daftar Tiket Assigned</h2>
                    <table id="ticket-assigned" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Tipe Tiket</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Subkategori</th>
                                <th class="text-center">Item kategori</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Tipe Matriks/SLA</th>
                                <th class="text-center">Status Tiket</th>
                                <th class="text-center">Assigned Group</th>
                                <th class="text-center">Assigned Technical</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <script>
        $(document).ready(function() {
            var table = new DataTable('#ticket-display', {
                ajax: {
                    url: "/api/helpdesk-tiket-submitted/",
                    dataSrc: ''
                },
                info: true,
                paging: true,
                ordering: true,
                searching: true,
                columns: [{
                        data: 'nomor_tiket'
                    },
                    {
                        data: 'tipe_tiket'
                    },
                    {
                        data: 'kategori_tiket'
                    },
                    {
                        data: 'subkategori_tiket'
                    },
                    {
                        data: 'item_kategori_tiket'
                    },
                    {
                        data: 'judul_tiket'
                    },
                    {
                        data: 'tipe_matriks'
                    },
                    {
                        data: 'created_by'
                    },
                    {
                        data: null,
                        defaultContent: '<button class="btn btn-sm btn-primary">Detail</button>',
                        targets: -1
                    },
                ],
            })

            table.on('click', 'button', function(e) {
                // target klik di row berapa
                let data = table.row(e.target.closest('tr')).data();
                window.location = '/helpdesk/detail/' + data.id;

                // alert(data[5] + "'s status is: " + data[7]);
            });

            new DataTable('#ticket-assigned', {
                ajax: {
                    url: "/api/helpdesk-tiket-assigned/",
                    dataSrc: ''
                },
                info: true,
                paging: true,
                ordering: true,
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'tipe_tiket'
                    },
                    {
                        data: 'kategori_tiket'
                    },
                    {
                        data: 'subkategori_tiket'
                    },
                    {
                        data: 'item_kategori_tiket'
                    },
                    {
                        data: 'judul_tiket'
                    },
                    {
                        data: 'tipe_matriks'
                    },
                    {
                        data: 'status_tiket'
                    },
                    {
                        data: 'assigned_group'
                    },
                    {
                        data: 'assigned_technical'
                    },
                ],
            })
        })
    </script>
@endsection
