@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('include.message')
            
                <div class="card pub_image pub_image_details">
                <div class="card-header">

                    @if ($image->user->image)
                       <div class="img_icon_bar">
                                <img src="{{ url('/user/avatar/'.$image->user->image) }}" class="rounded-circle img-thumbnail mx-auto d-block" alt="Carga tu imagen">
                        </div>
                    @endif
                    
                    <div class="data-user">
                        {{ $image->user->name.' '.$image->user->surname}}
                        <span class="nick">
                            {{ '| @'. $image->user->nick }}
                        </span>
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
                        <span class="nick">
                            {{ '|'.\FormatTime::LongTimeFilter($image->created_at) }}
                        </span>
                        <p>{{ $image->description }}</p>
                    </div>

                    <div class="likes">
                       <img src="{{ asset('img/heartGray.png') }}" alt=""> 
                    </div>
                    
                    <div class="clearfix"></div>

                    <div class="comments">
                        <h2>Comentarios ({{ count($image->comments) }})</h2>
                        <hr>

                        <form action="{{ route('comment.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}">

                            <p>
                                <textarea class="form-control" name="content"></textarea>
                                @if ($errors->has('content'))
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <button type="submit" class="btn btn-success">
                                Enviar
                            </button>
                        </form>
                    <hr>
                        @foreach ($image->comments as $comment)
                           <div class="comment">
                               <div class="description">
                                <span class="nick">
                                    {{ '@'.$comment->user->nick }}    
                                </span>
                                <span class="nick">
                                    {{ '|'.\FormatTime::LongTimeFilter($comment->created_at) }}
                                </span>
                                    <p>{{ $comment->content }}
                                    {{-- condicion de visibilidad --}}
                                    @if (Auth::check()  && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                      <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">
                                        Eliminar
                                    </a>
                                    @endif
                                    </p>

                                </div>
                           </div>
                        @endforeach

                    </div>

                </div>

            </div>
    </div>
</div>
@endsection
