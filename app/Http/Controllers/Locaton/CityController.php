<?php

namespace App\Http\Controllers\Locaton;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\City;
use DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_city = $this->getInfo();
        return view('admin.location.city.index', compact('all_city'));
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        return view('admin.location.city.ajax',[
            'all_division'=>$all_division,
        ]);
    }

    public function getDistrict(Request $request)
    {
        $all_district = District::where([
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        if (count($all_district)>0) {
            return view('admin.location.city.ajax_district',[
                'all_district'=>$all_district,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $city_create = City::latest() -> get(); // as latest
        $all_country = Country::latest()->where('status','=',1) -> get(); // as latest

        return view('admin.location.city.create', [
            'city_create'   =>  $city_create,
            'all_country'   =>  $all_country
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $city_create = new City();

        $city_create->cityname      = $request->cityname; 
        $city_create->districtId    = $request->districtId; 
        $city_create->divisionId    = $request->divisionId; 
        $city_create->countryId     = $request->countryId; 
        $city_create->status        = $request->status; 
        $city_create->save();

        return redirect() -> back() -> with('message', 'City is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $city_single_data = $this->getDetails($id);
        
        if($city_single_data->count() > 0){
            return view('admin.location.city.show', compact('city_single_data'));
        }else{
            return redirect('/city');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $city_data = $this->getDetails($id);
        
        if($city_data->count() > 0){
            return view('admin.location.city.edit', compact('city_data'));
        }else{
            return redirect('/city');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validation($request);

        $city_data = City::findOrFail($id);

        $city_data->cityname = $request->cityname; 
        $city_data->update();

        return redirect() -> back() -> with('message', 'City Name is Updated successfully');
    }

    public function editInfo($id)
    {
        $city_data_info = $this->getDetails($id);
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        
        if($city_data_info->count() > 0){
            return view('admin.location.city.editInfo', [
            'city_data_info'=>$city_data_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
        ]);
        }else{
            return redirect('/city');
        }
    }

    public function updateInfo(Request $request, $id)
    {
        $city_data_info = City::findOrFail($id);

        $city_data_info->districtId  = $request->districtId;
        $city_data_info->divisionId  = $request->divisionId;
        $city_data_info->countryId   = $request->countryId;
        $city_data_info->status      = $request->status;
        $city_data_info->update();

        return redirect() -> back() -> with('message', 'City Info is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_city = City::find($id);
        $data_city -> delete();

        return redirect() -> back() -> with('message', 'The City is deleted successfully');
    }

    public function inactive(Request $request, $id)
    {

        $city_inactive = City::findOrFail($id);

        $city_inactive->cityname    = $request->cityname;
        $city_inactive->status      = 0;
        $city_inactive->update();              

        return redirect('/city')->with('message', 'The City is Inactive Successfully');
    }
    
    public function active(Request $request, $id)
    {

        $city_active = City::findOrFail($id);

        $city_active->cityname  = $request->cityname;
        $city_active->status    = 1;
        $city_active->update();              

        return redirect('/city')->with('message', 'The City is Active Successfully');
    }

    protected function getInfo(){
        $data_info = DB::table('cities')
            ->leftJoin('countries', 'cities.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'cities.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'cities.districtId', '=', 'districts.id')
            ->select('cities.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname')
            ->orderBy('countries.countryname')
            ->orderBy('divisions.divisionname')
            ->orderBy('districts.districtname')
            ->orderBy('cities.cityname')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('cities')
            ->leftJoin('countries', 'cities.countryId', '=', 'countries.id')
            ->where('cities.id', $id)
            ->leftJoin('divisions', 'cities.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'cities.districtId', '=', 'districts.id')
            ->select('cities.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname')
            ->get();
        return $data_details;
    }

    protected function validation($request){
        $this -> validate($request, [
            'cityname'   => 'required|unique:cities',
        ],
        [
            'cityname.required' => 'City Name Field must not be Empty',
            'cityname.unique'   => 'The City Name is already exist',
        ]);
    }
}