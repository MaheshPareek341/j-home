<?php include("common/header.php"); ?>

    <style>
        .form-group{
            padding-bottom:20px;
        }
    </style>
      <main id="main" class="main">
         <div class="pagetitle">
            <h1>Videos</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active"><a href="<?=base_url()?>admin/users">Users</a></li>
                  <li class="breadcrumb-item active">Edit</li>
               </ol>
            </nav>
         </div>
         <!-- End Page Title --> 
         <section class="section dashboard">

                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert <?= $this->session->flashdata('message_type') === 'success' ? 'alert-success' : 'alert-danger' ?>">
                        <?= $this->session->flashdata('message') ?>
                    </div>
                <?php endif; ?>
                
            <div class="row">
               
                <div class="col-md-12">
                    <div class="my-listing-table-wrapper">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="active" role="tabpanel" aria-labelledby="active-tab">
                    
                                <form action="<?= base_url('admin/users/update/'.$user['user_id']); ?>" method="post">
                                    <div class="form-group">
                                        <label for="full_name">Name *</label>
                                        <input type="text" class="form-control mt-1" id="full_name" name="full_name" value="<?= $user['full_name']; ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email">Email Id *</label>
                                        <input type="email" class="form-control mt-1" id="email" name="email" value="<?= $user['email']; ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" class="form-control mt-1" id="phone_number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="phone_number" value="<?= $user['phone_number']; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="telegram">Telegram</label>
                                        <input type="text" class="form-control mt-1" id="telegram" name="telegram" value="<?= $user['telegram']; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control mt-1" id="twitter" name="twitter" value="<?= $user['twitter']; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control mt-1" id="instagram" name="instagram" value="<?= $user['instagram']; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="wallet_address">Wallet Address</label>
                                        <input type="text" class="form-control mt-1" id="wallet_address" name="wallet_address" value="<?= $user['wallet_address']; ?>">
                                    </div>
                            
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update User</button>
                                    </div>
                                </form>

                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </section>
      </main>
     
        
        
    </div>

<?php include("common/footer.php"); ?>