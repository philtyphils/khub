<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

    var $table = 'daftar_perusahaan';
    var $column_order = array('a.id','a.nm_perusahaan','a.ksop_id','a.bdgusaha_id','a.kategori_id','a.lokasi','a.koordinat','a.ter_tuk','a.sk','a.tgl_terbit','a.status','a.ms_berlaku'); //set column field database for datatable orderable
    var $column_search = array('a.id','a.nm_perusahaan','c.nama','d.nama','e.nama','a.lokasi','a.koordinat','a.ter_tuk','a.sk','a.tgl_terbit','a.status','a.ms_berlaku'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order 
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.*,b.name as nmprov,c.nama as nmksop,d.nama as nmusaha,e.nama as nmkateg');
        $this->db->from('daftar_perusahaan as a');
        $this->db->join('provinsi as b','a.provinsi_id=b.id','left');
        $this->db->join('ksop as c','a.ksop_id=c.ksop_id','left');
        $this->db->join('bdg_usaha as d','a.bdgusaha_id=d.bdg_usaha_id');
        $this->db->join('kategori as e','a.kategori_id=e.kategori_id','left');
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    //$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                //if(count($this->column_search) - 1 == $i) //last loop
                    //$this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_provinsi()
    {
        $this->db->from('wilayah');
        $this->db->where('length(kode) = 2');
        $this->db->order_by('kode','asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_kategori()
    {
        $this->db->from('kategori');
        $this->db->order_by('kategori_id','asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_bidangusaha()
    {
        $this->db->from('bdg_usaha');
        $this->db->order_by('bdg_usaha_id','asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_Kota($id)
    {
        $where = "";
        if(count($id) > 0)
        {
            $query =" WHERE (";
            foreach($id as $p)
            {
                $query = $query." (substr(kode,1,2) =".$p. " and kode!='".$p."') OR ";
            }
            $query = substr($query,0,-4);
            $where = $query.")";
            $sql ="SELECT * from wilayah ".$where;
            $query= $this->db->query($sql);
                
            return $query->result(); 
        }
        else
        {
            return (object) [];
        }
       
    }

    public function get_Kota2($id)
    {
        
        $sql ="SELECT * from wilayah where substr(kode,1,2) = '".$id."' and kode!='".$id."' and length(kode) = 5  ORDER BY nama ASC";
        $query= $this->db->query($sql);
            
        return $query->result(); 
    }

    public function get_Kecamatan($id)
    {
        
        $sql ="SELECT * from wilayah where length(kode) = 8 && substr(kode,1,2) = '".$id."' and kode!='".$id."' ORDER BY nama ASC";
        $query= $this->db->query($sql);
            
        return $query->result(); 
    }

    public function get_Kecamatan2($id)
    {
        $sql ="SELECT * from wilayah where length(kode) = 5 and substr(kode,1,2) = '".$id."'  ORDER BY nama ASC";
        $query= $this->db->query($sql);
            
        return $query->result(); 
    }

    public function get_Kelurahan($id)
    {
        $sql ="SELECT * from wilayah where length(kode) > 5 and substr(kode,1,5) = '".$id."' ORDER BY nama ASC";
        $query= $this->db->query($sql);
            
        return $query->result(); 
    }

    public function get_Kelas($id)
    {
        $where = "";
        if(count($id) > 0)
        {
            $query =" WHERE (";
            foreach($id as $p)
            {
                $query = $query." ksop.provinsi_id ='".$p."' OR ";
            }
            $query = substr($query,0,-4);
            $where = $query.")";

            $sql ="SELECT * from ksop left join provinsi on ksop.provinsi_id=provinsi.id ".$where;
            $query= $this->db->query($sql);

            return $query->result();
            
        }
        else
        {
            return (object) array();
        }

         
    }

    public function get_Kelas2($id)
    {
       
        $sql ="SELECT * from ksop left join provinsi on ksop.provinsi_id=provinsi.id where provinsi_id ='".$id."'";
        $query= $this->db->query($sql);
            
        return $query->result(); 
    }

    public function DMStoDD($deg,$min,$sec)
    {

        // Converting DMS ( Degrees / minutes / seconds ) to decimal format
        return $deg+((($min*60)+($sec))/3600);
    }    


    public function create($data)
    {
        //echo "<pre>";print_r($data);die();
        $d_provinsi = "";
        if($data['provinsi'] != "")
        {
            $dData = explode("|",$data['provinsi']);
            $d_provinsi = (int) $dData[0];
        }

        $d_kecamatan = "";
        if( $data['kecamatan'] != "")
        {
            $dData = explode("|",$data['kecamatan']);
            $d_kecamatan = (int) $dData[0];
        }

        $d_kelurahan = "";
        if($data['kelurahan'] != "")
        {
            $dData = explode("|",$data['kelurahan']);
            $d_kelurahan = (int) $dData[0];
        }

        $contactperson = "";
        if($data['contactperson'] != "")
        {
            $contactperson = $data['contactperson'];
        }

        $email = "";
        if($data['email'] != "")
        {
            $email = $data['email'];
        }

        for($i=0;$i<count($data['lokasi_f']);$i++)
        {
            $provinsi_f = "";
            if($data['provinsi_f'][$i] != "")
            {
                $dData = explode("|",$data['provinsi_f'][$i]);
                $provinsi_f = (int) $dData[0];
            }

            $kecamatan_f = "";
            if($data['kecamatan_f'][$i] != "")
            {
                $dData = explode("|",$data['kecamatan_f'][$i]);
                $kecamatan_f = (int) $dData[0];
            }

            $kelurahan_f = "";
            if($data['kelurahan_f'][$i] != "")
            {
                $dData = explode("|",$data['kelurahan_f'][$i]);
                $kelurahan_f = (int) $dData[0];
            }

            $spesifikasi = "";
            foreach($data['dermaga'][$i] as $key=>$val){ // Loop though one array
                
                $val2 = $data['spesifikasi'][$i][$key];
                $val3 = $data['peruntukan'][$i][$key]; 
                $val4 = $data['meter'][$i][$key];
                $val5 = $data['kapasitas'][$i][$key];
                $val6 = $data['satuan'][$i][$key];                 
                $spesifikasi .= "TIPE: ".$val .", SPESIFIKASI: " . $val2 .", KEDALAMAN: " .str_replace(" ","",$val4)." M LWS, PERUNTUKAN: " .$val3.", UKURAN MAKSIMUM " .$val5." ".$val6 . ". | ";
            
            }
            $spesifikasi        = substr($spesifikasi,0,-3);

            $bdgusaha_id        = (int) $data['bidangusaha'][$i];
            $_get_kategori_id   = $this->db->where('bdg_usaha_id',(int) $data['bidangusaha'])->get("bdg_usaha")->row();
            $kategori_id        = $_get_kategori_id->kategori_id;

            $insert = array(
                "provinsi_id"           => $provinsi_f,
                "ksop_id"               => $data['kelas'][$i],
                "bdgusaha_id"           => $bdgusaha_id,
                "kategori_id"           => $kategori_id,
                "nm_perusahaan"         => $data['name'],
                "lokasi"                => $data['lokasi_f'][$i],
                "lokasi_kecamatan"      => $kecamatan_f,
                "lokasi_kelurahan"      => $kelurahan_f,
                "alamat"                => $data['alamat'],
                "alamat_provinsi_id"    => $d_provinsi,
                "alamat_kelurahan"      => $d_kelurahan,
                "alamat_kecamatan"      => $d_kecamatan,
                "alamat_kodepos"        => $data['kodepos'],
                "alamat_email"          => $email,
                "no_tlp"                => $contactperson,
                "koordinat"             => $data["d_lat"][$i]."°-".$data['m_lat'][$i]."'-".$data['s_lat'][$i]."\"".$data['direction_lat'][$i]."/". $data["d_long"][$i]."°-".$data['m_long'][$i]."'-".$data['s_long'][$i]."\"BT",
                "koordinat_dd"          => $this->DMStoDD($data["d_lat"][$i],$data['m_lat'][$i],$data['s_lat'][$i]) ." ". $this->DMStoDD($data["d_long"][$i],$data['m_long'][$i],$data['s_long'][$i]),
                "k_lat"                 => $this->DMStoDD($data["d_lat"][$i],$data['m_lat'][$i],$data['s_lat'][$i]),
                "k_long"                => $this->DMStoDD($data["d_long"][$i],$data['m_long'][$i],$data['s_long'][$i]),
                "ter_tuk"               => $$data['tersus_tuks'][$i],
                "spesifikasi"           => $spesifikasi,
                "sk"                    => $data['nosk'][$i],
                "jns_legalitas"         => $data['jenissk'][$i],
                "tgl_terbit"            => $data['tgl_terbit'][$i],
                "ms_berlaku"            => $data['tgl_akhir'][$i],
                "update_date"           => date("Y-m-d"),
                "status"                => $data['status'][$i]
    
            );
            try
            {
                $exec = $this->db->insert("daftar_perusahaan",$insert);
            }
            catch (\Exception $e)
            {
                die($e->getMessage());
                //return FALSE;
            }
        }

        return $exec;
    }

    public function edit($data)
    {
        $d_provinsi = "";
        if($data['provinsi'] != "")
        {
            $dData = explode("|",$data['provinsi']);
            $d_provinsi = (int) $dData[0];
        }

        $d_kecamatan = "";
        if( $data['kecamatan'] != "")
        {
            $dData = explode("|",$data['kecamatan']);
            $d_kecamatan = (int) $dData[0];
        }

        $d_kelurahan = "";
        if($data['kelurahan'] != "")
        {
            $dData = explode("|",$data['kelurahan']);
            $d_kelurahan = (int) $dData[0];
        }

        $provinsi_f = "";$prov_nama = "";
        if($data['provinsi_f'] != "")
        {
            $dData = explode("|",$data['provinsi_f']);
            $provinsi_f = (int) $dData[0];
            $prov_nama  = $dData[1];
        }

       
        $spesifikasi = "";
        foreach($data['dermaga'] as $key=>$val){ // Loop though one array
            
            $val2 = $data['spesifikasi'][$key];
            $val3 = $data['peruntukan'][$key]; 
            $val4 = $data['meter'][$key];
            $val5 = $data['kapasitas'][$key];
            $val6 = $data['satuan'][$key];                 
            $spesifikasi .= "TIPE: ".$val .", SPESIFIKASI:" . $val2 .", KEDALAMAN: " .str_replace(" ","",$val4)." M LWS, PERUNTUKAN: " .$val3.", UKURAN MAKSIMUM " .$val5." ".$val6 . ". | ";
           
        }
        $spesifikasi        = substr($spesifikasi,0,-3);
        $_get_kategori_id   = $this->db->where('bdg_usaha_id',(int) $data['bidangusaha'])->get("bdg_usaha")->row();

        $lok_kec            = $this->db->where("kode",$data['kecamatan_f'])->get('wilayah')->row();
        $lok_kel            = $this->db->where("kode",$data['kelurahan_f'])->get('wilayah')->row();
        /* ------------ table update ---------------*/
        $provinsi_id        = $provinsi_f;
        $ksop_id            = (int) $data['wilayah_kerja'];
        $bdg_usaha_id       = (int) $data['bidangusaha'];
        $kategori_id        = $_get_kategori_id->kategori_id;        
        $nm_perusahaan      = trim($data['name']);
        $lokasi             = $data['lokasi_f'] . " " .$lok_kec->nama . " " .$lok_kel->nama . " ".$prov_nama;
        $lokasi_kecamatan   = $data['kecamatan_f'];
        $lokasi_kelurahan   = $data['kelurahan_f'];
        $alamat             = $data['alamat'];
        $alamat_provinsi_id = $d_provinsi;        
        $alamat_kelurahan   = $data['kelurahan'];
        $alamat_kecamatan   = $data['kecamatan'];
        $alamat_kodepos     = $data['kodepos'];
        $alamat_email       = $data['email'];
        $no_tlp             = $data['contactperson'];
        $koordinat          = $data["d_lat"]."°-".$data['m_lat']."'-".$data['s_lat']."\"".$data['direction_lat']."/". $data["d_long"]."°-".$data['m_long']."'-".$data['s_long']."\"BT";
        $koordinat_dd       = $this->DMStoDD($data["d_lat"],$data['m_lat'],$data['s_lat']) ." ". $this->DMStoDD($data["d_long"],$data['m_long'],$data['s_long']);
        $k_lat              = $this->DMStoDD($data["d_lat"],$data['m_lat'],$data['s_lat']);
        $k_long             = $this->DMStoDD($data["d_long"],$data['m_long'],$data['s_long']);
        $ter_tuk            = $data['ter_tuk'];
        $spesifikasi        = $spesifikasi;
        $sk                 = $data['nosk'];
        $jns_legalitas      = $data['jenissk'];
        $tgl_terbit         = date("Y-m-d",strtotime($data['tgl_terbit']));
        $ms_berlaku         = date("Y-m-d",strtotime($data['tgl_akhir']));

        $data = $this->db->where("id",$data['_id'])->update("daftar_perusahaan",array(
            "provinsi_id"           => $provinsi_id,
            "ksop_id"               => $ksop_id,
            "bdgusaha_id"           => $bdg_usaha_id,
            "kategori_id"           => $kategori_id,
            "nm_perusahaan"         => $nm_perusahaan,
            "lokasi"                => $lokasi,
            "lokasi_kecamatan"      => $lokasi_kecamatan,
            "lokasi_kelurahan"      => $lokasi_kelurahan,
            "alamat"                => $alamat,
            "alamat_provinsi_id"    => $alamat_provinsi_id,
            "alamat_kelurahan"      => $alamat_kelurahan,
            "alamat_kecamatan"      => $alamat_kecamatan,
            "alamat_kodepos"        => $alamat_kodepos,
            "alamat_email"          => $alamat_email,
            "no_tlp"                => $no_tlp,
            "koordinat"             => $koordinat,
            "koordinat_dd"          => $koordinat_dd,
            "k_lat"                 => $k_lat,
            "k_long"                => $k_long,
            "ter_tuk"               => $ter_tuk,
            "spesifikasi"           => $spesifikasi,
            "sk"                    => $sk,
            "jns_legalitas"         => $jns_legalitas,
            "tgl_terbit"            => $tgl_terbit,
            "ms_berlaku"            => $ms_berlaku,
            "update_date"           => date("Y-m-d"),
            "status"                => $data['status']

        ));

        return $data;


    }

    public function _getSingleData($id)
    {
        $data           = $this->db->where("id",$id)->get("daftar_perusahaan")->row();
     
        $kecamatan      = $this->db->where("substr(kode,1,2)",$data->provinsi_id)->where("LENGTH(kode)",5)->get("wilayah")->result();
        $kelurahan      = $this->db->where("substr(kode,1,2)",$data->provinsi_id)->where("LENGTH(kode)>5")->get("wilayah")->result();
        $wilayah_kerja  = $this->db->where("provinsi_id",$data->provinsi_id)->get("ksop")->result();
       
        $alamat_kecamtan=  $this->db->where("substr(kode,1,2)",$data->alamat_provinsi_id)->where("LENGTH(kode)",5)->get("wilayah")->result();
        return array(
            "data" => $data,
            "kecamatan" => $kecamatan,
            "kelurahan" => $kelurahan,
            "wilayah_kerja" => $wilayah_kerja,
            "alamat_kecamatan" => $alamat_kecamtan
        );
    }

    public function _getspesifikasi($id)
    {
        $this->db->where("id",$id);
        $data = $this->db->get('daftar_perusahaan')->result();
        return $data;

    }

    public function check_sk($val)
    {
        $this->db->where("sk",trim($val));
        $data = $this->db->count_all_results();
        return $data;

    }

    public function jenis_sk()
    {
        return $this->db->get("jenis_sk")->result();
    }

    public function delete($data)
    {
       $data = $this->db->where("id",$data['id'])->update("daftar_perusahaan",array(
            "flag" => "0"
        ));
        return $data;
    }

    public function get_dermaga()
    {
        return $this->db->get("dermaga_tipe")->result();
    }

    public function notification()
    {
        return $this->db->where("flag",1)->where("ms_berlaku < '".date('Y-m-d H:i:s')."'")->count_all_results("daftar_perusahaan");
    }

}