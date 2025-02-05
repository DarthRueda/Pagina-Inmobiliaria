<?php


namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\proba;


class AuthorController extends Controller
{
   public function index(){
    //    $authors = Author::all();
    //    return response()->json(['status'=>405,'success'=>true,'data'=>$authors]);

    return proba::collection(Author::all());
   }


   public function store(Request $request){


       $validator = Validator::make(
           $request->all(),
           [
               'name'=> ['required','max:255'],
               'surname' => '',
               'email'=>['required','unique:authors']
           ]
       );


       $data = $validator->validated();


       $author = Author::create($data);
       return response()->json(['status'=>405,'success'=>true,'data'=>$author]);


       //




       /*
       $author = new Author();
       $author->name = $request->name;
       $author->surname = $request->surname;
       $author->email = $request->email;
       $author->save();
       return response()->json(['status'=>405,'success'=>true,'data'=>$author]);
       */
   }

   public function update(Request $request, Author $author){
    
       $validator = Validator::make(
           $request->all(),
           [
               'name'=> ['required','max:255'],
               'surname' => '',
           ]
       );

       $data = $validator->validated();
       $author->update($data);
   }


   public function destroy(Author $author){


       $author->delete();
       return response()->json(['status'=>405,'success'=>true,'data'=>'']);
   }




}
