<x-app-layout>
    <x-slot name="header">
         </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if( Auth::user()->type  == 'D')
                    <x-info/> 
                @endif
                @if( Auth::user()->type  == 'A')
                    <x-infostudio/> 
                @endif
            </div>
</x-app-layout>
