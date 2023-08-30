@extends('layouts.master')
@section('content')
    <div class="row py-5">
        <div class="col-11 border border-1 border-dark mx-auto">

            <div class="row mb-3">
                <label for="kategori_tiket">Kategori Tiket</label>
                <div class="col">
                    <select class="form-control" name="kategori_tiket" id="kategori_tiket">
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="subkategori_tiket">Subkategori Tiket</label>
                <div class="col">
                    <select class="form-control" name="subkategori_tiket" id="subkategori_tiket">
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="judul">Judul Tiket</label>
                <div class="col">
                    <input type="text" class="form-control" name="judul_tiket" id="judul_tiket">
                </div>
            </div>

            <div class="row mb-3">
                <label for="detail_tiket">Detail Tiket</label>
                <div class="col">
                    <textarea type="text" class="form-control" name="detail_tiket" id="detail_tiket" rows="5"></textarea>
                </div>
            </div>

            <div class="row pb-3 mx-auto text-center">
                <a href="/create-ticket" class="btn btn-lg btn-primary" style="width: 100%">Submit Ticket</a>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "/api/kategori-list/",
                method: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    //
                    $('#kategori_tiket').empty();

                    $.each(data, function(key, value) {
                        $('#kategori_tiket').append('<option value="' + value.id + '">' + value
                            .nama_kategori + '</option>');
                    });

                    get_subcat(1);
                }
            })

            $('#kategori_tiket').change(function() {
                var id_kategori = $(this).val();

                get_subcat(id_kategori);
            })
        });

        function get_subcat(id) {
            $.ajax({
                url: "/api/subkategori-list/" + id,
                method: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    //
                    $('#subkategori_tiket').empty();

                    $.each(data, function(key, value) {
                        $('#subkategori_tiket').append('<option value="' + value
                            .id +
                            '">' + value
                            .nama_subkategori + '</option>');
                    });
                }
            })
        }
    </script>
@endsection
