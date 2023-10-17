<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <div class="col">
                        <!--Nama diambil dari database-->
                        <span style="font-size: x-large;">{{$user->name}}</span>
                    </div>
                    <div class="col-md-5 text-center">
                        <!--Gambar sesuai gambar profil-->
                        <img src="{{ $user->profile_pic }}" alt="Example Image" style="border: 2px solid #000000; border-radius: 50%;" width="180" height="180">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
