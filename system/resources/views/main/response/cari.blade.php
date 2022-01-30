@if($table == 'data_calon')
<table class="table table-striped table-hover">
  <tr>
    <th>No</th>
    <th>Kode Calon</th>
    <th>Nama</th>
    <th>Daerah</th>
    <th>Lokasi</th>
    <th>No Telp</th>
    <th width="150">Aksi</th>
  </tr>
  <?php 
    $no=1; 
  ?>
  @foreach($dataTable as $calon)
  <tr>
    <td><?php echo $no++; ?></td>
    <td>{{$calon->kode_calon}}</td>
    <td width="250">{{$calon->nama_depan_calon}}</td>
    <td>{{$calon->calon_daerah}}</td>
    <td width="200">
    <?php  
    $prov = DB::table('inf_lokasi')
      ->join('data_calon','data_calon.provinsi','=','inf_lokasi.provinsi')
      ->where('inf_lokasi.provinsi',$calon->provinsi)
      ->where('inf_lokasi.kabupaten_kota',00)
      ->get();
    $kab = DB::table('inf_lokasi')
      ->join('data_calon','data_calon.kabupaten_kota','=','inf_lokasi.kabupaten_kota')
      ->where('inf_lokasi.provinsi',$calon->provinsi)
      ->where('inf_lokasi.kabupaten_kota',$calon->kabupaten_kota)
      ->get();
      foreach ($kab as $key) {
        if(count($kab) > 0)
        {
          echo $key->lokasi.', ';
        } else {
          echo $key->lokasi;
        }
      }
      foreach ($prov as $key) {
        echo $key->lokasi;
      }
    ?>
    </td>
    <td>{{$calon->no_telp1}}</td>
    <td>
      <a href="{{asset('edit/calon/'.$calon->id_calon)}}"><div class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span></div></a>
      <div class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></div>
    </td>
  </tr>
  @endforeach
</table>
@elseif($table == 'data_dpd')
<table class="table table-striped table-hover">
  <tr>
    <th>No</th>
    <th>Calon</th>
    <th>Nama Lengkap</th>
    <th>Lokasi</th>
    <th>No Telp</th>
    <th width="150">Aksi</th>
  </tr>
  <?php $no =1; ?>
  @foreach($dataTable as $dpd)
  <tr>
    <td><?php echo $no++; ?></td>
    <td>{{$dpd->nama}}</td>
    <td>{{$dpd->nama_lengkap}}</td>
    <td>{{$dpd->lokasi}}</td>
    <td>{{$dpd->telp1}}</td>
    <td>
      <a href="{{asset('DPD/edit/'.$dpd->id_dpd)}}"><div class="btn-primary btn btn-xs"><span class="glyphicon glyphicon-edit"></span></div></a>
      <div class="btn-danger btn btn-xs"><span class="glyphicon glyphicon-trash"></span></div>
    </td>
  </tr>
  @endforeach
</table>
@endif