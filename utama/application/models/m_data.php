<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	// ======================================================================================
	// # Fungsi string random
	// ======================================================================================
	function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i)
		{
			$str .= $keyspace[rand(0, $max)];
		}
		return $str;
	}

	// ======================================================================================
	// # Fungsi enskripsi
	// ======================================================================================
	public function encryptIt($string)
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'Y4nu4r';
		$secret_iv = 'Pr1j4d1';
		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
		return $output;
	}

	// ======================================================================================
	// # Fungsi deskripsi
	// ======================================================================================
	public function decryptIt($string)
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'Y4nu4r';
		$secret_iv = 'Pr1j4d1';
		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		return $output;
	}

	// ======================================================================================
	// # Fungsi
	// ======================================================================================
	public function showLogin()
	{
		$vals = array(
					'word'          => $this->random_str(5, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),
					'img_path'      => 'utama/assists/captcha_images/',
					'img_url'       => 'utama/assists/captcha_images/',
					'font_path'     => 'utama/assets/tiny_editor/php/FreeSerifItalic.ttf',
					'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
					);

		$captcha = create_captcha($vals);
		// Unset previous captcha and store new captcha word
		$this->session->unset_userdata('captchaCode');
		$this->session->set_userdata('captchaCode',$captcha['word']);
		$captchaImg = $captcha['image'];
		echo
      '<div id="container_demo" >
          <div id="wrapper">
              <div id="login">
              <div class="login-logo">
               <p><b>Silahkan Masuk</b></p>
             </div>
							<div>
								<input type="text" id="username" name="username" placeholder="Id User" onkeyup="cekInput(this)"/>
							</div>
							<div class="input-group margin">
								<input type="password" class="form-control" id="password" placeholder="Password" name="password"style="height:16px;margin-left:-10px;" onkeyup="cekInput(this)">
								<span class="input-group-btn">
									<button type="button" id="tampil" class="btn btn-success btn-flat" style="margin-left:4px;margin-top:5px;height:38px;border-radius:8px;" onclick="showHidePass()">
										<i class="glyphicon glyphicon-eye-open" id="simbol"></i>
									</button>
								</span>
							</div>
						<div class="form-horizontal">';
          	echo $captchaImg;
            echo
            '<a href="#" id="refresh" style="margin-left:10px;" onclick="showLogin()">
            		<img src="'.base_url().'utama/assists/images/icons/refresh.ico" width=24 height=24>
            </a>
            </div>
						<div class="form-horizontal" style="margin-left:10px;margin-top:2px;">
							<input type="text" name="captcha" id="captcha" style="height:16px;margin-left:-10px;" onkeyup="cekInput(this)">
							<span style="height:16px;margin-left:-10px;color: red;">
								**Masukkan kode di atas
							</span>
               <div class="col-sm-12 text-sm-center push">
                  <center>
                   <button name="btn-login" style="height:40px;width:120px;" value="Login" onclick="cekLogin()">Masuk
                   </button> </center>
               </div>
						</div>';
		exit;
	}
	// ======================================================================================
	// # Fungsi Cek login Admin atau Siswa
	// ======================================================================================
	public function cekLogin()
	{
    date_default_timezone_set("Asia/Jakarta");
  		$username = $this->input->get('id');
  		$password = $this->encryptIt($this->input->get('ps'));
  		$inputCaptcha = $this->input->get('cc');
  		$sessCaptcha = $this->session->userdata('captchaCode');
  		if($inputCaptcha == $sessCaptcha)
  		{
  			$hasil = 0;
  			$query = $this->db->select('*')
  					->from('tb_admin')
  					->where('username', $username)
  					->where('password', $password)
  					->get();
  			$hasil = $query -> num_rows();
  			if($hasil > 0)
  			{
  				$user   = $query->row();
  				$username = $user->username;
  				$nama   = $user->nama;
  				$status = $user->status;
  				$login_status = $user->login_status;
  			}
  			else
  			{
  				$query = $this->db->select('*')
  						->from('tb_siswa')
  						->where('nisn', $username)
  						->where('password', $password)
  						->get();
  				$hasil = $query -> num_rows();
  				if($hasil > 0)
  				{
  					$row = $query->row();
  					$username = $row->nisn;
  					$nama     = $row->nama;
  					$status   = $row->status;
  					$login_status = 'N';
  				}
  				else
  				{
  					$query = $this->db->select('*')
  							->from('tb_wali')
  							->where('kd_guru', $username)
  							->where('password', $password)
  							->get();
  					$hasil = $query -> num_rows();
  					if($hasil > 0)
  					{
  						$row = $query->row();
  						$username = $row->kd_guru;
  						$nama     = $row->nama;
              $status = $row->status;
  						$login_status = 'N';
  					}
  				}
  			}
			$password = $this->decryptIt($password);
			if ($hasil == 1)
			{
				if(strtolower($status) == 'kepsek')				{$level = 99;}
				elseif(strtolower($status) == 'administrator')	{$level = 98;}
        elseif(strtolower($status) == 'walikelas')				{$level = 96;}
				elseif(strtolower($status) == 'siswa')          {$level = 91;}
				else
				{
					$this->session->sess_destroy();
					$page = 'home';
					redirect('home');
					exit;
				}
				//die($username.' - '.$password.' - '.$status.' - '.$level);
				$newdata = array
							('username' => $username,
							'nama' => $nama,
							'tingkat' => $status,
							'level' => $level,
							'logged_in' => TRUE
							);
				$this->session->set_userdata($newdata);
				$ip = $this->input->ip_address();
				$waktu = date('Y-m-d H:i:s');
				$status = 'sukses';
				//if($level > 97) $password = '';
				$data = array('user' => $username,
							'password' => $password,
							'tanggal' => $waktu,
							'ip' => $ip,
							'status' => $status);
				$this->db->insert('tb_login', $data);
				$data = array(
							'login_terakhir' => $waktu,
							'login_status' => 'Y',
							'ip' => $ip
							);
				if($level >=97)
					$this->db->where('username', $username)->update('tb_admin', $data);
				elseif($level == 96)
					$this->db->where('kd_guru', $username)->update('tb_wali', $data);
				echo 'sukses';
				exit;
			}
			else
			{
				$ip = $this->input->ip_address();
				$waktu = date('Y-m-d H:i:s');
				$status = 'Gagal';
				$data = array('user' => $username,
							'password' => $password,
							'tanggal' => $waktu,
							'ip' => $ip,
							'status' => $status);
				$this->db->insert('tb_login', $data);
				echo 'Username dan Password tidak Ada';
				exit;
			}
		}
		else
		{
			echo 'Kode Tidak Sama';
			exit;
		}

	}
	// ======================================================================================
	// # Fungsi Logout
	// ======================================================================================
    function logout()
    {
		$username = $this->session->userdata('username');
		$level    = $this->session->userdata('level');
		$data = array('login_status' => 'N');
		if($level > 96)
		$this->db->where('username', $username)->update('tb_admin', $data);
		elseif($level == 94)
		$this->db->where('kd_guru', $username)->update('tb_wali', $data);
    $alamat_ip = $this->session->userdata('ip');

		session_start();
		session_unset();
		session_destroy();

		$this->session->sess_destroy();
		$this->session->set_userdata('ip', $alamat_ip);

		$page = 'home';
		redirect('home');
		exit;
	}

    // ======================================================================================
	// # Fungsi Cek Pengunjung
	// ======================================================================================
	public function cek_pengunjung($page)
	{
    	date_default_timezone_set("Asia/Jakarta");

        $alamat_ip = $this->session->userdata('ip');
        if($alamat_ip == '')
        {
            $this->load->library('user_agent');
            if ($this->agent->is_browser())
            {
                $agent = $this->agent->agent_string();
            }
            elseif ($this->agent->is_robot())
            {
                $agent = $this->agent->robot();
            }
            elseif ($this->agent->is_mobile())
            {
                $agent = $this->agent->mobile();
            }
            elseif ($this->agent->is_referral())
            {
                $agent = $this->agent->referrer();
            }
            else
            {
                $agent = 'Unidentified User Agent';
            }

			$ip = $this->input->ip_address();
			$waktu = date('Y-m-d H:i:s');
			$data = array('tanggal' => $waktu,
						'ip' => $ip,
						'browser' => $agent,
                        'page' => $page);
			$this->db->insert('tb_pengunjung', $data);
			$this->session->set_userdata('ip', $ip);
        }
	}

	// ======================================================================================
	// # Fungsi
	// ======================================================================================
	function showHeaderSiswa()
	{
		$username = $this->session->userdata('username');
		$nama     = $this->session->userdata('nama');
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
									<img src="'.base_url().'utama/assists/photos/home.png" width=24 height=24 class="img-circle" alt="User Image">
									<span class="hidden-xs"><font color="yellow"><b>'.$nama.'</b></font></span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<img src="'.base_url().'utama/assists/photos/home.png" class="img-circle" alt="User Image">
										<p>'.$nama.' - Siswa</p>
									</li>
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
					<ul class="sidebar-menu">
						<li class="header">MAIN NAVIGATION</li>
						<li>
							<a href="home">
								<img src="'.base_url().'utama/assists/images/icons/house.png" width=24 height=24>
								&nbsp;Beranda
							</a>
						</li>
						<li class="treeview">
							<a href="#">
								<img src="'.base_url().'utama/assists/images/icons/bk.png" width=24 height=24>
								<span>Data BK</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="awal?pl=presensi">
										<img src="'.base_url().'utama/assists/images/icons/absensi.png" width=24 height=24>
										&nbsp;History Kehadiran
									</a>
								</li>
								<li>
									<a href="awal?pl=langgar">
										<img src="'.base_url().'utama/assists/images/icons/pelanggaran.png" width=24 height=24>
										&nbsp;History Pelanggaran
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="logout">
								<img src="'.base_url().'utama/assists/images/icons/exit.png" width=24 height=24>
								&nbsp;Logout
							</a>
						</li>
					</ul>
				</section>
			</aside>';
		exit;
	}
    /*	xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
      xx                                        Referensi Master                                                  xx
      xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
	// ======================================================================================
	// # Fungsi Nama Siswa Dalam 1 kelas
	// ======================================================================================
	function array_siswa($kelas)
	{
		$arr_siswa = array();
		$query = $this->db->select('*')
				->from('tb_siswa')
				->where('kelas', $kelas)
				->order_by('nama', 'asc')
				->get();
		foreach($query->result() as $row)
		{
			$id   = $row -> no_induk;
			$nama_siswa = $row -> nama;
			$arr_siswa[$id] = $nama_siswa;
		}
		return $arr_siswa;
	}

	// ======================================================================================
	// # Fungsi Nama Siswa Dalam 1 kelas
	// ======================================================================================
	function pilihSiswa()
	{
		$kelas = $this->input->get('kl');
		echo
			'<div class="col-md-3">
				<label style="color: white;">
					Nama Siswa
				</label>
			</div>
			<div class="col-md-8">
				<select id="indukSelect" name="indukSelect" style="height:28px;width:100%;" >';
					foreach($this->array_siswa($kelas) as $x => $x_value)
					{
						echo '<option value="'.$x.'">'.$x_value.'</option>';
					}
					echo
				'</select>
			</div>';

		exit;
	}

	// ========================
	// # Fungsi Pilihan Agama #
	// ========================
	public function array_agama()
	{
		$arr_agama = array();
		$query = $this->db->select('*')
				->from('tb_agama')
				->get();
		foreach($query->result() as $row)
		{
			$agama_id = $row -> agama_id;
			$agama    = $row -> nama_agama;
			$arr_agama[$agama_id] = $agama;
		}
		return $arr_agama;
	}

	// =========================
	// # Fungsi Pilihan Negara #
	// =========================
	public function array_negara()
	{
		$arr_negara = array();
		$query = $this->db->select('*')
				->from('tb_negara')
				->get();
		foreach($query->result() as $row)
		{
			$id   = $row -> negara_id;
			$nama = $row -> nama_negara;
			$arr_negara[$id] = $nama;
		}
		return $arr_negara;
	}

	// ======================================================================================
	// # Fungsi
	// ======================================================================================
	function ambilDataSiswa($nisn)
	{
		$query = $this->db->select('*')
				->from('tb_siswa')
				->join('tb_kelas', 'tb_kelas.kd_kelas = tb_siswa.kelas', 'left')
				->where('nisn', $nisn)
				->get();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$nisn		= $row -> nisn;
			$password			= $this->decryptIt($row -> password);
			$th_ajaran			= $row -> th_ajaran;
			$nisn				= $row -> nisn;
			$no_induk			= $row -> no_induk;
			$nama				= $row -> nama;
			$kelas				= $row -> kelas;
			$nama_kelas			= $row -> nama_kelas;

			$gender				= $row -> gender;
			$tgl_lhr			= $row -> tgl_lhr;
			$agama				= $row -> agama;
			$warga				= $row -> warga;
			$alamat				= $row -> alamat;
			$tlp_rmh			= $row -> tlp_rmh;
			$sts_tinggal3		= $row -> sts_tinggal3;
			$jarak				= $row -> jarak;
			$waktu				= $row -> waktu;
			$gakin				= $row -> gakin;
			$no_gakin			= $row -> no_gakin;
			$minat				= $row -> minat;

			$nama_ayah			= $row -> nama_ayah;
			$nik_ayah			= $row -> nik_ayah;
			$alamat_ayah		= $row -> alamat_ayah;
			$tgl_ayah			= $row -> tgl_ayah;
			$agama_ayah			= $row -> agama_ayah;
			$warga_ayah			= $row -> warga_ayah;
			$tlp_ayah			= $row -> tlp_ayah;
			$hdp_mt_ayah		= $row -> hdp_mt_ayah;
			$mati_ayah			= $row -> mati_ayah;

			$nama_ibu			= $row -> nama_ibu;
			$nik_ibu			= $row -> nik_ibu;
			$alamat_ibu			= $row -> alamat_ibu;
			$tgl_ibu			= $row -> tgl_ibu;
			$agama_ibu			= $row -> agama_ibu;
			$warga_ibu			= $row -> warga_ibu;
			$tlp_ibu			= $row -> tlp_ibu;
			$hdp_mt_ibu			= $row -> hdp_mt_ibu;
			$mati_ibu			= $row -> mati_ibu;

			$nama_wali			= $row -> nama_wali;
			$nik_wali			= $row -> nik_wali;
			$alamat_wali		= $row -> alamat_wali;
			$tgl_wali			= $row -> tgl_wali;
			$agama_wali			= $row -> agama_wali;
			$warga_wali			= $row -> warga_wali;
			$tlp_wali			= $row -> tlp_wali;
			$hdp_mt_wali		= $row -> hdp_mt_wali;
			$mati_wali			= $row -> mati_wali;

			$th_ajaran			= $row -> th_ajaran;
			$thn_msk			= $row -> thn_msk;
			$sts_siswa			= $row -> sts_siswa;
			$status				= $row -> status;
		}
		else
		{
			$password			= '';
			$th_ajaran			= '';
			$nisn				= '';
			$no_induk			= '';
			$nama				= '';
			$kelas				= '';
			$nama_kelas			= '';
			$gender				= '';
			$tgl_lhr			= '';
			$agama				= '';
			$warga				= '';
			$alamat				= '';
			$tlp_rmh			= '';
			$sts_tinggal3		= '';
			$jarak				= '';
			$waktu				= '';
			$gakin				= '';
			$no_gakin			= '';

			$nama_ayah			= '';
			$nik_ayah			= '';
			$alamat_ayah		= '';
			$tgl_ayah			= '';
			$agama_ayah			= '';
			$warga_ayah			= '';
			$tlp_ayah			= '';
			$hdp_mt_ayah		= '';
			$mati_ayah			= '';

			$nama_ibu			= '';
			$nik_ibu			= '';
			$alamat_ibu			= '';
			$tgl_ibu			= '';
			$agama_ibu			= '';
			$warga_ibu			= '';
			$tlp_ibu			= '';
			$hdp_mt_ibu			= '';
			$mati_ibu			= '';

			$nama_wali			= '';
			$nik_wali			= '';
			$alamat_wali		= '';
			$tgl_wali			= '';
			$agama_wali			= '';
			$warga_wali			= '';
			$tlp_wali			= '';
			$hdp_mt_wali		= '';
			$mati_wali			= '';

			$minat				= '';
			$th_ajaran			= '';
			$thn_msk			= '';
			$sts_siswa			= '';
			$status				= '';
		}

		$dataSiswaArray = array(
			'nisn'		=> $nisn,
			'password'			=> $password,
			'nisn'				=> $nisn,
			'no_induk'			=> $no_induk,
			'nama'				=> $nama,
			'thn_msk'			=> $thn_msk,
			'kelas'				=> $kelas,
			'nama_kelas'		=> $nama_kelas,
			'gender'			=> $gender,
			'tgl_lhr'			=> $tgl_lhr,
			'agama'				=> $agama,
			'warga'				=> $warga,
			'alamat'			=> $alamat,
			'tlp_rmh'			=> $tlp_rmh,
			'sts_tinggal3'		=> $sts_tinggal3,
			'jarak'				=> $jarak,
			'waktu'				=> $waktu,
			'gakin'				=> $gakin,
			'no_gakin'			=> $no_gakin,

			'minat'				=> $minat,
			'nama_ayah'			=> $nama_ayah,
			'nik_ayah'			=> $nik_ayah,
			'alamat_ayah'		=> $alamat_ayah,
			'tgl_ayah'			=> $tgl_ayah,
			'agama_ayah'		=> $agama_ayah,
			'warga_ayah'		=> $warga_ayah,
			'tlp_ayah'			=> $tlp_ayah,
			'hdp_mt_ayah'		=> $hdp_mt_ayah,
			'mati_ayah'			=> $mati_ayah,

			'nama_ibu'			=> $nama_ibu,
			'nik_ibu'			=> $nik_ibu,
			'alamat_ibu'		=> $alamat_ibu,
			'tgl_ibu'			=> $tgl_ibu,
			'agama_ibu'			=> $agama_ibu,
			'warga_ibu'			=> $warga_ibu,
			'tlp_ibu'			=> $tlp_ibu,
			'hdp_mt_ibu'		=> $hdp_mt_ibu,
			'mati_ibu'			=> $mati_ibu,

			'nama_wali'			=> $nama_wali,
			'nik_wali'			=> $nik_wali,
			'alamat_wali'		=> $alamat_wali,
			'tgl_wali'			=> $tgl_wali,
			'agama_wali'		=> $agama_wali,
			'warga_wali'		=> $warga_wali,
			'tlp_wali'			=> $tlp_wali,
			'hdp_mt_wali'		=> $hdp_mt_wali,
			'mati_wali'			=> $mati_wali,

			'th_ajaran'			=> $th_ajaran,
			'sts_siswa'			=> $sts_siswa,
			'status'			=> 'Siswa'
			);
		return $dataSiswaArray;
	}

	// ======================================================================================
	// # Fungsi
	// ======================================================================================
	function modalEditSiswa()
	{
		$level    = $this->session->userdata('level');

		if($level > 93)
			$nisn = $this->input->get('id');
		else
			$nisn = $this->session->userdata('username');

		$dataKu = array();
		$dataKu = $this->ambilDataSiswa($nisn);

		$kkCek		= false;
		$ktpCek		= false;
		$photoCek	= false;
		if(file_exists('./utama/assists/photos/'.$nisn))
		{
			$nmFile = array('kk', 'ktp', 'photo');
			for($i = 0; $i < count($nmFile); $i++)
			{
				if(file_exists('./utama/assists/photos/'.$nisn.'/'.$nmFile[$i].'.png') or
					file_exists('./utama/assists/photos/'.$nisn.'/'.$nmFile[$i].'.jpeg') or
					file_exists('./utama/assists/photos/'.$nisn.'/'.$nmFile[$i].'.jpg') or
					file_exists('./utama/assists/photos/'.$nisn.'/'.$nmFile[$i].'.bmp'))
				{
					if($i == 0) $kkCek = true;
					elseif($i == 3) $ktpCek = true;
					elseif($i == 5) $photoCek = true;
				}
			}

		}

		echo
				'<!-- modal-dialog -->
				<div class="modal-dialog modal-lg" role="document">
					<!-- modal-content -->
					<div class="modal-content" style="background: green; border-radius: 15px;">
						<!-- modal header -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="modal-title " id="isianUserLabel">
								<center><b>
									<img src="'.base_url().'utama/assists/images/icons/personal-information.ico" width=32 height=32> Edit Data Siswa - <font color="yellow">'.ucwords(strtolower($dataKu["nama"])).'</font>
								</b></center>
							</h3>
						</div>
						<!-- ./modal header -->

						<!-- modal body -->
						<div class="modal-body" id="isianDataSiswa">

							<!-- Panel -->
							<div class="panel" style="background-color: green;border-radius: 8px;">
								<div class="panel-body" style="background-color: lightgrey;border-radius: 8px;">

									<!-- Nav tabs -->
									<ul class="nav nav-pills">
										<li class="active"><a href="#utama" data-toggle="tab"><b>Utama</b></a></li>
										<li><a href="#diri_siswa" data-toggle="tab"><b>Diri Siswa</b></a></li>
										<li><a href="#ayah" data-toggle="tab"><b>Ayah K</b></a></li>
										<li><a href="#ibu" data-toggle="tab"><b>Ibu K</b></a></li>
										<li><a href="#wali" data-toggle="tab"><b>Wali</b></a></li>
										<li><a href="#lain" data-toggle="tab"><b>Lain-lain</b></a></li>';
										if($level != 94)
										echo
									'</ul>
									<!-- /. Nav tabs -->
									<hr/>

									<!-- Tab panes -->
									<div class="tab-content">

										<!-- Bagian Utama -->
										<div class="tab-pane fade in active" id="utama">
											<div class="row">
												<!-- col Kiri -->
												<div class="col-md-6">
													<div class="form-group">
														<label class="">Nama Lengkap Siswa : </label>
														<input type="text" name="nama" id="nama" class="form-control" value="'.ucwords(strtolower($dataKu['nama'])).'" ';if($level == 94) echo ' disabled '; echo '>
													</div>';
													if($level > 95)
														echo
													'<div class="col-md-5">
														<div class="form-group" style="margin-left: -12px;">
															<label class="">Nomer Induk : </label>
															<input type="text" name="no_induk" id="no_induk" class="form-control" value="'.$dataKu['no_induk'].'">
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<label class="">Tahun Pelajaran : </label><br/>
															<input type="number" name="th_ajaran" id="th_ajaran" min="2016" max="2025" value="'.$dataKu['th_ajaran'].'" style="height: 34px;width: 80px;text-align: center;" oninput="rbhDtSiswaTA()">
															&nbsp;&nbsp;&nbsp;&nbsp;<span id="dtSiswaTapel"><b> -&nbsp;&nbsp;&nbsp;&nbsp; '.($dataKu['th_ajaran'] + 1).'</b></span>
														</div>
													</div>';
													else
														echo
													'<div class="col-md-5">
														<div class="form-group" style="margin-left: -12px;">
															<label class="">Nomer Induk : </label>
															<input type="text" name="no_induk" id="no_induk" class="form-control" value="'.$dataKu['no_induk'].'" disabled>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<label class="">Tahun Pelajaran : </label><br/>
															<input type="number" name="th_ajaran" id="th_ajaran" min="2016" max="2025" value="'.$dataKu['th_ajaran'].'" style="height: 34px;width: 80px;text-align: center;" disabled>
															&nbsp;&nbsp;&nbsp;&nbsp;<span id="dtSiswaTapel"><b> -&nbsp;&nbsp;&nbsp;&nbsp; '.($dataKu['th_ajaran'] + 1).'</b></span>
														</div>
													</div>';
													echo
													'
												</div>
												<!-- ./col Kiri -->
												<!-- col Kanan -->
												<div class="col-md-6">
													<div class="col-md-12">
														<div class="form-group">
															<label class="">Nomer Induk Siswa Nasional (NISN) : </label>
															<input type="text" name="nisn" id="nisn" class="form-control" value="'.$dataKu['nisn'].'" ';if($level == 94) echo ' disabled '; echo '>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="">Kelas : </label>
															<select class="form-control" id="kelas" name="kelas" ';if($level < 95) echo ' disabled '; echo'>';
															$query = $this->db->select('*')
																		->from('tb_kelas')
																		->get();
															if($query->num_rows() > 0)
															{
																foreach($query->result() as $row)
																{
																	$kd_kelas = $row->kd_kelas;
																	if($dataKu['kelas'] == $kd_kelas)
																		echo '<option value="'.$row->kd_kelas.'" selected> '.$row->nama_kelas.'</option>';
																	else
																		echo '<option value="'.$row->kd_kelas.'"> '.$row->nama_kelas.'</option>';
																}
															}
															echo
															'</select>
														</div>
													</div>
													<div class="col-md-8">
														<div class="input-group">
															<label class="">Password : </label>
															<input type="password" class="form-control" id="password" name="password" value="'.$dataKu['password'].'" ';if($level == 94) echo ' disabled '; echo '>
															<span class="input-group-btn">
																<button type="button" id="tampil" class="btn btn-warning btn-flat" style="margin-top: 25px;" onclick="showHidePass()" ';if($level == 94) echo ' disabled '; echo '>
																	<i class="glyphicon glyphicon-eye-open" id="simbol"></i>
																</button>
															</span>
														</div>
													</div>
												</div>
												<!-- col Kanan -->
											</div>
											<!-- ./row -->
										</div>
										<!-- ./Bagian Utama -->

										<!-- Bagian Data Diri Siswa -->
                    <!-- Bagian Data Diri Siswa -->
										<div class="tab-pane fade" id="diri_siswa">
											<div class="row">
												<!-- col Kiri -->
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Tanggal Lahir : </label>
																<input type="date" name="tgl_lhr" id="tgl_lhr" class="form-control" value="'.$dataKu['tgl_lhr'].'" ';if($level == 94) echo ' disabled '; echo '>
															</div>
                              <div class="form-group">
    														<label class="">Alamat Rumah : </label>
    														<input type="text" name="alamat" id="alamat" class="form-control" value="'.ucwords(strtolower($dataKu['alamat'])).'" ';if($level == 94) echo ' disabled '; echo '>
    													</div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="">Jarak Sekolah dari Rumah : </label>
                                    <select class="form-control" name="jarak" id="jarak" ';if($level == 94) echo ' disabled '; echo '>
                                      <option value=""> -- Pilih salah satu -- </option>
                                      <option value="1" ';if($dataKu['jarak']=="1") echo ' selected ' ; echo ' >Kurang dari 1 Km</option>
                                      <option value="2" ';if($dataKu['jarak']=="2") echo ' selected ' ; echo ' >Lebih dari 1 Km</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="">Waktu Tempuh ke Sekolah : </label>
                                    <select class="form-control" name="waktu" id="waktu" ';if($level == 94) echo ' disabled '; echo '>
                                      <option value=""> -- Pilih -- </option>
                                      <option value="1" ';if($dataKu['waktu']=="1") echo ' selected ' ; echo ' >Kurang dari 30 menit</option>
                                      <option value="2" ';if($dataKu['waktu']=="2") echo ' selected ' ; echo ' >30 - 60 menit</option>
                                      <option value="3" ';if($dataKu['waktu']=="3") echo ' selected ' ; echo ' >lebih dari 60 menit</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
													</div>
                        </div>
											</div>
												<!-- ./col Kiri -->
												<!-- col Kanan -->
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="">Agama : </label>
																<select class="form-control" name="agama" id="agama" ';if($level == 94) echo ' disabled '; echo '>';
																	foreach($this->array_agama() as $x => $x_value)
																	{
																		echo '<option value="'.$x.'"'; if($x == $dataKu['agama']) echo ' selected ' ; echo' >'.$x_value.'</option>';
																	}
																	echo
																'</select>
															</div>
                              <div class="form-group">
																<label class="">Nomor Telp. / Nomor HP : </label>
																<input type="text" name="tlp_rmh" id="tlp_rmh" class="form-control" value="'.$dataKu['tlp_rmh'].'" ';if($level == 94) echo ' disabled '; echo '>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="">Kewarganegaraan : </label>
																<select class="form-control" name="warga" id="warga" ';if($level == 94) echo ' disabled '; echo '>';
																	foreach($this->array_negara() as $x => $x_value)
																	{
																		echo '<option value="'.$x.'"'; if($x == $dataKu['warga']) echo ' selected ' ; echo' >'.$x_value.'</option>';
																	}
																	echo
																'</select>
															</div>
														</div>
													</div>
                          <div class=rows >
													<div class="form-group">
														<label class="">Jenis Kelamin : &nbsp;&nbsp;</label>
                            <div>
														<label class="radio-inline">
															<input type="radio" name="gender" id="gender1" value="P" ';
															if($dataKu['gender'] == 'P') echo "checked"; echo ' > <div class="">Perempuan</div>
														</label>
														&nbsp;&nbsp;&nbsp;
														<label class="radio-inline">
															<input type="radio" name="gender" id="gender2" value="L" ';
															if($dataKu['gender'] == 'L') echo "checked"; echo ' > <div class="">Laki-laki</div>
														</label>
                            </div>
													</div>
                        </div>
											</div>
												<!-- col Kanan -->
											</div>
											<!-- ./row -->
										</div>
										<!-- ./Bagian Data Diri Siswa -->

										<!-- Bagian Tempat Tinggal -->
										<div class="tab-pane fade" id="tempat_tinggal">
											<div class="row">
												<!-- col Kanan -->
												<div class="col-md-12">
													<div class="form-group">
															<input type="radio" name="sts_tinggal3" id="tdkMampu" value="Y" ';
															if($dataKu['sts_tinggal3']=="Y") echo 'checked'; echo ' onclick="cekGakin()" ';
															if($level == 94) echo ' disabled '; echo '> Ya
														</label>
														&nbsp;&nbsp;&nbsp;&nbsp;
														<label class="">
															<input type="radio" name="sts_tinggal3" id="mampu" value="T" ';if($dataKu['sts_tinggal3']=="T") echo 'checked'; echo ' onclick="cekGakin()" ';if($level == 94) echo ' disabled '; echo '> Tidak
														</label>
													</div>
													<div class="form-group" id="stsTinggal3" ';if($dataKu['sts_tinggal3'] == "T") echo ' style="display: none;" '; echo '>
														<label class="">Penerima KPS/ KIP/ SKTM/ GAKIN ?</label>
														&nbsp;&nbsp;&nbsp;&nbsp;
														<label class="">
															<input type="radio" name="gakin" id="gakin1" value="Y" ';if($dataKu['gakin']=="Y") echo 'checked'; echo ' > Ya
														</label>
														<label class="">
															<input type="radio" name="gakin" id="gakin2" value="T" ';if($dataKu['gakin']=="T") echo 'checked'; echo ' > Tidak
														</label>
													</div>
													<div class="form-group" id="noGakin" ';if($dataKu['sts_tinggal3'] == "T") echo ' style="display: none;" '; echo '>
														<label class="">Nomer Kartu / Surat : </label>
														<input type="text" name="no_gakin" id="no_gakin" class="form-control" value="'.$dataKu['no_gakin'].'">
													</div>
												</div>
												<!-- col Kanan -->
											</div>
											<!-- ./row -->
										</div>
										<!-- ./Bagian Tempat Tinggal -->

                    <!-- Bagian Ayah Kandung -->
  										<div class="tab-pane fade" id="ayah">
  											<div class="row">
  												<!-- col Kiri -->
  												<div class="col-md-6">
  													<div class="form-group">
  														<label class="">Nama Ayah Kandung : </font></label>
  														<input type="text" name="nama_ayah" id="nama_ayah" class="form-control" value="'.ucwords(strtolower($dataKu['nama_ayah'])).'" ';if($level == 94) echo ' disabled '; echo '>
  													</div>
  													<div class="row">
  														<div class="col-md-6">
  															<div class="form-group">
  																<label class="">NIK Ayah : </label>
  																<input type="text" name="nik_ayah" id="nik_ayah" class="form-control" value="'.$dataKu['nik_ayah'].'" ';if($level == 94) echo ' disabled '; echo '>
  															</div>
  														</div>
  														<div class="col-md-6">
  															<div class="form-group">
  																<label class="">Tanggal Lahir Ayah : </label>
  																<input type="date" name=tgl_ayah"" id="tgl_ayah" class="form-control" value="'.$dataKu['tgl_ayah'].'" ';if($level == 94) echo ' disabled '; echo '>
  															</div>
  														</div>
  													</div>
  												</div>
  												<!-- ./col Kiri -->
  												<!-- col Kanan -->
  												<div class="col-md-6">
  													<div class="row">
  														<div class="col-md-6">
  															<div class="form-group">
  																<label class="">Telephone Ayah : </label>
  																<input type="text" name="tlp_ayah" id="tlp_ayah" class="form-control" value="'.$dataKu['tlp_ayah'].'" ';if($level == 94) echo ' disabled '; echo '>
  															</div>
  														</div>
                              <div class="col-md-6">
                              <div class="form-group">
    														<label class="">Alamat Rumah : </label>
    														<input type="text" name="alamat_ayah" id="alamat_ayah" class="form-control" value="'.ucwords(strtolower($dataKu['alamat_ayah'])).'" ';if($level == 94) echo ' disabled '; echo '>
    													</div>
                             </div>
  													</div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="">Agama : </label>
                                  <select class="form-control" name="agama_ayah" id="agama_ayah" ';if($level == 94) echo ' disabled '; echo '>
                                    <option value=""> == Pilih Agama == </option>';
                                    foreach($this->array_agama() as $x => $x_value)
                                    {
                                      echo '<option value="'.$x.'"'; if($x == $dataKu['agama_ayah']) echo ' selected ' ; echo' >'.$x_value.'</option>';
                                    }
                                    echo
                                  '</select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="">Kewarganegaraan Ayah : </label>
                                  <select class="form-control" name="warga_ayah" id="warga_ayah" ';if($level == 94) echo ' disabled '; echo '>
                                    <option value=""> == Pilih Kewarganegaraan == </option>';
                                    foreach($this->array_negara() as $x => $x_value)
                                    {
                                      echo '<option value="'.$x.'"'; if($x == $dataKu['warga_ayah']) echo ' selected ' ; echo' >'.$x_value.'</option>';
                                    }
                                    echo
                                  '</select>
                                </div>
                              </div>
                            </div>
    													<div class="form-group">
    														<label class="">Masih Hidup / Meninggal Dunia ?</label>
    														<br/>
    														<label class="">
    															<input type="radio" name="hdp_mt_ayah" id="hdpAyah" value="Y" ';if($dataKu['hdp_mt_ayah']=="Y") echo 'checked'; echo ' onclick="cekAyah()" ';if($level == 94) echo ' disabled '; echo '> Masih Hidup
    														</label>
    														&nbsp;&nbsp;&nbsp;&nbsp;
    														<label class="">
    															<input type="radio" name="hdp_mt_ayah" id="matiAyah" value="T" ';if($dataKu['hdp_mt_ayah']=="T") echo 'checked'; echo ' onclick="cekAyah()" ';if($level == 94) echo ' disabled '; echo '> Sudah Meninggal
    														</label>
    													</div>
    													<div class="form-group" id="ayahHidup" ';if($dataKu['hdp_mt_ayah']=="Y") echo ' style="display: none;" '; echo ' >
    														<label class="">Tahun meninggal : </label>
    														<input type="number" name="mati_ayah" id="mati_ayah" class="form-control" value="'.$dataKu['mati_ayah'].'" ';if($level == 94) echo ' disabled '; echo ' >
    													</div>
    												</div>
    												<!-- col Kanan -->
    											</div>
    											<!-- ./row -->
    										</div>
    										<!-- ./Bagian Ayah Kandung -->

  										<!-- Bagian Ibu Kandung -->
  										<div class="tab-pane fade" id="ibu">
  											<div class="row">
  												<!-- col Kiri -->
  												<div class="col-md-6">
  													<div class="form-group">
  														<label class="">Nama Ibu Kandung : </label>
  														<input type="text" name="nama_ibu" id="nama_ibu" class="form-control" value="'.ucwords(strtolower($dataKu['nama_ibu'])).'" ';if($level == 94) echo ' disabled '; echo '>
  													</div>
  													<div class="row">
  														<div class="col-md-6">
  															<div class="form-group">
  																<label class="">NIK Ibu : </label>
  																<input type="text" name="nik_ibu" id="nik_ibu" class="form-control" value="'.$dataKu['nik_ibu'].'" ';if($level == 94) echo ' disabled '; echo '>
  															</div>
  														</div>
  														<div class="col-md-6">
  															<div class="form-group">
  																<label class="">Tanggal Lahir Ibu : </label>
  																<input type="date" name="tgl_ibu" id="tgl_ibu" class="form-control" value="'.$dataKu['tgl_ibu'].'" ';if($level == 94) echo ' disabled '; echo '>
  															</div>
  														</div>
  													</div>
  												</div>
  												<!-- ./col Kiri -->
  												<!-- col Kanan -->
  												<div class="col-md-6">
  													<div class="row">
  														<div class="col-md-6">
  															<div class="form-group">
  																<label class="">Telephone Ibu : </label>
  																<input type="text" name="tlp_ibu" id="tlp_ibu" class="form-control" value="'.$dataKu['tlp_ibu'].'" ';if($level == 94) echo ' disabled '; echo '>
  															</div>
  														</div>
                              <div class="col-md-6">
                              <div class="form-group">
                                <label class="">Alamat Rumah : </label>
                                <input type="text" name="alamat_ibu" id="alamat_ibu" class="form-control" value="'.ucwords(strtolower($dataKu['alamat_ibu'])).'" ';if($level == 94) echo ' disabled '; echo '>
                              </div>
                             </div>
  													</div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="">Agama : </label>
                                  <select class="form-control" name="agama_ibu" id="agama_ibu" ';if($level == 94) echo ' disabled '; echo '>
                                    <option value=""> == Pilih Agama == </option>';
                                    foreach($this->array_agama() as $x => $x_value)
                                    {
                                      echo '<option value="'.$x.'"';if($x == $dataKu['agama_ibu']) echo ' selected ' ;echo' >'.$x_value.'</option>';
                                    }
                                    echo
                                  '</select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="">Kewarganegaraan Ibu : </label>
                                  <select class="form-control" name="warga_ibu" id="warga_ibu" ';if($level == 94) echo ' disabled '; echo '>
                                    <option value=""> == Pilih Kewarganegaraan == </option>';
                                    foreach($this->array_negara() as $x => $x_value)
                                    {
                                      echo '<option value="'.$x.'"'; if($x == $dataKu['warga_ibu']) echo ' selected ' ; echo' >'.$x_value.'</option>';
                                    }
                                    echo
                                  '</select>
                                </div>
                              </div>
                            </div>
  													<div class="form-group">
  														<label class="">Masih Hidup / Meninggal Dunia ?</label>
  														<br/>
  														<label class="">
  															<input type="radio" name="hdp_mt_ibu" id="hdpIbu" value="Y" ';if($dataKu['hdp_mt_ibu']=="Y") echo 'checked'; echo ' onclick="cekIbu()" ';if($level == 94) echo ' disabled '; echo '> Masih Hidup
  														</label>
  														&nbsp;&nbsp;&nbsp;&nbsp;
  														<label class="">
  															<input type="radio" name="hdp_mt_ibu" id="matiIbu" value="T" ';if($dataKu['hdp_mt_ibu']=="T") echo 'checked'; echo ' onclick="cekIbu()" ';if($level == 94) echo ' disabled '; echo '> Sudah Meninggal
  														</label>
  													</div>
  													<div class="form-group" id="ibuHidup" ';if($dataKu['hdp_mt_ibu'] == "Y") echo ' style="display: none;" '; echo ' >
  														<label class="">Tahun meninggal : </label>
  														<input type="number" name="mati_ibu" id="mati_ibu" class="form-control" value="'.$dataKu['mati_ibu'].'" ';if($level == 94) echo ' disabled '; echo ' >
  													</div>
  												</div>
  												<!-- col Kanan -->
  											</div>
  											<!-- ./row -->
  										</div>
  										<!-- ./Bagian Ibu Kandung -->

  										<!-- Bagian Wali -->
  										<div class="tab-pane fade" id="wali">
  											<div class="row">
  												<!-- col Kiri -->
  												<div class="col-md-6">
  													<div class="form-group">
  														<label class="">Nama Wali : </label>
  														<input type="text" name="nama_wali" id="nama_wali" class="form-control" value="'.$dataKu['nama_wali'].'">
  													</div>
  													<div class="row">
  														<div class="col-md-6">
  															<div class="form-group">
  																<label class="">NIK Wali : </label>
  																<input type="text" name="nik_wali" id="nik_wali" class="form-control" value="'.$dataKu['nik_wali'].'">
  															</div>
  														</div>
  														<div class="col-md-6">
  															<div class="form-group">
  																<label class="">Tanggal Lahir Wali : </label>
  																<input type="date" name="tgl_wali" id="tgl_wali" class="form-control" value="'.$dataKu['tgl_wali'].'">
  															</div>
  														</div>
  													</div>
  												</div>
  												<!-- ./col Kiri -->
  												<!-- col Kanan -->
  												<div class="col-md-6">
  													<div class="row">
  														<div class="col-md-6">
  															<div class="form-group">
  																<label class="">Telephone Wali : </label>
  																<input type="text" name="tlp_wali" id="tlp_wali" class="form-control" value="'.$dataKu['tlp_wali'].'">
  															</div>
  														</div>
                              <div class="col-md-6">
                              <div class="form-group">
                                <label class="">Alamat Rumah : </label>
                                <input type="text" name="alamat_wali" id="alamat_wali" class="form-control" value="'.$dataKu['alamat_wali'].'">
                              </div>
                             </div>
  													</div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="">Agama : </label>
                                  <select class="form-control" name="agama_wali" id="agama_wali">
                                    <option value=""> == Pilih Agama == </option>';
                                    foreach($this->array_agama() as $x => $x_value)
                                    {
                                      echo '<option value="'.$x.'"'; if($x == $dataKu['agama_wali']) echo ' selected ' ; echo' >'.$x_value.'</option>';
                                    }
                                    echo
                                  '</select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="">Kewarganegaraan Wali : </label>
                                  <select class="form-control" name="warga_wali" id="warga_wali">
                                    <option value=""> == Pilih Kewarganegaraan == </option>';
                                    foreach($this->array_negara() as $x => $x_value)
                                    {
                                      echo '<option value="'.$x.'"'; if($x == $dataKu['warga_wali']) echo ' selected ' ; echo' >'.$x_value.'</option>';
                                    }
                                    echo
                                  '</select>
                                </div>
                              </div>
                            </div>
  													<div class="form-group" ';if($dataKu['hdp_mt_wali'] == "Y") echo ' style="display: none;" '; echo ' >
  														<label class="">Masih Hidup / Meninggal Dunia ?</label>
  														<br/>
  														<label class="">
  															<input type="radio" name="hdp_mt_wali" id="hdpWali" value="Y" ';if($dataKu['hdp_mt_wali']=="Y") echo 'checked'; echo ' onclick="cekWali()" ';if($level == 94) echo ' disabled '; echo '> Masih Hidup
  														</label>
  														&nbsp;&nbsp;&nbsp;&nbsp;
  														<label class="">
  															<input type="radio" name="hdp_mt_wali" id="matiWali" value="T" ';if($dataKu['hdp_mt_wali']=="T") echo 'checked'; echo ' onclick="cekWali()" ';if($level == 94) echo ' disabled '; echo '> Sudah Meninggal
  														</label>
  													</div>
                            <div class="form-group" id="ibuHidup" ';if($dataKu['hdp_mt_wali'] == "Y") echo ' style="display: none;" '; echo ' >
                              <label class="">Tahun meninggal : </label>
                              <input type="number" name="mati_wali" id="mati_wali" class="form-control" value="'.$dataKu['mati_wali'].'" ';if($level == 94) echo ' disabled '; echo ' >
                            </div>
  												</div>

  												<!-- col Kanan -->
  											</div>
  											<!-- ./row -->
  										</div>
  										<!-- ./Bagian Wali -->

										<!-- Bagian Lain-lain -->
										<div class="tab-pane fade" id="lain">
											<div class="row">
												<!-- col Kiri -->
												<div class="col-md-12">
													<div class="form-group">
													</div>';
													if($level <= 93)
														echo
													'<div class="row">
														<div class="col-md-12">
															<label class=""><font color="red"><b>*)Harus diperhatikan. Peminatan penjurusan hanya dapat dilakukan maksimal 1x saja. Anda tidak dapat merubah Peminatan Penjurusan setelah tombol <button type="button" class="btn btn-primary" style="border-radius:8px;">
																<img src="'.base_url().'utama/assists/images/icons/accept.png" width=20 height=20> Simpan
															</button> anda tekan.<br/>Peminatan dibatasi oleh kouta yang disedikan dan nilai UN Matematika serta nilai UN IPA</b></font></label>
														</div>
													</div>';
													echo
												'</div>
												<!-- ./col Kiri -->
												<!-- col Kanan -->
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="">Tahun Masuk : </label>
																<input type="number" name="thn_msk" id="thn_msk" class="form-control" value="'.$dataKu['thn_msk'].'" ';if($level <= 95)echo 'disabled '; echo '>
															</div>
														</div>
														<div class="col-md-6">
														<div class="form-group">
															<label class="">Peminatan Penjurusan : <font color="red">(maksimal 1x pengisian)</font></label>';
															if($level > 95)
															{
																echo
															'<select class="form-control" name="minat" id="minat">
																<option value=""> -- Pilih -- </option>';
																$query = $this->db->select('*')
																			->from('tb_prodi')
																			->get();
																foreach($query->result() as $row)
																{
																	$prodi = $row->prodi;
																	$nama_prodi = $row->nama_prodi;
																	echo
																	'<option value="'.$prodi.'" ';if($prodi == $dataKu["minat"]) echo ' selected '; echo '> '.$nama_prodi.' </option>';
																}
															}
															else
															{
																if(($dataKu['minat'] != '') or
																	($dataKu['nil_bin'] == 0) or
																	($dataKu['nil_big'] == 0) or
																	($dataKu['nil_mat'] == 0) or
																	($dataKu['nil_ipa'] == 0))
																	echo
																	'<select class="form-control" name="minat" id="minat" disabled>
																		<option value=""> -- Isikan semua Nilai UN -- </option>';
																else
																{
																	if(($dataKu['nil_ipa'] >= 75) and ($dataKu['nil_mat'] >= 75))
																		echo
																		'<select class="form-control" name="minat" id="minat">
																			<option value=""> -- Pilih Peminatan -- </option>';
																	else
																	{
																		$dataKu['minat'] = 'IPS';
																		echo
																		'<select class="form-control" name="minat" id="minat" disabled>
																			<option value=""> -- Pilih Peminatan -- </option>';
																	}

																}
																$query = $this->db->select('*')
																			->from('tb_prodi')
																			->order_by('prodi', 'desc')
																			->get();
																foreach($query->result() as $row)
																{
																	$minatM = $row->prodi;
																	$nama_minat = $row->nama_prodi;
																	echo
																	'<option value="'.$minatM.'" ';
																		if($dataKu['minat'] == $minatM) echo ' selected ';
																		echo '> '.$nama_minat.' </option>';
																}
															}
																echo
															'</select>
														</div>
														</div>
													</div>
													<div class="row">
													</div>';
													if($level <= 93)
														echo
													'<div class="row">
														<div class="col-md-12">
															<label class=""><font color="red"><b>*) Hasil Penjurusan ditentukan berdasarkan ranking dari : Nilai TPA, nilai UN Matematika, nilai UN IPA, hasil psikotes dan pilihan peminatan.</b></font></label>
														</div>
													</div>';
													echo
												'</div>
												<!-- col Kanan -->
											</div>
											<!-- ./row -->
										</div>
										<!-- /.Bagian Lain-lain -->

									</div>
									<!-- /. Tab panes -->

								</div>
								<!-- /. Panel Body -->

							</div>
							<!-- /. Panel -->

						</div>
						<!-- ./modal body -->

						<!-- modal footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-warning pull-left" data-dismiss="modal" style="border-radius:8px;">
								<img src="'.base_url().'utama/assists/images/icons/cross.png" width=20 height=20> Close
							</button>';
							if($level != 94)
								echo
							'<button type="button" class="btn btn-primary" onClick="simpanDataSiswa()" style="border-radius:8px;">
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

	// ======================================================================================
	// # Fungsi
	// ======================================================================================
	function simpanDataSiswa()
	{
		$outp = array();
		$dt_isian = array("nisn", "password", "nisn","no_induk", "nama", "thn_msk", "kelas",
						"gender", "tgl_lhr",
						"agama", "warga",
						"alamat","tlp_rmh",
					  "sts_tinggal3", "jarak", "waktu", "gakin", "no_gakin",
						"nama_ayah", "nik_ayah","tgl_ayah", "agama_ayah", "warga_ayah",
						"alamat_ayah", "tlp_ayah", "hdp_mt_ayah", "mati_ayah",
						"nama_ibu", "nik_ibu","tgl_ibu", "agama_ibu", "warga_ibu",
            "alamat_ibu", "tlp_ibu", "hdp_mt_ibu", "mati_ibu",
						"nama_wali", "nik_wali","tgl_wali", "agama_wali", "warga_wali",
            "alamat_wali","tlp_wali", "hdp_mt_wali", "mati_wali",
					  "sts_siswa", "th_ajaran", "minat"
						);
		$nil_isian = array();
		for($i = 0; $i < count($dt_isian); $i++)
		{
			$isian_dt = $dt_isian[$i];
			if($isian_dt == 'password')
				$nil_isian[$isian_dt] = $this->encryptIt($this->input->post($isian_dt));
			else
				$nil_isian[$isian_dt] = $this->input->post($isian_dt);
		}
		$nisn = $nil_isian["nisn"];
		$minat = $nil_isian["minat"];

		if($minat != '')
		{
			$query = $this->db->select('*')
						->from('tb_siswa')
						->join('tb_prodi', 'tb_prodi.prodi = tb_siswa.minat', 'left')
						->where('tb_prodi.prodi', $minat)
						->get();
			$jmlSiswa = $query->num_rows();

			$query = $this->db->select('*')
						->from('tb_kelas')
						->select_sum('maksi', 'jmlMaksi')
						->where('kd_prodi', $minat)
						->get();
			$row = $query->row();
			$maksi = $row->jmlMaksi;
		}
		else
		{
			$jmlSiswa = 0;
			$maksi    = 100;
		}
		if($jmlSiswa < $maksi)
		{
			$query = $this->db->select('*')
						->from('tb_siswa')
						->where('nisn', $nisn)
						->get();
			$rowcounts = $query->num_rows();
			if($rowcounts > 0)
			{
				$this->db->where('nisn', $nisn)->update('tb_siswa', $nil_isian);
				$outp[1] = 'Sukses merubah data siswa';
				//$outp[1] = 'maksi = ' .$maksi. ' jmlSiswa = ' . $jmlSiswa;
			}
			else
			{
				$this->db->insert('tb_siswa', $nil_isian);
				$outp[1] = 'Sukses menambah data siswa';
			}
			$outp[0] = 'sukses';
		}
		else
		{
			$outp[0] = 'error';
			$outp[1] = 'Sudah melebihi batas peminatan';
		}

		echo json_encode($outp);
		exit;
	}
	// ======================================================================================
	// # Fungsi
	// ======================================================================================
	public function showSiswaPresensi()
	{
		date_default_timezone_set("Asia/Jakarta");
		$nisn = $this->session->userdata('username');

		if(isset($_GET['m']))  $mulai    = $this->input->get('m');  else $mulai = 1;
		if(isset($_GET['t1'])) $tglAwal  = $this->input->get('t1'); else $tglAwal = date('Y-m-d');
		if(isset($_GET['t2'])) $tglAkhir = $this->input->get('t2'); else $tglAkhir = date('Y-m-d');

		$query = $this->db->select('*')
					->from('tb_siswa')
					->where('nisn', $nisn)
					->get();
		$row = $query->row();
		$induk = $row->no_induk;

		echo
		'  </br><div class="col-md-12">
			<input type="hidden" id="mulai" value="'.$mulai.'">
      </br><div class="panel panel-primary">
				<div class="panel-heading">
					<center><b><i>Daftar Kehadiran</i></b></center>
				</div>
				<!-- /.panel-heading -->
				<form action="cetakPresensiPDF" method="POST">
				<input type="hidden" id="induk" name="induk" value="'.$induk.'">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
						<div class="form-horizontal">
							<div class="form-group">
								<label for="inputCetak" class="col-md-2 control-label">Tanggal :</label>
								<div class="col-md-4" style="margin-top:4px;margin-left:0px;">
									<input type="date" id="tglAwal" name="tglAwal" value="'.$tglAwal.'" oninput="ubahSiswaPresensi(this)">
								</div>
								<div class="col-md-1" style="margin-top:6px;margin-left:-20px;">
									<center><b>s/d</b></center>
								</div>
								<div class="col-md-4" style="margin-top:4px;margin-left:-10px;">
									<input type="date" id="tglAkhir" name="tglAkhir" value="'.$tglAkhir.'" oninput="ubahSiswaPresensi(this)">
								</div>
							</div>
						</div>
						</div>
					</div>
					<div class="row">';
						$jml_data = 60;
						$data_tengah = 20;
						if($mulai == 0)
							$awal = 0;
						else
							$awal = ($mulai - 1) * $jml_data;
						$nomer = $awal;
						for($i = 0; $i < 3; $i++)
						{
							echo
							'<div class="col-md-12">
								<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr style="background:#008B8B;color:white;">
											<th><center>No.</center></th>
											<th><center>Tanggal</center></th>
                      <th><center>Waktu</center></th>
											<th><center>Keterangan Kehadiran</center></th>
										</tr>
									</thead>
									<tbody>';
										$query = $this->db->select('*')
													->from('tb_presensi')
													->where('induk', $induk)
													->where('tanggal >=', $tglAwal)
													->where('tanggal <=', $tglAkhir)
													->limit($jml_data, $awal)
													->order_by('tanggal', 'asc')
													->get();
										foreach($query->result() as $row)
										{
											$nomer++;
											$tanggal = $row->tanggal;
                      $waktu   = $row->jam;
											$jns   = $row->jenis;
											if(strtolower($jns) == 's') $jenis = 'Sakit';
											elseif(strtolower($jns) == 's') $jenis = 'Sakit';
											elseif(strtolower($jns) == 'i') $jenis = 'Ijin';
											elseif(strtolower($jns) == 'a') $jenis = 'Alpha';
											elseif(strtolower($jns) == 't') $jenis = 'Terlambat';
											echo
											'<tr class="gradeA">
												<td><center>'.$nomer.'</center></td>
												<td><center>'.$tanggal.'</center></td>
                        <td><center>'.$waktu.'</center></td>
												<td><center>'.$jenis.'</center></td>
											</tr>';
										}
										if($nomer == 0)
											echo
											'<tr style="background:red;color:yellow;">
												<td colspan="12"><b><center>Tidak ada data</center></b></td>
											</tr>
											<tr>
												<td colspan="3"><b>*) Siswa tidak pernah Sakit, Ijin, Terlambat dan Tanpa Keterangan (Alpha) selama periode ini</b></td>
											</tr>';
											/*
											echo
											'<tr style="background:red;color:yellow;">
												<td><center>'.$nomer.'</center></td>
												<td><center>'.$tglAwal.'</center></td>
												<td><center>'.$tglAkhir.'</center></td>
											</tr>';
											*/
										echo
									'</tbody>
								</table>
							</div>';
							if($nomer < $data_tengah)
								$i = 5;
							else $awal += $data_tengah;
						}
						echo
					'</div>';
					if($nomer > 0)
					{
						echo
						'<center>';
						$query = $this->db->select('*')
									->from('tb_presensi')
									->where('induk', $induk)
									->where('tanggal >=', $tglAwal)
									->where('tanggal <=', $tglAkhir)
									->get();
						$rowcounts = $query->num_rows();
						$numpages  = ceil($rowcounts / $jml_data);
						$pagenow   = ceil($awal / $jml_data)+1;
						$nextpage  = $pagenow + 1;
						$lastpage  = $pagenow - 1;

						if($rowcounts > $jml_data)
						{
							if($pagenow <= 1)
								echo '<button type="button" class="btn btn-danger" style="height:34px;" disabled>
										<img src="'.base_url().'utama/assists/images/icons/control_start.png" width=24 height=24 style="margin-top:-4px;">
									</button>';
							else
								echo '<a href="#" id="1" class="btn btn-primary" style="height:34px;" oninput="ubahSiswaPresensi(this)">
										<img src="'.base_url().'utama/assists/images/icons/control_start_blue.png" width=24 height=24 style="margin-top:-4px;">
									</a>';
							if($pagenow <= 1)
								echo '<button type="button" class="btn btn-danger" style="height:34px;" disabled>
										<img src="'.base_url().'utama/assists/images/icons/control_rewind.png" width=24 height=24 style="margin-top:-4px;">
									</button>';
							else
								echo '<a href="#" id="'.$lastpage.'" class="btn btn-primary" style="height:34px;" oninput="ubahSiswaPresensi(this)">
										<img src="'.base_url().'utama/assists/images/icons/control_rewind_blue.png" width=24 height=24 style="margin-top:-4px;">
									</a>';
							echo '<button type="button" class="btn btn-primary" disabled>'.$pagenow.'</button>';
							if($numpages > $pagenow)
								echo '<a href="#" id="'.$nextpage.'" class="btn btn-primary" style="height:34px;" oninput="ubahSiswaPresensi(this)">
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
								echo '<a href="#" id="'.$numpages.'" class="btn btn-primary" style="height:34px;" oninput="ubahSiswaPresensi(this)">
										<img src="'.base_url().'utama/assists/images/icons/control_end_blue.png" width=24 height=24 style="margin-top:-4px;">
									</a>';
						}
						echo
						'<br />
							<button type="submit" class="btn btn-primary" style="border-radius: 8px;">
								<img src="'.base_url().'utama/assists/images/icons/file_extension_pdf.png" width=24 height=24> Cetak Semua Data
							</button>
						</center>
						<br />';
					}
					echo
				'</div>
				<!-- /.panel-body -->
				</form>
			</div>
			<!-- /.panel -->
		</div>';

		exit;
	}

	// ======================================================================================
	// # Fungsi
	// ======================================================================================
	public function showSiswaLanggar()
	{
		date_default_timezone_set("Asia/Jakarta");
		$nisn = $this->session->userdata('username');

		if(isset($_GET['m']))  $mulai    = $this->input->get('m');  else $mulai = 1;
		if(isset($_GET['t1'])) $tglAwal  = $this->input->get('t1'); else $tglAwal = date('Y-m-d');
		if(isset($_GET['t2'])) $tglAkhir = $this->input->get('t2'); else $tglAkhir = date('Y-m-d');

		$query = $this->db->select('*')
					->from('tb_siswa')
					->where('nisn', $nisn)
					->get();
		$row = $query->row();
		$induk = $row->no_induk;

		echo
		'</br><div class="col-md-12">
			<input type="hidden" id="mulai" value="'.$mulai.'">
			</br><div class="panel panel-primary">
				<div class="panel-heading">
					<center><b><i>Daftar Pelanggaran</i></b></center>
				</div>
				<!-- /.panel-heading -->
				<form action="cetakLanggarPDF" method="POST">
				<input type="hidden" id="induk" name="induk" value="'.$induk.'">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
						<div class="form-horizontal">
							<div class="form-group">
								<label for="inputCetak" class="col-md-2 control-label">Tanggal :</label>
								<div class="col-md-4" style="margin-top:4px;margin-left:0px;">
									<input type="date" id="tglAwal" name="tglAwal" value="'.$tglAwal.'" oninput="ubahSiswaLanggar(this)">
								</div>
								<div class="col-md-1" style="margin-top:6px;margin-left:-20px;">
									<center><b>s/d</b></center>
								</div>
								<div class="col-md-4" style="margin-top:4px;margin-left:-10px;">
									<input type="date" id="tglAkhir" name="tglAkhir" value="'.$tglAkhir.'" oninput="ubahSiswaLanggar(this)">
								</div>
							</div>
						</div>
						</div>
					</div>
					<div class="row">';
						$jml_data = 20;
						$data_tengah = 10;
						if($mulai == 0)
							$awal = 0;
						else
							$awal = ($mulai - 1) * $jml_data;
						$nomer = $awal;
						for($i = 0; $i < 2; $i++)
						{
							echo
							'<div class="col-md-12">
								<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr style="background:#008B8B;color:white;">
											<th><center>No.</center></th>
											<th><center>Tanggal</center></th>
											<th><center>Masalah</center></th>
                      <th><center>Poin</center></th>
                      <th><center>Oleh</center></th>
                      <th><center>Status</center></th>
										</tr>
									</thead>
									<tbody>';
										$query = $this->db->select('*')
													->from('tb_langgar')
													->where('induk', $induk)
													->where('tanggal >=', $tglAwal)
													->where('tanggal <=', $tglAkhir)
													->limit($jml_data, $awal)
													->order_by('tanggal', 'asc')
													->get();
										foreach($query->result() as $row)
										{
											$nomer++;
											$tanggal = $row->tanggal;
											$mslh    = $row->masalah;
                      $poin    = $row->skor_poin;
                      $oleh    = $row->oleh;
											$sts     = $row->statusL;
											if(strtolower($sts) == 'b') $status = 'Belum';
											elseif(strtolower($sts) == 's') $status = 'Sudah';
											elseif(strtolower($sts) == 'p') $status = 'Proses';
											echo
											'<tr class="gradeA">
												<td><center>'.$nomer.'</center></td>
												<td><center><b>'.$tanggal.'</b></center></td>
												<td><center><b>'.$mslh.'</b></center></td>
                        <td><center><b>'.$poin.'</b></center></td>
                        <td><center><b>'.$oleh.'</b></center></td>
												<td><center><b>'.$status.'</b></center></td>
											</tr>';

										}
										if($nomer == 0)
											echo
											'<tr style="background:red;color:white;">
												<td colspan="12"><b><center>Tidak ada data</center></b></td>
											</tr>
											<tr>
												<td colspan="4"><b>*) Siswa tidak pernah melakukan pelanggaran selama periode ini</b></td>
											</tr>';
											/*
											echo
											'<tr style="background:red;color:yellow;">
												<td><center>'.$nomer.'</center></td>
												<td><center>'.$tglAwal.'</center></td>
												<td><center>'.$tglAkhir.'</center></td>
											</tr>';
											*/
										echo
									'</tbody>
								</table>
							</div>';
							if($nomer < $data_tengah)
								$i = 5;
							else $awal += $data_tengah;
						}
						echo
					'</div>';
					if($nomer > 0)
					{
						echo
						'<center>';
						$query = $this->db->select('*')
									->from('tb_langgar')
									->where('induk', $induk)
									->where('tanggal >=', $tglAwal)
									->where('tanggal <=', $tglAkhir)
									->get();
						$rowcounts = $query->num_rows();
						$numpages  = ceil($rowcounts / $jml_data);
						$pagenow   = ceil($awal / $jml_data)+1;
						$nextpage  = $pagenow + 1;
						$lastpage  = $pagenow - 1;

						if($rowcounts > $jml_data)
						{
							if($pagenow <= 1)
								echo '<button type="button" class="btn btn-danger" style="height:34px;" disabled>
										<img src="'.base_url().'utama/assists/images/icons/control_start.png" width=24 height=24 style="margin-top:-4px;">
									</button>';
							else
								echo '<a href="#" id="1" class="btn btn-primary" style="height:34px;" oninput="ubahSiswaLanggar(this)">
										<img src="'.base_url().'utama/assists/images/icons/control_start_blue.png" width=24 height=24 style="margin-top:-4px;">
									</a>';
							if($pagenow <= 1)
								echo '<button type="button" class="btn btn-danger" style="height:34px;" disabled>
										<img src="'.base_url().'utama/assists/images/icons/control_rewind.png" width=24 height=24 style="margin-top:-4px;">
									</button>';
							else
								echo '<a href="#" id="'.$lastpage.'" class="btn btn-primary" style="height:34px;" oninput="ubahSiswaLanggar(this)">
										<img src="'.base_url().'utama/assists/images/icons/control_rewind_blue.png" width=24 height=24 style="margin-top:-4px;">
									</a>';
							echo '<button type="button" class="btn btn-primary" disabled>'.$pagenow.'</button>';
							if($numpages > $pagenow)
								echo '<a href="#" id="'.$nextpage.'" class="btn btn-primary" style="height:34px;" oninput="ubahSiswaLanggar(this)">
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
								echo '<a href="#" id="'.$numpages.'" class="btn btn-primary" style="height:34px;" oninput="ubahSiswaLanggar(this)">
										<img src="'.base_url().'utama/assists/images/icons/control_end_blue.png" width=24 height=24 style="margin-top:-4px;">
									</a>';
						}
						echo
						'<br />
							<button type="submit" class="btn btn-primary" style="border-radius: 8px;">
								<img src="'.base_url().'utama/assists/images/icons/file_extension_pdf.png" width=24 height=24> Cetak Semua Data
							</button>
						</center>
						<br />';
					}
					echo
				'</div>
				<!-- /.panel-body -->
				</form>
			</div>
			<!-- /.panel -->
		</div>';

		exit;
	}

}
