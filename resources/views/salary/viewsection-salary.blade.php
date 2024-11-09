@extends('layouts.master')
@section('title')
    @lang('translation.new-page-title')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <style>
    
      .button-container {
            display: flex;
            justify-content: center; /* Center the buttons horizontally */
            margin-top: 20px; /* Add space at the top of the button section */
        }

        .btn {
            margin: 0 10px; /* Space between the buttons */
        }
    .checkmark-container {
    position: relative;
    padding: 20px 50px;
    border-radius: 8px;
    max-width: 228px;
    margin: 0 auto;
    text-align: center;
    height: 100px; /* Adjust as per your image size */
}

.signed-info {
    position: absolute;
    top: 65%;
    left: 50%;
    transform: translate(-50%, -50%); /* Center the text over the image */
    font-size: 10px; /* Adjust text size */
    color: black;
    font-weight: bold;
    text-align: center;
    z-index: 1; /* Ensure text is above the image */
}

.checkmark {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 110px; /* Adjust size of the image */
    height: auto;
    z-index: 0; /* Image stays behind the text */
    opacity: 0.4; /* Lighten the checkmark to make text more visible */
}

    
        /*body {*/
        /*    font-family: Arial, sans-serif;*/
        /*    margin: 0;*/
        /*    padding: 0;*/
        /*    display: flex;*/
        /*    justify-content: center;*/
        /*    align-items: flex-start;*/
        /*    height: 100vh;*/
        /*    background-color: #f4f4f4;*/
        /*}*/

        /*.row {*/
        /*    display: flex !important;*/
        /*    width: 100% !important;*/
        /*    height: 90% !important;*/
        /*    background-color: white !important;*/
        /*    border: 1px solid #ccc !important;*/
        /*    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5) !important;*/
        /*    margin-top: 30px !important;*/
        /*}*/

        .ele-left-div {
            width: 50%;
            padding: 0px 1px;
            position: relative;
            border-right: 1px solid #ccc;
        }

        .ele-left-div button {
            padding: 2px 15px;
            border: none;
            background-color: #0056ac;
            color: white;
            font-size: 14px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 3px;
        }

        .ele-left-div button.remove {
            background-color: #d2d0d0;
        }

        .ele-watermark {
            position: absolute;
    left: 100px;
    font-size: 70px;
    color: rgba(0, 0, 0, 0.05);
    transform: rotate(-30deg);
    user-select: none;
    margin-top: 200px;
}
        

.ele-right-div {
    width: 50%;
    padding: 20px;
    display: flex;
    flex-direction: column;
    position: relative;
     overflow-y: auto; /* Scrollable form content */
    /*margin-bottom: 20px;*/
    overflow-x: hidden;
    height:600px;
}

.ele-form-section {
    flex-grow: 1; /* Makes the form content take up remaining space */
    overflow-y: auto; /* Scrollable form content */
    margin-bottom: 20px;
    overflow-x: hidden;
}



        .ele-right-div h3 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
        }

        .ele-form-section {
            margin-bottom: 20px;
           
        }

        .ele-form-section h4 {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ele-form-section h4 .radio {
            display: flex;
            align-items: center;
        }

        .ele-form-section h4 .radio label {
            margin-right: 10px;
             margin-top: 10px;
        }

        .ele-form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            margin-right: 10px;
            gap:5px;
        }

        .ele-form-row .form-group {
            /*width: 42% !important;*/
            margin: 0 10px;
        }

        .ele-form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .ele-form-group input {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .ele-form-group select{
            width: 107% !important;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .ele-right-div h3{
            /*background-color: #d2d0d0;*/
            color: #000;
            font-size: 12px;
            padding: 5px;
        }
        .ele-form-section h4{
            /*background-color: #d2d0d0;*/
            /*color: #000;*/
            font-size: 18px;
            padding: 5px;
        }
        #minDeptother{
            width: 500px !important;
        }
   .ele-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: white; /* Set the background color to white */
    padding: 10px;
    position: sticky; /* Keeps the footer visible at the bottom */
    bottom: 0;
    left: 0;
    width: 100%;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);
    z-index: 1000; /* Ensure the footer is above other content */
}

    .card-footer button{
        background-color: #0056ac;
        color: #fff;
        padding: 5px 15px;
        border: none;
        border-radius: 5px;
    }
    #fileInput {
            display: none;
        }
         .file-name {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
       
 
.elebtn{
    /*background-color:#FFF;*/
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.4);
      padding:5px;
display:flex;
      
}
.elesec1{
    border:1px solid #ddd;
    padding:10px;
     /*box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.4);*/
}
.live-preview {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.progress-container {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.progress-step-arrow {
    flex: 1; /* Allows the progress bar to take up available space */
    margin: 0 10px; /* Optional: Adds space between progress bars */
}

.progress-bar {
   margin:0 10px;
}
.progress-step-arrow {
    height: 1.78rem !important;
}
.progress-step-arrow .progress-bar:after {
    
     bottom: 5px !important; 
    
}
.progress-info .progress-bar {
   background-color: #70769b !important;
    color:#fff !important;
}
.progress-info .progress-bar:after {
    border-left-color:  #70769b  !important;
     color:#fff !important;
    
}
.progress-barr {
    display: flex;
    flex-direction: column;
    justify-content: center;
    font-size: .875rem;
    
}

.ql-toolbar.ql-snow{
    background-color:white;
}
.ql-editor {
    background-color:#ecffec;
}


#memo-editors .ql-editor {
    background-color:white;
}

.custom-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 105px; /* Adjust the width as needed */
    padding:0px;
    background-color: #fff; /* Button background color */
    color: black;
    border: 1px sloid black;
    /*border-radius: 5px;*/
    position: relative;
    text-align: center;
    margin:5px 10px;
    
}

