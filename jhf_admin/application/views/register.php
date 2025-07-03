<style>
    .success-msg {
          color: #270;
          background-color: #DFF2BF;
          padding:6px;
        }
</style>
<?php include "common/frontend/header.php" ?>
	<div data-elementor-type="wp-page" data-elementor-id="17024" class="elementor elementor-17024"
		data-elementor-post-type="page">
		<div class="elementor-element elementor-element-7c3221c4 e-flex e-con-boxed e-con e-parent" data-id="7c3221c4"
			data-element_type="container">
			<div class="e-con-inner" style="padding-top:5%">
		
			<form method="post" class="form-outer" action="<?=base_url()?>admin/add_user">
		    <?php if(@$_GET['msg']=='success') { ?>
			<div class="success-msg">
                <i class="fa fa-check"></i>
                AirDrop Registration successfully, Our representative will contact you soon
            </div>
            <?php } ?>
			    <div class="row"><h2 style="text-align:center; color:white; width:100%"><a href="register.php">Register for Airdrop</a></h2></div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Name<span>*</span></label>
                        <input type="text" name="full_name" tabindex="1" class="first-name" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Email<span>*</span></label>
                        <input type="email" class="email-display" name="email" tabindex="2" required="">
                    </div>
                    <div class="col-md-6">
                        <label>Phone<span></span></label>
                        <input type="text" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" class="phone" name="phone_number" tabindex="3" maxlength="20" required="">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <label>Your Telegram </label>
                        <input type="text" class="email-display" tabindex="4" name="telegram">
                    </div>
                    <div class="col-md-6">
                        <label>Your Twitter </label>
                        <input type="text" class="email-display" tabindex="5" name="twitter">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <label>Your Instagram </label>
                        <input type="text" class="email-display" tabindex="6" name="instagram">
                    </div>
                    <div class="col-md-6">
                        <label>Wallet Address</label>
                        <input type="text" class="email-display" tabindex="7" name="wallet_address">
                    </div>
                </div>
                <input type="submit" class="btn btn-hover iq-button multi-registration-submit" value="submit">
            </form>
			</div>
		</div>
	
	</div>
	<!--LWSOPTIMIZE_HERE_START_FOOTER-->
	<?php include "common/frontend/footer.php" ?>