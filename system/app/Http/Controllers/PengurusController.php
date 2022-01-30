<?php

namespace App\Http\Controllers;

use DB;
use Input;
use Redirect;
use Illuminate\Http\Request;

/**
 * 
 */
date_default_timezone_set('Asia/Jakarta');
class PengurusController extends Controller
{
	public $allowed = array('png', 'jpg', 'jpeg', 'docx', 'pdf', 'doc', 'xlsx', 'xls');
	/* Fatchur */
	public function viewUser()
	{
		if (session('idRole') == 1) {
			$dataBio = DB::table('m_bio')
				->select('*', 'm_bio.bio_id as id_bio')
				->leftjoin('ref_jk', 'jk_id', '=', 'm_bio.bio_jenis_kelamin')
				->paginate(10);
		} else {
			$dataBio = DB::table('m_bio')
				->select('*', 'm_bio.bio_id as id_bio');
			/*->leftjoin('ref_bio','ref_bio.bio_id','=','m_bio.bio_id')
						->leftjoin('ref_jk','jk_id','=','m_bio.bio_jenis_kelamin')
						->leftjoin('r_bio_dprri','r_bio_dprri.bio_id','=','m_bio.bio_id')
						->leftjoin('r_bio_dprdi','r_bio_dprdi.bio_id','=','m_bio.bio_id')
						->leftjoin('r_bio_dprdii','r_bio_dprdii.bio_id','=','m_bio.bio_id')
						->leftjoin('r_bio_pimda','r_bio_pimda.bio_id','=','m_bio.bio_id')
						->leftjoin('r_bio_pimcab','r_bio_pimcab.bio_id','=','m_bio.bio_id')
						->leftjoin('r_bio_pimcam','r_bio_pimcam.bio_id','=','m_bio.bio_id')
						->leftjoin('r_bio_pimran','r_bio_pimran.bio_id','=','m_bio.bio_id')
						->leftjoin('r_bio_par','r_bio_par.bio_id','=','m_bio.bio_id')
						->leftjoin('r_bio_kpa','r_bio_kpa.bio_id','=','m_bio.bio_id');*/
			switch (session('idRole')) {
				case 3:
					/*$dataBio->leftjoin('ref_bio','ref_bio.bio_id','=','m_bio.bio_id');*/
					$dataBio->leftjoin('ref_jk', 'jk_id', '=', 'm_bio.bio_jenis_kelamin');
					/*$dataBio->leftjoin('r_bio_dprri','r_bio_dprri.bio_id','=','m_bio.bio_id');
						$dataBio->leftjoin('r_bio_dprdi','r_bio_dprdi.bio_id','=','m_bio.bio_id');
						$dataBio->leftjoin('r_bio_dprdii','r_bio_dprdii.bio_id','=','m_bio.bio_id');
						$dataBio->leftjoin('r_bio_pimda','r_bio_pimda.bio_id','=','m_bio.bio_id');
						$dataBio->leftjoin('r_bio_pimcab','r_bio_pimcab.bio_id','=','m_bio.bio_id');
						$dataBio->leftjoin('r_bio_pimcam','r_bio_pimcam.bio_id','=','m_bio.bio_id');
						$dataBio->leftjoin('r_bio_pimran','r_bio_pimran.bio_id','=','m_bio.bio_id');
						$dataBio->leftjoin('r_bio_par','r_bio_par.bio_id','=','m_bio.bio_id');
						$dataBio->leftjoin('r_bio_kpa','r_bio_kpa.bio_id','=','m_bio.bio_id');*/
					$dataBio->orWhere(function ($query) {
						$query->where('bio_area_prov', session('idProvinsi2'));
						$query->orWhere('bio_provinsi', session('idProvinsi2'));
						/*$query->where('r_bio_dprri.geo_prov_id',session('idProvinsi2'))
									  ->orWhere('r_bio_dprdi.geo_prov_id',session('idProvinsi2'))
									  ->orWhere('r_bio_dprdii.geo_prov_id',session('idProvinsi2'))
									  ->orWhere('r_bio_pimda.geo_prov_id',session('idProvinsi2'))
									  ->orWhere('r_bio_pimcab.geo_prov_id',session('idProvinsi2'))
									  ->orWhere('r_bio_pimcam.geo_prov_id',session('idProvinsi2'))
									  ->orWhere('r_bio_pimran.geo_prov_id',session('idProvinsi2'))
									  ->orWhere('r_bio_par.geo_prov_id',session('idProvinsi2'))
									  ->orWhere('r_bio_kpa.geo_prov_id',session('idProvinsi2'))
									  ->orWhere('ref_bio.geo_prov_id',session('idProvinsi2'));*/
					});
					break;
				case 8:
					$dataBio->leftjoin('r_bio_kpa', 'r_bio_kpa.bio_id', '=', 'm_bio.bio_id');
					$dataBio->orWhere(function ($query) {
						$query->orWhere('r_bio_kpa.geo_rt_id', session('idRT'));
					});
					break;
				case 7:
					$dataBio->leftjoin('r_bio_par', 'r_bio_par.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_kpa', 'r_bio_kpa.bio_id', '=', 'm_bio.bio_id');
					$dataBio->orWhere(function ($query) {
						$query->orWhere('r_bio_par.geo_rw_id', session('idRW'))
							->orWhere('r_bio_kpa.geo_rw_id', session('idRW'));
					});
					break;
				case 6:
					$dataBio->leftjoin('r_bio_pimran', 'r_bio_pimran.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_par', 'r_bio_par.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_kpa', 'r_bio_kpa.bio_id', '=', 'm_bio.bio_id');
					$dataBio->orWhere(function ($query) {
						$query->orWhere('r_bio_pimran.geo_deskel_id', session('idKelurahan'))
							->orWhere('r_bio_par.geo_deskel_id', session('idKelurahan'))
							->orWhere('r_bio_kpa.geo_deskel_id', session('idKelurahan'));
					});
					break;
				case 5:
					$dataBio->leftjoin('r_bio_pimcam', 'r_bio_pimcam.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_pimran', 'r_bio_pimran.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_par', 'r_bio_par.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_kpa', 'r_bio_kpa.bio_id', '=', 'm_bio.bio_id');
					$dataBio->orWhere(function ($query) {
						$query->orWhere('r_bio_pimcam.geo_kec_id', session('idKecamatan'))
							->orWhere('r_bio_pimran.geo_kec_id', session('idKecamatan'))
							->orWhere('r_bio_par.geo_kec_id', session('idKecamatan'))
							->orWhere('r_bio_kpa.geo_kec_id', session('idKecamatan'));
					});
					break;
				case 4:
					$dataBio->leftjoin('ref_bio', 'ref_bio.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_dprdii', 'r_bio_dprdii.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_pimda', 'r_bio_pimda.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_pimcab', 'r_bio_pimcab.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_pimcam', 'r_bio_pimcam.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_pimran', 'r_bio_pimran.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_par', 'r_bio_par.bio_id', '=', 'm_bio.bio_id');
					$dataBio->leftjoin('r_bio_kpa', 'r_bio_kpa.bio_id', '=', 'm_bio.bio_id');
					$dataBio->orWhere(function ($query) {
						$query->orWhere('r_bio_dprdii.geo_kab_id', session('idKabupaten'))
							->orWhere('r_bio_pimcab.geo_kab_id', session('idKabupaten'))
							->orWhere('r_bio_pimcam.geo_kab_id', session('idKabupaten'))
							->orWhere('r_bio_pimran.geo_kab_id', session('idKabupaten'))
							->orWhere('r_bio_par.geo_kab_id', session('idKabupaten'))
							->orWhere('r_bio_kpa.geo_kab_id', session('idKabupaten'))
							->orWhere('ref_bio.geo_kab_id', session('idKabupaten'));
					});
					break;
			}
			$dataBio = $dataBio->paginate(10);
		}
		$dataBio->setPath('');

		$getProv = DB::table('m_geo_prov_kpu')->get();
		/*$getKota = DB::table('m_geo_kab_kpu')->get();
			$getKec = DB::table('m_geo_kec_kpu')->get();
			$getKel = DB::table('m_geo_deskel_kpu')->get();*/

		return view('main.anggota.partai.index', array(
			'dataBio' => $dataBio,
			"dataProv" => $getProv/*,
				"dataKota" => $getKota,
				"dataKec"  => $getKec,
				"dataKel"  => $getKel*/
		));
	}
	public function viewAddUser()
	{
		if (session('idLogin')) {
			$dataProvinsi = DB::table('m_geo_prov_kpu')
				->get();
			$dataIdentitas = DB::table('ref_identitas')
				->get();
			$dataPekerjaan = DB::table('ref_pekerjaan')
				->get();
			$dataAgama = DB::table('ref_agama')
				->get();
			$dataJk = DB::table('ref_jk')
				->get();
			$dataStatus = DB::table('ref_status')
				->get();
			return view('main.anggota.partai.add-index', array(
				'dataProvinsi' => $dataProvinsi,
				'dataIdentitas' => $dataIdentitas,
				'dataPekerjaan' => $dataPekerjaan,
				'dataAgama' => $dataAgama,
				'dataJk' => $dataJk,
				'dataStatus' => $dataStatus
			));
		} else {
			return redirect('logout');
		}
	}

