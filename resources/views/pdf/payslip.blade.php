<!DOCTYPE html>
<html>
<head>
    <title>Payslip</title>
    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; }
        h2 { color: #6f42c1; }
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

    <p><strong>Name:</strong> {{ $payroll->employee->name }}</p>
    <p><strong>Payroll Date:</strong> {{ $payroll->created_at->format('M d, Y') }}</p>

    <table>
        <tr>
            <th>Basic Salary</th>
            <td>₱{{ number_format($payroll->basic_salary, 2) }}</td>
        </tr>
        <tr>
            <th>Deductions</th>
            <td>₱{{ number_format($payroll->deductions, 2) }}</td>
        </tr>
        <tr>
            <th>Net Salary</th>
            <td>₱{{ number_format($payroll->net_salary, 2) }}</td>
        </tr>
    </table>
</div>
</body>
</html>