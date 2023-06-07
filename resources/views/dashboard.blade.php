@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">APENS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if (session('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ session('success') }}');
            });
        </script>
    @elseif (session('error'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ session('error') }}');
            });
        </script>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-md-4">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Today's Details</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <th>Date </th>
                                    <td>{{ $todayTime }}</td>
                                </tr>
                                <tr>
                                    <th>Available Nurses</th>
                                    <td>{{ $nurseAttendance->count() }}</td>
                                </tr>
                                <tr>
                                    <th>Total Request</th>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <th>Responses</th>
                                    <td><span class="badge badge-success">5</span></td>
                                </tr>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Available Nurses</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Nurse Number</th>
                                <th>Full Name</th>
                                <th>Time In</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($nurseAttendance as $attendances)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $nurseinfo->where('id', $attendances->nurse_id)->first()->nurse_number }}
                                    </td>
                                    <td>
                                        {{ $nurseinfo->where('id', $attendances->nurse_id)->first()->f_name }}
                                        {{ $nurseinfo->where('id', $attendances->nurse_id)->first()->l_name }}
                                    </td>
                                    <td>{{ $attendances->created_at->format('H:i') }}</td>
                                    @if ($attendances->created_at == $attendances->updated_at)
                                        <td><span class="badge badge-success"> On site..</span></td>
                                    @endif

                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
