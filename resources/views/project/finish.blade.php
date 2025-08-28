@extends('layouts.public')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 p-4">
        <form action="{{ route('project.finish', ['code' => $project->code]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl w-full max-w-lg overflow-hidden">

                <!-- 🔹 Header / Title -->
                <div class="px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                    <p class="text-sm text-red-500 mt-2 text-center">
                        ⚠ Please take a photo post-install/fix
                    </p>
                </div>

                <!-- 🔹 Body -->
                <div class="px-8 py-6 space-y-4">
                    <label for="photos" class="block text-gray-400 mb-2">Upload Photos</label>
                    <input
                        type="file"
                        name="photos[]"
                        id="photos"
                        accept="image/*"
                        multiple
                        class="block w-full text-sm text-gray-500
                           file:mr-4 file:py-2 file:px-4
                           file:rounded file:border-0
                           file:text-sm file:font-semibold
                           file:bg-blue-50 file:text-blue-700
                           hover:file:bg-blue-100"
                    >

                    <!-- Campo oculto combinado lat,long -->
                    <input type="hidden" name="location" id="location">
                </div>

                <!-- 🔹 Footer -->
                <div class="px-8 py-6 border-t border-gray-200 dark:border-gray-700 flex justify-between gap-4">
                    <!-- Botón cancelar -->
                    <a href="{{ url()->previous() }}"
                       class="w-1/2 text-center bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg text-lg font-medium">
                        Cancel
                    </a>

                    <!-- Botón start -->
                    @if($project->status !== 'completed')
                        <button type="submit"
                                class="w-1/2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg text-lg font-medium">
                            Finish
                        </button>
                    @else
                        <p class="text-green-400 text-center">This project has been completed!</p>
                    @endif
                </div>
            </div>
        </form>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (!navigator.geolocation) {
                console.warn('Geolocalización no soportada en este navegador.');
                return;
            }

            // Verificar estado del permiso
            navigator.permissions.query({ name: 'geolocation' }).then(result => {
                if (result.state === 'granted') {
                    // Usuario ya dio permiso
                    obtenerUbicacion();
                } else if (result.state === 'prompt') {
                    // El navegador todavía puede pedir permiso
                    obtenerUbicacion();
                } else if (result.state === 'denied') {
                    // Usuario denegó → no se puede forzar, solo guiar
                    alert('Please enable and allow location services and reload the site.');
                }
            });
        });

        function obtenerUbicacion() {
            navigator.geolocation.getCurrentPosition(
                position => {
                    const { latitude, longitude } = position.coords;
                    document.getElementById('location').value = `${latitude},${longitude}`;
                },
                error => {
                    console.warn('Location unavailable:', error.message);
                }
            );
        }
    </script>
@endsection
