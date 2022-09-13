<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight font-serif">
            {{$post->title}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p class="text-center text-green-600 text-2xl font-bold mb-3">{{$post->title}}</p>
                    <p class="text-center text-green-400 text-xl font-medium mb-4">{{$post->subtitle}} </p>
                    <p class="font-medium m-3">
                        <a href="/category/{{$post->category_id}}" class="p-2 rounded-sm bg-green-100 hover:bg-green-300">{{$post->category->name}}</a>
                        @foreach ($tags as $tag)
                            <span class="m-2 p-1 bg-gray-200 rounded-lg">{{$tag->name}}</span>
                        @endforeach
                    </p>
                    <div class="text-base text-justify mx-10 m-4">{!! $post->content !!}</div>
                    @if($post->user_id == auth()->user()->id)
                        <div>
                            <a href="/post/edit/{{$post->id}}" class="float-right mr-5 py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Edit Post
                            </a>
                        </div>
                        <br>
                        <br>
                    @endif
                    <p class="text-green-800 text-base font-medium m-3 px-10">Comments:</p>
                    <div>
                        @if(count($post->comments) > 0)
                            <ol class="list-decimal m-2 px-16 mb-5">
                                @foreach ($post->comments as $comment)
                                    <div class="flex">
                                        <li class="text-base m-2">{{$comment->content}}</li>
                                        @if($comment->user_id == auth()->user()->id)
                                            <form action="delete/comment/{{$comment->id}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="m-2 py-1 px-2 border border-transparent text-sm font-sm rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    delete
                                                </button>
                                            </form>
                                        @elseif($post->user_id == auth()->user()->id)
                                            <form action="delete/comment/{{$comment->id}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="m-2 py-1 px-2 border border-transparent text-sm font-sm rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endforeach
                            </ol>
                        @else
                            <p class="m-2 px-16 text-base font-semibold mb-5">No comments yet</p>
                        @endif
                    </div>
                    <hr>
                    <p class="text-green-800 font-medium mx-3 my-2 text-medium">Write a comment about this post...</p>
                    <form action="{{route('comment.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <input type="hidden" name="user_id" value="0">
                        <div class="mx-5">
                            <textarea name="content" id="article-ckeditor" rows="2" placeholder="What do have to say?"
                                class="@error('content') is-invalid @enderror w-full outline-none p-2 rounded-md shadow-sm border border-green-300 focus:border-green-300
                                focus:ring focus:ring-green-200 focus:ring-opacity-50">{{old('content')}}</textarea>
                        </div>
                        <div class="flex items-center justify-end mt-5">
                            <x-button class="mr-5">
                                {{ __('Add') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
