@extends('layouts.public')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 p-4">
        <form action="{{ route('project.comments', ['code' => $project->code]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl w-full max-w-lg overflow-hidden">

                <!-- 🔹 Header / Title -->
                <div class="px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                    <p class="text-gray-600 dark:text-gray-300 text-center">
                        {{ $project->description }}
                    </p>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ json_decode($project->details, true)['texto'] ?? '' }}
                    </p>
                </div>

                <!-- 🔹 Body -->
                <div class="px-8 py-6 space-y-4">
                    <label for="comments" class="block text-sm font-medium text-gray-400">
                        Comments
                    </label>
                    <textarea
                        id="comments"
                        name="comments"
                        rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
               focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Write your comments here..."></textarea>
                </div>

                <!-- 🔹 Footer -->
                <div class="px-8 py-6 border-t border-gray-200 dark:border-gray-700 flex justify-between gap-4">
                    <!-- Botón start -->
                    @if($project->status !== 'completed')
                        <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg text-lg font-medium">
                            Save
                        </button>
                    @else
                        <p class="text-success">This project has been completed!</p>
                    @endif
                </div>
            </div>
        </form>
    </div>




@endsection
