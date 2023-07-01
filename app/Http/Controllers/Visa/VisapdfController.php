<?php

namespace App\Http\Controllers\Visa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visa;
use App\Models\CustomerEmbassy;
use DB;
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

    protected function getMpdfHeader(){
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        return $mpdf;
    }
}
