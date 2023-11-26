<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter un évènement') }}
        </h2>
    </x-slot>

    <script>
        function save() {
            const userToken = "{{ auth()->user()->getRememberToken() }}";
            const data = {}; // Créer un objet pour stocker les données non nulles

            const addIfNotNull = (field, value) => {
                if (value !== null && value !== undefined && value !== '') {
                    data[field] = value;
                }
            };

            const title = $('#title').val();
            const description = $('#description').val();
            const date = $('#date').val();
            const imageURL = $('#imageURL').val();
            const price = $('#price').val();
            const category_id = $('#category_id').val();
            const adresse = $('#adresse').val();
            const is_food_on_site = $('#is_food_on_site').val();
            const registered_limit = $('#registered_limit').val();
            const team_style = $('#team_style').val();
            const creator_id = $('#creator_id').val();
            const status = $('#status').val();

            // Ajouter les champs non nuls aux données
            addIfNotNull('title', title);
            addIfNotNull('description', description);
            addIfNotNull('date', date);
            addIfNotNull('imageURL', imageURL);
            addIfNotNull('price', price);
            addIfNotNull('category_id', category_id);
            addIfNotNull('adresse', adresse);
            addIfNotNull('is_food_on_site', is_food_on_site ? 1 : 0);
            addIfNotNull('registered_limit', registered_limit);
            addIfNotNull('team_style', team_style);
            addIfNotNull('creator_id', creator_id);
            addIfNotNull('status', status);

            if (Object.keys(data).length > 5) {
            $.ajax({
                url: '/api/event',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + userToken
                },
                data: data,
                success: function () {
                    window.location.href = '/events';
                },
                error: function (result) {
                    console.log(result);
                    console.log(data);
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
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title *</label>
                            <input type="text" name="title" id="title" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <input type="text" name="description" id="description" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date *</label>
                            <input type="datetime-local" name="date" id="date" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- ImageURL -->
                        <div class="mb-4">
                            <label for="imageURL" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ImageURL</label>
                            <input type="text" name="imageURL" id="imageURL" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price *</label>
                            <input type="number" name="price" id="price" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Category_id -->
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category_id</label>
                            <input type="number" name="category_id" id="category_id" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Adresse -->
                        <div class="mb-4">
                            <label for="adresse" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse *</label>
                            <input type="text" name="adresse" id="adresse" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Is_food_on_site -->
                        <div class="mb-4">
                            <label for="is_food_on_site" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nourriture sur place ?</label>
                            <input type="checkbox" name="is_food_on_site" id="is_food_on_site" min="0" max="1" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Registered_limit -->
                        <div class="mb-4">
                            <label for="registered_limit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre maximum de bouliste *</label>
                            <input type="number" name="registered_limit" id="registered_limit" min="0" max="1000" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Team_style -->
                        <div class="mb-4">
                            <label for="team_style" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Team_style *</label>
                            <input type="text" name="team_style" id="team_style" min="0" max="1000" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Creator_id -->
                        <div class="mb-4">
                            <label for="creator_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Creator_id</label>
                            <input type="number" name="creator_id" id="creator_id" min="0" max="1000" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <input type="text" name="status" id="status" min="0" max="1000" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
