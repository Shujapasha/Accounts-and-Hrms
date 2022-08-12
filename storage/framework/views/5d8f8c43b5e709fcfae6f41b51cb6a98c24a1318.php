<!-- [ Main Content ] end -->
<footer class="dash-footer">
    <div class="footer-wrapper">
        <div class="py-1">
            <span class="text-muted">  <?php echo e((Utility::getValByName('footer_text')) ? Utility::getValByName('footer_text') :  __('Copyright AccountGo SaaS')); ?> <?php echo e(date('Y')); ?></span>
        </div>
        <div class="py-1">
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        </div>
    </div>
</footer>



<!-- Warning Section Ends -->
<!-- Required Js -->
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.form.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/perfect-scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/dash.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/plugins/datepicker-full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/dropzone-amd-module.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/plugins/choices.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/plugins/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/simple-datatables.js')); ?>"></script>

<!-- sweet alert Js -->



<!--Botstrap switch-->
<script src="<?php echo e(asset('assets/js/plugins/bootstrap-switch-button.min.js')); ?>"></script>


<!-- Apex Chart -->
<script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/flatpickr.min.js')); ?>"></script>

<script src="<?php echo e(asset('js/custom.js')); ?>"></script>

<?php if($message = Session::get('success')): ?>
    <script>
        show_toastr('success', '<?php echo $message; ?>');
    </script>
<?php endif; ?>
<?php if($message = Session::get('error')): ?>
    <script>
        show_toastr('error', '<?php echo $message; ?>');
    </script>
<?php endif; ?>
<?php echo $__env->yieldPushContent('script-page'); ?>




<script>

    feather.replace();
    // var pctoggle = document.querySelector("#pct-toggler");
    // if (pctoggle) {
    //     pctoggle.addEventListener("click", function () {
    //         if (
    //             !document.querySelector(".pct-customizer").classList.contains("active")
    //         ) {
    //             document.querySelector(".pct-customizer").classList.add("active");
    //         } else {
    //             document.querySelector(".pct-customizer").classList.remove("active");
    //         }
    //     });
    // }

    // var themescolors = document.querySelectorAll(".themes-color > a");
    // for (var h = 0; h < themescolors.length; h++) {
    //     var c = themescolors[h];
    //
    //     c.addEventListener("click", function (event) {
    //         var targetElement = event.target;
    //         if (targetElement.tagName == "SPAN") {
    //             targetElement = targetElement.parentNode;
    //         }
    //         var temp = targetElement.getAttribute("data-value");
    //         removeClassByPrefix(document.querySelector("body"), "theme-");
    //         document.querySelector("body").classList.add(temp);
    //     });
    // }

    // var custthemebg = document.querySelector("#cust-theme-bg");
    // custthemebg.addEventListener("click", function () {
    //     if (custthemebg.checked) {
    //         document.querySelector(".dash-sidebar").classList.add("transprent-bg");
    //         document
    //             .querySelector(".dash-header:not(.dash-mob-header)")
    //             .classList.add("transprent-bg");
    //     } else {
    //         document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
    //         document
    //             .querySelector(".dash-header:not(.dash-mob-header)")
    //             .classList.remove("transprent-bg");
    //     }
    // });



    function removeClassByPrefix(node, prefix) {
        for (let i = 0; i < node.classList.length; i++) {
            let value = node.classList[i];
            if (value.startsWith(prefix)) {
                node.classList.remove(value);
            }
        }
    }
</script>
<?php /**PATH C:\xampp\htdocs\newaccounts\resources\views/partials/admin/footer.blade.php ENDPATH**/ ?>