@extends('main.layout.layout')

@section('title-page','Log')

@section('main-sidebar')
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	  <h1>
        Log
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Log</li>
      </ol>
    </section>
	
    <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="box-header with-border">
						<div class="row">
							<div class="col-md-2 col-sm-3 col-xs-6">
								<h4>Log</h4>
							</div>
						</div>
					</div>				
					<div class="box-body">
						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Daerah</th>
									<th style="min-width: 300px;">Waktu Login</th>
								</tr>
							</thead>
							<tbody>
							{{--*/ $no = 1 /*--}}
								@foreach($data as $tmp)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $tmp->name }}</td>
										<td>{{ date('d-m-Y H:i', strtotime($tmp->log_time)) }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>				
				</div>				
			</div>
		</div> 
    </section>
</div>
@endsection