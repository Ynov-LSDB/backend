<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter un drinkEvent') }}
        </h2>
    </x-slot>

    <script>
        function save() {
            const userToken = "{{ auth()->user()->getRememberToken() }}";
                $.ajax({
                    url: '/api/drinkEvent',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + userToken
                    },
                    data: {
                        drink_id: $('#drink_id').val(),
                        event_id: $('#event_id').val()
                    },
                    success: function () {
                        console.log('success');
                        window.location.href = '/drinkEvents';
                    },
                    error: function (result) {
                        console.log(result);
                        alert('error, watch console');
                    }
                });
        }

    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form onsubmit=save()>
                        <!-- name -->
                        <div class="mb-4">
                            <label for="drink_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">drink_id *</label>
                            <input type="number" name="drink_id" id="drink_id" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="event_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">event_id *</label>
                            <input type="number" name="event_id" id="event_id" class="mt-1 p-2 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
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
