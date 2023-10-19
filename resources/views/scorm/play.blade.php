<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('play scorm') }}
        </h2>
    </x-slot>
    <div class=" px-4 text-white">
        <script type="text/javascript">
            var settings = {
                "url": "{{ route('scorm.play', ['uuid' => $item->uuid]) }}",
                "lmsUrl": "{{ route('scorm.play', ['uuid' => $item->uuid]) }}",
                "trackurl": "{{ route('scorm.track', ['uuid' => $item->uuid]) }}",
                "headers": {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                "data": {
                    "uuid": "{{ $item->uuid }}"
                },
                };
            window.API = new Scorm12API(settings);
            console.log(window.API);
            var data = window.API.cmi;
            console.log(settings.data);

            window.API.on('LMSInitialize', function() {
                console.log('LMSInitialize');
                createTracking();
            });

            window.API.on('LMSCommit', function() {
                console.log('LMSCommit');
                updateTracking();
            })

            function createTracking() {
               axios.post('{{ route('scorm.track', ['uuid' => $item->uuid]) }}', {
                   _token: '{{ csrf_token() }}',
                   uuid: '{{ $item->uuid }}'
               }).then(response => {
                   console.log(response.data);
               }).catch(error => {
                   console.log(error);
               })
                console.log("tracking")
            }

            function updateTracking() {
                axios.post('{{ route('scorm.track.update', ['uuid' => $item->uuid]) }}', {
                    _token: '{{ csrf_token() }}',
                    uuid: '{{ $item->uuid }}',
                    data: data
                }).then(response => {
                    console.log(response.data);
                }).catch(error => {
                    console.log(error);
                })
            }




        </script>
        <iframe src="{{asset('storage/8a5e12de-d24d-4955-9e7b-2b61f4849728/index_scorm.html')}}" width="800" height="400"></iframe>
    </div>
</x-app-layout>
