<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight font-serif">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-3xl text-center text-green-700">Categories</h1>
                <div class="grid gap-x-8 gap-y-4 grid-cols-3">
                    <div class="col-span-2 p-4 m-3">

                        <ol>
                            @foreach ($categories as $category)
                                <li class="bg-green-200 m-3 p-2 rounded-xl">
                                    <a href="category/{{$category->id}}" class="hover:bg-gray-100 rounded-md m-1 p-1">{{$category->name}} <span class="px-2 mx-1 my-1 bg-green-100 rounded-full">{{$category->post_count($category->id)}}</span></a>

                                    <div class="float-right mr-3 text-red-500">
                                        @csrf
                                        <input type="hidden" class="delete_val" value="{{ $category->id }}">
                                        <input type="hidden" class="categoryname" value="{{ $category->name }}">
                                        <button class="font-bold delete" type="button">x</button>
                                    </div>
                                    {{-- <form action="/category/delete/{{$category->id}}" method="POST" class="float-right mr-3 text-red-400">
                                        @method('DELETE')
                                        @csrf
                                        <button class="font-bold hover:text-red-600" type="submit">x</button>
                                    </form> --}}
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf

                            <!-- Name -->
                            <div class="">
                                <x-label for="name" :value="__('New Category')" class="text-lg" />

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

    @section('script')
        <script>
            $('.delete').click(function(e) {
                e.preventDefault();

                var delete_id = $(this).closest('div').find('.delete_val').val();
                var name      = $(this).closest('div').find('.categoryname').val();
                swal({
                    title: "Delete "+name+"?",
                    text: "Are you sure you want to delete this Category?",
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
                            url: "/category/delete/"+ delete_id,
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
