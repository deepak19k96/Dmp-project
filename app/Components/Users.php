<?php namespace App\Components;

use Model as Model;

class Users extends Model {	

	public function __construct() {
		 parent::__construct(); 
	}



	public function UserProfile($data) {
		$UserID=$data;
		// Build General Profile Info
		$Profile = $this->UserGen($UserID);
			foreach($Profile as $prKey => $UserProfile) {
				$UserProf['Profile'][$prKey]=$UserProfile;
			}
		

		// Build Permissions Array
        if($Profile['role_id']) {
            $Permissions = $this->UserPermissions($Profile['role_id']);
                foreach($Permissions as $pKey => $Permissions) {
                    $UserProf['Permissions'][$pKey]=$Permissions;
                }
        }





		// print_array($UserProf);
		return json_encode($UserProf);
	}

    public function CheckUser($email="", $auth="", $phone="") {
        if($email)  { $WhereSQL = "WHERE email ='{$email}'"; }
        if($auth)   { $WhereSQL = "WHERE ssmauth like '%{$auth}%'"; }
        if($phone)  { $WhereSQL = "WHERE phone ='{$phone}'"; }

        $sql = "SELECT * FROM users {$WhereSQL} ";
        $Return = $this->db->select($sql);

        return $Return[0];

    }

    public function UserAuthentication($Username, $Password) {

        $sql = "SELECT * FROM users WHERE username = :username and password = :password";
        $userdata['username'] = $Username;
        $userdata['password'] = \Hash::create('sha256', $Password, HASH_PASSWORD_KEY);
        $Return = $this->db->select($sql, $userdata);

         // \Helper::print_array($Return);
        if(empty($Return)) {
            $Response['Code']="401";
            $Response['Error']="Authentication Error.";
        } else {
            $Response['Code']="1";
            $Response['userID'] = $Return[0]['userid'];
        }

        return $Response;
    }


    public function userGen($userid){
        $sql = "SELECT * FROM users WHERE userid='{$userid}'";
        $Return = $this->db->select($sql);
        return $Return[0];
    }


	public function UserPermissions($data){
            $sql = "SELECT t2.perm_controller,t2.perm_action FROM role_perm as t1
					JOIN permissions as t2 ON t1.perm_id = t2.perm_id
					WHERE t1.role_id = :role_id";
            $permission = array();
            $Return = $this->db->select($sql, array(':role_id' => $data));
		
			foreach ($Return as $KeyD => $Perms){
				$PermArray[$Perms['perm_controller']][]=$Perms['perm_action'];
			}

			return $PermArray;
	}



    /* Generic Create */
    public function Create($data) {
        $Response = $this->db->insert('users', $data);
		return $Response;
	}
    /* Generic Update */
	public function Update($table, $data, $identifier) {
        $Return = $this->db->update($table, $data, $identifier);
		return $Return;
	}

	/* Search User by email address */
	function UserByEmail($data) {
        $UserSQL = "select * from usergen where username=:userEmail";
        $Return = $this->db->select($UserSQL, array('userEmail' => $data));
			return $Return;
	}

    /* Build Menu from JSON  */
	function jsonMenu($data) {
        $UserSQL = "SELECT * FROM roles_menu WHERE roleid=:roleid";
        $Return = $this->db->select($UserSQL, array('roleid' => $data));
			
		return $Return[0]['menu'];
	}
	

    public function OTPadd($data) {
        $Return = $this->db->insert('phoneoptverify', $data);
        return $Return;
    }


    public function OTPupdate($data) {

	    $code = $data['code'];
	    $phone = $data['phone'];

	    #Step 1: Search the OTP in the phoneotepverify database.
        $CheckReturn = $this->db->query("select * from phoneoptverify where code='{$code}' and active='1'");

        if($CheckReturn[0]['code'] == $code) {  // Redunded but it works.
            $updatedata['active']='2';
            $updatedata['verifiedate']= TIMESTAMP;
            $Updated = $this->db->update('phoneoptverify', $updatedata, "phone='$phone'");
            $Update = json_decode($Updated);
            if($Update->Code == '1') {
                $Return['Code'] = '1';
                $Return['Message'] = "success";
                $Return = json_encode($Return);
            }

        } else {
            $Return['Code'] = '0';
            $Return['Message'] = "Invalid Verification Code";
            $Return = json_encode($Return);
        }

        return $Return;
    }



    function Search($data){

        $pagenum = $data['pagenum'];
        $limit = $data['limit'];

        $UserName = $data['username'];


        $OrderBySQL = "order by userid asc";
        if($UserName) { $WhereClause .= "AND username LIKE '%{$username}%'"; }

	    $sql = "select * from usergen where 1 {$WhereClause} {$OrderBySQL} LIMIT ?,?  ";
        $Return = $this->db->pagination($sql, $pagenum, $limit);

        return $Return;
    }






} // End Class 