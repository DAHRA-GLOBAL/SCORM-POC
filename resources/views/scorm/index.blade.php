<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Main Page') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 text-white">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @foreach($scorms as $scorm)
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-white">
                  {{$scorm->title}}
                </div>

            @endforeach
        </div>

    </div>
</x-app-layout>
