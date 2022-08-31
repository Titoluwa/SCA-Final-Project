<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p class="text-center text-green-600 text-2xl font-bold mb-3">{{$post->title}}</p>
                    <p class="text-center text-green-400 text-xl font-medium mb-3">{{$post->subtitle}} </p>
                    <p class="text-green-800 font-semibold m-3"><span class="p-2 rounded bg-green-100">{{$post->category->name}}</span></p>
                    <p class="text-base text-justify mx-10">{{$post->content}}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
