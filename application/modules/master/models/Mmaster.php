<?php
class Mmaster extends CI_Model {

	public function __construct () {
		parent::__construct();
	}

	public function eselon2(){
		$this->db->select(" e1.nama_eselon1, e2.* ");
		$this->db->from("mr_eselon1 e1");
		$this->db->join("mr_eselon2 e2","e1.id_es1=e2.id_es1");
		return $this->db->get();
	}

	public function eselon3(){
		$this->db->select(" e1.nama_eselon1, e2.nama_eselon2, e3.* ");
		$this->db->from("mr_eselon1 e1");
		$this->db->join("mr_eselon2 e2","e1.id_es1=e2.id_es1");
		$this->db->join("mr_eselon3 e3","e2.id_es2=e3.id_es2");
		return $this->db->get();
	}

	public function eselon4(){
		$this->db->select(" e1.nama_eselon1, e2.nama_eselon2, e3.nama_eselon3, e4.* ");
		$this->db->from("mr_eselon1 e1");
		$this->db->join("mr_eselon2 e2","e1.id_es1=e2.id_es1");
		$this->db->join("mr_eselon3 e3","e2.id_es2=e3.id_es2");
		$this->db->join("mr_eselon4 e4","e3.id_es3=e4.id_es3");
		return $this->db->get();
	}

	public function activeDay(){
		$this->db->select(" a.nama_bulan, b.* ");
		$this->db->from('mr_bulan a');
		$this->db->join('mr_hari_aktif b','a.id=b.bulan');
		$this->db->order_by('b.tahun asc,b.bulan asc');
		return $this->db->get();
	}

	public function struktur($num,$offset,$flag){
		$this->db->where($flag);
		$this->db->select(" a.*, b.nama_kat_posisi, es1.nama_eselon1, es2.nama_eselon2, es3.nama_eselon3, es4.nama_eselon4 ");
		$this->db->from("mr_eselon1 es1");
		$this->db->join("mr_eselon2 es2","es2.id_es1=es1.id_es1");
		$this->db->join("mr_eselon3 es3","es3.id_es2=es2.id_es2");
		$this->db->join("mr_eselon4 es4","es4.id_es3=es3.id_es3");
		$this->db->join("mr_posisi a","a.eselon4=es4.id_es4");
		$this->db->join("mr_kat_posisi b","b.id=a.kat_posisi");
		// $this->db->limit($num,$offset);
		return $this->db->get();
	}

	// public function dataUser($flag,$num,$offset){
	// 	$this->db->where($flag);
	// 	$this->db->select("a.*, b.nama_posisi, c.nama_role, d.nama_agama, es1.nama_eselon1, es2.nama_eselon2, es3.nama_eselon3, es4.nama_eselon4, es1.id_es1, es2.id_es2, es3.id_es3, es4.id_es4 ");
	// 	$this->db->from('mr_pegawai a');
	// 	$this->db->join('mr_posisi b','b.id=a.posisi');
	// 	$this->db->join('user_role c','a.id_role=c.id_role');
	// 	$this->db->join('mr_agama d','a.agama=d.id_agama');
	// 	$this->db->join('mr_eselon4 es4','es4.id_es4=a.es4');
	// 	$this->db->join('mr_eselon3 es3','es3.id_es3=es4.id_es3');
	// 	$this->db->join('mr_eselon2 es2','es2.id_es2=es3.id_es2');
	// 	$this->db->join('mr_eselon1 es1','es1.id_es1=es2.id_es1');
	// 	$this->db->order_by("id ASC");
	// 	// $this->db->limit($num,$offset);
	// 	return $this->db->get();
	// }

