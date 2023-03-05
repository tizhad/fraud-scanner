<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Scan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button class="bg-sky-500 hover:bg-sky-700" type="submit" id="my-button">
                        <a href="{{ route('scan') }}" class="btn btn-xs btn-info pull-right">Start Scan</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




