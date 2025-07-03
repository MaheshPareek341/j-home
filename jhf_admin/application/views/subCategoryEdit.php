<?php include("common/header.php"); ?>


      <main id="main" class="main">
         <div class="pagetitle">
            <h1>Sub Category</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard">Home</a></li>
                  <li class="breadcrumb-item active"><a href="<?=base_url()?>sub_category">Sub Category</a></li>
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
                    
                                <form action="<?= base_url('sub_category/update/'.$sub_category['id']); ?>" method="post" enctype="multipart/form-data">
                                     <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control mt-1" id="name" name="name" value="<?=$sub_category['name']?>" required>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label for="image">Category</label>
                                        <select class="form-control mt-1" name="category_id" required>
                                            <option>--Select Category --</option>
                                        <?php
                                            if(!empty($categories)) { 
                                                foreach($categories as $cat){
                                                    ?>
                                                    <option value="<?=$cat->id?>" <?php if($cat->id == $sub_category['category_id']) { echo "selected"; } ?> ><?=$cat->name?></option>
                                                    <?php
                                                }
                                            } 
                                        ?>
                                        </select>
                                      
                                    </div>
                                    
                            
                                   <div class="form-group">
                            <br />
                                    <button type="submit" class="btn btn-primary">Update Sub Category</button>
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