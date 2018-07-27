<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function getDashboard(){
        return view('super.dashboard');
    }

    public function getUsers(){
        return view('super.users');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCategory(){
        $category = Category::get();
        return view('super.category',['category' => $category]);
    }

    /**
     * @param Request $request
     */
    public function category(Request $request){
        $columns  = array(
            0 => 'id',
            1 => 'category',
            2 => 'status',
            3 => 'id',
        );

        $totalData = Category::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $category = Category::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }else{
            $search = $request->input('search.value');
            $category = Category::where('category','LIKE','%'.$search.'%')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Category::where('category','LIKE','%'.$search.'%')->count();
        }

        $data = array();

        if(!empty($category)) {
            foreach ($category as $cat) {
                $edit = route('super.edit_category',$cat->id);
                $delete = route('super.delete_category',$cat->id);
                $approve = route('super.approve_category',$cat->id);

                $nestedData['id'] = $cat->id;
                $nestedData['category'] = $cat->category;
                $nestedData['status'] = $cat->is_active == 0 ? "<a href='{$approve}' class='btn btn-primary'>Active</a>" : "<span class='text-primary'><b>Activate</b></span>";
                $nestedData['options'] = "<a href='{$edit}' title='Edit' ><span class='glyphicon glyphicon-edit text-primary'></span></a> &nbsp; <a href='{$delete}' title='Delete' ><span class='glyphicon glyphicon-trash text-danger'></span></a>";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddCategory(){
        $category = [];
        return view('super.add_category',['category' => $category]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editCategory($id){
        $category = Category::find($id);
        return view('super.add_category',['category' => $category]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCategory(Request $request){
        $validator = Validator::make($request->all(),[
            'category' => 'required|unique:category,category|max:20'
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        $id = $request->input('id');
        $category_name = $request->input('category');

        if ($id == 0){
            $category = new Category();
            $category->category = $category_name;
            $category->is_active = 1;
            $result = $category->save();
        }else{
            $category = Category::find($id);
            $category->category = $category_name;
            $result = $category->save();
        }

        if (!$request){
            return redirect()->back()->with('error','Problem to Save Category')->withInput($request->all());
        }
        return redirect()->route('super.get_category')->with('success','Category Add Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveCategory($id){
        $category = Category::find($id);
        if (!$category){
            return redirect()->back()->with('error','Category Not Found');
        }
        $category->is_active = 1;
        $result = $category->save();
        if (!$result){
            return redirect()->back()->with('error','Problem to Active Category');
        }

        return redirect()->back()->with('success','Category Active Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCategory($id){
        $category = Category::find($id);
        if (!$category){
            return redirect()->back()->with('error','Category Not Found');
        }
        $result = $category->delete();
        if (!$result){
            return redirect()->back()->with('error','Problem to Delete Category');
        }

        return redirect()->back()->with('success','Category Delete Successfully');
    }

    public function getPosts(){
        return view('super.posts');
    }

    public function getComments(){
        return view('super.comments');
    }

    public function getAddPost(){
        return view('super.add_post');
    }

    public function getProfile(){
        return view('super.profile');
    }
}