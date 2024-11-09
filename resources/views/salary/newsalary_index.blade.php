@extends('layouts.master')
@section('title')
    @lang('translation.list-js')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th, .table td {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 10px;
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
                        width: 20%;

        }


    table.dataTable tbody tr {
        background-color: transparent !important;
    }

.table-responsive {
    overflow-x: auto; /* Enable horizontal scrolling */
}

.table {
    width: 100%; /* Ensure table takes full width */
}

.table th, .table td {
    white-space: nowrap; /* Prevent text from wrapping */
}

        @media (prefers-color-scheme: dark) {
            .table th {
                background-color: #1c1e21;
                color: #e1e1e1;
            }

            .table td {
                color: #d1d1d1;
            }
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table tbody tr:last-child td {
            border-bottom: none; 
        }

        /* Make the table scrollable on smaller screens */
        @media screen and (max-width: 768px) {
            .table-responsive {
                display: block;
                overflow-x: auto;
            }
        }

        .dataTables_wrapper {
            overflow-x: auto;
        }
        
        
        .table-nowrap td .sorting, .table-nowrap td .sorting_asc, .table-nowrap td .sorting_desc {
    display: none; 
}


     table.dataTable>thead .sorting:after, table.dataTable>thead .sorting_asc:after, table.dataTable>thead .sorting_desc:after, table.dataTable>thead .sorting_asc_disabled:after, table.dataTable>thead .sorting_desc_disabled:after{
    
     content:"" !important;
    
    
}


table.dataTable>thead .sorting:before, table.dataTable>thead .sorting_asc:before, table.dataTable>thead .sorting_desc:before, table.dataTable>thead .sorting_asc_disabled:before, table.dataTable>thead .sorting_desc_disabled:before{
    
    
    content:"" !important;
}

    </style>
@endsection
@section('content')
      
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0"> Salary Details</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                            @if((isset($permissions)) && (($permissions['salary_create'] == 2)))
                            <button type="button" class="btn btn-success add-btn" onclick="window.location.href='{{ route('newsalaryadd') }}'">
                                Add Salary
                            </button>
                            @endif
                            <button type="button" class="btn btn-warning " onclick="window.location.href='{{ route('salary.pending') }}'">
                                Request
                            </button>
                            <a href="{{route('salary-history')}}" > <button class="btn  btn-primary ">
                                            History
                                        </button></a>
                           
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="designationsTable">
        <thead class="table-light">
            <tr>
                                                                    <th>ID</th>

                                    <th>User Name</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Taluka</th>
                                    <th>Organization Name</th>
                                    <th>Department Name</th>
                                    <th>Designation Name</th>
                                    <th>Caste</th>
                                    <th>Joining Date</th>
                                      <th>Slap Amount</th>
                                     <th>Grade Amount</th>
                                                                          <th>Merge Amount</th>
                                     <th>Direct Add Salary</th>

                                      <th>Direct Add Total Salary </th>
                                    <th>Last Approved Salary</th>
                                                                        <th>Level</th>
                                    <th>Salary Amount</th>
                                                                        <th>Document</th>


                                    @if((isset($permissions)) && (($permissions['salary_view'] == 2) ||($permissions['salary_edit'] == 2) || 
                                        ($permissions['salary_delete'] == 2)))
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                                                                                                    @php $sno = 1; @endphp 

                            <tbody class="form-check-all">
                                   @if((isset($permissions)) && (($permissions['salary_view'] == 2) ||($permissions['salary_edit'] == 2) || ($permissions['salary_delete'] == 2)))
                                @foreach ($salaries as $salary)
                               
                                <tr id="userRow{{ $salary->id }}">
                                                                         <td>{{ $salary->id }}</td>

                                    <td>{{ $salary->first_name }}</td>
                                    <td>{{ $salary->state }}</td>
                                    <td>{{ $salary->district }}</td>
                                    <td>{{ $salary->taluka }}</td>
                                    <td>{{ $salary->org_name }}</td>
                                    <td>{{ $salary->department_name }}</td>
                                    <td>{{ $salary->designation_name }}</td>
                                                <td>{{ $salary->caste }}</td>
            <td>{{ $salary->joining_date }}</td>
            <td>{{ $salary->slap_amount }}</td>
            <td>{{ $salary->grade_amount }}</td>
         <td>{{ $salary->merge_amount ?? 'N/A' }}</td>

<td>{{ $salary->direct_added_amount ?? 'N/A' }}</td>

<td>{{ $salary->direct_total_salary ?? 'N/A' }}</td>

            <td>{{ $salary->last_salary }}</td>
            <td>{{ $salary->label }}</td>
            <td>{{ $salary->salary_amount }}</td>
            <td>
                @if ($salary->reference_document)
                    <a href="{{ asset('uploads/' . $salary->reference_document) }}" target="_blank">View Document</a>
                @else
                    No Document
                @endif
            </td>

                                 
                                @endforeach
                                @endif
                            </tbody>

    </table>

                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <!-- end row -->

    <!-- Modal for Add Leave -->
    <!-- Modal for Edit Leave -->
<!-- Modal for Edit Leave -->


    <!-- Modal for Delete Confirmation -->
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

     <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

   <script>
    $(document).ready(function() {
        var table = $('#customerTable').DataTable({
            scrollY: '400px', 
            scrollX: true, 
            scrollCollapse: true,
            paging: true,
            searching: false,
            lengthMenu: [10, 25, 50, 100],
            responsive: true,
                        dom: 'tp',

                                  "order": [[0, 'desc']], 

        });


            });
</script>

<!-- Description Modal -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel"> Reject Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalDescription">
                <!-- Description will be populated here -->
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('.view-description');
    const modalDescription = document.getElementById('modalDescription');

    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const description = this.getAttribute('data-description');
            modalDescription.textContent = description;
        });
    });
});

</script>


      <script>
$(document).ready(function() {
    $('.remove-item-btn').click(function() {
        var id = $(this).data('id');
        var action = '/checklist-new/' + id; 
        $('#deleteForm').attr('action', action);
    });

    // Handle the form submission
    $('#deleteForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        var form = $(this);
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize() + '&_method=DELETE', // Add the DELETE method
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include the CSRF token
            },
            success: function(response) {
                if (response.success) {
                    $('#deleteRecordModal').modal('hide');
                    $('#checklistRow' + response.id).remove(); // Remove the deleted row
                    Swal.fire('Deleted!', 'The record has been deleted.', 'success');
                } else {
                    Swal.fire('Failed!', 'An error occurred while trying to delete the record.', 'error');
                }
            },
            error: function(response) {
                Swal.fire('Error!', 'An error occurred while trying to delete the record.', 'error');
            }
        });
    });
});



</script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
