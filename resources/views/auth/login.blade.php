<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('path-to-your-styles.css') }}">
    <title>Login / Registration</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

    * {
        box-sizing: border-box;
    }

    body {
        background: #f6f5f7;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: 'Montserrat', sans-serif;
        height: 100vh;
        margin: -20px 0 50px;
    }

    h1 {
        font-weight: bold;
        margin: 0;
    }

    h2 {
        text-align: center;
    }

    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: 0.5px;
        margin: 20px 0 30px;
    }

    span {
        font-size: 12px;
    }

    a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    button {
        border-radius: 20px;
        border: 1px solid #FF4B2B;
        background-color: #FF4B2B;
        color: black;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;
    }

    button:active {
        transform: scale(0.95);
    }

    button:focus {
        outline: none;
    }

    button.ghost {
        background-color: rgba(1, 204, 255, 0.498);
        border-color: rgba(1, 204, 255, 0.498);
    }

    form {
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 50px;
        height: 100%;
        text-align: center;
    }

    input {
        background-color: #eee;
        border: none;
        padding: 12px 15px;
        margin: 8px 0;
        width: 100%;
    }

    .container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
            0 10px 10px rgba(0, 0, 0, 0.22);
        position: relative;
        overflow: hidden;
        width: 768px;
        max-width: 100%;
        min-height: 480px;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
        left: 0;
        width: 50%;
        z-index: 2;
    }

    .container.right-panel-active .sign-in-container {
        transform: translateX(100%);
    }

    .sign-up-container {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.right-panel-active .sign-up-container {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }

    @keyframes show {

        0%,
        49.99% {
            opacity: 0;
            z-index: 1;
        }

        50%,
        100% {
            opacity: 1;
            z-index: 5;
        }
    }

    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }

    .container.right-panel-active .overlay-container {
        transform: translateX(-100%);
    }

    .overlay {
        color: #000000;
        /* background: #FF416C;
        background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
        background: linear-gradient(to right, #FF4B2B, #FF416C); */
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 0 0;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
        background-image: url({{ asset('images/bg-1.avif') }});
    }

    .container.right-panel-active .overlay {
        transform: translateX(50%);
    }

    .overlay-panel {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        text-align: center;
        top: 0;
        height: 100%;
        width: 50%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay-left {
        transform: translateX(-20%);
    }

    .container.right-panel-active .overlay-left {
        transform: translateX(0);
    }

    .overlay-right {
        right: 0;
        transform: translateX(0);
    }

    .container.right-panel-active .overlay-right {
        transform: translateX(20%);
    }

    .social-container {
        margin: 20px 0;
    }

    .social-container a {
        border: 1px solid #DDDDDD;
        border-radius: 50%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 0 5px;
        height: 40px;
        width: 40px;
    }

    .web-view {
        display: none;
        /* Hide by default */
    }

    @media (min-width: 768px) {

        /* Apply styles for screens wider than 768px */
        .mobile-view {
            display: none;
            /* Hide on larger screens */
        }

        .web-view {
            display: block;
            /* Show on larger screens */
        }
    }




    /* mobile view  */
    @import url("https://fonts.googleapis.com/css?family=Fira+Sans");

    html,
    body {
        position: relative;
        min-height: 100vh;
        background-color: #E1E8EE;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Fira Sans", Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .form-structor {
        background-color: #3f494d94;
        border-radius: 15px;
        height: 600px;
        width: 350px;
        position: relative;
        overflow: hidden;

        &::after {
            content: '';
            opacity: .8;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-repeat: no-repeat;
            background-position: left bottom;
            background-size: 500px;
            background-image: url({{ asset('images/bg-1.avif') }});

        }

        .signup {
            position: absolute;
            top: 48.5%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            width: 75%;
            z-index: 5;
            -webkit-transition: all .3s ease;


            &.slide-up {
                top: 5%;
                -webkit-transform: translate(-50%, 0%);
                -webkit-transition: all .3s ease;
            }

            &.slide-up .form-holder,
            &.slide-up .submit-btn {
                opacity: 0;
                visibility: hidden;
            }

            &.slide-up .form-title {
                font-size: 1em;
                cursor: pointer;
            }

            &.slide-up .form-title span {
                margin-right: 5px;
                opacity: 1;
                visibility: visible;
                -webkit-transition: all .3s ease;
            }

            .form-title {
                color: #fff;
                font-size: 1.7em;
                text-align: center;

                span {
                    color: rgba(0, 0, 0, 0.4);
                    opacity: 0;
                    visibility: hidden;
                    -webkit-transition: all .3s ease;
                }
            }

            .form-holder {
                border-radius: 15px;
                background-color: #fff;
                overflow: hidden;
                margin-top: 50px;
                opacity: 1;
                visibility: visible;
                -webkit-transition: all .3s ease;

                .input {
                    border: 0;
                    outline: none;
                    box-shadow: none;
                    display: block;
                    height: 30px;
                    line-height: 30px;
                    padding: 8px 15px;
                    border-bottom: 1px solid #eee;
                    width: 100%;
                    font-size: 12px;

                    &:last-child {
                        border-bottom: 0;
                    }

                    &::-webkit-input-placeholder {
                        color: rgba(0, 0, 0, 0.4);
                    }
                }
            }

            .submit-btn {
                background-color: #E6B35E;
                color: rgba(256, 256, 256, 0.7);
                border: 0;
                border-radius: 15px;
                display: block;
                margin: 15px auto;
                padding: 15px 45px;
                width: 100%;
                font-size: 13px;
                font-weight: bold;
                cursor: pointer;
                opacity: 1;
                visibility: visible;
                -webkit-transition: all .3s ease;

                &:hover {
                    transition: all .3s ease;
                    background-color: #E63E1D;
                }
            }
        }

        .login {
            position: absolute;
            top: 20%;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ffffff;
            z-index: 5;
            -webkit-transition: all .3s ease;

            &::before {
                content: '';
                position: absolute;
                left: 50%;
                top: -20px;
                -webkit-transform: translate(-50%, 0);
                background-color: #fff;
                width: 200%;
                height: 250px;
                border-radius: 50%;
                z-index: 4;
                -webkit-transition: all .3s ease;
            }

            .center {
                position: absolute;
                top: calc(50% - 10%);
                left: 50%;
                -webkit-transform: translate(-50%, -50%);
                width: 85%;
                z-index: 5;
                -webkit-transition: all .3s ease;

                .form-title {
                    color: #000;
                    font-size: 1.7em;
                    text-align: center;

                    span {
                        color: rgba(0, 0, 0, 0.4);
                        opacity: 0;
                        visibility: hidden;
                        -webkit-transition: all .3s ease;
                    }
                }

                .form-holder {
                    border-radius: 15px;
                    background-color: #fff;
                    border: 1px solid #eee;
                    overflow: hidden;
                    margin-top: 50px;
                    opacity: 1;
                    visibility: visible;
                    -webkit-transition: all .3s ease;

                    .input {
                        border: 0;
                        outline: none;
                        box-shadow: none;
                        display: block;
                        height: 30px;
                        line-height: 30px;
                        padding: 8px 15px;
                        border-bottom: 1px solid #eee;
                        width: 100%;
                        font-size: 12px;

                        &:last-child {
                            border-bottom: 0;
                        }

                        &::-webkit-input-placeholder {
                            color: rgba(0, 0, 0, 0.4);
                        }
                    }
                }

                .submit-btn {
                    background-color: #6B92A4;
                    color: rgba(256, 256, 256, 0.7);
                    border: 0;
                    border-radius: 15px;
                    display: block;
                    margin: 15px auto;
                    padding: 15px 45px;
                    width: 100%;
                    font-size: 13px;
                    font-weight: bold;
                    cursor: pointer;
                    opacity: 1;
                    visibility: visible;
                    -webkit-transition: all .3s ease;

                    &:hover {
                        transition: all .3s ease;
                        background-color: rgba(0, 0, 0, 0.8);
                    }
                }
            }

            &.slide-up {
                top: 90%;
                -webkit-transition: all .3s ease;
            }

            &.slide-up .center {
                top: 10%;
                -webkit-transform: translate(-50%, 0%);
                -webkit-transition: all .3s ease;
            }

            &.slide-up .form-holder,
            &.slide-up .submit-btn {
                opacity: 0;
                visibility: hidden;
                -webkit-transition: all .3s ease;
            }

            &.slide-up .form-title {
                font-size: 1em;
                margin: 0;
                padding: 0;
                cursor: pointer;
                -webkit-transition: all .3s ease;
            }

            &.slide-up .form-title span {
                margin-right: 5px;
                opacity: 1;
                visibility: visible;
                -webkit-transition: all .3s ease;
            }
        }
    }
</style>

<body>


    <div class="mobile-view">

        <img src="{{ asset('images/loungerlive.png') }}" height="65" alt="LoungerLive Logo">

        <div class="form-structor">
            {{-- SignUP  --}}
            <div class="signup">
                <h2 class="form-title" id="signup">Sign up</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-holder">

                        {{-- Name --}}
                        <input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                        {{-- Username --}}
                        <input id="username" class="block mt-1 w-full" type="text" name="username"
                            value="{{ old('username') }}" required autofocus autocomplete="username"
                            placeholder="Username" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />

                        {{-- Email --}}
                        <input id="email" class="block mt-1 w-full" type="email" name="email"
                            value="{{ old('email') }}" required autocomplete="email" placeholder="Email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        {{-- Password --}}
                        <input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" placeholder="Password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        {{-- Confirm Password --}}
                        <input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirm Password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <button class="submit-btn">Sign up</button>
                </form>
            </div>
            <!-- Login -->
            <div class="login slide-up">
                <div class="center">
                    <h2 class="form-title" id="login">Log in</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-holder">
                            <input id="email" class="block mt-1 w-full" type="email" name="email"
                                value="{{ old('email') }}" required autofocus autocomplete="username"
                                placeholder="Email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />


                            <input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="current-password" placeholder="Password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <button class="submit-btn">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="web-view">


        <img src="{{ asset('images/loungerlive.png') }}" height="80" alt="LoungerLive Logo"
            style="padding-left:150px;">


        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h1>Create Account</h1>
                    {{-- <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div> --}}
                    <span>with your email for registration</span>
                    <!-- Name -->
                    <input id="name" class="block mt-1 w-full" type="text" name="name"
                        value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    {{-- username  --}}
                    <input id="username" class="block mt-1 w-full" type="text" name="username"
                        value="{{ old('username') }}" required autofocus autocomplete="username"
                        placeholder="Username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />

                    {{-- Email  --}}
                    <input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email') }}" required autocomplete="username" placeholder="Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    {{-- password  --}}
                    <input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    {{-- confirm password  --}}
                    <input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Confirm Password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    <button>Sign Up</button>
                </form>
            </div>

            {{-- register end  --}}






            {{-- login  --}}
            <div class="form-container sign-in-container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>Sign in</h1>
                    {{-- <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div> --}}
                    <span>on use your account</span>
                    <input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email') }}" required autofocus autocomplete="username"
                        placeholder="Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />


                    <input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" placeholder="Password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    @if (Route::has('password.request'))
                        {{-- <a href="{{ route('password.request') }}">Forgot your password?</a> --}}
                    @endif
                    <button>Sign In</button>
                </form>
            </div>
            {{-- login end  --}}



            {{-- overlay --}}
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>




        </div>


    </div>


    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>

    <script>
        console.clear();

        const loginBtn = document.getElementById('login');
        const signupBtn = document.getElementById('signup');

        loginBtn.addEventListener('click', (e) => {
            let parent = e.target.parentNode.parentNode;
            Array.from(e.target.parentNode.parentNode.classList).find((element) => {
                if (element !== "slide-up") {
                    parent.classList.add('slide-up')
                } else {
                    signupBtn.parentNode.classList.add('slide-up')
                    parent.classList.remove('slide-up')
                }
            });
        });

        signupBtn.addEventListener('click', (e) => {
            let parent = e.target.parentNode;
            Array.from(e.target.parentNode.classList).find((element) => {
                if (element !== "slide-up") {
                    parent.classList.add('slide-up')
                } else {
                    loginBtn.parentNode.parentNode.classList.add('slide-up')
                    parent.classList.remove('slide-up')
                }
            });
        });
    </script>

</body>

</html>
