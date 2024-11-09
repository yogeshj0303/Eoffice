@extends('layouts.master')
@section('title')
    @lang('translation.list-js')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" type="text/css" />

<style>
    #merged_amount:disabled {
    background-color: white;
    color: #000; 
    opacity: 1;  
}
#direct_total_salary:disabled{
     background-color: white;
    color: #000; 
    opacity: 1;    
}
#direct_added_amount:disabled{
     background-color: white;
    color: #000; 
    opacity: 1;    
}


</style>


@endsection
@section('content')

<div class="row">
     @php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



$userId = Auth::user()->id;

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
                <h4 class="card-title mb-0">Add Salary </h4>
            </div><!-- end card header -->

            <div class="card-body">
                <!-- Your existing form container -->
               <form class="leave-form" autocomplete="off" action="{{ route('storesalary') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select id="state" name="state" class="form-control" >
                                <option value="">Select State</option>
                                @foreach($statesData['states'] as $state)
                <option value="{{ $state['state'] }}">
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
                            <select id="organisation" name="org_id" class="form-select mb-3" >
                                <option value="">Select organization</option>
                            </select>
                             @error('org_id')
        <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                      

                                           </div>
                                           
                                           
                                           
                                           
                                <div class="row">
    <div class="col-md-4">
        <label for="department_name" class="form-label">Select Department</label>
        <select name="depart_id" id="department_name" class="form-select mb-3">
            <option value="">-- Select Department --</option>
        </select>
        @error('depart_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="taluka-field" class="form-label">Taluka</label>
        <select id="taluka-field" name="taluka" class="form-select mb-3">
            <option value="">Select Taluka</option>
            <!-- Talukas will be loaded here -->
        </select>
        @error('taluka')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="designation" class="form-label">Select Designation</label>
        <select name="design_id" id="designation" class="form-select mb-3">
            <option value="">-- Select Designation --</option>
        </select>
        @error('design_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div> <!-- Closing row div -->


                    <!-- Profile Name, Caste -->
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Profile Name</label>
<select id="name" name="user_id" class="form-control @error('user_id') is-invalid @enderror" onchange="checkGenderAndAlert()">
                                <option value="">Select Profile Name</option>
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                   
   <div class="col-md-4">
    <label for="joining_date" class="form-label">Job Joining Date</label>
    <input type="text" id="joining_date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror" readonly>
    @error('joining_date')
        <div class="invalid-feedback text-red">{{ $message }}</div>
    @enderror
</div>


    <div class="col-md-4">
        <label for="caste" class="form-label">Caste</label>
<input type="text" id="caste" name="caste" class="form-control @error('caste') is-invalid @enderror" placeholder="Enter Caste" readonly>

        @error('cast')
            <div class="invalid-feedback text-red">{{ $message }}</div>
        @enderror
    </div>
</div>
<!---->
<div class="row mb-3">
    <div class="col-md-4">
        <label for="last_approved_salary" class="form-label">Last Approved Salary</label>
        <input type="number" id="last_approved_salary" name="last_salary" class="form-control @error('last_salary') is-invalid @enderror" placeholder="Enter Last Approved Salary" readonly>
        @error('last_salary')
            <div class="invalid-feedback text-red">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 position-relative">
        <label for="slap_amount" class="form-label">Slap Amount</label>
        <select id="slap_amount" name="" class="form-control @error('slap_amount') is-invalid @enderror">
            <option value="">Select Slap Amount</option>
       @foreach($slapAmounts as $slapAmount)
        <option value="{{ $slapAmount->id }}">{{ $slapAmount->slap_amount }}</option>
    @endforeach
     </select>
             <input type="hidden" id="hidden_slap_amount" name="slap_amount" value="">

        <i class="fas fa-chevron-down position-absolute" style="right: 10px; top: 40%; transform: translateY(-50%);"></i>
        @error('slap_amount')
            <div class="invalid-feedback text-red">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 position-relative">
        <label for="grade_amount" class="form-label">Grade Amount</label>
        <select id="grade_amount" name="" class="form-control @error('grade_amount') is-invalid @enderror">
    <option value="">Select Grade Amount</option>

        </select>
        <i class="fas fa-chevron-down position-absolute" style="right: 10px; top: 40%; transform: translateY(-50%);"></i>
        @error('grade_amount')
            <div class="invalid-feedback text-red">{{ $message }}</div>
        @enderror
    </div>
        <input type="hidden" id="hidden_grade_amount" name="grade_amount" value="">

</div>

<!---->
<div class="row mb-3">
    <div class="col-md-4 position-relative">
        <label for="direct_added_amount" class="form-label">Direct Add Salary</label>
<input type="text" id="direct_added_amount" name="direct_added_amount" class="form-control @error('direct_added_amount') is-invalid @enderror" placeholder="Enter Direct Added Amount"  / readonly>
        <i class="fas fa-chevron-down position-absolute" style="right: 10px; top: 40%; transform: translateY(-50%);"></i>
        @error('direct_added_amount')
            <div class="invalid-feedback text-red">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 position-relative">
    <label for="merged_amount" class="form-label">Merged Amount</label>
    <input type="text" id="merged_amount" name="merge_amount" class="form-control @error('merged_amount') is-invalid @enderror" placeholder="Enter Merged Amount" readonly />
    <i class="fas fa-chevron-down position-absolute" style="right: 10px; top: 40%; transform: translateY(-50%);"></i>
    @error('merged_amount')
        <div class="invalid-feedback text-red">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-4 position-relative">
    <label for="direct_total_salary" class="form-label">Direct Add Total Salary</label>
    <input type="text" id="direct_total_salary" name="direct_total_salary" class="form-control @error('direct_total_salary') is-invalid @enderror" placeholder="Enter Direct Total Salary" readonly />
    <i class="fas fa-chevron-down position-absolute" style="right: 10px; top: 40%; transform: translateY(-50%);"></i>
    @error('direct_total_salary')
        <div class="invalid-feedback text-red">{{ $message }}</div>
    @enderror
</div>



<div class="col-md-4 position-relative">
    <label for="label" class="form-label">Level</label>
    <input type="text" id="label" name="label" class="form-control @error('label') is-invalid @enderror" placeholder="Enter Level" readonly data-id="" />
 <i class="fas fa-chevron-down position-absolute" style="right: 10px; top: 40%; transform: translateY(-50%);"></i>
    @error('label')
        <div class="invalid-feedback text-red">{{ $message }}</div>
    @enderror
</div>


  <div class="col-md-4">
    <label for="salary_amount" class="form-label">Salary Amount</label>
    <select id="salary_amount" name="" class="form-control @error('salary_amount') is-invalid @enderror">
        <option value="">Select Salary Amount</option>
        <!-- Option values will be dynamically added here -->
    </select>
        <input type="hidden" id="hidden_salary_amount" name="salary_amount" value="">

    @error('salary_amount')
        <div class="invalid-feedback text-red">{{ $message }}</div>
    @enderror
</div>

</div>

<div class="row mb-3">
    <div class="col-md-4 position-relative">
        <label for="reference_document" class="form-label">Add Reference Document (PDF)</label>
        <input type="file" id="reference_document" name="reference_document" class="form-control @error('reference_document') is-invalid @enderror" accept=".pdf">
        @error('reference_document')
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
    <a href="javascript:history.back()" class="btn btn-primary">Back</a>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
$(document).ready(function() {
    
    $('#label').on('input', function() {
        var labelId = $(this).data('id'); // Get the value from data-id attribute
        console.log('Captured labelId:', labelId); // Log the labelId after capturing it
        if (labelId) {
            loadSalaryAmount(labelId);
        } else {
            console.warn('labelId is empty or undefined.');
        }
    });

    var initialLabelId = $('#label').data('id');
    console.log('Initial labelId on page load:', initialLabelId);
    if (initialLabelId) {
        loadSalaryAmount(initialLabelId);
    }
});
</script>



<script>

    $(document).ready(function() {
        $('#grade_amount').change(function() {
            var gradeId = $(this).val();
            $('#merged_amount').val('').prop('disabled', true);
            
            if (gradeId) {
                $.ajax({
                    url: '{{ url("salary/get-merge-amount") }}/' + gradeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); // Log the returned data
if (data.length > 0) {
    $('#merged_amount').val(data[0]);
    $('#merged_amount').prop('disabled', false);
    $('#merged_amount').attr('placeholder', '');
} else {
    $('#merged_amount').val('');
    $('#merged_amount').prop('disabled', true);
    $('#merged_amount').attr('placeholder', '- -');
}
                    },
                    error: function() {
                        console.error('Could not fetch data.');
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
    // Handle Salary Amount Change
    $('#salary_amount').change(function() {
        var salaryAmountText = $('#salary_amount option:selected').text(); // Get the actual salary_amount text

        // Store the actual salary_amount value in the hidden input
        $('#hidden_salary_amount').val(salaryAmountText);
    });
});

</script>
<script>
$(document).ready(function() {
    function loadSalaryAmount(labelId) {
        console.log('Function loadSalaryAmount called with labelId:', labelId);
        $('#salary_amount').empty().append('<option value="">Select Salary Amount</option>').prop('disabled', true);

        if (labelId) {
            console.log('Making AJAX request for labelId:', labelId);
            $.ajax({
                url: '{{ url("salary/get-gradesalary") }}/' + labelId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log('Data received:', data);
                    $.each(data, function(index, salary_amount) {
                        $('#salary_amount').append('<option value="' + index + '">' + salary_amount + '</option>');
                    });
                    $('#salary_amount').prop('disabled', false);
                },
                error: function() {
                    console.error('Could not fetch salary data.');
                }
            });
        } else {
            console.warn('No labelId provided.');
        }
    }

    $('#grade_amount').change(function() {
        var gradeId = $(this).val();
        $('#label').val('').prop('disabled', true); // Clear input and disable it initially
        
        if (gradeId) {
            $.ajax({
                url: '{{ url("salary/get-label") }}/' + gradeId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data); // Log the returned data
                    if (data.length > 0) { // Check if data array has elements
                        $('#label').val(data[0].label); // Set the value of the input field
                        $('#label').prop('disabled', false); // Enable the input field
                        loadSalaryAmount(data[0].id); // Call to load salary based on the first label's id
                    } else {
                        $('#label').val('').prop('disabled', true); // Reset input if no valid data
                    }
                },
                error: function() {
                    console.error('Could not fetch data for label.');
                }
            });
        } else {
            $('#label').val('').prop('disabled', true); // Reset input if no gradeId
        }
    });
});
</script>


<script>
    $(document).ready(function() {
        $('#grade_amount').change(function() {
            var gradeId = $(this).val();
            $('#direct_total_salary').val('').prop('disabled', true); // Clear input and disable it initially
            
            if (gradeId) {
                $.ajax({
                    url: '{{ url("salary/get-total-amount") }}/' + gradeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); // Log the returned data
if (data.length > 0) {
    $('#direct_total_salary').val(data[0]);
    $('#direct_total_salary').prop('disabled', false);
    $('#direct_total_salary').attr('placeholder', '');
} else {
    $('#direct_total_salary').val('');
    $('#direct_total_salary').prop('disabled', true);
    $('#direct_total_salary').attr('placeholder', '- -');
}
                    },
                    error: function() {
                        console.error('Could not fetch data.');
                    }
                });
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#grade_amount').change(function() {
            var gradeId = $(this).val();
            $('#direct_added_amount').val('').prop('disabled', true); // Clear input and disable it initially
            
            if (gradeId) {
                $.ajax({
                    url: '{{ url("salary/get-salary-amount") }}/' + gradeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); // Log the returned data
                        if (data.length > 0) {
                            // Assuming data is an array, set the first salary amount to the input
                            $('#direct_added_amount').val(data[0]); // Set the value of the input field
                            $('#direct_added_amount').prop('disabled', false); // Enable the input field
                                $('#direct_added_amount').attr('placeholder', '');

                        } else {
                            $('#direct_added_amount').val('').prop('disabled', true); // Reset input if no data
                              $('#direct_added_amount').prop('disabled', true);
    $('#direct_added_amount').attr('placeholder', '- -');
                        }
                    },
                    error: function() {
                        console.error('Could not fetch data.');
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#slap_amount').change(function() {
            var slapId = $(this).val();
                    var slapAmountText = $('#slap_amount option:selected').text(); // Get the actual slap_amount text

        $('#hidden_slap_amount').val(slapAmountText);

            $('#grade_amount').empty().append('<option value="">Select Grade Amount</option>').prop('disabled', true);
            
            if (slapId) {
                $.ajax({
                    url: '{{ url("salary/get-grade-amounts") }}/' + slapId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $.each(data, function(id, grade_amount) { // Accessing key as id and value as grade_amount
                            $('#grade_amount').append('<option value="' + id + '">' + grade_amount + '</option>');
                        });
                        $('#grade_amount').prop('disabled', false);
                    },
                    error: function() {
                        console.error('Could not fetch data.');
                    }
                });
            }
        });
    });
    
    
        $('#grade_amount').change(function() {
        var gradeId = $(this).val();
        var gradeAmountText = $('#grade_amount option:selected').text(); // Get the actual grade amount text

        // Store the actual grade_amount in the hidden field
        $('#hidden_grade_amount').val(gradeAmountText);
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

   var initialState = '{{ old('state', $user->state) ?? '' }}';
var initialDistrict = '{{ old('district', $user->district) ?? '' }}';
var initialTaluka = '{{ old('taluka', $user->taluka) ?? '' }}';
var initialDesignation = '{{ old('designation', $user->design_id) ?? '' }}';
var initialDepartment = '{{ old('department_name', $user->depart_id) ?? '' }}';
var initialOrganisation = '{{ old('organisation', $user->org_id) ?? '' }}';

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


    $('#state').val(initialState).trigger('change');
    $('#district').val(initialDistrict).trigger('change');
    $('#taluka-field').val(initialTaluka).trigger('change');
    $('#designation').val(initialDesignation).trigger('change');
    $('#department_name').val(initialDepartment).trigger('change');
    $('#organisation').val(initialOrganisation).trigger('change');

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
                    console.log(response);
                    var profileDropdown = $('#name'); // The profile dropdown
                    profileDropdown.empty().append('<option value="">Select Profile Name</option>');

                    response.forEach(function(user) {
                        profileDropdown.append($('<option>', {
                            value: user.id,
                            text: `${user.first_name} ${user.last_name}`,
        'data-gender': user.gender,
                                'data-caste': user.caste, // Add caste data
                        'data-joining-date': user.joining_date,

                'data-joining_start_salary': user.joining_start_salary

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
    $('#name').on('change', function() {
    var selectedOption = $(this).find(':selected');

    var caste = selectedOption.data('caste') || ''; // Default to empty if not present
    console.log(caste);
    var joiningDate = selectedOption.data('joining-date') || ''; 
        var lastSalary = selectedOption.data('joining_start_salary') || ''; 
           console.log(lastSalary);

    console.log(joiningDate);

    $('#caste').val(caste); // Set the selected caste value
    $('#joining_date').val(joiningDate); // Set the selected joining date value
        $('#last_approved_salary').val(lastSalary); // Set the selected joining date value

});
    

    // Check gender and alert if the profile cannot be updated
    
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


    
@endsection
