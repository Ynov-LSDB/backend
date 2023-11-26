<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Édition d\'évènement') }}
        </h2>
    </x-slot>

    <script>
        function save() {
            if (confirm(`modifier évènement {{$event->id}} ?`)) {
                const userToken = "{{ auth()->user()->getRememberToken() }}";
                $.ajax({
                    url: '/api/event/' + {{$event->id}},
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + userToken
                    },
                    data: {
                        title: $('#title').val(),
                        description: $('#description').val(),
                        date: $('#date').val(),
                        imageURL: $('#imageURL').val(),
                        price: $('#price').val(),
                        category_id: $('#category_id').val(),
                        adresse: $('#adresse').val(),
                        is_food_on_site: $('#is_food_on_site').val(),
                        registered_limit: $('#registered_limit').val(),
                        team_style: $('#team_style').val(),
                        creator_id: $('#creator_id').val(),
                        status: $('#status').val(),
                    },
                    success: function() {
                        window.location.href = '/events';
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
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title" value="{{ $event->title }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <input type="text" name="description" id="description" value="{{ $event->description }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input type="datetime-local" name="date" id="date" value="{{ $event->date }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- ImageURL -->
                        <div class="mb-4">
                            <label for="imageURL" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ImageURL</label>
                            <input type="text" name="imageURL" id="imageURL" value="{{ $event->imageURL }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                            <input type="text" name="price" id="price" value="{{ $event->price }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Category_id -->
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category_id</label>
                            <input type="number" name="category_id" id="category_id" value="{{ $event->category_id }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Adresse -->
                        <div class="mb-4">
                            <label for="adresse" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse</label>
                            <input type="text" name="adresse" id="adresse" value="{{ $event->adresse }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Is_food_on_site -->
                        <div class="mb-4">
                            <label for="is_food_on_site" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nourriture sur place ?</label>
                            <input type="checkbox" name="is_food_on_site" id="is_food_on_site" value="{{ $event->is_food_on_site }}" min="0" max="1" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Registered_limit -->
                        <div class="mb-4">
                            <label for="registered_limit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre maximum de bouliste</label>
                            <input type="number" name="registered_limit" id="registered_limit" value="{{ $event->registered_limit }}" min="0" max="1000" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Team_style -->
                        <div class="mb-4">
                            <label for="team_style" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Team_style</label>
                            <input type="text" name="team_style" id="team_style" value="{{ $event->team_style }}" min="0" max="1000" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Creator_id -->
                        <div class="mb-4">
                            <label for="creator_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Creator_id</label>
                            <input type="number" name="creator_id" id="creator_id" value="{{ $event->creator_id }}" min="0" max="1000" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <input type="text" name="status" id="status" value="{{ $event->status }}" min="0" max="1000" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
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
