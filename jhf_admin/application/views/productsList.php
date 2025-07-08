<?php include("common/header.php"); ?>


      <main id="main" class="main">
         <div class="pagetitle">
            <h1>Products</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>cmsadmin/dashboard"">Home</a></li>
                  <li class="breadcrumb-item active">Products</li>
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
                   
                       <a type="button" class="btn btn-primary" href="<?= base_url('products/add') ?>">Add Product</a>
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
                                        <th>Product Name</th>
                                        <th>Item Code</th>
                                        <th>Size</th>
                                        <th>Material</th>
                                        <th>Finish</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                   if($products){
                                        foreach($products as $cat){
                                            ?>
                                            <tr>
                                               
                                                
                                                <td><?=$cat->name?></td>
                                                 <td><?=$cat->item_code?></td>
                                                 <td><?=$cat->size?></td>
                                                 <td><?=$cat->material?></td>
                                                 <td><?=$cat->finish?></td>
                                                <td>
                                                   <a href="<?= base_url('products/edit/' . $cat->id) ?>" > <i class="fa fa-edit" style="font-size:22px; cursor: pointer;"></i> </a>
                                                    <sapn style="padding-left:20px;"></sapn> 
                                                    <a href="<?= base_url('products/delete_products/' . $cat->id) ?>" 
                                                       class="btn btn-danger" 
                                                       onclick="return confirm('Are you sure you want to delete this product?')">
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