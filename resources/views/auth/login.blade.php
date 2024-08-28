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
            <form method="POST" action="{{ route('login') }}" class="sing-in-form">
                <h1 class="title">Connectez-vous</h1>

                <div class="form-group input-field">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp"
                        placeholder="{{ __('sentence.Email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" class=" @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password"
                        placeholder="{{ __('sentence.Password') }}">
                    @error('password')
                        <span class="alert alert-danger mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input class="custom-control-input" type="checkbox" name="remember" id="customCheck"
                            {{ old('remember') ? 'checked' : '' }}>
                        {{ csrf_field() }}
                        <label class="custom-control-label" for="customCheck">{{ __('sentence.Remember Me') }}</label>
                    </div>
                </div>
                <button class="btn btn-success" type="submit">
                    {{ __('sentence.Login') }}</button>

                {{-- <p class="social-text">Or Sign in with social plateform </p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div> --}}
                <p class="account-text">Vous n'avez pas de compte ? <a href="" id="sign-up-btn2">Enregistrez-Vous
                        ici</a></p>
            </form>

            <form method="POST" action="{{ url('/api/users/register') }}" class="sing-up-form">
                <h1 class="title">Creez votre compte</h1>
                <div class="form-group input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" placeholder="{{ __('sentence.Name') }}" id="Name"
                        name="name">
                </div>

                <div class="form-group  input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-control" id="Email" placeholder="{{ __('sentence.Email') }}"
                        name="email">
                </div>


                <div class="form-group input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" id="Password"
                        placeholder="{{ __('sentence.Password') }}" name="password" autocomplete="off">
                </div>
                <div class="form-group input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" id="Password" name="password" autocomplete="off"
                        placeholder="{{ __('sentence.Password') }}">
                </div>


                <div class="form-group input-field">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" class="form-control" id="Address" name="address"
                        placeholder="{{ __('sentence.Address') }}">
                </div>
                <div class="form-group input-field">
                    <i class="fas fa-phone"></i>
                    <input type="text" class="form-control" id="Phone" name="phone"
                        placeholder="{{ __('sentence.Phone') }}">
                </div>

                <div class="form-group input-field">
                    <i class="fas fa-venus-mars"></i> <!-- Icône de genre -->
                    <select class="form-control" name="gender" id="Gender">
                        <option value="" disabled selected hidden>{{ __('sentence.SelectGender') }}</option>
                        <!-- Placeholder -->
                        <option value="Homme">{{ __('sentence.Male') }}</option>
                        <option value="Femme">{{ __('sentence.Female') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <label class="custom-control-label" for="customCheck">Souhaitez-vous avoir accès a notre
                            e-shop</label>
                        <input class="custom-control-input" type="checkbox" value="true" name="appChoice"
                            id="customCheck">
                        {{ csrf_field() }}
                    </div>
                </div>
                <button class="btn btn-success" type="submit">
                    {{ __('sentence.Send') }}</button>

                {{-- <p class="social-text">Or Sign in with social plateform </p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div> --}}
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
                <img src="{{asset('img/undraw_sync_re_492g.svg')}}" alt="" class="image">
            </div>
        </div>
    </div>
    <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");
        const sign_in_btn2 = document.querySelector("#sign-in-btn2");
        const sign_up_btn2 = document.querySelector("#sign-up-btn2");

        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });

        sign_up_btn2.addEventListener("click", () => {
            container.classList.add("sign-up-mode2");
        });

        sign_in_btn2.addEventListener("click", () => {
            container.classList.remove("sign-up-mode2");
        });
    </script>

    {{-- <script>
        document
            .getElementById("loginForm")
            .addEventListener("submit", async (e) => {
                let soinSuccess = false;
                try {
                    // Gestion des résultats
                    if (soinSuccess === true) {
                        alert("Login successful to both modules");
                        window.location.href = "{{ route('login.home' }}";
                    } else{
                        alert("Login not success");

                    }
                } catch (error) {
                    console.error("Unexpected error during login:", error);
                    alert("An unexpected error occurred. Please try again later.");
                }
            });
    </script> --}}
</body>

</html>
