<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Utilisateurs') }}
        </h2>
    </x-slot>

    <script>
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                const userToken = "{{ auth()->user()->getRememberToken() }}";
                console.log(userToken);
                $.ajax({
                    url: '/api/user/' + userId,
                    type: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + userToken
                    },
                    success: function(result) {
                        window.location.reload(true);
                    }
                });
            }
        }


        function editUser(userId) {
            // Add your edit logic here
            alert('Edit user with ID: ' + userId);
        }
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <div class="table-wrapper" style="overflow-x: auto;">
                            <table style="width: 400%; table-layout: fixed;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>ImageURL_fav_balls</th>
                                    <th>ImageURL_profile</th>
                                    <th>Fav_balls_name</th>
                                    <th>Rank_id</th>
                                    <th>Birth_date</th>
                                    <th>Fav_drink_id</th>
                                    <th>Doublette_user_id</th>
                                    <th>Triplette_id</th>
                                    <th>Role_id</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr style="margin-bottom: 10px;">
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->firstname }}</td>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->imageURL_fav_balls }}</td>
                                        <td>{{ $user->imageURL_profile }}</td>
                                        <td>{{ $user->fav_balls_name }}</td>
                                        <td>{{ $user->rank_id }}</td>
                                        <td>{{ $user->birth_date }}</td>
                                        <td>{{ $user->fav_drink_id }}</td>
                                        <td>{{ $user->doublette_user_id }}</td>
                                        <td>{{ $user->triplette_id }}</td>
                                        <td>{{ $user->role_id }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td class="action-buttons">
                                            <button class="delete-btn btn-red" onclick="deleteUser({{ $user->id }})">Delete</button>
                                            <button class="edit-btn" onclick="editUser({{ $user->id }})">Edit</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
