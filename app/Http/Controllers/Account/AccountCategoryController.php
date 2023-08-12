<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Super;
use App\Models\User;
use App\Models\AccountCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_category = AccountCategory::latest() -> get(); // as latest
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            return view('admin.account.category.index', compact('all_category'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_data = AccountCategory::latest() -> get(); // as latest
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            return view('admin.account.category.create', compact('category_data'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existingRecord = AccountCategory::where([
            'category'=>$request->category,
            'type'=>$request->type,
            'official'=>$request->official,
        ])->first();
        if (!$existingRecord){
            $this->validation($request);

            AccountCategory::create([
                'category'      => $request->category,
                'type'          => $request->type,
                'official'      => $request->official,
                'status'        => $request->status,
            ]);
            return redirect() -> back() -> with('message', 'Account Category is added successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Account Category is already exist in the table !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_category = AccountCategory::find($id);

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            if ($single_category !== null) {
                return view('admin.account.category.show', compact('single_category'));
            }else{
                return redirect('/category');
            }
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category_info = AccountCategory::find($id);

        if ($category_info !== null) {
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
                return view('admin.account.category.edit', compact('category_info'));
            }else{
                return redirect('/');
            } 
        }else{
            return redirect('/category');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category_info = AccountCategory::findOrFail($id);
        $existingRecord = AccountCategory::where([
            'category'=>$request->category,
            'type'=>$request->type,
            'official'=>$request->official,
        ])->first();
        if (!$existingRecord){
            $this->validation($request);

        $category_info->category = $request->category;
        $category_info->type     = $request->type;
        $category_info->official = $request->official;
        $category_info->status   = $request->status;
        $category_info->update();              

        return back()->with('message', 'The Account Category Info is Updated Successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Account Category is already exist in the table !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_category = AccountCategory::find($id);
        $data_category -> delete();

        return redirect() -> back() -> with('message', 'The Account Category is deleted successfully');
    }

    public function inactive($id)
    {
        $category_inactive = AccountCategory::findOrFail($id);
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            $category_inactive->status   = 0;
            $category_inactive->update();              

            return redirect('/category')->with('message', 'The Account Category is Inactive Successfully');
        }else{
            return redirect('/');
        }
    }
    
    public function active($id)
    {
        $category_active = AccountCategory::findOrFail($id);
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            $category_active->status   = 1;
            $category_active->update();              

            return redirect('/category')->with('message', 'The Account Category is Active Successfully');
        }else{
            return redirect('/');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'category' => 'required',
            'type'      => 'required|in:income,expense,assets,liabilities',
            'official'   => 'required|in:1,2',
            'status'     => 'required|in:1,0',
        ],
        [
            'category.required' => 'Account Category Field must not be Empty',
            'type.required'     => 'Account Type Field is required',
            'type.in'           => 'Invalid Account Type option selected',
            'official.required' => 'Official Field is required',
            'official.in'       => 'Invalid Official option selected',
            'status.required'   => 'Status Field is required',
            'status.in'         => 'Invalid Status option selected',
        ]);
    }
}