<!DOCTYPE html>
<html>
<head>
    <title>Payslip</title>

    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; }
        h2 { color: #6f42c1; }

        .cutoff {
            margin-bottom: 15px;
            padding: 6px 10px;
            background: #6f42c1;
            color: white;
            display: inline-block;
            border-radius: 5px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        td, th {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background: #f3f0f7;
            text-align: left;
        }

        .section {
            margin-bottom: 30px;
        }

        .text-success { color: #198754; }
        .text-danger { color: #dc3545; }
    </style>
</head>

<body>

<div class="container">

    <h2>Employee Payslip</h2>

    <p><strong>Name:</strong> {{ $user->employee->name }}</p>

    <p><strong>Month:</strong> {{ now()->format('F Y') }}</p>

    @foreach($payrolls as $payroll)

        <div class="section">

            <div class="cutoff">
                {{ $payroll->cutoff_label == 'first' ? 'First Cut-off' : 'Second Cut-off' }}
            </div>

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
                    <th>Gross Salary</th>
                    <td>₱{{ number_format($payroll->gross_salary, 2) }}</td>
                </tr>

                {{-- ✅ DEDUCTION BREAKDOWN --}}
                <tr>
                    <th>Deductions</th>
                    <td>
                        @if($payroll->cutoff_label == 'first')
                            <strong>Tax (5%)</strong><br>
                        @elseif($payroll->cutoff_label == 'second')
                            <strong>SSS (5%)</strong><br>
                            <strong>PhilHealth (5%)</strong><br>
                            <strong>Pag-IBIG (5%)</strong><br>
                        @endif

                        <span style="color:#dc3545;">
                            - ₱{{ number_format($payroll->deduction, 2) }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Net Salary</th>
                    <td style="color:#198754;">
                        <strong>
                            ₱{{ number_format($payroll->net_salary, 2) }}
                        </strong>
                    </td>
                </tr>

            </table>

        </div>

    @endforeach
        <hr>

        <h3 style="color:#6f42c1;">Monthly Summary</h3>

        <table>

            <tr>
                <th>Total Basic Salary</th>
                <td>₱{{ number_format($totalBasic, 2) }}</td>
            </tr>

            <tr>
                <th>Total Allowances</th>
                <td>₱{{ number_format($totalAllowance, 2) }}</td>
            </tr>

            <tr>
                <th>Total Deductions</th>
                <td style="color:#dc3545;">
                    - ₱{{ number_format($totalDeduction, 2) }}
                </td>
            </tr>

            <tr>
                <th>Total Net Salary</th>
                <td style="color:#198754;">
                    <strong>
                        ₱{{ number_format($totalNet, 2) }}
                    </strong>
                </td>
            </tr>

        </table>
</div>

</body>
</html>