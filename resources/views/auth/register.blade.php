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

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Axios Library -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Lien vers Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="login">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-8 shadow-lg form my-5">
                <div class="col-lg-12">
                    <div class="">
                        <div class="text-center">
                            <h2 class="h3 text-light mb-4">{{ __('sentence.Welcome') }}</h2>
                            <center>
                                <div class="d-flex w-25 justify-content-center align-items-center">
                                    <img src="{{ asset('img/sai-i-lama-logo.png') }}" class="img-fluid1">
                                </div>
                            </center>
                        </div>
                        <form method="post" action="{{ route('patient.store') }}" enctype="multipart/form-data"
                            class="user" id="register-form">
                            @csrf
                            <h1 class="title">Creez votre compte</h1>
                            <div class="form-group fle">
                                <div class="form-group w-100">
                                    <i class="fas fa-user"></i>
                                    <input type="text" class="input w-100 @error('name') is-invalid @enderror"
                                        placeholder="{{ __('sentence.Full Name') }}" required id="Name"
                                        name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group w-100">
                                    <i class="fas fa-envelope"></i>
                                    <input id="email" type="email"
                                        class="input w-100 @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="off" autofocus
                                        aria-describedby="emailHelp" placeholder="{{ __('sentence.Email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group fle">
                                <p id="password-error" style="color: red;"></p>
                                <div class="w-100">
                                    <i class="fas fa-lock"></i>
                                    <input id="password" type="password"
                                        class="input w-100 @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="off" placeholder="{{ __('sentence.Password') }} ">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="w-100">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" class="input w-100 @error('password') is-invalid @enderror"
                                        required id="confirm_password" name="password_confirmation" autocomplete="off"
                                        placeholder="{{ __('sentence.Confirm Password') }}">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group fle">
                                <div class="w-100">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <input type="text" class="input w-100 @error('address') is-invalid @enderror"
                                        required id="Address" name="address"
                                        placeholder="{{ __('sentence.Address') }}" value="{{ old('address') }}">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="w-100">
                                    <i class="fas fa-phone"></i>
                                    <input type="text" class="input w-100 @error('phone') is-invalid @enderror"
                                        required id="Phone" name="phone" placeholder="{{ __('sentence.Phone') }}"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group fle">
                                <div class="w-100">
                                    <i class="fas fa-venus-mars"></i> <!-- Icône de genre -->
                                    <select class="select w-100" name="gender" id="Gender">
                                        <option value="" disabled selected hidden>
                                            {{ __('sentence.SelectGender') }}
                                        </option>
                                        <!-- Placeholder -->
                                        <option value="Homme" {{ old('gender') == 'Homme' ? 'selected' : '' }}>
                                            {{ __('sentence.Male') }}</option>
                                        <option value="Femme" {{ old('gender') == 'Femme' ? 'selected' : '' }}>
                                            {{ __('sentence.Female') }}</option>
                                    </select>
                                </div>
                                <!-- Bouton qui déclenche la modal -->
                                <div class="w-100">
                                    <button class="btn btn-success w-75" id="submit-btn" type="button">
                                        {{ __('Envoyer') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center">
                            <a class="small text-light" href="{{ route('login') }}">
                                {{ __('sentence.connection patient') }}</a>
                        </div>
                    </div>
                    <div class="drop drop1"></div>
                    <div class="drop drop2"></div>
                    <div class="drop drop3"></div>
                    <div class="drop drop4"></div>
                    <div class="drop drop5"></div>
                </div>
            </div>
        </div>

        <!-- Modal Bootstrap -->
        <div class="modal fade" id="appChoicePopup" tabindex="-1" aria-labelledby="appChoicePopupLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Souhaitez-vous avoir accès à notre e-shop ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <div class="d-flex w-25 justify-content-center align-items-center">
                                <img src="{{ asset('img/interro2.jfif') }}" class="img-fluid">
                            </div>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button id="yes-btn" class="btn btn-primary">Oui</button>
                        <button id="no-btn" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.getElementById('submit-btn').addEventListener('click', function() {
        // Afficher la modal lorsque le bouton "Envoyer" est cliqué
        var myModal = new bootstrap.Modal(document.getElementById('appChoicePopup'), {
            keyboard: false
        });
        myModal.show();
    });

    // Gérer le clic sur le bouton "Oui"
    document.getElementById('yes-btn').addEventListener('click', function() {
        ajouterHiddenInput('true');
        soumettreFormulaire();
    });

    // Gérer le clic sur le bouton "Non"
    document.getElementById('no-btn').addEventListener('click', function() {
        ajouterHiddenInput('false');
        soumettreFormulaire();
    });

    // Fonction pour ajouter un champ caché "appChoice" au formulaire
    function ajouterHiddenInput(valeur) {
        const form = document.getElementById('register-form');

        // Supprime l'ancien input "appChoice" s'il existe
        const oldInput = document.querySelector('input[name="appChoice"]');
        if (oldInput) {
            oldInput.remove();
        }

        // Créer un nouvel input caché pour "appChoice"
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'appChoice';
        hiddenInput.value = valeur;
        form.appendChild(hiddenInput);
    }

    // Fonction pour soumettre le formulaire après avoir ajouté "appChoice"
    function soumettreFormulaire() {
        const form = document.getElementById('register-form');
        form.submit(); // Soumet le formulaire après avoir ajouté la valeur
    }
</script>

</html>
