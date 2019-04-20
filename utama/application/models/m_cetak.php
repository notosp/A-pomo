<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cetak extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('m_data');
    }

	// ======================================================================================
	// # Fungsi cetak QRCode
	// ======================================================================================
	function cetakQRCode($nisn, $nama)
	{
		// Panggil Library QRCode
		$this->load->library('ciqrcode');
		$config['cacheable']	= true;						//boolean, the default is true
		$config['cachedir']		= '';						//string, the default is application/cache/
		$config['errorlog']		= '';						//string, the default is application/logs/
		$config['quality']		= true;						//boolean, the default is true
		$config['size']			= '';						//interger, the default is 1024
		$config['black']		= array(224,255,255);		// array, default is array(255,255,255)
		$config['white']		= array(70,130,180);		// array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		header("Content-Type: image/png");
		$params['data'] = $nisn.' - '.$nama;
		$params['level'] = 'H';
		$params['size'] = 2;
		$params['savename'] = './utama/assists/files/qrcode/'.$nisn.'.png';
		$this->ciqrcode->generate($params);
		return;
	}

	// ======================================================================================
	// # Fungsi
	// ======================================================================================
	function ambilCSSPdf()
	{
		// ============= Style =================
		$strhtml = '<style>';
		$strhtml .= 	'.coret {text-decoration: line-through;background-color: #C0C0C0;display: inline;}';
		$strhtml .= 	'.grsBwh {border-bottom: 2px dotted black;}';
		$strhtml .= 	'div.font12 {font-size: 12px;}';
		$strhtml .= 	'div.gbQrc {position: absolute; top: 980px; left: 60px; width: 100px; height: 120px;}';
		$strhtml .= 	'table.rapor {width: 100%; border-collapse: collapse; font-size:12px; }';
		$strhtml .= 	'tr.bgClr {background-color:#D8D8D8; border: 1px solid black;}';
		$strhtml .= 	'tr.polos {border: 1px solid black;}';
		$strhtml .= 	'td.bgClr {background-color:#D8D8D8; border: 1px solid black;}';
		$strhtml .= 	'td.kiri1 {text-align: left; padding: 6px 10px; horizontal-align:middle; border: 1px solid black;}';
		$strhtml .= 	'td.kiri2 {text-align: left; padding: 4px 20px; horizontal-align:middle;}';
		$strhtml .= 	'td.kiri70 {height: 70px; text-align: left; padding: 4px 10px; horizontal-align:top; border: 1px solid black;}';
		$strhtml .= 	'td.kiri140 {height: 140px; text-align: left; padding: 4px 10px;horizontal-align:top; border: 1px solid black;}';
		$strhtml .= 	'td.tengah1 {text-align: center; padding: 8px 0; horizontal-align:middle; border: 1px solid black;}';
		$strhtml .= 	'td.tengah2 {text-align: center; padding: 8px 10px; horizontal-align:middle; border: 1px solid black;}';
		$strhtml .= 	'td.tengah70 {height: 70px; text-align: center; padding: 4px 0; horizontal-align:middle; border: 1px solid black;}';
		$strhtml .= 	'td.tengah140 {height: 140px; text-align: center; padding: 4px 0;horizontal-align:middle; border: 1px solid black;}';
		$strhtml .= '</style>';
		return $strhtml;
	}

  // ======================================================================================
	// # Fungsi cetak Kop Surat
	// ======================================================================================
	function kopSuratPDF()
	{
		$query = $this->db->select('*')
					->from('tb_sekolah')
					->get();
		$row = $query->row();
		$sklh    =  strtoupper($row->nama_sekolah);
		$alamat  = $row->alamat;
		$kota    = strtoupper($row->kota);
		$prop    = strtoupper($row->propinsi);
		$telepon = $row->telepon;
		$kodepos = $row->kodepos;
		$sekolah = strtoupper(str_replace('SMA ', '', $sklh));

		$strhtml  = '';
		$strhtml .= '<table width=100% style="font-size:14px;">';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td width=0%></td>';
		$strhtml .= 		'<td width=0%>';
		$strhtml .= 			'<IMG class="displayed" src="'.base_url().'utama/assists/images/banjarnegara1.png" alt="" width=9% height=10%>';
		$strhtml .= 		'</td>';
		$strhtml .= 		'<td align="center">';
		$strhtml .= 			'<p><h3>PEMERINTAH PROPINSI '.$prop.'</h2></p>';
		$strhtml .= 			'<p><h3>DINAS PENDIDIKAN PEMUDA DAN OLAHRAGA</h3></p>';
		$strhtml .= 			'<p><h2>SEKOLAH MENENGAH ATAS '.$sekolah.'</h2></p>';
		$strhtml .= 			'<p><h5>'.$alamat.''.$kota.'Kode Pos'.$kodepos.' Telp. '.$telepon.' - Fax. 0286-479376 - Website: sman1klampok.sch.id</h5></p>';
		$strhtml .= 		'</td>';
		$strhtml .= 	'</tr>';
		$strhtml .= '</table>';
		$strhtml .= '<br/>';
		return $strhtml;
	}
	// ======================================================================================
	// # Fungsi cetak Header Rapor
	// ======================================================================================
	function headerRaporPDF($nama_kelas, $semester, $nama, $tapel, $no_induk, $nisn)
	{
		$query = $this->db->select('*')
					->from('tb_sekolah')
					->get();
		$row = $query->row();
		$sekolah = $row->nama_sekolah;
		$kota    = $row->kota;
		$alamat  = $row->alamat;
		$strhtml  = '';
		$strhtml .= '<table width=100% style="font-size:14px;">';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td width=21%>Nama Sekolah</td>';
		$strhtml .= 		'<td align="center" width=10px>:</td>';
		$strhtml .= 		'<td width=40%><b>'.$sekolah.'&nbsp;&nbsp;'.$kota.'</b></td>';
		$strhtml .= 		'<td width=10px>&nbsp;</td>';
		$strhtml .= 		'<td width=17%>Kelas</td>';
		$strhtml .= 		'<td align="center" width=10px>:</td>';
		$strhtml .= 		'<td width=18%><b>'.$nama_kelas.'</b></td>';
		$strhtml .= 	'</tr>';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td>Alamat</td>';
		$strhtml .= 		'<td align="center">:</td>';
		$strhtml .= 		'<td><b>'.$alamat.'</b></td>';
		$strhtml .= 		'<td>&nbsp;</td>';
		$strhtml .= 		'<td>Semester</td>';
		$strhtml .= 		'<td align="center">:</td>';
		$strhtml .= 		'<td><b>'.$semester.'</b></td>';
		$strhtml .= 	'</tr>';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td>Nama Peserta Didik</td>';
		$strhtml .= 		'<td align="center">:</td>';
		if(strtolower($no_induk) == 'all')
			$strhtml .= 		'<td><b> - </b></td>';
		else
			$strhtml .= 		'<td><b>'.$nama.'</b></td>';
		$strhtml .= 		'<td>&nbsp;</td>';
		$strhtml .= 		'<td>Tahun Pelajaran</td>';
		$strhtml .= 		'<td align="center">:</td>';
		$strhtml .= 		'<td><b>'.$tapel.'</b></td>';
		$strhtml .= 	'</tr>';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td>Nomer Induk / NISN</td>';
		$strhtml .= 		'<td align="center">:</td>';
		if(strtolower($no_induk) == 'all')
			$strhtml .= 		'<td><b> - </b></td>';
		else
			$strhtml .= 		'<td><b>'.$no_induk.' / '.$nisn.'</b></td>';
		$strhtml .= 		'<td colspan="4">&nbsp;</td>';
		$strhtml .= 	'</tr>';
		$strhtml .= '</table>';
		$strhtml .= '<hr/>';
		return $strhtml;
	}

		// ======================================================================================
	// # Fungsi cetak Header Rapor
	// ======================================================================================
	function headerRaporPDF1($nama_kelas, $semester, $nama, $tapel, $no_induk, $nisn)
	{
		$query = $this->db->select('*')
					->from('tb_sekolah')
					->get();
		$row = $query->row();
		$sekolah = $row->nama_sekolah;
		$kota    = $row->kota;
		$alamat  = $row->alamat;
		$strhtml  = '';
		$strhtml .= '<table width=100% style="font-size:14px;">';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td width=21%>Nama Sekolah</td>';
		$strhtml .= 		'<td align="center" width=10px>:</td>';
		$strhtml .= 		'<td width=40%><b>'.$sekolah.'&nbsp;&nbsp;'.$kota.'</b></td>';
		$strhtml .= 		'<td width=10px>&nbsp;</td>';
		$strhtml .= 		'<td width=17%>Keterangan</td>';
		$strhtml .= 		'<td align="center" width=10px>:</td>';
		$strhtml .= 		'<td width=18%><b>'.$nama_kelas.'</b></td>';
		$strhtml .= 	'</tr>';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td>Alamat</td>';
		$strhtml .= 		'<td align="center">:</td>';
		$strhtml .= 		'<td><b>'.$alamat.'</b></td>';
		$strhtml .= 		'<td>&nbsp;</td>';
		$strhtml .= 		'<td>Semester</td>';
		$strhtml .= 		'<td align="center">:</td>';
		$strhtml .= 		'<td><b>'.$semester.'</b></td>';
		$strhtml .= 	'</tr>';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td>Tahun Pelajaran</td>';
		$strhtml .= 		'<td align="center">:</td>';
		$strhtml .= 		'<td><b>'.$tapel.'</b></td>';
		$strhtml .= 	'</tr>';
		$strhtml .= 	'<tr>';
		$strhtml .= 	'</tr>';
		$strhtml .= '</table>';
		$strhtml .= '<hr/>';
		return $strhtml;
	}
	// ======================================================================================
	// # Fungsi
	// ======================================================================================
	function importDataAll()
	{
		if(isset($_POST['pilih'])) $pilih = $_POST['pilih']; else $pilih = '';
		if(isset($_POST['file']))  $file  = $_POST['file'];  else $file  = '';
		if(isset($_POST['drop']))  $drop  = $_POST['drop'];  else $drop  = '';

		$fileName = $_FILES['file']['name'];
		$fileType = $_FILES['file']['type'];
		$fileErr  = $_FILES['file']['error'];

		// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
		$sukses	= 0;
		$gagal	= 0;
		$baris	= '';

		$target1 = './utama/assists/files/excel/upload/'.$fileName;
		$target  = './utama/assists/files/excel/upload/'.$fileName;
		move_uploaded_file($_FILES['file']['tmp_name'], $target);

		// mengambil nama Fields
		$kueri1 = '(';
		if(strtolower($pilih) == 'admin')
			$query = $this->db->select('*')
					->from("tb_admin")
					->get();
		elseif(strtolower($pilih) == 'siswa')
			$query = $this->db->select('*')
					->from("tb_siswa")
					->get();
		elseif(strtolower($pilih) == 'wali')
			$query = $this->db->select('*')
					->from("tb_wali")
					->get();
		$field_arr = $query->list_fields();								// Array Nama Fields
		$jml_fields = $query->num_fields();
		//$fieldsName = '(' . implode(", ", $field_arr) . ')';			// Nama Fields
		/*
		for($i=0; $i < $jml_fields; $i++)
		{
			$kueri1 .= $field_arr[$i];
			if($i < ($jml_fields-1))
				$kueri1 .= ', ';
		}
		$kueri1 .= ')';
		*/

		//memanggil file excel_reader
		$this->load->library('excel');
		$objReader =PHPExcel_IOFactory::createReader('Excel5');    		// For excel 2003
		//$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007
		//Set to read only
		$objReader->setReadDataOnly(true);

		//Load excel file
		$objPHPExcel=$objReader->load($target1);
		$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);
		$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();	//Count Number of rows avalable in excel

		// cek kosongkan data
		if($drop = 1)
		{
			// kosongkan tabel Data terlebih dahulu
			if(strtolower($pilih) == 'siswa')
				$truncate = "TRUNCATE TABLE tb_siswa";
			elseif(strtolower($pilih) == 'admin')
				$truncate = "TRUNCATE TABLE tb_admin";
			elseif(strtolower($pilih) == 'wali')
				$truncate = "TRUNCATE TABLE tb_wali";
			$sql = $this->db->query($truncate);
		}

		//print_r($field_arr);
		//print_r($fieldsName);
		//loop from first data untill last data
		$mulai = 3;
		for($i = $mulai; $i <= $totalrows; $i++)
		{
			$dataImport = array();
			for ($j=0; $j < $jml_fields; $j++)
			{
				$dataIn = $this->db->escape_str($objWorksheet->getCellByColumnAndRow($j,$i)->getValue());
				if($dataIn == NULL) $dataIn = '';
				$dataImport[$field_arr[$j]] = $dataIn;		// Menampung data excel pada array dataImport
			}
			//print_r($dataImport);
			if(strtolower($pilih) == 'siswa')
			{
				if($dataImport["nisn"] != '')
				{
					$dataImport["password"] = $this->m_data->encryptIt($dataImport["password"]);
					$this->db->insert('tb_siswa', $dataImport);
					$sukses++;
				}
				else
					$gagal++;
			}
			elseif(strtolower($pilih) == 'admin')
			{
				if($dataImport["username"] != '')
				{
					$dataImport["password"] = $this->m_data->encryptIt($dataImport["password"]);
					$this->db->insert('tb_admin', $dataImport);
					$sukses++;
				}
				else
					$gagal++;
			}
			elseif(strtolower($pilih) == 'wali')
			{
				if($dataImport["kd_guru"] != '')
				{
					$dataImport  = array_diff($dataImport, '');
					$queri = $this->db->select('*')
								->from('tb_wali')
								->where('kd_guru', $dataImport["kd_guru"])
								->get();
					if($queri->num_rows() <= 0)
						$this->db->insert('tb_wali', $dataImport);
					else
						$this->where('kd_guru', $dataImport["kd_guru"])->update('tb_wali', $dataImport);
					$sukses++;
				}
				else
					$gagal++;
			}
		}

		unlink($target);		//File Deleted After uploading in database

		$outp = array();
		$outp[0] = 'sukses';
		$outp[1] = 'Data berhasil diimport : '.$sukses.', gagal : '.$gagal;
		$outp[2] = $baris;
		echo json_encode($outp);

		exit;
	}

  // ======================================================================================
	// # Fungsi cetak Wali Kelas
	// ======================================================================================
	function walikelasRaporPDF($no_ujian_smp, $tgl_surat, $kelas)
	{
		$query = $this->db->select('*')
					->from('tb_admin')
					->get();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$nama = $row->nama;
			$nip  = $row->nip;
		}
		else
		{
			$nama = '';
			$nip  = '';
		}
		$spasi = '&nbsp;';
		if($nama == '')
		{
			for($i = 0; $i < 36; $i++)
			{
				$nama .= $spasi;
			}
		}
		$strhtml  = '';
		$strhtml .= '<table width=100% style="font-size:14px;">';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td width=70%>&nbsp;</td>';
		$strhtml .= 		'<td width=30%>'.$tgl_surat.'</td>';
		$strhtml .= 	'</tr>';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td>&nbsp;</td>';
		$strhtml .= 		'<td>Penanggung Jawab,</td>';
		$strhtml .= 	'</tr>';
		$strhtml .= 	'<tr><td colspan="2">&nbsp;</td></tr>';
		$strhtml .= 	'<tr><td colspan="2">&nbsp;</td></tr>';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td>&nbsp;</td>';
		$strhtml .= 		'<td> <u><b>'.$nama.'</b></u> </td>';
		$strhtml .= 	'</tr>';
		$strhtml .= 	'<tr>';
		$strhtml .= 		'<td>&nbsp;</td>';
		$strhtml .= 		'<td> NIP. '.$nip.' </td>';
		$strhtml .= 	'</tr>';
		$strhtml .= '</table>';
		$strhtml .= '<div class="gbQrc">';
		$strhtml .= '</div>';

		return $strhtml;
	}


	// ======================================================================================
	// # Fungsi cetak Presensi PDF
	// ======================================================================================
	function cetakPresensiPDF()
	{
		date_default_timezone_set("Asia/Jakarta");
		$level    = $this->session->userdata('level');

		if($level < 95)
		{
			$induk    = $this->input->post('induk');
			$tglAwal  = $this->input->post('tglAwal');
			$tglAkhir = $this->input->post('tglAkhir');
			$semua    = 2;
		}
		else
		{
			$semua    = $this->input->post('semua');
			$rekap    = $this->input->post('rekap');
			$tglAwal  = $this->input->post('tglCetak1');
			$tglAkhir = $this->input->post('tglCetak2');
			$kelas    = $this->input->post('kelasPilih');
			$induk    = $this->input->post('siswaSel');
			if($semua == 1)
			{
				$query = $this->db->select('*')
							->from('tb_kelas')
							->where('kd_kelas', $kelas)
							->get();
				if($query->num_rows() > 0)
				{
					$row = $query->row();
					$nama_kelas = $row->nama_kelas;
				}
				$induk = 'all';
			}
		}

		$query = $this->db->select('*')
					->from('tb_sekolah')
					->get();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$kota        = ucwords(strtolower($row->kota));
			$sekolah     = $row->nama_sekolah;
			$nama_kepsek = $row->kepsek;
			$nip_kepsek  = $row->nip;
			$website     = $row->website;
			$email       = $row->email;
			$tapelS		 = $row->tapel;
			$semes		 = $row->semester;
		}
		else
		{
			$kota		 = '';
			$sekolah	 = '';
			$nama_kepsek = '';
			$nip_kepsek  = '';
			$website     = '';
			$email       = '';
			$tapel		 = '';
			$semes		 = '';
		}

		$bulan		= array("Januari", "Februari", "Maret", "April",
							"Mei", "Juni", "Juli", "Agustus",
							"September", "Oktober", "nopember", "Desember");

		$tgl_awal = date("j", strtotime($tglAwal)) . ' ' . $bulan[(date("n", strtotime($tglAwal))-1)] . ' ' . date("Y", strtotime($tglAwal));
		$tgl_akhir = date("j", strtotime($tglAkhir)) . ' ' . $bulan[(date("n", strtotime($tglAkhir))-1)] . ' ' . date("Y", strtotime($tglAkhir));

		if($semes == 1) $semester = 'Ganjil'; else $semester	= 'Genap';
		$tapel      = $tapelS . ' - ' . ($tapelS + 1);

		// Panggil Library mPdf
		$this->load->library('mpdf');
		//$mpdf = new mPDF('utf-8', 'Folio-L', 0, '', $kiri, $kanan, $atas, $bawah, $hdr, $ftr, 'L');	// ---- Cetak landscape
		$mpdf = new mPDF('utf-8', 'Folio', 0, '', 10, 10, 10, 10, 5, 15, '');		// ---- Cetak Potrait
		$mpdf->SetHeader('Presensi Siswa||Hal. : {PAGENO} dari {nb}');
		$mpdf->SetFooter('http://'.$website.'|'.$sekolah.' '.$kota.'|e-mail : '.$email);

		// ============= Style =================
		$strhtml = $this->ambilCSSPdf();
		$mpdf->WriteHTML($strhtml);
		$strhtml = '';

		if($semua == 2)
		{
			$query = $this->db->select('*')
						->from('tb_siswa')
						->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
						->where('tb_siswa.no_induk', $induk)
						->get();
			$row = $query->row();
			$no_induk		= $row -> no_induk;
			$nisn	= $row -> nisn;
			$nama			= $row -> nama;
			$nisn			= $row -> nisn;
			$kelas			= $row -> kelas;
			$nama_kelas		= $row -> nama_kelas;

			$jml_skt = 0;
			$jml_ijn = 0;
			$jml_alp = 0;
			$jml_lmb = 0;
			$query = $this->db->select('*')
						->from('tb_presensi')
						->where('induk', $induk)
						->where('tanggal >=', $tglAwal)
						->where('tanggal <', $tglAkhir)
						->get();
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					$jenis = $row->jenis;
					if(strtolower($jenis) == 's') $jml_skt++;
					elseif(strtolower($jenis) == 'i') $jml_ijn++;
					elseif(strtolower($jenis) == 'a') $jml_alp++;
					elseif(strtolower($jenis) == 't') $jml_lmb++;
				}
			}
			//$this->cetakQRCode($nisn, $nama);

			$nomer = 0;
			$query = $this->db->select('*')
						->from('tb_presensi')
						->where('induk', $induk)
						->where('tanggal >=', $tglAwal)
						->where('tanggal <=', $tglAkhir)
						->order_by('tanggal', 'asc')
						->get();
			$rowcounts = $query->num_rows();
			$perKolom = ceil($rowcounts / 3);

      $strhtml .= $this->kopSuratPDF();
      $strhtml .= $this->headerRaporPDF($nama_kelas, $semester, $nama, $tapel, $induk, $nisn);
			$strhtml .= '<div style="text-align: center">';
			$strhtml .= 	'<h3>DAFTAR HADIR SISWA</h3><br/>';
			$strhtml .= 	'<h4 style="margin-top:-34px;">Tanggal : '.$tgl_awal.' s/d '.$tgl_akhir.'</h4><br/>';
			$strhtml .= '</div>';
			$strhtml .=	'<table class="rapor" style="margin-top: -15px;">';
			$strhtml .= 	'<tr>';
			$strhtml .= 		'<td class="bgClr tengah2" style="width: 6%;">No</td>';			// Tabel 1
			$strhtml .= 		'<td class="bgClr tengah2" style="width: 13%;">Tanggal</td>';
			$strhtml .= 		'<td class="bgClr tengah2" style="width: 13%;">Jenis</td>';
			if($rowcounts > 1)
			{
				$strhtml .= 	'<td style="width: 10px;">&nbsp;</td>';							// Pembatas Kolom
				$strhtml .= 	'<td class="bgClr tengah2" style="width: 6%;">No</td>';			// Tabel (Kolom) 2
				$strhtml .= 	'<td class="bgClr tengah2" style="width: 13%;">Tanggal</td>';
				$strhtml .= 	'<td class="bgClr tengah2" style="width: 13%;">Jenis</td>';
			}
			if($rowcounts > 2)
			{
				$strhtml .= 	'<td style="width: 10px;">&nbsp;</td>';							// Pembatas Kolom
				$strhtml .= 	'<td class="bgClr tengah2" style="width: 6%;">No</td>';			// Tabel (Kolom) 3
				$strhtml .= 	'<td class="bgClr tengah2" style="width: 13%;">Tanggal</td>';
				$strhtml .= 	'<td class="bgClr tengah2" style="width: 13%;">Jenis</td>';
			}
			$strhtml .= 	'</tr>';

			for($i = 0; $i < $perKolom; $i++)
			{
				$strhtml .= '<tr>';
					$row1 = $query->row($i);
					$tgl  = date("d-m-Y", strtotime($row1->tanggal));
					$jns  = $row1->jenis;
					if(strtolower($jns) == 's') $jenis = 'Sakit';
					elseif(strtolower($jns) == 'i') $jenis = 'Ijin';
					elseif(strtolower($jns) == 't') $jenis = 'Terlambat';
					elseif(strtolower($jns) == 'a') $jenis = 'Alpha';
				$strhtml .= 	'<td class="tengah2">'.($i+1).'</td>';
				$strhtml .= 	'<td class="tengah2">'.$tgl.'</td>';
				$strhtml .= 	'<td class="tengah2">'.$jenis.'</td>';
				$strhtml .= 	'<td>&nbsp;</td>';												// Pembatas Kolom
				if(($i + $perKolom) < $rowcounts)
				{
					$row1 = $query->row($i + $perKolom);
					$tgl  = date("d-m-Y", strtotime($row1->tanggal));
					$jns = $row1->jenis;
					if(strtolower($jns) == 's') $jenis = 'Sakit';
					elseif(strtolower($jns) == 'i') $jenis = 'Ijin';
					elseif(strtolower($jns) == 't') $jenis = 'Terlambat';
					elseif(strtolower($jns) == 'a') $jenis = 'Alpha';
					$strhtml .= '<td class="tengah2">'.($i + $perKolom + 1).'</td>';
					$strhtml .= '<td class="tengah2">'.$tgl.'</td>';
					$strhtml .= '<td class="tengah2">'.$jenis.'</td>';
				}
				else
				{
					$strhtml .= '<td>&nbsp;</td>';
					$strhtml .= '<td>&nbsp;</td>';
					$strhtml .= '<td>&nbsp;</td>';
				}
				$strhtml .= 	'<td>&nbsp;</td>';												// Pembatas Kolom
				if(($perKolom * 2 + $i) < $rowcounts)
				{
						$row1 = $query->row($perKolom * 2 + $i);
						$tgl  = date("d-m-Y", strtotime($row1->tanggal));
						$jns = $row1->jenis;
						if(strtolower($jns) == 's') $jenis = 'Sakit';
						elseif(strtolower($jns) == 'i') $jenis = 'Ijin';
						elseif(strtolower($jns) == 't') $jenis = 'Terlambat';
						elseif(strtolower($jns) == 'a') $jenis = 'Alpha';
					$strhtml .= '<td class="tengah2">'.($perKolom * 2 + $i + 1).'</td>';
					$strhtml .= '<td class="tengah2">'.$tgl.'</td>';
					$strhtml .= '<td class="tengah2">'.$jenis.'</td>';
				}
				else
				{
					$strhtml .= '<td>&nbsp;</td>';
					$strhtml .= '<td>&nbsp;</td>';
					$strhtml .= '<td>&nbsp;</td>';
				}
				$strhtml .= '</tr>';
				$nomer++;
			}
			$strhtml .= '</table>';
      $strhtml .= $this->walikelasRaporPDF($no_ujian_smp, $tgl_surat, $kelas);
			$mpdf->WriteHTML($strhtml);
			$strhtml = '';
		}
		elseif($semua == 1)
		{
      $strhtml .= $this->kopSuratPDF();
			$strhtml .= $this->headerRaporPDF($nama_kelas, $semester, $nama, $tapel, $induk, $nisn);
			$strhtml .= '<div style="text-align: center">';
			$strhtml .= 	'<h3>DAFTAR HADIR SISWA</h3><br/>';
			$strhtml .= 	'<h4 style="margin-top:-34px;">Tanggal : '.$tgl_awal.' s/d '.$tgl_akhir.'</h4><br/>';
			$strhtml .= '</div>';
			$strhtml .= $this->ctkPresensiKelas($kelas, $tglAwal, $tglAkhir, $nama_kelas);
      $strhtml .= $this->walikelasRaporPDF($no_ujian_smp, $tgl_surat, $kelas);
			$mpdf->WriteHTML($strhtml);
			$strhtml = '';
		}
		else
		{
			$urut = 0;
			$query1 = $this->db->select('*')
						->from('tb_presensi')
						->join('tb_siswa', 'tb_siswa.no_induk = tb_presensi.induk', 'left')
						->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
						->where('tb_presensi.tanggal >=', $tglAwal)
						->where('tb_presensi.tanggal <=', $tglAkhir)
						->group_by('tb_kelas.kd_kelas')
						->get();
			$jmlKls = $query1->num_rows();
			$query = $this->db->select('*')
						->from('tb_kelas')
						->get();
			foreach($query->result() as $row)
			{
				$klsPlh = $row->kd_kelas;
				$query1 = $this->db->select('*')
							->from('tb_presensi')
							->join('tb_siswa', 'tb_siswa.no_induk = tb_presensi.induk', 'left')
							->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
							->where('tb_presensi.tanggal >=', $tglAwal)
							->where('tb_presensi.tanggal <=', $tglAkhir)
							->where('tb_kelas.kd_kelas', $klsPlh)
							->get();
				if($query1->num_rows() > 0)
				{
					$row1 = $query1->row();
					$nama_kelas = $row1->nama_kelas;
					$kelas = $row1->kd_kelas;
					$induk = 'all';
          $strhtml .= $this->kopSuratPDF();
					$strhtml .= $this->headerRaporPDF($nama_kelas, $semester, $nama, $tapel, $induk, $nisn);
					$strhtml .= '<div style="text-align: center">';
					$strhtml .= 	'<h3>DAFTAR HADIR SISWA</h3><br/>';
					$strhtml .= 	'<h4 style="margin-top:-34px;">Tanggal : '.$tgl_awal.' s/d '.$tgl_akhir.'</h4><br/>';
					$strhtml .= '</div>';
					$strhtml .= $this->ctkPresensiKelas($kelas, $tglAwal, $tglAkhir, $nama_kelas);
          $strhtml .= '<td>&nbsp;</td>';
					$strhtml .= '<td>&nbsp;</td>';
          $strhtml .= '<td>&nbsp;</td>';
					$strhtml .= '<td>&nbsp;</td>';
          $strhtml .= $this->walikelasRaporPDF($no_ujian_smp, $tgl_surat, $kelas);
					$mpdf->WriteHTML($strhtml);
          $urut++;
					if($urut < $jmlKls)
						$mpdf->AddPage();
					$strhtml = '';
				}
			}
		}

		if($semua == 2)
			$NamaFile   = 'Presensi-'.$nisn.'.pdf';
		elseif($semua == 1)
			$NamaFile   = 'Presensi-'.$kelas.'.pdf';
		elseif($semua == 0)
			$NamaFile   = 'Presensi-All.pdf';

		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->Output($NamaFile,'D');

		exit;
	}

	function ctkPresensiKelas($kelas, $tglAwal, $tglAkhir, $nama_kelas)
	{
		$strhtml = '';
		$query1 = $this->db->select('*')
					->from('tb_presensi')
					->join('tb_siswa', 'tb_siswa.no_induk = tb_presensi.induk', 'left')
					->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
					->where('tanggal >=', $tglAwal)
					->where('tanggal <=', $tglAkhir)
					->where('tb_kelas.kd_kelas', $kelas)
					->get();
		$rowcounts = $query1->num_rows();
		if($rowcounts > 0)
		{
			$row1 = $query1->row();
			$nama_kelas	= $row1 -> nama_kelas;
			$perHal = 60;
			$jmlHal = ceil($rowcounts / $perHal);
			for($j = 0; $j < $jmlHal; $j++)
			{
				$awal = $j * $perHal;
				$query1 = $this->db->select('*')
						->from('tb_presensi')
						->join('tb_siswa', 'tb_siswa.no_induk = tb_presensi.induk', 'left')
						->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
						->where('tanggal >=', $tglAwal)
						->where('tanggal <=', $tglAkhir)
						->limit($perHal, $awal)
						->where('tb_kelas.kd_kelas', $kelas)
						->order_by('tb_siswa.nama', 'asc')
						->order_by('tb_presensi.tanggal', 'asc')
						->get();
				$rowcounts1 = $query1->num_rows();
				$perKolom = ceil($rowcounts1 / 2);
				$strhtml .= '<div class="font12" style="margin-top:-28px;">';
				if($j == 0)
					$strhtml .= 	'<b>Kelas : '.$nama_kelas.'</b><br/>';
				else
					$strhtml .= 	'<b>Kelas : '.$nama_kelas.' <i>(lanjutan)</i></b><br/>';
				$strhtml .= '</div>';
				$strhtml .=	'<table class="rapor">';
				$strhtml .= 	'<tr>';
				$strhtml .= 		'<td class="bgClr tengah2" style="width: 6%;">No</td>';			// Tabel 1
				$strhtml .= 		'<td class="bgClr tengah2" style="width: 23%;">Nama</td>';
				$strhtml .= 		'<td class="bgClr tengah2" style="width: 13%;">Tanggal</td>';
				$strhtml .= 		'<td class="bgClr tengah2" style="width: 8%;">Jenis</td>';
				if($rowcounts1 > 1)
				{
					$strhtml .= 	'<td style="width: 10px;">&nbsp;</td>';							// Pembatas Kolom
					$strhtml .= 	'<td class="bgClr tengah2" style="width: 6%;">No</td>';			// Tabel (Kolom) 2
					$strhtml .= 	'<td class="bgClr tengah2" style="width: 23%;">Nama</td>';
					$strhtml .= 	'<td class="bgClr tengah2" style="width: 13%;">Tanggal</td>';
					$strhtml .= 	'<td class="bgClr tengah2" style="width: 8%;">Jenis</td>';
				}
				$strhtml .= 	'</tr>';
				$nomer = 0;
				for($i = 0; $i < $perKolom; $i++)
				{
					$strhtml .= '<tr>';
					$row1 = $query1->row($i);
					$tgl  = date("d-m-Y", strtotime($row1->tanggal));
					$nama = $row1->nama;
					$jns  = $row1->jenis;
					if(strtolower($jns) == 's') $jenis = 'Sakit';
					elseif(strtolower($jns) == 'i') $jenis = 'Ijin';
					elseif(strtolower($jns) == 't') $jenis = 'Terlambat';
					elseif(strtolower($jns) == 'a') $jenis = 'Alpha';
					$strhtml .= 	'<td class="tengah2">'.($i+1).'</td>';
					$strhtml .= 	'<td class="tengah2">'.$nama.'</td>';
					$strhtml .= 	'<td class="tengah2">'.$tgl.'</td>';
					$strhtml .= 	'<td class="tengah2">'.$jenis.'</td>';
					$strhtml .= 	'<td>&nbsp;</td>';												// Pembatas Kolom
					if(($i + $perKolom) < $rowcounts1)
					{
						$row1 = $query1->row($i + $perKolom);
						$tgl  = date("d-m-Y", strtotime($row1->tanggal));
						$nama = $row1->nama;
						$jns  = $row1->jenis;
						if(strtolower($jns) == 's') $jenis = 'Sakit';
						elseif(strtolower($jns) == 'i') $jenis = 'Ijin';
						elseif(strtolower($jns) == 't') $jenis = 'Terlambat';
						elseif(strtolower($jns) == 'a') $jenis = 'Alpha';
						$strhtml .= '<td class="tengah2">'.($i + $perKolom + 1).'</td>';
						$strhtml .= '<td class="tengah2">'.$nama.'</td>';
						$strhtml .= '<td class="tengah2">'.$tgl.'</td>';
						$strhtml .= '<td class="tengah2">'.$jenis.'</td>';
					}
					else
					{
						$strhtml .= '<td>&nbsp;</td>';
						$strhtml .= '<td>&nbsp;</td>';
						$strhtml .= '<td>&nbsp;</td>';
						$strhtml .= '<td>&nbsp;</td>';
					}
					$strhtml .= '</tr>';
					$nomer++;
				}
			}
			$strhtml .= '</table>';
		}
		return $strhtml;
	}

	// ======================================================================================
	// # Fungsi cetak Pelanggaran PDF
	// ======================================================================================
	function cetakLanggarPDF()
	{
		date_default_timezone_set("Asia/Jakarta");
		$level    = $this->session->userdata('level');

		if($level < 95)
		{
			$induk    = $this->input->post('induk');
			$tglAwal  = $this->input->post('tglAwal');
			$tglAkhir = $this->input->post('tglAkhir');
			$semua    = 2;
		}
		else
		{
			$semua    = $this->input->post('semua');
			$rekap    = $this->input->post('rekap');
			$tglAwal  = $this->input->post('tglCetak1');
			$tglAkhir = $this->input->post('tglCetak2');
			$kelas    = $this->input->post('kelasPilih');
			$induk    = $this->input->post('siswaSel');
			if($semua == 1)
			{
				$query = $this->db->select('*')
							->from('tb_kelas')
							->where('kd_kelas', $kelas)
							->get();
				if($query->num_rows() > 0)
				{
					$row = $query->row();
					$nama_kelas = $row->nama_kelas;
				}
				$induk = 'all';
			}
		}

		$NamaFile   = 'Pelanggaran-All.pdf';

		$query = $this->db->select('*')
					->from('tb_sekolah')
					->get();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$kota        = ucwords(strtolower($row->kota));
			$sekolah     = $row->nama_sekolah;
			$nama_kepsek = $row->kepsek;
			$nip_kepsek  = $row->nip;
			$website     = $row->website;
			$email       = $row->email;
			$tapelS		 = $row->tapel;
			$semes		 = $row->semester;
		}
		else
		{
			$kota		 = '';
			$sekolah	 = '';
			$nama_kepsek = '';
			$nip_kepsek  = '';
			$website     = '';
			$email       = '';
			$tapel		 = '';
			$semes		 = '';
		}

		$bulan		= array("Januari", "Februari", "Maret", "April",
							"Mei", "Juni", "Juli", "Agustus",
							"September", "Oktober", "nopember", "Desember");

		$tgl_awal = date("j", strtotime($tglAwal)) . ' ' . $bulan[(date("n", strtotime($tglAwal))-1)] . ' ' . date("Y", strtotime($tglAwal));
		$tgl_akhir = date("j", strtotime($tglAkhir)) . ' ' . $bulan[(date("n", strtotime($tglAkhir))-1)] . ' ' . date("Y", strtotime($tglAkhir));

		if($semes == 1) $semester = 'Ganjil'; else $semester	= 'Genap';
		$tapel      = $tapelS . ' - ' . ($tapelS + 1);

		if($semua == 2)
		{
			// Panggil Library mPdf
			$this->load->library('mpdf');
			//$mpdf = new mPDF('utf-8', 'Folio-L', 0, '', $kiri, $kanan, $atas, $bawah, $hdr, $ftr, 'L');	// ---- Cetak landscape
			$mpdf = new mPDF('utf-8', 'Folio', 0, '', 10, 10, 10, 10, 5, 15, '');		// ---- Cetak Potrait
			$mpdf->SetHeader('Pelanggaran Siswa||Hal. : {PAGENO} dari {nb}');
			$mpdf->SetFooter('http://'.$website.'|'.$sekolah.' '.$kota.'|e-mail : '.$email);

			// ============= Style =================
			$strhtml = $this->ambilCSSPdf();
			$mpdf->WriteHTML($strhtml);
			$strhtml = '';

			$query = $this->db->select('*')
						->from('tb_siswa')
						->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
						->where('tb_siswa.no_induk', $induk)
						->get();
			$row = $query->row();
			$no_induk		= $row -> no_induk;
			$nisn	= $row -> nisn;
			$nama			= $row -> nama;
			$nisn			= $row -> nisn;
			$kelas			= $row -> kelas;
      $skor_poin   = $row -> skor_poin;
			$nama_kelas		= $row -> nama_kelas;
			$tgl_lhr		= $row -> tgl_lhr;

			$this->cetakQRCode($nisn, $nama);

			// ===================== Halaman 1 =============================
      $strhtml .= $this->kopSuratPDF();
			$strhtml .= $this->headerRaporPDF($nama_kelas, $semester, $nama, $tapel, $no_induk, $nisn);
			$strhtml .= '<div style="text-align: center">';
			$strhtml .= 	'<h3>DAFTAR PELANGGARAN SISWA</h3><br/>';
			$strhtml .= 	'<h4 style="margin-top:-34px;">Tanggal : '.$tgl_awal.' s/d '.$tgl_akhir.'</h4><br/>';
			$strhtml .= '</div>';
			$nomer = 0;
			$strhtml .=	'<table class="rapor">';
			$strhtml .= 	'<tr class="bgClr">';
			$strhtml .= 		'<td class="tengah2" rowspan="2" style="width: 5%;font-weight: bold;">No</td>';
			$strhtml .= 		'<td class="tengah2" colspan="2" style="font-weight: bold;">Pelanggaran</td>';
			$strhtml .= 		'<td class="tengah2" colspan="6" style="font-weight: bold;">Penanganan</td>';
			$strhtml .= 	'</tr>';
			$strhtml .= 	'<tr class="bgClr">';
			$strhtml .= 		'<td class="tengah2" style="width:10%;font-weight: bold;">Tanggal</td>';
			$strhtml .= 		'<td class="tengah2" style="width:27%;font-weight: bold;">Masalah</td>';
			$strhtml .= 		'<td class="tengah2" style="width:10%;font-weight: bold;">Tanggal</td>';
      $strhtml .= 		'<td class="tengah2" style="width:5%;font-weight: bold;">Poin</td>';
			$strhtml .= 		'<td class="tengah2" style="width:15%;font-weight: bold;">Oleh</td>';
			$strhtml .= 		'<td class="tengah2" style="width:27%;font-weight: bold;">Solusi</td>';
			$strhtml .= 		'<td class="tengah2" style="width: 6%;font-weight: bold;">Status</td>';
			$strhtml .= 	'</tr>';
			$nomer = 0;
			$query = $this->db->select('*')
						->from('tb_langgar')
						->where('induk', $induk)
						->where('tanggal >=', $tglAwal)
						->where('tanggal <=', $tglAkhir)
						->order_by('tanggal', 'asc')
						->get();
			foreach($query->result() as $row)
			{
				$nomer++;
				$tanggal = $row->tanggal;
				$masalah = $row->masalah;
				$tangani = $row->tangani;
				$oleh    = $row->oleh;
				$solusi  = $row->solusi;
        $skor_poin = $row->skor_poin;
				$sts     = $row->statusL;
  				if(strtolower($sts) == 's') $status = 'Sudah';
  				elseif(strtolower($sts) == 'b') $status = 'Belum';
  				elseif(strtolower($sts) == 'p') $status = 'Proses';
				$strhtml .=		'<tr class="polos">';
				$strhtml .= 		'<td class="tengah2">'.$nomer.'</td>';
				$strhtml .= 		'<td class="tengah2">'.$tanggal.'</td>';
				$strhtml .= 		'<td class="kiri1"><b>'.$masalah.'</b></td>';
				$strhtml .= 		'<td class="tengah2">'.$tangani.'</td>';
        $strhtml .= 		'<td class="tengah2">'.$skor_poin.'</td>';
				$strhtml .= 		'<td class="tengah2">'.$oleh.'</td>';
				$strhtml .= 		'<td class="kiri1"><b>'.$solusi.'</b></td>';
				$strhtml .= 		'<td class="tengah2"><b>'.$status.'</b></td>';
				$strhtml .= 	'</tr>';
			}
      $query = $this->db->select('*')
						->from('tb_langgar')
						->where('induk', $induk)
						->where('tanggal >=', $tglAwal)
						->where('tanggal <=', $tglAkhir)
						->order_by('tanggal', 'asc')
						->get();

			$query3 = $this->db->query("SELECT SUM(skor_poin) AS total FROM tb_langgar WHERE induk = '$row->induk'");
			foreach($query3->result() as $row3){}

      $strhtml .= 	'<tr class="bgClr">';
      $strhtml .= 		'<td class="tengah2" colspan="8" style="font-weight: bold;">Jumlah Poin : '.$row3->total.'</td>';
      $strhtml .= 	'</tr>';
			$strhtml .= '</table>';
      $strhtml .= $this->walikelasRaporPDF($no_ujian_smp, $tgl_surat, $kelas);
			$mpdf->WriteHTML($strhtml);
		}
		else
		{
			// Panggil Library mPdf
			$this->load->library('mpdf');
			//$mpdf = new mPDF('utf-8', 'Folio-L', 0, '', $kiri, $kanan, $atas, $bawah, $hdr, $ftr, 'L');	// ---- Cetak landscape
			$mpdf = new mPDF('utf-8', 'Folio-L', 0, '', 10, 10, 10, 10, 5, 15, '');		// ---- Cetak Potrait
			$mpdf->SetHeader('Pelanggaran Siswa||Hal. : {PAGENO} dari {nb}');
			$mpdf->SetFooter('http://'.$website.'|'.$sekolah.' '.$kota.'|e-mail : '.$email);

			// ============= Style =================
			$strhtml = $this->ambilCSSPdf();
			$mpdf->WriteHTML($strhtml);
			$strhtml = '';

			$urut = 0;
			if($semua == 0)
			{
				$query1 = $this->db->select('*')
							->from('tb_langgar')
							->join('tb_siswa', 'tb_siswa.no_induk = tb_langgar.induk', 'left')
							->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
							->where('tb_langgar.tanggal >=', $tglAwal)
							->where('tb_langgar.tanggal <=', $tglAkhir)
							->group_by('tb_kelas.kd_kelas')
							->get();
				$jmlKls = $query1->num_rows();
				$query = $this->db->select('*')
							->from('tb_kelas')
							->get();
			}
			else
			{
				$jmlKls = 1;
				$query = $this->db->select('*')
							->from('tb_kelas')
							->where('kd_kelas', $kelas)
							->get();
			}
			foreach($query->result() as $row)
			{
				$klsPlh = $row->kd_kelas;
				$query1 = $this->db->select('*')
							->from('tb_langgar')
							->join('tb_siswa', 'tb_siswa.no_induk = tb_langgar.induk', 'left')
							->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
							->where('tb_langgar.tanggal >=', $tglAwal)
							->where('tb_langgar.tanggal <=', $tglAkhir)
							->where('tb_kelas.kd_kelas', $klsPlh)
							->order_by('tb_siswa.nama', 'asc')
							->order_by('tb_langgar.tanggal', 'asc')
							->get();
				if($query1->num_rows() > 0)
				{
					$nomer  = 1;
					$row1 = $query1->row();
					$nama_kelas = $row1->nama_kelas;
					$kelas = $row1->kd_kelas;
					$no_induk = 'all';
          $strhtml = $this->headerRaporPDF($nama_kelas, $semester, $nama, $tapel, $no_induk, $nisn);
					$strhtml .= '<div style="text-align: center">';
					$strhtml .= 	'<h3>DAFTAR PELANGGARAN SISWA</h3><br/>';
					$strhtml .= 	'<h4 style="margin-top:-34px;">Tanggal : '.$tgl_awal.' s/d '.$tgl_akhir.'</h4><br/>';
					$strhtml .= '</div>';
					$strhtml .=	'<table class="rapor" style="font-size:14px;">';
					$strhtml .= 	'<tr class="bgClr">';
					$strhtml .= 		'<td class="tengah2" rowspan="2" style="width: 2%;font-weight: bold;">No</td>';
					$strhtml .= 		'<td class="tengah2" colspan="4" style="font-weight: bold;">Pelanggaran</td>';
					$strhtml .= 		'<td class="tengah2" colspan="6" style="font-weight: bold;">Penanganan</td>';
					$strhtml .= 	'</tr>';
					$strhtml .= 	'<tr class="bgClr">';
					$strhtml .= 		'<td class="tengah2" style="width:8%;font-weight: bold;">Tanggal</td>';
					$strhtml .= 		'<td class="tengah2" style="width:5%;font-weight: bold;">Induk</td>';
					$strhtml .= 		'<td class="tengah2" style="width:15%;font-weight: bold;">Nama</td>';
					$strhtml .= 		'<td class="tengah2" style="width:25%;font-weight: bold;">Masalah</td>';
					$strhtml .= 		'<td class="tengah2" style="width:6%;font-weight: bold;">Tanggal</td>';
          $strhtml .= 		'<td class="tengah2" style="width:5%;font-weight: bold;">Poin</td>';
					$strhtml .= 		'<td class="tengah2" style="width:10%;font-weight: bold;">Oleh</td>';
					$strhtml .= 		'<td class="tengah2" style="width:25%;font-weight: bold;">Solusi</td>';
					$strhtml .= 		'<td class="tengah2" style="width: 4%;font-weight: bold;">Status</td>';
					$strhtml .= 	'</tr>';
					foreach($query1->result() as $row1)
					{
						$tanggal = $row1->tanggal;
						$induk   = $row1->induk;
						$nama    = $row1->nama;
						$macam   = $row1->masalah;
						$tangani = $row1->tangani;
            $skor_poin = $row1->skor_poin;
						$oleh    = $row1->oleh;
						$solusi  = $row1->solusi;
						$sts     = $row1->statusL;
  						if(strtolower($sts) == 'b') $status = 'Belum';
  						elseif(strtolower($sts) == 's') $status = 'Sudah';
  						elseif(strtolower($sts) == 'p') $status = 'Proses';
						$strhtml .= 	'<tr class="polos">';
						$strhtml .= 		'<td class="tengah2" style="width:%;font-weight: bold;">'.$nomer.'</td>';
						$strhtml .= 		'<td class="tengah2" style="width:8%;font-weight: bold;">'.$tanggal.'</td>';
						$strhtml .= 		'<td class="tengah2" style="width:5%;font-weight: bold;">'.$induk.'</td>';
						$strhtml .= 		'<td class="kiri1" style="width:15%;font-weight: bold;">'.$nama.'</td>';
						$strhtml .= 		'<td class="kiri1" style="width:25%;font-weight: bold;">'.$macam.'</td>';
						$strhtml .= 		'<td class="tengah2" style="width:6%;font-weight: bold;">'.$tangani.'</td>';
            $strhtml .= 		'<td class="tengah2" style="width:6%;font-weight: bold;">'.$skor_poin.'</td>';
						$strhtml .= 		'<td class="tengah2" style="width:10%;font-weight: bold;">'.$oleh.'</td>';
						$strhtml .= 		'<td class="kiri1" style="width:25%;font-weight: bold;">'.$solusi.'</td>';
						$strhtml .= 		'<td class="tengah2" style="width: 4%;font-weight: bold;">'.$status.'</td>';
						$strhtml .= 	'</tr>';
						$nomer++;
					}
					$strhtml .= '</table>';
          $strhtml .= $this->walikelasRaporPDF($no_ujian_smp, $tgl_surat, $kelas);

					$mpdf->WriteHTML($strhtml);
					$urut++;
					if($urut < $jmlKls)
						$mpdf->AddPage();
				}
			}
		}

		if($semua == 2)
			$NamaFile   = 'Pelanggaran-'.$nisn.'.pdf';
		elseif($semua == 1)
			$NamaFile   = 'Pelanggaran-'.$kelas.'.pdf';
		else
			$NamaFile   = 'Pelanggaran-All.pdf';
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->Output($NamaFile,'D');

		exit;
	}

	// ======================================================================================
	// # Fungsi cetak Pelanggaran PDF
	// ======================================================================================
	function cetakSPPDF()
	{
		date_default_timezone_set("Asia/Jakarta");
		$level    = $this->session->userdata('level');

		if($level < 95)
		{
		}
		else
		{
			$semua    = $this->input->post('semua');
			$rekap    = $this->input->post('rekap');
			$tglAwal  = $this->input->post('tglCetak1');
			$tglAkhir = $this->input->post('tglCetak2');
			$kelas    = $this->input->post('kelasPilih');
			$sp    		= $this->input->post('spPilih');
			$induk    = $this->input->post('siswaSel');
			if($semua == 1)
			{
				$query = $this->db->select('*')
							->from('tb_sp')
							->where('id_sp', $id_sp)
							->get();
				if($query->num_rows() > 0)
				{
					$row = $query->row();
					$id_sp = $row->id_sp;
				}
				$induk = 'all';
			}
		}
		$NamaFile   = 'Pelanggaran-All.pdf';

		$query = $this->db->select('*')
					->from('tb_sekolah')
					->get();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$kota        = ucwords(strtolower($row->kota));
			$sekolah     = $row->nama_sekolah;
			$nama_kepsek = $row->kepsek;
			$nip_kepsek  = $row->nip;
			$website     = $row->website;
			$email       = $row->email;
			$tapelS		 = $row->tapel;
			$semes		 = $row->semester;
		}
		else
		{
			$kota		 = '';
			$sekolah	 = '';
			$nama_kepsek = '';
			$nip_kepsek  = '';
			$website     = '';
			$email       = '';
			$tapel		 = '';
			$semes		 = '';
		}

		$bulan		= array("Januari", "Februari", "Maret", "April",
							"Mei", "Juni", "Juli", "Agustus",
							"September", "Oktober", "nopember", "Desember");

		$tgl_awal = date("j", strtotime($tglAwal)) . ' ' . $bulan[(date("n", strtotime($tglAwal))-1)] . ' ' . date("Y", strtotime($tglAwal));
		$tgl_akhir = date("j", strtotime($tglAkhir)) . ' ' . $bulan[(date("n", strtotime($tglAkhir))-1)] . ' ' . date("Y", strtotime($tglAkhir));

		if($semes == 1) $semester = 'Ganjil'; else $semester	= 'Genap';
		$tapel      = $tapelS . ' - ' . ($tapelS + 1);



		if($semua == 2)
		{
			// Panggil Library mPdf
			$this->load->library('mpdf');
			//$mpdf = new mPDF('utf-8', 'Folio-L', 0, '', $kiri, $kanan, $atas, $bawah, $hdr, $ftr, 'L');	// ---- Cetak landscape
			$mpdf = new mPDF('utf-8', 'Folio', 0, '', 10, 10, 10, 10, 5, 15, '');		// ---- Cetak Potrait
			$mpdf->SetHeader('Pelanggaran Siswa||Hal. : {PAGENO} dari {nb}');
			$mpdf->SetFooter('http://'.$website.'|'.$sekolah.' '.$kota.'|e-mail : '.$email);

			// ============= Style =================
			$strhtml = $this->ambilCSSPdf();
			$mpdf->WriteHTML($strhtml);
			$strhtml = '';

			$query = $this->db->query("SELECT * FROM `tb_sp` WHERE statusL = '$row->statusL'");
			$row = $query->row();
			$induk		= $row -> induk;
			$nama	= $row -> nama;
			$kelas			= $row -> kelas;
      $jmlh_poin   = $row -> jmlh_poin;
			$status		= $row -> statusL;
			$this->cetakQRCode($nisn, $nama);

			// ===================== Halaman 1 =============================
      $strhtml .= $this->kopSuratPDF();
			$strhtml .= $this->headerRaporPDF1($nama_kelas, $semester, $nama, $tapel, $no_induk, $nisn);
			$strhtml .= '<div style="text-align: center">';
			$strhtml .= 	'<h3>DAFTAR SP SISWA</h3><br/>';
			$strhtml .= 	'<br/>';
			$strhtml .= 	'<h4 style="margin-top:-34px;">Tanggal : '.$tgl_awal.' s/d '.$tgl_akhir.'</h4><br/>';
			$strhtml .= '</div>';
			$nomer = 0;
			$strhtml .=	'<table class="rapor">';
			$strhtml .= 	'<tr class="bgClr">';
			$strhtml .= 		'<td class="tengah2" rowspan="2" style="width: 5%;font-weight: bold;">No</td>';
			$strhtml .= 	'</tr>';
			$strhtml .= 	'<tr class="bgClr">';
			$strhtml .= 		'<td class="tengah2" style="width:10%;font-weight: bold;">Nama</td>';
			$strhtml .= 		'<td class="tengah2" style="width:27%;font-weight: bold;">Induk</td>';
			$strhtml .= 		'<td class="tengah2" style="width:10%;font-weight: bold;">Jumlah POIN</td>';
      $strhtml .= 		'<td class="tengah2" style="width:5%;font-weight: bold;">Kelas</td>';
			$strhtml .= 		'<td class="tengah2" style="width:15%;font-weight: bold;">Keterangan</td>';
			$strhtml .= 	'</tr>';

			// $query = $this->db->query("SELECT * FROM `tb_sp` WHERE statusL = '$row->statusL'");
			// foreach($query->result() as $row){
						
			$strhtml .=		'<tr class="polos">';
			$strhtml .= 		'<td class="tengah2">1</td>';
			$strhtml .= 		'<td class="tengah2">8274</td>';
			$strhtml .= 		'<td class="tengah2">Abdul Aziz</td>';
			$strhtml .= 		'<td class="kiri1"><b>40</b></td>';
			$strhtml .= 		'<td class="tengah2">XII IPA 1</td>';
			$strhtml .= 		'<td class="tengah2"><b>SP1</b></td>';
			$strhtml .= 	'</tr>';

			$strhtml .=		'<tr class="polos">';
			$strhtml .= 		'<td class="tengah2">2</td>';
			$strhtml .= 		'<td class="tengah2">9254</td>';
			$strhtml .= 		'<td class="tengah2">Adelia Oix Febriyani</td>';
			$strhtml .= 		'<td class="kiri1"><b>25</b></td>';
			$strhtml .= 		'<td class="tengah2">X B 1</td>';
			$strhtml .= 		'<td class="tengah2"><b>SP1</b></td>';
			$strhtml .= 	'</tr>';

			$strhtml .=		'<tr class="polos">';
			$strhtml .= 		'<td class="tengah2">3</td>';
			$strhtml .= 		'<td class="tengah2">8973</td>';
			$strhtml .= 		'<td class="tengah2">Dwi Yanuar Saputro</td>';
			$strhtml .= 		'<td class="kiri1"><b>30</b></td>';
			$strhtml .= 		'<td class="tengah2">X IPA 1</td>';
			$strhtml .= 		'<td class="tengah2"><b>SP1</b></td>';
			$strhtml .= 	'</tr>';

			$strhtml .=		'<tr class="polos">';
			$strhtml .= 		'<td class="tengah2">4</td>';
			$strhtml .= 		'<td class="tengah2">9259</td>';
			$strhtml .= 		'<td class="tengah2">Asih Dwi Nursanti</td>';
			$strhtml .= 		'<td class="kiri1"><b>45</b></td>';
			$strhtml .= 		'<td class="tengah2">X BHS 1</td>';
			$strhtml .= 		'<td class="tengah2"><b>SP1</b></td>';
			$strhtml .= 	'</tr>';

			$strhtml .=		'<tr class="polos">';
			$strhtml .= 		'<td class="tengah2">5</td>';
			$strhtml .= 		'<td class="tengah2">8975</td>';
			$strhtml .= 		'<td class="tengah2">Eka Puji Lestari</td>';
			$strhtml .= 		'<td class="kiri1"><b>40</b></td>';
			$strhtml .= 		'<td class="tengah2">X IPA 1</td>';
			$strhtml .= 		'<td class="tengah2"><b>SP1</b></td>';
			$strhtml .= 	'</tr>';
			

      $strhtml .= 	'<tr class="bgClr">';
      $strhtml .= 	'</tr>';
			$strhtml .= '</table>';
      $strhtml .= $this->walikelasRaporPDF($no_ujian_smp, $tgl_surat, $kelas);
			$mpdf->WriteHTML($strhtml);
		}
		else
		{
			// Panggil Library mPdf
			$this->load->library('mpdf');
			//$mpdf = new mPDF('utf-8', 'Folio-L', 0, '', $kiri, $kanan, $atas, $bawah, $hdr, $ftr, 'L');	// ---- Cetak landscape
			$mpdf = new mPDF('utf-8', 'Folio-L', 0, '', 10, 10, 10, 10, 5, 15, '');		// ---- Cetak Potrait
			$mpdf->SetHeader('Pelanggaran Siswa||Hal. : {PAGENO} dari {nb}');
			$mpdf->SetFooter('http://'.$website.'|'.$sekolah.' '.$kota.'|e-mail : '.$email);

			// ============= Style =================
			$strhtml = $this->ambilCSSPdf();
			$mpdf->WriteHTML($strhtml);
			$strhtml = '';
			$urut = 0;












			if($semua == 0)
			{
				$query2 = $this->db->query("SELECT * FROM `tb_sp` WHERE id_sp = '$row->id_sp'");
				$query1 = $this->db->select('*')
							->from('tb_sp')
							->join('tb_siswa', 'tb_siswa.no_induk = tb_sp.induk', 'left')
							->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
							->group_by('tb_kelas.kd_kelas')
							->get();
				$jmlKls = $query1->num_rows();
				$query = $this->db->select('*')
							->from('tb_kelas')
							->get();
			}
			foreach($query->result() as $row)
			{
				$klsPlh = $row->kd_kelas;
				$query1 = $this->db->select('*')
							->from('tb_sp')
							->join('tb_siswa', 'tb_siswa.no_induk = tb_sp.induk', 'left')
							->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
							->where('tb_kelas.kd_kelas', $klsPlh)
							->order_by('tb_siswa.nama', 'asc')
							->get();
				if($query1->num_rows() > 0)
				{
					$nomer  = 1;
					$row1 = $query1->row();
					$nama_kelas = 'Surat Peringatan';
					$strhtml = $this->kopSuratPDF();
          $strhtml .= $this->headerRaporPDF1($nama_kelas, $semester, $nama, $tapel, $no_induk, $nisn);
					$strhtml .= '<div style="text-align: center">';
					$strhtml .= 	'<h3>DAFTAR SISWA PENERIMA SP</h3><br/>';
					$strhtml .= 	'<h4 style="margin-top:-34px;">Tanggal : '.$tgl_awal.' s/d '.$tgl_akhir.'</h4><br/>';
					$strhtml .= '</div>';
					$strhtml .=	'<table class="rapor" style="font-size:14px;">';
					$strhtml .= 	'<tr class="bgClr">';
					$strhtml .= 		'<td class="tengah2" rowspan="2" style="width: 2%;font-weight: bold;">No</td>';
					$strhtml .= 	'</tr>';
					$strhtml .= 	'<tr class="bgClr">';
					$strhtml .= 		'<td class="tengah2" style="width:8%;font-weight: bold;">Nama</td>';
					$strhtml .= 		'<td class="tengah2" style="width:5%;font-weight: bold;">Induk</td>';
					$strhtml .= 		'<td class="tengah2" style="width:15%;font-weight: bold;">Jumlah Poin</td>';
					$strhtml .= 		'<td class="tengah2" style="width:25%;font-weight: bold;">Kelas</td>';
					$strhtml .= 		'<td class="tengah2" style="width:6%;font-weight: bold;">Keterangan</td>';
					$strhtml .= 	'</tr>';
					foreach($query1->result() as $row1)
					{
						$nama = $row1->nama;
						$induk   = $row1->induk;
						$jmlh_poin   = $row1->jmlh_poin;
						$tangani = $row1->tangani;
            $kelas = $row1->kelas;
						$sts     = $row1->statusL;
  						if(strtolower($sts) == 'sp1') $status = 'sp1';
  						elseif(strtolower($sts) == 'sp2') $status = 'sp1';
							elseif(strtolower($sts) == 'sp3') $status = 'sp3';
							elseif(strtolower($sts) == 'sp4') $status = 'sp4';
						$strhtml .= 	'<tr class="polos">';
						$strhtml .= 		'<td class="tengah2" style="width:%;font-weight: bold;">'.$nomer.'</td>';
						$strhtml .= 		'<td class="tengah2" style="width:8%;font-weight: bold;">'.$nama.'</td>';
						$strhtml .= 		'<td class="tengah2" style="width:5%;font-weight: bold;">'.$induk.'</td>';
						$strhtml .= 		'<td class="kiri1" style="width:15%;font-weight: bold;">'.$jmlh_poin.'</td>';
						$strhtml .= 		'<td class="kiri1" style="width:25%;font-weight: bold;">'.$kelas.'</td>';
						$strhtml .= 		'<td class="tengah2" style="width:6%;font-weight: bold;">'.$sts.'</td>';
						$strhtml .= 	'</tr>';
						$nomer++;
					}
					$strhtml .= '</table>';
          $strhtml .= $this->walikelasRaporPDF($no_ujian_smp, $tgl_surat, $kelas);

					$mpdf->WriteHTML($strhtml);
					$urut++;
					if($urut < $jmlKls)
						$mpdf->AddPage();
				}
			}
		}

		if($semua == 2)

			$NamaFile   = 'Pelanggaran-'.$nisn.'.pdf';
		elseif($semua == 1)
			$NamaFile   = 'Pelanggaran-'.$kelas.'.pdf';
		else
			$NamaFile   = 'Pelanggaran-All.pdf';
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->Output($NamaFile,'D');

		exit;
	}
}
