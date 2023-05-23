<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Fieldbn;

class FieldbnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_fieldbn = Fieldbn::latest() -> get(); // as latest
        return view('super.fieldbn.index', compact('all_fieldbn'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super.fieldbn.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'title_bn'         => 'required|unique:fieldbns',
            'license_bn'       => 'required|unique:fieldbns',
            'description_bn'   => 'required',
            'proprietor_bn'    => 'required',
            'address_bn'       => 'required',
            'cellphone_bn'     => 'required',
        ],
        [
            'title_bn.required'        => 'Title Field must not be Empty',
            'title_bn.unique'          => 'The Title is already exist',
            'description_bn.required'  => 'Description Field must not be Empty',
            'license_bn.required'      => 'License Field is required',
            'license_bn.unique'        => 'The License Number is already exist',
            'proprietor_bn.required'   => 'Proprietor Name Field must not be Empty',
            'address_bn.required'      => 'Address Field must not be Empty',
            'cellphone_bn.required'    => 'Cellphone Field must not be Empty',
        ]);


        Fieldbn::create([
            'title_bn'             => $request->title_bn,
            'license_bn'           => $request->license_bn,
            'description_bn'       => $request->description_bn,
            'address_bn'           => $request->address_bn,
            'proprietor_bn'        => $request->proprietor_bn,
            'proprietortitle_bn'   => $request->proprietortitle_bn,
            'telephone_bn'         => $request->telephone_bn,
            'cellphone_bn'         => $request->cellphone_bn,
            'helpline_bn'          => $request->helpline_bn,
            'status'               => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Field Option in Bengali is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $single_fieldbn_data = Fieldbn::find($id);
        if ($single_fieldbn_data !== null) {
            return view('super.fieldbn.show', compact('single_fieldbn_data'));
        }else{
            return redirect('/super/fieldbn');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fieldbn_data = Fieldbn::find($id);
        if ($fieldbn_data !== null) {
            return view('super.fieldbn.edit', compact('fieldbn_data'));
        }else{
            return redirect('/super/fieldbn');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'description_bn'   => 'required',
            'proprietor_bn'    => 'required',
            'address_bn'       => 'required',
            'cellphone_bn'     => 'required',
        ],
        [
            'description_bn.required'  => 'Description Field must not be Empty',
            'proprietor_bn.required'   => 'Proprietor Name Field must not be Empty',
            'address_bn.required'      => 'Address Field must not be Empty',
            'cellphone_bn.required'    => 'Cellphone Field must not be Empty',
        ]);

        $fieldbn_data = Fieldbn::findOrFail($id);

        $fieldbn_data->description_bn        = $request->description_bn;
        $fieldbn_data->address_bn            = $request->address_bn;
        $fieldbn_data->proprietor_bn         = $request->proprietor_bn;
        $fieldbn_data->proprietortitle_bn    = $request->proprietortitle_bn;
        $fieldbn_data->telephone_bn          = $request->telephone_bn;
        $fieldbn_data->cellphone_bn          = $request->cellphone_bn;
        $fieldbn_data->helpline_bn           = $request->helpline_bn;
        $fieldbn_data->status                = $request->status;
        $fieldbn_data->update();              

        return back()->with('message', 'The Bengali Site Option Information is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_bn = Fieldbn::find($id);
        $data_bn -> delete();

        return redirect() -> back() -> with('message', 'The Bengali Site Option data is deleted successfully');
    }

    public function editTitle($id)
    {
        $fieldbn_data_title = Fieldbn::find($id);
        
        if ($fieldbn_data_title !== null) {
            return view('super.fieldbn.edit_title', compact('fieldbn_data_title'));
        }else{
            return redirect('/super/fieldbn');
        }
    }

    public function updateTitle(Request $request, $id)
    {
        $this -> validate($request, [
            'title_bn'         => 'required|unique:fieldbns',
        ],
        [
            'title_bn.required'        => 'Title Field must not be Empty',
            'title_bn.unique'          => 'The Title is already exist',
        ]);

        $fieldbn_data_title = Fieldbn::findOrFail($id);

        $fieldbn_data_title->title_bn        = $request->title_bn;
        $fieldbn_data_title->update();              

        return back()->with('message', 'The Bengali Site Option Title is Updated Successfully');
    }

    public function editLicense($id)
    {
        $fieldbn_data_license = Fieldbn::find($id);
        
        if ($fieldbn_data_license !== null) {
            return view('super.fieldbn.edit_license', compact('fieldbn_data_license'));
        }else{
            return redirect('/super/fieldbn');
        }
    }

    public function updateLicense(Request $request, $id)
    {
        $this -> validate($request, [
            'license_bn'         => 'required|unique:fieldbns',
        ],
        [
            'license_bn.required'        => 'License Number Field must not be Empty',
            'license_bn.unique'          => 'The License Number is already exist',
        ]);

        $fieldbn_data_license = Fieldbn::findOrFail($id);

        $fieldbn_data_license->license_bn        = $request->license_bn;
        $fieldbn_data_license->update();              

        return back()->with('message', 'The Bengali Site Option License Number is Updated Successfully');
    }

    public function inactive(Request $request, $id)
    {

        $fieldbn_inactive = Fieldbn::findOrFail($id);

        $fieldbn_inactive->title_bn     = $request->title_bn;
        $fieldbn_inactive->status       = 0;
        $fieldbn_inactive->update();              

        return redirect('/super/fieldbn')->with('message', 'The Bengali Site Option is Inactive Successfully');
    }
    
    public function active(Request $request, $id)
    {

        $fieldbn_active = Fieldbn::findOrFail($id);

        $fieldbn_active->title_bn     = $request->title_bn;
        $fieldbn_active->status       = 1;
        $fieldbn_active->update();              

        return redirect('/super/fieldbn')->with('message', 'The Bengali Site Option is Active Successfully');
    }
}
