@extends('layout.layout')

@section('title','Peta')
@section('title-page','Peta')

@section('content')
<?php
	$kontak_dpd = @$_GET['kontak_dpd'];
	$kontak_dpc = @$_GET['kontak_dpc'];
	$penduduk = @$_GET['penduduk'];
	$suara_tahun = @$_GET['suara_tahun'];
	$agenda_tahun = @$_GET['agenda_tahun'];
?>
		<div class="on-map-menu">
			<div class="box app-menu" style="border:0px;">
				<div class="box-header" style="background:#dd4b39;color:white;">
					<div class="col-md-11 col-sm-11 col-xs-11 menu-title" style="font-family: 'Open Sans';font-size:11px;padding:0;color:white;">Filter By :</div>
					<div class="col-md-1 col-sm-1 col-xs-1 box-tools">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" style="color:white;"></i></button>
					</div>
				</div>
				<div class="box-body" style="width:100%;">			  
					<div id="wrapper-200a">
					<ul class="accordion">				
						<li id="statistik" class="mail">
							<a href="#statistik" onclick="showStatistik('getData')" class="active">Statistik</a>
							<ul class="sub-menu">						
								<li><a href="#statistik" id="statistikOrganisasi" onclick="showStatistik('statistikOrganisasi')" ><em>01</em>Organisasi ( {{ $jumlahProv }} )</a></li>						
								<li>
									<a href="#statistik" id="statistikKusri" onclick="showStatistik('statistikKusri')" data-toggle="collapse" data-target="#detailKursi"><em>02</em>Perolehan Kursi ( {{ $jumlahProv }} )</a>
									<ul id="detailKursi" class="collapse">
										<li><a href="#statistik" id="responseKursi1" onclick="showStatistikKursi('dprri')" class="responseKursidprri"></a></li>
										<li><a href="#statistik" id="responseKursi2" onclick="showStatistikKursi('dprdi')" class="responseKursidprdi"></a></li>
										<li><a href="#statistik" id="responseKursi3" onclick="showStatistikKursi('dprdii')" class="responseKursidprdii"></a></li>
									</ul>
								</li>						
							</ul>
						</li>					
						<li id="data">
							<a href="#data" onclick="showDPDDPC('getData')">Data PIMDA & PIMCAB PKN</a>
							<ul class="sub-menu">						
								<li><a href="#data" id="kontakDPD" onclick="showDPD('kontakDPD')" ><em>01</em>PIMDA ( {{ count($datapimdaAll) }} )</a></li>						
								<li><a href="#data" id="kontakDPC" onclick="showDPC('kontakDPC')" ><em>02</em>PIMCAB ( {{ count($datapimcabAll) }} )</a></li>
							</ul>
						</li>				
						<li id="penduduk" class="mail">
							<a href="#penduduk" onclick="showPenduduk('getData')">Penduduk</a>
							<ul class="sub-menu">						
								<li><a href="#penduduk" id="pendudukProvinsi" onclick="showPenduduk('pendudukProvinsi')" ><em>01</em>Provinsi</a></li>						
								<li><a href="#penduduk" id="pendudukKabupaten" onclick="showPenduduk('pendudukKabupaten')" ><em>02</em>Kabupaten</a></li>
							</ul>
						</li>						
						<li id="agenda" class="mail">
							<a href="#agenda" onclick="showAgenda('getData')">Agenda Hanura</a>
							<ul class="sub-menu">						
								<li><a href="#agenda" id="pilkada" onclick="showPilkadaAll('pilkada')" data-toggle="collapse" data-target="#detailPilkada"> <em>01</em>Pilkada 2018</a>
									<ul id="detailPilkada" class="collapse">
										<li><a href="#agenda" id="responsePilkada1" onclick="showPilkada('gubernur')" class="responsePilkadagubernur"> <em>-</em>Gubernur</a></li>
										<li><a href="#agenda" id="responsePilkada2" onclick="showPilkada('bupati')" class="responsePilkadabupati"> <em>-</em>Bupati</a></li>
										<li><a href="#agenda" id="responsePilkada3" onclick="showPilkada('walikota')" class="responsePilkadawalikota"> <em>-</em>Walikota</a></li>
									</ul>
								</li>
							</ul>
						</li>			
					</ul>			
				</div>
				</div>
			</div>	
		</div>

		<div id="legend" style="min-width:200px; display: none;">
			<div class="box app-menu" style="border:0px;">
				<div class="box-header" style="background:#f39c12;color:white;">
					<div class="col-md-11 col-sm-11 col-xs-11 menu-title" style="font-family: 'Open Sans';font-size:11px;padding:0;color:white;">Legend :</div>
					<div class="col-md-1 col-sm-1 col-xs-1 box-tools">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" style="color:white;"></i></button>
					</div>
				</div>
				<div class="box-body" style="width:100%;" style="margin: 0; padding: 0;">			  
					
				</div>
			</div>	
		</div>
		
		<div class="row" style="height:100%;width:100%;margin:0;">
			<div class="col-md-12" style="height:100%;padding:0;">
				<div class="response-maps" style="height:100%;">
					@include('index_maps')
				</div>
			</div>
		</div>

		<div class="row scroll no-margin">
			<div class="col-md-1 pull-right">
				<div class="row scroll-button" id="btn-up">
					<div class="col-md-12"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
				</div>
				<div class="row scroll-button" id="btn-down">
					<div class="col-md-12"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
				</div>
			</div>
		</div>
<script type="text/javascript">
	function goToData(jenis,dpd,dpc) {
		var url = "http://partaihanura.net/downloads/";
		if(jenis == "DPD") {
			url += "DPD "+dpd;
		} else if(jenis == "DPC") {
			url += "DPD "+dpd+"/DPC "+dpc;
		}
		window.open(url,'_blank');
	}
	$('.accordion>li').click(function(){
		$('.accordion>li').addClass('mail');
		$(this).removeClass('mail');
	});
</script>
@endsection