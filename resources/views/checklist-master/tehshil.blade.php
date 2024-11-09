@extends('layouts.master')
@section('title') Tehshils @endsection




@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


@endsection

@section('content')
                        <?php



?>
<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Tehsil</h4>
               <a href="{{route('tehsil.history')}}"><button class="btn btn-sm btn-primary ">
                                                History
                                            </button></a> 
                                            
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="designationsTable">
                            <thead>
                                <tr>
                                    <th>S. No</th>
                                    <th>State Name</th>
                                    <th>District Name</th>
                                    <th>Tehsil Name</th>
                                      @if((isset($permissions)) && (($permissions['tehsils_delete'] == 2)))
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if((isset($permissions)) && (($permissions['tehsils_view'] == 2) || 
                                 ($permissions['tehsils_delete'] == 2)))
                                @foreach($tehshil as $key => $teh)
                                    <tr id="tehsilRow{{ $teh->id }}">
    <td>{{ $teh->id }}</td>
                                        <td>{{ $teh->state_name }}</td>
                                        <td>{{ $teh->district_name }}</td>
                                        <td>{{ $teh->th_name }}</td>
                                        @if((isset($permissions)) && ( ($permissions['tehsils_delete'] == 2)) || (isset($permissions)) && ( ($permissions['tehsils_edit'] == 2)))
                                        <td>
                                             @if( (isset($permissions)) && ( ($permissions['tehsils_edit'] == 2)))
                                      
                                            <a href="{{route('tehsil.edit',$teh->id)}}"> <button class="btn btn-sm btn-primary remove-item-btn"  data-id="{{ $teh->id }}">
                                                Edit
                                            </button></a>
                                            @endif
                                                @if( (isset($permissions)) && ( ($permissions['tehsils_delete'] == 2)))
                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-id="{{ $teh->id }}">
                                                Remove
                                            </button>
                                            @endif
                                            
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        
                                             @if($tehshil->isNotEmpty())
                    <div class="d-flex justify-content-center">
                        {!! $tehshil->links() !!}
                    </div>
                    @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@if((isset($permissions)) && ( ($permissions['tehsils_create'] == 2)))
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Add Tehsil</h4>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <form action="{{ route('store-tehshil') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-12">
                            <input type="hidden" name="owner_id" value="{{Auth::user()->id}}" >
                            <label for="state" class="form-label">State Name</label>
                            <select id="state" name="state" class="form-select mb-3" required>
                                <option value="">Select state</option>
                                @foreach($statesData['states'] as $state)
                                    <option value="{{ $state['state'] }}">{{ $state['state'] }}</option>
                                @endforeach
                            </select>
                            @error('state')
                                <div class="invalid-feedback" style="color: red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="district" class="form-label">District Name</label>
                            <select id="district" name="dist" class="form-select mb-3" required>
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="tehshil_name" class="form-label">Tehsil Name</label>
                            <input type="text" name="tehshil_name" class="form-control @error('tehshil_name') is-invalid @enderror" id="tehshil_name" placeholder="Enter tehsil name">
                            @error('tehshil_name')
                                <div class="invalid-feedback" style="color: red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Modal for Deleting Record -->
<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body text-center">
                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                    <h4>Are you Sure?</h4>
                    <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record?</p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-light">Yes, delete it</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!-- listjs init -->
    <script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
          
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>


        
        
<script>
    $(document).ready(function() {
        $('#district').select2({
            placeholder: 'Select District',
            allowClear: true
        });
    });
    
    
    
     $(document).ready(function() {
        $('#state').select2({
            placeholder: 'Select state',
            allowClear: true
        });
    });
    

</script>

