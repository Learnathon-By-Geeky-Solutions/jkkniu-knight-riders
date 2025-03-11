@stack('style')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <hr>
    <div class="flex h-screen bg-gray-100">

        @include('backend.partials.sidebar')
    
        @yield('content')
    </div>
</x-app-layout>
@stack('script')
