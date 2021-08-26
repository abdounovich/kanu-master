<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Redirect;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $types=Type::all();
       return view('types.types')->with('types',$types);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  


    public function store(Request $request)
    {
      


        if ($request->isMethod('post')) 
                 
        {
  
         $image_name = $request->file('photo')->getRealPath();
         Cloudder::upload($image_name, null);
         list($width, $height) = getimagesize($image_name);
         $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
       

        $types = new Type();
            $types->type=  $request->get('type');
            $types->prix=$request->get('prix');
            $types->temps=$request->get('temps');
            $types->point=$request->get('point');
            $types->photo=$image_url;
           
    
        $types->save();
    
    }
        return redirect('types.types')->with('success', 'type saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function supprimer( $id)
    {$type=Type::whereId($id);
       $type->delete();
       return Redirect::back()->with('message','Operation Successful !');


    }

    public function edit($id )
    {
        $type=Type::findOrFail($id);
        return view('types.types_edit',compact('type'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $type=Type::find($id);
        if($request->hasFile('photo')){

            $image_name = $request->file('photo')->getRealPath();
            Cloudder::upload($image_name, null);
  
            list($width, $height) = getimagesize($image_name);
     
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
           
         
          $type->photo= $image_url;

         }
         else{
            $type->photo=$request->get('image');
         
         }
         

        $type->type = $request->input('type');
        $type->prix = $request->input('prix');
        $type->temps=$request->input('temps');
        $type->point=$request->input('point');
        $type->save();
    
        return redirect('types.types')->with('success', 'type saved!');


      
      }
}
