@php
    $data = app('App\Helpers\BanglaNumberConverter');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Put Up List</title>
    <link href="{{ asset('public/admin/assets/css/pdf/putupprint.css') }}" rel="stylesheet">
</head>
<body>

<div class="app_wrapper clear">
    <div class="main_content clear">
        <div class="putup_headline clear">
            <div class="main_heading">
                <div class="top_heading">একক বহির্গমন ছাড়পত্রের পুটআপশীট ও ডাটাএন্ট্রি ফরম</div>
                <div class="heading_data">
                    <span class="headingdata_left">নিয়োগকারী দেশের নাম - </span>
                    <span class="headingdata_right">{{ $manpower_single_data[0]->countrynamebn }}</span>
                </div>
                <div class="heading_data">
                    <span class="headingdata_left">জমাদানকারী রিক্রুটিং এজেন্সীর নাম - </span>
                    <span class="headingdata_right">মেসার্স {{ $manpower_single_data[0]->title_bn }}</span>
                </div>
                <div class="heading_data_bottom">
                    <div class="left_bottom">
                        <span class="headingdata_left">লাইসেন্স নং - </span>
                        <span class="headingdata_right">{{ $manpower_single_data[0]->license_bn }}</span>
                    </div>
                    <div class="right_bottom">
                        <span class="headingdata_left">জমার তারিখ - </span>
                        <span class="headingdata_right">
            @php
                $mp_date = date('d/m/Y', strtotime($manpower_single_data[0]->manpowerDate));
            @endphp
                            {{ $data->convertToBanglaNumber($mp_date) }}</span>
                    </div>
                </div>
            </div>
            <div class="headline_right">
                <div class="right_top">ক্লিয়ারেন্স নং:</div>
                <div class="right_bottom">তারিখঃ</div>
            </div>
        </div>


        <div class="putup_customers">
            <div class="customers_table">
                <table id="customersData">
                    <thead>
                        <tr>
                            <th>ক্র. নং</th>
                            <th>বিদেশগামী কর্মীর নাম</th>
                            <th>পাসপোর্ট নম্বর</th>
                            <th>ভিসা/এন ও সি নম্বর ও তারিখ</th>
                            <th>ভিসা এডভাইস নম্বর ও তারিখ</th>
                            <th>নিয়োগকর্তার নাম</th>
                            <th>ভিসার সংখ্যা</th>
                            <th>প্রশিক্ষন সনদ নং</th>
                            <th>পদের নাম</th>
                            <th colspan="3">বেতন ও আনুষঙ্গিক সুবিধাদি</th>
                            <th>রেজিস্ট্রেশন নাম্বার</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>বেতন</th>
                            <th>আহার</th>
                            <th>বি/ভাড়া</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>02</td>
                            <td>03</td>
                            <td>04</td>
                            <td>05</td>
                            <td>06</td>
                            <td>07</td>
                            <td>08</td>
                            <td>09</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                      $i=1;
                    @endphp
                    @foreach($manpower_customers as $customer)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                {{ $customer->cusFname .' '. $customer->cusLname }}
                            </td>
                            <td>{{ $customer->passportNo }}</td>
                            <td>{{ $customer->visano_en }}</td>
                            <td>{{ $customer->stamped_visano }}</td>
                            <td>{{ $customer->sponsorname_en }}</td>
                            <td>01</td>
                            <td>{{ $customer->certificateNo }}</td>
                            <td>{{ $customer->occupation_en }}</td>
                            <td>{{ $customer->salary }}</td>
                            <td>Self</td>
                            <td>Free</td>
                            <td>{{ $customer->finger_regno }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @foreach ($manpower_payment as $payment)
            @php
                $income_tax_date = date('d/m/Y', strtotime($payment->incomeTaxDate));
                $insurance_date = date('d/m/Y', strtotime($payment->welfareInsuranceDate));
                $card_date = date('d/m/Y', strtotime($payment->smartCardDate));
            @endphp
        <div class="putup_translate">
            <div class="translate_info">
                <div class="translate_content">পে-অর্ডার টাকা {{ $numto->bnNum($payment->welfareInsurance) }}/- নং- {{ $numto->bnNum($payment->welfareInsuranceNo) }} তারিখঃ {{ $data->convertToBanglaNumber($insurance_date) }}, আয়কর টাকা {{ $numto->bnNum($payment->incomeTax) }}/- নং- {{ $numto->bnNum($payment->incomeTaxNo) }} তারিখঃ {{ $data->convertToBanglaNumber($income_tax_date) }}</div>
            </div>
        </div>
        @endforeach

        <div class="putup_promise clear">
            <div class="promise_info">
                <div class="promise_heading">এজেন্সীর অঙ্গীকারঃ</div>
                <div class="promise_content">বর্ণিত কর্মী গ্রুপ ভিসার অন্তর্ভুক্ত নয়। কর্মীদের পাসপোর্ট, ভিসা, চাকুরীর চুক্তিপত্রে বর্ণিত বেতন ও শর্তাদি সঠিক আছে। উক্ত বিষয়ে ত্রুটির কারণে কর্মীদের কোন প্রকার সমস্যা হলে আমরা <span style="font-size: 20px;">মেসার্স {{ $manpower_single_data[0]->title_bn }}, {{ $manpower_single_data[0]->license_bn }}</span> সম্পূর্ণ দায় দায়িত্ব গ্রহন ও কর্মীদের ক্ষতিপূরণ দান করতে বাধ্য থাকবে।</div>
                <div class="promise_bottom">পরীক্ষিত হয়েছে। কাগজপত্র বর্ণিত তথ্যাদি যথাযথ আছে। বহির্গমনের ছাড়পত্র দেওয়া যায়। সঠিক আছে।</div>
            </div>
        </div>

        <div class="putup_sign clear">
            <div class="sign_first">সহকারীর স্বাক্ষর</div>
            <div class="sign_second">সহকারী পরিচালকের স্বাক্ষর</div>
            <div class="sign_third">উপ-পরিচালকের স্বাক্ষর</div>
            <div class="sign_forth">পরিচালকের স্বাক্ষর</div>
            <div class="sign_fifth">মহাপরিচালক</div>
            <div class="sign_sixth">এজেন্সীর মালিক/প্রতিনিধির স্বাক্ষর প্রস্তাবমত</div>
        </div>
      
    </div>
</div>

</body>
</html>