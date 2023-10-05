@extends('layouts.master')
@section('content')
    <div class="row pt-5">

        <div class="col-11 mx-auto" style="background-color: #FFE482">

            <div class="row">
                <div class="col-2 pt-3">
                    <a href="/" class="btn btn-lg" style="background-color:#2D50A0;color:white">Home</a>
                </div>
                <div class="col-8 pt-4 text-center">
                    <h3>Detail Ticket - Team Lead</h3>
                </div>
            </div>

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
                    <a href="#" class="btn btn-lg fw-bold"
                        style="width: 80%;background-color:#F4F8FF;color:#7A8CAC">ASSIGN GRUP
                        LAIN</a>
                </div>
                <div class="col-6 text-center">
                    <a id="assign_button" class="btn btn-lg fw-bold"
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
                            <label for="recipient-name" class="col-form-label">Pilih Teknisi</label>
                            <select class="form-control" id="technical" name="technical">

                            </select>
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
                get_technical(id_tiket);
            });

        })

        function get_technical(id) {
            $.ajax({
                url: "/api/technical-list/" + id,
                method: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#technical').empty();

                    $('#technical').append('<option value="">Pilih Teknisi</option>');

                    $.each(data, function(key, value) {
                        $('#technical').append('<option value="' + value.nik_member + '">' + value
                            .nama_member + '</option>');
                    });
                }
            })
        }

        function assign_ticket() {
            var id_tiket = {{ $tiket_id }};
            var id_technical = $('#technical').find('option:selected').val();
            var nama_technical = $('#technical').find('option:selected').text();

            $.ajax({
                url: "/api/tiket-assign-technical",
                method: "POST",
                dataType: "json",
                data: {
                    id_tiket: id_tiket,
                    id_technical: id_technical,
                    nama_technical: nama_technical,
                    nik: 121003,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log('success');
                    window.location.href = '/teamlead/121003'; // Redirect to helpdesk home page
                }
            })

        }
    </script>
@endsection
