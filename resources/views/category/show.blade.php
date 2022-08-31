<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            {{ __('Category Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p class="text-center text-green-600 text-2xl font-bold mb-5">Posts from {{$category->name}}</p>

                    @if(!empty($posts))
                    <div class="grid grid-cols-2 gap-3 m-3">
                        @foreach($posts as $post)

                            <a href="/post/{{$post->id}}" class="flex p-3 pb-7 mb-3 bg-gray-200 rounded-lg hover:bg-green-100 hover:shadow-xl focus:bg-green-100 focus:shadow-xl focus:outline-none">

                                {{-- <div class="flex-none bg-green-200 text-gray-500">
                                    <img class="h-44 w-32" src="{{asset('storage/'.$post->post_cover)}}" alt="post cover">
                                </div> --}}
                                <div class="flex-1 mx-6">
                                    <p class="text-base mt-4"><span class="p-1 bg-green-200 rounded-lg">{{$post->category->name}}</span></p>
                                    <p class="mt-2 text-lg leading-6 font-medium text-green-700">{{$post->title}}</p>
                                    <span class="mt-2 text-base text-gray-400">Written by: <span class="text-green-500">{{$post->user->name}}</span></span>
                                    <p class="text-justify mt-2 text-base text-gray-600">{{$post->subtitle}}</p>
                                </div>
                            </a>

                        @endforeach
                    </div>
                    @else
                        <p class="py-8">No posts Found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
