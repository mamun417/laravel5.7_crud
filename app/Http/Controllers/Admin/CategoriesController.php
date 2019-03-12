<?php /** @noinspection ALL */

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Component\fileHandlerComponent;
use App\Http\Requests\Admin\CategoryRequest;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoriesController extends fileHandlerComponent
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->search) AND trim($request->search)){
            Session::put('category_search', $request->search);
        }

        if ($searchBy = Session::get('category_search')){
            $search = $searchBy;
        }else{
            $search = '';
        }

        $where = $this->__search();

        $categories = Category::with('parent', 'childrens')->orderBy('id', 'desc')->where($where)->paginate(8);

        $main_categories = Category::with('parent', 'childrens')->orderBy('id', 'desc')->where('parent_id', null)->get();

        //dd($main_categories->toArray());

        return view('admin.category.index', compact('categories', 'search', 'main_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_categories = Category::orderBy('id', 'desc')->get();
        $main_categories = Category::with('parent', 'childrens')->orderBy('id', 'desc')->where('parent_id', null)->get();

        return view('admin.category.create', compact('all_categories', 'main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if ($request->img){

            $image_name = $this->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }
        }

        $request['status'] = ($request->status)?1:0;
        $category = new Category($request->all());

        if ($category->save()){
            return redirect(route('admin.categories.index'))->with('success', 'Category create successfully');
        }else{
            return redirect(route('admin.categories.create'))->with('error', 'Category could not be created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $all_categories = Category::orderBy('id', 'desc')->get();

        $main_categories = Category::with('parent', 'childrens')->orderBy('id', 'desc')->where('parent_id', null)->get();

        return view('admin.category.edit', compact('category', 'all_categories', 'main_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if ($request->img){
            $image_name = $this->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }

            //Delete old image
            if ($category->image){
                $this->deleteImage($category->image);
            }
        }

        $request['status'] = isset($request->status)?1:0;
        $update = $category->update($request->all());

        if ($update){
            return redirect(route('admin.categories.index'))->with('success', 'Category update successfully');
        }else{
            return redirect(route('admin.categories.create'))->with('error', 'Category could not be updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if(count($category->childrens) == 0){

            //Delete image
            if ($category->image){
                $this->deleteImage($category->image);
            }

            if ($category->delete()){
                return redirect()->back()->with('success', 'Category delete successfully');
            }else{
                return redirect()->back()->with('error', 'Category could not be deleted');
            }

        }else{
            return redirect()->back()->with('warning', 'Category could not be deleted due to it has children category');
        }
    }

    public function search(Request $request){

        $search = trim($request->search);

        if ($search){
            Session::put(['search' => $search]);
        }

        $categories = Category::orderBy('id', 'desc')
            ->where('name', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->paginate(5);

        return view('admin.category.index', compact('categories', 'search'));
    }

    /**
     * Change status
     */
    public function changeStatus(Request $request, Category $category){

        $request['status'] = ($request->old == 1) ? 0:1;
        $change_status = $category->update($request->all());

        if ($change_status){
            return back()->with('success', 'Brand status change successfully');
        }else{
            return back()->with('error', 'Brand status could not be changed');
        }
    }

    public function __search(){

        if ($search = Session::get('category_search')){
            $where = function ($query) use ($search){
                $query->orWhere('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            };
        }else{
            $where = [];
        }

        return $where;
    }

    public function reset(){

        Session::forget('category_search');

        return redirect(route('admin.categories.index'));
    }

}
