<h4 class="mb-4 basic_headline">All Manpower Payment</h4>
<div class="table-responsive">
  <table id="example3" class="display" style="min-width: 700px">
      <thead>
          <tr>
              <th>SL</th>
              <th>Manpower Date</th>
              <th>Customers</th>
              <th>Income Tax</th>
              <th>Insurance</th>
              <th>Smart Card</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @php
          $i=1;
        @endphp
      @foreach($all_payment as $payment)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ date('d-M-Y', strtotime($payment->manpowerDate)) }}</td>
            <td>{{ $payment->customerNumber }}</td>
            <td>{{ $payment->incomeTax }}</td>
            <td>{{ $payment->welfareInsurance }}</td>
            <td>{{ $payment->smartCard }}</td>
            <td>
              @if($payment->status == 1)
                {{ __('Active') }}
                @elseif($payment->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              <a class="view_option" href="{{ route('admin.manpower.showPayment', ['id'=>$payment->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
            @if($payment->status == 1)
            <form class="d-inline-block" action="{{ route('admin.manpower.inactivePayment', ['id'=>$payment->id]) }}" method="POST" onsubmit="return confirm('Are you sure to Inactive !')">
              @csrf
              @method('POST')
              <button type="submit" class="edit_option bg-warning">
                <i class="fas fa-caret-square-down"></i>
                <span>Set Inactive</span>
              </button>
            </form>
            @elseif($payment->status == 0)
            <form class="d-inline-block" action="{{ route('admin.manpower.activePayment', ['id'=>$payment->id]) }}" method="POST" onsubmit="return confirm('Are you sure to Active !')">
              @csrf
              @method('POST')
              <button type="submit" class="edit_option">
                <i class="fas fa-caret-square-up"></i>
                <span>Set Active</span>
              </button>
            </form>
            @endif
            @if(Auth::check() && (Auth::user()->role == 'admin'))
              <a class="delete_option" onclick="return confirm('Are you sure to delete !')" href="{{ route('admin.manpower.delete', ['id'=>$payment->id]) }}"><i class="fas fa-trash"></i><span>Delete Manpower Payment</span></a>
            @endif
            </td>
        </tr>
@endforeach
      </tbody>
  </table>
</div>