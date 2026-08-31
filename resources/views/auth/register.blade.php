<x-guest-layout>

    <div class="civic-login-title">
        Créer votre compte
    </div>

    <div class="civic-login-subtitle">
        Rejoignez CivicPulse AI pour participer à l'amélioration de votre ville.
    </div>

    @if ($errors->any())
        <div class="civic-session-status"
             style="padding:12px 15px;background:#fff0f0;color:#c62828;border-radius:10px;font-size:13px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">

        @csrf

        <!-- Nom complet -->

        <div class="civic-field">

            <label for="name" class="civic-label">
                Nom complet
            </label>

            <div class="civic-input-wrapper">

                <input
                    id="name"
                    class="civic-input"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Votre nom complet"
                >

            </div>

            @error('name')
                <div class="civic-error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Adresse e-mail -->

        <div class="civic-field">

            <label for="email" class="civic-label">
                Adresse e-mail
            </label>

            <div class="civic-input-wrapper">

                <input
                    id="email"
                    class="civic-input"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder="exemple@email.com"
                >

            </div>

            @error('email')
                <div class="civic-error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Mot de passe -->

        <div class="civic-field">

            <label for="password" class="civic-label">
                Mot de passe
            </label>

            <div class="civic-input-wrapper">

                <input
                    id="password"
                    class="civic-input"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Votre mot de passe"
                >

            </div>

            @error('password')
                <div class="civic-error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Confirmation -->

        <div class="civic-field">

            <label for="password_confirmation" class="civic-label">
                Confirmer le mot de passe
            </label>

            <div class="civic-input-wrapper">

                <input
                    id="password_confirmation"
                    class="civic-input"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirmez votre mot de passe"
                >

            </div>

            @error('password_confirmation')
                <div class="civic-error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Connexion -->

        <button
            type="submit"
            class="civic-button"
        >
            Créer mon compte
        </button>

    </form>


    <div class="civic-register">

        Vous avez déjà un compte ?

        <a href="{{ route('login') }}">
            Se connecter
        </a>

    </div>

</x-guest-layout>