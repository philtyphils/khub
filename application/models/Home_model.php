<?php
	class Home_model extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}

		public function notification()
    	{
    	    return $this->db->where("ms_berlaku < '".date('Y-m-d H:i:s')."'")->count_all_results("daftar_perusahaan");
		}
	
		public function Set_ANSI_NULLS(){
			$this->db->query('SET ANSI_NULLS ON');
			$this->db->query('SET ANSI_WARNINGS ON');
		}

		public function getDataRole($userid){
			$arrayHasil = array();
			$USER_ID = $userid;

			$sql="SELECT a.USERID,a.ID_MENU,b.NAMA_MENU,
				CASE WHEN a.READ=1 
				THEN
				'true'
				ELSE
				'false'
				end as READX,
				CASE WHEN a.WRITE=1 
				THEN
				'true'
				ELSE
				'false'
				end as WRITEX,
				CASE WHEN a.DELETE=1 
				THEN
				'true'
				ELSE
				'false'
				end as DELETEX,
				CASE WHEN a.ADD=1 
				THEN
				'true'
				ELSE
				'false'
				end as ADDX,b.URUT_MENU FROM tblrole  a LEFT JOIN tblmenu as b ON a.ID_MENU=b.ID_MENU WHERE a.USERID = ? ORDER BY b.URUT_MENU";
			$sql1 = $this->db->query($sql,array($USER_ID));
			$i=0;
			if($sql1->num_rows()>0){
				foreach ($sql1->result_array() as $row){
					$arrayHasil[$i]["id_user"] = trim($row['USERID']);
					$arrayHasil[$i]["id_menu"] = trim($row['ID_MENU']);
					$arrayHasil[$i]["nama_menu"] = trim($row['NAMA_MENU']);
					$arrayHasil[$i]["read"] = trim($row['READX']);
					$arrayHasil[$i]["write"] = trim($row['WRITEX']);
					$arrayHasil[$i]["deletex"] = trim($row['DELETEX']);
					$arrayHasil[$i]["add"] = trim($row['ADDX']);
					$arrayHasil[$i]["urut"] = trim($row['URUT_MENU']);
					$i++;
				}
			}
			return $arrayHasil;
		}


		public function checkRole($validUser,$ID_MENU,$field){
	        $query = $this->db->query("SELECT $field as roledata FROM tblrole WHERE `READ`=1 AND USERID=? AND ID_MENU=?",array($validUser,$ID_MENU));
	        $row = $query->row();
	        $return = 0;
	        if(isset($row)){
	            $return = $row->roledata;
	        }
	        return $return;
		}
		
		public function status_aktif($status)
		{
			$this->db->from("daftar_perusahaan");
			$this->db->where("ter_tuk",$status);
			$this->db->where("status","Y");
			$aktif =  $this->db->count_all_results();

			$this->db->from("daftar_perusahaan");
			$this->db->where("ter_tuk",$status);
			$this->db->where("status","N");
			$nonaktif =  $this->db->count_all_results();

			return array(
				"aktif" => $aktif,
				"nonaktif" => $nonaktif,
				"total" => $this->db->where("ter_tuk",$status)->count_all("daftar_perusahaan")
			);
		}
		
		
	}
?>