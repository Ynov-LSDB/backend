<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Utilisateurs') }}
            </h2>
            <a href="#" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline-green">
                Ajouter un utilisateur
            </a>
        </div>

    </x-slot>

    <script>
        function deleteUser(userId) {
            if (confirm(`Voulez vous vraiment supprimer utilisateur ${userId} ?`)) {
                const userToken = "{{ auth()->user()->getRememberToken() }}";
                console.log(userToken);
                $.ajax({
                    url: '/api/user/' + userId,
                    type: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + userToken
                    },
                    success: function() {
                        window.location.reload(true);
                    }
                });
            }
        }

        function editUser(userId) {
            window.location.href = '/userEdit/' + userId;
        }
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Firstname</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Lastname</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">imageURL_fav_balls</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">imageURL_profile</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">fav_balls_name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">rank_id</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">birth_date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">fav_drink_id</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">doublette_user_id</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">role_id</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->firstname }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->lastname }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->imageURL_fav_balls }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->imageURL_profile }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->fav_balls_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->rank_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->birth_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->fav_drink_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->doublette_user_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->role_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-red-500 text-white hover:bg-red-700 py-2 px-4 rounded focus:outline-none focus:shadow-outline-red" onclick="deleteUser({{ $user->id }})">Delete</button>
                                    <button class="bg-blue-500 text-white hover:bg-blue-700 py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue" onclick="editUser({{ $user->id }})">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
