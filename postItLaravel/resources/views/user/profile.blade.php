@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
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
				<h1>{{ '@'.$user->nick }}</h1>
				<h2>{{ $user->name.' '.$user->surname }}</h2>
				<p>{{ 'Se unió: '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
			</div>
			</div>
		</div>
		<hr>

		<div class="clearfix"></div>	

            @foreach ($user->images as $image)
                @include('include.image',['image'=>$image])
            @endforeach

        
        </div>
    </div>
</div>
@endsection