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

                    <p class="card-text">
                        Hostname: {{ optional($hostname)->fqdn }} <br>
                        Website: {{ $website->uuid }} <br>

                        Roles: @json($user->getRoleNames())
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