.custom-btn i {
    font-size: 15px;
    margin-right: 5px; /* Space between icon and border */
    background: #3F51B5;
    /*padding:5px;*/
    color:#fff;
}

.custom-btn span {
    flex-grow: 1;
    text-align: center;
    /*border-left: 1px solid #000;  */
    padding-left: 5px;
   
}
/**/
       
    </style>


    </style>
@endsection

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">
                            <button type="button" class="btn btn-primary " style="margin: -49px 33px; " onclick="window.history.back()">
                                Back
                            </button>

<div class="row" style="display:flex; 
    border: 1px solid #ccc !important;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5) !important; margin-top:40px;">
 
    <div class="card" style=" width: 50%;
        padding: 0px 1px;
        position: relative;
        border-right: 1px solid #ccc;
           background-color:#white;
            overflow-y: auto;
              overflow-x: hidden;
    height: 600px;
        ">
<h3 class="latters-heading" style="margin-top: 20px;">Add Green-Note</h3>
<div class="row" id="greenNoteField" style="margin-top: 0px;">
    <div class="form-group col-md-12">
        <div id="memo-editor" class="memo-editor" contenteditable="true" 
             style="border: 1px solid #ccc; height: 200px; background-color: #cfd2cc; 
             overflow-y: auto; padding: 10px; overflow-x: hidden;">
        </div>
        <textarea id="memo" name="green_note_dis" style="display: none; background-color: #ecffec;"></textarea>
    </div>
</div>


<h3 class="latters-heading" style="margin-top: 50px;">Add Letters</h3>
<div class="row" id="greenNoteField" style="margin-top: 0px;">
    <div class="form-group col-md-12">
        <div id="memo-editors" class="memo-editors" contenteditable="true" 
             style="border: 1px solid #ccc; height: 250px; background-color: white !important; 
             overflow-y: auto; padding: 10px; overflow-x: hidden;">
        </div>
        <textarea id="memo" name="letters_dis" style="display: none; background-color: white;"></textarea>
    </div>
</div>



<!--<h3 class="latters-heading" style="margin-top: 15px; font-size:18px;" >Add Green-Note</h3>-->
<!--<div class="row" id="greenNoteField" style="margin-top: 0px;">-->
<!--    <div class="form-group col-md-12">-->
<!--        <div id="memo-editor" class="editor" contenteditable="true" -->
<!--             style="border: 1px solid #ccc; height: 250px; background-color: #ecffec;-->
<!--; -->
<!--             overflow-y: auto; padding: 10px; overflow-x: hidden;">-->
         
<!--        </div>-->
<!--        <textarea id="memo" name="green_note_dis" style="display: none; background-color: #ecffec;"></textarea>-->
<!--    </div>-->
<!--</div>-->
<!-- Add Letters Section with white background -->
<!--<h3 class="latters-heading" style="margin-top: 15px;font-size:18px;">Add Letters</h3>-->
<!--<div class="row" id="lettersField" style="margin-top: 0px;">-->
<!--    <div class="form-group col-md-12">-->
<!--        <div id="letters-editor" class="editor" contenteditable="true" -->
<!--             style="border: 1px solid #ccc; height: 250px; background-color: white !important; -->
<!--             overflow-y: auto; padding: 10px; overflow-x: hidden;">-->