	public function data_pegawai($flag=NULL,$order_by=NULL)
	{
		# code...
		$sql_1      = "";
		$sql_2      = "";
		$sql_3      = "";
		$sql_4      = "";
		$select_opt = "	COALESCE(
									(SELECT 
											pic.photo
										FROM mr_pegawai_photo pic
										WHERE pic.id_pegawai = a.id
										AND pic.main_pic = 1
									),'-'
								) AS photo,
								a.local,
        						a.es1,
        						a.es2,
        						a.es3,
        						a.es4,
        						a.id,
        						b.id AS `id_posisi`,
        						b.kat_posisi,
        						c.posisi_class,";
		if ($flag == 'default')
		{
			# code...
			$sql_1 = "AND a.es1 = '".$this->session->userdata('sesEs1')."'";
		}
		elseif ($flag == 'report') {
			# code...
			$sql_1 = "AND a.es1 = '".$this->session->userdata('sesEs1')."'";
			$select_opt = "b.id AS `id_posisi`,";
		}
		else
		{
			if ($flag['eselon1'] == '') {
				# code...
				$sql_1 = "";
			}
			else $sql_1 = "AND a.es1 = '".$flag['eselon1']."'";

			if ($flag['eselon2'] == '') {
				# code...
				$sql_2 = "";
			}
			else $sql_2 = "AND a.es2 = '".$flag['eselon2']."'";

			if ($flag['eselon3'] == '') {
				# code...
				$sql_3 = "";
			}
			else $sql_3 = "AND a.es3 = '".$flag['eselon3']."'";

			if ($flag['eselon4'] == '') {
				# code...
				$sql_4 = "";
			}
			else $sql_4 = "AND a.es4 = '".$flag['eselon4']."'";
		}

