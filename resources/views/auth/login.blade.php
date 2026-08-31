<x-guest-layout>

    <div class="civic-login-title">
        Bienvenue 👋
    </div>

    <div class="civic-login-subtitle">
        Connectez-vous à votre espace CivicPulse AI
    </div>

    @if (session('status'))
        <div class="civic-session-status"
             style="padding:12px 15px;background:#e9f8f0;color:#087443;border-radius:10px;font-size:13px;">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="civic-session-status"
             style="padding:12px 15px;background:#fff0f0;color:#c62828;border-radius:10px;font-size:13px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <!-- Email -->

        <div class="civic-field">

            <label for="email" class="civic-label">
                Adresse email
            </label>

            <div class="civic-input-wrapper">

                <input
                    id="email"
                    class="civic-input"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
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
                    autocomplete="current-password"
                    placeholder="Votre mot de passe"
                >

            </div>

            @error('password')
                <div class="civic-error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Options -->

        <div class="civic-options">

            <label class="civic-remember">

                <input
                    type="checkbox"
                    name="remember"
                    id="remember_me"
                >

                <span>
                    Se souvenir de moi
                </span>

            </label>

            @if (Route::has('password.request'))

                <a
                    class="civic-forgot"
                    href="{{ route('password.request') }}"
                >
                    Mot de passe oublié ?
                </a>

            @endif

        </div>

        <!-- Connexion -->

        <button
            type="submit"
            class="civic-button"
        >
            Se connecter
        </button>

    </form>

    @if (Route::has('register'))

        <div class="civic-register">

            Vous n'avez pas encore de compte ?

            <a href="{{ route('register') }}">
                Créer un compte
            </a>

        </div>

    @endif

</x-guest-layout>