@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>

    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title">Student <strong>Monthly Fee</strong></h4>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('student.monthly.fee.classwise.get') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Year <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="year_id" id="year_id" required=""
                                                        class="form-control">
                                                        <option value="" selected="" disabled="">Select Year
                                                        </option>
                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div> <!-- End Col md 3 -->
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Class <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="class_id" id="class_id" required=""
                                                        class="form-control">
                                                        <option value="" selected="" disabled="">Select Class
                                                        </option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div> <!-- End Col md 3 -->
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Month <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="month" id="month" required=""
                                                        class="form-control">
                                                        <option value="" selected="" disabled="">Select Month
                                                        </option>

                                                        <option @isset($month)
                                                            {{ ($month == 'January') ? "selected" : "" }} 
                                                        @endisset value="January">January</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'February') ? "selected" : "" }} 
                                                    @endisset value="February">February</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'March') ? "selected" : "" }} 
                                                    @endisset value="March">March</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'April') ? "selected" : "" }} 
                                                    @endisset value="April">April</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'May') ? "selected" : "" }} 
                                                    @endisset value="May">May</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'Jun') ? "selected" : "" }} 
                                                    @endisset value="Jun">Jun</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'July') ? "selected" : "" }} 
                                                    @endisset value="July">July</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'August') ? "selected" : "" }} 
                                                    @endisset value="August">August</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'September') ? "selected" : "" }} 
                                                    @endisset value="September">September</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'October') ? "selected" : "" }} 
                                                    @endisset value="October">October</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'November') ? "selected" : "" }} 
                                                    @endisset value="November">November</option>
                                                        <option @isset($month)
                                                        {{ ($month == 'December') ? "selected" : "" }} 
                                                    @endisset value="December">December</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 3 -->
                                        <div class="col-md-3" style="padding-top: 25px;">

                                            <input type="submit" class="btn btn-rounded btn-dark mb-5" name="search"
                                                value="Search">

                                        </div> <!-- End Col md 3 -->
                                    </div><!--  end row -->
                                </form>
                            </div>
                            <!-- /.col -->
                            <!--  ////////////////// monthly Fee table /////////////  -->
                        </div>
                    </div>
					<div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Student List</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
									@if(isset($allData)&&isset($monthly_fee))
										
									
									<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="5%">SL</th>
			<th>Name</th>
                                                <th>ID No</th>
                                                <th>Roll</th>
                                                <th>Monthly Fee</th>
                                                <th>Discount</th>
                                                <th>Student Fee</th>
                                                <th width="25%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											@foreach ($allData as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $value->student->name }}</td>
                                                    <td>{{ $value->student->id_no }}</td>
                                                    <td>{{ $value->roll }}</td>
                                                    <td>{{ $monthly_fee->amount }}</td>
                                                    <td>{{ $value->discount->discount }}</td>
                                                    {{-- for calculate total payable registration fee --}}
                                                    @php
                                                        $originalfee = $monthly_fee->amount;
                                                        $discount = $value->discount->discount;
                                                        $discounttablefee = ($discount / 100) * $originalfee;
                                                        $finalfee = (float) $originalfee - (float) $discounttablefee
														@endphp
                                                    <td>
														{{ $finalfee }}
                                                    </td>
                                                    <td>
                                                        <a
                                                        href="{{ route('student.monthly.fee.payslip', [$value->student_id,$month]) }}"
                                                          target="_blank"class="btn btn-success">Fee slip</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
									@endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.row -->
            </section>
            <!-- /.content -->
			
        </div>
    </div>
	@endsection
