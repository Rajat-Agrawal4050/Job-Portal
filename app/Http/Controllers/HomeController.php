<?php

namespace App\Http\Controllers;

use App\Models\AllJob;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{
    
      public function index(){

        $categories=Category::where('status',1)->orderBy('name','ASC',)->take(6)->get();
        $jobs = AllJob::where('isFeatured',1)->where('status',1)->with('category')->latest()->take(6)->get();
        return view('index',compact('categories','jobs'));
      }

      public function contact(){
        return view('contact');
      }

}
