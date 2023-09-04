@extends('layouts.master')
@section('library')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
@endsection
@section('content')
    <div class="row py-5">

        <div class="col-11 border border-1 border-dark mx-auto"
            style="background-image: linear-gradient(to right, #2D4F9F, #3281BC);">

            <div class="row">
                <div class="col-2">
                    <div class="pt-3">
                        <a href="/" class="btn btn-lg btn-primary">Home</a>
                    </div>
                </div>
                <div class="col-8 pt-4 text-center text-light">
                    <h2>User</h2>
                </div>
                <div class="text-center my-5">
                    <h2 class="text-light">Buat Tiket Insiden/Request</h2>
                    <a href="/create-tiket" class="btn btn-lg btn-primary">Create Ticket</a>
                </div>
            </div>

        </div>

        <div class="col-11 border border-1 border-dark mx-auto">

            <div class="row">
                <div class="text-start my-5">
                    <h2>Daftar Tiket Anda</h2>
                    <table id="ticket-display" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Tipe Tiket</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Subkategori</th>
                                <th class="text-center">Item kategori</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Status Tiket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftar_tiket as $tiket)
                                <tr>
                                    <td>TO BE DETERMINED</td>
                                    <td>{{ $tiket->tipe_tiket }}</td>
                                    <td>{{ $tiket->kategori_tiket }}</td>
                                    <td>{{ $tiket->subkategori_tiket }}</td>
                                    <td>
                                        @if ($tiket->item_kategori_tiket != null)
                                            {{ $tiket->item_kategori_tiket }}
                                        @else
                                            <div class="text-center">
                                                -
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $tiket->judul_tiket }}</td>
                                    {{-- @if ($tiket->tipe_matriks == 'LOW')
                                        <td class="text-light fw-bold text-center" style="background-color: green">
                                            {{ $tiket->tipe_matriks }}
                                        </td>
                                    @elseif ($tiket->tipe_matriks == 'MEDIUM')
                                        <td class="text-dark fw-bold text-center" style="background-color: yellow">
                                            {{ $tiket->tipe_matriks }}
                                        </td>
                                    @else
                                        <td class="text-light fw-bold text-center" style="background-color: red">
                                            {{ $tiket->tipe_matriks }}
                                        </td>
                                    @endif --}}
                                    <td class="text-center">
                                        {{ $tiket->status_tiket }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#ticket-display').DataTable();
        })
    </script>
@endsection
