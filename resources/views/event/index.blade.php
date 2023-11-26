<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Évènements') }}
            </h2>
            <a href="/eventCreate" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline-green">
                Ajouter un évenement
            </a>
        </div>

    </x-slot>

    <script>
        function destroy(eventId) {
            if (confirm(`Voulez vous vraiment supprimer l'évènement ${eventId} ?`)) {
                const userToken = "{{ auth()->user()->getRememberToken() }}";
                $.ajax({
                    url: '/api/event/' + eventId,
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

        function edit(eventId) {
            window.location.href = '/eventEdit/' + eventId;
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">imageURL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">category_id</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">adresse</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">is_food_on_site</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">registered_limit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">team_style</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">creator_id</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">created_at</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">updated_at</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($events as $event)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->imageURL }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->category_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->adresse }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->is_food_on_site }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->registered_limit }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->team_style }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->creator_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->created_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->updated_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-red-500 text-white hover:bg-red-700 py-2 px-4 rounded focus:outline-none focus:shadow-outline-red" onclick="destroy({{ $event->id }})">Delete</button>
                                    <button class="bg-blue-500 text-white hover:bg-blue-700 py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue" onclick="edit({{ $event->id }})">Edit</button>
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
