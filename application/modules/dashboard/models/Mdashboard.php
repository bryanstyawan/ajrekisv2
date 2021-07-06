<?php

class Mdashboard extends CI_Model 
{
	
	private $_tbl_survey = "tr_survey_ip";
	
	public function __construct () 
	{
		parent::__construct();
	
	}
	
	public function save_survey($id_pegawai)
    {
	
			
        $post = $this->input->post();
		$this->id_pegawai = $id_pegawai;
        $this->jns_jabatan = $post["jabatan"];
		
		if ($post["jabatan"]=='CPNS') {
			$this->disclaimer = 0;
		}
		else {
			$this->disclaimer = $post["disclaimer"];
		}
		
		$this->input_date = date('y-m-d H:i:s');
        
		$this->diklat_pim = $post["tampil"];
		if ($post["tampil"]=='sdhpim') {
				$this->n_diklat_pim = 15;
		}
		else
		{ 	
			$this->n_diklat_pim = 0;
		}
		
		$this->diklat_jafung = $post["tampiljafung"];
		if ($post["tampiljafung"]=='sdhdiklatjafung') {
				$this->n_diklat_jafung = 15;
		}
		else
		{ 	
			$this->n_diklat_jafung = 0;
		}
		
		$this->diklat_20jp = $post["tampil20jp"];
		if ($post["tampil20jp"]=='sdhdiklat20jp' && $post["jabatan"]=='struktural') {
				$this->n_diklat_20jp = 15;
		}
		else
		{ 	
			if ($post["tampil20jp"]=='sdhdiklat20jp' && $post["jabatan"]<>'struktural') {
				$this->n_diklat_20jp = 22.5;
			}
			else
			{
				$this->n_diklat_20jp = 0;
			}
		}
		
		
		$this->seminar = $post["tampilseminar"];
		if ($post["tampilseminar"]=='sdhseminar' && $post["jabatan"]=='struktural') {
				$this->n_seminar = 15;
		}
		else
		{ 	
			if ($post["tampilseminar"]=='sdhseminar' && $post["jabatan"]<>'struktural') {
				$this->n_seminar = 17.5;
			}
			else
			{
				$this->n_seminar = 0;
			}
		}
		
		if ($post["jabatan"]=='CPNS') {
			$this->n_kualifikasi = 0;
		}
		else {
			$this->kualifikasi = $post["pendidikan"];
			switch ($post["pendidikan"]) {
			  case "S3":
				$this->n_kualifikasi = 25;
				break;
			  case "S2":
				$this->n_kualifikasi = 20;
				break;
			  case "S1D4":
				$this->n_kualifikasi = 15;
				break;
			  case "D3":
				$this->n_kualifikasi = 10;
				break;
			  case "D2D1SMASMK":
				$this->n_kualifikasi = 5;
				break;
			  default:
				$this->n_kualifikasi = 1;
			}
		}
		
		if ($post["jabatan"]=='CPNS') {
			$this->n_penilaian_kinerja = 0;
		}
		else {
			$this->penilaian_kinerja = $post["kinerja"];
			
			switch ($post["kinerja"]) {
			  case "Sangat Baik":
				$this->n_penilaian_kinerja = 30;
				break;
			  case "Baik":
				$this->n_penilaian_kinerja = 25;
				break;
			  case "Cukup":
				$this->n_penilaian_kinerja = 15;
				break;
			  case "Kurang":
				$this->n_penilaian_kinerja = 5;
				break;
			  default:
				$this->n_penilaian_kinerja = 1;
			}
		}
		
		if ($post["jabatan"]=='CPNS') {
			$this->n_hukuman_disiplin = 0;
		}
		else {
			$this->hukuman_disiplin= $post["hukuman"];
			switch ($post["hukuman"]) {
			  case "Berat":
				$this->n_hukuman_disiplin = 1;
				break;
			  case "Sedang":
				$this->n_hukuman_disiplin = 2;
				break;
			  case "Ringan":
				$this->n_hukuman_disiplin = 3;
				break;
			  default:
				$this->n_hukuman_disiplin = 5;
			}
		}
	
		$this->tahun= 2021;
        $this->db->insert($this->_tbl_survey, $this);
		
		//return 1;
    }
	
	public function save_survey_hukuman($id_pegawai)
    {
		
			$penandatangansk = $this->input->post("ttdsk");
			$tglsk = (date('Y-m-d',strtotime($this->input->post("tglsurat"))));
			$alasan = $this->input->post("alasan");   
			$tahun= 2021;
			$data = array(
				'id_pegawai'=>$id_pegawai,
				'penandatangansk'=>$penandatangansk,
				'tglsk'=>$tglsk,
				'alasan'=>$alasan,
				'tahun'=>$tahun
				);	
			
			$this->db->insert('tr_survey_hukuman',$data);
			
			
		
    }
	
	public function save_survey_diklatpim($id_pegawai)
    {
		
			$diklatpim = $this->input->post("tampil");
			if ($diklatpim=='sdhpim') {
				$jnsdiklatpim =  $this->input->post("jenisdiklatpim");
				$tgldiklatpim = $this->input->post("tgldiklatpim"); 
				$tmpdiklatpim = $this->input->post("tmpdiklatpim");

				foreach($jnsdiklatpim as $a => $b)
				{
					$data = array(
					'id_pegawai'=>$id_pegawai,
					'jnsdiklatpim'=>$jnsdiklatpim[$a],
					'tgldiklatpim'=>$tgldiklatpim[$a],
					'tmpdiklatpim'=>$tmpdiklatpim[$a]
					);
					$this->db->insert('tr_survey_diklatpim',$data);
					
				}
			}
		
    }
	
