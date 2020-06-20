<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\Job;

class CategoryController extends Controller
{
    public function show(Request $request, $id, $slug)
    {
        $jobs_per_page = 10;

        $category = Category::where('name', $slug)->first();
        $category->setActiveJobs(Job::getActiveJobs($category->id, $jobs_per_page));

        if($request->query('_format') == 'atom') {
            return view('category/feed', compact('category'));
        }

        return view('category/show', compact('category'));
    }

    public function deleteCategory($id)
    {
        DB::table('categories')->where('id',$id)->delete();
        DB::table('jobs')->where('category_id',$id)->delete();
        return redirect('/');
    }
}
