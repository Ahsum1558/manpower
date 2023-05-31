<?php

namespace App\Http\Controllers\Locaton;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_country = Country::latest() -> get(); // as latest
        return view('admin.location.country.index', compact('all_country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.location.country.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Country::create([
            'countryname'           => $request->countryname,
            'nationality'           => $request->nationality,
            'status'                => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Country is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $single_country = Country::find($id);
        
        if ($single_country !== null) {
            return view('admin.location.country.show', compact('single_country'));
        }else{
            return redirect('/country');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country_data = Country::find($id);
        
        if ($country_data !== null) {
            return view('admin.location.country.edit', compact('country_data'));
        }else{
            return redirect('/country');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validationName($request);
        $country_data = Country::findOrFail($id);

        $country_data->countryname   = $request->countryname;
        $country_data->update();              

        return back()->with('message', 'The Country Name is Updated Successfully');
    }

    public function editNationality($id)
    {
        $country_National = Country::find($id);
        
        if ($country_National !== null) {
            return view('admin.location.country.editNational', compact('country_National'));
        }else{
            return redirect('/country');
        }
    }

    public function updateNationality(Request $request, $id)
    {
        $this->validationNationality($request);
        $country_National = Country::findOrFail($id);

        $country_National->nationality        = $request->nationality;
        $country_National->update();              

        return back()->with('message', 'The Nationality is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_country = Country::find($id);
        $data_country -> delete();

        return redirect() -> back() -> with('message', 'The Country is deleted successfully');
    }

    public function inactive(Request $request, $id)
    {

        $country_inactive = Country::findOrFail($id);

        $country_inactive->countryname = $request->countryname;
        $country_inactive->status      = 0;
        $country_inactive->update();              

        return redirect('/country')->with('message', 'The Country is Inactive Successfully');
    }
    
    public function active(Request $request, $id)
    {

        $country_active = Country::findOrFail($id);

        $country_active->countryname   = $request->countryname;
        $country_active->status        = 1;
        $country_active->update();              

        return redirect('/country')->with('message', 'The Country is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'countryname'       => 'required|unique:countries',
            'nationality'       => 'required|unique:countries',
        ],
        [
            'countryname.required' => 'Country Name Field must not be Empty',
            'countryname.unique'   => 'The Country Name is already exist',
            'nationality.required' => 'Nationality Field is required',
            'nationality.unique'   => 'The Nationality is already exist',
        ]);
    }

    protected function validationName($request){
        $this -> validate($request, [
            'countryname'       => 'required|unique:countries',
        ],
        [
            'countryname.required'  => 'Country Name Field must not be Empty',
            'countryname.unique'    => 'The Country Name is already exist',
        ]);
    }

    protected function validationNationality($request){
        $this -> validate($request, [
            'nationality'       => 'required|unique:countries',
        ],
        [
            'nationality.required' => 'Nationality Field is required',
            'nationality.unique'   => 'The Nationality is already exist',
        ]);
    }
}