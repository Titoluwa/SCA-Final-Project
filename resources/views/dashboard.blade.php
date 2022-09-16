<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight font-serif">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="leading-loose text-center text-4xl text-green-600 font-bold">Welcome {{ Auth::user()->name }}</p>
                    <p class="text-center text-lg">You're logged in!</p>
                    <div class="m-4 text-center">
                        <a href="post/create" class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                           New Post
                        </a>
                    </div>
                    {{-- <p class="my-3 mx-96 py-3 text-center bg-green-200 border-2 border-green-600 rounded-md  hover:bg-green-600">View My posts</p> --}}
                    @if(count($posts) > 0)
                        <div class="grid grid-cols-1">
                            @foreach ($posts as $post)
                            <div class="flex m-3 p-4 bg-gray-200 rounded-lg hover:bg-green-100 hover:shadow-xl focus:bg-green-100">
                                {{-- <div class="flex-none bg-green-200 text-gray-500">
                                    <img class="h-44 w-32" src="{{asset('storage/'.$post->post_cover)}}" alt="post cover">
                                </div> --}}
                                <div class="flex-initial mx-6 mt-1">
                                    <a href="/post/{{$post->id}}" class="text-xl leading-6 font-medium text-green-700 focus:text-green-800 hover:text-green-800 focus:outline-none hover:shadow-md focus:shadow-md">{{$post->title}}</a>
                                    <p class="text-justify mt-2 text-base text-gray-600">
                                        {{$post->subtitle}}
                                        <br> <br>
                                        <div class="space-x-4">
                                            <a href="/post/edit/{{$post->id}}" class="inline-block py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                Edit
                                            </a>

                                            <div class="inline-block">
                                                @csrf
                                                <input type="hidden" class="delete_val" value="{{ $post->id }}">
                                                <input type="hidden" class="postitle" value="{{ $post->title }}">
                                                <button type="button" class="delete py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" >
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="p-3 m-3 text-base font-bold text-green-300 text-center">No Post Found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            $('.delete').click(function(e) {
                e.preventDefault();

                var delete_id = $(this).closest('div').find('.delete_val').val();
                var name      = $(this).closest('div').find('.postitle').val();
                swal({
                    title: "Delete "+name+"?",
                    text: "Are you sure you want to delete this Post?",
                    icon: "warning",
                    buttons: ["Cancel","Delete"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": delete_id,
                        }
                        $.ajax({
                            type: "DELETE",
                            url: "/post/delete/"+ delete_id,
                            data: data,
                            success: function (response){
                                swal(response.status, {
                                    icon: "success",
                                })
                                .then((result)=>{
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });
        </script>
    @endsection

</x-app-layout>
