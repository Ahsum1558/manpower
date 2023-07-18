<?php

namespace App\Http\Controllers\Visa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visa;
use App\Models\Customer;
use App\Models\CustomerDocoment;
use App\Models\CustomerEmbassy;
use App\Models\CustomerPassport;
use App\Models\CustomerRate;
use App\Models\CustomerVisa;
use App\Models\CustomerManpower;
use App\Models\Delegate;
use App\Models\Visatrade;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class VisapdfController extends Controller
{
    public function getpdf()
    {
        $mpdf = $this->getMpdfHeader();

        $all_visa = Visa::latest() -> get(); // as latest
        $visaCounts = [];

        foreach ($all_visa as $visa) {
            $visaId = $visa->id;
            $total_customer = CustomerEmbassy::where('visaId', $visaId)->count();
            $visaCounts[$visaId] = $total_customer;
        }
        $output = view('admin.visa.visainfo.pdf',  compact('all_visa', 'visaCounts'))->render();

        $mpdf->WriteHTML($output);
        $filename = 'Visa List.pdf';
        $mpdf->Output($filename, 'I');
    }

    public function getVisaPdf($id)
    {
        $mpdf = $this->getMpdfHeader();

        $single_visa = Visa::find($id);
        $customer_data = $this->getVisaCustomers($id);

         if ($single_visa !== null) {
            $visaCounts = [];
            $visaId = $single_visa->id;
            $total_customer = CustomerEmbassy::where('visaId', $id)->count();
            $visaCounts[$visaId] = $total_customer;
            $output = view('admin.visa.visainfo.visaDetailsPdf', [
            'single_visa'=>$single_visa,
            'visaCounts'=>$visaCounts,
            'customer_data'=>$customer_data,
        ])->render();
        $mpdf->WriteHTML($output);
        $filename = $single_visa->visano_en.'.pdf';
        $mpdf->Output($filename, 'I');
        }else{
            return redirect('/visa');
        }
    }

    protected function getMpdfHeader(){
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        return $mpdf;
    }

    protected function getVisaCustomers($id){
        $data_details = DB::table('customers')
            ->where('customer_embassies.visaId', $id)
            ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
            ->leftJoin('submission_customers', 'customers.id', '=', 'submission_customers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('countries', 'customers.countryFor', '=', 'countries.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'countries.countryname as destination_country')
            ->get();
        return $data_details;
    }
}