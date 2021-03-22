<?php


namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\brand;
use Image;
use File;
use Illuminate\Http\Request;

class brandsController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth:admin');
  }
    public function index(){

        $brands =brand::orderBy('id','desc')->get();
        return view('backend.pages.brands.index',compact('brands'));
    }
    public function create(){

       
        return view('backend.pages.brands.create');
    }
    public function store(Request $request){
     $this->validate($request,[
          'name' =>'required',
          'image'=>'nullable|image', 
     ],
       [
           'name.required'=>'please provide a brand name',
            'image.image'=>'please provide valid image with .jpg,  .png,  .gif,  .jpeg extension'
       ]);
    
       $brand = new brand();
       $brand->name=$request->name;
       $brand->description=$request->description;
       
      

       if ($request->image){
      
               $image=$request->file('image');
               $img=time().'.'.$image->getClientOriginalExtension();
               $location=public_path('images/brands/'.$img);
               Image::make($image)->save($location);
               $brand->image=$img;
                 
    }
    $brand->save();
        
    session()->flash('success',' new brand added successfully');
    return redirect()->route('admin.brands');

    }
public function edit($id){
  
    $brand=Brand::find($id);
    if(!is_null($brand)){
        return view('backend.pages.brands.edit',compact('brand','main_brands'));
    }else{
        return redirect()->route('admin.brands');
    }
}
public function update(Request $request,$id){
    $this->validate($request,[
         'name' =>'required',
         'image'=>'nullable|image', 
    ],
      [
          'name.required'=>'please provide a brand name',
           'image.image'=>'please provide valid image with .jpg,  .png,  .gif,  .jpeg extension'
      ]);
   
      $brand = brand::find($id);
      $brand->name=$request->name;
      $brand->description=$request->description;
      $brand->parent_id=$request->parent_id;
     

      if ($request->image){
          if(File::exists('images/brands/'.$brand->image)){
              File::delete('images/brands/'.$brand->image);
          }
              $image=$request->file('image');
              $img=time().'.'.$image->getClientOriginalExtension();
              $location=public_path('images/brands/'.$img);
              Image::make($image)->save($location);
              $brand->image=$img;
                
   }
   $brand->save();
       
   session()->flash('success',' brand updated successfully');
   return redirect()->route('admin.brands');

   }
public function delete($id ){
    $brand=Brand::find($id);
    if(!is_null($brand)){
       
          
       
        
        if(File::exists('images/brands/'.$brand->image)){
            File::delete('images/brands/'.$brand->image);
        }
        $brand->delete();
    }
    
       
   session()->flash('success',' brand has deleted successfully!!');
   return back();

}


}
