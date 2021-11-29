<?php

use App\Components\Orgs;

class Org extends Controller {

    function __construct() {
        parent::__construct();

        $this->Orgs = new Orgs();

    }

    function index(){
        echo 'nothing to see ... nothing to see.. keepit moving. ';
    }

    function getOrgProfile($id='') {
        if(!$id) {
            http_response_code(401);
            $ReturnError['Code']='401';
            $ReturnError['Message']='UserID Required';
            $Result = json_encode($ReturnError);
        } else {

            $Result = $this->Orgs->orgProfile($id);

        }
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: ' . ($_GET['callback'] ? 'application/javascript' : 'application/json') . ';charset=UTF-8');
        echo isset($_GET['callback']) ? "/**/ typeof {$_GET['callback']} === 'function' && {$_GET['callback']}($Result)" : $Result;

    }



    function createUser() {

        $Email      = $_POST['email'];
        $ssmAuth    = $_POST['ssmauth'];
        $Phone      = $_POST['phone'];

        $Response = $this->Users->CheckUser($Email, $ssmAuth, $Phone);
        $UserID = $Response['userid'];
        ($Response['phone'] ? $hasPhone = '1' : $hasPhone = '0' );
        ($Response['address'] ? $hasAddress = '1' : $hasAddress = '0' );

        if($Response['userid']) {
            // User Exists.
            $Result['Code'] = '1';
            $Result['UserID'] = $UserID;
            $Result['hasPhone'] = $hasPhone;
            $Result['hasAddress'] = $hasAddress;
            $Result['Message'] = 'User Exist';
            $Result = json_encode($Result);
        } else {
        // Create User; User Doesn't Exist
            foreach($_POST as $kPost => $PostData) :
                $$kPost = $PostData;
                $data[$kPost]=$PostData;
                    if($kPost == 'password') $data['password'] = Hash::create('sha256', $password, HASH_PASSWORD_KEY);
                    if($kPost == 'whatsapp') $data['whatsapp'] = Helper::cleanPhone($whatsapp);
                    if($kPost == 'phone') $data['phone'] = Helper::cleanPhone($phone);
            endforeach;
            $Result = $this->Users->Create($data);
        }
        echo $Result;
    } // End Method




    function updateUser(){
        $param = $_POST;
        $UserID = $param['userid'];

        // \Helper::print_array($param);

        if($UserID) {
            foreach($param as $uKey => $uVal) :
                $$uKey = $uVal;
                $udata[$uKey] = $uVal;

                if($uKey == 'password')     $udata['password'] = Hash::create('sha256', $password, HASH_PASSWORD_KEY);
                if($uKey == 'whatsapp')     $udata['whatsapp'] = Helper::cleanPhone($whatsapp);
                if($uKey == 'phone')        $udata['phone'] = Helper::cleanPhone($phone);
            endforeach;


            $Return = $this->Users->Update('users', $udata, "userid='{$UserID}'");
            echo $Return;
        }
    }


    function deleteUser(){
        $UserID = $_POST['UserID'];
        if($_SESSION['Logged']['userId'] == $UserID) {
            die('{"Code":"0","Message":"You Can Not Delete Yoursef"}');
        }

        if($_SESSION['UserProfile']['isSuper'] == '1') {
            echo $this->Users->Delete($UserID);
        } else {
            echo '{"Code":"0","Message":"Only Super Admin Can Delete User."}';
        }
    }


    function search() {
		
        $data['pagenum'] = $pagenum;
        $ReturnOrgs = $this->Orgs->Search($data);

        foreach($ReturnOrgs['results'] as $oKey => $oVal) :
            $responsive_id  = $oVal['responsive_id'];
            $orid           = $oVal['orgid'];
            $fullname       = $oVal['name'];
            $username       = $oVal['orgid'];
            $orgType        = $oVal['catid'];
            $Phone          = $oVal['phone'];
            $Location       = $oVal['city'] . ', ' . $oVal['state'];
            $Status         = $oVal['active'];
            $Avatar         = $oVal['avatar'];

            $jData[$orid]['responsive_id'] = $responsive_id;
            $jData[$orid]['id'] = $orid;
            $jData[$orid]['role'] = 'Broker';
            $jData[$orid]['full_name'] = $fullname;
            $jData[$orid]['username'] = $username;
            $jData[$orid]['current_plan'] = $orgType;
            $jData[$orid]['phone_number'] = $Phone;
            $jData[$orid]['location'] = $Location;
            $jData[$orid]['status'] = $Status;
            $jData[$orid]['avatar'] = $Avatar;
            $jDataJson = json_encode(array_values($jData));

        endforeach;

        $Result = '{"data":';
        $Result .= $jDataJson;
        $Result .= '}';

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: ' . ($_GET['callback'] ? 'application/javascript' : 'application/json') . ';charset=UTF-8');
        echo isset($_GET['callback']) ? "/**/ typeof {$_GET['callback']} === 'function' && {$_GET['callback']}($Result)" : $Result;


    }




} // end class