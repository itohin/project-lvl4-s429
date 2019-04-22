@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

mysql://b7ccf6260da766:af398bc8@eu-cdbr-west-02.cleardb.net/heroku_503826743251117?reconnect=true

eu-cdbr-west-02.cleardb.net
b7ccf6260da766
af398bc8
heroku_503826743251117
