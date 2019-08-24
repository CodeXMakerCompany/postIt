@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('include.message')
            
            @foreach ($images as $image)
                <div class="card pub_image">
                <div class="card-header">

                    @if ($image->user->image)
                       <div class="img_icon_bar">
                                <img src="{{ url('/user/avatar/'.$image->user->image) }}" class="rounded-circle img-thumbnail mx-auto d-block" alt="Carga tu imagen">
                        </div>
                    @endif
                    
                    <div class="data-user">
                        <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                            {{ $image->user->name.' '.$image->user->surname}}
                            <span class="nick">
                                {{ '| @'. $image->user->nick }}
                            </span>
                        </a>
                    </div>
                    
                </div>

                <div class="card-body">

                    <div class="image-container text-center">
                        <img class="img-fluid" src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="">    
                    </div>
                    

                    <div class="description">

                        <span class="nick">
                            {{ '@'.$image->user->nick }}    
                        </span>
                        <span class="nick date">
                            {{ '|'.\FormatTime::LongTimeFilter($image->created_at) }}
                        </span> 
                        <p>{{ $image->description }}</p>
                    </div>

                    <div class="likes">
                       <img src="{{ asset('img/heartGray.png') }}" alt=""> 
                    </div>
                    
                    <div class="comments">
                        <a href="" class="btn btn-warning btn-comments">
                                Comentarios ({{ count($image->comments) }})
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
            <!-- Paginacion -->

        <div class="clearfix"></div>
        {{ $images->links() }}
        </div>
    </div>
</div>
@endsection
