<div class="sidenav-overlay"></div>
<div class="drag-target"></div>


<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ms-25" href="#" target="_blank">CreditGuard</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    <hr>
    <h2>Session Testing</h2>
    <?php
    \Helper::print_array($_SESSION);
    ?>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<?php
    if($this->JavaScript) {
        foreach ($this->JavaScript as $kj => $JavaScript) :
            if(!is_numeric($kj)) {
                echo PHP_EOL;
                echo $JavaScript . PHP_EOL;
                continue;
            }
            echo '<script src="'. $JavaScript .'"></script>' . PHP_EOL;
        endforeach;
    }
?>


</body>
<!-- END: Body-->

</html>