<script>
    
    
    
    
        $(document).ready(function() {
            // Handle state selection change
            $('#state').change(function() {
                var state = $(this).val();
                var statesData = @json($statesData['states']); // Pass states data to JavaScript

                var districtDropdown = $('#district');
                districtDropdown.empty().append('<option value="">Select District</option>'); // Clear existing options

                var selectedState = statesData.find(function(item) {
                    return item.state === state;
                });

                if (selectedState) {
                    selectedState.districts.forEach(function(district) {
                        districtDropdown.append($('<option>', {
                            value: district,
                            text: district
                        }));
                    });
                }

                $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
                $('#name').empty().append('<option value="">Select Profile Name</option>'); // Clear existing options
            });

            // Handle district selection change
            $('#district').change(function() {
                var state = $('#state').val();
                var district = $(this).val();

                if (state && district) {
                    $.ajax({
                        url: '{{ route('tehsils.get') }}', // Ensure this matches your route
                        type: 'GET',
                        data: { state: state, district: district },
                        success: function(response) {
                            var talukaDropdown = $('#taluka-field');
                            talukaDropdown.empty().append('<option value="">Select Taluka</option>'); 

                            response.forEach(function(taluka) {
                                talukaDropdown.append($('<option>', {
                                    value: taluka,
                                    text: taluka
                                }));
                            });
                        },
                        error: function(xhr) {
                            console.error('Error fetching talukas:', xhr.responseText);
                        }
                        
                        
                    });
                
                    
                    
                    
                }
                
                
                
                
                
                
                        
                
                
            });

            // Handle taluka selection change
            $('#taluka-field').change(function() {
                var state = $('#state').val();
                var district = $('#district').val();
                var taluka = $(this).val(); 

                if (state && district && taluka) {
                    $.ajax({
                        url: '{{ route('fetch.profiles') }}',
                        type: 'GET',
                        data: { state: state, district: district, taluka: taluka },
                        success: function(response) {
                            var profileDropdown = $('#name');
                            profileDropdown.empty().append('<option value="">Select Profile Name</option>');

                            response.forEach(function(user) {
                                profileDropdown.append($('<option>', {
                                    value: user.id,
                                    text: `${user.first_name} ${user.last_name}`
                                }));
                            });
                        },
                        error: function(xhr) {
                            console.error('Error fetching profiles:', xhr.responseText);
                        }
                    });
                }
            });
        });
        
        
        
        
        
        
        
        
        
        
        $('#district').change(function() {
    var state = $('#state').val();
    var district = $(this).val();

    if (state && district) {
        // AJAX request to fetch organisations
        $.ajax({
            url: '{{ route('organisations.get') }}',
            type: 'GET',
            data: { state: state, district: district },
            success: function(response) {
                var organisationDropdown = $('#organisation');
                organisationDropdown.empty().append('<option value="">Select Organisation</option>');

                if (response.length === 0) {
                    console.warn('No organisations found for the selected district.');
                } else {
                    response.forEach(function(org) {
                        organisationDropdown.append($('<option>', {
                            value: org.id,
                            text: org.org_name
                        }));
                    });
                }
            },
            error: function(xhr) {
                console.error('Error fetching organisations:', xhr.responseText);
            }
        });
    } else {
        console.warn('State or district is missing.');
    }
});


        
        
        
        
        
</script>



<script>
    $(document).ready(function() {
    // Handle Remove Tehsil Modal and form submission
    $('.remove-item-btn').click(function() {
        var id = $(this).data('id');
        $('#deleteForm').attr('action', '/tehshil/' + id); // Update the form action to tehsils
    });

    // Handle Delete Tehsil Form Submission
    $('#deleteForm').submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var actionUrl = form.attr('action');
        var id = actionUrl.split('/').pop(); // Extract ID from URL

        $.ajax({
            url: actionUrl,
            type: 'DELETE',
            data: form.serialize(),
            success: function(response) {
                $('#tehsilRow' + id).remove(); // Updated to reflect tehsil row
                $('#deleteRecordModal').modal('hide');
                alert('Tehsil deleted successfully.');
            },
            error: function(response) {
                alert('An error occurred while trying to delete the tehsil.');
            }
        });
    });
});

</script>


<meta name="csrf-token" content="{{ csrf_token() }}">


@endsection