@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('include.message')
            
            @foreach ($images as $image)
                @include('include.image',['image'=>$image])
            @endforeach

        <!-- Paginacion -->
        <div class="clearfix"></div>
        {{ $images->links() }}
        
        </div>
    </div>
</div>
@endsection
