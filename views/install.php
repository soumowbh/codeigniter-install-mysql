<!DOCTYPE HTML>
<html>
<head>
    <?php $this->load->view('includes/meta'); ?>
	<script type="text/javascript">
    AppHelper = {};
    AppHelper.baseUrl = "<?php echo base_url(); ?>";
    AppHelper.assetsDirectory = "<?php echo base_url("assets") . "/"; ?>";
    AppHelper.settings = {};
    AppHelper.all = "<?php echo lang("all"); ?>";
</script>
	<?php
    load_css(array(
        "assets/bootstrap/css/bootstrap.min.css",
        "assets/js/font-awesome/css/font-awesome.min.css",
        "assets/js/datatable/css/jquery.dataTables.min.css",
        "assets/js/datatable/TableTools/css/dataTables.tableTools.min.css",
        "assets/js/select2/select2.css",
        "assets/js/select2/select2-bootstrap.min.css",
        "assets/js/bootstrap-datepicker/css/datepicker3.css",
        "assets/js/bootstrap-timepicker/css/bootstrap-timepicker.min.css",
        "assets/js/x-editable/css/bootstrap-editable.css",
        "assets/js/dropzone/dropzone.min.css",
        "assets/js/magnific-popup/magnific-popup.css",
        "assets/css/font.css",
        "assets/css/style.css",
        "assets/css/custom-style.css",
        "assets/js/jquery-internationalphone/css/intlTelInput.css",
    ));
    load_js(array(
        "assets/js/jquery-1.11.3.min.js",
        "assets/bootstrap/js/bootstrap.min.js",
        "assets/js/jquery-validation/jquery.validate.min.js",
        "assets/js/jquery-validation/jquery.form.js",
        "assets/js/slimscroll/jquery.slimscroll.min.js",
        "assets/js/datatable/js/jquery.dataTables.min.js",
        "assets/js/select2/select2.js",
        "assets/js/datatable/TableTools/js/dataTables.tableTools.min.js",
        "assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js",
        "assets/js/bootstrap-timepicker/js/bootstrap-timepicker.min.js",
        "assets/js/x-editable/js/bootstrap-editable.min.js",
        "assets/js/fullcalendar/moment.min.js",
        "assets/js/dropzone/dropzone.min.js",
        "assets/js/magnific-popup/jquery.magnific-popup.min.js",
        "assets/js/notificatoin_handler.js",
        "assets/js/general_helper.js",
        "assets/js/app.js",
        "assets/js/jquery-internationalphone/js/utils.js",
        "assets/js/jquery-internationalphone/js/intlTelInput.js"
    ));
    ?>
    <script>function redirect() {
        <?php if(check_database()){ ?>
        window.location.replace("<?php echo base_url();?>");
        <?php } ?>  
        }
    </script>
	</head>
	<body onLoad="redirect()">
<div id="page-content" class="clearfix" >
    <div class="scrollable-page">
        <div class="signin-box">
            <div class="panel panel-default clearfix" style="padding-top:20px">
                <div style="text-align:center">
                    <img src="<?php echo base_url("/files/system/_file59b68d56ebdad-site-logo.png") ?>" alt="Mind.Engineering"><hr>
                </div>
                <div class="panel-heading text-center">
                    <h2 class="form-signin-heading"><?php echo lang('install_title'); ?></h2>
                    <p><?php echo $install_message; ?></p>
                </div>
                <div class="panel-body">
					<?php echo form_open("exec", array("id" => "install-form", "class" => "general-form", "role" => "form")); ?>
					<input type="hidden" name="load" value="1" />
                    <div class="form-group">
                        <div class=" col-md-12">
                            <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo lang('install'); ?></button>
                        </div>
                    </div>
                </div>
				<?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div> <!-- /container -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#install-form").appForm({
            isModal: false,
            onSubmit: function() {
                appLoader.show();
            },
            onSuccess: function(result) {
                appLoader.hide();
                appAlert.success(result.message, {container: '.panel-body', animate: false});
                $("#install-form").remove();
                window.location.replace("<?php echo base_url();?>");
            },
            onError: function(result) {
                appLoader.hide();
                appAlert.error(result.message, {container: '.panel-body', animate: false});
                return false;
            }
        });
    });
</script>
</body>
</html>