		$sql = "SELECT
					a.id as id_pegawai,
					a.nip,
					a.nama_pegawai,
					b.nama_posisi,
					COALESCE(es1.nama_eselon1,'-') as nama_eselon1,
					COALESCE(es2.nama_eselon2,'-') as nama_eselon2,
					COALESCE(es3.nama_eselon3,'-') as nama_eselon3,
					COALESCE(es4.nama_eselon4,'-') as nama_eselon4,
					".$select_opt."
					b.atasan,
					COALESCE (
							(
								SELECT
									tmt.StartDate
								FROM
									mr_masa_kerja tmt
								WHERE tmt.EndDate <> '9999-01-01'
								AND tmt.id_pegawai = a.id
								ORDER BY tmt.EndDate ASC
								LIMIT 1
							),
							'-'
						) AS tmt
				FROM mr_pegawai a
				JOIN mr_posisi b ON b.id = a.posisi
				JOIN mr_posisi_class c ON b.posisi_class = c.id
				JOIN mr_eselon1 es1 ON es1.id_es1 = a.es1
				LEFT JOIN mr_eselon2 es2 on es2.id_es2 = a.es2
				LEFT JOIN mr_eselon3 es3 on es3.id_es3 = a.es3
				LEFT JOIN mr_eselon4 es4 on es4.id_es4 = a.es4
				-- LEFT JOIN mr_pegawai_photo aa ON aa.id_pegawai = a.id
				WHERE a. STATUS = '1'
				-- AND aa.main_pic = 1
				".$sql_1."
				".$sql_2."
				".$sql_3."
				".$sql_4."
				ORDER BY ".$order_by."";
		$query = $this->db->query($sql);
		// print_r($sql);die();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
	}

	public function grade($id){
		$this->db->where('kat_posisi',$id);
		$this->db->select(" a.posisi_class, a.tunjangan, b.* ");
		$this->db->from('mr_posisi_class a');
		$this->db->join('mr_grade_range b','a.posisi_class=b.posisi_grade');
		$this->db->order_by('posisi_class ASC');
		return $this->db->get();
	}

	public function cariGrade($flag){
		$this->db->where($flag);
		$this->db->select(" a.*, b.flag, b.kat_posisi");
		$this->db->from('mr_posisi_class a');
		$this->db->join('mr_grade_range b','a.posisi_class=b.posisi_grade');
		$this->db->order_by('posisi_class ASC');
		return $this->db->get();
	}

	public function getEs3($flag){
		$this->db->where($flag);
		$this->db->select("es1.*, es2.id_es2, es2.nama_eselon2, es3.id_es3 ,es3.nama_eselon3");
		$this->db->from("mr_eselon1 es1");
		$this->db->join("mr_eselon2 es2","es2.id_es1=es1.id_es1");
		$this->db->join("mr_eselon3 es3","es3.id_es2=es2.id_es2");
		return $this->db->get();
	}

	public function getEs4($flag){
		$this->db->where($flag);
		$this->db->select("es1.*, es2.id_es2, es2.nama_eselon2, es3.id_es3, es3.nama_eselon3, es4.id_es4, es4.nama_eselon4");
		$this->db->from("mr_eselon1 es1");
		$this->db->join("mr_eselon2 es2","es2.id_es1=es1.id_es1");
		$this->db->join("mr_eselon3 es3","es3.id_es2=es2.id_es2");
		$this->db->join("mr_eselon4 es4","es4.id_es3=es3.id_es3");
		return $this->db->get();
	}

	public function bulan(){
		$this->db->order_by("id ASC");
		return $this->db->get('mr_bulan');
	}

	public function search_data_pegawai(
											$data_nip,
											$data_nama,
											$data_jabatan,
											$data_role
										)
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_posisi,
						c.nama_role,
						d.nama_agama,
						es1.nama_eselon1,
						es2.nama_eselon2,
						es3.nama_eselon3,
						es4.nama_eselon4,
						es1.id_es1,
						es2.id_es2,
						es3.id_es3,
						es4.id_es4
		FROM mr_pegawai a
		JOIN mr_posisi b
		ON b.id       = a.posisi
		JOIN user_role c
		ON a.id_role  = c.id_role
		JOIN mr_agama d
		ON a.agama    = d.id
		JOIN mr_eselon4 es4
		ON es4.id_es4 = a.es4
		JOIN mr_eselon3 es3
		ON es3.id_es3 = es4.id_es3
		JOIN mr_eselon2 es2
		ON es2.id_es2 = es3.id_es2
		JOIN mr_eselon1 es1
		ON es1.id_es1 = es2.id_es1
        WHERE a.nip LIKE '%".$data_nip."%'
        AND a.nama_pegawai LIKE '%".$data_nama."%'
        AND b.nama_posisi LIKE '%".$data_jabatan."%'
        AND c.nama_role LIKE '%".$data_role."%'";
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

	// public function refresh_data($num,$offset)
	// {
	// 	# code...
	// 	$sql = "SELECT a.*,
	// 					b.nama_posisi,
	// 					c.nama_role,
	// 					d.nama_agama,
	// 					es1.nama_eselon1,
	// 					es2.nama_eselon2,
	// 					es3.nama_eselon3,
	// 					es4.nama_eselon4,
	// 					es1.id_es1,
	// 					es2.id_es2,
	// 					es3.id_es3,
	// 					es4.id_es4
	// 	FROM mr_pegawai a
	// 	JOIN mr_posisi b
	// 	ON b.id       = a.posisi
	// 	JOIN user_role c
	// 	ON a.id_role  = c.id_role
	// 	JOIN mr_agama d
	// 	ON a.agama    = d.id
	// 	JOIN mr_eselon4 es4
	// 	ON es4.id_es4 = a.es4
	// 	JOIN mr_eselon3 es3
	// 	ON es3.id_es3 = es4.id_es3
	// 	JOIN mr_eselon2 es2
	// 	ON es2.id_es2 = es3.id_es2
	// 	JOIN mr_eselon1 es1
	// 	ON es1.id_es1 = es2.id_es1
	// 	ORDER BY a.id ASC
	// 	LIMIT 10";
	// 	$query = $this->db->query($sql);
	// 	if($query->num_rows() > 0)
	// 	{
	// 		return $query->result();
	// 	}
	// 	else
	// 	{
	// 		return 0;
	// 	}
	// }

	public function cari_atasan_STRUKTURAL($param)
	{
		# code...
		$sql_1 = "";
		$sql_2 = "";
		$sql_3 = "";
		$sql_4 = "";

		if ($param['eselon1'] == '') {
			# code...
			$sql_1 = "";
		}
		else $sql_1 = "AND a.eselon1 = '".$param['eselon1']."'";

		if ($param['eselon2'] == '') {
			# code...
			$sql_2 = "";
		}
		else $sql_2 = "AND a.eselon2 = '".$param['eselon2']."'";

		if ($param['eselon3'] == '') {
			# code...
			$sql_3 = "";
		}
		else $sql_3 = "AND a.eselon3 = '".$param['eselon3']."'";

		if ($param['eselon4'] == '') {
			# code...
			$sql_4 = "";
		}
		else $sql_4 = "AND a.eselon4 = '".$param['eselon4']."'";

		$sql = "SELECT a.nama_posisi,
						a.id
				FROM mr_posisi a
				WHERE a.kat_posisi = ".$param['kat_posisi']."
				".$sql_1."
				".$sql_2."
				".$sql_3."
				".$sql_4."
				";
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

	public function cari_atasan_FUNGSIONAL($param)
	{
		# code...
		$sql_1 = "";
		$sql_2 = "";
		$sql_3 = "";
		$sql_4 = "";

		if ($param['eselon4'] == '') {
			# code...
			$sql_4 = "";
		}
		else $sql_4 = "AND a.eselon4 = '".$param['eselon4']."'";

		$sql = "SELECT a.nama_posisi,
					   a.id
				FROM mr_posisi a
				WHERE a.kat_posisi = 1
				".$sql_4."
				";
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

	public function cari_atasan_FUNGSIONAL_TERTENTU($param)
	{
		# code...
		$sql_1 = "";
		$sql_2 = "";
		$sql_3 = "";
		$sql_4 = "";

		if ($param['eselon2'] == '') {
			# code...
			$sql_2 = "";
		}
		else $sql_4 = "AND a.eselon2 = '".$param['eselon2']."'";

		$sql = "SELECT a.nama_posisi,
						a.id
				FROM mr_posisi a
				WHERE a.kat_posisi = 1
				".$sql_2."
				";
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


	public function get_posisi_struktur($id)
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_eselon2,
						c.nama_eselon3,
						d.nama_eselon4,
						e.nama_posisi as `posisi_atasan`,
						f.tunjangan
				FROM mr_posisi a
				JOIN mr_eselon2 b
				ON b.id_es2       = a.eselon2
				JOIN mr_eselon3 c
				ON c.id_es3       = a.eselon3
				JOIN mr_eselon4 d
				ON d.id_es4       = a.eselon4
				JOIN mr_posisi e
				ON e.id       = a.atasan
				JOIN mr_posisi_class f
				ON f.posisi_class       = a.posisi_class
				WHERE a.id = '".$id."'
				";
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

	public function get_posisi_class()
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_posisi_class a
				ORDER BY a.posisi_class DESC
				";
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


	public function get_struktur_organisasi($param)
	{
		# code...

		$sql_1 = "";
		$sql_2 = "";
		$sql_3 = "";
		$sql_4 = "";

		if ($param['eselon1'] == '') {
			# code...
			$sql_1 = "";
		}
		else $sql_1 = "AND a.eselon1 = '".$param['eselon1']."'";

		if ($param['eselon2'] == '') {
			# code...
			$sql_2 = "";
		}
		else $sql_2 = "AND a.eselon2 = '".$param['eselon2']."'";

		if ($param['eselon3'] == '') {
			# code...
			$sql_3 = "";
		}
		else $sql_3 = "AND a.eselon3 = '".$param['eselon3']."'";

		if ($param['eselon4'] == '') {
			# code...
			$sql_4 = "";
		}
		else $sql_4 = "AND a.eselon4 = '".$param['eselon4']."'";

		$sql = "SELECT a.*,
						b.nama_kat_posisi,
						es1.nama_eselon1,
						es2.nama_eselon2,
						es3.nama_eselon3,
						es4.nama_eselon4,
						COALESCE((
							SELECT COUNT(aa.id) as counter_x
							FROM mr_pegawai aa
							WHERE aa.posisi = a.id
						),'0') as counter_pegawai   						
				FROM mr_posisi a
				JOIN mr_kat_posisi b
				ON b.id = a.kat_posisi
				LEFT JOIN mr_eselon1 es1
				ON a.eselon1 = es1.id_es1
				LEFT JOIN mr_eselon2 es2
				ON a.eselon2 = es2.id_es2
				LEFT JOIN mr_eselon3 es3
				ON a.eselon3 = es3.id_es3
				LEFT JOIN mr_eselon4 es4
				ON a.eselon4 = es4.id_es4
				WHERE a.eselon1 = '".$param['eselon1']."'
				".$sql_2."
				".$sql_3."
				".$sql_4."
				";
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

	public function save_pegawai($data,$id=NULL,$flag)
	{
		if ($flag == 'add') {
			# code...
			$res = $this->db->insert('mr_pegawai', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		elseif ($flag == 'edit') {
			# code...
			$this->db->where('id', $id);
			$result = $this->db->update('mr_pegawai',$data);
			return $result;
		}
	}

	public function get_data_pegawai($id)
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_posisi,
						COALESCE(es1.nama_eselon1,'-') as nama_eselon1,
						COALESCE(es2.nama_eselon2,'-') as nama_eselon2,
						COALESCE(es3.nama_eselon3,'-') as nama_eselon3,
						COALESCE(es4.nama_eselon4,'-') as nama_eselon4,
						COALESCE((SELECT aa.photo
									FROM mr_pegawai_photo aa
									WHERE aa.id_pegawai = a.id
									AND aa.main_pic = 1
									AND aa.local = a.local
								),'-') as photo,
						a.local,
						a.es1,
						a.es2,
						a.es3,
						a.es4,
						a.id,
						b.atasan,
						b.id AS `id_posisi`,
						b.kat_posisi,
						c.posisi_class
				FROM mr_pegawai a
				JOIN mr_posisi b ON b.id = a.posisi
				JOIN mr_posisi_class c ON b.posisi_class = c.id
				JOIN mr_eselon1 es1 ON es1.id_es1 = a.es1
				LEFT OUTER JOIN mr_eselon2 es2 on es2.id_es2 = a.es2
				LEFT OUTER JOIN mr_eselon3 es3 on es3.id_es3 = a.es3
				LEFT OUTER JOIN mr_eselon4 es4 on es4.id_es4 = a.es4
				WHERE a.id = '".$id."'";
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

	public function get_data_pegawai_nip($id)
	{
		# code...
		$sql = "SELECT  a.*,
						a.nama_pegawai,
						b.nama_posisi,
						b.atasan,
						b.id as `id_posisi`,
						b.kat_posisi,
						c.posisi_class,
						es1.nama_eselon1,
						es2.nama_eselon2,
						es3.nama_eselon3,
						es4.nama_eselon4
			FROM mr_pegawai a
			JOIN mr_posisi b ON b.id = a.posisi
			JOIN mr_posisi_class c ON b.posisi_class = c.id
			JOIN mr_eselon1 es1 ON es1.id_es1 = a.es1
			JOIN mr_eselon2 es2 ON es2.id_es2 = a.es2
			JOIN mr_eselon3 es3 ON es3.id_es3 = a.es3
			JOIN mr_eselon4 es4 ON es4.id_es4 = a.es4
			WHERE a.nip = '".$id."'";
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


	public function get_masa_kerja_id_pegawai($id,$SORT)
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_posisi,
						c.nama as `status_masakerja`
			FROM mr_masa_kerja a
			LEFT JOIN mr_posisi b ON a.id_posisi = b.id
			LEFT JOIN mr_masa_kerja_status c ON a.status_masa_kerja = c.id
			WHERE a.id_pegawai = '".$id."'
			ORDER BY a.StartDate ".$SORT."";
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

	public function get_masa_kerja($id_pegawai,$id)
	{
		# code...
		$sql = "SELECT a.*
			FROM mr_masa_kerja a
			WHERE a.id_pegawai = '".$id_pegawai."'
			AND a.id_posisi = '".$id."'";
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

	public function get_masa_kerja_id($id)
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_posisi
            FROM mr_masa_kerja a
            LEFT JOIN mr_posisi b ON a.id_posisi = b.id
			WHERE a.id = '".$id."'";
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

	public function get_data_tugas_belajar()
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_pegawai,
						b.nip
				FROM mr_tugas_belajar a
				JOIN mr_pegawai b
				ON a.id_pegawai = b.id
				ORDER BY a.id DESC";
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

	public function get_tugas_belajar_id($id)
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_pegawai,
						b.nip
				FROM mr_tugas_belajar a
				JOIN mr_pegawai b
				ON a.id_pegawai = b.id
				WHERE a.id = '".$id."'";
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

	public function get_data_tunjangan_profesi()
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_pegawai,
						b.nip
				FROM mr_tunjangan_profesi a
				JOIN mr_pegawai b
				ON a.id_pegawai = b.id
				ORDER BY b.nama_pegawai ASC,
							a.tgl_selesai ASC";
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

	public function get_data_tunjangan_profesi_id($id)
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_pegawai,
						b.nip
				FROM mr_tunjangan_profesi a
				JOIN mr_pegawai b
				ON a.id_pegawai = b.id
				WHERE a.id = '".$id."'";
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

	public function get_last_pic($id)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_pegawai_photo a
				WHERE a.id_pegawai = '".$id."'";
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

	public function get_tunjangan_profesi_pegawai($id,$SORT)
	{
		# code...
		$sql = "SELECT a.*
			FROM mr_tunjangan_profesi a
			WHERE a.id_pegawai = '".$id."'
			ORDER BY a.tgl_mulai ".$SORT."";
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

	public function get_data_jfu($id=NULL)
	{
		# code...
		$sql_WHERE = "";
		if ($id != NULL) {
			# code...
			$sql_WHERE = "WHERE a.id = '".$id."'";
		}
		$sql = "SELECT a.*,
						b.posisi_class,
						b.tunjangan,
						COALESCE(
							(
								SELECT COUNT(aa.id)
								FROM mr_posisi aa
								WHERE aa.id_jfu = a.id
							),'0'
						) as counter_jfu
				FROM mr_jabatan_fungsional_umum a
				JOIN mr_posisi_class b
				on a.id_kelas_jabatan = b.id
				".$sql_WHERE."";
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

	public function get_data_jfu_detail($id=NULL)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_jabatan_fungsional_umum_uraian_tugas a
				WHERE a.id_jfu = '".$id."'";
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

	public function get_data_jft($id=NULL)
	{
		# code...
		$sql_WHERE = "";
		if ($id != NULL) {
			# code...
			$sql_WHERE = "WHERE a.id = '".$id."'";
		}
		$sql = "SELECT a.*,
						b.posisi_class,
						b.tunjangan,
						COALESCE(
							(
								SELECT COUNT(aa.id)
								FROM mr_posisi aa
								WHERE aa.id_jft = a.id
							),'0'
						) as counter_jft
				FROM mr_jabatan_fungsional_tertentu a
				JOIN mr_posisi_class b
				on a.id_kelas_jabatan = b.id
				".$sql_WHERE."";
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

	public function get_data_jft_detail($id=NULL)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_jabatan_fungsional_tertentu_uraian_tugas a
				WHERE a.id_jft = '".$id."'";
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
