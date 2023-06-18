<?php

namespace App\Http\Controllers\Visa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visatype;
use DB;

class VisatypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_visa_type = Visatype::latest() -> get(); // as latest
        return view('admin.visa.visatype.index', compact('all_visa_type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.visa.visatype.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Visatype::create([
            'visatype_name'   => $request->visatype_name,
            'status'          => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Visa Type is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $single_visaType = Visatype::find($id);
        
        if ($single_visaType !== null) {
            return view('admin.visa.visatype.show', compact('single_visaType'));
        }else{
            return redirect('/visaType');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visaType_data = Visatype::find($id);
        
        if ($visaType_data !== null) {
            return view('admin.visa.visatype.edit', compact('visaType_data'));
        }else{
            return redirect('/visaType');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request, [
            'visatype_name'  => 'required|unique:visatypes',
        ],
        [
            'visatype_name.required' => 'Visa Type Field must not be Empty',
            'visatype_name.unique'   => 'The Visa Type is already exist',
        ]);
        $visaType_data = Visatype::findOrFail($id);

        $visaType_data->visatype_name   = $request->visatype_name;
        $visaType_data->update();              

        return back()->with('message', 'The Visa Type is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_visaType = Visatype::find($id);
        $data_visaType -> delete();

        return redirect() -> back() -> with('message', 'The Visa Type is deleted successfully');
    }

    public function inactive($id)
    {

        $Visatype_inactive = Visatype::findOrFail($id);

        $Visatype_inactive->status      = 0;
        $Visatype_inactive->update();              

        return redirect('/visaType')->with('message', 'The Visa Type is Inactive Successfully');
    }
    
    public function active($id)
    {

        $visaType_active = Visatype::findOrFail($id);

        $visaType_active->status    = 1;
        $visaType_active->update();              

        return redirect('/visaType')->with('message', 'The Visa Type is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'visatype_name'  => 'required|unique:visatypes',
            'status'         => 'required|in:1,0',
        ],
        [
            'visatype_name.required' => 'Visa Type Field must not be Empty',
            'visatype_name.unique'   => 'The Visa Type is already exist',
            'status.required'        => 'Status Field is required',
            'status.in'              => 'Invalid status option selected',
        ]);
    }
}