	public function save_survey_diklatjafung($id_pegawai)
    {
		
			$diklatjafung = $this->input->post("tampiljafung");
			if ($diklatjafung=='sdhdiklatjafung') {
				$jenisdiklatjafung =  $this->input->post("jenisdiklatjafung");
				$tgldiklatjafung = $this->input->post("tgldiklatjafung"); 
				$tmpdiklatjafung = $this->input->post("tmpdiklatjafung");

				foreach($jenisdiklatjafung as $a => $b)
				{
					$data = array(
					'id_pegawai'=>$id_pegawai,
					'jnsdiklatjafung'=>$jenisdiklatjafung[$a],
					'tgldiklatjafung'=>$tgldiklatjafung[$a],
					'tmpdiklatjafung'=>$tmpdiklatjafung[$a]
					);
					$this->db->insert('tr_survey_diklatjafung',$data);
					
				};
			}
		
    }
	
	public function save_survey_seminar($id_pegawai)
    {
		
			$seminar = $this->input->post("tampilseminar");
			if ($seminar=='sdhseminar') {
				$jnsseminar =  $this->input->post("jnsseminar");
				$tglseminar = $this->input->post("tglseminar"); 
				$tmpseminar = $this->input->post("tmpseminar");

				foreach($jnsseminar as $a => $b)
				{
					$data = array(
					'id_pegawai'=>$id_pegawai,
					'jnsseminar'=>$jnsseminar[$a],
					'tglseminar'=>$tglseminar[$a],
					'tmpseminar'=>$tmpseminar[$a]
					);
					$this->db->insert('tr_survey_seminar',$data);
					
				}
			}
		
    }
	
	public function save_survey_diklat20jp($id_pegawai)
    {
			
				$diklat20jp = $this->input->post("tampil20jp");
				if ($diklat20jp=='sdhdiklat20jp') {
					$jnsdiklat20jp =  $this->input->post("jenisdiklatjp");
					$tgldiklat20jp = $this->input->post("tgldiklatjp"); 
					$tmpdiklat20jp = $this->input->post("tmpdiklatjp");	
						
					
						foreach($jnsdiklat20jp as $a => $b)
						{
							$data = array(
							'id_pegawai'=>$id_pegawai,
							'jns_diklat'=>$jnsdiklat20jp[$a],
							'tgl_diklat'=>$tgldiklat20jp[$a],
							'tmp_diklat'=>$tmpdiklat20jp[$a]
							);
							$this->db->insert('tr_survey_diklat20jp',$data);
							
						}
					
				}
			
    }

	public function check_data_menit_efektif_rpt()
	{
		# code...
		$bulan = date('m');
		$tahun = date('Y'); 
		$sql = "SELECT
					a.id_pegawai,
					a.bulan,
					a.tahun,
					a.tr_approve,
					a.menit_efektif,
					b.jml_menit AS tr_Menit_efektif
				FROM
					rpt_capaian_kinerja a
				LEFT JOIN (
					SELECT
						id_pegawai,
						SUM(`menit_efektif`) jml_menit
					FROM
						`tr_capaian_pekerjaan`
					WHERE
						MONTH (`tanggal_mulai`) = 4
					AND `status_pekerjaan` = 1
					GROUP BY
						`id_pegawai`
				) b ON b.id_pegawai = a.id_pegawai
				WHERE a.bulan = 4
				AND a.menit_efektif <> b.jml_menit";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}								
	}	

	public function get_data_menit_efektif($param)
	{
		# code...
		$bulan = date('m');
		$tahun = date('Y'); 
		$sql = "SELECT SUM(".$param.") as jumlah
				FROM tr_capaian_pekerjaan a
				JOIN mr_skp_pegawai b ON a.id_uraian_tugas = b.skp_id
				JOIN mr_pegawai c ON a.id_pegawai = c.id
				WHERE a.tanggal_mulai LIKE '%".date('Y-m')."%'
				AND a.tanggal_selesai LIKE '%".date('Y-m')."%'
				AND a.id_pegawai = '".$this->session->userdata('sesUser')."'
				AND a.status_pekerjaan = '1'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result()[0]->jumlah;
		}
		else
		{
			return 0;
		}								
	}

	public function get_data_notify_user($param,$id_pegawai)
	{
		# code...
		$sql = "SELECT a.*
				FROM log_notifikasi a
				WHERE a.receiver = '".$id_pegawai."'
				AND a.status_log = '".$param."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}								
	}
	
	public function get_history_golongan()
	{
		# code...
		$sql = "SELECT b.nama_pangkat, a.tmt
				FROM mr_history_golongan a
				JOIN mr_golongan b
				ON a.id_golongan = b.id
				WHERE a.id_pegawai = '".$this->session->userdata('sesUser')."'
				ORDER BY a.id";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}								
	}	

	public function get_data_dashboard($set_menit_efektif=NULL)
	{
	 	# code...
	 	$bulan = date('m');
	 	$tahun = date('Y'); 
	 	#JOIN mr_skp_pegawai b ON a.id_uraian_tugas = b.skp_id
	 	$sql = "SELECT a.*,
						a.real_tunjangan as tunjangankinerja
				FROM rpt_capaian_kinerja a
				WHERE a.tahun = '".$tahun."'
				AND a.bulan = '".$bulan."'
				AND a.id_pegawai = '".$this->session->userdata('sesUser')."'
				AND a.id_posisi = '".$this->session->userdata('sesPosisi')."'";
	 	$query = $this->db->query($sql);
	 	if($query->num_rows() > 0)
	 	{
	 		return $query->result();
	 	}
	 	else
	 	{
	 		return 0;
	 	}								
	}	
}