@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        
        <div class="card">
          <div class="card-header">
           Editar mi imagen
          </div>

          <div class="card-body">
            
            <form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
				<input type="hidden" name="image_id" value="{{ $image->id }}">
                <div class="form-group row">
                    <label for="image_path" class="col-md-4 col-form-label text-md-right">Imagen</label>
                    <div class="col-md-7">
                    @if ($image->user->image)
                       <div class="img_profile">
                                <img src="{{ url('/image/file/'.$image->image_path) }}" class="rounded-circle img-thumbnail mx-auto d-block" alt="Carga tu imagen">
                        </div>
                    @endif
                      <input id="image_path" type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror">

                      @error('image_path')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>    
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>
                    <div class="col-md-7">
                      <textarea id="description" type="text" name="description" class="form-control">{{ $image->description }}</textarea> 

                      @if ($errors->has('description'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first() }}</strong>
                          </span>
                      @endif
                    </div>    
                </div>

                <div class="form-group row">
                 
                    <div class="col-md-6 offset-md-4">
                      <input type="submit" class="btn btn-primary" value="Actualizar imagen">
                    
                    </div>    
                </div>

            </form>

          </div>

        </div>
    
        </div>
    </div>
</div>

@endsection