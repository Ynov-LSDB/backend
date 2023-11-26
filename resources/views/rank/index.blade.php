<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Utilisateurs') }}
            </h2>
            <a href="/rankCreate" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline-green">
                Ajouter un rank
            </a>
        </div>

    </x-slot>

    <script>
        function destroy(rankId) {
            if (confirm(`Voulez vous vraiment supprimer le rank ${rankId} ?`)) {
                const userToken = "{{ auth()->user()->getRememberToken() }}";
                $.ajax({
                    url: '/api/rank/' + rankId,
                    type: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + userToken
                    },
                    success: function() {
                        window.location.reload();
                    }
                });
            }
        }

        function edit(rankId) {
            window.location.href = '/rankEdit/' + rankId;
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">created_at</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">updated_at</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($ranks as $rank)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $rank->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $rank->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $rank->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $rank->created_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $rank->updated_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-red-500 text-white hover:bg-red-700 py-2 px-4 rounded focus:outline-none focus:shadow-outline-red" onclick="destroy({{ $rank->id }})">Delete</button>
                                    <button class="bg-blue-500 text-white hover:bg-blue-700 py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue" onclick="edit({{ $rank->id }})">Edit</button>
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
