<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Foto de perfil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Atualize sua foto de perfil.") }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <div>
            <input type="file" name="avatar" id="avatar">
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
    </div>
</section>
