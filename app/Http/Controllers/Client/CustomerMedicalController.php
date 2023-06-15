<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\CustomerDocoment;
use App\Models\CustomerEmbassy;
use App\Models\CustomerPassport;
use App\Models\CustomerRate;
use App\Models\CustomerVisa;
use App\Models\Delegate;
use App\Models\Visatrade;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\Issue;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CustomerMedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function medical()
    {
        $all_medical_none = $this->getInfo()->where('medical','=',4); // as latest
        $all_medical_done = $this->getInfo()->where('medical','=',1); // as latest
        $all_medical_fit = $this->getInfo()->where('medical','=',2); // as latest
        $all_medical_unfit = $this->getInfo()->where('medical','=',3); // as latest
        $all_medical_problem = $this->getInfo()->where('medical','=',5); // as latest
        return view('admin.client.customer.medical.medical', [
            'all_medical_none'=>$all_medical_none,
            'all_medical_done'=>$all_medical_done,
            'all_medical_fit'=>$all_medical_fit,
            'all_medical_unfit'=>$all_medical_unfit,
            'all_medical_problem'=>$all_medical_problem,
        ]);
    }

    public function editMedical($id)
    {
        $customer_medical = Customer::find($id);
        
        if ($customer_medical !== null) {
            return view('admin.client.customer.medical.editMedical', compact('customer_medical'));
        }else{
            return redirect('/customer/medical');
        }
    }

    public function updateMedical(Request $request, $id)
    {
        $customer_medical = Customer::findOrFail($id);

        $customer_medical->medical    = $request->medical;
        $customer_medical->update();

        return redirect() -> back() -> with('message', 'Customer Medical Info is Updated successfully');
    }

    protected function getInfo(){
        $data_info = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver')
            ->orderBy('customers.customersl', 'desc')
            ->get();
        return $data_info;
    }
}