<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ro_peg extends CI_Controller {
  public function __construct() {
  parent::__construct();
}
public function index(){
            	
          

$curl = curl_init();

$this->Globalrules->session_rule();	
$nip = $this->session->userdata('sesNip');
$hari = date('Y-m-d');

$month = substr($hari,6,1);
$year = substr($hari,0,4);
curl_setopt_array($curl, array(
  CURLOPT_PORT => "8090",
  CURLOPT_URL => "http://192.168.193.172:8090/esidik/api/presensi/getpotongan",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 360,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "token=80f0d4e2dcda977afbfbed11de34b6b4&nip=$nip&month=$month&year=$year",
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Content-Type: application/x-www-form-urlencoded",
    "Host: 192.168.193.172:8090",
    "Postman-Token: 56e5503f-b702-4aa2-8456-328c677911ed,79ca6720-2e5a-4e1d-80e7-7d9156717897",
    "User-Agent: PostmanRuntime/7.13.0",
    "accept-encoding: gzip, deflate",
    "cache-control: no-cache",
    "content-length: 79",
    "cookie: abs3nDagr1=1u4nv51j49i0r3a8dp8a8vldvmq5iknp"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

}



}






//                
//                $text = '[{"id":"1","nip":"198404122014022002",'
//                        . '"nama_pegawai":"PENNY DWI HARNANING, S.Kom",'
//                        . '"nama_satker":"BIRO KEPEGAWAIAN","jabatan":'
//                        . '"PRANATA KOMPUTER PERTAMA BIRO KEPEGAWAIAN PADA SEKRETARIAT JENDERAL"'
//                        . ',"kelas_jabatan":"8","tunjangan":"2297575"}]' ;
                
//                $text____ = '{"status":true,'
//                        . '"results":'
//                        . '{"info_pegawai":'
//                        . '[{"nip":"198312252014021002","nama_pegawai":"RIFKI ARDIANSYAH, A.Md.",'
//                        . '"nama_satker":"SUBBAGIAN PENILAIAN KINERJA PEGAWAI",'
//                        . '"jabatan":"PENGELOLA SISTEM INFORMASI MANAJEMEN KEPEGAWAIAN PADA SUBBAGIAN PENILAIAN KINERJA PEGAWAI BAGIAN PENGEMBANGAN KARIER BIRO KEPEGAWAIAN SEKRETARIAT JENDERAL",'
//                        . '"kelas_jabatan":"6","tunjangan":1755200}],'
//                        
//                        . '"data":'
//                        . '[{"tgl":"2019-06-17","status":"Tidak absen pulang",'
//                        . '"nilai":null,"persentase":1,"jumlah":17552},{"tgl":"2019-06-18",'
//                        . '"status":"Alpa","nilai":null,"persentase":5,"jumlah":87760},'
//                        . '{"tgl":"2019-06-19","status":"Alpa","nilai":null,"persentase":5,"jumlah":87760},'
//                        . '{"tgl":"2019-06-20","status":"Alpa","nilai":null,"persentase":5,"jumlah":87760},'
//                        . '{"tgl":"2019-06-21","status":"Alpa","nilai":null,"persentase":5,"jumlah":87760},'
//                        . '{"tgl":"2019-06-24","status":"Alpa","nilai":null,"persentase":5,"jumlah":87760},'
//                        . '{"tgl":"2019-06-25","status":"Alpa","nilai":null,"persentase":5,"jumlah":87760},'
//                        . '{"tgl":"2019-06-26","status":"Alpa","nilai":null,"persentase":5,"jumlah":87760},'
//                        . '{"tgl":"2019-06-27","status":"Alpa","nilai":null,"persentase":5,"jumlah":87760},'
//                        . '{"tgl":"2019-06-28","status":"Alpa","nilai":null,"persentase":5,"jumlah":87760}]}}';
//                
//                
//                $text2 = '{
//                                "status":true,
//                                "results":{
//                                    "info_pegawai":[
//                                    {
//                                    "nip":"198312252014021002",
//                                    "nama_pegawai":"RIFKI ARDIANSYAH, A.Md.",
//                                    "nama_satker":"SUBBAGIAN PENILAIAN KINERJA PEGAWAI",
//                                    "jabatan":"PENGELOLA SISTEM INFORMASI MANAJEMEN KEPEGAWAIAN PADA SUBBAGIAN PENILAIAN KINERJA PEGAWAI BAGIAN PENGEMBANGAN KARIER BIRO KEPEGAWAIAN SEKRETARIAT JENDERAL",
//                                    "kelas_jabatan":"6",
//                                    "tunjangan":1755200
//                                    }
//                                    ],
//                                    "data":[
//                                    {
//                                    "tgl":"2019-06-17",
//                                    "status":"Tidak absen pulang",
//                                    "nilai":null,
//                                    "persentase":1,
//                                    "jumlah":1000
//                                    },
//                                    {
//                                    "tgl":"2019-06-18",
//                                    "status":"Alpa",
//                                    "nilai":null,
//                                    "persentase":5,
//                                    "jumlah":1000
//                                    },
//                                    {
//                                    "tgl":"2019-06-19",
//                                    "status":"Alpa",
//                                    "nilai":null,
//                                    "persentase":5,
//                                    "jumlah":1000
//                                    },
//                                    {
//                                    "tgl":"2019-06-20",
//                                    "status":"Alpa",
//                                    "nilai":null,
//                                    "persentase":5,
//                                    "jumlah":1000
//                                    },
//                                    {
//                                    "tgl":"2019-06-21",
//                                    "status":"Alpa",
//                                    "nilai":null,
//                                    "persentase":5,
//                                    "jumlah":1000
//                                    },
//                                    {
//                                    "tgl":"2019-06-24",
//                                    "status":"Alpa",
//                                    "nilai":null,
//                                    "persentase":5,
//                                    "jumlah":1000
//                                    },
//                                    {
//                                    "tgl":"2019-06-25",
//                                    "status":"Alpa",
//                                    "nilai":null,
//                                    "persentase":5,
//                                    "jumlah":1000
//                                    },
//                                    {
//                                    "tgl":"2019-06-26",
//                                    "status":"Alpa",
//                                    "nilai":null,
//                                    "persentase":5,
//                                    "jumlah":1000
//                                    },
//                                    {
//                                    "tgl":"2019-06-27",
//                                    "status":"Alpa",
//                                    "nilai":null,
//                                    "persentase":5,
//                                    "jumlah":1000
//                                    },
//                                    {
//                                    "tgl":"2019-06-28",
//                                    "status":"Alpa",
//                                    "nilai":null,
//                                    "persentase":5,
//                                    "jumlah":1000
//                                    }
//                                    ]
//                                    }
//            }
//';
//                echo $text2;
       //     }

//        }
//    
//}