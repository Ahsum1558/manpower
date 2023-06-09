<!--**********************************
    Sidebar start
***********************************-->
<div class="deznav" id="nav_menu">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{ url('/') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-user"></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.profile') }}">Profile</a></li>
                    <li><a href="{{ route('admin.theme') }}">Theme Option</a></li>
                    <li><a href="{{ route('admin.customerRef') }}">Customer Ref</a></li>
                @if(Auth::user()->role == 'admin')                    
                    <li><a href="{{ route('admin.operator') }}">All Operator</a></li>
                @endif                    
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-map-marker"></i>
                    <span class="nav-text">Location</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.country') }}">Country</a></li>
                    <li><a href="{{ route('admin.division') }}">Division</a></li>
                    <li><a href="{{ route('admin.district') }}">District</a></li>
                    <li><a href="{{ route('admin.policestation') }}">Police Station</a></li>
                    <li><a href="{{ route('admin.city') }}">City</a></li>
                    <li><a href="{{ route('admin.issue') }}">Issue Place</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-address-card-o"></i>
                    <span class="nav-text">Visa</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.visa') }}">Visa Info</a></li>
                    <li><a href="{{ route('admin.visaTrade') }}">Visa Trade</a></li>
                    <li><a href="{{ route('admin.visaType') }}">Visa Type</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-controls-3"></i>
                    <span class="nav-text">Delegate</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.delegate') }}">Delegate Info</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <span class="nav-text">Customer</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.customer') }}">Customer Info</a></li>
                    <li><a href="{{ route('admin.customer.medical') }}">Medical Info</a></li>
                    <li><a href="{{ route('admin.submission') }}">Submission Info</a></li>
                    <li><a href="{{ route('admin.manpower') }}">Manpower Info</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-link"></i>
                    <span class="nav-text">Important Links</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.link') }}">Links</a></li>
                </ul>
            </li>
            <li><a href="{{ url('logout') }}" class="ai-icon" aria-expanded="false">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>

            
<?php //if (Session::get('userRole') == '1') { ?>
            <li><a href="summary.php" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-internet"></i>
                    <span class="nav-text">Account Summary</span>
                </a>
            </li>
<?php// } ?>
<?php// if (Session::get('userRole') == '1' || Session::get('userRole') == '2') { ?>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-wrench" aria-hidden="true"></i>
                    <span class="nav-text">Setting</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="aide.php">Sister Concern</a></li>
                    <li><a href="asset.php">Assets</a></li>
                    <li><a href="request.php">Request Option</a></li>
                </ul>
            </li>
