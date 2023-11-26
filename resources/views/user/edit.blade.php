<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Édition d\'utilisateur') }}
        </h2>
    </x-slot>

    <script>
        function save() {
            if (confirm(`modifier l'utilisateur {{$user->id}} ?`)) {
                const userToken = "{{ auth()->user()->getRememberToken() }}";
                $.ajax({
                    url: '/api/user/' + {{$user->id}},
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + userToken
                    },
                    data: {
                        firstname: $('#firstname').val(),
                        lastname: $('#lastname').val(),
                        email: $('#email').val(),
                        imageURL_fav_balls: $('#imageURL_fav_balls').val(),
                        imageURL_profile: $('#imageURL_profile').val(),
                        fav_balls_name: $('#fav_balls_name').val(),
                        rank_id: $('#rank_id').val(),
                        birth_date: $('#birth_date').val(),
                        fav_drink_id: $('#fav_drink_id').val(),
                        doublette_user_id: $('#doublette_user_id').val(),
                        role_id: $('#role_id').val(),
                        status: $('#status').val(),
                    },
                    success: function() {
                        window.location.href = '/users';
                    },
                    error: function(result) {
                        console.log(result)
                        alert('error');
                    }
                });
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
                            <label for="firstname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Firstname</label>
                            <input type="text" name="firstname" id="firstname" value="{{ $user->firstname }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Lastname -->
                        <div class="mb-4">
                            <label for="lastname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lastname</label>
                            <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="text" name="email" id="email" value="{{ $user->email }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- ImageURL_fav_balls -->
                        <div class="mb-4">
                            <label for="imageURL_fav_balls" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ImageURL_fav_balls</label>
                            <input type="text" name="imageURL_fav_balls" id="imageURL_fav_balls" value="{{ $user->imageURL_fav_balls }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- ImageURL_profile -->
                        <div class="mb-4">
                            <label for="imageURL_profile" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ImageURL_profile</label>
                            <input type="text" name="imageURL_profile" id="imageURL_profile" value="{{ $user->imageURL_profile }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Fav_balls_name -->
                        <div class="mb-4">
                            <label for="lastname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fav_balls_name</label>
                            <input type="text" name="lastname" id="lastname" value="{{ $user->fav_balls_name }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Rank_id -->
                        <div class="mb-4">
                            <label for="rank_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rank_id</label>
                            <input type="number" name="rank_id" id="rank_id" value="{{ $user->rank_id }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Birth_date -->
                        <div class="mb-4">
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birth_date</label>
                            <input type="date" name="birth_date" id="birth_date" value="{{ $user->birth_date }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Fav_drink_id -->
                        <div class="mb-4">
                            <label for="lastname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fav_drink_id</label>
                            <input type="number" name="lastname" id="lastname" value="{{ $user->fav_drink_id }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Doublette_user_id -->
                        <div class="mb-4">
                            <label for="lastname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Doublette_user_id</label>
                            <input type="number" name="lastname" id="lastname" value="{{ $user->doublette_user_id }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Role_id -->
                        <div class="mb-4">
                            <label for="lastname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role_id</label>
                            <input type="number" name="lastname" id="lastname" value="{{ $user->role_id }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="lastname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <input type="text" name="lastname" id="lastname" value="{{ $user->status }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
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
