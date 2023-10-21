@extends('layouts.admin')
@section('page-title','User Edit')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0"><i class="fab fa-bandcamp"></i> {{__('User')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{__('Home')}}</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user') }}">{{__('User')}}</a>
            </li>
            <li class="breadcrumb-item active">{{__('Edit User')}}
            </li>
        </ol>
    </div>
@endsection
@section('content')

    <section class="validations" id="validation">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i data-feather='arrow-right'></i> {{__('Edit User')}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.update', encrypt($admin->id)) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>{{__('Roles')}}</label>
                                    <div class="form-group">
                                        <select name="roles[]" id="category" class="form-control select2" multiple>
                                            <option value="" disabled>Select role</option>
                                            @foreach($roles as $role)
                                                <option
                                                    value="{{$role->id}}" {{ in_array($role->name,$admin->getRoleNames()->toArray()) ? 'selected':'' }}>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-12 mb-2">
                                    <label for="name">{{__('Name')}}</label>
                                    <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" id="name" placeholder="User name" value="{{ $admin->name }}"  autocomplete="off">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4 col-12 mb-2">
                                    <label for="phone_number">{{__('Phone Number')}}</label>
                                    <input type="text" name="phone_number"
                                           class="form-control @error('phone_number')is-invalid @enderror"
                                           id="phone_number"
                                           placeholder="Enter Phone Number" value="{{ $admin->phone_number }}"
                                           required="" autocomplete="off">
                                    @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4 col-12 mb-2">
                                    <label for="name">{{__('Email')}}</label>
                                    <input type="email" name="email"
                                           class="form-control @error('email')is-invalid @enderror" id="email"
                                           placeholder="Enter email" value=" {{ $admin->email }}"
                                           required="">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-4 col-12 mb-2">
                                    <label for="login-password">New Password</label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" name="password" class="form-control @error('password')is-invalid @enderror" id="password" placeholder="Enter Password" value="{{ old('password') }}"  autocomplete="off">
                                        <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                    </div>
                                </div>

                                <div class="form-group col-sm-4 col-12 mb-2 ">
                                    <label for="login-password">Retype Password</label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation')is-invalid @enderror" id="password_confirmation" placeholder="Retype Password" value="{{ old('password_confirmation') }}"  autocomplete="off">
                                        <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-float waves-light float-right"
                                    type="submit">{{__('Update')}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- validations end -->
@endsection

