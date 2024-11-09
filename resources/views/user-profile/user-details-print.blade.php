<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Page Layout</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 40%;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            font-size: 12px;
        }
        .page-title {
            text-align: center;
            text-decoration: underline;
            margin-bottom: 15px;
            font-size: 22px;
            font-weight: bold;
        }
        .info-table {
            width: 90%;
            border-collapse: collapse;
            font-size: 14px;
            margin: 0 auto;
        }
        .info-table, .info-table th, .info-table td {
            border: 1px solid black;
        }
        .info-table th, .info-table td {
            padding: 8px;
            text-align: left;
        }
        .signature-section {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        .signature {
            width: 100%;
            text-align: center;
        }
        .signature img {
            width: 40px;
            display: block;
            margin: 0 auto;
        }
        .footer {
            margin-top: 20px;
            border-top: 1px dotted black;
            padding-top: 5px;
            text-align: center;
            font-size: 15px;
        }

        /* Print styles */
        @media print {
            body, .container {
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
                font-size: 12px; /* Adjust font size if needed for printing */
            }
            .container {
                page-break-inside: avoid; /* Prevents page break inside the container */
            }
            .info-table {
                width: 100%; /* Full width for printing */
            }
            .signature img {
                width: 100px;
            }
            .footer {
                font-size: 12px;
            }
            .page-title {
                font-size: 20px; /* Adjust the heading size for print */
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="page-title">Employee Details</h1>

<table class="info-table">
    @php $rowNumber = 1; @endphp <!-- Initialize the counter -->

    <tr class="table-row">
        <td class="table-cell">{{ $rowNumber++ }}</td> <!-- Display and increment counter -->
        <td class="table-cell">Name</td>
        <td class="table-cell">{{ $user->first_name }} {{ $user->last_name }}</td>
    </tr>
  @if (!empty($user->email))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Email</td>
            <td class="table-cell">{{ $user->email }}</td>
        </tr>
    @endif

  
    @if (!empty($user->number))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Contact No</td>
            <td class="table-cell">{{ $user->number }}</td>
        </tr>
    @endif
    

    @if (!empty($user->address))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Address</td>
            <td class="table-cell">{{ $user->address }}</td>
        </tr>
    @endif

    @if (!empty($user->state))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">State</td>
            <td class="table-cell">{{ $user->state }}</td>
        </tr>
    @endif

    @if (!empty($user->district))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">District</td>
            <td class="table-cell">{{ $user->district }}</td>
        </tr>
    @endif

    @if (!empty($user->taluka))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Taluka</td>
            <td class="table-cell">{{ $user->taluka }}</td>
        </tr>
    @endif
                @if (!empty($user->org_name))
            <tr class="table-row">
                <td class="table-cell">{{ $rowNumber++ }}</td>
                <td class="table-cell">Organization Name</td>
                <td class="table-cell">{{ $user->org_name }}</td>
            </tr>
            @endif

            @if (!empty($user->department_name))
            <tr class="table-row">
                <td class="table-cell">{{ $rowNumber++ }}</td>
                <td class="table-cell">Department Name</td>
                <td class="table-cell">{{ $user->department_name }}</td>
            </tr>
            @endif

            @if (!empty($user->designation_name))
            <tr class="table-row">
                <td class="table-cell">{{ $rowNumber++ }}</td>
                <td class="table-cell">Designation Name</td>
                <td class="table-cell">{{ $user->designation_name }}</td>
            </tr>
            @endif

            @if (!empty($user->joining_start_salary))
            <tr class="table-row">
                <td class="table-cell">{{ $rowNumber++ }}</td>
                <td class="table-cell">Joining Start Salary</td>
                <td class="table-cell">{{ $user->joining_start_salary }}</td>
            </tr>
            @endif

            @if (!empty($user->joining_date))
            <tr class="table-row">
                <td class="table-cell">{{ $rowNumber++ }}</td>
                <td class="table-cell">Joining Date</td>
                <td class="table-cell">{{ $user->joining_date }}</td>
            </tr>
            @endif
      
    @if (!empty($user->caste))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Caste</td>
            <td class="table-cell">{{ $user->caste }}</td>
        </tr>
    @endif

    @if (!empty($user->gender))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Gender</td>
            <td class="table-cell">{{ ucfirst($user->gender) }}</td>
        </tr>
    @endif

    @if (!empty($user->after_mar_first_name))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">After Marriage First Name</td>
            <td class="table-cell">{{ $user->after_mar_first_name }}</td>
        </tr>
    @endif

    @if (!empty($user->after_mar_mid_name))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">After Marriage Middle Name</td>
            <td class="table-cell">{{ $user->after_mar_mid_name }}</td>
        </tr>
    @endif

    @if (!empty($user->after_mar_last_name))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">After Marriage Last Name</td>
            <td class="table-cell">{{ $user->after_mar_last_name }}</td>
        </tr>
    @endif

    @if (!empty($user->address_B))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Secondary Address</td>
            <td class="table-cell">{{ $user->address_B }}</td>
        </tr>
    @endif

    @if (!empty($user->father_name))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Father's Name</td>
            <td class="table-cell">{{ $user->father_name }}</td>
        </tr>
    @endif

    @if (!empty($user->father_address))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Father's Address</td>
            <td class="table-cell">{{ $user->father_address }}</td>
        </tr>
    @endif

    @if (!empty($user->birth_date))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Birth Date</td>
            <td class="table-cell">{{ $user->birth_date }}</td>
        </tr>
    @endif

    @if (!empty($user->birth_text))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Birth Text</td>
            <td class="table-cell">{{ $user->birth_text }}</td>
        </tr>
    @endif

    @if (!empty($user->birth_mark))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Birth Mark</td>
            <td class="table-cell">{{ $user->birth_mark }}</td>
        </tr>
    @endif

    @if (!empty($user->height))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Height</td>
            <td class="table-cell">{{ $user->height }}</td>
        </tr>
    @endif

    @if (!empty($user->qualification))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Qualification</td>
            <td class="table-cell">{{ $user->qualification }}</td>
        </tr>
    @endif

    @if (!empty($user->another_qualification))
        <tr class="table-row">
            <td class="table-cell">{{ $rowNumber++ }}</td>
            <td class="table-cell">Another Qualification</td>
            <td class="table-cell">{{ $user->another_qualification }}</td>
        </tr>
    @endif
 

</table>


        <div class="signature-section">
            <div class="signature">
                <img src="{{asset('checkmark.png')}}" alt="Clerk Signature">
                
                <p>Clerk Signature</p>
            </div>
            <div class="signature">
                <img src="{{asset('checkmark.png')}}" alt="HOD Signature">
                <p>HOD Signature </p>
            </div>
        </div>

        <div class="footer">
            टीप - या पृष्ठावरील नोंदीस निवडीन प्रत्येक पाच वर्षानंतर पुन्हा नव्याने करणे आवश्यक.<br>
            The entries in this page should be renewed or re-attested at least every five years.
        </div>
    </div>

</body>
</html>