<?php

namespace App\Http\Controllers;

use App\Models\lost_property;
use Illuminate\Http\Request;
use Image;

class LostPropertyController extends Controller
{
    public function index()
    {
        return view('property');
    }
    public function create(Request $request)
    {
        $imagePath = request('file')->store("property", 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(900, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save(public_path("storage/{$imagePath}"), 60);
        $image->save();


        $property = new lost_property;
        $property->property_name = $request->name;
        $property->location = $request->location ;
        $property->image = $imagePath;
        $property->status = $request->status;
        $property->save();
        
        return redirect()->to("/lost_property");
    }

    public function update(string $property_id)
    {
        $property = lost_property::find($property_id);
        $property->status='已領取';
        $property->save();
        
        return response()->json($property); 
    }
    

   
    public function delete(string $property_id)
    {
        $property = lost_property::find($property_id);
        $property->delete();
        return response()->json(['success'=>'Record has been deleted']); 
    }
}