<!--        </div>-->
<!--        <textarea id="letters-textarea" name="letters_dis" style="display: none; background-color: white;"></textarea>-->
<!--    </div>-->
<!--</div>-->



    </div>
    
    
    <!-- Right Div (Form Details) -->
    <div class="card" style="  width: 50%;
        padding: 20px;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow-y: auto;
        height:600px;">
        
        <h3 style="font-size: 17px;">
            <span><i class="fa-solid fa-book"></i> Salary Details</span>
        </h3>

         
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="state" class="form-label">State</label>
            <input type="text" id="state" name="state" class="form-control" value="{{ $salary->state }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="district" class="form-label">District</label>
            <input type="text" id="district" name="district" class="form-control" value="{{ $salary->district }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="organisation" class="form-label">Organization</label>
            <input type="text" id="organisation" name="organisation" class="form-control" value="{{ $salary->org_name }}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="department_name" class="form-label">Department</label>
            <input type="text" id="department_name" name="department_name" class="form-control" value="{{ $salary->name }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="taluka-field" class="form-label">Taluka</label>
            <input type="text" id="taluka-field" name="taluka" class="form-control" value="{{ $salary->taluka }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="designation" class="form-label">Designation</label>
            <input type="text" id="designation" name="designation" class="form-control" value="{{ $salary->designation_name }}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Profile Name</label>
            <input type="text" id="name" name="user_id" class="form-control" value="{{ $salary->first_name }}" readonly>
        </div>
        <div class="col-md-6">
            <label for="joining_date" class="form-label">Job Joining Date</label>
            <input type="date" id="joining_date" name="joining_date" class="form-control" value="{{ $salary->joining_date }}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="cast" class="form-label">Caste</label>
            <input type="text" id="cast" name="cast" class="form-control" value="{{ $salary->caste }}" readonly>
        </div>
        <div class="col-md-6">
            <label for="last_approved_salary" class="form-label">Last Approved Salary</label>
            <input type="text" id="last_approved_salary" name="last_approved_salary" class="form-control" value="{{ $salary->last_salary }}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="slap_amount" class="form-label">Slap Amount</label>
            <input type="text" id="slap_amount" name="slap_amount" class="form-control" value="{{ $salary->slap_amount }}" readonly>
        </div>
        <div class="col-md-6">
            <label for="grade_amount" class="form-label">Grade Amount</label>
            <input type="text" id="grade_amount" name="grade_amount" class="form-control" value="{{ $salary->grade_amount }}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="direct_added_amount" class="form-label">Direct Added Amount</label>
            <input type="text" id="direct_added_amount" name="direct_added_amount" class="form-control" value="{{ $salary->direct_added_amount }}" readonly>
        </div>
        <div class="col-md-6">
            <label for="label" class="form-label">Label</label>
            <input type="text" id="label" name="label" class="form-control" value="{{ $salary->label }}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="salary_amount" class="form-label">Salary Amount</label>
            <input type="text" id="salary_amount" name="salary_amount" class="form-control" value="{{ $salary->salary_amount }}" readonly>
        </div>
    </div>

  <div class="row mb-3">
    <div class="col-md-12">
        <label for="reference_document" class="form-label">Reference Document : </label>
        <a href="{{ $salary->reference_document ? asset('uploads/'.$salary->reference_document) : '#' }}" 
           target="_blank" 
           id="reference_document" 
           name="reference_document">
            {{ $salary->reference_document ? 'View Document' : 'No Document Uploaded' }}
        </a>
    </div>
</div>



           <div class="row mb-3">
               
               
            <div class="col-md-12 mb-3">
               
   
    <div class="button-container">
        <button type="button" id="send-button" class="btn btn-primary" data-docuser="" data-bs-toggle="modal" data-bs-target="#ForwardModel">Send</button>

        <button type="button" id="approve-button" class="btn btn-success" data-docuser="">Send & Sign</button>

        <button type="button" id="reject-button" class="btn btn-danger">Reject</button>
    </div>
    <!-- Hidden input field for status -->
    <input type="hidden" name="status" id="status-field" value="">

    <!-- Hidden input field for rejection description -->
    <input type="hidden" name="reject_description" id="reject-description-field" value="">

    <!-- Rejection Modal (Ensure this modal is included in your HTML) -->
    <div class="modal fade" id="rejectionModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectionModalLabel">Rejection Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea id="reject-description-field-modal" class="form-control" placeholder="Enter rejection reason"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submit-reject" class="btn btn-danger">Submit Rejection</button>
                </div>
            </div>
        </div>
    </div>
  
