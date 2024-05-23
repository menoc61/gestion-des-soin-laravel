@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit User') }}
@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-multiselect.css') }}">
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Edit User') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.store_edit') }}">
                        @csrf
                        <center>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input type="file" class="form-control" id="file-upload" name="image"
                                        accept="image/*" style="display: none;">
                                    <div class="image-container">
                                        <span class="hover-text">Choisir le Profil</span>
                                        <img id="image-preview" src="{{ asset('img/default-image.jpeg') }}"
                                            alt="Image Preview">
                                    </div>
                                </div>
                            </div>
                        </center>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label">{{ __('sentence.Full Name') }}<font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Name" name="name">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Email" class="col-sm-3 col-form-label">{{ __('sentence.Email Adress') }}<font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="Email" name="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Password" class="col-sm-3 col-form-label">{{ __('sentence.Password') }}<font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="Password" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Password" class="col-sm-3 col-form-label">{{ __('sentence.Password Confirmation') }}
                                <font color="red">*</font>
                            </label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="Password" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Phone" class="col-sm-3 col-form-label">{{ __('sentence.Phone') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Phone" name="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Gender" class="col-sm-3 col-form-label">{{ __('sentence.Gender') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="gender" id="Gender">
                                    <option value="Male">{{ __('sentence.Male') }}</option>
                                    <option value="Female">{{ __('sentence.Female') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-sm-3 col-form-label">{{ __('sentence.Role') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="role_id" id="roleID">
                                    {{-- <option value="Unknown">{{ __('sentence.Select Role') }}</option>
                                    <option value="admin">{{ __('sentence.Admin') }}</option>
                                    <option value="praticien">{{ __('sentence.Doctor') }}</option> --}}

                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fonction_user" class="col-sm-3 col-form-label">{{ __('sentence.Type of patient') }}
                                <font color="red">*
                                </font>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control" id="fonction_user" multiple="multiple" name="fonction[]">
                                    <option value="Praticien Main">Praticien Main</option>
                                    <option value="Praticien Peau">Praticien Peau</option>
                                    <option value="Praticien Pied">Praticien Pied</option>
                                    <option value="Dermatologue">Dermatologue</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success">{{ __('sentence.Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <script type="text/javascript">
        $('#fonction_user').multiselect();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fileUpload = document.getElementById("file-upload");
            const imagePreview = document.getElementById("image-preview");
            const defaultImage = "default-image.jpeg";

            fileUpload.addEventListener("change", function() {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                }

                if (fileUpload.files[0]) {
                    reader.readAsDataURL(fileUpload.files[0]);
                } else {
                    imagePreview.src = defaultImage;
                    imagePreview.style.display = "block";
                }
            });

            imagePreview.addEventListener("click", function() {
                fileUpload.click();
            });
        });
    </script>
@endsection
