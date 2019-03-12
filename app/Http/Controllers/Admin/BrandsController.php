<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Requests\Admin\BrandRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->search) AND trim($request->search)){
            Session::put('brand_search', $request->search);
        }

        if ($searchBy = Session::get('brand_search')){
            $search = $searchBy;
        }else{
            $search = '';
        }

        $where = $this->__search();

        $brands = Brand::orderBy('id', 'desc')->where($where)->paginate(8);

        return view('admin.brand.index', compact('brands', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $request['status'] = ($request->status)?1:0;
        $brand = new Brand($request->all());

        if ($brand->save()){
            return redirect(route('admin.brands.index'))->with('success', 'Brand create successfully');
        }else{
            return redirect(route('admin.brands.create'))->with('error', 'Brand could not be created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $request['status'] = isset($request->status)?1:0;
        $update = $brand->update($request->all());

        if ($update){
            return redirect(route('admin.brands.index'))->with('success', 'Brand update successfully');
        }else{
            return redirect(route('admin.brands.create'))->with('error', 'Brand could not be updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if ($brand->delete()){
            return redirect(route('admin.brands.index'))->with('success', 'Brand delete successfully');
        }else{
            return redirect(route('admin.brands.create'))->with('error', 'Brand could not be deleted');
        }
    }


    /**
     * @return array|\Closure
     * Search option
     */
    public function __search(){

        if ($search = Session::get('brand_search')){
            $where = function ($query) use ($search){
                $query->orWhere('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            };
        }else{
            $where = [];
        }
        return $where;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Reset search data
     */
    public function reset(){

        Session::forget('brand_search');
        return redirect(route('admin.brands.index'));
    }

    /**
     * Change status
     */
    public function changeStatus(Request $request, Brand $brand){

        $request['status'] = ($request->old == 1) ? 0:1;
        $change_status = $brand->update($request->all());

        if ($change_status){
            return back()->with('success', 'Brand status change successfully');
        }else{
            return back()->with('error', 'Brand status could not be changed');
        }
    }
}
