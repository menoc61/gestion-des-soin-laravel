<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>sai i lama - Login</title>

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Lien vers Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/login.min.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container">
        <!-- Outer Row -->
        <div class="singin-singup">
            <form method="post" action="{{ route('patient.store') }}" enctype="multipart/form-data"
                class="sing-up-form">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="title">Creez votre compte</h1>
                <div class="form-group fle">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control input" placeholder="{{ __('sentence.Full Name') }}"
                        id="Name" name="name">
                </div>

                <div class="form-group  fle">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-control input" id="Email"
                        placeholder="{{ __('sentence.Email') }}" name="email">
                </div>

                <div class="form-group fle">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control input" id="password"
                        placeholder="{{ __('sentence.Password') }}" name="password" autocomplete="off">
                </div>
                <p id="password-error" style="color: red;"></p>
                <div class="form-group fle">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control input" id="confirm_password" name="password_confirmation"
                        autocomplete="off" placeholder="{{ __('sentence.Confirm Password') }}">
                </div>


                <div class="form-group fle">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" class="form-control input" id="Address" name="address"
                        placeholder="{{ __('sentence.Address') }}">
                </div>
                <div class="form-group fle">
                    <i class="fas fa-phone"></i>
                    <input type="text" class="form-control input" id="Phone" name="phone"
                        placeholder="{{ __('sentence.Phone') }}">
                </div>

                <div class="form-group fle">
                    <i class="fas fa-venus-mars"></i> <!-- Icône de genre -->
                    <select class="form-control" name="gender" id="Gender">
                        <option value="" disabled selected hidden>{{ __('sentence.SelectGender') }}</option>
                        <!-- Placeholder -->
                        <option value="Homme">{{ __('sentence.Male') }}</option>
                        <option value="Femme">{{ __('sentence.Female') }}</option>
                    </select>
                </div>
                <div class="form-group fle">
                    <div class="custom-control custom-checkbox small">
                        <label class="custom-control-label" for="customCheck">Souhaitez-vous avoir accès à notre
                            e-shop</label>
                        <input type="hidden" name="appChoice" value="false">
                        <input class="custom-control-input" type="checkbox" value="true" name="appChoice"
                            id="customCheck">
                        {{ csrf_field() }}
                    </div>
                </div>

                <button class="btn btn-success" id="submit-btn" type="submit">
                    {{ __('sentence.Send') }}</button>

                <p class="account-text">Vous avez déja un compte ? <a href="" id="sign-in-btn2">Connectez-Vous
                        ici</a>
                </p>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Vous avez déja un compte ?</h3>
                    <p>
                    </p>
                    <button class="btn" id="sign-in-btn">Connectez-Vous ici</button>
                </div>
                <img src="" alt="" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Vous êtes nouveau ?</h3>
                    <p> Veuillez cliquer sur ce bouton afin de créer votre compte</p>
                    <button class="btn" id="sign-up-btn">Enregistrez-Vous ici</button>
                </div>
                <img src="{{ asset('img/undraw_sync_re_492g.svg') }}" alt="" class="image">
            </div>
        </div>
    </div>

</body>

</html>
