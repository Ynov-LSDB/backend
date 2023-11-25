<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Édition d\'une boisson') }}
        </h2>
    </x-slot>

    <script>
        function save() {
            if (confirm(`modifier la boisson {{$drink->id}} ?`)) {
                const userToken = "{{ auth()->user()->getRememberToken() }}";
                $.ajax({
                    url: '/api/drink/' + {{$drink->id}},
                    type: 'PUT',
                    headers: {
                        'Authorization': 'Bearer ' + userToken
                    },
                    data: {
                        title: $('#title').val(),
                        description: $('#description').val(),
                        degree: $('#degree').val(),
                        imageURL: $('#imageURL').val(),
                        is_cuite_possible: $('#is_cuite_possible').val(),
                        nbr_ice_max: $('#nbr_ice_max').val(),
                        status: $('#status').val(),
                    },
                    success: function() {
                        window.location.href = '/drinks';
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
                            <input type="text" name="title" id="title" value="{{ $drink->title }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <input type="text" name="description" id="description" value="{{ $drink->description }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Degree -->
                        <div class="mb-4">
                            <label for="degree" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Degree</label>
                            <input type="number" name="degree" id="degree" value="{{ $drink->degree }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- ImageURL -->
                        <div class="mb-4">
                            <label for="imageURL" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ImageURL</label>
                            <input type="text" name="imageURL" id="imageURL" value="{{ $drink->imageURL }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- is_cuite_possible -->
                        <div class="mb-4">
                            <label for="is_cuite_possible" class="block text-sm font-medium text-gray-700 dark:text-gray-300">is_cuite_possible</label>
                            <input type="checkbox" name="is_cuite_possible" id="is_cuite_possible" value="{{ $drink->is_cuite_possible }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- nbr_ice_max -->
                        <div class="mb-4">
                            <label for="nbr_ice_max" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre maximum de glaçon(s)</label>
                            <input type="number" name="nbr_ice_max" id="nbr_ice_max" value="{{ $drink->nbr_ice_max }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="lastname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <input type="text" name="lastname" id="lastname" value="{{ $drink->status }}" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
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
