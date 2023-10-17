<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 text-white">
        <form action="{{ route('scorm.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                <input type="file" name="zip" id="zip" class="file-input file-input-bordered file-input-primary w-full max-w-xs">
            </div>
            <div class="mb-4">
                <button class="btn btn-primary" type="submit">send</button>
            </div>
        </form>
    </div>
</x-app-layout>
