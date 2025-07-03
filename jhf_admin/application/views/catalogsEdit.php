<?php include("common/header.php"); ?>


      <main id="main" class="main">
         <div class="pagetitle">
            <h1>Catalogs</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard">Home</a></li>
                  <li class="breadcrumb-item active"><a href="<?=base_url()?>catalogs">Catalogs</a></li>
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
                    
                                <form action="<?= base_url('catalogs/update/'.$catalogs['id']); ?>" method="post" enctype="multipart/form-data">
                                     <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control mt-1" id="name" name="name" value="<?=$catalogs['name']?>" required>
                                    </div>
                                     <br />
                                     <div class="form-group">
                                        <label for="image">Image</label>
                                        <?php if(!empty($catalogs['image'])) { ?>
                                        <br />
                                         <img src="../../../images/catalogs/<?=$catalogs['image'];?>" width="50"/> <br />
                                         <?php } ?>
                                        <input type="file" name="image" accept="image/*" />
                                      
                                    </div>
                                    
                                    <br />
                                    <div class="form-group">
                                        <label for="pdf">PDF</label>
                                         <br />
                                        <?php if(!empty($catalogs['pdf'])) { ?>
                                         <a href="<?php echo base_url('../../newweb/images/catalogs/' . $catalogs['pdf']); ?>" target="_blank">View PDF</a><br />
                                         <?php } ?>
                                        <input type="file" name="pdf" accept="application/pdf" />
                                      
                                    </div>
                                    
                            
                                   <div class="form-group">
                            <br />
                                    <button type="submit" class="btn btn-primary">Update Catalogs</button>
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