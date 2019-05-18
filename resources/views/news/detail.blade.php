@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $news->title }}</div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            {{ $news->description }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right pt-5">
                            <a href="/" class="">Back to home</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.modal_delete')
@endsection

