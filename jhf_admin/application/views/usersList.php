<?php include("common/header.php"); ?>


      <main id="main" class="main">
         <div class="pagetitle">
            <h1>User</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">User</li>
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
                    
                    
                <div class="recent-listing-area">
                        <div class="recent-listing-table">
                            <table class="eg-table2" id="example">
                                <thead>
                                    <tr>
                                       
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Telegram</th>
                                        <th>Twitter</th>
                                        <th>Instagram</th>
                                        <th>Wallet Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($users){
                                      
                                        foreach($users as $key => $user){
                                            ?>
                                            <tr>
                                              
                                                <td><?=$user->full_name?></td>
                                                <td><?=$user->email?></td>
                                                <td><?=$user->phone_number?></td>
                                                <td><?=$user->telegram?></td>
                                                <td><?=$user->twitter?></td>
                                                <td><?=$user->instagram?></td>
                                                <td><?=$user->wallet_address?></td>
                                                
                                                <td style="display: flex;">
                                                   <a href="<?= base_url('admin/users/edit/' . $user->user_id) ?>" > <i class="fa fa-edit" style="font-size:22px; cursor: pointer;"></i> </a>
                                                    <sapn style="padding-left:20px;"></sapn> 
                                                    <a href="<?= base_url('admin/users/delete/' . $user->user_id) ?>" 
                                                       class="btn btn-danger" 
                                                       onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class="fa fa-trash" style="font-size:22px"></i></a>
                                                    
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 </div>
                    </div>
                </div>
            </div>
         </section>
      </main>
<script  type="text/javascript">
     
    $(document).ready( function () {
          $('#example').dataTable();
    } );
</script>
        
<?php include("common/footer.php"); ?>
     