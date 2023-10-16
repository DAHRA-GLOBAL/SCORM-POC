<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Main Page') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 text-white">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <iframe src="{{ asset('/app/0a954e01-27e6-4198-a46b-6e7a858d2b3e/Playing/Playing.html') }}" width="100%" height="100%" style="border: none;" allowfullscreen="" loading="lazy"></iframe>
        </div>
{{--        <script>--}}
{{--            var settings = {--}}
{{--                "url": "{{ route('scorm.index') }}",--}}
{{--            }--}}
{{--            // window.API = new Scorm12API(settings);--}}
{{--            window.API_1484_11 = new Scorm2004API(settings);--}}
{{--            // Listen for LMSInitialize event in SCORM 1.2--}}
{{--            // scorm12API.on('LMSInitialize', () => {--}}
{{--            //     console.log('SCORM 1.2 initialized');--}}
{{--            // });--}}
{{--            var hello = window.API_1484_11.launch();--}}
{{--            console.log(hello);--}}

{{--            // Listen for SetValue event on cmi.learner_id in SCORM 2004--}}
{{--            scorm2004API.on('SetValue.cmi.learner_id', (CMIElement, value) => {--}}
{{--                console.log('Learner ID updated:', value);--}}
{{--            });--}}

{{--        </script>--}}
    </div>
</x-app-layout>
