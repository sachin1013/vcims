<?php
namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Categories;
use Auth;

class CategoriesController extends Controller
{
    //view categories method
    public function view ()
    {
        $catedata = Categories::all();
        return view('backend.categories.view-categories',compact('catedata'));
    }
    //add categories interface method
    public function add()
    {
        return view('backend.categories.add-categories');
    }
    //store categories method
    public function store(Request $request)
    {
        $Category = new Categories();
        $Category->name = $request->name;
        $Category->description = $request->description;
        $Category->cgst_perc = $request->cgst_perc;
        $Category->sgst_perc = $request->sgst_perc;
        $Category->created_by = Auth::user()->id;
        $add_category = $Category->save();
        if($add_category){
            $notification=array(
                'message'=>'Category Added Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->route('categories.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('categories.view')->with($notification);
        }
    }
    //edit unit method
    public function edit($id)
    {
        $editData = Categories::find($id);
        return view('backend.categories.edit-categories',compact('editData'));
    }
    //update categories method
    public function update (Request $request,$id)
    {
        $cate = Categories::find($id);
        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->cgst_perc = $request->cgst_perc;
        $cate->sgst_perc = $request->sgst_perc;
        $cate->updated_by = Auth::user()->id;
        $cate_update = $cate->save();
        if($cate_update){
            $notification=array(
                'message'=>'Category Updated Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->route('categories.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('categories.view')->with($notification);
        }
    }
    //delete categories method
    public function delete($id)
    {
        $cate = Categories::find($id);
        $del = $cate->delete(); 
        if($del){
            $notification=array(
                'message'=>'Successfully Delete Category',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->back()->with($notification);
        }
    }
}
