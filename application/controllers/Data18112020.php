<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Data_Model','datax');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('encrypt');
		
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
		$data['dataProvinsi'] = $this->datax->get_provinsi();
		$data['dataKateg'] = $this->datax->get_kategori();
		$data['dataBdgUsaha'] = $this->datax->get_bidangusaha();
		$this->load->view('templates/header',$data);
		// $this->load->view('templates/hmenu',$data);
		$this->load->view('main/data',$data);
		// $this->load->view('templates/footer',$data);
		
		// $isLoggedIn = $this->session->userdata("isLoggedIn");
		// $validUser = $this->session->userdata("validUser");
		// $validPass = $this->session->userdata("validPass");
		// $validLevel = $this->session->userdata("validLevel");
		// $validNama = $this->session->userdata("validNama");
		// $validSession = $this->session->userdata("validSession");
		// $validRole = $this->session->userdata("validRole");

		// if(!$isLoggedIn){
		// 	$data['title'] = 'LOGIN';
		// 	$this->load->view('templates/header',$data);
		// 	$this->load->view('main/index',$data);
		// 	$this->load->view('templates/footer',$data);
		// }else{
		// 	$data['judul'] = 'HOME';
		// 	$data['validUser'] = $validUser;
		// 	$data['validNama'] = $validNama;
		// 	$data['menu']='';
		// 	$data['validUser']=$validUser;
		// 	$data['validSession']=$validSession;
		// 	$data['validLevel']=$validLevel;
		// 	$this->load->view('templates/header',$data);
		// 	$this->load->view('templates/hmenu',$data);
		// 	$this->load->view('main/frmhome',$data);
		// 	$this->load->view('templates/footer',$data);
			
		// }
	}

	public function ajax_list()
    {
        // $isLoggedIn = $this->session->userdata("isLoggedIn");
        // if($isLoggedIn){
            $list = $this->datax->get_datatables();
            $data = array();
            $no = $_POST['start'];
            $i=1;
            foreach ($list as $datax) {
                $no++;
                $row = array();

                $row[] = $no;
                $row[] = "<font style='font-weight: bold;'>".trim($datax->nm_perusahaan)."</font>";
                $row[] = "<font class='td-status2'>".trim($datax->alamat)."</font>";
                $row[] = trim($datax->nmksop);
                $row[] = trim($datax->nmusaha);
                $row[] = trim($datax->nmkateg);
                $row[] = trim($datax->lokasi);
                $row[] = trim($datax->koordinat);
                $row[] = trim($datax->spesifikasi);
                if(trim($datax->ter_tuk) =='TUKS')
                {
                	$row[] = "<font class='td-status' style='color: #A3A0FB;'>".trim($datax->ter_tuk)."</font>";
                }else{
                	$row[] = "<font class='td-status' style='color: #6bd189;'>".trim($datax->ter_tuk)."</font>";
                }
                $row[] = trim($datax->sk);
                $row[] = date('d-m-Y', strtotime(trim($datax->tgl_terbit)));
                if(trim($datax->status) =='Y')
                {
                	$row[] = "<font class='td-status' style='color: #649e07;'>AKTIF</font>";
                }else{
                	$row[] = "<font class='td-status' style='color: red;'>TIDAK AKTIF</font>";
                }
                $row[] = date('d-m-Y', strtotime(trim($datax->ms_berlaku)));
                
                //add html for action
                $row[] = '<a class="btn btn-simple btn-warning btn-icon btnedit" href="javascript:void(0)" title="Ubah" onclick="edit_Datax('."'".$datax->id."'".')"><i class="fa fa-edit"></i></a>
                <a class="btn btn-simple btn-danger btn-icon btndelete" href="javascript:void(0)" title="Hapus" onclick="delete_Datax('."'".$datax->id."'".')"><i class="fa fa-times"></i></a>';
                
                $data[] = $row;
            }
            
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->datax->count_all(),
                            "recordsFiltered" => $this->datax->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        // }else{

            
            
        // }
    }
	
	public function get_Kota()
	{
		$html='';
        $provinsi = $this->input->post('provinsi');
        $dataprov = $this->datax->get_Kota($provinsi);
        $html .='<option value="">Pilih Kabupaten / Kota</option>';
        foreach ($dataprov as $list) {
             $html .= '<option value="'.trim($list->nama).'">'.trim($list->nama).'</option>';
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

	public function getData()
	{
  //       $name = trim($this->input->post('name'));
		// $provinsi = trim($this->input->post('provinsi'));
		// $kota = trim($this->input->post('kota'));
		// $kelas = trim($this->input->post('kelas'));
		// $kategori = trim($this->input->post('kategori'));
		// $bidangusaha = $this->input->post('bidangusaha');
		// $dermaga = trim($this->input->post('dermaga'));
		// $meter = trim($this->input->post('meter')); 
		// $kapasitas = trim($this->input->post('kapasitas'));
		// $tuk_ter = trim($this->input->post('tuk_ter'));
		// $status = trim($this->input->post('status'));
		// $tgl_akhir = trim($this->input->post('tgl_akhir'));

		// $cek=$this->datax->getData($name,$provinsi,$kota,$kelas,$kategori,$bidangusaha,$dermaga,$meter,$kapasitas,$tuk_ter,$status,$tgl_akhir);
		// echo json_encode($cek);

		$html ="";
		$param1 = $this->security->xss_clean($this->input->post("param"));
		$data = $this->datax->getData($param1);

		$i=1;
            
        foreach($data as $row)
        {
           	$html .="<tr role='row'>";
           	$html .="<td>".$i."</td>";
            $html .="<td><font style='font-weight: bold;'>".trim($row->nm_perusahaan)."</font></td>";
           	$html .="<td><font class='td-status2'>".trim($row->alamat)."</font></td>";
            $html .="<td>".$row->nmksop."</td>";
            // $html .="<td>".$row['nmprov']."</td>";
            $html .="<td>".$row->nmusaha."</td>";
            $html .="<td>".$row->nmkateg."</td>";
            $html .="<td>".trim($row->lokasi)."</td>";
            $html .="<td>".trim($row->koordinat)."</td>";
            $html .="<td>".trim($row->spesifikasi)."</td>";
            if(trim($row->ter_tuk)=='TUKS')
            {
                $html .="<td><font class='td-status' style='color: #A3A0FB;'>".trim($row->ter_tuk)."</font></td>";
            }else{
                $html .="<td>.<font class='td-status' style='color: #6bd189;'>".trim($row->ter_tuk)."</font></td>";
            }

            $html .="<td>".trim($row->sk)."</td>";
            $html .="<td>".date('d-m-Y', strtotime(trim($row->tgl_terbit)))."</td>";
            if(trim($row->status)=='Y')
            {
                $html .="<td><font class='td-status' style='color: #649e07;'>AKTIF</font></td>";
            }else{
                $html .="<td><font class='td-status' style='color: red;'>TIDAK AKTIF</font></td>";                
            }
            $html .="<td>".date('d-m-Y', strtotime(trim($row->ms_berlaku)))."</td>";
            $html .='<td><a class="btn btn-simple btn-warning btn-icon btnedit" href="javascript:void(0)" title="Ubah" onclick="edit_Datax('."'".$row->id."'".')"><i class="fa fa-edit"></i></a>
                <a class="btn btn-simple btn-danger btn-icon btndelete" href="javascript:void(0)" title="Hapus" onclick="delete_Datax('."'".$row->id."'".')"><i class="fa fa-times"></i></a></td>';
			$html .='</tr>';
			
            $i++;
        
        }  
        
        echo json_encode($html);
		
	}


	// public function getDataRole()
	// {
	// 	$ID_USER = trim($this->input->post('USER_ID'));
	// 	$cek=$this->Home_model->getDataRole($ID_USER);
	// 	echo json_encode($cek);
	// }
	
}
?>
