		<?php
			$query = $this->db->select('*')
						->from('tb_sekolah')
						->get();
			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$nama = $row->nama_sekolah;
				$kota = $row->kota;
			}
			else
			{
				$nama = '';
				$kota = '';
			}
		?>
        <div class="container-Wrapper">
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
            <section id="idLogin">
            </section>
        </div>