	public function saveUser()
	{
		$allowed = array('png', 'jpg', 'jpeg', 'docx', 'pdf', 'doc', 'xlsx', 'xls');
		$statusKader = @$_POST['statusKader'];
		$nomerAnggota = @$_POST['nomerAnggota'];
		$kategoriCalon = @$_POST['kategoriCalon'];
		$namaFoto = '';
		$riwayatHidup = '';
		$visiMisi = '';
		$fotoCopyKtp = '';
		$fotoCopyKk = '';
		$fotoCopyNpwp = '';
		$fotoCopyIjazah = '';
		$skcs = '';
		$ktaPartaiHanura = '';
		$formPendaftaranCalon = '';
		$komitmen = '';
		$bertaqwa = '';
		$tinggal = '';

		$namaDepan = @$_POST['namaDepan'];
		$namaTengah = @$_POST['namaTengah'];
		$namaBelakang = @$_POST['namaBelakang'];
		$identitas = @$_POST['identitas'];
		$noIdentitas = @$_POST['noIdentitas'];
		$tempatLahir = @$_POST['tempatLahir'];
		$tanggalLahir = @$_POST['tanggalLahir'];
		$alamat = @$_POST['alamat'];
		$abProv = @$_POST['abProv'];
		$abKab = @$_POST['abKab'];
		$abKec = @$_POST['abKec'];
		$abKel = @$_POST['abKel'];
		$jenisKelamin = @$_POST['jenisKelamin'];
		$statusPernikahan = @$_POST['statusPernikahan'];
		$namaPasangan = @$_POST['namaPasangan'];
		$jumlahAnak = @$_POST['jumlahAnak'];
		$foto = @$_POST['foto'];
		$agama = @$_POST['agama'];
		$telp = @$_POST['telp'];
		$hp = @$_POST['hp'];
		$emailBalon = @$_POST['emailBalon'];
		$twitter = @$_POST['twitter'];
		$facebook = @$_POST['facebook'];
		$note = @$_POST['note'];
		$createDate = date('Y-m-d H:i:s');

		$prov_ar = @$_POST['s_provinsi'];
		$kab_ar = @$_POST['s_kab'];
		$kec_ar = @$_POST['s_kec'];
		$kel_ar = @$_POST['s_kel'];

		/* Insert Table Biodata */
		$savePendaftaran = DB::table('m_bio')
			->insertGetId([
				'bio_nama_depan' => $namaDepan,
				'bio_nama_tengah' => $namaTengah,
				'bio_nama_belakang' => $namaBelakang,
				'bio_jenis_identitas' => $identitas,
				'bio_nomer_identitas' => $noIdentitas,
				'bio_tempat_lahir' => $tempatLahir,
				'bio_tanggal_lahir' => date('Y-m-d', strtotime($tanggalLahir)),
				'bio_jenis_kelamin' => $jenisKelamin,
				'bio_agama' => $agama,
				'bio_alamat' => $alamat,
				'bio_provinsi' => $abProv,
				'bio_kabupaten' => $abKab,
				'bio_kecamatan' => $abKec,
				'bio_kelurahan' => $abKel,
				'bio_telephone' => $telp,
				'bio_handphone' => $hp,
				'bio_email' => $emailBalon,
				'bio_twitter' => $twitter,
				'bio_facebook' => $facebook,
				'bio_status_kawin' => $statusPernikahan,
				'bio_nama_pasangan' => $namaPasangan,
				'bio_anak' => $jumlahAnak,
				'bio_created_date' => $createDate,

				'bio_area_prov' => $prov_ar,
				'bio_area_kab'  => $kab_ar,
				'bio_area_kec'  => $kec_ar,
				'bio_area_kel'  => $kel_ar,

				'bio_created_by' => session('idLogin')
			]);

		if (Input::hasFile('foto')) {
			$file 	= Input::file('foto');
			if ($file->getSize() <= 2097152) {
				$f_name = $file->getClientOriginalName();
				$exp = explode(".", $f_name);
				$ext = $exp[1];
				if (array_search($ext, $allowed) !== false) {
					$file->move('asset/img/dokumen/' . $savePendaftaran . '/foto/', $file->getClientOriginalName());
					$namaFoto = $file->getClientOriginalName();
					$savePendaftaran = DB::table('m_bio')
						->where('bio_id', $savePendaftaran)
						->update([
							'bio_foto' => $namaFoto
						]);
				}
			} else {
?><script>
					alert("File Anda Terlalu Besar");
				</script><?php
						}
					}

					if (session('status') == 'facebook' || session('status') == 'google' || session('status') == 'quest') {
						if (session('status') == 'quest') {
							$savePendaftaran = DB::table('m_bio')
								->where('bio_id', $savePendaftaran)
								->update([
									'bio_status' => session('status'),
									'bio_flag' => 0
								]);
						} else {
							$savePendaftaran = DB::table('m_bio')
								->where('bio_id', $savePendaftaran)
								->update([
									'bio_' . session('status') . '_id' => session('id'),
									'bio_status' => session('status'),
									'bio_flag' => 0
								]);
						}
					}

					/*Script Save Data Pendidikan*/
					$jml_pendidikan = Input::get('jml_pendidikan');
					for ($i = 1; $i <= $jml_pendidikan; $i++) {
						$tahun_pendidikan[$i] = Input::get('pendidikan_tahun' . $i);
						$keterangan_pendidikan[$i] = Input::get('pendidikan_keterangan' . $i);

						if ($tahun_pendidikan[$i] != '') {
							$savePendidikan = DB::table('m_bio_pendidikan')
								->insertGetId([
									'bio_id' => $savePendaftaran,
									'bio_pendidikan_tahun' => $tahun_pendidikan[$i],
									'bio_pendidikan_keterangan' => $keterangan_pendidikan[$i],
									'bio_pendidikan_created_date' => date('Y-m-d H:i:s'),
									'bio_pendidikan_created_by' => session('idLogin')
								]);
						}
					}
					/*End Script*/

					/*Script Save Data Organisasi*/
					$jml_organisasi = Input::get('jml_organisasi');
					for ($j = 0; $j <= $jml_organisasi; $j++) {
						$tahun_organisasi[$j] = Input::get('organisasi_tahun' . $j);
						$keterangan_organisasi[$j] = Input::get('organisasi_keterangan' . $j);

						if ($tahun_organisasi[$j] != "") {
							$saveOrganisasi = DB::table('m_bio_organisasi')
								->insertGetId([
									'bio_id' => $savePendaftaran,
									'bio_organisasi_tahun' => $tahun_organisasi[$j],
									'bio_organisasi_keterangan' => $keterangan_organisasi[$j],
									'bio_organisasi_created_date' => date('Y-m-d H:i:s'),
									'bio_organisasi_created_by' => session('idLogin')
								]);
						}
					}
					/*End Script*/

					/*Script Save Data Pekerjaan*/
					$jml_pekerjaan = Input::get('jml_pekerjaan');
					for ($k = 0; $k <= $jml_pekerjaan; $k++) {
						$tahun_pekerjaan[$k] = Input::get('pekerjaan_tahun' . $k);
						$keterangan_pekerjaan[$k] = Input::get('pekerjaan_keterangan' . $k);

						if ($tahun_pekerjaan[$k] != '') {
							$savePekerjaan = DB::table('m_bio_pekerjaan')
								->insertGetId([
									'bio_id' => $savePendaftaran,
									'bio_pekerjaan_tahun' => $tahun_pekerjaan[$k],
									'bio_pekerjaan_keterangan' => $keterangan_pekerjaan[$k],
									'bio_pekerjaan_created_date' => date('Y-m-d H:i:s'),
									'bio_pekerjaan_created_by' => session('idLogin')
								]);
						}
					}
					/*End Script*/

					/*Script Save Data Diklat*/
					$jml_diklat = Input::get('jml_diklat');
					for ($l = 0; $l <= $jml_diklat; $l++) {
						$tahun_diklat[$l] = Input::get('diklat_tahun' . $l);
						$keterangan_diklat[$l] = Input::get('diklat_keterangan' . $l);

						if ($tahun_diklat[$l] != "") {
							$saveDiklat = DB::table('m_bio_diklat')
								->insertGetId([
									'bio_id' => $savePendaftaran,
									'bio_diklat_tahun' => $tahun_diklat[$l],
									'bio_diklat_keterangan' => $keterangan_diklat[$l],
									'bio_diklat_created_date' => date('Y-m-d H:i:s'),
									'bio_diklat_created_by' => session('idLogin')
								]);
						}
					}
					/*End Script*/

					/*Script Save Data Perjuangan*/
					$jml_perjuangan = Input::get('jml_perjuangan');
					for ($x = 0; $x <= $jml_perjuangan; $x++) {
						$tahun_perjuangan[$x] = Input::get('perjuangan_tahun' . $x);
						$keterangan_perjuangan[$x] = Input::get('perjuangan_keterangan' . $x);

						if ($tahun_perjuangan[$x] != "") {
							$savePerjuangan = DB::table('m_bio_perjuangan')
								->insertGetId([
									'bio_id' => $savePendaftaran,
									'bio_perjuangan_tahun' => $tahun_perjuangan[$x],
									'bio_perjuangan_keterangan' => $keterangan_perjuangan[$x],
									'bio_perjuangan_created_date' => date('Y-m-d H:i:s'),
									'bio_perjuangan_created_by' => session('idLogin')
								]);
						}
					}
					/*End Script*/

					/*Script Save Penghargaan*/
					$jml_penghargaan = Input::get('jml_penghargaan');
					for ($y = 0; $y <= $jml_penghargaan; $y++) {
						$tahun_penghargaan[$y] = Input::get('penghargaan_tahun' . $y);
						$keterangan_penghargaan[$y] = Input::get('penghargaan_keterangan' . $y);

						if ($tahun_penghargaan[$y] != "") {
							$savePenghargaan = DB::table('m_bio_penghargaan')
								->insertGetId([
									'bio_id' => $savePendaftaran,
									'bio_penghargaan_tahun' => $tahun_penghargaan[$y],
									'bio_penghargaan_keterangan' => $keterangan_penghargaan[$y],
									'bio_penghargaan_created_date' => date('Y-m-d H:i:s'),
									'bio_penghargaan_created_by' => session('idLogin')
								]);
						}
					}
					/*End Script*/


					/* Insert Dokumen Pendukung */
					if (Input::hasFile('filedaftarRiwayatHidup')) {
						$file1 	= Input::file('filedaftarRiwayatHidup');
						if ($file1->getSize() <= 2097152) {
							$f_name = $file1->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file1->move('asset/img/dokumen/' . $savePendaftaran . '/riwayat/', $file1->getClientOriginalName());
								$riwayatHidup = $file1->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('filevisiMisi')) {
						$file2 	= Input::file('filevisiMisi');
						if ($file2->getSize() <= 2097152) {
							$f_name = $file2->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file2->move('asset/img/dokumen/' . $savePendaftaran . '/vm/', $file2->getClientOriginalName());
								$visiMisi = $file2->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('filefotoCopyKtp')) {
						$file3 	= Input::file('filefotoCopyKtp');
						if ($file3->getSize() <= 2097152) {
							$f_name = $file3->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file3->move('asset/img/dokumen/' . $savePendaftaran . '/ktp/', $file3->getClientOriginalName());
								$fotoCopyKtp = $file3->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('filefotoCopyKk')) {
						$file4 	= Input::file('filefotoCopyKk');
						if ($file4->getSize() <= 2097152) {
							$f_name = $file4->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file4->move('asset/img/dokumen/' . $savePendaftaran . '/kk/', $file4->getClientOriginalName());
								$fotoCopyKk = $file4->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('filefotoCopyNpwp')) {
						$file5 	= Input::file('filefotoCopyNpwp');
						if ($file5->getSize() <= 2097152) {
							$f_name = $file5->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file5->move('asset/img/dokumen/' . $savePendaftaran . '/npwp/', $file5->getClientOriginalName());
								$fotoCopyNpwp = $file5->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('filefotoCopyIjazah')) {
						$file6 	= Input::file('filefotoCopyIjazah');
						if ($file6->getSize() <= 2097152) {
							$f_name = $file6->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file6->move('asset/img/dokumen/' . $savePendaftaran . '/ijazah/', $file6->getClientOriginalName());
								$fotoCopyIjazah = $file6->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('fileskcs')) {
						$file7 	= Input::file('fileskcs');
						if ($file7->getSize() <= 2097152) {
							$f_name = $file7->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file7->move('asset/img/dokumen/' . $savePendaftaran . '/skcs/', $file7->getClientOriginalName());
								$skcs = $file7->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('filektaPartaiHanura')) {
						$file8 	= Input::file('filektaPartaiHanura');
						if ($file8->getSize() <= 2097152) {
							$f_name = $file8->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file8->move('asset/img/dokumen/' . $savePendaftaran . '/kta/', $file8->getClientOriginalName());
								$ktaPartaiHanura = $file8->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('fileformPendaftaranCalon')) {
						$file9 	= Input::file('fileformPendaftaranCalon');
						if ($file9->getSize() <= 2097152) {
							$f_name = $file9->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file9->move('asset/img/dokumen/' . $savePendaftaran . '/form/', $file9->getClientOriginalName());
								$formPendaftaranCalon = $file9->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('filekomitmen')) {
						$file10 	= Input::file('filekomitmen');
						if ($file10->getSize() <= 2097152) {
							$f_name = $file10->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file10->move('asset/img/dokumen/' . $savePendaftaran . '/komitmen/', $file10->getClientOriginalName());
								$komitmen = $file10->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('filebertaqwa')) {
						$file11 	= Input::file('filebertaqwa');
						if ($file11->getSize() <= 2097152) {
							$f_name = $file11->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file11->move('asset/img/dokumen/' . $savePendaftaran . '/bertaqwa/', $file11->getClientOriginalName());
								$bertaqwa = $file11->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}
					if (Input::hasFile('filetinggal')) {
						$file12 	= Input::file('filetinggal');
						if ($file12->getSize() <= 2097152) {
							$f_name = $file12->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file12->move('asset/img/dokumen/' . $savePendaftaran . '/tinggal/', $file12->getClientOriginalName());
								$tinggal = $file12->getClientOriginalName();
							}
						} else { ?><script>
					alert("File Anda Terlalu Besar");
				</script><?php }
					}

					$saveDokumen = DB::table('m_bio_doc')
						->insertGetId([
							'bio_id' => $savePendaftaran,
							'bio_doc_riwayat' => $riwayatHidup,
							'bio_doc_visi' => $visiMisi,
							'bio_doc_ktp' => $fotoCopyKtp,
							'bio_doc_kk' => $fotoCopyKk,
							'bio_doc_npwp' => $fotoCopyNpwp,
							'bio_doc_ijazah' => $fotoCopyIjazah,
							'bio_doc_skck' => $skcs,
							'bio_doc_kta' => $ktaPartaiHanura,
							'bio_doc_pendaftaran' => $formPendaftaranCalon,
							'bio_doc_komitmen' => $komitmen,
							'bio_doc_pernyataan' => $bertaqwa,
							'bio_doc_nkri' => $tinggal,
							'bio_doc_note' => $note,
							'bio_doc_created_date' => $createDate,
							'bio_doc_created_date' => session('idLogin')
						]);

					if (session('idRole') == 3) {
						$prov = session('idProvinsi2');
					}
					if (session('idRole') == 4) {
						$prov = session('idProvinsi2');
						$kab = session('idKabupaten');
					}

					if (session('idRole') >= 3) {
						if (session('idRole') == 3) {
							DB::table('ref_bio')
								->insertGetId([
									'bio_id' => $savePendaftaran,
									'geo_prov_id' => $prov
								]);
						} elseif (session('idRole') == 4) {
							DB::table('ref_bio')
								->insertGetId([
									'bio_id' => $savePendaftaran,
									'geo_prov_id' => $prov,
									'geo_kab_id' => $kab
								]);
						}
					}

					return redirect('anggota/partai/list');
				}

				public function getDataUser($bioId)
				{
					$dataProvinsi = array();
					$dataKabupatenLahir = array();
					$dataKabupaten = array();
					$dataKecamatan = array();
					$dataKelurahan = array();
					$dataRW = array();
					$dataBio = DB::table('m_bio')
						->select('m_bio.*', 'm_bio_doc.*', 'm_bio.bio_id as id_bio', 'm_geo_prov_kpu.geo_prov_id as prov_lahir', 'ref_status.status_value')
						->leftjoin('ref_status', 'ref_status.status_id', '=', 'm_bio.bio_status_kawin')
						->leftjoin('m_geo_kab_kpu', 'm_geo_kab_kpu.geo_kab_id', '=', 'm_bio.bio_tempat_lahir')
						->leftjoin('m_geo_prov_kpu', 'm_geo_prov_kpu.geo_prov_id', '=', 'm_geo_kab_kpu.geo_prov_id')
						->leftjoin('m_bio_doc', 'm_bio_doc.bio_id', '=', 'm_bio.bio_id')
						->where('m_bio.bio_id', $bioId)
						->get();
					foreach ($dataBio as $tmp) {
						$dataProvinsi = DB::table('m_geo_prov_kpu')
							->get();
						$dataKabupatenLahir = DB::table('m_geo_kab_kpu')
							->where('geo_prov_id', $tmp->prov_lahir)
							->get();
						$dataKabupaten = DB::table('m_geo_kab_kpu')
							->where('geo_prov_id', $tmp->bio_provinsi)
							->get();
						$dataKecamatan = DB::table('m_geo_kec_kpu')
							->where('geo_kab_id', $tmp->bio_kabupaten)
							->get();
						$dataKelurahan = DB::table('m_geo_deskel_kpu')
							->where('geo_kec_id', $tmp->bio_kecamatan)
							->get();
						$dataRW = DB::table('m_geo_rw')
							->where('geo_deskel_id', $tmp->bio_kelurahan)
							->get();
					}
					$dataIdentitas = DB::table('ref_identitas')
						->get();
					$dataPekerjaan = DB::table('ref_pekerjaan')
						->get();
					$dataAgama = DB::table('ref_agama')
						->get();
					$dataJk = DB::table('ref_jk')
						->get();
					$dataStatus = DB::table('ref_status')
						->get();

					$dataPendidikan = DB::table('m_bio_pendidikan')
						->where('bio_id', $bioId)
						->get();
					$dataOrganisasi = DB::table('m_bio_organisasi')
						->where('bio_id', $bioId)
						->get();
					$dataPekerjaan = DB::table('m_bio_pekerjaan')
						->where('bio_id', $bioId)
						->get();
					$dataDiklat = DB::table('m_bio_diklat')
						->where('bio_id', $bioId)
						->get();
					$dataPerjuangan = DB::table('m_bio_perjuangan')
						->where('bio_id', $bioId)
						->get();
					$dataPenghargaan = DB::table('m_bio_penghargaan')
						->where('bio_id', $bioId)
						->get();
					//var_dump($dataDokumen[0])	;
					//print_r(json_encode($dataDokumen));

					return view('main.anggota.partai.edit_index', array(
						'dataBio' => $dataBio,
						'dataPendidikan' => $dataPendidikan,
						'dataOrganisasi' => $dataOrganisasi,
						'dataPekerjaan' => $dataPekerjaan,
						'dataDiklat' => $dataDiklat,
						'dataPerjuangan' => $dataPerjuangan,
						'dataPenghargaan' => $dataPenghargaan,
						'dataProvinsi' => $dataProvinsi,
						'dataKabupatenLahir' => $dataKabupatenLahir,
						'dataKabupaten' => $dataKabupaten,
						'dataKecamatan' => $dataKecamatan,
						'dataKelurahan' => $dataKelurahan,
						'dataRW' => $dataRW,
						'dataIdentitas' => $dataIdentitas,
						'dataPekerjaan' => $dataPekerjaan,
						'dataAgama' => $dataAgama,
						'dataJk' => $dataJk,
						'dataStatus' => $dataStatus
					));
					// return json_encode($dataBio);
				}
				public function saveEditUser()
				{
					$allowed = array('png', 'jpg', 'jpeg', 'docx', 'pdf', 'doc', 'xlsx', 'xls');
					$bio_id = @$_POST['bio_id'];
					$statusKader = @$_POST['statusKader'];
					$nomerAnggota = @$_POST['nomerAnggota'];
					$kategoriCalon = @$_POST['kategoriCalon'];
					$namaFoto = '';
					$riwayatHidup = '';
					$visiMisi = '';
					$fotoCopyKtp = '';
					$fotoCopyKk = '';
					$fotoCopyNpwp = '';
					$fotoCopyIjazah = '';
					$skcs = '';
					$ktaPartaiHanura = '';
					$formPendaftaranCalon = '';
					$komitmen = '';
					$bertaqwa = '';
					$tinggal = '';

					$namaDepan = @$_POST['namaDepan'];
					$namaTengah = @$_POST['namaTengah'];
					$namaBelakang = @$_POST['namaBelakang'];
					$identitas = @$_POST['identitas'];
					$noIdentitas = @$_POST['noIdentitas'];
					$tempatLahir = @$_POST['tempatLahir'];
					$tanggalLahir = @$_POST['tanggalLahir'];
					$alamat = @$_POST['alamat'];
					$abProv = @$_POST['abProv'];
					$abKab = @$_POST['abKab'];
					$abKec = @$_POST['abKec'];
					$abKel = @$_POST['abKel'];
					$jenisKelamin = @$_POST['jenisKelamin'];
					$statusPernikahan = @$_POST['statusPernikahan'];
					$namaPasangan = @$_POST['namaPasangan'];
					$jumlahAnak = @$_POST['jumlahAnak'];
					$foto = @$_POST['foto'];
					$agama = @$_POST['agama'];
					$telp = @$_POST['telp'];
					$hp = @$_POST['hp'];
					$emailBalon = @$_POST['emailBalon'];
					$twitter = @$_POST['twitter'];
					$facebook = @$_POST['facebook'];
					$note = @$_POST['note'];
					$createDate = date('Y-m-d H:i:s');

					if (Input::hasFile('foto')) {
						$file 	= Input::file('foto');
						if ($file->getSize() <= 2097152) {
							$f_name = $file->getClientOriginalName();
							$exp = explode(".", $f_name);
							$ext = $exp[1];
							if (array_search($ext, $allowed) !== false) {
								$file->move('asset/img/dokumen/' . $bio_id . '/foto/', $file->getClientOriginalName());
								$namaFoto = $file->getClientOriginalName();
								$savePendaftaran = DB::table('m_bio')
									->where('bio_id', $bio_id)
									->update([
										'bio_foto' => $namaFoto
									]);
							}
						} else {
							?><script>
					alert("File Anda Terlalu Besar");
				</script><?php
						}
					}

					/* Insert Table Biodata */
					$savePendaftaran = DB::table('m_bio')
						->where('bio_id', $bio_id)
						->update([
							'bio_nama_depan' => $namaDepan,
							'bio_nama_tengah' => $namaTengah,
							'bio_nama_belakang' => $namaBelakang,
							'bio_jenis_identitas' => $identitas,
							'bio_nomer_identitas' => $noIdentitas,
							'bio_tempat_lahir' => $tempatLahir,
							'bio_tanggal_lahir' => date('Y-m-d', strtotime($tanggalLahir)),
							'bio_jenis_kelamin' => $jenisKelamin,
							'bio_agama' => $agama,
							'bio_alamat' => $alamat,
							'bio_provinsi' => $abProv,
							'bio_kabupaten' => $abKab,
							'bio_kecamatan' => $abKec,
							'bio_kelurahan' => $abKel,
							'bio_telephone' => $telp,
							'bio_handphone' => $hp,
							'bio_email' => $emailBalon,
							'bio_twitter' => $twitter,
							'bio_facebook' => $facebook,
							'bio_status_kawin' => $statusPernikahan,
							'bio_nama_pasangan' => $namaPasangan,
							'bio_anak' => $jumlahAnak
						]);


					/*Script Save Data Pendidikan*/
					$jenisRiwayat = ['pendidikan', 'organisasi', 'pekerjaan', 'diklat', 'perjuangan', 'penghargaan'];
					for ($a = 0; $a < count($jenisRiwayat); $a++) {
						$prosesDelete = DB::table('m_bio_' . $jenisRiwayat[$a])
							->where('bio_id', $bio_id)
							->delete();

						$jmlRiwayat = Input::get('jml_' . $jenisRiwayat[$a]);
						for ($i = 1; $i <= $jmlRiwayat; $i++) {
							$tahunRiwayat[$i] = Input::get($jenisRiwayat[$a] . '_tahun' . $i);
							$keteranganRiwayat[$i] = Input::get($jenisRiwayat[$a] . '_keterangan' . $i);

							if ($tahunRiwayat[$i] != '') {
								$prosesSave = DB::table('m_bio_' . $jenisRiwayat[$a])
									->insertGetId([
										'bio_id' => $bio_id,
										'bio_' . $jenisRiwayat[$a] . '_tahun' => $tahunRiwayat[$i],
										'bio_' . $jenisRiwayat[$a] . '_keterangan' => $keteranganRiwayat[$i],
										'bio_' . $jenisRiwayat[$a] . '_created_date' => date('Y-m-d H:i:s'),
										'bio_' . $jenisRiwayat[$a] . '_created_by' => session('idLogin')
									]);
							}
						}
					}
					/*End Script*/


					/* Insert Dokumen Pendukung */
					$jenisDokumenFile = ['filedaftarRiwayatHidup', 'filevisiMisi', 'filefotoCopyKtp', 'filefotoCopyKk', 'filefotoCopyNpwp', 'filefotoCopyIjazah', 'fileskcs', 'filektaPartaiHanura', 'fileformPendaftaranCalon', 'filekomitmen', 'filebertaqwa', 'filetinggal'];
					$jenisDokumenLocation = ['riwayat', 'visi', 'ktp', 'kk', 'npwp', 'ijazah', 'skck', 'kta', 'pendaftaran', 'komitmen', 'pernyataan', 'nkri'];
					for ($a = 0; $a < count($jenisDokumenFile); $a++) {
						if (Input::hasFile($jenisDokumenFile[$a])) {
							$file 	= Input::file($jenisDokumenFile[$a]);
							if ($file->getSize() <= 2097152) {
								$f_name = $file1->getClientOriginalName();
								$exp = explode(".", $f_name);
								$ext = $exp[1];
								if (array_search($ext, $allowed) != "") {
									$file->move('asset/img/dokumen/' . $bio_id . '/' . $jenisDokumenLocation[$a] . '/', $file->getClientOriginalName());
									$namaFile = $file->getClientOriginalName();

									$dataDokumenUpdate['bio_doc_' . $jenisDokumenLocation[$a]] = $namaFile;
								}
							} else { ?><script>
						alert("File Anda Terlalu Besar");
					</script><?php }
						}
					}

					$dataDokumenUpdate['bio_doc_note'] = $note;
					$dataDokumenUpdate['bio_id'] = $bio_id;
					$dataDokumenUpdate['bio_doc_created_by'] = session('idLogin');
					$dataDokumenUpdate['bio_doc_created_date'] = date('Y-m-d H:i:s');

					$saveDokumen = DB::table('m_bio_doc')
						->where('bio_id', $bio_id)
						->delete();

					$saveDokumen = DB::table('m_bio_doc')
						->insertGetId($dataDokumenUpdate);

					return redirect('anggota/partai/list');
				}

				public function viewEksekutif()
				{
					$dataMaster[] = '';

					$data = DB::table('r_bio_eksekutif')
						->join('m_eksekutif', 'm_eksekutif.eksekutif_id', '=', 'r_bio_eksekutif.eksekutif_id')
						->join('m_bio', 'm_bio.bio_id', '=', 'r_bio_eksekutif.bio_id')
						->leftJoin('m_bio_sk', 'm_bio_sk.bio_id', '=', 'm_bio.bio_id')
						->leftJoin('m_bio_kta', 'm_bio_kta.bio_id', '=', 'm_bio.bio_id')
						->paginate(30);


					$eksekutif = DB::table('m_eksekutif')
						->whereNull('eksekutif_status')
						->get();
					$provinsi = DB::table('m_geo_prov_kpu')
						->select('geo_prov_nama', 'geo_prov_id')
						->get();

					$breadcrumb = ['Pendaftaran Anggota', 'Daftar Anggota Legislatif'];
					$SK_Baru = "-";
					$dataMaster = [
						'data' => $data,
						'eksekutif' => $eksekutif,
						'provinsi' => $provinsi,
						'selected' => ['', '', '', '', ''],
						'breadcrumb' => $breadcrumb,
						"sk_baru"   => $SK_Baru
					];

					return view('main.anggota.eksekutif.index', $dataMaster);
				}

				public function actionCUEksekutif($edit = '')
				{
					$data['eksekutif_id'] = $_POST['eksekutif'];
					$data['bio_id'] = $_POST['bio'];
					$data['bio_eksekutif_created_date'] = date('Y-m-d H:i:s');
					$data['bio_eksekutif_created_by'] = session('idLogin');


					if ($edit == '') {
						$prosesEdit = DB::table('m_eksekutif')
							->where('eksekutif_id', $data['eksekutif_id'])
							->update(['eksekutif_status' => true]);

						$prosesInsert = DB::table('r_bio_eksekutif')
							->insertGetId($data);
					} else {
						$prosesInsert = DB::table('r_bio_eksekutif')
							->where('eksekutif_id', $edit)
							->update($data);
					}

					return redirect()->back();
				}

				public function viewPengurus($type, $prov = null, $kab = null, $kec = null, $deskel = null, $rw = null)
				{
					if (session('idRole') == 3) {
						$prov = session('idProvinsi2');
					}
					if (session('idRole') == 4) {
						$prov = session('idProvinsi2');
						$kab = session('idKabupaten');
					}

					/*$urlP .= $type;*/
					$urlP = "$type";

					$showIndex = False;

					$join_r_bio = DB::table('m_bio')
						->select(
							'*',
							'm_bio.bio_id as bio_id',
							DB::raw('CONCAT_WS(" ",bio_nama_depan,bio_nama_tengah,bio_nama_belakang) as nama'),
							'm_bio.bio_telephone as no_telp',
							'm_bio.bio_handphone as no_hp',
							'm_bio.bio_jenis_kelamin as gender',
							'm_bio.bio_email as email',
							'm_bio.bio_nomer_identitas',
							'm_bio_sk.bio_sk_no as no_sk',
							'm_bio_sk.bio_sk_tgl as tgl_sk',
							'm_bio_kta.bio_kta_no as no_kta',
							'r_bio_' . $type . '.bio_' . $type . '_id as r_bio_id',
							'r_bio_' . $type . '.bio_id as idBio'
						);

					$join_r_bio->addselect(
						'r_bio_' . $type . '.bio_' . $type . '_sk as no_sk2',
						'r_bio_' . $type . '.bio_' . $type . '_kta as no_kta2',
						'r_bio_' . $type . '.bio_' . $type . '_tgl as turun_sk',
						'r_bio_' . $type . '.bio_nama as nama_anggota',
						'r_bio_' . $type . '.bio_id as id_anggota',
						'm_struk_' . $type . '.struk_' . $type . '_nama as nama_jabatan',
						'm_struk_' . $type . '.struk_' . $type . '_id as jabatan_id'
					);

					$join_r_bio->rightJoin('r_bio_' . $type, 'r_bio_' . $type . '.bio_id', '=', 'm_bio.bio_id');
					$join_r_bio->leftJoin('m_bio_sk', 'm_bio_sk.bio_id', '=', 'm_bio.bio_id');
					$join_r_bio->leftJoin('m_bio_kta', 'm_bio_kta.bio_id', '=', 'm_bio.bio_id');
					$join_r_bio->leftJoin('m_struk_' . $type, 'm_struk_' . $type . '.struk_' . $type . '_id', '=', 'r_bio_' . $type . '.struk_' . $type . '_id');


					if ($type == 'pimnas') {
					} else if ($type == 'pimda') {
						$join_r_bio->join('m_geo_prov_kpu', 'm_geo_prov_kpu.geo_prov_id', '=', 'r_bio_' . $type . '.geo_prov_id');
					} else if ($type == 'pimcab') {
						$join_r_bio->join('m_geo_kab_kpu', 'm_geo_kab_kpu.geo_kab_id', '=', 'r_bio_' . $type . '.geo_kab_id');
						$join_r_bio->join('m_geo_prov_kpu', 'm_geo_prov_kpu.geo_prov_id', '=', 'r_bio_' . $type . '.geo_prov_id');
					} else if ($type == 'pimcam') {
						$join_r_bio->join('m_geo_kec_kpu', 'm_geo_kec_kpu.geo_kec_id', '=', 'r_bio_' . $type . '.geo_kec_id');
						$join_r_bio->join('m_geo_kab_kpu', 'm_geo_kab_kpu.geo_kab_id', '=', 'r_bio_' . $type . '.geo_kab_id');
						$join_r_bio->join('m_geo_prov_kpu', 'm_geo_prov_kpu.geo_prov_id', '=', 'r_bio_' . $type . '.geo_prov_id');
					} else if ($type == 'pr') {
						$join_r_bio->join('m_geo_deskel_kpu', 'm_geo_deskel_kpu.geo_deskel_id', '=', 'r_bio_' . $type . '.geo_deskel_id');
						$join_r_bio->join('m_geo_kec_kpu', 'm_geo_kec_kpu.geo_kec_id', '=', 'r_bio_' . $type . '.geo_kec_id');
						$join_r_bio->join('m_geo_kab_kpu', 'm_geo_kab_kpu.geo_kab_id', '=', 'r_bio_' . $type . '.geo_kab_id');
						$join_r_bio->join('m_geo_prov_kpu', 'm_geo_prov_kpu.geo_prov_id', '=', 'r_bio_' . $type . '.geo_prov_id');
					} else if ($type == 'par') {
						$join_r_bio->join('m_geo_rw', 'm_geo_rw.geo_rw_id', '=', 'r_bio_' . $type . '.geo_rw_id');
						$join_r_bio->join('m_geo_deskel_kpu', 'm_geo_deskel_kpu.geo_deskel_id', '=', 'r_bio_' . $type . '.geo_deskel_id');
						$join_r_bio->join('m_geo_kec_kpu', 'm_geo_kec_kpu.geo_kec_id', '=', 'r_bio_' . $type . '.geo_kec_id');
						$join_r_bio->join('m_geo_kab_kpu', 'm_geo_kab_kpu.geo_kab_id', '=', 'r_bio_' . $type . '.geo_kab_id');
						$join_r_bio->join('m_geo_prov_kpu', 'm_geo_prov_kpu.geo_prov_id', '=', 'r_bio_' . $type . '.geo_prov_id');
					} else if ($type == 'kpa') {
						$join_r_bio->join('m_geo_rt', 'm_geo_rt.geo_rt_id', '=', 'r_bio_' . $type . '.geo_rt_id');
						$join_r_bio->join('m_geo_rw', 'm_geo_rw.geo_rw_id', '=', 'r_bio_' . $type . '.geo_rw_id');
						$join_r_bio->join('m_geo_deskel_kpu', 'm_geo_deskel_kpu.geo_deskel_id', '=', 'r_bio_' . $type . '.geo_deskel_id');
						$join_r_bio->join('m_geo_kec_kpu', 'm_geo_kec_kpu.geo_kec_id', '=', 'r_bio_' . $type . '.geo_kec_id');
						$join_r_bio->join('m_geo_kab_kpu', 'm_geo_kab_kpu.geo_kab_id', '=', 'r_bio_' . $type . '.geo_kab_id');
						$join_r_bio->join('m_geo_prov_kpu', 'm_geo_prov_kpu.geo_prov_id', '=', 'r_bio_' . $type . '.geo_prov_id');
					}

					if ($type == "pimnas") {
						$based_on = Input::get('based_on');
						$keyword = Input::get('keyword');

						if ($based_on == "nama") {
							/*echo $based_on." ".$keyword;*/
							$join_r_bio->where(DB::raw('CONCAT_WS(" ",bio_nama_depan,bio_nama_tengah,bio_nama_belakang)'), 'LIKE', DB::Raw('"%' . $keyword . '%"'));
						} else if ($based_on == "jabatan") {
							$join_r_bio->where('m_struk_' . $type . '.struk_' . $type . '_nama', 'LIKE', DB::Raw('"%' . $keyword . '%"'));
						} else if ($based_on == "no_kta") {
							$join_r_bio->where('r_bio_' . $type . '.bio_' . $type . '_kta', 'LIKE', DB::Raw('"%' . $keyword . '%"'));
						} else if ($based_on == "no_ktp") {
							$join_r_bio->where('m_bio.bio_nomer_identitas', 'LIKE', DB::Raw('"%' . $keyword . '%"'));
						} else if ($based_on == "no_sk") {
							$join_r_bio->where('r_bio_' . $type . '.bio_' . $type . '_sk', 'LIKE', DB::Raw('"%' . $keyword . '%"'));
						} else {
						}
					}

					if ($rw != "") {
						$join_r_bio->where('r_bio_' . $type . '.geo_rw_id', '=', $rw);
					}

					if ($deskel != "") {
						$join_r_bio->where('r_bio_' . $type . '.geo_deskel_id', '=', $deskel);
					}

					if ($kec != "") {
						$join_r_bio->where('r_bio_' . $type . '.geo_kec_id', '=', $kec);
						$join_r_bio->addselect('m_geo_kec_kpu.geo_kec_nama', 'm_geo_kec_kpu.geo_kec_id');
					}

					if ($kab != "") {
						$join_r_bio->where('r_bio_' . $type . '.geo_kab_id', '=', $kab);
						$join_r_bio->addselect('m_geo_kab_kpu.geo_kab_nama', 'm_geo_kab_kpu.geo_kab_id');
					}

					if ($prov) {
						$join_r_bio->where('r_bio_' . $type . '.geo_prov_id', '=', $prov);
						$join_r_bio->addselect('m_geo_prov_kpu.geo_prov_nama', 'm_geo_prov_kpu.geo_prov_id');
					}

					/* if($type != 'pimnas') {
				$join_r_bio->where('m_struk_'.$type.'.struk_'.$type.'_nama','=',"Ketua");		
			} */

					$data = $join_r_bio->paginate(10);
					$provinsi = DB::table('m_geo_prov_kpu')
						->select('geo_prov_nama', 'geo_prov_id')
						->get();

					$provnya = session('idProvinsi2');
					$provsession = DB::table('m_geo_prov_kpu')
						->where('geo_prov_id', $provnya)
						->get();

					$breadcrumb = ['Pendaftaran Anggota', 'Daftar Pengurus Organisasi', strtoupper($type)];

					if ($type == "pimnas") {
						$SK_Baru = '-';
					}

					if ($type == "pimda") {
						if ($type == "pimda" && $prov != "") {
							$getSK = DB::table('ref_sk_cek')
								->where('tingkatan_pengurus', $type)
								->where('tingkat_provinsi', $prov)
								->count();
							if ($getSK == 1) {
								$SK_Baru = "YA";
							} else {
								$SK_Baru = "TIDAK";
							}
						} else {
							$SK_Baru = "-";
						}
					}

					if ($type == "pimcab") {
						if ($type == "pimcab" && $kab != "") {
							$getSK = DB::table('ref_sk_cek')
								->where('tingkatan_pengurus', $type)
								->where('tingkat_provinsi', $prov)
								->where('tingkat_kabupaten', $kab)
								->count();
							if ($getSK == 1) {
								$SK_Baru = "YA";
							} else {
								$SK_Baru = "TIDAK";
							}
						} else {
							$SK_Baru = "-";
						}
					}

					if ($type == "pimcam") {
						if ($type == "pimcam" && $kec != "") {
							$getSK = DB::table('ref_sk_cek')
								->where('tingkatan_pengurus', $type)
								->where('tingkat_provinsi', $prov)
								->where('tingkat_kabupaten', $kab)
								->where('tingkat_kecamatan', $kec)
								->count();
							if ($getSK == 1) {
								$SK_Baru = "YA";
							} else {
								$SK_Baru = "TIDAK";
							}
						} else {
							$SK_Baru = "-";
						}
					}

					if ($type == "pimran") {
						if ($type == "pimran" && $deskel != "") {
							$getSK = DB::table('ref_sk_cek')
								->where('tingkatan_pengurus', $type)
								->where('tingkat_provinsi', $prov)
								->where('tingkat_kabupaten', $kab)
								->where('tingkat_kecamatan', $kec)
								->where('tingkat_kelurahan', $deskel)
								->count();
							if ($getSK == 1) {
								$SK_Baru = "YA";
							} else {
								$SK_Baru = "TIDAK";
							}
						} else {
							$SK_Baru = "-";
						}
					}

					if ($type == "par") {
						if ($type == "par" && $rw != "") {
							$getSK = DB::table('ref_sk_cek')
								->where('tingkatan_pengurus', $type)
								->where('tingkat_provinsi', $prov)
								->where('tingkat_kabupaten', $kab)
								->where('tingkat_kecamatan', $kec)
								->where('tingkat_kelurahan', $deskel)
								->count();
							if ($getSK == 1) {
								$SK_Baru = "YA";
							} else {
								$SK_Baru = "TIDAK";
							}
						} else {
							$SK_Baru = "-";
						}
					}

					if ($type == "kpa") {
						if ($type == "pr" && $deskel != "") {
							$getSK = DB::table('ref_sk_cek')
								->where('tingkatan_pengurus', $type)
								->where('tingkat_provinsi', $prov)
								->where('tingkat_kabupaten', $kab)
								->where('tingkat_kecamatan', $kec)
								->where('tingkat_kelurahan', $deskel)
								->count();
							if ($getSK == 1) {
								$SK_Baru = "YA";
							} else {
								$SK_Baru = "TIDAK";
							}
						} else {
							$SK_Baru = "-";
						}
					}

					$masterData = [
						'dataUsers' => $this->getData('cl_admin'),
						'data' => $data,
						'type' => $type,
						'provinsi' => $provinsi,
						'provsession' => $provsession,
						'selected' => [$prov, $kab, $kec, $deskel, $rw],
						'breadcrumb' => $breadcrumb,
						'dataDapil' => @$dataDapil,
						'urlPrintExcel' => "",
						"sk_baru"   => $SK_Baru
					];
					($type != "") ? $masterData['a_type'] = $type : $masterData['a_type'] = "";
					($prov != "") ? $masterData['a_prov'] = $prov : $masterData['a_prov'] = "";
					($kab != "") ? $masterData['a_kab'] = $kab : $masterData['a_kab'] = "";
					($kec != "") ? $masterData['a_kec'] = $kec : $masterData['a_kec'] = "";
					($deskel != "") ? $masterData['a_deskel'] = $deskel : $masterData['a_deskel'] = "";
					($rw != "") ? $masterData['a_rw'] = $rw : $masterData['a_rw'] = "";

					if ($prov != "") {
						$masterData['kabupaten'] = DB::table('m_geo_kab_kpu')
							->select('geo_kab_nama', 'geo_kab_id')
							->where('geo_prov_id', '=', $prov)
							->get();
						/*echo "INI PROV : ".$prov;*/
					}

					if ($kab) {
						$masterData['kabupaten'] = DB::table('m_geo_kab_kpu')
							->select('geo_kab_nama', 'geo_kab_id')
							->where('geo_prov_id', '=', $prov)
							->get();
					}

					if ($kec) {
						$masterData['kecamatan'] = DB::table('m_geo_kec_kpu')
							->select('geo_kec_nama', 'geo_kec_id')
							->where('geo_kab_id', '=', $kab)
							->get();
					}

					if ($deskel) {
						$masterData['kelurahan'] = DB::table('m_geo_deskel_kpu')
							->select('geo_deskel_nama', 'geo_deskel_id')
							->where('geo_kec_id', '=', $kec)
							->get();
					}

					if ($rw) {
						$masterData['rukunwarga'] = DB::table('m_geo_rw_kpu')
							->select('geo_rw_nama', 'geo_rw_id')
							->where('geo_deskel_id', '=', $deskel)
							->get();
					}


					$masterData['test'] = [];
					foreach ($provinsi as $row) {
						$masterData['kabn'][] = DB::table('r_bio_pimcab')
							->select(DB::raw('geo_kab_nama,count(bio_pimcab_id) as jml_pimcab'))
							->leftJoin('m_geo_kab', 'm_geo_kab.geo_kab_id', '=', 'r_bio_pimcab.geo_kab_id')
							->groupBy('r_bio_pimcab.geo_kab_id')
							->where('r_bio_pimcab.geo_prov_id', '=', $row->geo_prov_id)
							->get();
					}
					$masterData['test'] = DB::table('r_bio_pimcab')
						->select(DB::raw('COALESCE(count(*),0) as jml'))
						->rightJoin('m_geo_prov', 'm_geo_prov.geo_prov_id', '=', 'r_bio_pimcab.geo_prov_id')
						->groupBy('m_geo_prov.geo_prov_id')
						//->where('m_geo_prov.geo_prov_id','=',$row->geo_prov_id)
						->get();
					$masterData['countstruktot'] = DB::table('m_struk_pimcab')
						->select(DB::raw('count(*) as jml'))
						->groupBy('geo_prov_id')
						//->where('geo_prov_id','=',$row->geo_prov_id)
						->get();

					$masterData['countkab'] = DB::table('m_geo_kab')
						->select(DB::raw('count(*) as jml'))
						->groupBy('geo_prov_id')
						//->where('geo_prov_id','=',$row->geo_prov_id)
						->get();
					$masterData['countstrukav'] = DB::table('m_struk_pimcab')
						->select(DB::raw('count(m_struk_pimcab.struk_pimcab_id) as jml'))
						->rightJoin('m_geo_prov', function ($join) {
							$join->on('m_geo_prov.geo_prov_id', '=', 'm_struk_pimcab.geo_prov_id');
							$join->whereNull('dijabat');
						})->groupBy('m_geo_prov.geo_prov_id')
						->get();


					if ($type == 'pimnas' || $type == "par" || $type == "kpa" || $type == "pimran" || $type == "pimda") {
						return view('main.anggota.organisasis.' . $type, $masterData);
					} else {
						return view('main.anggota.organisasi.index_' . $type, $masterData);
					}
				}
				/* Fatchur */

				/* Erwin */
				public function loadSearch()
				{
					echo "DIE";
				}
				/* End */
			}
