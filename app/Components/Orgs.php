<?php namespace App\Components;

use Model as Model;

class Orgs extends Model {

	public function __construct() {
		 parent::__construct(); 
	}



	public function orgProfile($data) {
		$UserID=$data;
		// Build General Profile Info
		$Profile = $this->OrgGen($UserID);
			foreach($Profile as $prKey => $UserProfile) {
                $OrgProfile['Profile'][$prKey]=$UserProfile;
			}

		// print_array($UserProf);
		return json_encode($OrgProfile);
	}


    function Search($data){

        $pagenum = $data['pagenum'];
        $limit = $data['limit'];

        $UserName = $data['username'];


        $OrderBySQL = "order by orgid asc";
        if($UserName) { $WhereClause .= "AND username LIKE '%{$username}%'"; }

        $sql = "select * from orgs where 1 {$WhereClause} {$OrderBySQL} LIMIT ?,?  ";
        $Return = $this->db->pagination($sql, $pagenum, $limit);

        return $Return;
    }



    public function OrgGen($userid){
        $sql = "SELECT * FROM orgs WHERE orgid='{$userid}'";
        $Return = $this->db->select($sql);
        return $Return[0];
    }

    /* Generic Create */
    public function Create($data) {
        $Response = $this->db->insert('orgs', $data);
		return $Response;
	}

    /* Generic Update */
	public function Update($table, $data, $identifier) {
        $Return = $this->db->update($table, $data, $identifier);
		return $Return;
	}




} // End Class 