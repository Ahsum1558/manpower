<?php

namespace App\Http\Controllers\Locaton;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use DB;

class PolicestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_upzila = $this->getInfo();
        return view('admin.location.policestation.index', compact('all_upzila'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $upzila_create = Policestation::latest() -> get(); // as latest
        $all_country = Country::latest() -> get(); // as latest

        return view('admin.location.policestation.create', [
            'upzila_create'   =>  $upzila_create,
            'all_country'       =>  $all_country
        ]);
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->get();

        return view('admin.location.policestation.ajax',[
            'all_division'=>$all_division,
        ]);
    }

    public function getDistrict(Request $request)
    {
        $all_district = District::where([
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->get();

        if (count($all_district)>0) {
            return view('admin.location.policestation.ajax_district',[
                'all_district'=>$all_district,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $upzila_create = new Policestation();

        $upzila_create->policestationname = $request->policestationname; 
        $upzila_create->districtId    = $request->districtId; 
        $upzila_create->divisionId    = $request->divisionId; 
        $upzila_create->countryId     = $request->countryId; 
        $upzila_create->save();

        return redirect() -> back() -> with('message', 'Police Station is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $upzila_single_data = $this->getDetails($id);
        
        if($upzila_single_data->count() > 0){
            return view('admin.location.policestation.show', compact('upzila_single_data'));
        }else{
            return redirect('/upzila');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $upzila_data = $this->getDetails($id);
        
        if($upzila_data->count() > 0){
            return view('admin.location.policestation.edit', compact('upzila_data'));
        }else{
            return redirect('/upzila');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validation($request);

        $upzila_data = Policestation::findOrFail($id);

        $upzila_data->policestationname = $request->policestationname; 
        $upzila_data->update();

        return redirect() -> back() -> with('message', 'Police Station Name is Updated successfully');
    }

    public function editInfo($id)
    {
        $upzila_data_info = $this->getDetails($id);
        $all_country = Country::latest() -> get();
        $all_division = Division::latest() -> get();
        $all_district = District::latest() -> get();
        
        if($upzila_data_info->count() > 0){
            return view('admin.location.policestation.editInfo', [
            'upzila_data_info'=>$upzila_data_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
        ]);
        }else{
            return redirect('/upzila');
        }
    }

    public function updateInfo(Request $request, $id)
    {
        $upzila_data_info = Policestation::findOrFail($id);

        $upzila_data_info->districtId  = $request->districtId;
        $upzila_data_info->divisionId  = $request->divisionId;
        $upzila_data_info->countryId   = $request->countryId;
        $upzila_data_info->update();

        return redirect() -> back() -> with('message', 'Police Station Info is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_upzila = Policestation::find($id);
        $data_upzila -> delete();

        return redirect() -> back() -> with('message', 'The Police Station is deleted successfully');
    }

    protected function getInfo(){
        $data_info = DB::table('policestations')
            ->leftJoin('countries', 'policestations.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'policestations.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'policestations.districtId', '=', 'districts.id')
            ->select('policestations.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname')
            ->orderBy('countries.countryname')
            ->orderBy('divisions.divisionname')
            ->orderBy('districts.districtname')
            ->orderBy('policestations.policestationname')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('policestations')
            ->leftJoin('countries', 'policestations.countryId', '=', 'countries.id')
            ->where('policestations.id', $id)
            ->leftJoin('divisions', 'policestations.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'policestations.districtId', '=', 'districts.id')
            ->select('policestations.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname')
            ->get();
        return $data_details;
    }

    protected function validation($request){
        $this -> validate($request, [
            'policestationname'   => 'required|unique:policestations',
        ],
        [
            'policestationname.required' => 'Police Station Name Field must not be Empty',
            'policestationname.unique'   => 'The Police Station Name is already exist',
        ]);
    }
}