<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidatioinRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class CrudOPration extends Controller
{
   public function create(ValidatioinRequest $request){
      dd("hello");
      if ($request->hasFile('image')) 
      {
         $image = $request->file('image');
         $imageName = time().'.'.$image->getClientOriginalExtension();
         $imagePath = public_path('images/'.$imageName);
         Image::make($image->getRealPath())->resize(300, 300)->save($imagePath);
     }
   $create=Product::create([
      'productid' => $request->product_id,
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'image' => $imageName ?? null,
        'coupon' => $request->coupon, ]);
        return response()->json($create, 201);
   }
   public function update(ValidatioinRequest $request,)
{
 

    // Find the product
    $product =Product::where('productid',$request->productid)->first() ;

    // Process image upload if a new image is provided
    if ($request->hasFile('image')) 
    {
        // Delete the previous image if it exists
        if ($product->image) {
            $imagePath = public_path('images/'.$product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

       
        $image = $request->file('image');
        $imageName = Str::random(20).'.'.$image->getClientOriginalExtension();
        $imagePath = public_path('images/'.$imageName);
        Image::make($image)->resize(300, 300)->save($imagePath);

        $product->image = $imageName;
      }
        $update=Product::update([
         'productid' => $request->productid,
           'name' => $request->name,
           'price' => $request->price,
           'description' => $request->description,
           'image' => $product->image,
           'coupon' => $request->coupon, 
         ]);

           return response()->json($update, 201);
          
    }

   

   
   
   function delete(ValidatioinRequest $request){

      $user = Product::where('productid',$request->productid)->delete();
   }
    function index(ValidatioinRequest $request){
      $allproducts=$request->all();
      return response()->json($allproducts,201);

   }

}