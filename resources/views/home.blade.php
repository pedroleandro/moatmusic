@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Artists') }}</div>

                <div class="card-body">

                    @foreach($artists as $artist)
                        <p>{{ $artist['name'] }}</p>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
