<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>sai i lama - register</title>

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="login">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-9 bo my-5">
                <div class="col-lg-12">
                    <div class="p-5">
                        <form method="post" action="{{ url('/api/users/register') }}" class="user">
                            @csrf
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label for="Name"
                                        class="col-sm-12 col-form-label">{{ __('sentence.Full Name') }}
                                        <font color="red">*</font>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="Name" name="name">
                                        {{ csrf_field() }}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Email"
                                        class="col-sm-12 col-form-label">{{ __('sentence.Email Adress') }}
                                        <font color="red">*</font>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="Email" name="email">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label for="Password" class="col-sm-12 col-form-label">{{ __('sentence.Password') }}
                                        <font color="red">*</font>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" id="Password" name="password">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Password"
                                        class="col-sm-12 col-form-label">{{ __('sentence.Password Confirmation') }}
                                        <font color="red">*</font>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" id="Password"
                                            name="password_confirmation">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label for="Phone"
                                        class="col-sm-12 col-form-label">{{ __('sentence.Phone') }}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="Phone" name="phone">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Gender"
                                        class="col-sm-12 col-form-label">{{ __('sentence.Gender') }}</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="gender" id="Gender">
                                            <option value="Homme">{{ __('sentence.Male') }}</option>
                                            <option value="Femme">{{ __('sentence.Female') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label for="fonction_user" class="col-sm-12 col-form-label">Voulez-vous avoir accès a notre e-shop ?
                                        <font color="red">*</font>
                                    </label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="fonction_user" name="appChoice">
                                            <option value="false">Non</option>
                                            <option value="true">Oui</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress2"
                                        class="col-sm-12 col-form-label">{{ __('sentence.Address') }}<font
                                            color="red">*
                                        </font>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="Address" name="address">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-success">{{ __('sentence.Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
