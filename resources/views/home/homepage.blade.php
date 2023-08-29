@extends('layouts.master')
@section('content')
    <div class="row py-5 border border-1 border-dark">

        <div class="col-12">
            <div class="mx-auto text-center">
                <h1 style="background: orange">PILIH MENU</h1>
            </div>
        </div>

        <div class="col-4 py-5 text-center border border-1 border-dark">
            <div class="mx-auto mb-5">
                <a href="/user" class="btn btn-lg btn-block btn-primary"> Masuk - User</a>
            </div>
            <div class="mx-auto">
                <a href="/vp-user" class="btn btn-lg btn-block btn-secondary"> Masuk - VP User</a>
            </div>
        </div>

        <div class="col-4 text-center py-5 border border-1 border-dark">
            <div class="mx-auto">
                <a href="/helpdesk" class="btn btn-lg btn-block btn-success"> Masuk - Helpdesk</a>
            </div>
        </div>

        <div class="col-4 text-center py-5 border border-1 border-dark">
            <div class="mx-auto mb-5">
                <a href="/team-lead" class="btn btn-lg btn-block btn-warning"> Masuk - Team Lead</a>
            </div>
            <div class="mx-autoo">
                <a href="/technical" class="btn btn-lg btn-block btn-warning"> Masuk - Teknisi/Engineer</a>
            </div>
        </div>

    </div>
@endsection
