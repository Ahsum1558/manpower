<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Super;
use App\Models\Field;
use App\Models\Headerfooter;
use App\Models\TravelSetup;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class TravelSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $header_footer_travel = $this->getInfo();
        return view('super.travelset.index', compact('header_footer_travel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setup_travel_data = TravelSetup::latest() -> get(); // as latest
        $field_data = Field::latest()->where('status','=',1) -> get(); // as latest

        return view('super.travelset.create', [
            'setup_travel_data'=>$setup_travel_data,
            'field_data'=>$field_data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $setup_travel_data = new TravelSetup();

        $setup_travel_data->field_id       = $request->field_id; 
        $setup_travel_data->footer_title   = $request->footer_title; 
        $setup_travel_data->content        = $request->content; 
        $setup_travel_data->type           = $request->type; 
        $setup_travel_data->menu           = $request->menu; 
        $setup_travel_data->contact_info   = $request->contact_info; 
        $setup_travel_data->links          = $request->links; 
        $setup_travel_data->status         = $request->status;

        $existingRecord = TravelSetup::first();
        if (!$existingRecord) {
            $setup_travel_data->save();
        return redirect() -> back() -> with('message', 'Travel Header and Footer Option is added successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Travel Header and Footer Option is already exist in the table !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_travel_setup = $this->getDetails($id);
        
        if($single_travel_setup->count() > 0){
            return view('super.travelset.show', compact('single_travel_setup'));
        }else{
            return redirect('/super/travelset');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $travel_setup_info = $this->getDetails($id);
        $field_data_info = Field::all()->where('status','=',1); 

        if($travel_setup_info->count() > 0){
                return view('super.travelset.edit', [
                'travel_setup_info'=>$travel_setup_info,
                'field_data_info'=>$field_data_info
            ]);
        }else{
            return redirect('/super/travelset');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validation($request);

        $travel_setup_info = TravelSetup::findOrFail($id);

        $travel_setup_info->field_id       = $request->field_id; 
        $travel_setup_info->footer_title   = $request->footer_title; 
        $travel_setup_info->content        = $request->content; 
        $travel_setup_info->type           = $request->type; 
        $travel_setup_info->menu           = $request->menu; 
        $travel_setup_info->contact_info   = $request->contact_info; 
        $travel_setup_info->links          = $request->links; 
        $travel_setup_info->status         = $request->status;
        $travel_setup_info->update();              

        return back()->with('message', 'Travel Header and Footer Option is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_travel_setup = TravelSetup::find($id);
        $data_travel_setup -> delete();

        return redirect() -> back() -> with('message', 'The Travel Header and Footer data is deleted successfully');
    }

    public function inactive($id)
    {

        $travelsetup_inactive = TravelSetup::findOrFail($id);

        $travelsetup_inactive->status          = 0;
        $travelsetup_inactive->update();              

        return redirect('/super/travelset')->with('message', 'The Travel Header and Footer Option is Inactive Successfully');
    }
    
    public function active($id)
    {

        $travelsetup_active = TravelSetup::findOrFail($id);

        $travelsetup_active->status        = 1;
        $travelsetup_active->update();              

        return redirect('/super/travelset')->with('message', 'The Travel Header and Footer Option is Active Successfully');
    }

    protected function getDetails($id){
        $header_footer_single_data_info = TravelSetup::leftJoin('fields','travel_setups.field_id','=','fields.id')
        ->where('travel_setups.id', $id)
        ->select('travel_setups.*', 'fields.title', 'fields.smalltitle', 'fields.license','fields.licenseExpiry', 'fields.address', 'fields.proprietor', 'fields.proprietortitle', 'fields.telephone', 'fields.cellphone', 'fields.helpline','fields.email', 'fields.web', 'fields.logo')->get();
        return $header_footer_single_data_info;
    }

    protected function getInfo(){
        $data_info = TravelSetup::leftJoin('fields','travel_setups.field_id','=','fields.id')
        ->select('travel_setups.*', 'fields.title', 'fields.smalltitle', 'fields.license', 'fields.licenseExpiry', 'fields.address', 'fields.logo')
        ->limit(1)->get();
        return $data_info;
    }

    protected function validation($request){
        $this -> validate($request, [
            'field_id'      => 'required|exists:fields,id',
            'footer_title'  => 'required',
            'contact_info'  => 'required',
            'content'       => 'required',
            'links'         => 'required',
            'status'        => 'required|in:1,0',
        ],
        [
            'footer_title.required' => 'Footer Title Field must not be Empty',
            'contact_info.required' => 'Contact Info Field must not be Empty',
            'content.required'      => 'Content Field must not be Empty',
            'links.required'        => 'Links Field must not be Empty',
            'field_id.required'     => "Office Field is required !!",
            'field_id.exists'       => "Invalid Office Field !!",
            'status.required'       => 'Status Field is required',
            'status.in'             => 'Invalid status option selected',
        ]);
    }
}