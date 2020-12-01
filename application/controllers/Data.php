<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Data_Model','datax');
		$this->load->model('Dashboard_Model','dashboard');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('encryption');
		
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$data['title'] = 'Data';
		$data['menu'] = 'Data';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$data['dataProvinsi'] 	= $this->datax->get_provinsi();
		$data['dataKateg'] 		= $this->datax->get_kategori();
		$data['dataBdgUsaha'] 	= $this->datax->get_bidangusaha();
		$data['dermaga']		= $this->datax->get_dermaga();
		$data['notification']	= $this->datax->notification();
		$trigger ='';
		$trigger 		= $this->input->post('trigger');
		$namaPerusahaan = $this->input->post('name');
		$provinsi 		= $this->input->post('provinsi');
		$kota 			= $this->input->post('kota');
		$kelas 			= $this->input->post('kelas');
		$kategori 		= $this->input->post('kategori');
		$bidangusaha 	= $this->input->post('bidangusaha');
		$dermaga 		= $this->input->post('dermaga');
		$meter 			= $this->input->post('meter');
		$kapasitas 		= $this->input->post('kapasitas');
		$tukter 		= $this->input->post('tuk_ter');
		$status 		= $this->input->post('status');
		$tglakhir 		= $this->input->post('tgl_akhir');
		$expired 		= ($this->input->post('expired')) ? TRUE : FALSE;
		
		$r = $this->dashboard->status_aktif()->result();
		$tersus = array(
			array(
				"name" => "AKTIF",
				"y"    => (int) $r[0]->TERSUS_AKTIF
			),
			array(
				"name" => "NON AKTIF",
				"y"	   => (int) $r[0]->TERSUS_NONAKTIF
			)
		);

		$tuks = array(
			array(
				"name" => "AKTIF",
				"y"    => (int) $r[0]->TUKS_AKTIF
			),
			array(
				"name" => "NON AKTIF",
				"y"	   => (int) $r[0]->TUKS_NONAKTIF
			)
		);


		if($trigger){
			/* set session data for exporting */
			$this->session->set_userdata("nm_perusahaan",$namaPerusahaan);
			$this->session->set_userdata("provinsi",$provinsi);
			$this->session->set_userdata("kota",$kota);
			$this->session->set_userdata("kelas",$kelas);
			$this->session->set_userdata("kategori",$kategori);
			$this->session->set_userdata("bidangusaha",$bidangusaha);
			$this->session->set_userdata("meter",$meter);
			$this->session->set_userdata("kapasitas",$kapasitas);
			$this->session->set_userdata("tukter",$tukter);
			$this->session->set_userdata("status",$status);
			$this->session->set_userdata("tglakhir",$tglakhir);

	

			$this->db->select('a.*,b.name as nmprov,c.nama as nmksop,d.nama as nmusaha,e.nama as nmkateg');
	        $this->db->from('daftar_perusahaan as a');
	        $this->db->join('provinsi as b','a.provinsi_id=b.id','left');
	        $this->db->join('ksop as c','a.ksop_id=c.ksop_id','left');
	        $this->db->join('bdg_usaha as d','a.bdgusaha_id=d.bdg_usaha_id');
	        $this->db->join('kategori as e','a.kategori_id=e.kategori_id','left');
			if($namaPerusahaan != ''){
				$this->db->like('a.nm_perusahaan', $namaPerusahaan);
			}
			
			if(count($provinsi) > 0)
            {
                $query ="(";
                foreach($provinsi as $k)
                {
                    $query = $query."a.provinsi_id=".$k. " OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
                $this->db->where($query);
			}
			
			if($kota != '')
			{
				$this->db->like('a.lokasi', $kota);		
			}
			if($kelas != '')
			{
				$this->db->where('a.ksop_id', $kelas);	
			}
			if(count($kategori) > 0)
            {
                $query ="(";
                foreach($kategori as $k)
                {
                    $query = $query."a.kategori_id=".$k. " OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
                $this->db->where($query);
            }
			// for($i = 0; $i < count($kategori); $i++){
			// 	$this->db->or_like('a.kategori_id', $kategori[$i]);
			// }
			if(count($bidangusaha) > 0)
            {
                $query ="(";
                foreach($bidangusaha as $b)
                {
                    $query = $query."a.bdgusaha_id=".$b. " OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
                $this->db->where($query);
            }
			// for($j = 0; $j < count($bidangusaha); $j++){
			// 	$this->db->or_like('a.bdgusaha_id', $bidangusaha[$j]);
			// }
			if($dermaga != ''){
				$query ="(";
                foreach($dermaga as $k)
                {
                    $query = $query."a.spesifikasi LIKE '%".$k. "%' OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
                $this->db->where($query);
			}
			if($meter != ''){
				$this->db->like('a.spesifikasi', $meter);
			}
			if($kapasitas != ''){
				$this->db->like('a.spesifikasi', $kapasitas);
			}
			if($tukter != ''){
				$this->db->where('a.ter_tuk', $tukter);
			}
			if($status != ''){
				$this->db->where('a.status', $status);
			}
			if($tglakhir != ''){
				$tgl =explode("-", $tglakhir);
				$t = $tgl[1].'-'.$tgl[0];
				$this->db->where('ms_berlaku BETWEEN "'.$tgl[1].'-'.$tgl[0].'-01 00:00:00" AND "'.$tgl[1].'-'.$tgl[0].'-30 00:00:00"');
			}

			if($expired)
			{
				$this->db->where("ms_berlaku < '".date("Y-m-d H:i:s")."'");
			}

			$this->db->where('a.flag',1);
			$this->db->order_by('a.provinsi_id','asc');
			$this->db->order_by('a.nm_perusahaan','asc');
			$return 		= $this->db->get()->result();
			$data['jumlah'] = count($return);
			$data['company'] = $return;

			$data['tersus']	 = json_encode($tersus);
			$data['tuks']	 = json_encode($tuks);
			$this->load->view('templates/header',$data);
			$this->load->view('main/data',$data);
		} else {
			$this->db->order_by('a.provinsi_id','asc');
			$this->db->order_by('a.nm_perusahaan','asc');
			$this->db->select('a.*,b.name as nmprov,c.nama as nmksop,d.nama as nmusaha,e.nama as nmkateg');
	        $this->db->from('daftar_perusahaan as a');
	        $this->db->join('provinsi as b','a.provinsi_id=b.id','left');
	        $this->db->join('ksop as c','a.ksop_id=c.ksop_id','left');
	        $this->db->join('bdg_usaha as d','a.bdgusaha_id=d.bdg_usaha_id');
			$this->db->join('kategori as e','a.kategori_id=e.kategori_id','left');
			
			$this->db->where('a.flag',1);
			
			$return 		= $this->db->get()->result();
			$data['jumlah'] = count($return);
			$data['company'] = $return;
			$data['tuks']	 = json_encode($tuks);
			$data['tersus']	 = json_encode($tersus);
			$this->load->view('templates/header',$data);
			$this->load->view('main/data',$data);
		}
	
	}

	public function load_view($id)
	{
		$data['id'] = (int) $id;
		$data['dataProvinsi'] = $this->datax->get_provinsi();
		$data['dataBdgUsaha'] = $this->datax->get_bidangusaha();

		$this->load->view('main/load_view',$data);
		
	}

	
	public function get_Kota()
	{
		$html='';
		$provinsi = $this->input->post('provinsi');
		$dataprov = $this->datax->get_Kota($provinsi);
		
		$html .='<option value="" selected readonly>Pilih Kabupaten / Kota</option>';
		if(count($dataprov) > 0)
		{
        	foreach ($dataprov as $list) {

        	 $html .= '<option value="'.trim($list->nama).'">'.trim($list->nama).'</option>';
			}
		}
	    echo json_encode($html); 
	}

	public function get_Kota2()
	{
		$html='';
        $provinsi = $this->input->post('provinsi');
        $dataprov = $this->datax->get_Kota2($provinsi);
        $html .='<option value="">Pilih Kabupaten / Kota</option>';
        foreach ($dataprov as $list) {
             $html .= '<option value="'.trim($list->kode).'|'.trim($list->nama).'">'.trim($list->nama).'</option>';
        	}
	        echo json_encode($html); 
	}  

	public function get_Kelas()
	{
		$html='';
        $kelas = $this->input->post('kota');

        $datakelas = $this->datax->get_Kelas($kelas);
        $html .='<option value="">Pilih Wilayah Kerja</option>';
        foreach ($datakelas as $list) {
             $html .= '<option value="'.trim($list->ksop_id).'">'.trim($list->nama).'</option>';
        	}
	        echo json_encode($html); 
	} 

	public function get_Kelas2()
	{
		$html='';
        $kelas = $this->input->post('kota');

        $datakelas = $this->datax->get_Kelas2($kelas);
        $html .='<option value="">Pilih Wilayah Kerja</option>';
        foreach ($datakelas as $list) {
             $html .= '<option value="'.trim($list->ksop_id).'">'.trim($list->nama).'</option>';
        	}
	        echo json_encode($html); 
	} 

	public function get_Kecamatan()
	{
		$html='';
        $kecamatan = $this->input->post('kota');

        $datakelas = $this->datax->get_Kecamatan($kecamatan);
        $html .='<option value="">Pilih Kecamatan</option>';
        foreach ($datakelas as $list) {
             $html .= '<option value="'.trim($list->kode).'|'.trim($list->nama).'">'.trim($list->nama).'</option>';
        	}
	        echo json_encode($html); 
	} 

	public function get_Kecamatan2()
	{
		$html='';
        $kecamatan = $this->input->post('provinsi');

        $datakecamatan = $this->datax->get_Kecamatan2($kecamatan);
        $html .='<option value="">Pilih Kecamatan</option>';
        foreach ($datakecamatan as $list) {
             $html .= '<option value="'.trim($list->kode).'|'.trim($list->nama).'">'.trim($list->nama).'</option>';
        	}
	        echo json_encode($html); 
	} 

	public function get_Kelurahan()
	{
		$html='';
        $kelurahan = $this->input->post('kecamatan');

        $datakelurahan = $this->datax->get_Kelurahan($kelurahan);
        $html .='<option value="">Pilih Kelurahan</option>';
        foreach ($datakelurahan as $list) {
         $html .= '<option value="'.trim($list->kode).'|'.trim($list->nama).'">'.trim($list->nama).'</option>';
        }
	    echo json_encode($html); 
	} 

	public function create()
	{
		$data['title'] = 'Create Data';
		$data['menu'] = 'Create Data';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$data['dataProvinsi'] = $this->datax->get_provinsi();
		$data['dataBdgUsaha'] = $this->datax->get_bidangusaha();
		$data['jenis_sk']     = $this->datax->jenis_sk();
		$data['notification']	= $this->datax->notification();

		$this->load->view('templates/header',$data);
		$this->load->view('main/data_create',$data);
	}

	public function edit($id)
	{
		$f = $this->datax->_getspesifikasi($id);
		foreach($f as $key => $value)
		{
			$split = preg_split("/(. DERMAGA|.DERMAGA|\s\|\s)/",$value->spesifikasi);
			$tipe = array();
			$spesifikasi = array();
			$peruntukan = array();
			$kapasitas = array();
			$kedalaman = array();
			$satuan  	= array();
			$results = array();
			
			if(count($split) > 1)
			{
				foreach($split as $key => $value)
				{
				
					$a 			= preg_match("/TIPE:([a-zA-Z\s]+)/",$value,$tipe);
					$b 			= preg_match("/TIPE:[a-zA-Z\s]+,(.*), KEDALAMAN:/",$value,$spesifikasi);
					$c 			= preg_match("/PERUNTUKAN:([a-zA-Z\s]+)/",$value,$peruntukan);
					$d 			= preg_match("/KEDALAMAN:(.*)(\sM LWS|M LWS),/",$value,$kedalaman);
					$e 			= preg_match("/MAKSIMUM\s+([0-9*]+.+[0-9*])+/",$value,$kapasitas);
					$f 			= preg_match("/MAKSIMUM\s+[0-9.\s*]+([a-zA-Z+]{3,4})/",$value,$satuan);
					
					$result = array(
						"tipe" 			=> (count($tipe) > 1) ? trim($tipe[1]) : "",
						"spesifikasi" 	=> (count($spesifikasi) > 1) ? trim($spesifikasi[1]) : "",
						"peruntukan" 	=> (count($peruntukan) > 1) ? trim($peruntukan[1]) : "",
						"kedalaman" 	=> (count($kedalaman) > 1) ? trim($kedalaman[1]) : "",
						"kapasitas" 	=> (count($kapasitas) > 1) ? str_replace(",",".",trim($kapasitas[1])) : "",
						"satuan" 	=> (count($satuan) > 1) ? trim($satuan[1]) : "",
					);
					$results[] = $result;


				}
			}
			else
			{
				$a 			= preg_match("/TIPE:([a-zA-Z\s()*]+),/",$split[0],$tipe);
				$b 			= preg_match("/TIPE:[a-zA-Z\s0-9()]+,(.*), KEDALAMAN:/",$split[0],$spesifikasi);
				$c 			= preg_match("/PERUNTUKAN:([a-zA-Z\s]+)/",$split[0],$peruntukan);
				$d 			= preg_match("/KEDALAMAN:(.*)\sM LWS/",$split[0],$kedalaman);
				$e 			= preg_match("/MAKSIMUM\s+([0-9*]+)/",$split[0],$kapasitas);
				$f 			= preg_match("/MAKSIMUM\s+[0-9.\s*]+([a-zA-Z+]{3,4})/",$split[0],$satuan);

			
				$result = array(
					"tipe" 			=> (count($tipe) > 1) ? trim($tipe[1]) : "",
					"spesifikasi" 	=> (count($spesifikasi) > 1) ? trim($spesifikasi[1]) : "",
					"peruntukan" 	=> (count($peruntukan) > 1) ? trim($peruntukan[1]) : "",
					"kedalaman" 	=> (count($kedalaman) > 1) ? trim($kedalaman[1]) : "",
					"kapasitas" 	=> (count($kapasitas) > 1) ? str_replace(",",".",trim($kapasitas[1])) : "",
					"satuan" 	=> (count($satuan) > 1) ? trim($satuan[1]) : "",
				);
				$results[] = $result;
			}
			
		}
		/* Split the koordinat value */
		$selected 			  			= $this->datax->_getSingleData($id);
		$selected['data']->koordinat	= str_replace("-","",$selected['data']->koordinat);
		$split 							= preg_split("/[°º⁰˚'\"”\/]+/",str_replace(",",".",$selected['data']->koordinat));
		$selected['data']->koordinat	= $split;
		$data['title'] 					= 'Edit Data';
		$data['menu'] 					= 'Edit Data';
		$data['baseurl'] 				= base_url();
		$data['siteurl'] 	  			= site_url();
		$data['data']		  			= $selected;
		$data['dermaga']				= $results;	
		$data['dataProvinsi'] 			= $this->datax->get_provinsi();
		$data['dataBdgUsaha'] 			= $this->datax->get_bidangusaha();
		$data['notification']			= $this->datax->notification();

		$this->load->view('templates/header',$data);
		$this->load->view('main/data_edit',$data);
	}

	public function submit($action)
	{
		$post = $this->input->post();
		if($action == "create")
		{
			$this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Nama Perusahaan', 'required',
                    array('required' => 'Pastikan %s telah terisi.')
            );
            $this->form_validation->set_rules('email', 'Email', 'required',
					array('required' => 'Pastikan %s telah terisi.')
			);

			$this->form_validation->set_rules('nosk', 'Nomor SK', 'check_nosk_callback',
					array('required' => 'Pastikan %s telah terisi dan belum terdaftar.')
			);

			$this->form_validation->set_rules('d_lat', 'Degree Latitude', 'check_dlat_callback');
			$this->form_validation->set_rules('m_lat', 'Minutes Latitude', 'check_mlat_callback');
			$this->form_validation->set_rules('s_lat', 'Second Latitude', 'check_mlat_callback');
			$this->form_validation->set_rules('d_long', 'Degree Latitude', 'check_dlat_callback');
			$this->form_validation->set_rules('m_long', 'Degree Latitude', 'check_mlat_callback');
			$this->form_validation->set_rules('s_long', 'Degree Latitude', 'check_slat_callback');
			$this->form_validation->set_rules('kelas', 'Wilayah Kerja', 'check_provf_callback');
			$this->form_validation->set_rules('provinsi_f', 'Provinsi Lokasi', 'check_provf_callback');
			
            if ($this->form_validation->run() == FALSE)
            {
				$alert = array('teks'=> '<div class="alert-danger text-center" role="alert"><b>'. validation_errors().'</b></div>');
				$this->session->set_flashdata($alert);
				redirect(base_url()."Data/create");
            }
            else
            {
                $data = $this->datax->create($this->input->post());
			
				$alert = array('teks'=>'<div class="alert-danger text-center" role="alert"><b> CREATE DATA GAGAL!</b></div>');
				if($data)
				{
					$alert = array('teks'=>'<div style="padding:10%" class="alert-success text-center" role="alert"><b> CREATE DATA BERHASIL !</b></div>');
				}
				$this->session->set_flashdata($alert);
				redirect(base_url()."Data/create");
				
			}

			
		}

		if($action == "edit")
		{
			$data 	= $this->datax->edit($post);
			$alert 	= array('teks'=>'<div class="alert-danger text-center" role="alert"><b> EDIT DATA GAGAL!</b></div>');
			if($data)
			{
				$alert = array('teks'=>'<div class="alert-success text-center" role="alert"><b> EDIT DATA BERHASIL !</b></div>');
			}
			$this->session->set_flashdata($alert);
			redirect(base_url()."Data/edit/".$post['_id']);
		}

		if($action == "delete")
		{
			$data = $this->datax->delete($post);
			$alert 	= array('teks'=>'<div class="alert-danger text-center" role="alert"><b> DELETE DATA GAGAL!</b></div>');
			if($data)
			{
				$alert = array('teks'=>'<div class="alert-success text-center" role="alert"><b> DELETE DATA BERHASIL !</b></div>');
			}
			$this->session->set_flashdata($alert);
			echo json_encode(array("status" => 200,"data" => "Successfully"));
		}

	}

	public function check_nosk($arr)
	{
		foreach($arr as $key => $value)
		{
			
			if($value == "" || empty($value))
			{
				$this->form_validation->set_message('check_nosk', 'Kolom {field} harus terisi.');
				return FALSE;
			}
			
			$data = $this->datax->check_sk($value);
			if($data > 0)
			{
				$this->form_validation->set_message('check_nosk', '{field} telah terdaftar.');
				return FALSE;
			}
				
		}

		return TRUE;
	}

	public function check_dlat($arr)
	{
		foreach($arr as $key => $value)
		{
			if(!isset($value) || $value == "" || $value > 11)
			{
				$this->form_validation->set_message('check_nosk', '{field} harus diisi dan diantara 0-11.');
				return FALSE;
			}
		}
		return TRUE;
	}

	public function check_mlat($arr)
	{
		foreach($arr as $key => $value)
		{
			if(!isset($value) || $value == "" || $value > 60)
			{
				$this->form_validation->set_message('check_nosk', '{field} harus diisi dan diantara 1-60.');
				return FALSE;
			}
		} 
		return TRUE;
	}

	public function check_provf($arr)
	{
		foreach($arr as $key => $value)
		{
			if($value == "" || empty($value))
			{
				$this->form_validation->set_message('check_provf', '{field} harus terisi.');
				return FALSE;
			}
		}

		return TRUE;
	}
	
}
?>
