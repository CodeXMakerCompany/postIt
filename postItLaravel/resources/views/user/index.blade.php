@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('include.message')
         <h1>Post creators</h1>
         
        <form method="GET" action="{{ route('user.index') }}" id="buscador">
            <div class="row">
                <div class="form-group col">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Busca por: nick, nombre o apellido">
                 </div>
                <div class="form-group col btn-search">
                    <input type="submit" value="Buscar" class="btn btn-primary">
                </div>
            </div>
            
             
         </form>  
         
         <hr>
    @foreach ($users as $user)
        <div class="data-user">
            <div class="row">
                <div class="col-md-4">
                 @if ($user->image)
                       <div class="img_profile">
                                <img src="{{ url('/user/avatar/'.$user->image) }}" class="rounded-circle img-thumbnail mx-auto d-block" alt="Carga tu imagen">
                        </div>
              @endif
            </div>
            <div class="col-md-3 text-center">
                <h2>{{ '@'.$user->nick }}</h2>
                <h3>{{ $user->name.' '.$user->surname }}</h3>
                <p>{{ 'Se unió: '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                <a class="btn btn-success" href="{{ route('profile', ['id' => $user->id]) }}">Ver perfil</a>
            </div>
            </div>
        </div>
        <hr>
    @endforeach   
           
        <!-- Paginacion -->
        <div class="clearfix"></div>
        {{ $users->links() }}
        
        </div>
    </div>
</div>
@endsection
