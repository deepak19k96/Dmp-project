<?php

use App\Components\Users;
use App\Utilities\Twilio;

class User extends Controller {

    function __construct() {
        parent::__construct();
        // Auth::handleLogin();

        $this->Users = new Users();
		$this->Twilio = new Twilio();

    }

    function index(){
        echo 'nothing to see ... nothing to see.. keepit moving. ';
    }

    function getUserProfile($userid='') {
        if(!$userid) {
            http_response_code(401);
            $ReturnError['Code']='401';
            $ReturnError['Message']='UserID Required';
            $Result = json_encode($ReturnError);
        } else {
            $Result = $this->Users->UserProfile($userid);
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: ' . ($_GET['callback'] ? 'application/javascript' : 'application/json') . ';charset=UTF-8');
        echo isset($_GET['callback']) ? "/**/ typeof {$_GET['callback']} === 'function' && {$_GET['callback']}($Result)" : $Result;

    }

    function authenticate() {
        $Source     = $_POST['source'];   // Facebook, Google, Apple

       //  \Helper::print_array($_POST);
        /// Check if there's a source.. If found then check if the user exist in th database.
        ///  If no source is found there's a major problem.
        if($Source) {
            switch($Source) {
                case 'gg' :  // Google
                    $SourceID   = 'gg-' . $_POST['profileid'];
                    $Email      = $_POST['email'];
                    $fName      = $_POST['fname'];
                    $lName      = $_POST['lname'];
                    $FullName   = $_POST['fullname'];
                    $Avatar     = $_POST['avatar'];
                    break;

                case 'fb' :  // Facebook
                    // $SourceID   = 'fb-' . $_POST['profile']['ID'];
                    break;

                case 'appl' :  // Facebook
                    // $SourceID   = 'ap-' . $_POST['profile']['ID'];
                    break;
            }

                # Check if User Exists
                $Response = $this->Users->CheckUser($Email, $SourceID);
                $UserID = $Response['userid'];
                ($Response['phone'] ? $hasPhone = '1' : $hasPhone = '0' );
                ($Response['address'] ? $hasAddress = '1' : $hasAddress = '0' );
                     if($UserID) {
                        // Record Login
                        $updatelog['lastlogin'] = TIMESTAMP;
                        $this->Users->Update('users', $updatelog, "userid='$UserID'");
                        $Result['Code'] = '1';
                        $Result['UserID'] = $UserID;
                        $Result['hasPhone'] = $hasPhone;
                        $Result['hasAddress'] = $hasAddress;
                        $Result['Message'] = 'User Exist';
                        $Result = json_encode($Result);
                        // User Sign-In end of story.

                    } else {
                         http_response_code(401);
                         $ReturnError['Code']='401';
                         $ReturnError['Message']='User Does Not Exist';
                         $Result = json_encode($ReturnError);


                         /* Remove this Snippet because we're not going to create user if user doesn't exist.
                        #Created User if user doesn't exist.
                        $createData['email'] = $Email;
                        $createData['fname'] = $fName;
                        $createData['lname'] = $lName;
                        $createData['name'] = $FullName;
                        $createData['avatar'] = $Avatar;
                        $createData['username'] = $Email;
                        $createData['ipaddress'] = $_SERVER['REMOTE_ADDR'];
                        $createData['ssmauth'] = $SourceID;
                        $RandomPass = rand(1000,9999) .  TIMESTAMP;
                        $createData['password'] = Hash::create('sha256', $RandomPass, HASH_PASSWORD_KEY);

                            if($Email) {
                                $CreatedUser = $this->Users->Create($createData);
                            } else {
                                http_response_code(401);
                                $ReturnError['Code']='401';
                                $ReturnError['Message']='Sign Up - Email Address Required';
                                $Result = json_encode($ReturnError);
                            }
                            if($CreatedUser) {
                                   $CreatedUser = json_decode($CreatedUser);
                                     $Result['Code'] = '1';
                                     $Result['UserID'] = $CreatedUser->ID;
                                     $Result['Message'] = 'Success';
                                     $Result = json_encode($Result);
                            } else {
                                http_response_code(401);
                                $ReturnError['Code']='401';
                                $ReturnError['Message']='Sign Up - Error Creating Account';
                                $Result = json_encode($ReturnError);
                            }
                         */
                    }
        } else {
            #If Source Doesn't Exist or Something Goes wrong in the Source.. Serious Error.
            http_response_code(401);
            $ReturnError['Code']='401';
            $ReturnError['Message']='Source Error - Contact Administrator';
            $Result = json_encode($ReturnError);
        }


        header('Access-Control-Allow-Origin: *');
        header('Content-Type: ' . ($_GET['callback'] ? 'application/javascript' : 'application/json') . ';charset=UTF-8');
        echo isset($_GET['callback']) ? "/**/ typeof {$_GET['callback']} === 'function' && {$_GET['callback']}($Result)" : $Result;


    }

    function emailogin($data=""){
        # Example:  carlos@hirocreative.com:testing
        #Y2FybG9zQGhpcm9jcmVhdGl2ZS5jb206dGVzdGluZw==
        // echo base64_encode('carlos@hirocreative.com:testing');
        #Y2FybG9zQGhpcm9jcmVhdGl2ZS5jb206dGVzdGluZw==


        $GetCreds = base64_decode($data);

        $ExplodeCreds = explode(':', $GetCreds);
            $username = $ExplodeCreds[0];
            $password = $ExplodeCreds[1];

        $Return = $this->Users->UserAuthentication($username, $password);
            if($Return['Code'] == 1) {
                // User Loggedin
                $UserProfile = json_decode($this->Users->UserProfile($Return['userID']));
                //\Helper::print_array($UserProfile);
                //die();
                $Name = $UserProfile->Profile->name;
                $LastLogin = $UserProfile->Profile->lastlogin;
                $roleid = $UserProfile->Profile->role_id;
                $isAdmin = $UserProfile->Profile->isadmin;

                if($isAdmin) {
                    $_SESSION['SuperAdmin']['isAdmin'] = '1';
                    $_SESSION['SuperAdmin']['userid'] = $Return['userID'];
                    $_SESSION['SuperAdmin']['name'] = $Name;
                }

                $_SESSION['User']['userid'] = $Return['userID'];
                $_SESSION['User']['name'] = $Name;
                $_SESSION['User']['lastlogin'] = $LastLogin;
                $_SESSION['User']['roleid'] = $roleid;


               // \Helper::print_array($_SESSION);

                $Result = json_encode($Return);
            } else {
                http_response_code(401);
                $ReturnError['Code']='401';
                $ReturnError['Message']='Authentication Error';
                $Result = json_encode($ReturnError);
            }

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: ' . ($_GET['callback'] ? 'application/javascript' : 'application/json') . ';charset=UTF-8');
        echo isset($_GET['callback']) ? "/**/ typeof {$_GET['callback']} === 'function' && {$_GET['callback']}($Result)" : $Result;

    }

    function OTPlogin($phone="") {
        if(!$phone) {
            http_response_code(401);
            $ReturnError['Code']='401';
            $ReturnError['Message']='Phone Number Required.';
            $Result = json_encode($ReturnError);
        } else {
            $Return = $this->Users->CheckUser("", "", $phone);
          //  \Helper::print_array($Return);

            $jReturn['userid'] = $Return['userid'];
            $jReturn['name'] = $Return['name'];

            $Result = json_encode($jReturn);
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: ' . ($_GET['callback'] ? 'application/javascript' : 'application/json') . ';charset=UTF-8');
            echo isset($_GET['callback']) ? "/**/ typeof {$_GET['callback']} === 'function' && {$_GET['callback']}($Result)" : $Result;
        }

    }

	
	function OTPSetup($phone="") {
		# Send user Phone Verification to have them login. 
        # https://comiida.com/appapi/user/OTPSetup/573014877888
        // It'll be Base64 Encode User Phone number and code


		if(!$phone) { die ('No Phone Number Found'); }
		$GenNumber = rand(1001, 9999);
		
		$data['phone'] = $phone; 
		$data['message'] = "Your verification code is {$GenNumber}. Please use this code to register your phone with Comiida app within 30 minutes";
		$Result = $this->Twilio->SendMessage($data);
		if($Result['Code'] == 1) {
		    $addData['phone'] = $phone;
		    $addData['code'] = $GenNumber;
		    $addData['source'] = 'Comiida App';
		    $addData['ipaddress'] = $_SERVER['REMOTE_ADDR'];
                $OTPReturn = $this->Users->OTPadd($addData);
        }
		$Result = json_encode($Result);


		header('Access-Control-Allow-Origin: *');
		header('Content-Type: ' . ($_GET['callback'] ? 'application/javascript' : 'application/json') . ';charset=UTF-8');
		echo isset($_GET['callback']) ? "/**/ typeof {$_GET['callback']} === 'function' && {$_GET['callback']}($Result)" : $Result;

	}
	
	function OTPConfirm($data="") {
        // echo base64_encode('3014877888:7378');
        $GetCreds = base64_decode($data);

        $ExplodeCreds = explode(':', $GetCreds);
        $phone = $ExplodeCreds[0];
        $code = $ExplodeCreds[1];

		// User enters the OTP Code into the app or website

            // Update Database.
            $oData['phone'] = $phone;
            $oData['code'] = $code;

            $Result = $this->Users->OTPupdate($oData);


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


    # TODO: Need to test this.. and make sure its possible to do pagination
    function searchUsers() {
        $data['pagenum'] = $pagenum;
        $ReturnUsers = $this->Users->Search($data);
        // \Helper::print_array($ReturnUsers);
		
		foreach($ReturnUsers['results'] as $oKey => $oVal) :
		    $responsive_id  = $oVal['responsive_id'];
            $userid  = $oVal['userid'];
            $username           = $oVal['username'];
            $password       = $oVal['password'];
            $email       = $oVal['email'];
            $fname        = $oVal['fname'];
            $lname          = $oVal['lname'];
            $phone          = $oVal['phone'];
            $whatsapp          = $oVal['whatsapp'];
            $telegram          = $oVal['telegram'];
            $website          = $oVal['website'];
            $address1          = $oVal['address1'];
            $address2          = $oVal['address2'];
            $Location       = $oVal['city'] . ', ' . $oVal['state'];
            $full_name       = $oVal['fname'] . ', ' . $oVal['lname'];
            $zip         = $oVal['zip'];
            $country         = $oVal['country'];
            $province         = $oVal['province'];
            $vat         = $oVal['vat'];
            $preferences         = $oVal['preferences'];
            $Avatar         = $oVal['avatar'];
            $cus_token         = $oVal['cus_token'];
            $role_id         = $oVal['role_id'];
            $isadmin         = $oVal['isadmin'];
            $lastlogin         = $oVal['lastlogin'];
            $created_date         = $oVal['created_date'];
            $updated_date         = $oVal['updated_date'];
            $ipaddress	         = $oVal['ipaddress'];
            $active	         = $oVal['active'];
            $notes	         = $oVal['notes'];
            $pwtoken	         = $oVal['pwtoken'];
			
			
			if($role_id == '1'){
				$role = 'Admin';
			}
			if($role_id == '2'){
				$role = 'Freebies';
			}
			if($role_id == '3'){
				$role = 'Premium';
			}
			if($role_id == '4'){
				$role = 'Marketing';
			}
			if($role_id == '5'){
				$role = 'User';
			}
			
			
			
			$jData[$userid]['responsive_id'] = $responsive_id;
            $jData[$userid]['userid'] = $userid;
            $jData[$userid]['username'] = $username;
            $jData[$userid]['password'] = $password;
            $jData[$userid]['email'] = $email;
            $jData[$userid]['full_name'] = $full_name;
            $jData[$userid]['username'] = $username;
            $jData[$userid]['fname'] = $fname;
            $jData[$userid]['lname'] = $lname;
            $jData[$userid]['phone'] = $phone;
            $jData[$userid]['whatsapp'] = $whatsapp;
            $jData[$userid]['telegram'] = $telegram;
            $jData[$userid]['website'] = $website;
            $jData[$userid]['address1'] = $address1;
            $jData[$userid]['address2'] = $address2;
            $jData[$userid]['location'] = $Location;
            $jData[$userid]['zip'] = $zip;
            $jData[$userid]['country'] = $country;
            $jData[$userid]['province'] = $province;
            $jData[$userid]['vat'] = $vat;
            $jData[$userid]['preferences'] = $preferences;
            $jData[$userid]['avatar'] = $Avatar;
            $jData[$userid]['cus_token'] = $cus_token;
            $jData[$userid]['role'] = $role;
            $jData[$userid]['isadmin'] = $isadmin;
            $jData[$userid]['lastlogin'] = $lastlogin;
            $jData[$userid]['created_date'] = $created_date;
            $jData[$userid]['updated_date'] = $updated_date;
            $jData[$userid]['ipaddress'] = $ipaddress;
            $jData[$userid]['active'] = $active;
            $jData[$userid]['notes'] = $notes;
            $jData[$userid]['pwtoken'] = $pwtoken;
            $jDataJson = json_encode(array_values($jData));

        endforeach;

        $Result = '{"data":';
        $Result .= $jDataJson;
        $Result .= '}';

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: ' . ($_GET['callback'] ? 'application/javascript' : 'application/json') . ';charset=UTF-8');
        echo isset($_GET['callback']) ? "/**/ typeof {$_GET['callback']} === 'function' && {$_GET['callback']}($Result)" : $Result;




    }


    function addAddress() {
        foreach($_POST as $kPost => $PostData) :
            $$kPost = $PostData;
            $data[$kPost]=$PostData;
            // if($kPost == 'zipcode') $data['zipcode'] = "555555";   // Replace specific parameters
        endforeach;

        // \Helper::print_array($data);

        $Return = $this->Addresses->addAddress($data);
        echo $Return;
    }

    function updateAddress()
    {

        $param = $_POST;

        $UserID = $param['userid'];
        if ($UserID) {
            foreach ($param as $uKey => $uVal) :
                $$uKey = $uVal;
                $udata[$uKey] = $uVal;

                if ($uKey == 'password') $udata['password'] = Hash::create('sha256', $password, HASH_PASSWORD_KEY);
                if ($uKey == 'whatsapp') $udata['whatsapp'] = Helper::cleanPhone($whatsapp);
                if ($uKey == 'phone') $udata['phone'] = Helper::cleanPhone($phone);
            endforeach;


        }
    }

    function forgotPassword(){
        $email ='kunvar.preet@gmail.co';
        if(empty($email)) {
            http_response_code(401);
            $ReturnError['Code']='401';
            $ReturnError['Message']='User Email Required.';
            $Result = json_encode($ReturnError);
        } else {
            $Return = $this->Users->CheckUser($email, "", "");
          //  \Helper::print_array($Return);

            $jReturn['userid'] = $Return['userid'];
            $jReturn['name'] = $Return['name'];

            $Result = json_encode($jReturn);
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: ' . ($_GET['callback'] ? 'application/javascript' : 'application/json') . ';charset=UTF-8');
            echo isset($_GET['callback']) ? "/**/ typeof {$_GET['callback']} === 'function' && {$_GET['callback']}($Result)" : $Result;
        }

    }


} // end class