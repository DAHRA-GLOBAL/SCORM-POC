<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Main Page') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @foreach($scorms as $scorm)
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-white ">
                    <div class="card w-96 glass bg-violet-400">
                        <figure><img src="https://images.unsplash.com/photo-1618609255761-6392d4383957?auto=format&fit=crop&q=80&w=2070&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="car!"/></figure>
                        <div class="card-body">
                            <h2 class="card-title">{{$scorm->title}}</h2>
                            <p>{{$scorm->identifier}}</p>
                            @foreach($scorm->scoTrackings as $sco)
                                <progress class="progress progress-primary w-56" value="{{$sco->progression}}" max="100"></progress>
                               <div class="flex justify-between my-2">
                                 <div>
                                     <p class="text-white">Time spent on this lesson</p>
                                     <div class="radial-progress bg-primary text-primary-content border-4 border-primary" style="--value:{{number_format( $sco->session_time/$sco->total_time_int*100,2, '.', '')}};">
                                         {{number_format( $sco->session_time/$sco->total_time_int*100,2, '.', '')}}%</div>
                                 </div>
                                   <div class="stats shadow w-fit overflow-hidden items-center justify-center">

                                       <div class="stat">
                                           <div class="stat-title">Lesson Total time</div>
                                           <div class="stat-value">{{$sco->total_time_int}}</div>
                                       </div>

                                   </div>
                               </div>
                            @endforeach
                            <div class="card-actions justify-end">
                                <a href="{{route('scorm.show',$scorm->uuid)}}">
                                    <button class="btn btn-primary" type="submit">Play</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    </div>
</x-app-layout>
