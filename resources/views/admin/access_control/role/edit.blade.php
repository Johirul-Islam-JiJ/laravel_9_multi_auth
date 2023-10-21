@extends('layouts.admin')
@section('page-title','Role Edit')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Role')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{__('Home')}}</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{__('Role')}}</a>
            </li>
            <li class="breadcrumb-item active">{{__('Edit Role')}}
            </li>
        </ol>
    </div>
@endsection

@section('content')
    <section class="validations" id="validation">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="">
                        <h4 class="card-title">{{__('Edit Role')}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', encrypt($role->id)) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label for="name">{{__('Role Name')}}</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name')is-invalid @enderror" id="name"
                                           placeholder="Role name" value="{{$role->name}}" required="" autofocus>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>
                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkAll">
                                                    <label class="custom-control-label" for="checkAll"><b>{{__('Select all')}}</b></label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                @for($i =1;$i <= (count($permissions)+20);$i++)
                                    @foreach($permissions as $index=>$modules)
                                        @if(count($modules)===$i)
                                    <div class="col-xl-6 col-lg-6 col-md-6 mb-2">
                                        <table class="table  table-borderless card" style="height: 100%; border: 1px solid #DEDEEB">
                                            <tr class="row" >
                                                <td width="30%" style="vertical-align:top">{{ucfirst($index)}}</td>
                                                <td width="30%" style="vertical-align:top">
                                                    <div class="custom-control custom-checkbox mb-1">
                                                        <input type="checkbox" class="custom-control-input {{$index}}" onclick="checkPermissionByGroupName('role_{{$loop->iteration}}_management_td', this) "  id="exampleCheckbox{{$index}}" value="{{$index}}">
                                                        <label class="custom-control-label" for="exampleCheckbox{{$index}}">Select All</label>
                                                    </div>
                                                </td>
                                                <td width="40%" style="vertical-align:top" class="role_{{$loop->iteration}}_management_td">
                                                    @foreach($modules as $permission)
                                                        <div class="custom-control custom-checkbox mb-1">
                                                            <input type="checkbox" name="permissions[]" {{$role->hasPermissionTo($permission->id) ? 'checked': ''}}
                                                            class="custom-control-input {{$index}}"
                                                                   id="exampleCheckbox{{$permission->id}}"
                                                                   value="{{$permission->id}}">
                                                            @php $string = array('.', '-') @endphp
                                                            <label class="custom-control-label" for="exampleCheckbox{{$permission->id}}">{{ucfirst(str_replace($string, ' ', $permission->name))}}</label>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                        @endif
                                    @endforeach
                                 @endfor
                            </div>
                            <button class="btn btn-primary waves-effect waves-float waves-light float-right" type="submit">{{__('Update')}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script type="text/javascript">
        $('#checkAll').click(function () {
            $('input:checkbox').prop('checked', this.checked);
        });
    </script>
    <script type="text/javascript">
        function checkPermissionByGroupName(className, checkThis){
            let groupIdName = $('#'+checkThis.id);
            let classCheckBox = $('.'+className+' input');
            if(groupIdName.is(':checked')){
                classCheckBox.prop('checked', true);
            }else {
                classCheckBox.prop('checked', false);
            }
        }
    </script>
@endpush
