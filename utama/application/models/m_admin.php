<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('m_data');
    }
	// =========================
	// # Fungsi Navigasi Admin #
	// =========================

  function showHeaderAdmin()
	 {
		$nama = $this->session->userdata('nama');
		$level    = $this->session->userdata('level');
    $status = $this->session->userdata('status');
		$username = $this->session->userdata('username');
		if($level == 96)
		{
			$query = $this->db->select('*')
					->from('tb_wali')
					->where('kd_guru', $username)
					->get();
			$hasil = $query -> num_rows();
			if($hasil > 0)
			{
				$row = $query->row();
				$kelas = $row->kelas;
			}

		}
    echo
  		'<div class="wrapper">
  			<header class="main-header">
  				<!-- Logo -->
  				<a href="home" class="logo">
  					<!-- logo for regular state and mobile devices -->
  					<span class="logo-lg"><b>A-Pomo</b></span>
  				</a>

  				<!-- Header Navbar: style can be found in header.less -->
  				<nav class="navbar navbar-static-top" role="navigation">
  					<!-- Sidebar toggle button-->
  					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
  						<span class="sr-only">Toggle navigation</span>
  					</a>

  					<!-- Navbar Right Menu -->
  					<div class="navbar-custom-menu">
  						<ul class="nav navbar-nav">
  							<!-- User Account: style can be found in dropdown.less -->
  							<li class="dropdown user user-menu">
  								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  									<img src="'.base_url().'utama/assists/photos/home.png" class="user-image" alt="User Image">
  										<span class="hidden-xs"><font color="yellow"><b>'.$nama.'</b></font></span>
  								</a>
  								<ul class="dropdown-menu">
  									<!-- User image -->
  									<li class="user-header">
  										<img src="'.base_url().'utama/assists/photos/home.png" class="img-circle" alt="User Image">
  											<p>'.$nama.' - ';if($level ==99)echo 'Kepala Sekolah'; elseif ($level ==98) echo 'Administrator'; elseif ($level ==96) echo 'WaliKelas'; echo'</p>
  									</li>
  									<!-- Menu Footer-->
  									<li class="user-footer">
  										<div class="pull-right">
  											<a href="logout" class="btn btn-default btn-flat">Logout</a>
  										</div>
  									</li>
  								</ul>
  							</li>
  						</ul>
  					</div>
  				</nav>
  			</header>

  			<!-- Left side column. contains the logo and sidebar -->
  			<aside class="main-sidebar">
  				<!-- sidebar: style can be found in sidebar.less -->
  				<section class="sidebar">

  					<!-- Sidebar user panel -->
  					<div class="user-panel">
  						<div class="pull-left image">
  							<img src="'.base_url().'utama/assists/photos/home.png" class="img-circle" alt="User Image">
  						</div>
  						<div class="pull-left info">
  							<p><font color="yellow"><b>'.$nama.'</b></font></p>
  							<a href="#"><i class="glyphicon glyphicon-record text-green"></i> Online</a>
  						</div>
  					</div>
  					<!-- /.sidebar user panel -->

  					<!-- sidebar menu: : style can be found in sidebar.less -->
  					<ul class="sidebar-menu" id="ulNavMenu">
  						<li class="header">MAIN NAVIGATION</li>
  						<li>
  							<a href="home">
  								<img src="'.base_url().'utama/assists/images/icons/house.png" width=24 height=24>
  								&nbsp;Beranda
  							</a>
  						</li>';
              if($level >=98)
                echo
              '<li class="treeview">
  							<a href="#">
  								<img src="'.base_url().'utama/assists/images/icons/rar.ico" width=24 height=24>
  								<span>Data Master</span>
  								<span class="pull-right-container">
  									<i class="fa fa-angle-left pull-right"></i>
  								</span>
  							</a>
  							<ul class="treeview-menu">
  								<li>
  									<a href="#" onclick="showDataSekolah()">
  										<img src="'.base_url().'utama/assists/images/icons/house.png" width=24 height=24>
  										&nbsp;Data Sekolah
  									</a>
  								</li>
  								<li>
  								</li>
                  <li>
  									<a href="awal?pl=admin">
  										<img src="'.base_url().'utama/assists/photos/home.png" width=24 height=24>
  										&nbsp;Data Admin
  									</a>
  								</li>
                  <li>
  									<a href="awal?pl=wali&pl1=kelas">
  										<img src="'.base_url().'utama/assists/images/icons/kelas.png" width=24 height=24>
  										&nbsp;Data Kelas
  									</a>
  								</li>
  								<li>
  									<a href="awal?pl=wali&pl1=wali">
  										<img src="'.base_url().'utama/assists/images/icons/guru.png" width=24 height=24>
  										&nbsp;Data Walikelas
  									</a>
  								</li>
  								<li>
  									<a href="awal?pl=siswa">
  										<img src="'.base_url().'utama/assists/images/icons/siswa.ico" width=24 height=24>
  										<span>Data Siswa</span>
  									</a>
                  </li>
  							</ul>';
              echo
            '</li>
  						<li class="treeview">
  							<a href="#">
  								<img src="'.base_url().'utama/assists/images/icons/bk.png" width=24 height=24>
  								<span>Bimbingan & Konseling</span>
  								<span class="pull-right-container">
  									<i class="fa fa-angle-left pull-right"></i>
  								</span>
  							</a>
  							<ul class="treeview-menu">
  								<li>
  									<a href="awal?pl=presensi">
  										<img src="'.base_url().'utama/assists/images/icons/absensi.png" width=24 height=24>
  										&nbsp;Kehadiran Siswa
  									</a>
  								</li>
  								<li>
  									<a href="awal?pl=langgar">
  										<img src="'.base_url().'utama/assists/images/icons/pelanggaran.png" width=24 height=24>
  										&nbsp;Pelanggaran Siswa
  									</a>
  								</li>
                  <li>
  									<a href="awal?pl=pelanggaran">
  										<img src="'.base_url().'utama/assists/images/icons/pelanggaran.png" width=24 height=24>
  										&nbsp;Penerima SP
  									</a>
  								</li>
  							</ul>
  						</li>
  						<li class="treeview">
  						</li>';
              if($level ==98)
                echo
              '<li>
                <a href="#" onclick="kirimPesan2()">
                  <img src="'.base_url().'utama/assists/images/icons/smsgateway.ico" width=24 height=24>
                  &nbsp;Sms Gateway
                </a>
  						</li>';
  						echo
  						'<li>
  							<a href="logout">
  								<img src="'.base_url().'utama/assists/images/icons/logout.png" width=24 height=24>
  								&nbsp;Logout
  							</a>
  						</li>
  					</ul>
  				</section>
  				<!-- /.sidebar -->
  			</aside>
  		</div>';

  		exit;
  	}


	// ===========================
	// # Fungsi Tampil Data Form #
	// ===========================
	function showDataAll()
	{
		$pilih = $this->input->get('pl');
		if(strtolower($pilih) == 'admin')		$this->showDataAdmin();
		elseif(strtolower($pilih) == 'siswa')	$this->showDataSiswa();
		elseif(strtolower($pilih) == 'pesan')	$this->showDataPesan();
		elseif(strtolower($pilih) == 'presensi')$this->showDataPresensi();
		elseif(strtolower($pilih) == 'sp')$this->showDataSuratp();
    elseif(strtolower($pilih) == 'pelanggaran')$this->showDataPelanggaran();
		elseif(strtolower($pilih) == 'langgar')	$this->showDataLanggar();
		elseif(strtolower($pilih) == 'wali')	$this->showDataWali();
		exit;
	}
	// ===========================
	// # Fungsi menghapus 1 item #
	// ===========================
	function hapusData()
	{
		$nomer = $this->input->get('id');
		$pilih = $this->input->get('pl');

		if(strtolower($pilih) == 'siswa')
		{
			$query = $this->db->select('*')
					->from('tb_siswa')
					->where('nisn', $nomer)
					->get();
			if($query->num_rows() > 0)
				$this->db->where('nisn', $nomer)->delete('tb_siswa');
		}
		elseif(strtolower($pilih) == 'admin')
		{
			$query = $this->db->select('*')
					->from('tb_admin')
					->where('username', $nomer)
					->get();
			if($query->num_rows() > 0)
				$this->db->where('username', $nomer)->delete('tb_admin');
		}

		elseif(strtolower($pilih) == 'pelanggaran')
		{
			$query = $this->db->select('*')
					->from('tb_pelanggaran')
					->where('pelanggaran_id', $nomer)
					->get();
			if($query->num_rows() > 0)
				$this->db->where('pelanggaran_id', $nomer)->delete('tb_pelanggaran');
		}
		elseif(strtolower($pilih) == 'langgar')
		{
			$query = $this->db->select('*')
					->from('tb_langgar')
					->where('no', $nomer)
					->get();
			if($query->num_rows() > 0)
				$this->db->where('no', $nomer)->delete('tb_langgar');
		}
		elseif(strtolower($pilih) == 'pesan')
		{
			$query = $this->db->select('*')
					->from('tb_pesan')
					->where('urut', $nomer)
					->get();
			if($query->num_rows() > 0)
				$this->db->where('urut', $nomer)->delete('tb_pesan');
		}

    elseif(strtolower($pilih) == 'sp')
    {
      $query = $this->db->select('*')
          ->from('tb_sp')
          ->where('no', $nomer)
          ->get();

      if($query->num_rows() > 0)
        $this->db->where('no', $nomer)->delete('tb_sp');
    }
		elseif(strtolower($pilih) == 'kelas')
		{
			$query = $this->db->select('*')
					->from('tb_kelas')
					->where('kd_kelas', $nomer)
					->get();
			if($query->num_rows() > 0)
				$this->db->where('kd_kelas', $nomer)->delete('tb_kelas');
			$query = $this->db->select('*')
					->from('tb_wali')
					->where('kelas', $nomer)
					->get();
			if($query->num_rows() > 0)
				$this->db->where('kelas', $nomer)->delete('tb_wali');
		}

		$outp[0] = 'sukses';
		$outp[1] = 'Sukses menghapus data';
		echo json_encode($outp);

		exit;
	}

	// ====================================================
	// # Fungsi menghapus semua data / mengosongkan tabel #
	// ====================================================
	function hapusDataAll()
	{
		$pilih = $this->input->get('id');
		$truncate = '';
		$outp = array();
    if(strtolower($pilih) == 'wali')	$truncate = "TRUNCATE TABLE tb_wali";
		elseif(strtolower($pilih) == 'kelas')	$truncate = "TRUNCATE TABLE tb_kelas";
		if($truncate != '')
		{
			$sql = $this->db->query($truncate);
			if(strtolower($pilih) == 'kelas')
			$sql = $this->db->query("TRUNCATE TABLE tb_wali");
			$outp[0] = 'sukses';
			$outp[1] = 'Tabel berhasil dikosongkan';
		}
		else
		{
			$outp[0] = 'error';
			$outp[1] = 'Tabel gagal dikosongkan';
		}
		$outp[2] = $pilih;
		echo json_encode($outp);

		exit;
	}

	// *******************************************************************************************
	// ***                                   Awal Data Admin                                   ***
	// *******************************************************************************************
	function showDataAdmin()
	{
		$userAktif = $this->session->userdata('username');

		$pilih = $this->input->get('pl');
		if(isset($_GET['id'])) {$username = $_GET['id'];} else {$username = '';}
		if(isset($_GET['cr'])) {$cari = $_GET['cr'];} else {$cari = '';}
		if(isset($_GET['m']))  {$mulai = $_GET['m'];} else {$mulai = 1;}

		echo
    '</br><div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <center><b>Daftar Admin</b></center>
        </div>
        <!-- /.panel-heading -->
    <div class="panel-body">
      <table class="table table-striped table-bordered" id="dataTables-example">
      <thead>
			<tr style="background:darkblue;color:white;">
				<th><center>No.</center></th>
				<th><center>Username</center></th>
				<th><center>Status</center></th>
				<th><center>Login Akhir</center></th>
				<th><center>Status Login</center></th>
				<th><center> # </center></th>
			</tr>
      </thead>
      <tbody>';
				$sts_log = array('Y' => 'Aktif', 'N' => 'Tdk Aktif');
				$jml_data = 20;
				$awal = ($mulai - 1) * $jml_data;
				$nomer = $awal;
				$query = $this->db->select('*')
						->from('tb_admin')
						->limit($jml_data, $awal)
						->order_by('status', 'desc')
						->order_by('nama', 'asc')
						->get();
				foreach($query->result() as $row)
				{
					$nomer++;
					$userid    = $row->username;
					$status     = $row->status;
					$log_akhir  = $row->login_terakhir;
					$sts_login  = $row->login_status;
					if($userid == $userAktif)
						echo '<tr style="background:yellow;color:black;">';
					elseif($userid == $username)
						echo '<tr style="background:red;color:black;">';
					else
						echo '<tr class="gradeA">';
					echo
						'<td><center>'.$nomer.'</center></td>
						<td><center><a href="#" id="'.$userid.'&m='.$mulai.'" onclick="editDataAdmin(this)">'.$userid.'</a></center></td>
					  <td><center><a href="#" id="'.$userid.'&m='.$mulai.'" onclick="editDataAdmin(this)">'.$status.'</a></center></td>
						<td><center><a href="#" id="'.$userid.'&m='.$mulai.'" onclick="editDataAdmin(this)">'.$log_akhir.'</a></center></td>
						<td><center><a href="#" id="'.$userid.'&m='.$mulai.'" onclick="editDataAdmin(this)">'.$sts_log[$sts_login].'</a></center></td>';
					if($userid == $userAktif)
							echo
							'<td>&nbsp;</td>';
						else
							echo
							'<td><center>
								<a href="#" id="'.$userid.'&pl=admin" onclick="hapusData(this)">
									<img src="'.base_url().'utama/assists/images/icons/hapus.png" width=20 height=20>
								</a></center>
							</td>';
						echo
						'</tr>';
					}
					if($nomer == 0)
						echo
						'<tr style="background:red;color:yellow;">
							<td colspan="7"><b><center>Tidak ada data</center></b></td>
						</tr>';
				echo
			'</tbody>
		   </table>
    		</div>
				<center>
					<a href="#" id="admin" class="btn btn-success" onclick="editDataAdmin(this)">
						<img src="'.base_url().'utama/assists/images/icons/add.png" width=24 height=24> Tambah Data
					</a>
				</center>
				<br />
			</div>
		</div>';
		exit;
	}

	// =====================
	// # Fungsi Edit Admin #
	// =====================
	function showAdminModal()
	{
		$username = $this->input->get('id');

		if($username == 'admin')
		{
			$username = '';
			$password = '';
			$nama     = '';
			$status   = '';
		}
		else
		{
			$query = $this->db->select('*')
					->from('tb_admin')
					->where('username', $username)
					->get();
			$row = $query->row();
			$password = $this->m_data->decryptIt($row->password);
			$nama     = $row->nama;
			$status   = $row->status;
		}

		$sts_arr = array('Administrator', 'Kepsek');
		echo
				'<!-- modal-dialog -->
				<div class="modal-dialog" role="document">
					<!-- modal-content -->
					<div class="modal-content" style="background:green;border-radius: 15px;">
						<!-- modal header -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="modal-title" id="isianAdminLabel" style="margin-bottom:0px;margin-top:0px;color: yellow;">
								<center><b>Edit Data Admin</b></center>
							</h3>
						</div>
						<!-- ./modal header -->
						<!-- modal body -->
						<div class="modal-body" id="isianDataAdmin">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label style="color: white;">
											Username :
										</label>
								<input type="text" class="form-control" name="username" id="username" value="'.$username.'">
							</div>
							<div class="form-group">
  								<label style="color: white;">
  									Nama :
  								</label>
  								<input type="text" class="form-control" name="nama" id="nama" value="'.$nama.'">
							</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<!-- /input-group -->
									<label style="color: white;">
										Password :
									</label>
									<div class="input-group margin" style="margin-top:0px;margin-left:0px;">
										<input type="password" class="form-control" id="password" name="password" value="'.$password.'">
										<span class="input-group-btn">
											<button type="button" class="btn btn-info btn-flat" style="margin-top:-1px;height:35px;border-radius:6px;" onclick="showHidePass();">
												<i id="simbol" class="glyphicon glyphicon-eye-open"></i>
											</button>
										</span>
									</div>
									<!-- ./input-group -->
								</div>
								<div class="form-group">
									<label style="color: white;">
										Level :
									</label>
									<select class="form-control" name="status" id="status">';
										for($i = 0; $i < count($sts_arr); $i++)
										{
											if($status == $sts_arr[$i])
											echo
											'<option value="'.$sts_arr[$i].'" selected> '.$sts_arr[$i].'</option>';
											else
											echo
											'<option value="'.$sts_arr[$i].'"> '.$sts_arr[$i].'</option>';
										}
											echo
									'</select>
								</div>
							</div>
						</div>
							<!-- ./row -->
						</div>
						<!-- ./modal body -->

						<!-- modal footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-warning pull-left" data-dismiss="modal" style="border-radius:8px;">
								<img src="'.base_url().'utama/assists/images/icons/hapus.png" width=20 height=20> Batal
							</button>
							<button type="button" class="btn btn-primary" onClick="simpanDataAdmin()" style="border-radius:8px;">
								<img src="'.base_url().'utama/assists/images/icons/accept.png" width=20 height=20> Simpan
							</button>
						</div>
						<!-- ./modal footer -->
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->';
		exit;
	}
	// ============================
	// # Fungsi simpan data admin #
	// ============================
	public function simpanDataAdmin()
	{
		$username = $this->input->post('username');
		$password = $this->m_data->encryptIt($this->input->post('password'));
		$nama     = $this->input->post('nama');
		$status   = $this->input->post('status');
		$data = array(
					'username' => $username,
					'password' => $password,
					'nama' => $nama,
					'status' => $status
					);

		$query = $this->db->select('*')
				->from('tb_admin')
				->where('username', $username)
				->get();
		$rowcounts = $query->num_rows();
		if($rowcounts > 0)
			$this->db->where('username', $username)->update('tb_admin', $data);
		else
			$this->db->insert('tb_admin', $data);

		$outp[0] = 'sukses';
		if($rowcounts > 0)
			$outp[1] = 'Sukses merubah data Admin';
		else
			$outp[1] = 'Sukses menambah data Admin';
		echo json_encode($outp);

		exit;
	}

	// **********************************************************************************************
	// ***                                   Akhir Fungsi Admin                                   ***
	// **********************************************************************************************

	// *********************************************************************************************
	// ***                                   Awal Data Sekolah                                   ***
	// *********************************************************************************************
	function showDataSekolah()
	{
		date_default_timezone_set("Asia/Jakarta");
		$level    = $this->session->userdata('level');

		$query = $this->db->select('*')
				->from('tb_sekolah')
				->get();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$nama_sekolah	= $row->nama_sekolah;
			$alamat			= $row->alamat;
			$kota			  = $row->kota;
			$propinsi		= $row->propinsi;
			$kepsek			= $row->kepsek;
			$nip			  = $row->nip;
			$website		= $row->website;
			$email			= $row->email;
			$tapel			= $row->tapel;
			$semester		= $row->semester;
		}
		else
		{
			$nama_sekolah	= '';
			$alamat			= '';
			$kota			= '';
			$propinsi		= '';
			$kepsek			= '';
			$nip			= '';
			$website		= '';
			$email			= '';
			$tapel			= 2017;
			$semester		= 1;
		}
		$tingkat = 9;

		echo
		'<!-- modal-dialog -->
		<div class="modal-dialog modal-lg" role="document">
			<!-- modal-content -->
			<div class="modal-content" style="background: green; border-radius: 15px;">
				<!-- modal header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title" id="dataSekolahLabel" style="margin-bottom:0px;margin-top:0px;color: yellow;">
						<center><b>
						<img src="'.base_url().'utama/assists/images/icons/house.png" width=32 height=32> Data Sekolah
						</b></center>
					</h3>
				</div>
				<!-- ./modal header -->

				<!-- modal body -->
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
            <!-- ----- Kolom 1 ------ -->
							<div class="form-group">
								<label style="color: white;">
									Nama Sekolah : (tanpa kota)
								</label>
								<input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" value="'.$nama_sekolah.'">
							</div>
							<div class="form-group">
								<label style="color: white;">
									Alamat :
								</label>
								<input type="text" class="form-control" name="alamat" id="alamat" value="'.$alamat.'">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label style="color: white;">
											Kabupaten / Kota :
										</label>
										<input type="text" class="form-control" name="kota" id="kota" value="'.$kota.'">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label style="color: white;">
											Provinsi :
										</label>
										<input type="text" class="form-control" name="propinsi" id="propinsi" value="'.$propinsi.'">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
            <!-- ----- Kolom 2 ------ -->
							<div class="form-group">
								<label style="color: white;">
									Nama Kepala Sekolah :
								</label>
								<input type="text" class="form-control" name="kepsek" id="kepsek" value="'.$kepsek.'">
							</div>
							<div class="form-group">
								<label style="color: white;">
									NIP Kepala Sekolah :
								</label>
								<input type="text" class="form-control" name="nip" id="nip" value="'.$nip.'">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label style="color: white;">
											Tahun Pelajaran :
										</label>
										<input type="number" class="form-control" name="tapel" id="tapel" value="'.$tapel.'" oninput="rubahTapel(this)">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label id="tapel1" style="color: white;margin-left: -20px;margin-top:30px;">';
											echo '- '.($tapel + 1);
										echo
										'</label>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
            <!-- ----- Kolom 3 ------ -->
							<div class="form-group">
								<label style="color: white;">
									Website : (tanpa http)
								</label>
								<input type="text" class="form-control" name="website" id="website" value="'.$website.'">
							</div>
							<div class="form-group">
								<label style="color: white;">
									Email :
								</label>
								<input type="text" class="form-control" name="email" id="email" value="'.$email.'">
							</div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label style="color: white;">
                      Semester :
                    </label>
                    <select class="form-control" name="semester" id="semester">
                      <option value="1" ';if($semester == 1) echo ' selected ';echo '> Ganjil </option>
                      <option value="2" ';if($semester == 2) echo ' selected ';echo '> Genap </option>
                    </select>
                  </div>
                </div>
              </div>
						</div>
					</div>
					<hr />
					<div class="row">';
					$kls_array = array('X', 'XI', 'XII');
					for($i = 0; $i < 3; $i++)
					{
						echo
						'<div class="col-md-4">
							<h4 style="margin-bottom:0px;margin-top:-6px;color: yellow;">
								<center><b>Kelas '.$kls_array[$i].'</b></center>
							</h4><br/>
							<table style="width: 100%; border-collapse: collapse;margin-top: -10px;">
								<tr style="background-color: cyan; border: 1px solid black;">
									<td style="text-align: center; padding: 4px 0; horizontal-align:middle; border: 1px solid black;">
										<b>Prodi</b>
									</td>
									<td style="text-align: center; padding: 4px 0; horizontal-align:middle; border: 1px solid black;">
										<b>Rombel</b>
									</td>
									<td style="text-align: center; padding: 4px 0; horizontal-align:middle; border: 1px solid black;">
										<b>Siswa</b>
									</td>
									<td style="text-align: center; padding: 4px 0; horizontal-align:middle; border: 1px solid black;">
										<b>Maksi</b>
									</td>
								</tr>';
								$tingkat++;
								$query = $this->db->select('*')
											->from('tb_kelas')
											->where('tingkat', $tingkat)
											->group_by('kd_prodi')
											->order_by('kd_prodi', 'desc')
											->get();
								if($query->num_rows() > 0)
								{
									foreach($query->result() as $row)
									{
										$prodi = $row->kd_prodi;
										$maksi = $row->maksi;
										$rata2 = $row->siswa;
										$query1 = $this->db->select('*')
													->from('tb_siswa')
													->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
													->where('tb_kelas.tingkat', $tingkat)
													->where('tb_kelas.kd_prodi', $prodi)
													->get();
										$jml_siswa = $query1->num_rows();

										$jmlMaksi = 0;
										$query1 = $this->db->select('*')
													->from('tb_kelas')
													->where('tingkat', $tingkat)
													->where('kd_prodi', $prodi)
													->get();
										$jml_rombel = $query1->num_rows();
										foreach($query1->result() as $row1)
										{
											$jmlMaksi += $row1->siswa;
										}
										echo
										'<tr style="background-color: white; border: 1px solid black;">
											<td style="text-align: center; padding: 4px 0; horizontal-align:middle; border: 1px solid black;">
												<b>'.$prodi.'</b>
											</td>
											<td style="text-align: center; padding: 4px 0; horizontal-align:middle; border: 1px solid black;">
												<b>'.$jml_rombel.'</b>
											</td>
											<td style="text-align: center; padding: 4px 0; horizontal-align:middle; border: 1px solid black;">
												<b>'.$jml_siswa.'</b>
											</td>
											<td style="text-align: center; padding: 4px 0; horizontal-align:middle; border: 1px solid black;">
												<b>'.$jmlMaksi.'</b>
											</td>
										</tr>';
									}
								}
								echo
							'</table>
						</div>';
					}
					echo
					'</div>
				</div>
				<!-- ./modal body -->

				<!-- modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-warning pull-left" data-dismiss="modal" style="border-radius:8px;">
						<img src="'.base_url().'utama/assists/images/icons/hapus.png" width=20 height=20> Close
					</button>';
					if($level > 95)
						echo
					'<button type="button" class="btn btn-primary" onClick="simpanDataSekolah()" style="border-radius:8px;">
						<img src="'.base_url().'utama/assists/images/icons/accept.png" width=20 height=20> Simpan
					</button>';
					echo
				'</div>
				<!-- ./modal footer -->
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->';

		exit;
	}

	// ==============================
	// # Fungsi simpan data sekolah #
	// ==============================
	function simpanDataSekolah()
	{
		date_default_timezone_set("Asia/Jakarta");
		$namaSekolah = $this->input->post('nama_sekolah');
		$alamat		 = $this->input->post('alamat');
		$kota		 = $this->input->post('kota');
		$propinsi	 = $this->input->post('propinsi');
		$tanggal	 = $this->input->post('tanggal');
		$kepsek		 = $this->input->post('kepsek');
		$nip		 = $this->input->post('nip');
		$tapel	 	 = $this->input->post('tapel');
		$semester	 = $this->input->post('semester');
		$website	 = $this->input->post('website');
		$email	 	 = $this->input->post('email');
		$data	= array(
						'nama_sekolah' => $namaSekolah,
						'alamat' => $alamat,
						'kota' => $kota,
						'propinsi' => $propinsi,
						'tanggal' => $tanggal,
						'kepsek' => $kepsek,
						'nip' => $nip,
						'tapel' => $tapel,
						'semester' => $semester,
						'website' => $website,
						'email' => $email
						);
		$query = $this->db->select('*')
				->from('tb_sekolah')
				->get();
		$rowcounts = $query->num_rows();
		if($rowcounts > 0)
			$this->db->update('tb_sekolah', $data);
		else
			$this->db->insert('tb_sekolah', $data);

		$outp[0] = 'sukses';
		if($rowcounts > 0)
			$outp[1] = 'Sukses merubah data Sekolah';
		else
			$outp[1] = 'Sukses menambah data Sekolah';
		echo json_encode($outp);
		exit;
	}

	// **********************************************************************************************
	// *********************************     Akhir Data Sekolah     *********************************
	// **********************************************************************************************


	// ************************************************************************************************
	// **********************************    Awal Data Wali Kelas     *********************************
	// ************************************************************************************************
	function showDataWali()
	{
		$pilih = $this->input->get('pl');
		$pilih1 = $this->input->get('pl1');
		if(isset($_GET['id'])) {$username = $_GET['id'];} else {$username = '';}
		if(isset($_GET['cr'])) {$cari = $_GET['cr'];} else {$cari = '';}
		if(isset($_GET['m']))  {$mulai = $_GET['m'];} else {$mulai = 1;}

		$level    = $this->session->userdata('level');

		echo
    '</br>
    <div class="col-md-12">
        <div class="panel-heading">
        </div>
        <!-- /.panel-heading -->
				<input type="hidden" name="pilih" id="pilih" value="'.$pilih1.'">
        <div class="panel panel-primary">
				<!--
        <div class="panel-heading">';
					if($pilih1 == 'wali')
            echo '<center><b><i>Daftar Wali Kelas</i></b></center>';
					else
            echo '<center><b><i>Daftar Wali Kelas</i></b></center>';
            echo
				'</div>
         <!-- /.panel-heading -->
         <div class="panel-body">
  				<div class="row">';
  					$noKls = '';
  					$sts_log = array('Y' => 'Aktif', 'N' => 'Tidak');
  					$nomer = 0;
  					$jml_data = 0;
  					if($pilih1 == 'wali')
  						$query = $this->db->select('*')
							->from('tb_kelas')
							->join('tb_wali', 'tb_kelas.kd_kelas = tb_wali.kelas', 'left')
							->order_by('tb_kelas.kd_kelas', 'asc')
							->get();
						else
							$query = $this->db->select('*')
										->from('tb_kelas')
										->order_by('kd_kelas', 'asc')
										->get();
						foreach($query->result() as $row)
						{
							$kelas      = $row->kd_kelas;
							$nama_kelas = $row->nama_kelas;
							if($pilih1 == 'wali') $nama_guru  = $row->nama; else
							{
								$prodi = $row->kd_prodi;
								$jml_siswa = $row->siswa;
							}
									//if($nama_guru != '') $jml_data++;
  						if(substr($kelas,0,2) != $noKls)
  						{
  							$noKls = substr($kelas, 0, 2);
  							echo
  							'<div class="col-md-4">
  								<table width="100%" class="table table-striped table-bordered table-hover">
  									<thead>
  										<tr style="background:#008B8B;color:white;">
  											<th><center>No</center></th>';
  											if($pilih1 == 'wali')
  												echo
  											'<th><center>Kelas</center></th>
  											<th><center>Nama</center></th>';
  											else
													echo
												'<th><center>Kode</center></th>
												<th><center>Kelas</center></th>
												<th><center>Prodi</center></th>
												<th><center>Siswa</center></th>
												<th><center>Aksi</center></th>';
												echo
											'</tr>
										</thead>
										<tbody>';
									}
							if($kelas == $username)
								echo
								'<tr style="background:yellow;color:red;">';
							else
								echo
								'<tr class="gradeA">';
									if($pilih1 == 'wali')
										echo
											'<td><center>'.($nomer + 1).'</center></td>
											<td><center><a href="#" id="pl=wali&pl1=wali&id='.$kelas.'" onclick="editDataWali(this)">'.$nama_kelas.'</a></center></td>
											<td><a href="#" id="pl=wali&pl1=wali&id='.$kelas.'" onclick="editDataWali(this)">'.$nama_guru.'</a></td>
										</tr>';
									else
									{
										echo
											'<td><center>'.($nomer + 1).'</center></td>
											<td><center><a href="#" id="pl=wali&pl1=kelas&id='.$kelas.'" onclick="editDataWali(this)">'.$kelas.'</a></center></td>
											<td><center><a href="#" id="pl=wali&pl1=kelas&id='.$kelas.'" onclick="editDataWali(this)">'.$nama_kelas.'</a></center></td>
											<td><center><a href="#" id="pl=wali&pl1=kelas&id='.$kelas.'" onclick="editDataWali(this)">'.$prodi.'</a></center></td>
											<td><center><a href="#" id="pl=wali&pl1=kelas&id='.$kelas.'" onclick="editDataWali(this)">'.$jml_siswa.'</a></center></td>
											<td>
										<center>';
										if($level > 94)
											echo
											'<a href="#" id="'.$kelas.'&pl=kelas" onclick="hapusData(this)">
												<img src="'.base_url().'utama/assists/images/icons/hapus.png" width=20 height=20>
											</a>';
										else
											echo '&nbsp;';
										echo
										'</center>
									</td>
								</tr>';
								}
								$nomer++;
								$row1 = $query->row($nomer);
								$cekKls = substr($row1->kd_kelas, 0, 2);
								if(($cekKls != $noKls) or ($nomer >= $query->num_rows()))
								{
									echo	'</tbody>
										</table>
									</div>';
								}
							}
					if($nomer == 0)
						echo '<b><center>Tidak ada data</center></b><br/>';
					echo
				'</div>';
				if(($pilih1 == 'wali') and ($level > 95))
					echo
				'<br>
				<center>
					<a href="#" id="wali" class="btn btn-danger" onclick="hapusDataAll(this)">
						<img src="'.base_url().'utama/assists/images/icons/stop.ico" width=24 height=24> Hapus Semua Data
					</a>
				</center>';
				elseif($level > 95)
								echo
							'<center>
								<a href="#" id="pl=wali&pl1=kelas&id=" class="btn btn-success" onclick="editDataWali(this)">
									<img src="'.base_url().'utama/assists/images/icons/add.png" width=24 height=24> Tambah Data
								</a>
							</center>';
							echo
						'</div>
					</div>
				</div>';
		exit;
	}

	// ===============================
	// # Fungsi Edit Data Wali Kelas #
	// ===============================
	function showWaliModal()
	{
		$level    = $this->session->userdata('level');
		$username = $this->session->userdata('username');
		if($level == 94)
		{
			$query = $this->db->select('*')
					->from('tb_wali')
					->where('kd_guru', $username)
					->get();
			$hasil = $query -> num_rows();
			if($hasil > 0)
			{
				$row = $query->row();
				$kelasM = $row->kelas;
			}
			else
				$kelasM = '';

		}

    $pilih = $this->input->get('pl');
  		$pilih1 = $this->input->get('pl1');
  		$kelas = $this->input->get('id');

  		if($pilih1 == 'wali')
  		{
  			$query = $this->db->select('*')
  					->from('tb_kelas')
  					->join('tb_wali', 'tb_wali.kelas = tb_kelas.kd_kelas', 'left')
  					->where('tb_kelas.kd_kelas', $kelas)
  					->get();
  			$row = $query->row();
  			$nama_kelas	= $row->nama_kelas;
  			$prodi		= $row->kd_prodi;
  			$nama_wali	= $row->nama;
  			$kd_guru	= $row->kd_guru;
  			$password	= $this->m_data->decryptIt($row->password);
  			$nip		= $row->nip;
  			$golongan	= $row->golongan;
  			$pangkat	= $row->pangkat;
  		}
  		else
  		{
  			if($kelas != '')
  			{
  				$query = $this->db->select('*')
  							->from('tb_kelas')
  							->where('kd_kelas', $kelas)
  							->get();
  				$row = $query->row();
  				$nama_kelas = $row->nama_kelas;
  				$prodi      = $row->kd_prodi;
  				$jml_siswa  = $row->siswa;
  				$tingkat    = $row->tingkat;
  				$maksi      = $row->maksi;
  			}
  			else
  			{
  				$nama_kelas	= '';
  				$prodi		= '';
  				$jml_siswa  = 0;
  				$tingkat    = 10;
  				$maksi      = 40;
  			}
  		}

  		echo
  				'<!-- modal-dialog -->
  				<div class="modal-dialog" role="document">
  					<!-- modal-content -->
  					<div class="modal-content" style="background: green;border-radius: 10px;">
  						<!-- modal header -->
  						<div class="modal-header">
  							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  							<h3 class="modal-title" id="isianAdminLabel" style="margin-bottom:0px;margin-top:0px;color: yellow;">';
  							if($pilih1 == 'wali')
  								echo
  								'<center><b>
  									<img src="'.base_url().'utama/assists/images/icons/group.png" width=32 height=32> Edit Wali Kelas
  								</b></center>';
  							else
  							{
  								if($kelas == '')
  									echo
  									'<center><b>
  										<img src="'.base_url().'utama/assists/images/icons/add.png" width=32 height=32> Tambah Kelas
  									</b></center>';
  								else
  									echo
  									'<center><b>
  										<img src="'.base_url().'utama/assists/images/icons/kelas.png" width=32 height=32> Edit Kelas
  									</b></center>';
  							}
  							echo
  							'</h3>
  						</div>
  						<!-- ./modal header -->

  						<!-- modal body -->
  						<div class="modal-body" id="isianDataWali">
  						<input type="hidden" name="pilihM" id="pilihM" value="'.$pilih1.'">';
  						if($pilih1 == 'wali')
  						{
  							echo
    							'<input type="hidden" name="kelasM" id="kelasM" value="'.$kelas.'">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-group">
  										<label style="color: white;">
  											Kelas :
  										</label>
  										<input type="text" class="form-control" name="nama_kelas" id="nama_kelas" value="'.$nama_kelas.'" disabled>
  									</div>
  									<div class="form-group">
  										<label style="color: white;">
  											Kode Guru :
  										</label>
  										<input type="text" class="form-control" name="kd_guru" id="kd_guru" value="'.$kd_guru.'">
  									</div>
  									<div class="form-group">
  										<label style="color: white;">
  											Nama Guru :
  										</label>
  										<input type="text" class="form-control" name="nm_wali" id="nm_wali" value="'.$nama_wali.'">
  									</div>
  									<div class="form-group">
  										<!-- /input-group -->
  										<label style="color: white;">
  											Password :
  										</label>
  										<div class="input-group margin" style="margin-top:0px;margin-left:0px;">
  											<input type="password" class="form-control" id="password" name="password" value="'.$password.'">
  											<span class="input-group-btn">
  												<button type="button" class="btn btn-info btn-flat" style="margin-top:-1px;height:35px;border-radius:6px;" onclick="showHidePass();">
  													<i id="simbol" class="glyphicon glyphicon-eye-open"></i>
  												</button>
  											</span>
  										</div>
  										<!-- ./input-group -->
  									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-group">
  										<label style="color: white;">
  											N I P :
  										</label>
  										<input type="text" class="form-control" name="nip" id="nip" value="'.$nip.'">
  									</div>
  									<div class="form-group">
  										<label style="color: white;">
  											Pangkat :
  										</label>
  										<input type="text" class="form-control" name="pangkat" id="pangkat" value="'.$pangkat.'">
  									</div>
  									<div class="form-group">
  										<label style="color: white;">
  											Golongan :
  										</label>
  										<input type="text" class="form-control" name="golongan" id="golongan" value="'.$golongan.'">
  									</div>
  								</div>
  							</div>
  							<!-- ./row -->';
  						}
  						else
  						{
  							echo
  							'<div class="row">
  								<div class="col-md-2">
  									<div class="form-group">
  										<label style="color: white;">
  											Kode :
  										</label>
  										<input type="text" class="form-control" name="kelasM" id="kelasM" value="'.$kelas.'" ';if($kelas != '') echo ' disabled '; echo '>
  									</div>
  								</div>
  								<div class="col-md-3">
  									<div class="form-group">
  										<label style="color: white;">
  											Nama Kelas :
  										</label>
  										<input type="text" class="form-control" name="nm_kelas" id="nm_kelas" value="'.$nama_kelas.'">
  									</div>
  								</div>
  								<div class="col-md-7">
  									<div class="form-group">
  										<label style="color: white;">
  											Prodi :
  										</label>
  										<select class="form-control" name="prodiM" id="prodiM" value="'.$prodi.'">';
  										$query = $this->db->select('*')
  													->from('tb_prodi')
  													->get();
  										foreach($query->result() as $row)
  										{
  											$kd_prodi = $row->prodi;
  											$nm_prodi = $row->nama_prodi;
  											if($kd_prodi == $prodi)
  												echo
  												'<option value="'.$kd_prodi.'" selected > '.$nm_prodi.' </option>';
  											else
  												echo
  												'<option value="'.$kd_prodi.'" > '.$nm_prodi.' </option>';
  										}
  										echo
  										'</select>
  									</div>
  								</div>
  							</div>
  							<div class="row">
  								<div class="col-md-4">
  									<div class="form-group">
  										<label style="color: white;">
  											Tingkat :
  										</label>
  										<input type="number" class="form-control" min="10" max="12" name="tingkat" id="tingkat" value="'.$tingkat.'" >
  									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
  										<label style="color: white;">
  											Jml Siswa :
  										</label>
  										<input type="number" class="form-control" min="30" max="40" name="jml_siswa" id="jml_siswa" value="'.$jml_siswa.'" >
  									</div>
  								</div>
  								<div class="col-md-4">
  									<div class="form-group">
  										<label style="color: white;">
  											Jml Siswa Maks. :
  										</label>
  										<input type="number" class="form-control" min="30" max="40" name="maksi" id="maksi" value="'.$maksi.'" >
  									</div>
  								</div>
  							</div>';
  						}
  						echo
  						'</div>
  						<!-- ./modal body -->

  						<!-- modal footer -->
  						<div class="modal-footer">
  							<button type="button" class="btn btn-warning pull-left" data-dismiss="modal" style="border-radius:8px;">
  								<img src="'.base_url().'utama/assists/images/icons/hapus.png" width=20 height=20> Close
  							</button>';
  							if(($level > 95) or (($level == 94) and ($kelas == $kelasM)))
  								echo
  							'<button type="button" class="btn btn-primary" onClick="simpanDataWali()" style="border-radius:8px;">
  								<img src="'.base_url().'utama/assists/images/icons/accept.png" width=20 height=20> Simpan
  							</button>';
  							echo
  						'</div>
  						<!-- ./modal footer -->
  					</div>
  					<!-- /.modal-content -->
  				</div>
  				<!-- /.modal-dialog -->';
  		exit;
  	}

  	// =================================
  	// # Fungsi simpan Data Wali Kelas #
  	// =================================
  	function simpanDataWali()
  	{
  		$pilih = $this->input->post('pilih');
  		if($pilih == 'wali')
  		{
  			$kelas = $this->input->post('kelas');
  			$data = array(
  							'kelas'		=> $kelas,
  							'kd_guru'	=> $this->input->post('kd_guru'),
  							'password'	=> $this->m_data->encryptIt($this->input->post('password')),
  							'nama'		=> $this->input->post('nm_wali'),
  							'nip'		=> $this->input->post('nip'),
  							'pangkat'	=> $this->input->post('pangkat'),
  							'golongan'	=> $this->input->post('golongan')
  						);
  			$query = $this->db->select('*')
  						->from('tb_wali')
  						->where('kelas', $kelas)
  						->get();
  			if($query->num_rows() > 0)
  				$this->db->where('kelas', $kelas)->update('tb_wali', $data);
  			else
  				$this->db->insert('tb_wali', $data);
  		}
  		else
  		{
  			$kd_kelas = $this->input->post('kelas');
  			$data = array(
  						'kd_kelas'		=> $kd_kelas,
  						'nama_kelas'	=> $this->input->post('nm_kelas'),
  						'kd_prodi'		=> $this->input->post('prodi'),
  						'tingkat'		=> $this->input->post('tingkat'),
  						'siswa'			=> $this->input->post('siswa'),
  						'maksi'			=> $this->input->post('maksi')
  						);
  			$query = $this->db->select('*')
  						->from('tb_kelas')
  						->where('kd_kelas', $kd_kelas)
  						->get();
  			if($query->num_rows() > 0)
  				$this->db->where('kd_kelas', $kd_kelas)->update('tb_kelas', $data);
  			else
  			{
  				$this->db->insert('tb_kelas', $data);
  				$data = array('kelas' => $kd_kelas);
  				$this->db->insert('tb_wali', $data);
  			}
  		}
  		$outp = array();
  		$outp[0] = 'sukses';
  		if($pilih == 'wali')
  			$outp[1] = 'Sukses menyimpan data Walikelas';
  		else
  			$outp[1] = 'Sukses menyimpan data Kelas';
  		echo json_encode($outp);
  		exit;
  	}
	// *************************************************************************************************
	// *********************************     Akhir Data Wali Kelas     *********************************
	// *************************************************************************************************

	// *******************************************************************************************
	// **********************************    Awal Data Siswa     *********************************
	// *******************************************************************************************
  function showDataSiswa()
  	{
  		$level    = $this->session->userdata('level');
  		$username = $this->session->userdata('username');

  		$pilih = $this->input->get('pl');
  		if(isset($_GET['id'])) {$nisn = $_GET['id'];} else {$nisn = '';}
  		if(isset($_GET['cr'])) {$cari = $_GET['cr'];} else {$cari = '';}
  		if(isset($_GET['m']))  {$mulai = $_GET['m'];} else {$mulai = 1;}
  		if(isset($_GET['sr'])) {$urut = $_GET['sr'];} else {$urut = '';}
  		if(isset($_GET['ur'])) {$naik = $_GET['ur'];} else {$naik = '';}
  		$kelas = $this->input->get('kl');

  		if($level == 94)
  		{
  			$query = $this->db->select('*')
  					->from('tb_wali')
  					->where('kd_guru', $username)
  					->get();
  			$hasil = $query -> num_rows();
  			if($hasil > 0)
  			{
  				$row = $query->row();
  				$kelas = $row->kelas;
  				$username = $row->kd_guru;
  			}

  		}
  		echo
  				'<div class="col-md-12">
          </br>
  					<input type="hidden" id="userId" name="userId" value="'.$nisn.'">
  					<input type="hidden" id="mulai"  name="userId" value="'.$mulai.'">
  					<input type="hidden" id="urut"   name="userId" value="'.$urut.'">
  					<input type="hidden" id="naik"   name="userId" value="'.$naik.'">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <center><b>Daftar Siswa</b></center>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
  							<div class="row">
  								<div class="col-md-6">
  									<div class="form-horizontal">
  										<div class="form-group">
  											<label for="inputCetak" class="col-md-2 control-label">Kelas :</label>
  											<div class="col-md-4" style="margin-top:4px;margin-left:0px;">
  												<input type="radio" id="semua" name="semua" value="0" ';if(($kelas == '') or ($kelas == 'x')) echo 'checked ';if($level < 95) echo ' disabled '; echo 'onclick="showKelasData(this)"> Semua
  												&nbsp;
  												<input type="radio" id="kelasP" name="semua" value="1" ';if($kelas != '') echo 'checked ';if($level < 95) echo ' disabled '; echo 'onclick="showKelasData(this)"> Per Kelas
  											</div>';
  											if($kelas == '')
  												echo
  												'<div class="col-md-5" id="idKelas" style="display:none;margin-top:4px;">';
  											else
  												echo
  												'<div class="col-md-5" id="idKelas" style="margin-top:4px;">';
  											echo
  												'<label for="inputCetak" class="col-md-5 control-label" style="margin-top:-4px;margin-left:-26px;">Kelas :</label>
  												<select class="col-md-7" id="kelasSelect" name="kelasSelect" style="margin-top:-2px;margin-left:0px;height:32px;" oninput="rubahKelasData()" ';if($level < 95) echo ' disabled ';echo '>';
  													$query = $this->db->select('*')
  																->from('tb_kelas')
  																->get();
  													if($query->num_rows() > 0)
  													{
  														foreach($query->result() as $row)
  														{
  															$kd_kelas = $row->kd_kelas;
  															if($kelas == $kd_kelas)
  																echo '<option value="'.$row->kd_kelas.'" selected> '.$row->nama_kelas.'</option>';
  															else
  																echo '<option value="'.$row->kd_kelas.'"> '.$row->nama_kelas.'</option>';
  														}
  													}
  												echo
  												'</select>
  											</div>
  										</div>
  									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="form-horizontal">
  										<div class="form-group">
  											<label for="inputCari" class="col-md-1 control-label">Cari</label>
  											<div class="col-md-8">
  												<div class="input-group margin" style="margin-top:0px;margin-left:0px;">
  													<input type="text" class="form-control" id="cari" name="cari" value="'.$cari.'">
  													<span class="input-group-btn">
  														<button type="button" class="btn btn-info" style="margin-top:-1px;height:35px;border-radius:6px;" onclick="cariDataSiswa();">
  															<img src="'.base_url().'utama/assists/images/icons/Search2.ico" width=20 height=20>
  														</button>
  													</span>
  												</div>
  											</div>
  										</div>
  									</div>
  								</div>
  							</div>

               <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
               <thead>
  									<tr style="background:#008B8B;">
                    <th><center><label style="color : white;">No.</label></center></th>
                    <th>
  											<label class="pull-left" style="margin-top: 6px; color : white;">User ID&nbsp;';
  												if(($urut == 'nisn') and ($naik == 'asc'))
  													echo '<img src="'.base_url().'utama/assists/images/icons/arrow_up.png" width=20 height=20>';
  												elseif(($urut == 'nisn') and ($naik == 'desc'))
  													echo '<img src="'.base_url().'utama/assists/images/icons/arrow_down.png" width=20 height=20>';
  												echo
  											'</label>';
  											if(($urut == 'nisn') and ($naik == 'asc'))
  												echo
  												'<button class="btn btn-warning pull-right" id="pl=siswa&m=1&cr='.$cari.'&sr=nisn&ur=desc" style="background-color: #008B8B;border: none;" onclick="showPage(this)">
  													<img src="'.base_url().'utama/assists/images/icons/sort_descending.png" width=20 height=20>
  												</button>';
  											else
  												echo
  												'<button class="btn btn-warning pull-right" id="pl=siswa&m=1&cr='.$cari.'&sr=nisn&ur=asc" style="background-color: #008B8B;border: none;" onclick="showPage(this)">
  													<img src="'.base_url().'utama/assists/images/icons/sort_ascending.png" width=20 height=20>
  												</button>';
  											echo
  										'</th>';
  										if(($kelas == '') or ($kelas == 'x'))
  										{
  											echo
                      '<th>
  											<label class="pull-left" style="margin-top: 6px;color:white;">Kelas&nbsp;';
  												if(($urut == 'kelas') and ($naik == 'asc'))
  													echo '<img src="'.base_url().'utama/assists/images/icons/arrow_up.png" width=20 height=20>';
  												elseif(($urut == 'kelas') and ($naik == 'desc'))
  													echo '<img src="'.base_url().'utama/assists/images/icons/arrow_down.png" width=20 height=20>';
  												echo
  											'</label>';
  											if(($urut == 'kelas') and ($naik == 'asc'))
  												echo
  												'<button class="btn btn-warning pull-right" id="pl=siswa&m=1&cr='.$cari.'&sr=kelas&ur=desc" style="background-color: #008B8B;border: none;" onclick="showPage(this)">
  													<img src="'.base_url().'utama/assists/images/icons/sort_descending.png" width=20 height=20>
  												</button>';
  											else
  												echo
  												'<button class="btn btn-warning pull-right" id="pl=siswa&m=1&cr='.$cari.'&sr=kelas&ur=asc" style="background-color: #008B8B;border: none;" onclick="showPage(this)">
  													<img src="'.base_url().'utama/assists/images/icons/sort_ascending.png" width=20 height=20>
  												</button>';
  											echo
  										'</th>';
  										}
  										echo
                      '<th><label style="color : white;">NISN</label></th>
                      <th>
  											<label class="pull-left" style="margin-top: 6px;color : white;">Induk&nbsp;';
  												if(($urut == 'no_induk') and ($naik == 'asc'))
  													echo '<img src="'.base_url().'utama/assists/images/icons/arrow_up.png" width=20 height=20>';
  												elseif(($urut == 'no_induk') and ($naik == 'desc'))
  													echo '<img src="'.base_url().'utama/assists/images/icons/arrow_down.png" width=20 height=20>';
  												echo
  											'</label>';
  											if(($urut == 'no_induk') and ($naik == 'asc'))
  												echo
  												'<button class="btn btn-warning pull-right" id="pl=siswa&m=1&cr='.$cari.'&sr=no_induk&ur=desc" style="background-color: #008B8B;border: none;" onclick="showPage(this)">
  													<img src="'.base_url().'utama/assists/images/icons/sort_descending.png" width=20 height=20>
  												</button>';
  											else
  												echo
  												'<button class="btn btn-warning pull-right" id="pl=siswa&m=1&cr='.$cari.'&sr=no_induk&ur=asc" style="background-color: #008B8B;border: none;" onclick="showPage(this)">
  													<img src="'.base_url().'utama/assists/images/icons/sort_ascending.png" width=20 height=20>
  												</button>';
  											echo
  										'</th>
                      <th>
  											<label class="pull-left" style="margin-top: 6px;color : white;">Nama Siswa&nbsp;';
  												if(($urut == 'nama') and ($naik == 'asc'))
  													echo '<img src="'.base_url().'utama/assists/images/icons/arrow_up.png" width=20 height=20>';
  												elseif(($urut == 'nama') and ($naik == 'desc'))
  													echo '<img src="'.base_url().'utama/assists/images/icons/arrow_down.png" width=20 height=20>';
  												echo
  											'</label>';
  											if(($urut == 'nama') and ($naik == 'asc'))
  												echo
  												'<button class="btn btn-warning pull-right" id="pl=siswa&m=1&cr='.$cari.'&sr=nama&ur=desc" style="background-color: #008B8B;border: none;" onclick="showPage(this)">
  													<img src="'.base_url().'utama/assists/images/icons/sort_descending.png" width=20 height=20>
  												</button>';
  											else
  												echo
  												'<button class="btn btn-warning pull-right" id="pl=siswa&m=1&cr='.$cari.'&sr=nama&ur=asc" style="background-color: #008B8B;border: none;" onclick="showPage(this)">
  													<img src="'.base_url().'utama/assists/images/icons/sort_ascending.png" width=20 height=20>
  												</button>';
  											echo
  										'</th>
                      <th><center><label style="color:white;">L/P</label></center></th>';
  										echo
                    '<th><center><label style="color:white;">Aksi</label></center></th>
  									</tr>
                    </thead>
                    <tbody>';
  									$jml_data = 20;
  									$awal = ($mulai - 1) * $jml_data;
  									$nomer = $awal;
  									if($cari != '')
  									{
  										if($kelas == '')
  											$query = $this->db->select('*')
  												->from('tb_siswa')
  												->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas')
  												->like('tb_siswa.nama', $cari)
  												->or_like('tb_siswa.nisn', $cari)
  												->or_like('tb_siswa.no_induk', $cari)
  												->or_like('tb_siswa.kelas', $cari)
  												->or_like('tb_kelas.nama_kelas', $cari)
  												->limit($jml_data, $awal)
  												->order_by('tb_siswa.kelas', 'asc')
  												->order_by('tb_siswa.nama', 'asc')
  												->get();
  										else
  											$query = $this->db->select('*')
  												->from('tb_siswa')
  												->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas')
  												->where('tb_kelas.kd_kelas', $kelas)
  												->like('tb_siswa.nama', $cari)
  												->or_like('tb_siswa.nisn', $cari)
  												->or_like('tb_siswa.no_induk', $cari)
  												->or_like('tb_siswa.kelas', $cari)
  												->or_like('tb_kelas.nama_kelas', $cari)
  												->limit($jml_data, $awal)
  												->order_by('tb_siswa.kelas', 'asc')
  												->order_by('tb_siswa.nama', 'asc')
  												->get();
  									}
  									elseif(! (($kelas == '') or ($kelas == 'x')))
  									{
  										if(($urut != '') and ($naik != ''))
  											$query = $this->db->select('*')
  												->from('tb_siswa')
  												->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas')
  												->where('tb_kelas.kd_kelas', $kelas)
  												->limit($jml_data, $awal)
  												->order_by('tb_siswa.'.$urut, $naik)
  												->get();
  										else
  											$query = $this->db->select('*')
  												->from('tb_siswa')
  												->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas')
  												->where('tb_kelas.kd_kelas', $kelas)
  												->limit($jml_data, $awal)
  												->order_by('tb_siswa.nama', 'asc')
  												->get();
  									}
  									elseif($urut != '')
  									{
  										if($urut == 'kelas')
  										{
  											$query = $this->db->select('*')
  														->from('tb_siswa')
  														->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas')
  														->limit($jml_data, $awal)
  														->order_by('tb_siswa.kelas', $naik)
  														->order_by('tb_siswa.nama', 'asc')
  														->get();
  										}
  										else
  										{
  											$query = $this->db->select('*')
  														->from('tb_siswa')
  														->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas')
  														->limit($jml_data, $awal)
  														->order_by('tb_siswa.'.$urut, $naik)
  														->order_by('tb_siswa.nama', 'asc')
  														->get();
  										}
  									}
  									else
  									{
  										$query = $this->db->select('*')
  													->from('tb_siswa')
  													->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas')
  													->limit($jml_data, $awal)
  													->order_by('tb_siswa.kelas', 'asc')
  													->order_by('tb_siswa.nama', 'asc')
  													->get();
  									}
  									foreach($query->result() as $row)
  									{
  										$nomer++;
  										$userid     = $row -> nisn;
  										$nama_siswa = $row -> nama;
  										$nisn       = $row -> nisn;
  										$induk      = $row -> no_induk;
  										$gender     = $row -> gender;
  										$nama_kelas = $row -> nama_kelas;
  										if($nisn == $userid)
  											echo '<tr style="background:white;color:black;">';
  										elseif(fmod($nomer, 2) == 0)
  											echo '<tr style="background:blue;color:black;">';
  										else
  											echo '<tr style="background:white;color:blue;">';
  										echo
                      '<td><center><b>'.$nomer.'</b></center></td>
  												<td><a href="#" id="'.$userid.'&m='.$mulai.'&pl=siswa&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" onclick="editDataSiswa(this)">'.$userid.'</a></td>';
  										if(($kelas == '') or ($kelas == 'x'))
  											echo
  												'<td><a href="#" id="'.$userid.'&m='.$mulai.'&pl=siswa&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" onclick="editDataSiswa(this)">'.$nama_kelas.'</a></td>';
  										echo
  												'<td><a href="#" id="'.$userid.'&m='.$mulai.'&pl=siswa&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" onclick="editDataSiswa(this)">'.$nisn.'</a></td>
  												<td><a href="#" id="'.$userid.'&m='.$mulai.'&pl=siswa&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" onclick="editDataSiswa(this)">'.$induk.'</a></td>
  												<td><a href="#" id="'.$userid.'&m='.$mulai.'&pl=siswa&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" onclick="editDataSiswa(this)">'.$nama_siswa.'</a></td>
  												<td><center><a href="#" id="'.$userid.'&m='.$mulai.'&pl=siswa&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" onclick="editDataSiswa(this)">'.$gender.'</a></center></td>';
  										if(!(($kelas == '') or ($kelas == 'x')))
  											echo
  												'<td><a href="#" id="'.$userid.'&m='.$mulai.'&pl=siswa&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" onclick="editDataSiswa(this)">'.'</a></td>';
  										  echo
  												'<td>
  													<center>';
  													if($level > 94)
  														echo
  														'<a href="#" id="'.$userid.'&pl=siswa" onclick="hapusData(this)" data-toggle="tooltip" title="Hapus Data">
  															<img src="'.base_url().'utama/assists/images/icons/hapus.png" width=20 height=20>
  														</a>';
  													'</center>
  												</td>
  											</tr>';
  									}
  									if($nomer == 0)
  										echo
  											'<tr class="text-bayang" style="background:red;color:yellow;">
  												<td colspan="12"><b><center>Tidak ada data</center></b></td>
  											</tr>';
  									echo
  								'</tbody>
  							</table>';
  							$this->db->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left');
  							if(! (($kelas == '') or ($kelas == 'x')))
  								$this->db->where('tb_kelas.kd_kelas', $kelas);
  							if($cari != '')
  								$this->db->like('tb_siswa.nama', $cari)
  										->or_like('tb_siswa.nisn', $cari)
  										->or_like('tb_siswa.no_induk', $cari)
  										->or_like('tb_siswa.kelas', $cari)
  										->or_like('tb_kelas.nama_kelas', $cari);
  							$query = $this->db->get('tb_siswa');
  							$rowcounts = $query->num_rows();
  							$numpages  = ceil($rowcounts / $jml_data);
  							$sisa      = $rowcounts % $jml_data;
  							if($sisa > 0) $numpages++;
  							$pagenow   = ceil($awal / $jml_data)+1;
  							$nextpage  = $pagenow + 1;
  							$lastpage  = $pagenow - 1;

  							if($nomer > 0)
  								echo
  								'<b><font color="blue">Tampil <font color="red">'.($awal+1).'</font> sampai <font color="red">'.$nomer.'</font> dari <font color="red">'.$rowcounts.'</font> data</font></b><br/><br/>';
  							if($level > 95)
  							echo
  						'</div>
  						<center>';

  							if($rowcounts > $jml_data)
  							{
  								if($pagenow <= 1)
  									echo '<button type="button" class="btn btn-danger" style="height:34px;" disabled>
  											<img src="'.base_url().'utama/assists/images/icons/control_start.png" width=24 height=24 style="margin-top:-4px;">
  										</button>';
  								else
  									echo '<a href="#" id="pl=siswa&m=1&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
  											<img src="'.base_url().'utama/assists/images/icons/control_start_blue.png" width=24 height=24 style="margin-top:-4px;">
  										</a>';
  								if($pagenow <= 1)
  									echo '<button type="button" class="btn btn-danger" style="height:34px;" disabled>
  											<img src="'.base_url().'utama/assists/images/icons/control_rewind.png" width=24 height=24 style="margin-top:-4px;">
  										</button>';
  								else
  									echo '<a href="#" id="pl=siswa&m='.$lastpage.'&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
  											<img src="'.base_url().'utama/assists/images/icons/control_rewind_blue.png" width=24 height=24 style="margin-top:-4px;">
  										</a>';
  								echo '<button type="button" class="btn btn-primary" disabled>'.$pagenow.'</button>';
  								if($numpages > $pagenow)
  									echo '<a href="#" id="pl=siswa&m='.$nextpage.'&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
  											<img src="'.base_url().'utama/assists/images/icons/control_fastforward_blue.png" width=24 height=24 style="margin-top:-4px;">
  										</a>';
  								else
  									echo '<button type="button" class="btn btn-danger" disabled>
  											<img src="'.base_url().'utama/assists/images/icons/control_fastforward.png" width=16 height=16>
  										</button>';
  								if($pagenow >= $numpages)
  									echo '<button type="button" class="btn btn-danger" disabled>
  											<img src="'.base_url().'utama/assists/images/icons/control_end.png" width=16 height=16>
  										</button>';
  								else
  									echo '<a href="#" id="pl=siswa&m='.$numpages.'&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
  											<img src="'.base_url().'utama/assists/images/icons/control_end_blue.png" width=24 height=24 style="margin-top:-4px;">
  										</a>';
  							}
  						echo
  						'</center>
  						<br />
  						<center>';
  							if($level > 95)
  							{
  								if($nomer > 0)
  								echo
  								'<a href="#" id="siswa" class="btn btn-success" onclick="editDataSiswa(this)">
  									<img src="'.base_url().'utama/assists/images/icons/add.png" width=24 height=24> Tambah Data
  								</a>';
  							}
  							echo
  						'</center>
  						<br />
  					</div>
  					<!-- ./panel -->
  				</div>
  				<!-- ./col -->';
  		exit;
  	}

	// ********************************************************************************************
	// **********************************    Akhir Data Siswa     *********************************
	// ********************************************************************************************

	// *****************************************************************************************
	// **********************************    Awal Presensi     *********************************
	// *****************************************************************************************
	function showDataPresensi()
	{
		date_default_timezone_set("Asia/Jakarta");
		if(isset($_GET['m']))  {$mulai = $_GET['m'];} else {$mulai = 1;}
		if(isset($_GET['tg'])) {$tanggal = $_GET['tg'];} else {$tgl = new DateTime(); $tanggal = $tgl->format('Y-m-d');}
		if(isset($_GET['kl'])) {$kelas = $_GET['kl'];} else {$kelas = '';}
		if(isset($_GET['nm'])) {$nama = $_GET['nm'];} else {$nama = '';}
		if(isset($_GET['jm']))
		{
			$jam = $_GET['jm'];
			$jam = date('H:i:s', strtotime($jam));
		}
		else
		{
			$jam1 = new DateTime();
			$jam = $jam1->format('H:i:s');
		}

		$this->tampilanPresensi($kelas, $mulai, $tanggal, $jam, $nama);

		exit;
	}

	// ========================
	// # Fungsi Edit Presensi #
	// ========================
	function rubahPresensi()
	{
		date_default_timezone_set("Asia/Jakarta");

		if(isset($_GET['kl'])) {$kelas = $_GET['kl'];} else {$kelas = '';}
		if(isset($_GET['m']))  {$mulai = $_GET['m'];} else {$mulai = 1;}
		if(isset($_GET['nm'])) {$nama = $_GET['nm'];} else {$nama = '';}
		if(isset($_GET['id'])) {$induk = $_GET['id'];} else {$induk = '';}
		if(isset($_GET['jn'])) {$jenis = $_GET['jn'];} else {$jenis = '';}
		if(isset($_GET['tg'])) {$tanggal = $_GET['tg'];} else {$tgl = new DateTime(); $tanggal = $tgl->format('Y-m-d');}
		if(isset($_GET['jm']))
		{
			$jam = $_GET['jm'];
			$jam = date('H:i:s', strtotime($jam));
		}
		else
		{
			$jam1 = new DateTime();
			$jam = $jam1->format('H:i:s');
		}

		$query = $this->db->select('*')
					->from('tb_presensi')
					->where('induk', $induk)
					->where('tanggal', $tanggal)
					->get();
		$rowcounts = $query->num_rows();
		if($rowcounts > 0)
		{
			$row = $query->row();
			$jns = $row->jenis;
			if($jns == $jenis)
			{
				$this->db->where('induk', $induk)->where('tanggal', $tanggal)->delete('tb_presensi');
				$jenis = '';
			}
			else
			{
				$data = array('jenis' => $jenis, 'jam' => $jam);
				$this->db->where('induk', $induk)->where('tanggal', $tanggal)->update('tb_presensi', $data);
			}
		}
		else
		{
			$data = array('induk' => $induk, 'tanggal' => $tanggal, 'jenis' => $jenis, 'jam' => $jam);
			$this->db->insert('tb_presensi', $data);
		}

		$this->tampilanPresensi($kelas, $mulai, $tanggal, $jam, $nama);

		exit;
	}

	// =================================
	// # Fungsi Tampilan Page Presensi #
	// =================================
	function tampilanPresensi($kelas, $mulai, $tanggal, $jam, $nama)
	{
		$level    = $this->session->userdata('level');
		$username = $this->session->userdata('username');
		if($level == 94)
		{
			$query = $this->db->select('*')
					->from('tb_wali')
					->where('kd_guru', $username)
					->get();
			$hasil = $query -> num_rows();
			if($hasil > 0)
			{
				$row = $query->row();
				$kelas = $row->kelas;
			}
		}
		echo

			'
      </br><div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<center><b>Daftar Presensi Siswa</b></center>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-horizontal">
									<div class="form-group">
										<label for="inputCetak" class="col-md-2 control-label">Filter:</label>

										<div class="col-md-5" style="margin-top:4px;margin-left:0px;">
											<input type="radio" id="semua" name="semua" value="0" ';if($kelas == '') echo 'checked ';
                      if($level < 96) echo ' disabled '; echo 'onclick="rubahKelas(this)"> Semua
											&nbsp;&nbsp;&nbsp;
											<input type="radio" id="kelasPil" name="semua" value="1" ';if($kelas != '') echo 'checked ';
                      if($level < 96) echo ' disabled '; echo 'onclick="rubahKelas(this)"> Per Kelas
										</div>

										<div class="col-md-5" id="idKelas" ';
                    if(($level > 94) and ($kelas != '')) echo ' style="display:inline;margin-top:4px;">';
                    else echo ' style="display:none;margin-top:4px;">';
										echo
										'<label for="inputCetak" class="col-md-5 control-label" style="margin-top:-6px;margin-left:-26px;">Kelas:</label>
										<select class="col-md-8" id="kelasSelect" name="kelasSelect" style="margin-top:0px;margin-left:0px;height: 25px;" ';
                      if($level < 96) echo ' disabled '; echo ' oninput="rubahKelas(this)">';
												$query = $this->db->select('*')
														->from('tb_kelas')
														->get();
												if($query->num_rows() > 0)
												{
													foreach($query->result() as $row)
													{
														$kd_kelas = $row->kd_kelas;
														if($kelas == $kd_kelas)
															echo '<option value="'.$row->kd_kelas.'" selected> '.$row->nama_kelas.'</option>';
														else
															echo '<option value="'.$row->kd_kelas.'"> '.$row->nama_kelas.'</option>';
													}
												}
											echo
											'</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-horizontal">
									<div class="form-group">
										<label for="inputData" class="col-md-2 control-label">Tanggal:</label>
										<div class="col-md-4" style="margin-top:4px;margin-left:0px;">
											<input type="date" id="tanggal" name="tanggal" value="'.$tanggal.'" oninput="rubahKelas(this)">
										</div>
										<label for="inputData" class="col-md-2 control-label">Jam:</label>
										<div class="col-md-4" style="margin-top:4px;margin-left:0px;">
											<input type="time" id="jam" name="jam" value="'.$jam.'">
										</div>
									</div>
								</div>
							</div>
						</div>
						<b><font color="blue">*) Untuk Terlambat / Ijin, <font color="red">setting jam </font><font color="blue">terlebih dahulu</font></b>
						<div class="row">';
							$jml_data = 40;
							$perkolom = 35;
							$awal = ($mulai - 1) * $jml_data;
							$nomer = $awal;
							for($kolom = 0; $kolom < 2; $kolom++)
							{
								if(($kolom == 0) or (($kolom == 1) and ($nomer > ($awal+20))))
								{
							echo
							'<div class="col-md-12">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr style="background:#008B8B;color:white;">
											<th><center>No.</label></center></th>
											<th><center>Kelas</label></center></th>
											<th><center>Induk</label></center></th>
											<th><center>Nama</label></center></th>
											<th><center>L/P</label></center></th>
											<th><center>Kehadiran</label></center></th>
										</tr>
									</thead>
									<tbody>';
										$awal1 = $awal + $kolom * $perkolom;
										if($kelas != '')
										{
											$query = $this->db->select('*')
														->from('tb_siswa')
														->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
														->where('tb_siswa.kelas', $kelas)
														->limit($perkolom, $awal1)
														->order_by('tb_siswa.nama', 'asc')
														->get();
										}
										else
										{
											$query = $this->db->select('*')
														->from('tb_siswa')
														->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
														->limit($perkolom, $awal1)
														->order_by('tb_siswa.kelas', 'asc')
														->order_by('tb_siswa.nama', 'asc')
														->get();
										}
										foreach($query->result() as $row)
										{
											$nomer++;
											$userid     = $row -> nisn;
											$nama_siswa = $row -> nama;
											$induk      = $row -> no_induk;
											$gender     = $row -> gender;
											$nama_kelas = $row -> nama_kelas;
											if($nama == $nama_siswa)
												echo
												'<tr style="background:yellow;color:red;">';
											elseif(fmod($nomer, 2) == 0)
												echo
												'<tr style="background:lightblue;color:black;">';
											else
												echo
												'<tr style="background:white;color:black;">';

											echo	'<td><center><b>'.$nomer.'</b></center></td>
													<td><center>'.$nama_kelas.'</center></td>
													<td><center>'.$induk.'</center></td>
													<td>'.ucwords(strtolower($nama_siswa)).'</td>
													<td><center>'.$gender.'</center></td>';

											$query1 = $this->db->select('*')
														->from('tb_presensi')
														->where('induk',$induk)
														->where('tanggal', $tanggal)
														->get();
											$adaData = $query1->num_rows();
											if($adaData > 0)
											{
												$row1 = $query1 -> row();
												$jenis = $row1 -> jenis;
												$jamT  = $row1 -> jam;
											}
											else
												$jenis = ' Ada ';
											if($level > 94)
											{
											echo
													'<td>
														<center>
															<a href="#" id="id='.$induk.'&jn=S" onclick="rubahPresensi(this)" data-toggle="tooltip" title="Toggle Sakit">';
																if($jenis == 'S')
																	echo
																	'<img src="'.base_url().'utama/assists/images/icons/temperature_5.png" width=25 height=25 style="background-color:red;">';
																else
																	echo
																	'<img src="'.base_url().'utama/assists/images/icons/s.ico" width=25 height=25>';
											            echo
															'</a>
															<a href="#" id="id='.$induk.'&jn=I" onclick="rubahPresensi(this)" data-toggle="tooltip" title="Toggle Ijin">';
																if($jenis == 'I')
																	echo
																	'<img src="'.base_url().'utama/assists/images/icons/document_info.png" width=25 height=25 style="background-color:red;">';
																else
																	echo
																	'<img src="'.base_url().'utama/assists/images/icons/i.ico" width=25 height=25>';
											            echo
															'</a>
															<a href="#" id="id='.$induk.'&jn=A" onclick="rubahPresensi(this)" data-toggle="tooltip" title="Toggle Alpha">';
																if($jenis == 'A')
																	echo
																	'<img src="'.base_url().'utama/assists/images/icons/cross.png" width=25 height=25 style="background-color:red;">';
																else
																	echo
																	'<img src="'.base_url().'utama/assists/images/icons/a.ico" width=25 height=25>';
											            echo
															'</a>
															<a href="#" id="id='.$induk.'&jn=T" onclick="rubahPresensi(this)" data-toggle="tooltip" title="Toggle Terlambat">';
																if($jenis == 'T')
																	echo
																	'<img src="'.base_url().'utama/assists/images/icons/lock.png" width=25 height=25 style="background-color:red;">';
																else
																	echo
																	'<img src="'.base_url().'utama/assists/images/icons/t.ico" width=25 height=25>';
											echo
															'</a>
														</center>
													</td>';
											}
											else
												echo '<td><center><b>'.$jenis.'</b></center></td>';
											echo
												'</tr>';
										}
										if($nomer == 0)
											echo
												'<tr class="text-bayang" style="background:red;color:yellow;">
													<td colspan="6"><b><center>Tidak ada data</center></b></td>
												</tr>';
										echo
									'</tbody>
								</table>
							</div>
							<!-- ./col -->';
								}
							}
						echo
						'</div>
						<!-- ./row -->';
						if($kelas != '')
						{
							$query = $this->db->select('*')
										->from('tb_siswa')
										->where('tb_siswa.kelas', $kelas)
										->get();
						}
						else
							$query = $this->db->select('*')
										->from('tb_siswa')
										->get();
						$rowcounts = $query->num_rows();
						$numpages  = ceil($rowcounts / $jml_data);
						$sisa      = $rowcounts % $jml_data;
						if($sisa > 0) $numpages++;
						$pagenow   = ceil($awal / $jml_data)+1;
						$nextpage  = $pagenow + 1;
						$lastpage  = $pagenow - 1;

						if($nomer > 0)
							echo
							'<b><font color="blue">Tampil <font color="red">'.($awal+1).'</font> sampai <font color="red">'.$nomer.'</font> dari <font color="red">'.$rowcounts.'</font> data</font></b><br/><br/>';
						echo
					'</div>
					<!-- ./panel body -->
					<center>';

						if($rowcounts > $jml_data)
						{
							if($pagenow <= 1)
								echo '<button type="button" class="btn btn-danger" style="height:34px;" disabled>
										<img src="'.base_url().'utama/assists/images/icons/control_start.png" width=24 height=24 style="margin-top:-4px;">
									</button>';
							else
								echo '<a href="#" id="pl=presensi&m=1" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
										<img src="'.base_url().'utama/assists/images/icons/control_start_blue.png" width=24 height=24 style="margin-top:-4px;">
									</a>';
							if($pagenow <= 1)
								echo '<button type="button" class="btn btn-danger" style="height:34px;" disabled>
										<img src="'.base_url().'utama/assists/images/icons/control_rewind.png" width=24 height=24 style="margin-top:-4px;">
									</button>';
							else
								echo '<a href="#" id="pl=presensi&m='.$lastpage.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
										<img src="'.base_url().'utama/assists/images/icons/control_rewind_blue.png" width=24 height=24 style="margin-top:-4px;">
									</a>';
							echo '<button type="button" class="btn btn-primary" disabled>'.$pagenow.'</button>';
							if($numpages > $pagenow)
								echo '<a href="#" id="pl=presensi&m='.$nextpage.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
										<img src="'.base_url().'utama/assists/images/icons/control_fastforward_blue.png" width=24 height=24 style="margin-top:-4px;">
									</a>';
							else
								echo '<button type="button" class="btn btn-danger" disabled>
										<img src="'.base_url().'utama/assists/images/icons/control_fastforward.png" width=16 height=16>
									</button>';
							if($pagenow >= $numpages)
								echo '<button type="button" class="btn btn-danger" disabled>
										<img src="'.base_url().'utama/assists/images/icons/control_end.png" width=16 height=16>
									</button>';
							else
								echo '<a href="#" id="pl=presensi&m='.$numpages.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
										<img src="'.base_url().'utama/assists/images/icons/control_end_blue.png" width=24 height=24 style="margin-top:-4px;">
									</a>';
						}

					echo
					'</center><br/>';
					if($level > 94)
					{
						echo
					'<center>
						<a href="#" id="pl=presensi&id=pdf" class="btn btn-primary" onclick="ctkPresensi(this)">
							<img src="'.base_url().'utama/assists/images/icons/file_extension_pdf.png" width=24 height=24> Export Data
						</a>
					</center>
					<br />';
					}
					echo
				'</div>
				<!-- ./panel -->
			</div>
			<!-- ./col -->';
		return;
	}

	// ====================================
	// # Fungsi Input buat Print Presensi #
	// ====================================
	public function ctkPresensiModal()
	{
		$tgl = new DateTime();
		$pilihan = $this->input->get('pl');
		$pilih = $this->input->get('id');
		if(isset($_GET['sm'])) $semuaM = $this->input->get('sm'); else $semuaM = 0;
		if(isset($_GET['kl'])) $kelasM = $this->input->get('kl'); else $kelasM = '';
		if(isset($_GET['sw'])) $siswaM = $this->input->get('sw'); else $siswaM = '';
		if(isset($_GET['t1'])) $tglCetak1 = $this->input->get('t1'); else $tglCetak1 = $tgl->format('Y-m-d');
		if(isset($_GET['t2'])) $tglCetak2 = $this->input->get('t2'); else $tglCetak2 = $tgl->format('Y-m-d');
		if(isset($_GET['jn'])) $jenisM = $this->input->get('jn'); else $jenisM = 0;
		if(isset($_GET['sp1'])) $spM1 = $this->input->get('sp1'); else $spM1 = 0;

		echo
		'<!-- modal-dialog -->
		<div class="modal-dialog" role="document">
			<!-- modal-content -->';
			if(strtolower($pilihan) == 'presensi')
			{
				if($pilih == 'xls')
					echo '<form id="ctkPresensiForm" action="exportData" method="get">';
				else
					echo '<form id="ctkPresensiForm" action="cetakPresensiPDF" method="post">';
			}
			elseif(strtolower($pilihan) == 'langgar')
			{
				if($pilih == 'xls')
					echo '<form id="ctkPresensiForm" action="exportData" method="get">';
				else
					echo '<form id="ctkPresensiForm" action="cetakLanggarPDF" method="post">';
			}

			elseif(strtolower($pilihan) == 'sp')
			{
				if($pilih == 'xls')
					echo '<form id="ctkPresensiForm" action="exportData" method="get">';
				else
					echo '<form id="ctkPresensiForm" action="cetakSPPDF" method="post">';
			}
			echo

			'<input type="hidden" id="pl" name="pl" value="'.$pilihan.'">
			<input type="hidden" id="pilih" name="pilih" value="'.$pilih.'">

			<div class="modal-content" style="background: #C0C0C0; border-radius: 15px;">
				<!-- modal header -->
				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title" id="isianUserLabel" style="margin-bottom:0px;margin-top:0px;">';
					if(strtolower($pilihan) == 'presensi')
					{
						if($pilih == 'xls')
							echo '<center><b><img src="'.base_url().'utama/assists/images/icons/file_extension_xls.png" width=32 height=32> Cetak Presensi Siswa</b></center>';
						else
							echo '<center><b><img src="'.base_url().'utama/assists/images/icons/file_extension_pdf.png" width=32 height=32> Cetak Presensi Siswa</b></center>';
					}
					elseif(strtolower($pilihan) == 'langgar')
					{
						if($pilih == 'xls')
							echo '<center><b><img src="'.base_url().'utama/assists/images/icons/file_extension_xls.png" width=32 height=32> Cetak Pelanggaran Siswa</b></center>';
						else
							echo '<center><b><img src="'.base_url().'utama/assists/images/icons/file_extension_pdf.png" width=32 height=32> Cetak Pelanggaran Siswa</b></center>';
					}
					elseif(strtolower($pilihan) == 'sp')
					{
							echo '<center><b><img src="'.base_url().'utama/assists/images/icons/file_extension_pdf.png" width=32 height=32> Cetak Pelanggaran Siswa</b></center>';
					}
					echo
					'</h3>
				</div>
				<!-- ./modal header -->










				

				<!-- modal body -->
				<div class="modal-body">
					<div class="panel panel-primary" border-radius: 16px;">
						<div class="panel-body" border-radius: 16px;">';
						if(strtolower($pilihan) == 'langgar')
						{
							echo
							'<div class="row">
								<div class="form-group col-md-12" style="margin-top: -2px;">
									<label class="">Pilih : </label>
									&nbsp;&nbsp;&nbsp;
									<input type="radio" id="semuaModal" name="semua" value="0" '; if($semuaM == 0) echo ' checked '; echo ' onclick="showKelas(this)"> Semua
									&nbsp;&nbsp;&nbsp;
									<input type="radio" id="kelasX" name="semua" value="1" onclick="showKelas(this)"> Kelas
									&nbsp;&nbsp;&nbsp;
									<input type="radio" id="siswa" name="semua" value="2" onclick="showKelas(this)"> Siswa
								</div>
								<!--
								<div class="form-group col-md-6">
									<label for="inputCetak" class="col-md-4 control-label">Cetak :</label>
								</div>
								-->
							</div>';
							}
							if(strtolower($pilihan) == 'presensi')
							{
								echo
								'<div class="row">
									<div class="form-group col-md-12" style="margin-top: -2px;">
										<label class="">Pilih : </label>
										&nbsp;&nbsp;&nbsp;
										<input type="radio" id="semuaModal" name="semua" value="0" '; 
										if($semuaM == 0) echo ' checked '; echo ' onclick="showKelas(this)"> Semua
										&nbsp;&nbsp;&nbsp;
										<input type="radio" id="kelasX" name="semua" value="1" onclick="showKelas(this)"> Kelas
										&nbsp;&nbsp;&nbsp;
										<input type="radio" id="siswa" name="semua" value="2" onclick="showKelas(this)"> Siswa
									</div>
									<!--
									<div class="form-group col-md-6">
										<label for="inputCetak" class="col-md-4 control-label">Cetak :</label>
									</div>
									-->
								</div>';
								}
							if(strtolower($pilihan) == 'langgar')
							{
								echo
                '<div class="row">
  								<div class="form-group col-md-12" style="margin-top: -2px;">
  									<label class="">Proses : </label>
  									&nbsp;&nbsp;&nbsp;
										<input type="radio" id="jenisA" name="jenis" value="0" '; 
										if($jenisM == 0) echo ' checked '; echo '> Semua
  									&nbsp;&nbsp;&nbsp;
  									<input type="radio" id="jenisB" name="jenis" value="1"> Belum
  									&nbsp;&nbsp;&nbsp;
  									<input type="radio" id="jenisP" name="jenis" value="2"> Proses
  									&nbsp;&nbsp;&nbsp;
  									<input type="radio" id="jenisS" name="jenis" value="2"> Sudah
  								</div>
  							</div>';
								}







								if(strtolower($pilihan) == 'sp')
								{
									echo
									'<div class="row">
										<div class="form-group col-md-12" style="margin-top: -2px;">
											<label class="">Pilih : </label>
											&nbsp;&nbsp;&nbsp;
											<input type="radio" id="semuaModal" name="semua" value="0" '; 
											if($semuaM == 0) echo ' checked '; echo ' onclick="showKelas(this)"> Semua
											
											&nbsp;&nbsp;&nbsp;
											<input type="radio" id="sp" name="semua" value="2" onclick="showKelas(this)"> Per SP
										</div>
									</div>';
									}







  							echo
  							'<div class="row" style="margin-top: -8px;">
  								<div class="form-group">
  									<label class="col-md-2 ">Tanggal : </label>
  									<div class="col-md-4" style="margin-top:-2px;margin-left:0px;">
  										<input type="date" id="tglCetak1" name="tglCetak1" value="'.$tglCetak1.'">
  									</div>
  									<div class="col-md-1" style="margin-top:0px;margin-left:-30px;">
  										<label class="col-md-1 "><center><b>s/d</b></center></label>
  									</div>
  									<div class="col-md-4" style="margin-top:-2px;margin-left:0px;">
  										<input type="date" id="tglCetak2" name="tglCetak2" value="'.$tglCetak2.'">
  									</div>
  								</div>
								</div>
								

  							<div class="row" style="margin-top: 4px;">
									<div class="col-md-4 form-group" id="idKelasModal" style="display:none;margin-top: 4px">
									
  									<label class="">Kelas : </label>
  									&nbsp;&nbsp;&nbsp;
  									<select id="kelasPilih" name="kelasPilih" style="height: 32px;width: 100px;" onchange="showKelas(this)">';
  										$query = $this->db->select('*')
  													->from('tb_kelas')
  													->get();
  										if($query->num_rows() > 0)
  										{
  											foreach($query->result() as $row)
  											{
  												$kd_kelas = $row->kd_kelas;
  												if($kelasM == $kd_kelas)
  													echo '<option value="'.$row->kd_kelas.'" selected> '.$row->nama_kelas.'</option>';
  												else
  													echo '<option value="'.$row->kd_kelas.'"> '.$row->nama_kelas.'</option>';
  											}
  										}
  									echo
  									'</select>
									</div>

									<div class="row" style="margin-top: 4px;">
  								<div class="col-md-4 form-group" id="idspModal" style="display:none;margin-top: 4px">
  									<label class="">SP : </label>
  									&nbsp;&nbsp;&nbsp;
  									<select id="spPilih" name="spPilih" style="height: 32px;width: 100px;" onchange="showKelas1(this)">';
  										$query = $this->db->select('*')
  													->from('tb_cek')
  													->get();
  										if($query->num_rows() > 0)
  										{
  											foreach($query->result() as $row)
  											{
  												$id_cek = $row->id_cek;
  												if('')
  													echo '<option value="'.$row->id_cek.'" selected> '.$row->ket.'</option>';
  												else
  													echo '<option value="'.$row->id_cek.'"> '.$row->ket.'</option>';
  											}
  										}
  									echo
  									'</select>
									</div>
									
  								<div class="col-md-8 form-group" id="idSiswaModal" style="display:none;margin-top: 4px;margin-left: -20px;">
  									<label class="">Siswa : </label>
  									&nbsp;&nbsp;&nbsp;
  									<select id="siswaSel" name="siswaSel" style="height: 32px;width: 290px;margin-right: 0;">';
  									$query = $this->db->select('*')
  												->from('tb_siswa')
  												->where('kelas', $kelasM)
  												->order_by('nama', 'asc')
  												->get();
  									if($query->num_rows() > 0)
  									{
  										foreach($query->result() as $row)
  										{
  											$nisn = $row->no_ujian_smp;
  											if($nisn == $siswaM)
  												echo '<option value="'.$row->no_induk.'" selected> '.$row->nama.'</option>';
  											else
  												echo '<option value="'.$row->no_induk.'"> '.$row->nama.'</option>';
  										}
  									}
  									echo
  									'</select>
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>
					<!-- ./modal body -->
					
				<!-- modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-warning pull-left" data-dismiss="modal" style="border-radius:8px;">
						<img src="'.base_url().'utama/assists/images/icons/cross.png" width=20 height=20> Close
					</button>
					<button type="button" id="'.$pilih.'" class="btn btn-primary" style="border-radius:8px;" onclick="cekCtkPresensi()">
						<img src="'.base_url().'utama/assists/images/icons/Print.ico" width=20 height=20> Cetak
					</button>
				</div>
				<!-- ./modal footer -->
			</div>
			<!-- /.modal-content -->
			</form>
		</div>
		<!-- /.modal-dialog -->';

		exit;
	}

	// ******************************************************************************************
	// *********************************     Akhir Presensi     *********************************
	// ******************************************************************************************

	// ********************************************************************************************
	// **********************************    Awal Pelanggaran     *********************************
	// ********************************************************************************************
	function showDataLanggar()
	{
		$level    = $this->session->userdata('level');
		$username = $this->session->userdata('username');

		$pilih = $this->input->get('pl');

		if(isset($_GET['m']))   $mulai    = $_GET['m']; 	else $mulai = 1;
  	if(isset($_GET['cr']))  {$cari	  = $_GET['cr'];} else {$cari = '';}
		if(isset($_GET["id"]))  $id       = $_GET["id"];	else $id    = "";
		if(isset($_GET["idk"])) $indukP   = $_GET["idk"];	else $indukP = "";
		if(isset($_GET["nm"]))  $nama     = $_GET["nm"];	else $nama  = "";
		if(isset($_GET["kl"]))  $kelas    = $_GET["kl"];	else $kelas = "";
    if(isset($_GET["po"]))  $poin     = $_GET["po"];	  else $poin = "";
		if(isset($_GET["jn"]))  $jenis    = $_GET["jn"];	else $jenis = "";
		if(isset($_GET['tg1'])) $tglAwal  = $_GET['tg1'];	else {$tgl = new DateTime(); $tglAwal = $tgl->format('Y-m-d');}
		if(isset($_GET['tg2'])) $tglAkhir = $_GET['tg2'];	else {$tgl = new DateTime('tomorrow'); $tglAkhir = $tgl->format('Y-m-d');}
		$batasKar = 25;

		if($level == 94)
		{
			$query = $this->db->select('*')
					->from('tb_wali')
					->where('kd_guru', $username)
					->get();
			$hasil = $query -> num_rows();
			if($hasil > 0)
			{
				$row = $query->row();
				$kelas = $row->kelas;
			}
		}

		echo
			'
      </br><div class="col-md-12">
				<input type="hidden" id="pl" name="pl" value="langgar">
				<div class="panel panel-primary">
					<div class="panel-heading text-bayang">
						<center><b>Daftar Pelanggaran Siswa</b></center>
					</div>

					<!-- /.panel-heading -->
    				<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-horizontal">
									<div class="form-group">
										<label for="inputCetak" class="col-md-1 control-label">Filter :</label>

										<input type="radio" style="margin-top:12px;" id="semua" name="semua" value="0" ';
                    if($kelas == '') echo 'checked ';if($level < 95) echo ' disabled ';
                    echo ' oninput="rubahKelasLanggar('.$mulai.')"> <b>Semua</b>
										&nbsp;&nbsp;&nbsp;

										<input type="radio" style="margin-top:12px;" id="kelas" name="semua" value="0" ';
                    if($kelas != '') echo 'checked ';if($level < 95) echo ' disabled ';
                    echo ' oninput="rubahKelasLanggar('.$mulai.')"> <b>Per Kelas</b>
										&nbsp;&nbsp;&nbsp;';

										if($kelas == '')
											echo
											'<div id="idKelasLanggar" style="display:none;">';
										else
											echo
											'<div id="idKelasLanggar" style="display:inline;">';
										echo
											'<b>Kelas :&nbsp;</b>
											<select id="kelasSelect" name="kelasSelect" style="height: 32px;" ';
                      if($level < 95) echo ' disabled '; echo ' oninput="rubahKelasLanggar('.$mulai.')">
												<option value=""></option>';
												$query = $this->db->select('*')
														->from('tb_kelas')
														->get();
												if($query->num_rows() > 0)
												{
													foreach($query->result() as $row)
													{
														$kd_kelas = $row->kd_kelas;
														if($kelas == $kd_kelas)
															echo '<option value="'.$row->kd_kelas.'" selected> '.$row->nama_kelas.'</option>';
														else
															echo '<option value="'.$row->kd_kelas.'"> '.$row->nama_kelas.'</option>';
													}
												}
											echo
											'</select>
										</div>
										&nbsp;&nbsp;';
										if($kelas == '')
											echo
											'<div id="idKelasLanggar" style="display:none;">';
										else
											echo
											'<div id="idKelasLanggar" style="display:inline;">';
										echo
											'<select id="siswaSelect" name="siswaSelect" style="height: 32px;" ';
											if($level < 95) echo ' disabled '; 
											echo ' oninput="rubahKelasLanggar('.$mulai.')">
										
										echo
												<option value=""></option>';
												$query = $this->db->select('*')
														->from('tb_siswa')
														->where ('kelas',$kelas)
														->order_by('nama', 'asc')
														->get();
												if($query->num_rows() > 0)
												{
													foreach($query->result() as $row)
													{
														$indukP = $row->no_induk;
														if($indukP == $siswa)
															echo '<option value="'.$row->no_induk.'" selected> '.$row->nama.'</option>';
														else
															echo '<option value="'.$row->no_induk.'" selected> '.$row->nama.'</option>';
													}
												}
											echo
											'</select>
										</div>
										&nbsp;<b>Tanggal :&nbsp;</b>
										<input type="date" id="tglAwal" name="tglAwal" style="height: 32px;" value="'.$tglAwal.'" oninput="rubahKelasLanggar('.$mulai.')">
										&nbsp;</b>
										<input type="date" id="tglAkhir" name="tglAkhir" style="height: 32px;" value="'.$tglAkhir.'" oninput="rubahKelasLanggar('.$mulai.')">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-horizontal">
									<div class="form-group">
										<label for="inputCetak" class="col-md-1 control-label" style="margin-top:-10px;">Status :</label>
										<input type="radio" style="margin-top:-6px;" id="jenisAll" name="jenis" value="0" ';if($jenis == '') echo 'checked '; echo ' oninput="rubahKelasLanggar('.$mulai.')"> <b>Semua</b>
										&nbsp;&nbsp;
										<input type="radio" style="margin-top:-6px;" id="jenisBlm" name="jenis" value="1" ';if($jenis == 'B') echo 'checked '; echo ' oninput="rubahKelasLanggar('.$mulai.')"> <b>Belum</b>
										&nbsp;&nbsp;
										<input type="radio" style="margin-top:-6px;" id="jenisSdh" name="jenis" value="2" ';if($jenis == 'S') echo 'checked '; echo ' oninput="rubahKelasLanggar('.$mulai.')"> <b>Sudah</b>
										&nbsp;&nbsp;
										<input type="radio" style="margin-top:-6px;" id="jenisPrs" name="jenis" value="3" ';if($jenis == 'P') echo 'checked '; echo ' oninput="rubahKelasLanggar('.$mulai.')"> <b>Proses</b>
									</div>
						  <div class="row">';
								$jml_data = 20;
								$awal = ($mulai - 1) * $jml_data;
								$nomer = $awal;
								echo
							'<div class="col-md-12">
								<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr style="background:#008B8B;color:white;">
											<th><center><label>No.</label></center></th>
											<th><center><label>Tanggal</label></center></th>
											<th><center><label>Kelas</label></center></th>
											<th><center><label>Induk</label></center></th>
											<th><center><label>Nama</label></center></th>
											<th><center><label>Pelanggaran</label></center></th>
											<th><center><label>Poin</label></center></th>
											<th><center><label>Penanganan</label></center></th>
											<th><center><label>Status</label></center></th>
										</tr>
									</thead>
									<tbody>';
										if($kelas != '')
										{
											$this->db->join('tb_siswa', 'tb_langgar.induk = tb_siswa.no_induk', 'left')
														->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
														->where('tb_siswa.kelas', $kelas)
														->where('tb_langgar.tanggal >=', $tglAwal)
														->where('tb_langgar.tanggal <=', $tglAkhir);
									
											if($jenis != '')
											$this->db->where('tb_langgar.statusL', $jenis);
											$this->db->limit($jml_data, $awal)
														->order_by('tb_langgar.tanggal', 'asc')
														->order_by('tb_siswa.nama', 'asc');
											$query = $this->db->get('tb_langgar');
										}
										else
										{
											$this->db->join('tb_siswa', 'tb_langgar.induk = tb_siswa.no_induk', 'left')
														->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
														->where('tb_langgar.tanggal >=', $tglAwal)
														->where('tb_langgar.tanggal <=', $tglAkhir);
											if($jenis != '')
											$this->db->where('tb_langgar.statusL', $jenis);
											$this->db->limit($jml_data, $awal)
														->order_by('tb_langgar.tanggal', 'asc')
														->order_by('tb_siswa.kelas', 'asc')
														->order_by('tb_siswa.nama', 'asc');
											$query = $this->db->get('tb_langgar');
										}
										foreach($query->result() as $row)
										{
											$nomer++;
											$noL		    = $row -> no;
											$userid     = $row -> nisn;
											$tanggal    = $row -> tanggal;
											$nama_siswa = $row -> nama;
											$induk      = $row -> no_induk;
											$nama_kelas = $row -> nama_kelas;
											$mslh		    = $row -> masalah;
                      $poin       = $row -> skor_poin;
											$solusi		  = $row -> solusi;
											$status		  = $row -> statusL;
											if (strlen($mslh) > $batasKar)
												$mslh = substr($mslh, 0, strrpos(substr($mslh, 0, $batasKar), ' ')) . '...';
											if (strlen($solusi) > $batasKar)
												$solusi = substr($solusi, 0, strrpos(substr($solusi, 0, $batasKar), ' ')) . '...';
											if($nama == $nama_siswa)
												echo
												'<tr style="background:yellow;color:red;">';
											elseif(fmod($nomer, 2) == 0)
												echo
												'<tr style="background:lightblue;color:black;">';
											else
												echo
												'<tr style="background:white;color:black;">';
											echo	'<td><center><b>'.$nomer.'</b></center></td>
													<td><a href="#" id="'.$noL.'" onclick="showLanggarModal(this)">'.$tanggal.'</a></td>
													<td><a href="#" id="'.$noL.'" onclick="showLanggarModal(this)">'.$nama_kelas.'</a></td>
													<td><a href="#" id="'.$noL.'" onclick="showLanggarModal(this)">'.$induk.'</a></td>
													<td><a href="#" id="'.$noL.'" onclick="showLanggarModal(this)">'.ucwords(strtolower($nama_siswa)).'</a></td>
													<td><a href="#" id="'.$noL.'" onclick="showLanggarModal(this)">'.$mslh.'</a></td>
													<td><a href="#" id="'.$noL.'" onclick="showLanggarModal(this)"> <center>'.$poin.'</center></a></td>
													<td><a href="#" id="'.$noL.'" onclick="showLanggarModal(this)">'.$solusi.'</a></td>
													<td>
														<center>
															<a href="#" id="'.$noL.'" onclick="showLanggarModal(this)">';
																if($status == 'B')
																	echo '<b><font color="#FFD700">Belum</font></b>';
																elseif($status == 'S')
																	echo '<b><font color="green">Sudah</font></b>';
																elseif($status == 'P')
																	echo '<b><font color="#6F00FF">Proses</font><b>';
																else
																	echo '&nbsp;';
																echo
															'</a>';
															if($level > 94)
																echo
															'&nbsp;&nbsp;
															<a href="#" id="'.$noL.'&pl=langgar" onclick="hapusData(this)">
																<img src="'.base_url().'utama/assists/images/icons/stop.ico" width=20 height=20>
															</a>
                              ';
															echo
														'</center>
													</td>
												</tr>';
										}
										if($nomer == 0)
											echo
												'<tr style="background:red;color:yellow;">
													<td colspan="11"><b><center>Tidak ada data</center></b></td>
												</tr>';
										echo
									'</tbody>
								</table>
							</div>
							<!-- ./col -->
						</div>
						<!-- ./row -->';
						if($kelas != '')
						{
							$this->db->join('tb_siswa', 'tb_langgar.induk = tb_siswa.no_induk', 'left')
										->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
										->where('tb_siswa.kelas', $kelas)
										->where('tb_langgar.tanggal >=', $tglAwal)
										->where('tb_langgar.tanggal <=', $tglAkhir);
							if($jenis != '')
								$this->db->where('tb_langgar.statusL', $jenis);
							$query = $this->db->get('tb_langgar');
						}
						else
						{
							$this->db->join('tb_siswa', 'tb_langgar.induk = tb_siswa.no_induk', 'left')
										->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
										->where('tb_langgar.tanggal >=', $tglAwal)
										->where('tb_langgar.tanggal <=', $tglAkhir);
							if($jenis != '')
								$this->db->where('tb_langgar.statusL', $jenis);
							$query = $this->db->get('tb_langgar');
						}
						$rowcounts = $query->num_rows();
						$numpages  = ceil($rowcounts / $jml_data);
						$sisa      = $rowcounts % $jml_data;
						if($sisa > 0) $numpages++;
						$pagenow   = ceil($awal / $jml_data)+1;
						$nextpage  = $pagenow + 1;
						$lastpage  = $pagenow - 1;

						if($nomer > 0)
							echo
							'<b><font color="blue">Tampil <font color="red">'.($awal+1).'</font> sampai <font color="red">'.$nomer.'</font> dari <font color="red">'.$rowcounts.'</font> data</font></b><br/><br/>';
						echo
					'</div>';
          if(($level > 94) and ($nomer > 0))
					{
						echo
					'<br/>
					<center>
						<a href="#" id="pl=langgar&id=pdf" class="btn btn-primary" onclick="ctkPresensi(this)">
							<img src="'.base_url().'utama/assists/images/icons/file_extension_pdf.png" width=24 height=24> Export Data
						</a>
						&nbsp;&nbsp;&nbsp;
						<a href="#" id="0" class="btn btn-primary" onclick="showLanggarModal(this)">
							<img src="'.base_url().'utama/assists/images/icons/add.png" width=24 height=24> Tambah Data
						</a>
					</center>';
					}
					echo
					'<br />
				</div>
				<!-- ./panel -->
			</div>
			<!-- ./col -->';

		exit;
	}

	// ===========================
	// # Fungsi Edit Pelanggaran #
	// ===========================
	function showLanggarModal()
	{
		date_default_timezone_set("Asia/Jakarta");
		$level    = $this->session->userdata('level');
		if(isset($_GET["id"])) $id = $_GET["id"]; else $id = '';
		if(($id == '') or ($id == 0))
		{
			$id = '';
			$kelas = '';
			$induk = '';
			$tgl = new DateTime();
			$tanggal = $tgl->format('Y-m-d');
			$tangani = $tanggal;
			$jam = $tgl->format('H:i:s');
			$masalah = '';
      $poin = '';
			$oleh = '';
			$solusi = '';
			$jenis = 'B';
			$nama = '';
		}
		else
		{
			$query = $this->db->select('*')
						->from('tb_langgar')
						->join('tb_siswa', 'tb_siswa.no_induk=tb_langgar.induk', 'left')
            ->join('tb_pelanggaran', 'tb_pelanggaran.poin_pelanggaran=tb_langgar.skor_poin', 'left')
						->where('tb_langgar.no', $id)
						->get();
    			$row   = $query->row();
    			$kelas = $row->kelas;
    			$induk = $row->induk;
    			$tgl   = $row->tanggal;
    			$tanggal = date("Y-m-d", strtotime($tgl));
    			$jam     = date("H:i:s", strtotime($tgl));
    			$tangani = $row->tangani;
          $poin    = $row->skor_poin;
    			$masalah = $row->masalah;
    			$oleh    = $row->oleh;
    			$solusi  = $row->solusi;
    			$jenis   = $row->statusL;
    			$nama    = $row->nama;
		}
		echo
				'<input type="hidden" id="nomerP" name="nomerP" value="'.$id.'">
				<!-- modal-dialog -->
				<div class="modal-dialog modal-lg" role="document">
					<!-- modal-content -->
					<div class="modal-content" style="background: linear-gradient(#696969,#800000,#696969);border-radius: 15px;">
						<!-- modal header -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="modal-title" id="isianUserLabel">
								<center>
									<img src="'.base_url().'utama/assists/images/icons/emotion_unhappy.png" width=36 height=36> <b>Data Pelanggaran Siswa</b>
								</center>
							</h3>
						</div>
						<!-- ./modal header -->

						<!-- modal body -->
						<div class="modal-body" id="idLanggarSiswa">
							<div class="row">
								<!-- sisi kiri -->
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-3">
											<label style="color: white;">
												Kelas
											</label>
										</div>
										<div class="col-md-6">
											<select id="kelasSelect" name="kelasSelect" style="height:28px;width:50%;" ';
											if($id != '') echo ' disabled ';
											echo ' oninput="showSiswa(this)">
												<option value=""></option>';
												$query = $this->db->select('*')
															->from('tb_kelas')
															->order_by('kd_kelas', 'asc')
															->get();
												if($query->num_rows() > 0)
												{
													foreach($query->result() as $row)
													{
														$kd_kelas = $row->kd_kelas;
														if($kelas == $kd_kelas)
															echo '<option value="'.$row->kd_kelas.'" selected> '.$row->nama_kelas.'</option>';
														else
															echo '<option value="'.$row->kd_kelas.'"> '.$row->nama_kelas.'</option>';
													}
												}
											echo
											'</select>
										</div>
									</div>
									<br/>
									<div class="row">
										<div class="col-md-3">
											<label style="color: white;">
												Tanggal
											</label>
										</div>
										<div class="col-md-6">
											<input type="date" class="form-control" id="tanggal" name="tanggal" style="height:28px;" value="'.$tanggal.'">
										</div>
									</div>
									<br/>
									<div class="row">
                  <div class="col-md-3">
                    <label style="color: white;">
                      Pelanggaran
                    </label>
                  </div>
                  <div class="col-md-9">
                    <select id="pelanggaranSelect" name="pelanggaranSelect" style="height:30px;width:100%;';
                    if($id != '') echo ' disabled ';
                    echo '
                      <option value=""></option>';
                      $query = $this->db->select('*')
                            ->from('tb_pelanggaran')
                            ->order_by('pelanggaran_id', 'asc')
                            ->get();
                      if($query->num_rows() > 0)
                      {
                        foreach($query->result() as $row)
                        {
                          if($pelanggaran_id == $pelanggaran_id)
                            echo '<option value="'.$row->nama_pelanggaran.'" selected> '.$row->nama_pelanggaran.'</option>';
                          else
                            echo '<option value="'.$row->nama_pelanggaran.'" selected> '.$row->nama_pelanggaran.'</option>';
                        }
                      }
                    echo
                    '</select>
                  </div>
                </div>
                <br/>
                  <div class="row">
                    <div class="col-md-3">
                      <label style="color: white;">
                        Poin
                      </label>
                    </div>
                      <div class="col-md-6">
                      <select id="poinSelect" name="poinSelect" style="height:30px;width:100%;';
                      if($id == 'nama_pelanggaran')
											echo
											' style="height:28px;width:100%;">';
												$query = $this->db->select('*')
															->from('tb_pelanggaran')
															->order_by('pelanggaran_id', 'poin_pelanggaran', 'asc')
															->get();
												if($query->num_rows() > 0)
												{
													foreach($query->result() as $row)
													{
														$poinS = $row->poin_pelanggaran;
														if($pelanggaran_id == $poin_pelanggaran)
															echo '<option value="'.$poinS.'" selected> '.$poinS.' </option>';
														else
															echo '<option value="'.$poinS.'" > '.$poinS.' </option>';
													}
												}
											echo
                      '</select>
                    </div>
                  </div>
                  <br/>
									<div class="row">
										<div class="col-md-3">
											<label style="color: white;">
												Solusi
											</label>
										</div>
										<div class="col-md-9">
											<textarea id="solusi" name="solusi" rows="3" style="width:100%;padding: 4px 10px;">'.$solusi.'</textarea>
										</div>
									</div>
								</div>
								<!-- ./sisi kiri -->

								<!-- sisi kanan -->
								<div class="col-md-6">
									<div class="row" id="pilihSiswa">
										<div class="col-md-3">
											<label style="color: white;">
												Nama Siswa
											</label>
										</div>
										<div class="col-md-8">
											<select id="indukSelect" name="indukSelect" ';
											if($id != '') echo ' disabled ';
											echo
											' style="height:28px;width:100%;">';
												$query = $this->db->select('*')
															->from('tb_siswa')
															->where('kelas', $kelas)
															->order_by('nama', 'asc')
															->get();
												if($query->num_rows() > 0)
												{
													foreach($query->result() as $row)
													{
														$namaS = $row->nama;
														$no_induk = $row->no_induk;
														if($no_induk == $induk)
															echo '<option value="'.$no_induk.'" selected> '.$namaS.' </option>';
														else
															echo '<option value="'.$no_induk.'"> '.$namaS.' </option>';
													}
												}
											echo
											'</select>
										</div>
									</div>
									<br/>
									<div class="row">
										<div class="col-md-3">
											<label style="color: white;">
												Jam
											</label>
										</div>
										<div class="col-md-6">
											<input type="time" class="form-control" id="jam" name="jam" style="height:28px;" value="'.$jam.'">
										</div>
									</div>
									<br/>
									<div class="row" style="height:28px;margin-top:4px;">
										<div class="col-md-3">
											<label style="color: white;">
												Status
											</label>
										</div>
										<div class="col-md-9">
											<input type="radio" id="jnsBlmMdl" name="jenisModal" value="1" ';
                      if($jenis == 'B') echo 'checked '; echo '> <b style="color: #FFD700;">Belum</b>
											&nbsp;&nbsp;&nbsp;
											<input type="radio" id="jnsSdhMdl" name="jenisModal" value="2" ';
                      if($jenis == 'S') echo 'checked '; echo '> <b style="color: green;">Sudah</b>
											&nbsp;&nbsp;&nbsp;
											<input type="radio" id="jnsPrsMdl" name="jenisModal" value="3" ';
                      if($jenis == 'P') echo 'checked '; echo '> <b style="color: #6F00FF;">Proses</b>
										</div>
									</div>
									<br/>
									<div class="row">
										<div class="col-md-3">
											<label style="color: white;">
												Tanggal Penanganan
											</label>
										</div>
										<div class="col-md-6">
											<input type="date" class="form-control" id="tangani" name="tangani" style="height:28px;" value="'.$tangani.'">
										</div>
									</div>
									<br/>
									<div class="row">
										<div class="col-md-3">
											<label style="color: white;">
												Oleh
											</label>
										</div>
										<div class="col-md-9">
											<input type="text" class="form-control" id="oleh" name="oleh" style="height:28px;" value="'.$oleh.'">
										</div>
									</div>
								</div>
								<!-- ./sisi kanan -->
							</div>

						</div>
						<!-- ./modal body -->

						<!-- modal footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-warning pull-left" data-dismiss="modal" style="border-radius:8px;">
								<img src="'.base_url().'utama/assists/images/icons/cross.png" width=20 height=20> Close
							</button>';
							if($level > 94)
								echo
							'<button type="button" class="btn btn-primary" style="border-radius:8px;" onclick="simpanLanggarSiswa()">
								<img src="'.base_url().'utama/assists/images/icons/accept.png" width=20 height=20> Simpan
							</button>';
							echo
						'</div>
						<!-- ./modal footer -->

					</div>
					<!-- ./modal content -->
				</div>
				<!-- ./modal dialog -->';
		exit;
	}

	// ==================================
	// # Fungsi simpan Data Pelanggaran #
	// ==================================
	function simpanLanggarSiswa()
	{
		date_default_timezone_set("Asia/Jakarta");

		$id			= $this->input->get('id');
		$tgl		= $this->input->get('tg');
		$jam		= $this->input->get('jm');
		$induk		= $this->input->get('in');
		$mslh		= $this->input->get('ms');
    $poin     = $this->input->get('po');
		$tangani	= $this->input->get('tn');
		$oleh		= $this->input->get('ol');
		$solusi		= $this->input->get('sl');
		$jenis		= $this->input->get('jn');
		$tanggal = date("Y-m-d H:i:s", strtotime($tgl . ' ' . $jam));
		$data	= array(
						'tanggal' => $tanggal,
						'induk' => $induk,
						'masalah' => $mslh,
            'skor_poin' => $poin,
						'tangani' => $tangani,
						'oleh' => $oleh,
						'solusi' => $solusi,
						'statusL' => $jenis);
		if(($id == '') or ($id == 0))
			$this->db->insert('tb_langgar', $data);
    else
			$this->db->where('no', $id)->update('tb_langgar', $data);

		$outp[0] = 'sukses';
		if(($id == '') or ($id == 0))
			$outp[1] = 'Sukses menambah data Pelanggaran';
		else
			$outp[1] = 'Sukses merubah Data Pelanggaran';
		echo json_encode($outp);
		exit;
	}
	// *********************************************************************************************
	// ***********************************   Akhir Pelanggaran     *********************************
	// *********************************************************************************************
  // **************************************************************************************
	// *********************************     Awal Pesan     *********************************
	// **************************************************************************************

      function kirimPesan2()
    	{
    		$level    = $this->session->userdata('level');
        date_default_timezone_set("Asia/Jakarta");
        $query = $this->db->select('*')
            ->from('tb_pesan')
            ->get();
        if($query->num_rows() > 0)
        {
          $row = $query->row();
          $pengirim			= $row->pengirim;
          $telpon			  = $row->telpon;
          $pesan		    = $row->pesan;
        }
        else
        {
        $tgl_pesan ='';
        $pengirim   ='';
        $telpon     ='';
        $pesan      ='';
        }
        echo
    		'<!-- modal-dialog -->
    		<div class="modal-dialog modal-lg" role="document">
    			<!-- modal-content -->
    			<div class="modal-content" style="background:#2F4F4F; border-radius: 10px;">
    				<!-- modal header -->
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    					<h3 class="modal-title" id="dataSekolahLabel" style="margin-bottom:0px;margin-top:0px;color: white;">
    						<center><b>
    						<img src="'.base_url().'utama/assists/images/icons/house.png" width=32 height=32> Sms Gateway
    						</b></center>
    					</h3>
    				</div>
    				<!-- ./modal header -->

    				<!-- modal body -->
    				<div class="modal-body">
    					<div class="row">';
    						echo
    						'<div class="col-md-12">
                <form action"pages/cek" method="POST">
                 <div class="col-md-12">
                  <div class="panel panel-primary">
                 <div class="panel-heading">
                     <center><b><i>Kirim Pesan</i></b></center>
                 </div>
                 <!-- /.panel-heading -->
                 <div class="modal-body">
                   <div class="row">
                     <div class="col-md-6">
                       <div class="form-group">
                         <label">
                           Telephone :
                         </label>
                         <input type="text" class="form-control" name="telpon" id="telpon" value="'.$telpon.'">
                       </div>
                       <div class="form-group">
                           <label">
                             Pengirim :
                           </label>
                           <input type="text" class="form-control" name="pengirim" id="pengirim" value="'.$pengirim.'">
                       </div>
                     </div>
                       <div class="col-md-6">
                         <div class="form-group">
                           <label>
                             Isi Pesan :
                           </label>
                           <textarea class="form-control" name="pesan" id="pesan" value="'.$pesan.'"rows="7">'.$pesan.'</textarea>
                         </div>
                         </div>
                       </div>
                     </div>
                   </div>
                   </form>
    					</div>';
    					echo
    					'</div>
    				</div>
    				<!-- ./modal body -->
    				<!-- modal footer -->
    				<div class="modal-footer">
    					<button type="button" class="btn btn-warning pull-left" data-dismiss="modal" style="border-radius:8px;">
    						<img src="'.base_url().'utama/assists/images/icons/hapus.png" width=20 height=20> Close
    					</button>';
    					if($level > 95)
    						echo
    					'<button type="button" class="btn btn-primary" onClick="kirimSms()" style="border-radius:8px;">
    						<img src="'.base_url().'utama/assists/images/icons/accept.png" width=20 height=20> Kirim Pesan
    					</button>';
    					echo
    				'</div>
    				<!-- ./modal footer -->
    			</div>
    			<!-- /.modal-content -->
    		</div>
    		<!-- /.modal-dialog -->';
    		exit;
    	}


	// ***************************************************************************************
	// *********************************     Akhir Pesan     *********************************
	// ***************************************************************************************

	function kirimSms()
	{
		date_default_timezone_set("Asia/Jakarta");
    $level    = $this->session->userdata('level');
    if(isset($_GET["id"])) $id = $_GET["id"]; else $id = '';

    $ch=curl_init();
    //$no_hp = "085759736767";
    $no_hp = "087781955877";
		$token = "eKAHITDnbcv2uPOmyES3";
		$isi2 = "Kepada Yth: Bapak/ibu Orang tua dari: Abdul Aziz, Diberitahukan anak Bapak/ Ibu yang bernama: Abdul Aziz telah mendapat kan SP1 dengan total poin : 40 poin.";
		$isi = rawurlencode($isi2);
		$url = 'https://bookcircle.id/sms/send/'.$token.'/'.$no_hp.'/'.$isi;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$curlerrno = curl_errno($ch);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
		curl_setopt($ch,CURLOPT_TIMEOUT,5);
		print $curlerrno;
		curl_exec($ch);
		curl_close($ch);
    $pengirim	 	 = $this->input->post('pengirim');
    $telpon	 	 = $this->input->post('telpon');
    $pesan	 	 = $this->input->post('pesan');
    $data	= array(
            'pengirim' => $pengirim,
            'telpon' => $telpon,
            'pesan' => $pesan,
            );
    $query = $this->db->select('*')
        ->from('tb_pesan')
        ->get();
    $rowcounts = $query->num_rows();
    if($rowcounts > 0)
      $this->db->update('tb_pesan', $data);
    else
      $this->db->insert('tb_pesan', $data);

    $outp[0] = 'sukses';
    if($rowcounts > 0)
      $outp[1] = 'Sukses mengirim Pesan';
    else
      $outp[1] = 'Sukses menambah data Pesan';
		echo json_encode($outp);
    exit;
	}

  // *******************************************************************************************
  // ***                                   Awal Data sp                                   ***
  // *******************************************************************************************
  function showDataPelanggaran()
  	{
			$level    = $this->session->userdata('level');
  		$username = $this->session->userdata('username');

  		$pilih = $this->input->get('pl');
  		if(isset($_GET['id'])) {$nisn = $_GET['id'];} else {$nisn = '';}
  		if(isset($_GET['cr'])) {$cari = $_GET['cr'];} else {$cari = '';}
  		if(isset($_GET['m']))  {$mulai = $_GET['m'];} else {$mulai = 1;}
  		if(isset($_GET['sr'])) {$urut = $_GET['sr'];} else {$urut = '';}
  		if(isset($_GET['ur'])) {$naik = $_GET['ur'];} else {$naik = '';}
  		$kelas = $this->input->get('kl');

  		if($level == 94)
  		{
  			$query = $this->db->select('*')
  					->from('tb_wali')
  					->where('kd_guru', $username)
  					->get();
  			$hasil = $query -> num_rows();
  			if($hasil > 0)
  			{
  				$row = $query->row();
  				$kelas = $row->kelas;
  				$username = $row->kd_guru;
  			}

  		}
  		echo
  				'<div class="col-md-12">
          </br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <center><b>Daftar Penerima SP</b></center>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
  							<div class="row">
  								<div class="col-md-5" style="margin-top:4px;margin-left:0px;>
  									<div class="form-horizontal">
  										<div class="form-group">
											Cari :   <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Berdasarkan Nama" title="Type in a name">
											<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Berdasarkan SP" title="Type in a name">
											</div>
										</div>
									</div>
								</div>
								</div>

               <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
               <thead>
  									<tr style="background:#008B8B;">
											<th><center><label style="color : white;">No.</label></center></th>
											<th>
													<label class="pull-left" style="margin-top: 6px; color : white;">Induk&nbsp;</label>
											</th>
											<th>
													<label class="pull-left" style="margin-top: 6px; color : white;">Nama&nbsp;</label>
											</th>
											<th>
													<label class="pull-left" style="margin-top: 6px; color : white;">Masalah&nbsp;</label>
											</th>
											<th>
													<label class="pull-left" style="margin-top: 6px; color : white;">Tanggal&nbsp;</label>
											</th>
											<th>
													<label class="pull-left" style="margin-top: 6px; color : white;">Skor Point&nbsp;</label>
											</th>
											<th>
													<label class="pull-left" style="margin-top: 4px; color : white;">Jumlah Skor&nbsp;</label>
											</th>
											<th>
													<label class="pull-left" style="margin-top: 6px; color : white;">Keterangan&nbsp;</label>
											</th>
											<th>
											<label class="pull-left" style="margin-top: 6px; color : white;">Aksi&nbsp;</label>
									</th>
  									</tr>
										</thead>
				
                    <tbody>';
  									$jml_data = 20;
  									$awal = ($mulai - 1) * $jml_data;
  									$nomer = $awal;
  									
											// $query = $this->db->query("SELECT * FROM `tb_langgar` WHERE `induk` = '8274' ");
										$query = $this->db->query("SELECT * FROM `tb_langgar`");
  									foreach($query->result() as $row)
  									{
											$query2 = $this->db->query("SELECT * FROM `tb_siswa` WHERE no_induk = '$row->induk'");
											foreach($query2->result() as $row2){}
											
											$query3 = $this->db->query("SELECT SUM(skor_poin) AS total FROM tb_langgar WHERE induk = '$row->induk'");
											foreach($query3->result() as $row3){}
											
											// $jumlah_skor = $row3->skor_poin;
											if($row3->total >= '25' && $row3->total < '50'){
												$ket = "<font color='#0bce08'>SP1</font>";
											} else if ($row3->total >= '50' && $row3->total <'75'){
												$ket = "<font color='#ccff00'>SP2</font>";

											} else if ($row3->total >= '75'&& $row3->total <'100'){
												$ket = "<font color='#d86d08'>SP3</font>";

											}  else if ($row3->total >= '100'){
												$ket = "<font color='#ff0000'>SP4</font>";
											} else {
												$ket = '-';
											}
											$nomer++;
											echo '
											<tr style="background:white;color:black;">
												<td><center><b>'.$nomer.'</b></center></td>
												<td>'.$row -> induk.'</td>
												<td>'.$row2 -> nama.'</td>
												<td>'.$row -> masalah.'</td>
												<td>'.$row -> tanggal.'</td>
												<td>'.$row -> skor_poin.'</td>
												<td>'.$row3->total.'</td>
												<td>'.$ket.'</td>
												<td>
													<a href="#" href="#" onclick="kirimPesan2()">
														<img src="'.base_url().'utama/assists/images/icons/send.ico" width=20 height=20>
													</a>
  												</td>
											</tr>';
  									}
  									if($nomer == 0)
  										echo
  											'<tr class="text-bayang" style="background:red;color:yellow;">
  												<td colspan="12"><b><center>Tidak ada data</center></b></td>
  											</tr>';
  									echo
  								'</tbody>
								</table>
								<center>
									<a href="#" id="pl=sp&id=pdf" class="btn btn-primary" onclick="ctkPresensi(this)">
										<img src="'.base_url().'utama/assists/images/icons/file_extension_pdf.png" width=24 height=24> Export Data
									</a>
								</center>
								<br />

								<script>
									function myFunction() {
										var input, filter, table, tr, td, i, txtValue;
										input = document.getElementById("myInput");
										filter = input.value.toUpperCase();
										table = document.getElementById("dataTables-example");
										tr = table.getElementsByTagName("tr");
										for (i = 0; i < tr.length; i++) {
											td = tr[i].getElementsByTagName("td")[2];
											if (td) {
												txtValue = td.textContent || td.innerText;
												if (txtValue.toUpperCase().indexOf(filter) > -1) {
													tr[i].style.display = "";
												} else {
													tr[i].style.display = "none";
												}
											}       
										}
									}
									</script>
									<script>
									function myFunction1() {
										var input, filter, table, tr, td, i, txtValue;
										input = document.getElementById("myInput1");
										filter = input.value.toUpperCase();
										table = document.getElementById("dataTables-example");
										tr = table.getElementsByTagName("tr");
										for (i = 0; i < tr.length; i++) {
											td = tr[i].getElementsByTagName("td")[7];
											if (td) {
												txtValue = td.textContent || td.innerText;
												if (txtValue.toUpperCase().indexOf(filter) > -1) {
													tr[i].style.display = "";
												} else {
													tr[i].style.display = "none";
												}
											}       
										}
									}
									</script>
								';
								

  							$this->db->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left');
  							if(! (($kelas == '') or ($kelas == 'x')))
  								$this->db->where('tb_kelas.kd_kelas', $kelas);
  							if($cari != '')
  								$this->db->like('tb_siswa.nama', $cari)
  										->or_like('tb_siswa.nisn', $cari)
  										->or_like('tb_siswa.no_induk', $cari)
  										->or_like('tb_siswa.kelas', $cari)
  										->or_like('tb_kelas.nama_kelas', $cari);
  							$query = $this->db->get('tb_siswa');
  							$rowcounts = $query->num_rows();
  							$numpages  = ceil($rowcounts / $jml_data);
  							$sisa      = $rowcounts % $jml_data;
  							if($sisa > 0) $numpages++;
  							$pagenow   = ceil($awal / $jml_data)+1;
  							$nextpage  = $pagenow + 1;
  							$lastpage  = $pagenow - 1;

  							if($nomer > 0)
  								echo
  								'<br/><br/>';
  							if($level > 95)
  							echo
  						'</div>
  						<center>';

  							if($rowcounts > $jml_data)
  							{
  								if($pagenow <= 1)
  									echo '<button type="button" class="btn btn-danger" style="height:34px;" disabled>
  											<img src="'.base_url().'utama/assists/images/icons/control_start.png" width=24 height=24 style="margin-top:-4px;">
  										</button>';
  								else
  									echo '<a href="#" id="pl=siswa&m=1&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
  											<img src="'.base_url().'utama/assists/images/icons/control_start_blue.png" width=24 height=24 style="margin-top:-4px;">
  										</a>';
  								if($pagenow <= 1)
  									echo '<button type="button" class="btn btn-danger" style="height:34px;" disabled>
  											<img src="'.base_url().'utama/assists/images/icons/control_rewind.png" width=24 height=24 style="margin-top:-4px;">
  										</button>';
  								else
  									echo '<a href="#" id="pl=siswa&m='.$lastpage.'&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
  											<img src="'.base_url().'utama/assists/images/icons/control_rewind_blue.png" width=24 height=24 style="margin-top:-4px;">
  										</a>';
  								echo '<button type="button" class="btn btn-primary" disabled>'.$pagenow.'</button>';
  								if($numpages > $pagenow)
  									echo '<a href="#" id="pl=siswa&m='.$nextpage.'&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
  											<img src="'.base_url().'utama/assists/images/icons/control_fastforward_blue.png" width=24 height=24 style="margin-top:-4px;">
  										</a>';
  								else
  									echo '<button type="button" class="btn btn-danger" disabled>
  											<img src="'.base_url().'utama/assists/images/icons/control_fastforward.png" width=16 height=16>
  										</button>';
  								if($pagenow >= $numpages)
  									echo '<button type="button" class="btn btn-danger" disabled>
  											<img src="'.base_url().'utama/assists/images/icons/control_end.png" width=16 height=16>
  										</button>';
  								else
  									echo '<a href="#" id="pl=siswa&m='.$numpages.'&cr='.$cari.'&sr='.$urut.'&ur='.$naik.'&kl='.$kelas.'" class="btn btn-primary" style="height:34px;" onclick="showDataAll(this.id)">
  											<img src="'.base_url().'utama/assists/images/icons/control_end_blue.png" width=24 height=24 style="margin-top:-4px;">
  										</a>';
  							}
  						echo
  						'</center>
  						<br />
  					</div>
  					<!-- ./panel -->
  				</div>
  				<!-- ./col -->';
			exit;
		}
}

