{{--*/ $no = 1; /*--}}
<style type="text/css">
	th.mid{
		text-align: center;
		vertical-align: middle;
	}
	.black {
		background: #000000;
		color: #FFFFFF;
	}
	.orange {
		background: #E26B0A;
		color: #FFFFFF;
	}
	.brown {
		background: #930000;
		color: #FFFFFF;
	}
	.yellow {
		background: #FF9900;
	}
	.light-orange {
		background: #FFD199;
	}
	.red {
		background: #C00000;
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
<table class="table table-striped table-hovered" id="report" border="1px" style="border-collapse: collapse;" >
	<thead>
		<tr style="text-align: center;">
			<th rowspan="2" class="black mid">NO</th>
			<th rowspan="2" class="orange mid">NAMA {{ $jeniss }}</th>
			<th colspan="2" class="black mid">STATUS KANTOR</th>
			<th rowspan="2" class="orange mid">ALAMAT KANTOR</th>
			<th rowspan="2" class="brown mid">TERLETAK DI IBUKOTA</th>
			<th colspan="3" class="orange mid">KEPENGURUSAN</th>
			<th colspan="3" class="black mid">RUANG KERJA</th>
			<th rowspan="2" class="orange mid">STAF ADMIN</th>
			<th rowspan="2" class="black mid">PAPAN NAMA PARTAI</th>
			<th colspan="3" class="orange mid">GAMBAR</th>
			<th rowspan="2" class="black mid">REKENING PARTAI</th>
		</tr>
		<tr>
			<th></th>
			<th></th>
			<th class="brown mid">MILIK SENDIRI</th>
			<th class="brown mid">KONTRAK / PINJAM PAKAI</th>
			<th></th>
			<th></th>
			<th class="black mid">KEAKTIFAN PENGURUS</th>
			<th class="black mid">30% PEREMPUAN</th>
			<th class="black mid">JUMLAH KTA</th>
			<th class="brown mid">K</th>
			<th class="brown mid">S</th>
			<th class="brown mid">B</th>
			<th></th>
			<th></th>
			<th class="brown mid">PRESIDEN & WKL PRESIDEN</th>
			<th class="brown mid">GARUDA</th>
			<th class="brown mid">KETUM & SEKJEN HANURA</th>
		</tr>
	</thead>
	<tbody>
		@foreach($dataReport as $tmp)				
			<tr class="light-orange">
				<td>{{ $no++ }}</td>
				<td>{{ $tmp->verifikasi_nama }}</td>
				<td style="text-align: center;">@if($tmp->verifikasi_status_kantor == '1') Ya @else Tidak @endif</td>
				<td style="text-align: center;">@if($tmp->verifikasi_status_kantor == '2') Ya @else Tidak @endif</td>
				<td>
					@if($tmp->verifikasi_alamat_kantor != '')
						{{ $tmp->verifikasi_alamat_kantor }} 
					@else 
						<center> - </center>	  
					@endif
				</td>
				<td style="text-transform: uppercase;">
					@if( $tmp->verifikasi_ibukota != '' )
						{{ $tmp->verifikasi_ibukota}}
					@else
						<center>-</center>
					@endif
				</td>
				<td style="text-align: center;">@if($tmp->verifikasi_keaktifan_pengurus == 1) Aktif @elseif($tmp->verifikasi_keaktifan_pengurus == 2) T.Aktif @else - @endif</td>
				<td style="text-align: center;">@if($tmp->verifikasi_perempuan == 1) Terpenuhi @else T.Terpenuhi @endif</td>
				<td>
					<center>
					@if($tmp->verifikasi_jumlah_kta)
						{{ $tmp->verifikasi_jumlah_kta}}	
					@else
						<center>-</center>
					@endif
					</center>
				</td>
				<td style="text-align: center;">
					<center>
					@if($tmp->verifikasi_ruang_kerja_k == '1')
						Ada
					@else
						T.Ada
					@endif
					</center>
				</td>
				<td style="text-align: center;">
					<center>
					@if($tmp->verifikasi_ruang_kerja_s == '1')
						Ada	
					@else
						T.Ada
					@endif
					</center>
				</td>
				<td style="text-align: center;">
					<center>
					@if($tmp->verifikasi_ruang_kerja_b == '1')
						Ada	
					@else
						T.Ada
					@endif
					</center>
				</td>
				<td>
					<center>
					@if($tmp->verifikasi_staf_admin != '')
						Ada	
					@else
						T.Ada
					@endif
					</center>
				</td>
				<td>
					<center>
					@if($tmp->verifikasi_papan_nama == '1')
						Ada	
					@else
						T.Ada
					@endif
					</center>
				</td>
				<td style="text-align: center;">
					<center>
					@if($tmp->verifikasi_preswapres == '1')
						Ada	
					@else
						T.Ada
					@endif
					</center>
				</td>
				<td style="text-align: center;">
					<center>
					@if($tmp->verifikasi_garuda == '1')
						Ada	
					@else
						T.Ada
					@endif
					</center>
				</td>
				<td style="text-align: center;">
					<center>
					@if($tmp->verifikasi_ketum_sekjen == '1')
						Ada	
					@else
						T.Ada
					@endif
					</center>
				</td>
				<td>
					<center>
						@if($tmp->verifikasi_nomer_rekening != '')
							{{ $tmp->verifikasi_nomer_rekening }}	
						@else
							-
						@endif
					</center>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
