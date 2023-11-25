<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter une category') }}
        </h2>
    </x-slot>

    <script>
        function save() {
            const userToken = "{{ auth()->user()->getRememberToken() }}";

            // Créer un objet pour stocker les données non nulles
            const data = {};

            const addIfNotNull = (field, value) => {
                if (value !== null && value !== undefined && value !== '') {
                    data[field] = value;
                }
            };

            const name = $('#name').val();
            const status = $('#status').val();

            // Ajouter les champs non nuls aux données
            addIfNotNull('name', name);
            addIfNotNull('status', status);

            // Envoyer les données uniquement si au moins un champ est non nul
            if (Object.keys(data).length > 0) {
                $.ajax({
                    url: '/api/category',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + userToken
                    },
                    data: data,
                    success: function (result) {
                        console.log('success');
                        window.location.href = '/categories';
                    },
                    error: function (result) {
                        console.log(result);
                        alert('error, watch console');
                    }
                });
            } else {
                alert('Veuillez remplir au moins les champs avec un astérisque.');
            }
        }

    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form onsubmit=save()>
                        <!-- name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom *</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <input type="text" name="Status" id="status" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue">
                                Ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
