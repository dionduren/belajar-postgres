@extends('layouts.master')
@section('content')
    <div class="row py-5">

        <div class="col-6 border border-1 border-dark mx-auto">

            <div class="row mb-3">
                <label for="judul">Judul TIket</label>
                <div class="col">
                    <input type="text" class="form-control" name="judul_tiket" id="judul_tiket">
                </div>
            </div>
            
            <div class="row mb-3">
              <label for="judul">Detaikl TIket</label>
              <div class="col">
                  <input type="text" class="form-control" name="judul_tiket" id="judul_tiket">
              </div>
          </div>

            <div class="row">
                <div class="col">
                    <a href="/create-ticket" class="btn btn-lg btn-primary">Submit Ticket</a>
                </div>
            </div>
        </div>

    </div>
@endsection
