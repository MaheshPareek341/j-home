<?php include("common/header.php"); ?>


      <main id="main" class="main">
         <div class="pagetitle">
            <h1>Catalogs</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>cmsadmin/dashboard"">Home</a></li>
                  <li class="breadcrumb-item active">Catalogs</li>
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
                <div class="col-md-12" style="text-align: right; padding: 20px;">
                   
                       <a type="button" class="btn btn-primary" href="<?= base_url('catalogs/add') ?>">Add Catalogs</a>
                </div>
             
                
                <div class="col-md-12">
                    <div class="my-listing-table-wrapper">
                        <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="active" role="tabpanel" aria-labelledby="active-tab">
                    
                    
                <div class="recent-listing-area">
                        <div class="recent-listing-table" style="width:100%;overflow: scroll;">
                            <table class="eg-table2" id="example">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Catalogs Name</th>
                                         <th>PDF</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($catalogs){
                                        foreach($catalogs as $cat){
                                            ?>
                                            <tr>
                                             <td><?php if(!empty($cat->image)) { ?>
                                        
                                             <img src="../images/catalogs/<?=$cat->image?>" width="50"/>
                                             <?php }?></td>
                                                <td><?=$cat->name?></td>
                                                <td>
                                                 <a href="<?php echo base_url('../../newweb/images/catalogs/' . $cat->pdf); ?>" target="_blank">View PDF</a>
                                                </td>
                                                <td>
                                                   <a href="<?= base_url('catalogs/edit/' . $cat->id) ?>" > <i class="fa fa-edit" style="font-size:22px; cursor: pointer;"></i> </a>
                                                    <sapn style="padding-left:20px;"></sapn> 
                                                    <a href="<?= base_url('catalogs/delete/' . $cat->id) ?>" 
                                                       class="btn btn-danger" 
                                                       onclick="return confirm('Are you sure you want to delete this catalogs?')">
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
     
        
        
        
       
        
        
    </div>

      <script  type="text/javascript">
     
     $(document).ready( function () {
          $('#example').dataTable();
        } );
    
    
</script>
<?php include("common/footer.php"); ?>
     