<h4 class="mb-4 basic_headline">Medical Fit</h4>
<div class="table-responsive">
  <table id="example4" class="display" style="min-width: 700px">
      <thead>
          <tr>
              <th>SL</th>
              <th>Serial</th>
              <th>Book Ref</th>
              <th>Name</th>
              <th>Passport No.</th>
              <th>Delegate</th>
              <th>Trade</th>
              <th>Medical</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @php
          $i=1;
        @endphp
      @foreach($all_medical_fit as $medical_fit)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $medical_fit->customersl }}</td>
            <td>{{ $medical_fit->bookRef }}</td>
            <td>{{ $medical_fit->cusFname .' '. $medical_fit->cusLname }}</td>
            <td>{{ $medical_fit->passportNo }}</td>
            <td>{{ $medical_fit->agentname .' '. $medical_fit->agentsl }}</td>
            <td>{{ $medical_fit->visatrade_name }}</td>
            <td>
              @if($medical_fit->medical == 1)
                {{ __('Done') }}
                @elseif($medical_fit->medical == 2)
                {{ __('Fit') }}
                @elseif($medical_fit->medical == 3)
                {{ __('Unfit') }}
                @elseif($medical_fit->medical == 4)
                {{ __('N/A') }}
                @elseif($medical_fit->medical == 5)
                {{ __('Problem') }}
              @endif
            </td>
            <td>
              @if($medical_fit->status == 1)
                {{ __('Active') }}
                @elseif($medical_fit->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              <a class="view_option" href="{{ route('admin.customer.show', ['id'=>$medical_fit->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
              <a class="edit_option" href="{{ route('admin.customer.editMedical', ['id'=>$medical_fit->id]) }}"><i class="fas fa-edit"></i><span>Update Medical</span></a>
            
            </td>
        </tr>
@endforeach
      </tbody>
  </table>
</div>