{{--*/ 
	$no = 1;
	$t_dpc = 0;
	$ta_dpc = 0;
	$tb_dpc = 0;
	$t_pac = 0;
	$ta_pac = 0;
	$tb_pac = 0;
	$t_ranting = 0;
	$ta_ranting = 0;
	$tb_ranting = 0;
	$t_anak_ranting = 0;
	$ta_anak_ranting = 0;
	$tb_anak_ranting = 0;
	$t_kpa = 0;
	$ta_kpa = 0;
	$tb_kpa = 0;
/*--}}
<style type="text/css">
	.black {
		background: #000000;
		color: #FFFFFF;
	}
	.orange {
		background: #FF6600;
	}
	.yellow {
		background: #FF9900;
	}
	.light-yellow {
		background: #FFC000;
	}
	.red {
		background: #FF0000;
	}
	.center {
		text-align: center;
	}
	tr>th {
		text-align: center;
	}
	.red-text {
		color: #FF0000 !important;
		word-wrap: break-word;
	}
	.bold {
		font-weight: bold;
	}
</style>
<table class="table table-striped table-hovered" id="report" border="1px">
	<thead>
		<tr>
			<th class="black center" align="center" valign="middle">NO</th>
			<th class="orange" align="center" valign="middle">PENGURUS DPD</th>
			<th class="black" align="center" valign="middle">JUMLAH KAB/KOTA</th>
			<th class="orange" colspan="2" align="center" valign="middle">PENGURUS DPC</th>
			<th class="black" align="center" valign="middle">JUMLAH KECAMATAN</th>
			<th class="orange" colspan="2" align="center" valign="middle">PENGURUS PAC</th>
			<th class="black" align="center" valign="middle">JUMLAH DESA/KEL</th>
			<th class="orange" colspan="2" align="center" valign="middle">PENGURUS RANTING</th>
			<th class="black" align="center" valign="middle">JUMLAH RW/DUSUN</th>
			<th class="orange" colspan="2" align="center" valign="middle">PENGURUS ANAK RANTING</th>
			<th class="black" align="center" valign="middle">JUMLAH RT</th>
			<th class="orange" colspan="2" align="center" valign="middle">PENGURUS KPA</th>
		</tr>
		<tr>
			<th class="orange"></th>
			<th class="black"></th>
			<th class="yellow"></th>
			<th class="black">TBK</th>
			<th class="red">B.TBK</th>
			<th class="yellow"></th>
			<th class="black">TBK</th>
			<th class="red">B.TBK</th>
			<th class="yellow"></th>
			<th class="black">TBK</th>
			<th class="red">B.TBK</th>
			<th class="yellow"></th>
			<th class="black">TBK</th>
			<th class="red">B.TBK</th>
			<th class="yellow"></th>
			<th class="black">TBK</th>
			<th class="red">B.TBK</th>
		</tr>
		@foreach($dataReport as $tmp)				
			<tr>
				<td class="orange center">{{ $no++ }}</td>
				<td class="black">{{ strtoupper($tmp->geo_prov_nama) }}</td>
				<td class="yellow center">{{ number_format($tmp->pengurus_pimcab,0, "." , ",") }}</td>
				<td class="center">{{ number_format($tmp->pengurus_pimcab_ada,0, "." , ",") }}</td>
				<td class="center red-text" style="color: #FF0000;">{{ number_format($tmp->pengurus_pimcab-$tmp->pengurus_pimcab_ada,0, "." , ",") }}</td>
				<td class="yellow center">{{ number_format($tmp->pengurus_pac,0, "." , ",") }}</td>
				<td class="center">{{ number_format($tmp->pengurus_pac_ada,0, "." , ",") }}</td>
				<td class="center red-text" style="color: #FF0000;">{{ number_format($tmp->pengurus_pac-$tmp->pengurus_pac_ada,0, "." , ",") }}</td>
				<td class="yellow center">{{ number_format($tmp->pengurus_ranting,0, "." , ",") }}</td>
				<td class="center">{{ number_format($tmp->pengurus_ranting_ada,0, "." , ",") }}</td>
				<td class="center red-text" style="color: #FF0000;">{{ number_format($tmp->pengurus_ranting-$tmp->pengurus_ranting_ada,0, "." , ",") }}</td>
				<td class="yellow center">{{ number_format($tmp->pengurus_anak_ranting,0, "." , ",") }}</td>
				<td class="center">{{ number_format($tmp->pengurus_anak_ranting_ada,0, "." , ",") }}</td>
				<td class="center red-text" style="color: #FF0000;">{{ number_format($tmp->pengurus_anak_ranting-$tmp->pengurus_anak_ranting_ada,0, "." , ",") }}</td>
				<td class="yellow center">{{ number_format($tmp->pengurus_kpa,0, "." , ",") }}</td>
				<td class="center">{{ number_format($tmp->pengurus_kpa_ada,0, "." , ",") }}</td>
				<td class="center red-text" style="color: #FF0000;">{{ number_format($tmp->pengurus_kpa-$tmp->pengurus_kpa_ada,0, "." , ",") }}</td>
			</tr>
			<?php
				$t_dpc = $t_dpc+$tmp->pengurus_pimcab;
				$ta_dpc = $ta_dpc+$tmp->pengurus_pimcab_ada;
				$tb_dpc = $tb_dpc+$tmp->pengurus_pimcab-$tmp->pengurus_pimcab_ada;
				
				$t_pac = $t_pac+$tmp->pengurus_pac;
				$ta_pac = $ta_pac+$tmp->pengurus_pac_ada;
				$tb_pac = $tb_pac+$tmp->pengurus_pac-$tmp->pengurus_pac_ada;
				
				$t_ranting = $t_ranting+$tmp->pengurus_ranting;
				$ta_ranting = $ta_ranting+$tmp->pengurus_ranting_ada;
				$tb_ranting = $tb_ranting+$tmp->pengurus_ranting-$tmp->pengurus_ranting_ada;
				
				$t_anak_ranting = $t_anak_ranting+$tmp->pengurus_anak_ranting;
				$ta_anak_ranting = $ta_anak_ranting+$tmp->pengurus_anak_ranting_ada;
				$tb_anak_ranting = $tb_anak_ranting+$tmp->pengurus_anak_ranting-$tmp->pengurus_anak_ranting_ada;
				
				$t_kpa = $t_kpa+$tmp->pengurus_kpa;
				$ta_kpa = $ta_kpa+$tmp->pengurus_kpa_ada;
				$tb_kpa = $tb_kpa+$tmp->pengurus_kpa-$tmp->pengurus_kpa_ada;
			?>
		@endforeach
		<tr>
			<td class="black center"></td>
			<td class="black center"></td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($t_dpc,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($ta_dpc,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($tb_dpc,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($t_pac,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($ta_pac,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($tb_pac,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($t_ranting,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($ta_ranting,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($tb_ranting,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($t_anak_ranting,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($ta_anak_ranting,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($tb_anak_ranting,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($t_kpa,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($ta_kpa,0, "." , ",") }}</td>
			<td class="black center bold" align="center" valign="middle">{{ number_format($tb_kpa,0, "." , ",") }}</td>
		</tr>

	@if($ta_dpc != 0 && $t_dpc != 0)			
		{{--*/ $perDPC = number_format(($ta_dpc/$t_dpc)*100,2); /*--}}
	@else
		{{--*/ $perDPC = 0; /*--}}
	@endif
	@if($ta_pac != 0 && $t_pac != 0)			
		{{--*/ $perPAC = number_format(($ta_pac/$t_pac)*100,2); /*--}}
	@else
		{{--*/ $perPAC = 0; /*--}}
	@endif
	@if($ta_ranting != 0 && $t_ranting != 0)			
		{{--*/ $perRANTING = number_format(($ta_ranting/$t_ranting)*100,2); /*--}}
	@else
		{{--*/ $perRANTING = 0; /*--}}
	@endif
	@if($ta_anak_ranting != 0 && $t_anak_ranting != 0)			
		{{--*/ $perANAKRANTING = number_format(($ta_anak_ranting/$t_anak_ranting)*100,2); /*--}}
	@else
		{{--*/ $perANAKRANTING = 0; /*--}}
	@endif
	@if($ta_kpa != 0 && $t_kpa != 0)			
		{{--*/ $perKPA = number_format(($ta_kpa/$t_kpa)*100,2); /*--}}
	@else
		{{--*/ $perKPA = 0; /*--}}
	@endif

		<tr>
			<td class="light-yellow center"></td>
			<td class="light-yellow center bold">PERSENTASE</td>
			<td class="light-yellow center bold" align="center" valign="middle">DPC</td>
			<td class="light-yellow center bold" colspan="2" align="center" valign="middle">{{ $perDPC }} %</td>
			<td class="light-yellow center bold" align="center" valign="middle">PAC</td>
			<td class="light-yellow center bold" colspan="2" align="center" valign="middle">{{ $perPAC }} %</td>
			<td class="light-yellow center bold" align="center" valign="middle">RANTING</td>
			<td class="light-yellow center bold" colspan="2" align="center" valign="middle">{{ $perRANTING }} %</td>
			<td class="light-yellow center bold" align="center" valign="middle">ANAK RANTING</td>
			<td class="light-yellow center bold" colspan="2" align="center" valign="middle">{{ $perANAKRANTING }} %</td>
			<td class="light-yellow center bold" align="center" valign="middle">KPA</td>
			<td class="light-yellow center bold" colspan="2" align="center" valign="middle">{{ $perKPA }} %</td>
		</tr>
	</tbody>
</table>