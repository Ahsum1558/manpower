<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Fieldar;

class FieldarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_fieldar = Fieldar::latest() -> get(); // as latest
        return view('super.fieldar.index', compact('all_fieldar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super.fieldar.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'title_ar'         => 'required|unique:fieldars',
            'license_ar'       => 'required|unique:fieldars',
            'description_ar'   => 'required',
            'proprietor_ar'    => 'required',
            'address_ar'       => 'required',
            'cellphone_ar'     => 'required',
        ],
        [
            'title_ar.required'        => 'Title Field must not be Empty',
            'title_ar.unique'          => 'The Title is already exist',
            'description_ar.required'  => 'Description Field must not be Empty',
            'license_ar.required'      => 'License Field is required',
            'license_ar.unique'        => 'The License Number is already exist',
            'proprietor_ar.required'   => 'Proprietor Name Field must not be Empty',
            'address_ar.required'      => 'Address Field must not be Empty',
            'cellphone_ar.required'    => 'Cellphone Field must not be Empty',
        ]);

        Fieldar::create([
            'title_ar'             => $request->title_ar,
            'license_ar'           => $request->license_ar,
            'description_ar'       => $request->description_ar,
            'address_ar'           => $request->address_ar,
            'proprietor_ar'        => $request->proprietor_ar,
            'proprietortitle_ar'   => $request->proprietortitle_ar,
            'telephone_ar'         => $request->telephone_ar,
            'cellphone_ar'         => $request->cellphone_ar,
            'helpline_ar'          => $request->helpline_ar,
            'status'               => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Field Option in Arabic is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $single_fieldar_data = Fieldar::find($id);
        
        if ($single_fieldar_data !== null) {
            return view('super.fieldar.show', compact('single_fieldar_data'));
        }else{
            return redirect('/super/fieldar');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fieldar_data = Fieldar::find($id);
        
        if ($fieldar_data !== null) {
            return view('super.fieldar.edit', compact('fieldar_data'));
        }else{
            return redirect('/super/fieldar');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'description_ar'   => 'required',
            'proprietor_ar'    => 'required',
            'address_ar'       => 'required',
            'cellphone_ar'     => 'required',
        ],
        [
            'description_ar.required'  => 'Description Field must not be Empty',
            'proprietor_ar.required'   => 'Proprietor Name Field must not be Empty',
            'address_ar.required'      => 'Address Field must not be Empty',
            'cellphone_ar.required'    => 'Cellphone Field must not be Empty',
        ]);

        $fieldar_data = Fieldar::findOrFail($id);

        $fieldar_data->description_ar        = $request->description_ar;
        $fieldar_data->address_ar            = $request->address_ar;
        $fieldar_data->proprietor_ar         = $request->proprietor_ar;
        $fieldar_data->proprietortitle_ar    = $request->proprietortitle_ar;
        $fieldar_data->telephone_ar          = $request->telephone_ar;
        $fieldar_data->cellphone_ar          = $request->cellphone_ar;
        $fieldar_data->helpline_ar           = $request->helpline_ar;
        $fieldar_data->status                = $request->status;
        $fieldar_data->update();              

        return back()->with('message', 'The Arabic Site Option Information is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_ar = Fieldar::find($id);
        $data_ar -> delete();

        return redirect() -> back() -> with('message', 'The Arabic Site Option data is deleted successfully');
    }

    public function editTitle($id)
    {
        $fieldar_data_title = Fieldar::find($id);
        
        if ($fieldar_data_title !== null) {
            return view('super.fieldar.edit_title', compact('fieldar_data_title'));
        }else{
            return redirect('/super/fieldar');
        }
    }

    public function updateTitle(Request $request, $id)
    {
        $this -> validate($request, [
            'title_ar'         => 'required|unique:fieldars',
        ],
        [
            'title_ar.required'        => 'Title Field must not be Empty',
            'title_ar.unique'          => 'The Title is already exist',
        ]);


        $fieldar_data_title = Fieldar::findOrFail($id);

        $fieldar_data_title->title_ar        = $request->title_ar;
        $fieldar_data_title->update();              

        return back()->with('message', 'The Arabic Site Option Title is Updated Successfully');
    }

    public function editLicense($id)
    {
        $fieldar_data_license = Fieldar::find($id);
        
        if ($fieldar_data_license !== null) {
            return view('super.fieldar.edit_license', compact('fieldar_data_license'));
        }else{
            return redirect('/super/fieldar');
        }
    }

    public function updateLicense(Request $request, $id)
    {
        $this -> validate($request, [
            'license_ar'         => 'required|unique:fieldars',
        ],
        [
            'license_ar.required'        => 'License Number Field must not be Empty',
            'license_ar.unique'          => 'The License Number is already exist',
        ]);


        $fieldar_data_license = Fieldar::findOrFail($id);

        $fieldar_data_license->license_ar        = $request->license_ar;
        $fieldar_data_license->update();              

        return back()->with('message', 'The Arabic Site Option License Number is Updated Successfully');
    }

    public function inactive(Request $request, $id)
    {

        $fieldar_inactive = Fieldar::findOrFail($id);

        $fieldar_inactive->title_ar     = $request->title_ar;
        $fieldar_inactive->status       = 0;
        $fieldar_inactive->update();              

        return redirect('/super/fieldar')->with('message', 'The Arabic Site Option is Inactive Successfully');
    }
    
    public function active(Request $request, $id)
    {

        $fieldar_active = Fieldar::findOrFail($id);

        $fieldar_active->title_ar     = $request->title_ar;
        $fieldar_active->status       = 1;
        $fieldar_active->update();              

        return redirect('/super/fieldar')->with('message', 'The Arabic Site Option is Active Successfully');
    }
}
