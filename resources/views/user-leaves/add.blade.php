@extends('layouts.master')
@section('title')
    @lang('translation.list-js')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')

<div class="row">
      @php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

$userId = Auth::user()->id;

// First, fetch the user details
$user = DB::table('users')->where('id', $userId)->first();

// If the user is not an admin, perform the joins
if ($user && $user->is_admin != 'admin') {
    $user = DB::table('users')
        ->join('designations', 'users.design_id', '=', 'designations.id')
        ->join('departments', 'users.depart_id', '=', 'departments.id')
        ->join('organizations', 'users.org_id', '=', 'organizations.id')
        ->select('users.*', 
                 'designations.designation_name', 
                 'departments.name as department_name', 
                 'organizations.org_name as organisation_name')
        ->where('users.id', $userId)
        ->first();
}

@endphp

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add User Leaves</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <form class="leave-form" method="POST" action="{{ route('leaves.store') }}" autocomplete="off">
                    @csrf

                         <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select id="state" name="state" class="form-control" >
                                <option value="">Select State</option>
                                @foreach($statesData['states'] as $state)
                <option value="{{ $state['state'] }}" {{ $user->state === $state['state'] ? 'selected' : '' }}>
                    {{ $state['state'] }}
                </option>
                                @endforeach
                            </select>
                            @error('state')
            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="district" class="form-label">District</label>
                            <select id="district" name="district" class="form-control" >
                                <option value="">Select District</option>
                                <!-- Districts will be loaded here -->
                            </select>
                            @error('district')
            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        
                        
                                                
                                                                          <div class="col-md-4">
                            <label for="organisation" class="form-label">select organization</label>
                            <select id="organisation" name="organisation" class="form-select mb-3" >
                                <option value="">Select organisation</option>
                            </select>
                             @error('organisation')
                <div class="invalid-feedback d-block">{{ $message }}</div>

    @enderror
                        </div>


                        
                                            <div class="row">
                                                
                                                
                                                <div class="col-md-4">
                            <label for="department_name" class="form-label">Select Department</label>
                           <select name="department_name"  id ="department_name" class="form-select mb-3" >
                            <option value="">-- Select Department --</option>
                        </select>
                        @error('department_name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror


                        </div>
                        
                        
                                                                                        <div class="col-md-4">
                            <label for="taluka-field" class="form-label">Taluka</label>
                            <select id="taluka-field" name="taluka" class="form-control" >
                                <option value="">Select Taluka</option>
                                <!-- Talukas will be loaded here -->
                            </select>
                            @error('taluka')
            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        
                        
                        
                        
                        
                        
                        
                                        <div class="col-md-4">
    <label for="designation" class="form-label">Select Designation</label>
    <select name="designation" id="designation" class="form-select mb-3">
        <option value="">-- Select Designation --</option>
    </select>
    @error('designation')
                <div class="invalid-feedback d-block">{{ $message }}</div>

    @enderror
</div>   
                        
                        
                                     
                                                





</div>
                     

                    <div class="row">
                        
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Profile Name</label>
<select id="name" name="name" class="form-control @error('name') is-invalid @enderror">
                                <option value="">Select Profile Name</option>
                            </select>
                            @error('name')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                            <div class="col-md-6 mb-3">
    <label for="available-leaves-field" class="form-label">Available Leaves</label>
    <input type="number" id="available_leave_field" name="available_leave_days" class="form-control" placeholder="Available Leaves" readonly />
</div>

                        
                        </div>
                        <div class="row">
        
                        <div class="col-md-6 mb-3">
                            <label for="subject-field" class="form-label">Leave Subject</label>
                            <input type="text" id="subject-field" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Enter Leave Subject"  />
                            @error('subject')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        
                          
                   
                        
                        

                        <div class="col-md-6 mb-3">
                            <label for="description-field" class="form-label">Leave Description</label>
                            <textarea id="description-field" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Leave Description" ></textarea>
                            @error('description')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        
                        
                        
                                                <div class="col-md-6 mb-3">
                            <label for="leave_category" class="form-label">Leave category</label>

                            <select id="leave_category" name="leave_category" class="form-control">
                                                                                            <option value="">Select Leave category</option>

                                                            @foreach($leaves as $leave)

                                <option value="{{$leave->leave_type}}">{{$leave->leave_type}}</option>
                                                            @endforeach

                            </select>
                            @error('leave_category')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start-date-field" class="form-label">Leave Starting Date</label>
                            <input type="date" id="start-date-field" name="start_date" class="form-control @error('start_date') is-invalid @enderror"  />
                            @error('start_date')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end-date-field" class="form-label">Leave Ending Date</label>
                            <input type="date" id="end-date-field" name="end_date" class="form-control @error('end_date') is-invalid @enderror"  />
                            @error('end_date')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="apply-start-date-field" class="form-label">Leave Applied Starting Date</label>
                            <input type="date" id="apply-start-date-field" name="apply_start_date" class="form-control @error('apply_start_date') is-invalid @enderror"  />
                            @error('apply_start_date')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="apply-end-date-field" class="form-label">Leave Applied Ending Date</label>
                            <input type="date" id="apply-end-date-field" name="apply_end_date" class="form-control @error('apply_end_date') is-invalid @enderror"  />
                            @error('apply_end_date')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                                                       <div class="col-md-3 mb-3">
        <label for="leave-days-field" class="form-label">Leave Days</label>
        <input type="text" id="leave-days-field" name="leave_days" class="form-control" readonly />
    </div>


    <div class="col-md-3 mb-3">
        <label for="available-leave" class="form-label">Do you want to reduce days from available leave?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" id="available-leave-yes" name="available_leave" value="yes">
            <label class="form-check-label" for="available-leave-yes">Yes</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" id="available-leave-no" name="available_leave" value="no">
            <label class="form-check-label" for="available-leave-no">No</label>
        </div>
    </div>


                   
                            
                        </div>
                        


                    <!--<div class="row">-->
                    <!--    <div class="col-md-6 mb-3">-->
                    <!--        <label for="approver-field" class="form-label">Leave Approved By</label>-->
                    <!--        <input type="text" id="approver-field" name="approver" class="form-control @error('approver') is-invalid @enderror" placeholder="Enter Approver's Name" />-->
                    <!--        @error('approver')-->
                    <!--            <div class="invalid-feedback text-red">{{ $message }}</div>-->
                    <!--        @enderror-->
                    <!--    </div>-->

                    <!--    <div class="col-md-6 mb-3">-->
                    <!--        <label for="rejecter-field" class="form-label">Leave Rejecter</label>-->
                    <!--        <input type="text" id="rejecter-field" name="rejecter" class="form-control @error('rejecter') is-invalid @enderror" placeholder="Enter Rejecter's Name" />-->
                    <!--        @error('rejecter')-->
                    <!--            <div class="invalid-feedback text-red">{{ $message }}</div>-->
                    <!--        @enderror-->
                    <!--    </div>-->
                    <!--</div>--> 
<input type="hidden" name="status" value="pending">
                    
                    <!--<div class="row">-->
                    <!--    <div class="col-md-12 mb-3">-->
                    <!--        <label for="status-field" class="form-label">Leave Status</label>-->
                    <!--        <select class="form-control @error('status') is-invalid @enderror" name="status" id="status-field" >-->
                    <!--            <option value="">Select Status</option>-->
                    <!--            <option value="pending">Pending</option>-->
                    <!--            <option value="approved">Approved</option>-->
                    <!--            <option value="rejected">Rejected</option>-->
                    <!--        </select>-->
                    <!--        @error('status')-->
                    <!--            <div class="invalid-feedback text-red">{{ $message }}</div>-->
                    <!--        @enderror-->
                    <!--    </div>-->
                    <!--</div>-->
                    
<div class="row" id="reject-description-row" style="display: none;">
                        <div class="col-md-12 mb-3">
                            <label for="reject-description-field" class="form-label">Leave Rejecter's Description</label>
                            <textarea id="reject-description-field" name="reject_description" class="form-control @error('reject_description') is-invalid @enderror" placeholder="Enter Reason for Rejection"></textarea>
                            @error('reject_description')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                         @php
$isAdmin = auth()->user()->is_admin === 'admin';
@endphp

@if (!$isAdmin)
    <input type="hidden" name="state" value="{{ old('state', $user->state) }}">
    <input type="hidden" name="district" value="{{ old('district', $user->district) }}">
    <input type="hidden" name="taluka" value="{{ old('taluka', $user->taluka) }}">
    <input type="hidden" name="designation" value="{{ old('designation', $user->design_id) }}">
    <input type="hidden" name="department_name" value="{{ old('department_name', $user->depart_id) }}">
    <input type="hidden" name="organisation" value="{{ old('organisation', $user->org_id) }}">
@endif

 <div style="display: flex; justify-content: flex-end; gap: 10px;">
    <div class="hstack gap-2">
        <button type="submit" class="btn btn-success">submit</button>
    </div>

    <div class="hstack gap-2">
        <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('leaves.index')}}'">Back</button>
    </div>
