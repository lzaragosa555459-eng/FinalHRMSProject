<!DOCTYPE html>
<html>
<head>
    <title>Payslip</title>
    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; }
        h2 { color: #6f42c1; }

        .cutoff-badge{
            display:inline-block;
            padding:6px 12px;
            background:#6f42c1;
            color:white;
            border-radius:5px;
            font-size:12px;
            margin-bottom:10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td, th {
            border: 1px solid #ddd;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Employee Payslip</h2>

    {{-- SHOW CUTOFF ONLY IF VALUE EXISTS --}}
    @if($payroll->cutoff_label == '1st Cutoff')
        <div class="cutoff-badge">
            First Cut-off
        </div>
    @elseif($payroll->cutoff_label == '2nd Cutoff')
        <div class="cutoff-badge">
            Second Cut-off
        </div>
    @endif

    <p>
        <strong>Name:</strong>
        {{ $payroll->employee->name }}
    </p>

    <p>
        <strong>Payroll Date:</strong>
        {{ $payroll->created_at->format('M d, Y') }}
    </p>

    <table>
        <tr>
            <th>Basic Salary</th>
            <td>₱{{ number_format($payroll->basic_salary, 2) }}</td>
        </tr>

        <tr>
            <th>Allowances</th>
            <td>₱{{ number_format($payroll->allowances, 2) }}</td>
        </tr>

        <tr>
            <th>Deductions</th>
            <td>₱{{ number_format($payroll->deduction, 2) }}</td>
        </tr>

        <tr>
            <th>Net Salary</th>
            <td>
                <strong>
                    ₱{{ number_format($payroll->net_salary, 2) }}
                </strong>
            </td>
        </tr>
    </table>

</div>

</body>
</html>