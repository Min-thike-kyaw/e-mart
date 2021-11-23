@extends('frontend.layouts.master')

@section('content')
<div style="background: #DDD" class="py-4">
    <div class="container " >
        <h2 style="font-size: 45px"><b>Home>User</b></h2>

    </div>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-5">
            @include('frontend.user.sidebar')
        </div>

        <div class="col-7">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                  <h5 class="card-title">Dashboard</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="card-link">Card link</a>
                  <a href="#" class="card-link">Another link</a>
                </div>
              </div>

        </div>
    </div>
</div>

@endsection
