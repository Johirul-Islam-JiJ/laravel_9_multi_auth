@extends('layouts.admin')
@section('page-title','User Profile')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Profile')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Profile')}}</li>

        </ol>
    </div>
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="content-body">
            <!-- account setting page -->
            <section id="page-account-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column nav-left" id="myTab">
                            <!-- general -->
                            <li class="nav-item">
                                <a class="nav-link active" id="account-pill-general" data-toggle="pill"
                                   href="#account-vertical-general" aria-expanded="true">
                                    <i class="fas fa-user"></i><span class="font-weight-bold">{{__('General')}}</span>
                                </a>
                            </li>
                            <!-- change password -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-password" data-toggle="pill"
                                   href="#account-vertical-password" aria-expanded="false">
                                    <i class="fas fa-key"></i>
                                    <span class="font-weight-bold">{{__('Change Password')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--/ left menu section -->

                    <!-- right content section -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- general tab -->
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                         aria-labelledby="account-pill-general" aria-expanded="true">
                                        <!-- form -->
                                        <form class="validate-form mt-2" novalidate="novalidate" method="post"
                                              action="{{route('admin.update_general',$data->id)}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="media">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    @if($data->image)
                                                        <img src="{{asset(config('imagepath.profile')).$data->image}}"
                                                             id="blah"
                                                             class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                             height="90" width="90">
                                                    @else
                                                        <img src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-11.jpg"
                                                             id="blah"
                                                             class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                             height="90" width="90">
                                                    @endif
                                                    <p>{{__('Profile Image')}}</p>
                                                </a>
                                                <!-- upload and reset button -->
                                                <div class="media-body mt-75 ml-1">
                                                    <div class="col-12 d-flex mt-1 px-0">
                                                        <label
                                                            class="btn btn-primary mr-75 mb-0 waves-effect waves-float waves-light"
                                                            for="change-picture">
                                                            <span class="d-none d-sm-block">{{__('Change')}} </span>
                                                            <input class="form-control imgInp" type="file"
                                                                   id="change-picture" hidden=""
                                                                   accept="image/png, image/jpeg, image/jpg"
                                                                   name="image">
                                                            <span class="d-block d-sm-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round" class="feather feather-edit mr-0"><path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-name">{{__('Name')}}</label>
                                                        <input type="text" class="form-control" id="account-name"
                                                               name="name" placeholder="Name" value="{{old('name', $data->name)}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-e-mail">{{__('Email')}}</label>
                                                        <input type="email" class="form-control" id="account-e-mail"
                                                               name="email" placeholder="Email"
                                                               value="{{$data->email}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-phone">{{__('Phone Number')}}</label>
                                                        <input type="text" class="form-control"
                                                               placeholder="Phone number" name="phone"
                                                               autocomplete="off" value="{{old('phone_number', $data->phone_number)}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-birth-date">{{__('Birth Date')}}</label>
                                                        <input type="date"
                                                               class="form-control flatpickr flatpickr-input"
                                                               placeholder="Birth date" id="account-birth-date"
                                                               name="dob" value="{{old('dob',$data->dob) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit"
                                                            class="btn btn-primary mt-2 mr-1 waves-effect waves-float waves-light">
                                                        {{__('Save Changes')}}
                                                    </button>
                                                    <button type="reset"
                                                            class="btn btn-outline-secondary mt-2 waves-effect">{{__('Cancel')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ general tab -->

                                    <!-- change password -->
                                    <div class="tab-pane fade" id="account-vertical-password" role="tabpanel"
                                         aria-labelledby="account-pill-password" aria-expanded="false">
                                        <!-- form -->
                                        <form class="validate-form" novalidate="novalidate" id="change_password"
                                              method="post" action="{{route('admin.update.password',$data->id)}}">
                                            @csrf
                                            <div class="form-group col-sm-6">
                                                <label for="account-old-password">{{__('Old Password')}}</label>
                                                <div class="input-group form-password-toggle input-group-merge">
                                                    <input type="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           id="account-old-password" name="password"
                                                           placeholder="Old Password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                 height="14" viewBox="0 0 24 24" fill="none"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-eye">
                                                                <path
                                                                    d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group col-sm-6">
                                                <label for="account-new-password">{{__('New Password')}}</label>
                                                <div class="input-group form-password-toggle input-group-merge">
                                                    <input type="password" id="account-new-password" name="new_password"
                                                           class="form-control @error('new_password') is-invalid @enderror"
                                                           placeholder="New Password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                 height="14" viewBox="0 0 24 24" fill="none"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-eye">
                                                                <path
                                                                    d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <div class="form-group col-sm-6">
                                                <label for="account-retype-new-password">{{__('Retype New Password')}}</label>
                                                <div class="input-group form-password-toggle input-group-merge">
                                                    <input type="password"
                                                           class="form-control @error('confirm_new_password') is-invalid @enderror"
                                                           id="account-retype-new-password" name="confirm_new_password"
                                                           placeholder="New Password">

                                                    <div class="input-group-append">
                                                        <div class="input-group-text cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                 height="14" viewBox="0 0 24 24" fill="none"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-eye">
                                                                <path
                                                                    d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span style="color:#FF0052;" id="password_confirm_error"></span>
                                            </div>
                                            @error('confirm_new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="col-12">
                                                <button type="submit"
                                                        class="btn btn-primary mr-1 mt-1 waves-effect waves-float waves-light change_password">
                                                    {{__('Save Changes')}}
                                                </button>
                                                <button type="reset"
                                                        class="btn btn-outline-secondary mt-1 waves-effect">{{__('Cancel')}}
                                                </button>
                                            </div>

                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ change password -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ right content section -->
                </div>
            </section>
            <!-- / account setting page -->
        </div>
    </div>
@endsection
@push('scripts')

    <script>
        //image preview
        $("#change-picture").change(function () {
            readURL(this);
        });

        //image input
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(function () {
            $('a[data-toggle="pill"]').on('click', function (e) {
                window.localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            let activeTab = window.localStorage.getItem('activeTab');
            if (activeTab) {
                $('.nav-pills a[href="' + activeTab + '"]').tab('show');
                window.localStorage.removeItem("activeTab");
            }
        });
        $(document).ready(function () {
            $("#account-e-mail").prop("disabled", true);
            $("#account-username").prop("disabled", true);
            // $("#account-phone").prop("disabled", true);

            $("#password_confirm_error").hide();
            let error_password_confirm = false;

            $("#account-retype-new-password").focusout(function () {
                check_password_confirm();
            });

            function check_password_confirm() {
                let password = $("#account-new-password").val();
                let password_confirm = $("#account-retype-new-password").val();
                if (password_confirm !== password) {
                    $("#password_confirm_error").html("Password not matched");
                    $("#password_confirm_error").show();
                    $("#password_confirm").css("border-bottom", "2px solid #f90A0A");
                    error_password_confirm = true;
                } else {
                    $("#password_confirm_error").hide();
                    $("#password_confirm").css("border-bottom", "2px solid #34F458");
                }
            }

        })

    </script>
@endpush