<div class="modal fade" id="VerifyClerk" tabindex="-1" aria-labelledby="VerifyClerkLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="VerifyClerkLabel">Verify Otp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                           <div class="form-group" id="frwd_hod" style="display:none">
                                    <label for="hod">Forward To Staff</label>
                                    <select name="hod" class="form-control select2" id="hod_id"  >
                                       
                                     
                                    </select>
                                </div>
                                  <div class="form-group" >
                                      <label for="hod">Otp</label>
                                  <input type="text" name="otp" class="form-control" placeholder="Enter otp" />
                                  </div>
                </div>
              
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitverify" class="btn btn-danger">Submit </button>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="modal fade" id="ForwardModel" tabindex="-1" aria-labelledby="ForwardModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ForwardModelLabel">Forward </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frwd_to_staff_Form"> 
                    <div class="form-group">
                        <input type="hidden" name="frwd_user_id" value="{{ Auth::user()->id }}" id="frwd_user_id">
                        <input type="hidden" name="frwd_leave_id" value="" id="frwd_leave_id">
                        <label for="frwd_hod_id">Forward To Staff</label>
                        <select name="frwd_hod_id" class="form-control select2" id="frwd_hod_id">
                           
                        </select>
                    </div>
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="submitfrwd" class="btn btn-danger">Submit</button>
            </div>
        </div>
    </div>
</div>
               
               
            </div>
        </div>

                    
                    
       
       
       

    </div>
</div>








@endsection

@section('script')

    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- listjs init -->
    <script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

        
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>


<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
$(document).ready(function() {
    $('#frwd_hod_id').select2({
        placeholder: "Select a staff member",
        allowClear: true
    });
      $('#hod_id').select2({
        placeholder: "Select a staff member",
        allowClear: true
    });
});
</script>
<script>
//  document.addEventListener('DOMContentLoaded', function () {
//     // Approve button functionality
//     document.getElementById('approveButton').addEventListener('click', function () {
//         // Set status to 'approved'
//         document.getElementById('status-field').value = 'approved';
//         // Hide reject description
//         document.getElementById('reject-description-row').style.display = 'none';
//         // Submit the form directly
//         document.getElementById('greenNoteForm').submit();
//     });

//     // Reject button functionality
//     document.getElementById('rejectButton').addEventListener('click', function () {
//         // Show reject description modal
//         var rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
//         rejectModal.show();
//     });

//     // Confirm reject button functionality
//     document.getElementById('confirmRejectButton').addEventListener('click', function () {
//         // Set status to 'rejected'
//         document.getElementById('status-field').value = 'rejected';
//         // Get the rejection description
//         var rejectDescription = document.getElementById('reject-description-field').value;
        
//         // Optionally, validate rejection description here

//         // Hide the modal
//         var rejectModal = bootstrap.Modal.getInstance(document.getElementById('rejectModal'));
//         rejectModal.hide();

//         // Show reject description row and submit button
//         document.getElementById('reject-description-row').style.display = 'block';
//         document.getElementById('submit-button-row').style.display = 'block';

//         // Submit the form directly after setting the rejection description
//         document.getElementById('greenNoteForm').submit();
//     });
// });


