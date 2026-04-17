<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee portal</title>
</head>

<body>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container mt-4">

    <div class="row">
        <div class="col-12">

            <h1>Attendance</h1>

            <!-- RESPONSIVE TABLE WRAPPER -->
            <div class="table-responsive">

                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-dark">
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

            </div>

        </div>
    </div>

</div>

@endsection

</body>
</html>