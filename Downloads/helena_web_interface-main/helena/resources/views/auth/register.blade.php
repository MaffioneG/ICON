<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <x-jet-authentication-card>
        <x-slot name="logo">
            
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        <form class="user" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">

            <div class="col-sm-6 mb-3 mb-sm-0">  
                <x-jet-label for="name" value="{{ __('Nome') }}" />
                <x-jet-input id="name" class="form-control form-control-user" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="col-sm-6">
                <x-jet-label for="surname" value="{{ __('Cognome') }}" />
                <x-jet-input id="surname" class="form-control form-control-user" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname" />
            </div>
</div>
            <div class="form-group row">
                                   
            <div class="col-sm-6 mb-3 mb-sm-0">  
                <x-jet-label for="city" value="{{ __('Citta') }}" />
                <x-jet-input id="city" class="form-control form-control-user" type="text" name="city" :value="old('city')" required autofocus autocomplete="city" />
            </div>

          
            <div class="col-sm-6"> 
                <x-jet-label for="adress" value="{{ __('Indrizzo') }}" />
                <x-jet-input id="adress" class="form-control form-control-user" type="text" name="adress" :value="old('adress')" required autofocus autocomplete="adress" />
            </div>
            </div>

           
            <div class="form-group row">
                                   
            <div class="col-sm-6 mb-3 mb-sm-0">  
                <x-jet-label for="phonenum" value="{{ __('Numero Telefonico') }}" />
                <x-jet-input id="phonenum" class="form-control form-control-user" type="text" name="phonenum" :value="old('phonenum')" required autofocus autocomplete="phonenum" />
            </div>

            <div class="col-sm-6">
                <x-jet-label for="cf" value="{{ __('Codice Fiscale') }}" />
                <x-jet-input id="cf" class="form-control form-control-user" type="text" name="cf" :value="old('cf')" required autofocus autocomplete="cf" />
            </div>
</div>
<div class="form-group row">
                                   
                                   <div class="col-sm-6 mb-3 mb-sm-0">
                <x-jet-label for="albo" value="{{ __('Codice Albo') }}" />
                <x-jet-input id="albo" class="form-control form-control-user" type="text" name="albo" :value="old('albo')" required autofocus autocomplete="albo" />
            </div>

            <div class="col-sm-6">
                <x-jet-label for="borndate" value="{{ __('Data Di Nascita') }}" />
                <x-jet-input id="borndate" class="form-control form-control-user" type="date" name="borndate" :value="old('borndate')" required autofocus autocomplete="borndate" />
            </div>
</div>
<div class="form-group row">
                                   
                                   <div class="col-sm-6 mb-3 mb-sm-0">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="form-control form-control-user" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="col-sm-6">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="form-control form-control-user" type="password" name="password" required autocomplete="new-password" />
            </div>
</div>
<div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="form-control form-control-user" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
</div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="text-center">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="btn btn-primary btn-user btn-block">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
 
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
                                </x-jet-authentication-card>
</html>
