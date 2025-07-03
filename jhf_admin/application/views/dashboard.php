<?php include("common/header.php"); ?>



      <main id="main" class="main">
         <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard"">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
               </ol>
            </nav>
         </div>
         <!-- End Page Title --> 
         <section class="section dashboard">
            <div class="row">
               <!-- Left side columns --> 
               <div class="col-lg-12">
                  <div class="row">
                     <!-- Sales Card --> 
                     <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                          <a href="<?=base_url()?>catalogs">
                           <div class="card-body">
                              <h5 class="card-title">Catalogs</h5>
                              <div class="d-flex align-items-center">
                                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-file-earmark-pdf"></i> </div>
                                 <div class="ps-3">
                                    <h6></h6>
                                 </div>
                              </div>
                           </div>
                            </a>
                        </div>
                     </div>
                     <!-- End Sales Card --> <!-- Revenue Card --> 
                     <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                         <a href="<?=base_url()?>category">
                           <div class="card-body">
                              <h5 class="card-title">Category</h5>
                              <div class="d-flex align-items-center">
                                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-list"></i> </div>
                                 <div class="ps-3">
                                    <h6></h6>
                                 </div>
                              </div>
                           </div>
                           </a>
                        </div>
                     </div>
                     
                     <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                         <a href="<?=base_url()?>products">
                           <div class="card-body">
                              <h5 class="card-title">Products</h5>
                              <div class="d-flex align-items-center">
                                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-cart4"></i> </div>
                                 <div class="ps-3">
                                    <h6></h6>
                                 </div>
                              </div>
                           </div>
                           </a>
                        </div>
                     </div>
                     
                     <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                         <a href="<?=base_url()?>contact-us">
                           <div class="card-body">
                              <h5 class="card-title">Contact Us</h5>
                              <div class="d-flex align-items-center">
                                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-person-vcard"></i> </div>
                                 <div class="ps-3">
                                    <h6></h6>
                                 </div>
                              </div>
                           </div>
                           </a>
                        </div>
                     </div>
                     <!-- End Revenue Card --> <!-- Customers Card --> 
                     
                  </div>
               </div>
               <!-- End Left side columns --> <!-- Right side columns --> 
              
            </div>
         </section>
      </main>
      </div>
<?php include("common/footer.php"); ?>
     