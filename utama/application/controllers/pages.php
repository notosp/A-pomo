<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url','captcha'));
        $this->load->library(array('form_validation', 'email'));
        //$this->load->library(array('form_validation', 'email'));
        $this->load->database();
        $this->load->model('m_data');
        $this->load->model('m_admin');
        $this->load->model('m_cetak');
	}

	function view($page = 'home')
	{
		$alamat_ip = $this->session->userdata('ip');
		if($alamat_ip == '') $this->m_data->cek_pengunjung($page);

		// Cek session apakah username sudah ada
		$username = $this->session->userdata('username');
		if($username == "")
		{
			if($page == 'showLogin') $this->m_data->showLogin();				// Tampilan Login Form
			elseif($page == 'cekLogin') $this->m_data->cekLogin();				// Cek Input Login
			elseif( ! file_exists('utama/application/views/pages/'.$page.'.php'))
			{
				redirect('home');
				exit;
			}
			else
			{
				$title = 'A-Pomo';
				$data = array('title' => $title);
				$this->load->view('pages/template/atas');
				$this->load->view('pages/'.$page, $data);
				$this->load->view('pages/template/bawah');
			}
		}
		else
		{
			$level = $this->session->userdata('level');
			if($page == 'logout') 				$this->m_data->logout();
			elseif($page == 'cetakPresensiPDF')	$this->m_cetak->cetakPresensiPDF();
			elseif($page == 'cetakSPPDF') $this->m_cetak->cetakSPPDF();
			elseif($page == 'cetakLanggarPDF')	$this->m_cetak->cetakLanggarPDF();
			elseif($page == 'getKota')			$this->m_data->pilihKota();			// Kode Kota Kelahiran
			elseif($page == 'getKotaAyah')		$this->m_data->pilihKotaAyah();
			elseif($page == 'getKotaIbu')		$this->m_data->pilihKotaIbu();
			elseif($page == 'getKotaWali')		$this->m_data->pilihKotaWali();
			elseif($page == 'getKota1')			$this->m_data->pilihKota1();		// Kode Kota Alamat
			elseif($page == 'getKotaAyah1')		$this->m_data->pilihKotaAyah1();
			elseif($page == 'getKotaIbu1')		$this->m_data->pilihKotaIbu1();
			elseif($page == 'getKotaWali1')		$this->m_data->pilihKotaWali1();
			elseif($page == 'getSiswa')			$this->m_data->pilihSiswa();
			elseif($page == 'modalEditSiswa')	$this->m_data->modalEditSiswa();
			elseif($page == 'simpanDataSiswa')	$this->m_data->simpanDataSiswa();
			elseif($level >= 97)				$this->admin_page($page);
      elseif($level == 96)				$this->admin_page($page);
			elseif($level == 91)				$this->siswa_page($page);
			else $this->m_data->logout();
		}
	}

	// ======================================================================================
	// # Page Administrator
	// ======================================================================================
    function admin_page($page)
    {
		if($page == 'showDataAll')				$this->m_admin->showDataAll();
		elseif($page == 'showHeaderAdmin') 		$this->m_admin->showHeaderAdmin();
		elseif($page == 'hapusData')			$this->m_admin->hapusData();
		elseif($page == 'hapusDataAll')			$this->m_admin->hapusDataAll();
    elseif($page == 'sp')			$this->m_admin->showDataSuratp();
		elseif($page == 'showDataSekolah')		$this->m_admin->showDataSekolah();
		elseif($page == 'simpanDataSekolah')	$this->m_admin->simpanDataSekolah();
		elseif($page == 'kirimSms')	$this->m_admin->kirimSms();

		elseif($page == 'showAdminModal')		$this->m_admin->showAdminModal();
		elseif($page == 'simpanDataAdmin')		$this->m_admin->simpanDataAdmin();

		elseif($page == 'showPelanggaranModal')	$this->m_admin->showPelanggaranModal();
		elseif($page == 'simpanDataPelanggaran') $this->m_admin->simpanDataPelanggaran();

		elseif($page == 'showWaliModal')		$this->m_admin->showWaliModal();
		elseif($page == 'simpanDataWali')		$this->m_admin->simpanDataWali();

		elseif($page == 'showLanggarModal')		$this->m_admin->showLanggarModal();
		elseif($page == 'simpanLanggarSiswa')	$this->m_admin->simpanLanggarSiswa();
		elseif($page == 'rubahPresensi')		$this->m_admin->rubahPresensi();
		elseif($page == 'ctkPresensiModal')		$this->m_admin->ctkPresensiModal();
	    elseif($page == 'kirimPesan2')			$this->m_admin->kirimPesan2();
	    elseif($page == 'balasPesan')			$this->m_admin->balasPesan();
		elseif( ! file_exists('utama/application/views/p_admin/'.$page.'.php'))
		{
			redirect('home');
			exit;
		}
		else
		{
			$this->load->view('p_admin/template/header');
			$this->load->view('p_admin/'.$page);
			$this->load->view('p_admin/template/footer');
		}
	}
	// ======================================================================================
	// # Page Siswa
	// ======================================================================================
    function siswa_page($page)
    {
		if($page == 'showHeaderSiswa')			$this->m_data->showHeaderSiswa();
		elseif($page == 'showSiswaPresensi')	$this->m_data->showSiswaPresensi();
		elseif($page == 'showSiswaLanggar')		$this->m_data->showSiswaLanggar();
		elseif( ! file_exists('utama/application/views/p_siswa/'.$page.'.php'))
		{
			redirect('home');
			exit;
		}
		else
		{
			$this->load->view('p_siswa/template/header');
			//$this->load->view('p_siswa/template/nav');
			$this->load->view('p_siswa/'.$page);
			$this->load->view('p_siswa/template/footer');
		}
	}
}
