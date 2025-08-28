@extends('layouts.public')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 p-4">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl w-full max-w-lg overflow-hidden">

            <!-- 🔹 Header / Title -->
            <div class="px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-3xl font-bold text-center text-gray-900 dark:text-gray-100">
                    {{ $project->title }}
                </h1>
            </div>

            <!-- 🔹 Body con collapse -->
            <div class="px-8 py-6 space-y-4" x-data="{ open: false }">
                <p class="text-gray-600 dark:text-gray-300 text-center">
                    {{ $project->description }}
                </p>

                <!-- Location section -->
                <div class="flex items-center justify-center text-gray-600 dark:text-gray-300 space-x-2">
                    <!-- Location icon (SVG) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5s-3 1.343-3 3 1.343 3 3 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c-4-4-6-8-6-11a6 6 0 1112 0c0 3-2 7-6 11z" />
                    </svg>
                    <p class="text-gray-600 dark:text-gray-300"> <a href="https://maps.google.com/?q={{ urlencode($project->address) }}" target="_blank">
                            <span> Location:{{$project->address }}</span>
                        </a>
                    </p>
                </div>



                <!-- Collapse -->
                <div x-show="open" x-transition class="space-y-3">
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ json_decode($project->details, true)['texto'] ?? '' }}
                    </p>
                    @if(isset(json_decode($project->details, true)['imagenes']))
                        @foreach(json_decode($project->details, true)['imagenes'] as $img)
                            <img src="{{ $img }}" alt="Detalle" class="rounded-lg shadow-md mx-auto">
                        @endforeach
                    @endif

                </div>

                <!-- Botón toggle -->
                <button
                    @click="open = !open"
                    class="text-blue-500 hover:underline text-sm font-medium">
                    <span x-show="!open">See more ↓</span>
                    <span x-show="open">See less ↑</span>
                </button>
            </div>

            <!-- 🔹 Footer -->
            <div class="px-8 py-6 border-t border-gray-200 dark:border-gray-700">

                @if($project->status !== 'completed')
                    <form action="{{route('project.start',['code' => $project->code])}}" method="GET">
                        @csrf
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg text-lg font-medium">
                            Continue
                        </button>
                    </form>
                    <p class="text-sm text-red-500 mt-2 text-center">
                        ⚠ Please make sure to review everything before starting.
                    </p>
                @else
                    <p class="text-green-400 text-center">This project has been completed!</p>
                @endif


            </div>
        </div>
    </div>

@endsection
