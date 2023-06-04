<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="{{ asset('public/admin/assets/css/pdf/visaList.css') }}" rel="stylesheet">

</head>
<body>
<div class="app_wrapper clear">
    <div class="header_area clear">
        <div class="top_header clear">
            <div class="headline">
                <h3 class="visa_heading">Visa List</h3>
            </div>
        </div>
    </div>
    <div class="content_area clear">
        <div class="content_table">
            <table id="visalist_table">

                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Visa No.</th>
                        <th>Sponsor Id No.</th>
                        <th>Sponsor Name</th>
                        <th>Location</th>
                        <th>Visa Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                      $i=1;
                    @endphp
                  @foreach($all_visa as $visa)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $visa->visano_en }}</td>
                        <td>{{ $visa->sponsorid_en }}</td>
                        <td>{{ $visa->sponsorname_en }}</td>
                        <td>{{ $visa->visa_address }}</td>
                        <td>{{ $visa->visa_date }}</td>
                        <td>
                          @if($visa->status == 1)
                            {{ __('Active') }}
                            @elseif($visa->status == 0)
                            {{ __('Inactive') }}
                          @endif
                        </td>
                        
                    </tr>
               @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>