<?php
use App\Components\Items;


class Account extends Controller {

    function __construct() {
        parent::__construct();
         // Auth::handleLogin();   # Uncomment to secure.
        $this->view->Menu = $this->view->PartialView('menu');

        /* Required Dashboard CSS */
            $this->Styles[] = DASHBOARD_ASSETS. '/css/bootstrap.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/css/bootstrap-extended.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/css/colors.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/css/components.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/css/themes/dark-layout.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/css/themes/bordered-layout.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/css/themes/semi-dark-layout.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/css/core/vertical-menu.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/vendors/css/vendors.min.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/extensions/toastr.min.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/css/plugins/extensions/ext-component-toastr.css';
        /* Required Dashboard CSS */

        /* Required Dashboard JavaScript */
            $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/vendors.min.js";
            $this->JavaScript[] = DASHBOARD_ASSETS . "/js/core/app-menu.js";
            $this->JavaScript[] = DASHBOARD_ASSETS . "/js/core/app.js";
            $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/extensions/toastr.min.js";
        /* Required Dashboard JavaScript */

    }

    function index() {

        // $this->JavaScript[] = DASHBOARD_ASSETS . "/js/account-index.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/js/custom.js";

        $this->view->JavaScript = $this->JavaScript;

        $this->Styles['commenta'] = '<!-- Page CSS -->';
        $this->Styles[] = DASHBOARD_ASSETS. '/css/plugins/forms/pickers/form-pickadate.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/css/plugins/forms/pickers/form-flat-pickr.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/css/plugins/forms/form-validation.css';

        /* Custom Page Css */
        $this->Styles[] = DASHBOARD_ASSETS. '/css/style.css';
        /* Custom Page Css */
            $this->view->Styles = $this->Styles;


        $this->view->render(('account/index'));
    }
	
    

}