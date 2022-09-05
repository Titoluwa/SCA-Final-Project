{{-- @if(count($error) > 0)
    @foreach ($errors->all() as $error)
        <div class="p-3 text-center bg-red-200 text-black text-lg font-semibold">
            {{$error}}
        </div>
    @endforeach
@endif --}}

@if(session('success'))
    <div class="p-3 text-center bg-purple-200 text-black text-lg font-semibold">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="p-3 text-center bg-red-200 text-black text-lg font-semibold">
        {{session('error')}}
    </div>
@endif
