	<?php
		$level = $this->session->userdata('level');
		$nama  = $this->session->userdata('nama');
		$status  = $this->session->userdata('status');
	?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<ol class="breadcrumb">
						<li class="active">
							<img src="<?php echo base_url();?>utama/assists/images/icons/house.png" width=24 height=24> Home
						</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Header -->
					<h2><strong><font color="#6FF00FF"><center><div id="idJam"></div></center></font></strong></h2>
					<hr />
					<input type="hidden" id="lapel" name="lapel" value="<?php echo $level;?>">
					<?php
						date_default_timezone_set("Asia/Jakarta");

						$waktu = intval(date("G"));
						if(($waktu < 10) and ($waktu > 4))
							echo '<h2 style="color: #6A5ACD;">
								<strong><center>Selamat Pagi</center></strong></h2>';
						elseif($waktu < 16)
							echo '<h2 style="color: #CD5C5C;">
								<strong><center>Selamat Siang</center></strong></h2>';
						elseif($waktu < 20)
							echo '<h2 style="color: #D2691E;">
								<strong><center>Selamat Sore</center></strong></h2>';
						else
							echo '<h2 style="color: black;">
								<strong><center>Selamat Malam</center></strong></h2>';
					?>
				</br>
					<h2 style="color: #006400;">
						<strong><center>Selamat Datang <font color="#B8860B"><?php echo $nama; if($level ==99)echo ' (Kepala Sekolah)'; elseif ($level ==98) echo ' (Administrator)'; elseif ($level ==96) echo ' (WaliKelas)';?></font> Di Aplikasi A-Pomo</center></strong>
					</h2>
					<input type="hidden" id="lapel" name="lapel" value="<?php echo $level;?>">
				</section>
				<!-- ./inner Main -->
			</div>
			<!-- ./main -->
