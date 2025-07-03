<?php if(isset($this->session->userdata['is_admin_login'])) { redirect('admin/login'); }?>

<?php include "common/header.php" ?>
      <div class="container" >  
           <br /><br /><br />  
          
             <?php if ($this->session->flashdata('error')): ?>
                    <div style="width:50%;" class="alert <?= $this->session->flashdata('message_type') === 'success' ? 'alert-success' : 'alert-danger' ?>">
                        <?= $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>
                
           <form method="post" action="<?php echo base_url(); ?>admin/login_validation" style="padding:10% 30%;">  
               <div class="form-group">  
                     <label>Enter Username</label>  
                     <input type="text" name="username" class="form-control" required />  
                     <span class="text-danger"><?php echo form_error('username'); ?></span>                 
                </div>  
                <div class="form-group" style="padding-top:10px; ">  
                     <label>Enter Password</label>  
                     <input type="password" name="password" class="form-control"  required />  
                     <span class="text-danger"><?php echo form_error('password'); ?></span>  
                </div>  
                <div class="form-group" style="padding-top:30px; color:#fff;">  
                     <input type="submit" name="insert" value="Login" class="btn btn-info" style="width:200px; color:#fff;" />  
                    
                </div>
           </form>  
      </div>  
   <?php include("common/footer.php"); ?>