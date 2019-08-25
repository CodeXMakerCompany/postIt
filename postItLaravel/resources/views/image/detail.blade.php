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

                        <!-- Comprobar si el usuario le dio like a la imagen -->

                        <?php $user_like = false; ?>

                        @foreach ($image->likes as $like)

                            @if ($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach
                       
                        @if ($user_like)
                            <img src="{{ asset('img/heartRed.png') }}" class="btn-dislike" data-id="{{ $image->id }}">
                        @else
                            <img src="{{ asset('img/heartGray.png') }}" class="btn-like" data-id="{{ $image->id }}">
                        @endif

                        <span class="number_likes">{{ count($image->likes) }}</span>

                    </div>

                    <br>

                    @if (Auth::user() && Auth::user()->id == $image->user->id)
                       <div class="actions">
                            <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-md btn-primary">Actualizar</a>
                            {{-- <a href="" class="btn btn-md btn-danger">Borrar</a> --}}

                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                              Eliminar
                            </button>

                            <!-- The Modal -->
                            <div class="modal" id="myModal">
                              <div class="modal-dialog">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">¿Estas seguro?</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    Si eliminas esta imagen, será de manera definitiva.¿Seguro de elimnarla?
                                  </div>

                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                     <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-md btn-danger">Borrar definitivamente</a>
                                    
                                  </div>

                                </div>
                              </div>
                            </div>

                    </div>
                    @endif
                    
                    
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
