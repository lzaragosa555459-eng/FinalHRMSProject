<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

    @section('title', 'Dashboard')

    @section('content')
    <h1>Attendance</h1>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($attendance as $attend)
                <tr>
                    <td>{{ $attend->employee->name }}</td>
                    <td>{{ $attend->date }}</td>
                    <td>{{ $attend->time_in }}</td>
                    <td>{{ $attend->time_out }}</td>
                    <td>{{ $attend->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endsection
</body>
</html>