<?php// } ?>
            
            

            
             
            
<?php// if (Session::get('userRole') == '1' || Session::get('userRole') == '2') { ?>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-suitcase" aria-hidden="true"></i>
                    <span class="nav-text">Payment Party</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="party.php">Party Info</a></li>
                </ul>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-bank"></i>
                    <span class="nav-text">Banking</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="bank.php">Bank Account</a></li>
                    <li><a href="mobile.php">Mobile Account</a></li>
                </ul>
            </li>
            
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Category</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="category.php">Account Category</a></li>
                    <li><a href="catFil.php">Filter By Date Range</a></li>
                    <li><a href="catFilDay.php">Filter Daily</a></li>
                    <li><a href="catFilMonth.php">Filter Monthly</a></li>
                    <li><a href="catFilYear.php">Filter Yearly</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-network"></i>
                    <span class="nav-text">Cash</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="cashDep.php">Cash Deposit</a></li>
                    <li><a href="cashWit.php">Cash Withdraw</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-coins"></i>
                    <span class="nav-text">Bank</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="bankDep.php">Bank Deposit</a></li>
                    <li><a href="bankWit.php">Bank Withdraw</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-money-bill-alt"></i>
                    <span class="nav-text">Mobile</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="mobileDep.php">Mobile Bank Deposit</a></li>
                    <li><a href="mobileWit.php">Mobile Bank Withdraw</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-database" aria-hidden="true"></i>
                    <span class="nav-text">Money Transfer</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Cash Transfer</a>
                        <ul aria-expanded="false">
                            <li><a href="cashTransfer.php">Cash To Cash</a></li>
                            <li><a href="cashReturn.php">Cash Return</a></li>
                            <li><a href="cashTransBank.php">Cash To Bank</a></li>
                            <li><a href="cashTransMobile.php">Cash To Mobile</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Bank Transfer</a>
                        <ul aria-expanded="false">
                            <li><a href="bankTransCash.php">Bank To Cash</a></li>
                            <li><a href="bankTransBank.php">Bank To Bank</a></li>
                            <li><a href="bankTransMobile.php">Bank To Mobile</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Mobile Transfer</a>
                        <ul aria-expanded="false">
                            <li><a href="mobileTransCash.php">Mobile To Cash</a></li>
                            <li><a href="mobileTransBank.php">Mobile To Bank</a></li>
                            <li><a href="mobileTransMobile.php">Mobile To Mobile</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Transaction</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="cashtran.php">Cash Transaction</a></li>
                    <li><a href="banktran.php">Bank Transaction</a></li>
                    <li><a href="mobiletran.php">Mobile Transaction</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-credit-card"></i>
                    <span class="nav-text">Filter By Date Range</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Cash</a>
                        <ul aria-expanded="false">
                            <li><a href="cashDepFil.php">Cash Deposit</a></li>
                            <li><a href="cashWitFil.php">Cash Withdraw</a></li>
                            <li><a href="cashTranFil.php">Cash Transaction</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Bank</a>
                        <ul aria-expanded="false">
                            <li><a href="bankDepFil.php">Bank Deposit</a></li>
                            <li><a href="bankWitFil.php">Bank Withdraw</a></li>
                            <li><a href="bankTranFil.php">Bank Transaction</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Mobile</a>
                        <ul aria-expanded="false">
                            <li><a href="mobileDepFil.php">Mobile Deposit</a></li>
                            <li><a href="mobileWitFil.php">Mobile Withdraw</a></li>
                            <li><a href="mobileTranFil.php">Mobile Transaction</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-heart"></i>
                    <span class="nav-text">Filter Daily</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Cash</a>
                        <ul aria-expanded="false">
                            <li><a href="cashDepDay.php">Cash Deposit</a></li>
                            <li><a href="cashWitDay.php">Cash Withdraw</a></li>
                            <li><a href="cashTranDay.php">Cash Transaction</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Bank</a>
                        <ul aria-expanded="false">
                            <li><a href="bankDepDay.php">Bank Deposit</a></li>
                            <li><a href="bankWitDay.php">Bank Withdraw</a></li>
                            <li><a href="bankTranDay.php">Bank Transaction</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Mobile</a>
                        <ul aria-expanded="false">
                            <li><a href="mobileDepDay.php">Mobile Deposit</a></li>
                            <li><a href="mobileWitDay.php">Mobile Withdraw</a></li>
                            <li><a href="mobileTranDay.php">Mobile Transaction</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-layer-1"></i>
                    <span class="nav-text">Filter Monthly</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Cash</a>
                        <ul aria-expanded="false">
                            <li><a href="cashDepMon.php">Cash Deposit</a></li>
                            <li><a href="cashWitMon.php">Cash Withdraw</a></li>
                            <li><a href="cashTranMon.php">Cash Transaction</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Bank</a>
                        <ul aria-expanded="false">
                            <li><a href="bankDepMon.php">Bank Deposit</a></li>
                            <li><a href="bankWitMon.php">Bank Withdraw</a></li>
                            <li><a href="bankTranMon.php">Bank Transaction</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Mobile</a>
                        <ul aria-expanded="false">
                            <li><a href="mobileDepMon.php">Mobile Deposit</a></li>
                            <li><a href="mobileWitMon.php">Mobile Withdraw</a></li>
                            <li><a href="mobileTranMon.php">Mobile Transaction</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Filter Yearly</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Cash</a>
                        <ul aria-expanded="false">
                            <li><a href="cashDepYear.php">Cash Deposit</a></li>
                            <li><a href="cashWitYear.php">Cash Withdraw</a></li>
                            <li><a href="cashTranYear.php">Cash Transaction</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Bank</a>
                        <ul aria-expanded="false">
                            <li><a href="bankDepYear.php">Bank Deposit</a></li>
                            <li><a href="bankWitYear.php">Bank Withdraw</a></li>
                            <li><a href="bankTranYear.php">Bank Transaction</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Filter Mobile</a>
                        <ul aria-expanded="false">
                            <li><a href="mobileDepYear.php">Mobile Deposit</a></li>
                            <li><a href="mobileWitYear.php">Mobile Withdraw</a></li>
                            <li><a href="mobileTranYear.php">Mobile Transaction</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
<?php //} ?>
            


        </ul>

    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">