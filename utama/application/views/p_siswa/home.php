	<?php
		$level = $this->session->userdata('level');
		$induk = $this->session->userdata('username');
		$nama  = $this->session->userdata('nama');
	?>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header hit-the-floor">
					<ol class="breadcrumb">
						<li class="active">
							<a href="#">
								<img src="<?php echo base_url();?>utama/assists/images/icons/house.png" width=24 height=24> Home
							</a>
						</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Header -->
					<h2 style="color: blue;">
						<strong><center><div id="idJam"></div></center></strong>
					</h2>
					<hr />
					<?php
						date_default_timezone_set("Asia/Jakarta");

						$waktu = intval(date("G"));
						if(($waktu < 10) and ($waktu > 4))
							echo '<h2 style="color: #6A5ACD;">
								<strong><center>Selamat Pagi</center></strong></h2>';
						elseif($waktu < 17)
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
						<strong><center>Selamat Datang <font color="#B8860B"> ' <?php echo $nama;?> '</font> Di Aplikasi A-Pomo</center></strong>
					</h2>
					<input type="hidden" id="lapel" name="lapel" value="<?php echo $level;?>">

				</section>
			</div>
			<!-- ./main -->