</div>
                </form>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!-- listjs init -->
    <script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    
    
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      
      
      
      
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>

<script>
    document.getElementById('status-field').addEventListener('change', function() {
        var status = this.value;
        var rejectDescriptionRow = document.getElementById('reject-description-row');
        
        if (status === 'rejected') {
            rejectDescriptionRow.style.display = 'block';
        } else {
            rejectDescriptionRow.style.display = 'none'; 
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var startDateField = document.getElementById('apply-start-date-field');
        var endDateField = document.getElementById('apply-end-date-field');
        var leaveDaysField = document.getElementById('leave-days-field');

        function calculateLeaveDays() {
            var startDate = new Date(startDateField.value);
            var endDate = new Date(endDateField.value);

            // Ensure both dates are selected
            if (startDate && endDate && startDate <= endDate) {
                // Calculate the difference in milliseconds
                var timeDifference = endDate.getTime() - startDate.getTime();
                // Convert milliseconds to days
                var dayDifference = timeDifference / (1000 * 3600 * 24) + 1; // Adding 1 to include both start and end date
                leaveDaysField.value = dayDifference;
            } else {
                leaveDaysField.value = ''; // Clear if invalid dates
            }
        }

        // Add event listeners to recalculate leave days when dates change
        startDateField.addEventListener('change', calculateLeaveDays);
        endDateField.addEventListener('change', calculateLeaveDays);
    });
</script>

<script>
$(document).ready(function() {
    // Initialize select2 for better dropdown styling
    $('#state').select2({ placeholder: 'Select State', allowClear: true });
    $('#district').select2({ placeholder: 'Select District', allowClear: true });
    $('#taluka-field').select2({ placeholder: 'Select Taluka', allowClear: true });
    $('#designation').select2({ placeholder: 'Select Designation', allowClear: true });
    $('#department_name').select2({ placeholder: 'Select Department', allowClear: true });
    $('#organisation').select2({ placeholder: 'Select Organization', allowClear: true });

    // Set initial values using user details
    var initialState = '{{ old('state', $user->state) }}';
    var initialDistrict = '{{ old('district', $user->district) }}';
    var initialTaluka = '{{ old('taluka', $user->taluka) }}';
    var initialDesignation = '{{ old('designation', $user->design_id) }}';
    var initialDepartment = '{{ old('department_name', $user->depart_id) }}';
    var initialOrganisation = '{{ old('organisation', $user->org_id) }}';

    // Initialize dropdowns with initial values
    $('#state').val(initialState).trigger('change');
    $('#district').val(initialDistrict).trigger('change');
    $('#taluka-field').val(initialTaluka).trigger('change');
    $('#designation').val(initialDesignation).trigger('change');
    $('#department_name').val(initialDepartment).trigger('change');
    $('#organisation').val(initialOrganisation).trigger('change');
        var isAdmin = {{ auth()->user()->is_admin === 'admin' ? 'true' : 'false' }};
        if (!isAdmin) {
            
        $('#state, #district, #taluka-field, #designation, #department_name, #organisation').each(function() {
            $(this).select2('enable', false); 
            $(this).css({
                'pointer-events': 'none', 
                'background-color': '#f5f5f5',
                'color': '#999'
            });
        });
    }



    function loadDropdowns() {
        loadInitialDistricts();
        loadInitialTalukas();
        loadOrganisations();
        loadDepartments();
        loadDesignations();
    }

    function loadInitialDistricts() {
        var state = $('#state').val();
        if (state) {
            var statesData = @json($statesData['states']);
            var selectedState = statesData.find(item => item.state === state);
            var districtDropdown = $('#district');

            districtDropdown.empty().append('<option value="">Select District</option>');

            if (selectedState) {
                selectedState.districts.forEach(district => {
                    districtDropdown.append($('<option>', { value: district, text: district }));
                });
                // Set selected value to the initial district
                districtDropdown.val(initialDistrict).trigger('change');
            }
        }
    }

    function loadInitialTalukas() {
        var state = $('#state').val();
        var district = $('#district').val();
        if (state && district) {
            $.ajax({
                url: '{{ route('tehsils.get') }}',
                type: 'GET',
                data: { state: state, district: district },
                success: function(response) {
                    var talukaDropdown = $('#taluka-field');
                    talukaDropdown.empty().append('<option value="">Select Taluka</option>');
                    response.forEach(taluka => {
                        talukaDropdown.append($('<option>', { value: taluka, text: taluka }));
                    });
                    // Set selected value to the initial taluka
                    talukaDropdown.val(initialTaluka).trigger('change');
                },
                error: function(xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
        } else {
            $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
        }
    }

    function loadOrganisations() {
        var state = $('#state').val() || initialState; // Use selected state or initial
        var district = $('#district').val() || initialDistrict; // Use selected district or initial
        var organisationDropdown = $('#organisation');


        organisationDropdown.empty().append('<option value="">Select Organisation</option>');

        if (state && district) {
            $.ajax({
                url: '{{ route('organisations.get') }}',
                type: 'GET',
                data: { state: state, district: district },
                success: function(response) {
                    response.forEach(org => {
                        if (!organisationDropdown.find('option[value="' + org.id + '"]').length) { // Prevent duplicates
                            organisationDropdown.append($('<option>', { value: org.id, text: org.org_name }));
                        }
                    });
                    // Set selected value to the initial organisation
                    organisationDropdown.val(initialOrganisation).trigger('change');
                },
                error: function(xhr) {
                    console.error('Error fetching organisations:', xhr.responseText);
                }
            });
        }
    }

    function loadDepartments() {
        var state = $('#state').val();
        var district = $('#district').val();
        var organisation = $('#organisation').val();
        var departmentDropdown = $('#department_name');

        departmentDropdown.empty().append('<option value="">Select Department</option>');

        if (state && district && organisation) {
            $.ajax({
                url: '{{ route('departments.get') }}',
                type: 'GET',
                data: { state: state, district: district, organisation: organisation },
                success: function(response) {
                    response.forEach(dept => {
                        if (!departmentDropdown.find('option[value="' + dept.id + '"]').length) { // Prevent duplicates
                            departmentDropdown.append($('<option>', { value: dept.id, text: dept.name }));
                        }
                    });
                    // Set selected value to the initial department
                    departmentDropdown.val(initialDepartment).trigger('change');
                },
                error: function(xhr) {
                    console.error('Error fetching departments:', xhr.responseText);
                }
            });
        }
    }

    function loadDesignations() {
        var department = $('#department_name').val();
        var taluka = $('#taluka-field').val();
        var organisation = $('#organisation').val();
        var designationDropdown = $('#designation');

        designationDropdown.empty().append('<option value="">-- Select Designation --</option>');

        if (taluka && organisation) {
            $.ajax({
                url: '{{ route('designations.getByTaluka') }}',
                type: 'GET',
                data: { taluka_id: taluka, organisation_id: organisation },
                success: function(response) {
                    response.forEach(designation => {
                        if (!designationDropdown.find('option[value="' + designation.id + '"]').length) { // Prevent duplicates
                            designationDropdown.append($('<option>', { value: designation.id, text: designation.designation_name }));
                        }
                    });
                    // Set selected value to the initial designation
                    designationDropdown.val(initialDesignation).trigger('change');
                },
                error: function(xhr) {
                    console.error('Error fetching designations by taluka:', xhr.responseText);
                }
            });
        } else if (department) {
            $.ajax({
                url: '{{ route('designations.get') }}',
                type: 'GET',
                data: { department_id: department },
                success: function(response) {
                    response.forEach(designation => {
                        if (!designationDropdown.find('option[value="' + designation.id + '"]').length) { // Prevent duplicates
                            designationDropdown.append($('<option>', { value: designation.id, text: designation.designation_name }));
                        }
                    });
                    // Set selected value to the initial designation
                    designationDropdown.val(initialDesignation).trigger('change');
                },
                error: function(xhr) {
                    console.error('Error fetching designations:', xhr.responseText);
                }
            });
        }
    }
    
function fetchProfileName() {
    var designation = $('#designation').val(); 
    if (designation) {
        $.ajax({
            url: '{{ route('fetch.profiles') }}',  // Ensure this route returns profiles based on designation
            type: 'GET',
            data: { designation: designation },
            success: function(response) {
                var profileDropdown = $('#name'); // The profile dropdown
                profileDropdown.empty().append('<option value="">Select Profile Name</option>');

                response.forEach(function(user) {
                    profileDropdown.append($('<option>', {
                        value: user.id,
                        text: `${user.first_name} ${user.last_name}`
                    }));
                });

                // Set the selected profile based on old value
                var selectedProfile = '{{ old('name', $user->profile_id ?? '') }}'; // Get the old value or the existing profile id
                profileDropdown.val(selectedProfile); // Set the old or pre-filled value
            },
            error: function(xhr) {
                console.error('Error fetching profiles:', xhr.responseText);
            }
        });
    } else {
        $('#name').empty().append('<option value="">Select Profile Name</option>'); // Reset if no designation is selected
    }
}

    // Attach change handlers to reload dependent dropdowns
    $('#state').change(function() {
        loadInitialDistricts();
        loadOrganisations();
    });

    $('#district').change(function() {
        loadInitialTalukas();
        loadOrganisations();
                    $('#designation').empty().append('<option value="">-- Select Designation --</option>');

    });

    $('#organisation').change(function() {
        loadDepartments();
    });

    $('#department_name, #taluka-field, #organisation').change(function() {
        loadDesignations();
    });
    
     $('#designation').change(function() {
        fetchProfileName();
    });

    // Initialize dropdowns on page load
    loadDropdowns();
});
</script>

    
   <script>
$(document).ready(function() {
    // Handle profile name change
    $('#name').change(function() {
        var profileId = $(this).val();
        console.log(profileId);  // Log profileId to check if it's selected

        if (profileId) {
            $.ajax({
                url: '/get-user-details/' + profileId,  // URL to fetch user details
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        console.log(data);  // Log the fetched data
                        $('#available_leave_field').val(data.available_leave);  // Set available leaves field
                    } else {
                        alert('User details not found!');
                    }
                },
                error: function() {
                    alert('Failed to fetch user details. Please try again.');
                }
            });
        }
    });
});
</script>
 
    
    
    
    
    
    
    
    
    
@endsection
