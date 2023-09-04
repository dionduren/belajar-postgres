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
                <div class="col-6">

                </div>
                <div class="col-6 text-center">
                    <a id="solve_button" class="btn btn-lg fw-bold" style="width: 80%; background-color:#6BDD63;color:white"
                        data-bs-toggle="modal" data-bs-target="#solveWindow">SOLVE
                        TICKET</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="solveWindow" tabindex="-1" aria-labelledby="solveWindowLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="solveWindowLabel">Solve Ticket Helpdesk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Pilih Solusi</label>
                        <select class="form-control" id="solution" name="solution">
                        </select>
                    </div>

                    <div class="mb-3" id="judul_solusi_div" style="display: none">
                        <label for="recipient-name" class="col-form-label">Judul Solusi</label>
                        <input type="text" class="form-control" id="judul_solusi" name="judul_solusi">
                        </select>
                    </div>

                    <div class="mb-3" id="detail_solusi_div" style="display: none">
                        <label for="recipient-name" class="col-form-label">Penjelasan Solusi</label>
                        <textarea class="form-control" id="detail_solusi" name="detail_solusi" rows="5"></textarea>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="solve_tiket()">Solve</button>
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

                    // $('#id_item_kategori').val(data.id_item_kategori);
                    // $('#item_kategori_tiket_popup').val(data.item_kategori_tiket);


                    $('#detail_tiket').append(data.detail_tiket);
                }
            })

            $('#solve_button').click(function() {
                get_solution(id_tiket);
            });

            $('#solution').change(function() {
                var choice = $(this).val();

                // alert(choice);

                if (choice == 999) {
                    $('#judul_solusi_div').show();
                    $('#detail_solusi_div').show();
                } else {
                    $('#judul_solusi_div').hide();
                    $('#detail_solusi_div').hide();
                }

            });

        })

        function get_solution(id) {
            $.ajax({
                url: "/api/solution-list/" + id,
                method: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    $('#solution').empty();

                    $('#solution').append('<option value="">Pilih Solusi</option>');
                    $('#solution').append('<option value="999">Buat Solusi Baru</option>');

                    $('#judul_solusi_div').hide();
                    $('#detail_solusi_div').hide();

                    $.each(data, function(key, value) {
                        $('#solution').append('<option value="' + value.id + '">' + value
                            .judul_solusi + '</option>');
                    });
                }
            })
        }

        function solve_tiket() {
            var id_tiket = {{ $tiket_id }};
            var id_solusi = $('#solution').find('option:selected').val();

            if (id_solusi == 999) {
                var judul_solusi = $('#judul_solusi').val();
                var detail_solusi = $('#detail_solusi').val();

                $.ajax({
                    url: "/api/submit-new-solution",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id_tiket: id_tiket,
                        judul_solusi: judul_solusi,
                        detail_solusi: detail_solusi,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log('success');
                        window.location.href = '/'; //Todo: Redirect to technical home page
                    }
                })
            } else {
                $.ajax({
                    url: "/api/submit-solution",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id_tiket: id_tiket,
                        id_solusi: id_solusi,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log('success');
                        window.location.href = '/'; //Todo: Redirect to technical home page
                    }
                })
            }
        }
    </script>
@endsection
