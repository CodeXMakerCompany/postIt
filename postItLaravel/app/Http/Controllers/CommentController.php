<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//ímportar modelo para insertar los datos
use App\Comment;

class CommentController extends Controller
{
    //verifica la autentificacion para proseguir a los demas metodos
    public function __construct(){
    	$this->middleware('auth');
    }

    //validación
    public function save(Request $request){

    	$validate = $this->validate($request, [
    		'image_id' => ['integer','required'],
    		'content' => ['string','required']
    	]);

    //recoger datos	
    	$user = \Auth::user();
    	$image_id = $request->input('image_id');
    	$content = $request->input('content');


    //guardar los valores al nuevo objeto
    $comment = new Comment();
    $comment->user_id = $user->id;
    $comment->image_id = $image_id;
    $comment->content = $content;

    //guardar en la bd
    $comment->save();	
    
    //redireccionar
    return redirect()->route('image.detail', ['id'=>$image_id])
    				 ->with([
    				 	'message' => 'comentario publicado!'	
    				 ]);	
    }

    public function delete($id){
    	//Conseguir datos del usuario logueado
    	$user = \Auth::user();

    	//Conseguir objeto del comentario
    	$comment = Comment::find($id);

    	//Comprobar si soy el dueño del comentario o de la publicacion
    	if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
    		$comment->delete();

    		//redireccionar
    		return redirect()->route('image.detail', ['id'=>$comment->image->id])
    				 ->with([
    				 	'message' => 'comentario eliminado correctamente!'	
    				 ]);

    	}else{
    		//redireccionar
    		return redirect()->route('image.detail', ['id'=>$comment->image->id])
    				 ->with([
    				 	'message' => 'No se ha podido eliminar!'	
    				 ]);
    	}
    }

}
