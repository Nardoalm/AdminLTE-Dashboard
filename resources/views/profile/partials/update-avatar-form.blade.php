<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Foto de perfil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Atualize sua foto de perfil.") }}
        </p>
    </header>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mt-6 space-y-6">
            <div class="upload-container">
                <label for="foto-upload" class="custom-file-upload">
                    <i class="fas fa-upload"></i> Escolher Foto
                </label>
                <input id="foto-upload" type="file" name="avatar" accept="image/*" />
                <span id="file-name">Nenhum ficheiro selecionado</span>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-success">Salvar</button>
        </div>
    </form>

    <style>
        /* 1. Esconde o input original */
        #foto-upload {
            display: none;
        }

        /* 2. Estiliza o Label como se fosse um botão */
        .custom-file-upload {
            display: inline-block;
            padding: 10px 20px;
            cursor: pointer;
            background-color: #3490dc; /* Azul Laravel */
            color: white;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        /* Efeito ao passar o rato */
        .custom-file-upload:hover {
            background-color: #2779bd;
        }

        /* Estilo para o texto do nome do ficheiro */
        #file-name {
            margin-left: 10px;
            font-size: 0.9rem;
            color: #666;
        }
    </style>

    <script>
        document.getElementById('foto-upload').addEventListener('change', function() {
            document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : "Nenhum ficheiro selecionado";
        });
    </script>
</section>
