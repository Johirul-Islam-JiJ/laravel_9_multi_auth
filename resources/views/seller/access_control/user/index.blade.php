@extends('layouts.seller')
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('User List')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                @can('user.add')
                                    <a href="{{route('seller.user.create')}}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>{{__('Add New')}}</a>
                                @endcan
                                @can('user.delete')
                                    <a href="{{route('seller-user.deleted')}}" class="btn btn-danger ml-1"><i
                                            class="far fa-trash-alt pr-1"></i>{{__('Deleted Data')}}</a>
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
                                <th>{{__('Phone Number')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Roles')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#dataTable').dataTable({
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: '{{ route('seller.user') }}',
                columns: [
                    {data: "DT_RowIndex", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "name"},
                    {data: "phone_number"},
                    {data: "email"},
                    {data: "roles", searchable: false, orderable: false},
                     {data: "action", searchable: false, orderable: false},
                ],
            });
        })
    </script>
@endpush
