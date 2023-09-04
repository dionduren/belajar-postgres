@extends('layouts.master')
@section('content')
    <div class="row pt-5">

        <div class="col-11 mx-auto" style="background-color: #AEFAA9">

            <div class="row">
                <div class="col-2 pt-3">
                    <a href="/" class="btn btn-lg" style="background-color:#2D50A0;color:white">Home</a>
                </div>
                <div class="col-8 pt-4 text-center">
                    <h3>Detail Ticket - Helpdesk</h3>
                </div>
                {{-- <div class="col pt-3 text-end">

                    <button type="button" class="btn btn-lg btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Assign Ticket</a></li>
                        <li><a class="dropdown-item" href="#">Solve</a></li>

                    </ul>

                </div> --}}

                <div class="row mt-5 ms-2 mb-3">
                    <table class="fs-4">
                        <tr>
                            <td class="fw-bold" width="30%">Ticket No.</td>
                            <td width="5%">:</td>
                            <td width="65%" id="ticket_no"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Judul</td>
                            <td>:</td>
                            <td id="judul_tiket"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Kategori</td>
                            <td>:</td>
                            <td id="kategori_tiket"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Sub-kategori</td>
                            <td>:</td>
                            <td id="subkategori_tiket"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Prioritas Tiket</td>
                            <td>:</td>
                            <td id="matriks_tiket"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Pembuatan Ticket</td>
                            <td>:</td>
                            <td id="created_at"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Response Ticket</td>
                            <td>:</td>
                            <td id="updated_at"></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-11 mx-auto shadow p-3 bg-body">
                <div class="row">
                    <div class="col-6 text-center">
                        <a href="#" class="btn btn-lg fw-bold text-light"
                            style="width: 80%; background-color:#6BDD63;color:white">SOLVE
                            TICKET</a>
                    </div>
                    <div class="col-6 text-center">
                        <a id="assign_button" class="btn btn-lg fw-bold text-light"
                            style="width: 80%; background-color:#2D50A0;color:white" data-bs-toggle="modal"
                            data-bs-target="#assignWindow" data-bs-whatever="{{ $tiket_id }}">ASSIGN
                            TICKET</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="assignWindow" tabindex="-1" aria-labelledby="assignWindowLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignWindowLabel">Assign Ticket Helpdesk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Pilih Grup</label>
                                <select class="form-control" id="grup_technical" name="grup_technical">

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_team_lead" class="col-form-label">Team Lead</label>
                                <input class="form-control" id="nama_team_lead" readonly>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="assign_ticket()">Assign</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-11 mx-auto shadow p-3 mb-5" style="background-color: rgb(212, 244, 255)">
                <div class="col-11 mx-auto shadow p-3 mb-5 bg-body rounded">
                    <label for="detail_tiket" class="fs-3 fw-bold">Detail Tiket</label>
                    <div id="detail_tiket" class="fs-4 mb-5">

                    </div>
                    <label for="detail_tiket" class="fs-3 fw-bold">Attachment(s)</label>
                    <div class="mb-5"></div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var id_tiket = {{ $tiket_id }};
                // alert(id_tiket);

                $.ajax({
                    url: "/api/helpdesk-tiket-detail/" + id_tiket,
                    method: "GET",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#ticket_no').append(data.id);
                        $('#judul_tiket').append(data.judul_tiket);
                        $('#kategori_tiket').append(data.kategori_tiket);
                        $('#subkategori_tiket').append(data.subkategori_tiket);
                        $('#matriks_tiket').append(data.tipe_matriks);
                        js_date_str = data.created_at.substr(0, 10) + ' ' + data.created_at.substr(11, 8);
                        $('#created_at').append(js_date_str);
                        js_date_str = data.updated_at.substr(0, 10) + ' ' + data.updated_at.substr(11, 8);
                        $('#updated_at').append(js_date_str);


                        $('#detail_tiket').append(data.detail_tiket);
                    }
                })

                $('#assign_button').click(function() {
                    get_group();
                });


                $('#grup_technical').change(function() {
                    var selected = $(this).find('option:selected');
                    var nama_leader = selected.data('leader');
                    $('#nama_team_lead').val(nama_leader);

                });
            })

            function get_group() {
                $.ajax({
                    url: "/api/technical-group-list/",
                    method: "GET",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#grup_technical').empty();
                        $('#nama_team_lead').empty();

                        $('#grup_technical').append('<option value="">Pilih Grup</option>');

                        $.each(data, function(key, value) {
                            $('#grup_technical').append('<option value="' + value.id + '" data-leader="' +
                                value.nama_team_lead + '">' + value
                                .nama_group + '</option>');
                        });
                    }
                })
            }

            function assign_ticket() {
                var id_tiket = {{ $tiket_id }};
                var id_group = $('#grup_technical').find('option:selected').val();
                var nama_group = $('#grup_technical').find('option:selected').text();

                $.ajax({
                    url: "/api/tiket-assign-group",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id_tiket: id_tiket,
                        id_group: id_group,
                        nama_group: nama_group,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log('success');
                        window.location.href = '/helpdesk'; // Redirect to helpdesk home page
                    }
                })

            }
        </script>
    @endsection
