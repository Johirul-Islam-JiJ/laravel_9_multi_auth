@extends('layouts.admin')
@section('content')
    <section class="validations" id="validation">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-plus"></i> {{__('Add New User')}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Assign a role</label>
                                    <div class="form-group">
                                        <select class="select2 form-control form-control-lg" name="roles[]" multiple required>
                                            <option value="" disabled>{{__('Select role')}}</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->name}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-12 mb-2">
                                    <label for="name">{{__('Name')}}</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name')is-invalid @enderror" id="name" placeholder="User name" value="{{ old('name') }}" required="" autocomplete="off">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4 col-12 mb-2">
                                    <label for="phone_number">{{__('Phone Number')}}</label>
                                    <input type="text" name="phone_number"
                                           class="form-control @error('phone_number')is-invalid @enderror"
                                           id="phone_number"
                                           placeholder="Enter Phone Number" value="{{ old('phone_number') }}"
                                           required="" autocomplete="off"
                                    >
                                    @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4 col-12 mb-2">
                                    <label for="name">{{__('Email')}}</label>
                                    <input type="email" name="email"
                                           class="form-control @error('email')is-invalid @enderror" id="email"
                                           placeholder="Enter email" value=" {{ old('email') }}"
                                           required=""
                                    >
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-4 col-12 mb-2">
                                    <label for="login-password">Password</label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" name="password"
                                               class="form-control @error('password')is-invalid @enderror" id="password"
                                               placeholder="Enter Password" value="{{ old('password') }}" required=""
                                               autocomplete="off"
                                        >
                                        <div class="input-group-append"><span class="input-group-text cursor-pointer"><i
                                                    data-feather="eye"
                                                ></i></span></div>
                                    </div>
                                </div>

                                <div class="form-group col-sm-4 col-12 mb-2 ">
                                    <label for="login-password">Retype Password</label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" name="password_confirmation"
                                               class="form-control @error('password_confirmation')is-invalid @enderror"
                                               id="password_confirmation" placeholder="Retype Password"
                                               value="{{ old('password_confirmation') }}" required="" autocomplete="off"
                                        >
                                        <div class="input-group-append"><span class="input-group-text cursor-pointer"><i
                                                    data-feather="eye"
                                                ></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-float waves-light float-right" type="submit">{{__('Submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

@endpush
