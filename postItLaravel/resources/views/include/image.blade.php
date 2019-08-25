<div class="card pub_image">
                <div class="card-header">

                    @if ($image->user->image)
                       <div class="img_icon_bar">
                                <img src="{{ url('/user/avatar/'.$image->user->image) }}" class="rounded-circle img-thumbnail mx-auto d-block" alt="Carga tu imagen">
                        </div>
                    @endif
                    
                    <div class="data-user">
                        <a href="{{ route('profile', ['id' => $image->user->id]) }}">
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
                    
                    <div class="comments">
                        <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-warning btn-comments">
                                Comentarios ({{ count($image->comments) }})
                        </a>
                    </div>
                </div>

            </div>