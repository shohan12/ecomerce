<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoriesController extends Controller
{
 public function index(){

 }
 public function show($id){
     $category= Category::find($id);
         if(!is_null($category)){
             return view('frontend.pages.categories.show',compact('category'));
         }
         else{
             session()->flash('errors','sorry !! there is no category by this id');
             return redirect('/');
         }
     }
 }

