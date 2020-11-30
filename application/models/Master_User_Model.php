<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_User_model extends CI_Model {
 
    var $table = 'tbluser';
    var $column_order = array('USERID','USERNM','USERLVL','LOCK',null); //set column field database for datatable orderable
    var $column_search = array('USERID','USERNM','USERLVL','LOCK'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('USERID' => 'asc'); // default order 
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    private function _get_datatables_query(){
        $this->db->select('userid,usernm,userlvl,email,lock as status'); 
        $this->db->from('tbluser');
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
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
 
    function get_datatables(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all(){
        $this->db->select('a.userid,a.usernm,a.userlvl,a.email,a.lock,c.nama_pry'); 
        $this->db->from('tbluser a');
        return $this->db->count_all_results();
    }
 
    public function get_by_id($id,$pry){
        $this->db->select('a.userid,a.usernm,a.userlvl,a.email,a.lock as status'); 
        $this->db->from('tbluser a');
        $this->db->where('a.userid',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data){
        $msg="";
        $EMAIL = $data['EMAIL'];
        $sql="SELECT a.userid  FROM tbluser a where a.userid=?";
        $sql1 = $this->db->query($sql,array($data['USERID']));
        if($sql1->num_rows()>0){
             return false;
        }else{
            $this->db->insert($this->table, $data);
            if($this->db->affected_rows()>0){
                $this->db->from("tblmenu");
                $query = $this->db->get();
                foreach ($query->result() as $row)
                {
                    $IDMENU = $row->ID_MENU;
                    $data_insert = array(
                        'USERID' => $data['USERID'],
                        'ID_MENU' => $IDMENU
                    );
                   $this->db->insert("tblrole", $data_insert);
                }
                return true;
                
            }else{
                return false;
            }
        }
        
    }
 
    public function update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function getalluser(){
        $html="";
        $sqlx="select userid,usernm from tbluser order by usernm asc";
        $sql1x = $this->db->query($sqlx);
        $i=1;
        if($sql1x->num_rows()>0){
            foreach ($sql1x->result_array() as $row)
            {
                $html .= "<option value='".trim($row['userid'])."'>".$i.". ".trim($row['usernm'])."</option>";
                $i++;
            }
           
        }
        return $html;
    }

   
    public function delete_by_id($id){
        $this->db->where('USERID', $id);
        $this->db->delete($this->table);
        $this->db->where('USERID', $id);
        $this->db->delete("tblrole"); 
        return true;
    }

    public function gettblref($arrWhere)
    {
        $query = $this->db->get_where("tblref", $arrWhere);
        return $query;
    }
     

    public function kategori_chart()
    {
        $data = $this->db->get('rekaptulasi_kategori')->result();
        $r = array();
        foreach($data as $key => $value)
        {
            $f      = array(
                "name" => $value->kategori,
                "y" => (int) $value->TOTAL
            );
            $r[]    = $f;
        }

        return $r;
    }

    public function wilayah_kerja_chart()
    {
        $data = $this->db->order_by('
            (CASE 
                WHEN wilayah_kerja LIKE "%OP KELAS%"    THEN 1
                WHEN wilayah_kerja LIKE "%KSOP KELAS%"  THEN 2 
                WHEN wilayah_kerja LIKE "%KUPP%"        THEN 3  
            END),
            wilayah_kerja ASC')->get('rekaptulasi_wilayah_kerja')->result(); 

        return $data;
    }



    public function bdg_usaha_chart()
    {
        $data = $this->db->order_by('bidang_usaha','ASC')->get('rekaptulasi_bidang_usaha')->result();
     
        return $data;
    }
    public function notification()
    {
        return $this->db->where("ms_berlaku < '".date('Y-m-d H:i:s')."'")->count_all_results("daftar_perusahaan");
    }
}
?>