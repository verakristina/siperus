@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Report '.$type)


	@section('menu','Report<small>'.strtoupper($type).'</small>')
	@section('box-header','Report '.strtoupper($type))

	@section('content-filter') 
			@section('indo_combo_fprov','initial')
			@section('goto_prov')
				location.href="{{ asset('report/'.$type) }}/"+provId;
			@stop
		@include('main.report.include.content-filter')
	@stop
	
	@section('content-body')
		
	@stop
	
	@include('main.report.include.content-bodwy')
@stop
