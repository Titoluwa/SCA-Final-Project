<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-3xl text-center text-green-700">Tags</h1>
                <div class="grid gap-x-8 gap-y-4 grid-cols-3">
                    <div class="col-span-2 p-4 m-3">
                        @if(session()->has("added_message"))
                            <p class="text-lg bg-green-100 p-3 rounded text-center text-green-800">New TAG created!!</p>
                        @elseif(session()->has("delete_message"))
                            <p class="text-lg bg-green-100 p-3 rounded text-center text-red-800">TAG has been Deleted!!</p>
                        @endif
                        @if (count($tags) > 0)
                            <ol>
                                @foreach ($tags as $tag)
                                    <li class="bg-green-200 m-3 p-2 rounded-xl">
                                        {{$tag->name}}
                                        <form action="tag/delete/{{$tag->id}}" method="POST" class="float-right mr-3 text-red-500">
                                            @method('DELETE')
                                            @csrf
                                            <button class="font-bold" type="submit">x</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p class="p-3 m-3 text-base font-bold text-green-300 text-center">No Tags</p>
                        @endif
                    </div>
                    <div>
                        <form method="POST" action="{{ route('tag.store') }}">
                            @csrf

                            <!-- Name -->
                            <div class="">
                                <x-label for="name" :value="__('New Tag')" class="text-lg" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus/>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    {{ __('Add') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
