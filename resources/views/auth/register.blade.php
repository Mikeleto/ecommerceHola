<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" dusk="9s" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" dusk="2b" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" dusk="a2" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            //añadir los campos a la vista
            <div>
                <x-jet-label for="bio"  value="{{ __('Bio') }}" />
                <x-jet-input id="bio" class="block mt-1 w-full" type="text" name="bio" :value="old('bio')" required autofocus autocomplete="bio" />
            </div>
            <div>
                <x-jet-label for="twitter" value="{{ __('Twitter') }}" />
                <x-jet-input id="twitter" class="block mt-1 w-full" type="text" name="twitter" :value="old('twitter')" required autofocus autocomplete="twitterF" />
            </div>
//crear campo para las profesiones en la vista


            <div>
                <div class="form-group">
                    <label for="profession_name" >Profesión</label>
                    <select id="profession_name" name="profession_name" class="form-control">
                        <option value="">Seleccione una opción</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Ingeniero">Ingeniero</option>
                        <option value="Obrero">Obrero  </option>
                        <option>Otros</option>
                    </select>
                </div>
                <x-jet-label for="profession_name" value="{{ __('Profession_name') }}" />
                <x-jet-input id="profession_name" class="block mt-1 w-full" type="text" name="profession_name" :value="old('profession_name')" />

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

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<script>
    function showInput(){
        var select = document.getElementById("profession_name");
        var div = document.getElementById("other_profession");

        if(select.value == 'otros'){
            div.classList.remove("hidden");
        }else{
            div.classList.add("hidden");
        }
    }
</script>