</script>
<script>
    
  $(document).ready(function() {
    var quill = new Quill('#memo-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'font': [] }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['blockquote', 'code-block'],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    // Handle form submission
    $('#greenNoteForm').submit(function(e) {
        var memoContent = quill.root.innerHTML; // Get the content from the Quill editor
        $('#memo').val(memoContent); // Assign the Quill content to the hidden textarea
    });
});

</script>
<script>
    
  $(document).ready(function() {
    var quill = new Quill('#memo-editors', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'font': [] }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['blockquote', 'code-block'],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    // Handle form submission
    $('#greenNoteForm').submit(function(e) {
        var memoContent = quill.root.innerHTML; // Get the content from the Quill editor
        $('#memo').val(memoContent); // Assign the Quill content to the hidden textarea
    });
});

</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
    const approveButton = document.getElementById('approve-button');
    const rejectButton = document.getElementById('reject-button');
    const rejectionModal = new bootstrap.Modal(document.getElementById('rejectionModal'));
    const verifyClerkModal = new bootstrap.Modal(document.getElementById('VerifyClerk'));
    const userId = approveButton.getAttribute('data-docuser'); // Get the document user ID from the button attribute

    // Approve Button Click Event with AJAX
    approveButton.addEventListener('click', function () {
        const apiUrl = '/api/send-otp-digital'; // Route for sending OTP
        const statusField = document.getElementById('status-field');
        statusField.value = 'approved'; // Set the status field to 'approved'

        // Perform the AJAX request
        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token for security
            },
            body: JSON.stringify({
                user_id: '{{Auth::user()->id}}',
                page_id: userId,
                page: 'leave'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // If 'data' is "OTHER", show the OTP modal and manage the select field
                if (data.data === 'OTHER') {
                    verifyClerkModal.show();

                    // Check if the role is HOD
                    const hodField = document.getElementById('frwd_hod');
                    
                    // If the data contains 'HOD', do not show the select
                    if (data.data === 'HOD') {
                        hodField.style.display = 'none'; 
                       
                        // Keep the select hidden
                    } else {
                        hodField.style.display = 'block'; // Show the select field for non-HOD users
                    }
                }else{
                    verifyClerkModal.show();

                    // Check if the role is HOD
                    const hodField = document.getElementById('frwd_hod');
                    
                    // If the data contains 'HOD', do not show the select
                    if (data.data === 'HOD') {
                        hodField.style.display = 'none'; 
                       
                        // Keep the select hidden
                    } else {
                        hodField.style.display = 'block'; // Show the select field for non-HOD users
                    }
                }

            } else {
                alert('Failed to send OTP. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while sending OTP.');
        });
    });

    // Submit OTP for Verification
    document.getElementById('submitverify').addEventListener('click', function () {
    const otpValue = document.querySelector('input[name="otp"]').value;
    const hodId = document.querySelector('select[name="hod"]').value; // Only used if hod field is visible
    const memoEditorContent = document.getElementById('memo-editor').innerHTML.trim(); // Get and trim the content from memo-editor

    // Determine if memo content should be included (only if not empty)
    const greenNoteDis = memoEditorContent !== '' ? memoEditorContent : null;

    if (otpValue) {
        fetch('/api/verify-otp-digital', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                user_id: '{{Auth::user()->id}}',
                page_id: userId,
                page: 'leave',
                verify_otp: otpValue,
                hod_id: hodId, // Pass the selected hod_id if needed
                green_note_dis: greenNoteDis // Pass the memo content if available, else null
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('OTP verified successfully.');
                if (data.data === 'approved_clerk' || data.data === 'approved') {
                    const statusField = document.getElementById('status-field');
                    statusField.value = data.data; // Set status field value

                    // Submit the form after setting the status
                    document.getElementById('achievement-form').submit();
                }
                verifyClerkModal.hide(); // Close the modal on success
            } else {
                alert('OTP verification failed: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while verifying OTP.');
        });
    } else {
        alert('Please enter the OTP.');
    }
});


    // Reject Button Click Event
    rejectButton.addEventListener('click', function () {
        // Show the rejection modal
        rejectionModal.show();
    });

    // Submit Rejection Button Click Event
    document.getElementById('submit-reject').addEventListener('click', function () {
        const rejectDescription = document.getElementById('reject-description-field-modal').value;

        if (rejectDescription) {
            // Set the reject description in the form
            const rejectDescriptionField = document.getElementById('reject-description-field');
            rejectDescriptionField.value = rejectDescription;

            // Set the status to rejected in the hidden input field
            const statusField = document.getElementById('status-field');
            statusField.value = 'rejected';

            // Close the modal and submit the form
            rejectionModal.hide();
            document.getElementById('achievement-form').submit();
        } else {
            alert("Please enter a reason for rejection.");
        }
    });
});

</script>
<script>
    $(document).ready(function() {
    // Click event for submit button in the modal
    $('#submitfrwd').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Check if the memo field has any content
        var memoContent = $('#memo-editor').html().trim();
        if (memoContent.length > 0) {
            // Set the content of memo-editor to the textarea for submission
            $('#memo').val(memoContent);
        } else {
            $('#memo').val(null); // Set memo value to null if empty
        }

        // Collect form data
        var formData = {
            frwd_user_id: $('#frwd_user_id').val(),
            frwd_leave_id: $('#frwd_leave_id').val(),
            frwd_hod_id: $('#frwd_hod_id').val(),
            green_note_dis: $('#memo').val()
        };

        // Send AJAX request to the API
        $.ajax({
            url: '/api/forward-user-leaves',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // If CSRF token is needed
            },
            success: function(response) {
                if (response.success) {
                    alert('Leave forwarded successfully');
                    $('#ForwardModel').modal('hide'); // Close the modal
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    });
});

</script>


@endsection