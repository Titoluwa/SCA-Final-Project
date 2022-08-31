<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            {{ __('New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-center text-green-500 text-2xl font-bold">Create a New Post</p>

                    <form class="mx-56" method="POST" action="{{ route('post.store') }}">
                            @if(session()->has("added_message"))
                                <p class="w-full font-medium my-3 text-lg bg-green-100 p-3 rounded text-center text-green-700">Your New Post has been created!!</p>
                            @elseif(session()->has("delete_message"))
                                <p class="w-full font-medium my-3 text-lg bg-green-100 p-3 rounded text-center text-red-800">Post has been Deleted!!</p>
                            @endif
                        @csrf
                        <input type="hidden" name="user_id" value="0">
                        <div class="grid gap-4 grid-cols-2 mt-4">
                            <!-- Title -->
                            <div class="">
                                <x-label for="title" :value="__('Title')" class="mb-2" />

                                <x-input id="title" class="@error('title') is-invalid @enderror mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            </div>
                            @error('title')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                            <!-- Subtitle -->
                            <div class="">
                                <x-label for="subtitle" :value="__('Subtitle')" class="mb-2" />

                                <x-input id="subtitle" class="@error('subtitle') is-invalid @enderror mt-1 w-full" type="text" name="subtitle" :value="old('subtitle')"/>
                            </div>
                            @error('subtitle')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mt-4">
                            <x-label for="content" :value="__('Content')" class="mb-2" />

                            <textarea name="content" id="content" rows="10" placeholder="What's on your mind?"
                                class="@error('content') is-invalid @enderror w-full outline-none p-2 rounded-md shadow-sm border border-green-300 focus:border-green-300
                                focus:ring focus:ring-green-200 focus:ring-opacity-50">{{old('content')}}</textarea>
                        </div>
                        @error('content')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="grid gap-4 grid-cols-2 mt-4">
                            <!-- Category -->
                            <div class="">
                                <x-label for="category_id" :value="__('Category')" class="mb-2" />

                                <select name="category_id" id="category_id" class="@error('category_id') is-invalid @enderror w-full outline-none p-2 rounded-md shadow-sm border border-green-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    <option value="" disabled selected class="text-gray-100">Select  Category</option>
                                    @foreach ($categories as $category)
                                        <option class="text-green-700 hover:bg-green-100 focus:outline-none focus:bg-green-100 transition duration-150 ease-in-out" value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror

                            <!-- Tags -->
                            <div class="">
                                <x-label for="tag_id" :value="__('Tags')" class="mb-2" />
                                <div class="grid grid-cols-6">
                                    @foreach ($tags as $tag)
                                        <input type="checkbox" name="tag_id[]" value="{{$tag->id}}" id="{{$tag->name}}" class="@error('tag_id') is-invalid @enderror outline-none rounded-md mb-1"/>
                                        <label for="{{$tag->name}}" class="col-span-2 font-medium text-sm text-green-300 mb-1">{{$tag->name}}</label>
                                    @endforeach
                                </div>
                            </div>
                            @error('tag_id')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-10">
                            <x-button class="ml-4">
                                {{ __('Add') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
