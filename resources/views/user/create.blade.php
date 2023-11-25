<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter un utilisateur') }}
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

            const firstname = $('#firstname').val();
            const lastname = $('#lastname').val();
            const email = $('#email').val();
            const password = $('#password').val();
            const imageURL_fav_balls = $('#imageURL_fav_balls').val();
            const imageURL_profile = $('#imageURL_profile').val();
            const fav_balls_name = $('#fav_balls_name').val();
            const rank_id = $('#rank_id').val();
            const birth_date = $('#birth_date').val();
            const fav_drink_id = $('#fav_drink_id').val();
            const doublette_user_id = $('#doublette_user_id').val();
            const role_id = $('#role_id').val();
            const status = $('#status').val();

            // Ajouter les champs non nuls aux données
            addIfNotNull('firstname', firstname);
            addIfNotNull('lastname', lastname);
            addIfNotNull('email', email);
            addIfNotNull('password', password);
            addIfNotNull('imageURL_fav_balls', imageURL_fav_balls);
            addIfNotNull('imageURL_profile', imageURL_profile);
            addIfNotNull('fav_balls_name', fav_balls_name);
            addIfNotNull('rank_id', rank_id);
            addIfNotNull('birth_date', birth_date);
            addIfNotNull('fav_drink_id', fav_drink_id);
            addIfNotNull('doublette_user_id', doublette_user_id);
            addIfNotNull('role_id', role_id);
            addIfNotNull('status', status);

            // Envoyer les données uniquement si au moins un champ est non nul
            if (Object.keys(data).length > 5) {
                $.ajax({
                    url: '/api/user',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + userToken
                    },
                    data: data,
                    success: function (result) {
                        console.log('success');
                        window.location.href = '/users';
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
                        <!-- Firstname -->
                        <div class="mb-4">
                            <label for="firstname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Firstname *</label>
                            <input type="text" name="firstname" id="firstname" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Lastname -->
                        <div class="mb-4">
                            <label for="lastname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lastname *</label>
                            <input type="text" name="lastname" id="lastname" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email *</label>
                            <input type="text" name="email" id="email" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password *</label>
                            <input type="password" name="password" id="password" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- ImageURL_fav_balls -->
                        <div class="mb-4">
                            <label for="imageURL_fav_balls" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ImageURL_fav_balls</label>
                            <input type="text" name="imageURL_fav_balls" id="imageURL_fav_balls" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- ImageURL_profile -->
                        <div class="mb-4">
                            <label for="imageURL_profile" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ImageURL_profile</label>
                            <input type="text" name="imageURL_profile" id="imageURL_profile" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Fav_balls_name -->
                        <div class="mb-4">
                            <label for="Fav_balls_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fav_balls_name</label>
                            <input type="text" name="Fav_balls_name" id="Fav_balls_name" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Rank_id -->
                        <div class="mb-4">
                            <label for="rank_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rank_id</label>
                            <input type="number" name="rank_id" id="rank_id" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Birth_date -->
                        <div class="mb-4">
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birth_date *</label>
                            <input type="date" name="birth_date" id="birth_date" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Fav_drink_id -->
                        <div class="mb-4">
                            <label for="Fav_drink_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fav_drink_id</label>
                            <input type="number" name="Fav_drink_id" id="Fav_drink_id" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Doublette_user_id -->
                        <div class="mb-4">
                            <label for="Doublette_user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Doublette_user_id</label>
                            <input type="number" name="Doublette_user_id" id="Doublette_user_id" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Role_id -->
                        <div class="mb-4">
                            <label for="Role_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role_id</label>
                            <input type="number" name="Role_id" id="Role_id" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
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
