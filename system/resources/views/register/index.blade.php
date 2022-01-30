@extends('layout.layout')

@section('title','Registration')
@section('title-page','Registration')

@section('content')

	<div class="content">
		<center>
		<h1>REGISTRASI</h1>
		<h2>REGISTRATION</h2>
		<p>Registrasi Dengan / <em>Registration With :</em></p>
			<a href="{{asset('register/facebook/login')}}"><div class="btn btn-primary default facebook">Facebook</div></a>
			<a href="{{asset('register/google/login')}}"><div class="btn btn-default default email">Email</div></a>
			<a href="{{asset('register/guest/login')}}"><div class="btn btn-default default email">Quest</div></a>
		</center>
	</div> 

@endsection