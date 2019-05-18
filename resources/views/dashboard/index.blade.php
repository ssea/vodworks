@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">News Management</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right pb-2">
                            <a href="/news/create" class="btn btn-success">Add news</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive-md">
                                    <table class="table table-sm table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($news as $row)
                                            <tr>
                                                <th scope="row">{{ $row->id }}</th>
                                                <td>{{ $row->title }}</td>
                                                <td>
                                                    @if ($row->status == 1)
                                                        Publish
                                                    @else
                                                        Unpublish
                                                    @endif

                                                </td>
                                                <td>{{ $row->description }}</td>
                                                <td>{{ $row->created_at }}</td>
                                                <td class="text-right">
                                                    <a href="/news/{{ $row->id }}" role="button">Show news detail</a> |
                                                    {!! Html::decode(link_to( "/news/$row->id", 'Remove', $attributes = array('class' => 'delete-btn', 'onClick'=>'return false;'))) !!}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.modal_delete')
@endsection

