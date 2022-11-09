<?php
class Mtalenta extends CI_Model
{
 	public function __construct () {
		parent::__construct();
	}

	public function getIndikator()
	{
		# code...
		$sql = "SELECT 
		a.id as id_indikator,
		a.nama as nama_indikator,
		a.sort
		FROM q_talenta_indikator a
		ORDER BY a.sort asc";
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

	public function getIndicatorProgess($sort)
	{
		# code...
		$sql = "SELECT
		a.id as id_indikator,
		a.nama as nama_indikator,
		a.sort,
		a.id		
		FROM q_talenta_indikator a
		WHERE a.sort = '".$sort."'";
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

	public function track_progress($id_pegawai)
	{
		# code...
		$sql = "SELECT a.*
		FROM q_talenta_progress a
		WHERE a.id_pegawai = '".$id_pegawai."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			$result = $query->result(); 
			$x =  $result[0]->id_q_talenta_indikator;
			return $x+1;
		}
		else
		{
			return 1;
		}		
	}

	public function checkDataJawaban($payload)
	{
		# code...
		$sql = "SELECT a.*
		FROM q_single_jawaban a
		WHERE a.id_q_talenta_pertanyaan = '".$payload['id_q_talenta_pertanyaan']."'
		AND a.id_pegawai = '".$payload['id_pegawai']."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}		
	}

	public function checkDataJawabanKinerja($payload)
	{
		# code...
		$sql = "SELECT a.*
		FROM q_kinerja_jawaban a
		WHERE a.id_q_talenta_pertanyaan = '".$payload['id_q_talenta_pertanyaan']."'
		AND a.id_pegawai = '".$payload['id_pegawai']."'
		AND a.id_pegawai_penilai = '".$payload['id_pegawai_penilai']."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}		
	}	

	public function getQuestionPegawai($id_indikator,$id_pegawai)
	{
		# code...
		$sql = "SELECT 
		a.id AS id_indikator,
		a.nama AS nama_indikator,
		b.id AS id_sub_indikator,
		b.nama AS nama_sub_indikator,
		c.id AS id_pertanyaan,
		c.nama AS pertanyaan,
		d.id AS id_parameter,
		d.nama AS nama_parameter,
		e.jawaban,
		e.jumlah
		FROM q_talenta_indikator a
		LEFT JOIN q_talenta_sub_indikator b 
		ON a.id = b.id_q_talenta_indikator
		LEFT JOIN q_talenta_pertanyaan c
		ON c.id_q_talenta_sub_indikator = b.id
		LEFT JOIN q_talenta_parameter d
		ON c.parameter = d.id
		LEFT JOIN q_single_jawaban e
		ON e.id_q_talenta_pertanyaan = c.id		
		WHERE a.id = '".$id_indikator."'
		AND e.`id_pegawai` = '".$id_pegawai."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			$data =  $query->result();
			return count($data);
		}
		else
		{
			return 0;
		}		
	}

	public function singleAnswer($id_pertanyaan,$id_pegawai)
	{
		# code...
		$sql = "SELECT a.*
		FROM q_single_jawaban a
		WHERE a.id_q_talenta_pertanyaan = '".$id_pertanyaan."'
		AND a.id_pegawai = '".$id_pegawai."' ";
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

	public function getQuestion($id_indikator)
	{
		# code...
		$sql = "SELECT 
		a.id as id_indikator,
		a.nama as nama_indikator,
		b.id as id_sub_indikator,
		b.nama as nama_sub_indikator,
		COALESCE(c.id,0) as id_pertanyaan,
		c.nama as pertanyaan,
		d.id as id_parameter,
		d.nama as nama_parameter
		-- e.jawaban,
		-- e.jumlah
		FROM q_talenta_indikator a
		LEFT JOIN q_talenta_sub_indikator b 
		ON a.id = b.id_q_talenta_indikator
		LEFT JOIN q_talenta_pertanyaan c
		ON c.id_q_talenta_sub_indikator = b.id
		LEFT JOIN q_talenta_parameter d
		ON c.parameter = d.id
		-- LEFT JOIN q_single_jawaban e
		-- ON e.id_q_talenta_pertanyaan = c.id		
		WHERE a.id = '".$id_indikator."'";
		// print_r($sql);die();
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

	public function getQuestionJabatan($id_indikator,$param)
	{
		# code...
		$sql = "SELECT 
		a.id as id_indikator,
		a.nama as nama_indikator,
		b.id as id_sub_indikator,
		b.nama as nama_sub_indikator,
		c.id as id_pertanyaan,
		c.nama as pertanyaan,
		d.id as id_parameter,
		d.nama as nama_parameter
		-- e.jawaban,
		-- e.jumlah
		FROM q_talenta_indikator a
		LEFT JOIN q_talenta_sub_indikator b 
		ON a.id = b.id_q_talenta_indikator
		LEFT JOIN q_talenta_pertanyaan c
		ON c.id_q_talenta_sub_indikator = b.id
		LEFT JOIN q_talenta_parameter d
		ON c.parameter = d.id
		-- LEFT JOIN q_single_jawaban e
		-- ON e.id_q_talenta_pertanyaan = c.id		
		WHERE a.id = '".$id_indikator."'
		AND c.jabatan = '".$param."'";
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
	
	public function getAnswer($id_indikator)
	{
		# code...
		$sql = "SELECT
		a.*,
		d.id as id_indikator
		FROM q_single_jawaban a
		LEFT JOIN q_talenta_pertanyaan b
		ON a.id_q_talenta_pertanyaan = b.id
		LEFT JOIN q_talenta_sub_indikator c
		ON b.id_q_talenta_sub_indikator = c.id
		LEFT JOIN q_talenta_indikator d
		ON d.id = c.id_q_talenta_indikator		
		WHERE d.id = '".$id_indikator."'";
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

	public function get_request_eval($id)
	{
		# code...
		$sql = "SELECT 	a.*,
						-- a.status as `status_prilaku`,
						b.*,
						a.id as evaluator_id
				FROM q_penilaian_kinerja a
				JOIN mr_pegawai b
				ON a.id_pegawai = b.id
				WHERE a.id_pegawai_penilai = '".$id."'
				AND a.status != 1";
		// print_r($sql);die();						
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

	public function get_data_evaluator($id,$id_posisi=NULL)
	{
		# code...
		$sql_where = "";
		if ($id_posisi != NULL) {
			# code...
			$sql_where = "AND a.id_posisi_pegawai = '".$id_posisi."'";			
		}
		$sql = "SELECT a.*,
						b.nama_pegawai,
						pnpos.nama_posisi
				FROM q_penilaian_kinerja a
				JOIN mr_pegawai b
				ON a.id_pegawai_penilai = b.id
				LEFT JOIN mr_posisi pnpos ON a.id_posisi_pegawai_penilai = pnpos.id
				WHERE a.id_pegawai = '".$id."'
				".$sql_where."";
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
