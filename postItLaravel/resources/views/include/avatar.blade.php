@if (Auth::user()->image)
                <div class="form-group row img_usuario">
                            <img src="{{ url('/user/avatar/'.Auth::user()->image) }}" class="rounded-circle img-thumbnail mx-auto d-block" alt="Carga tu imagen">  
                </div>
@endif