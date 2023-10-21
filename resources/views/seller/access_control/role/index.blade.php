@extends('layouts.seller')
@section('page-title','Role List')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Role')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Role')}}</li>
        </ol>
    </div>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Role List')}}</h4>
                        </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    @can('role.add')
                                         <a href="{{route('role.create')}}" class="btn btn-primary">{{__('Add New')}}</a>
                                    @endcan
                                </div>
                            </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $key=>$role)
                                <tr>
                                    <td>{{$key = $key+1}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        @can('role.edit')
                                           <a href="{{route('role.edit', encrypt($role->id))}}" class="badge badge-success">{{__('Edit')}}</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
