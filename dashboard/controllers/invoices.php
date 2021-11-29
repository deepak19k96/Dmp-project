<?php
use App\Components\Items;


class Invoices extends Controller {

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
            $this->Styles[] = DASHBOARD_ASSETS. '/vendors/css/vendors.min.css';
            $this->Styles[] = DASHBOARD_ASSETS. '/css/core/vertical-menu.css';
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
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/extensions/moment.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/jquery.dataTables.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/datatables.buttons.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/dataTables.bootstrap5.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/datatables.checkboxes.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/responsive.bootstrap4.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/dataTables.responsive.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/js/pages/invoice-index.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/js/custom.js";
        $this->view->JavaScript = $this->JavaScript;


        $this->Styles['commenta'] = '<!-- Page CSS -->';
        $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/tables/datatable/dataTables.bootstrap5.min.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/tables/datatable/extensions/dataTables.checkboxes.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/tables/datatable/responsive.bootstrap4.min.css';

        $this->Styles[] = DASHBOARD_ASSETS. '/css/pages/invoice-index.css';

        /* Custom Page Css */
        $this->Styles[] = DASHBOARD_ASSETS. '/css/style.css';
        /* Custom Page Css */
            $this->view->Styles = $this->Styles;

        $this->view->render(('invoices/index'));
    }



    function edit($uid="") {
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/forms/repeater/jquery.repeater.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/pickers/flatpickr/flatpickr.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/js/pages/invoice-edit.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/js/custom.js";
        $this->view->JavaScript = $this->JavaScript;


        $this->Styles['commenta'] = '<!-- Page CSS -->';
        $this->Styles[] = DASHBOARD_ASSETS. '/css/plugins/forms/form-validation.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/css/plugins/forms/pickers/form-flat-pickr.min.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/pickers/flatpickr/flatpickr.min.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/forms/select/select2.min.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/css/pages/invoice-edit.css';

        /* Custom Page Css */
        $this->Styles[] = DASHBOARD_ASSETS. '/css/style.css';
        /* Custom Page Css */
        $this->view->Styles = $this->Styles;


        $this->view->render(('invoices/edit'));
    }


    function view($uid="") {
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/extensions/moment.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/jquery.dataTables.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/dataTables.bootstrap5.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/responsive.bootstrap4.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/dataTables.responsive.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/datatables.buttons.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/tables/datatable/buttons.bootstrap5.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/js/pages/invoice-edit.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/js/custom.js";
        $this->view->JavaScript = $this->JavaScript;

        $this->Styles['commenta'] = '<!-- Page CSS -->';
        $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/tables/datatable/dataTables.bootstrap5.min.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/tables/datatable/responsive.bootstrap4.min.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/tables/datatable/buttons.bootstrap5.min.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/css/pages/invoice-edit.css';

        /* Custom Page Css */
        $this->Styles[] = DASHBOARD_ASSETS. '/css/style.css';
        /* Custom Page Css */
        $this->view->Styles = $this->Styles;


        $this->view->render(('invoices/view'));
    }


    function add($uid="") {
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/forms/repeater/jquery.repeater.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/pickers/flatpickr/flatpickr.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/vendors/js/forms/select/select2.full.min.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/js/pages/invoice-edit.js";
        $this->JavaScript[] = DASHBOARD_ASSETS . "/js/custom.js";
        $this->view->JavaScript = $this->JavaScript;


        $this->Styles['commenta'] = '<!-- Page CSS -->';
        $this->Styles[] = DASHBOARD_ASSETS. '/css/plugins/forms/form-validation.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/css/plugins/forms/pickers/form-flat-pickr.min.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/pickers/flatpickr/flatpickr.min.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/vendors/js/forms/select/select2.min.css';
        $this->Styles[] = DASHBOARD_ASSETS. '/css/pages/invoice-edit.css';

        /* Custom Page Css */
        $this->Styles[] = DASHBOARD_ASSETS. '/css/style.css';
        /* Custom Page Css */
        $this->view->Styles = $this->Styles;


        $this->view->render(('invoices/add'));
    }

}