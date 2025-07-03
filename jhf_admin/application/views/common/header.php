<!DOCTYPE html> 
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Dashboard - J Home Furnishings</title>
      <meta content="" name="description">
      <meta content="" name="keywords">
      <!-- Favicons --> 
      <link href="<?= base_url() ?>assets/admin/img/favicon.png" rel="icon">
      <link href="<?= base_url() ?>assets/admin/img/apple-touch-icon.png" rel="apple-touch-icon">
      <!-- Google Fonts --> 
      <link href="https://fonts.gstatic.com" rel="preconnect">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <!-- Vendor CSS Files --> 
      <link href="<?= base_url() ?>assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?= base_url() ?>assets/admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
      <link href="<?= base_url() ?>assets/admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="<?= base_url() ?>assets/admin/vendor/quill/quill.snow.css" rel="stylesheet">
      <link href="<?= base_url() ?>assets/admin/vendor/quill/quill.bubble.css" rel="stylesheet">
      <link href="<?= base_url() ?>assets/admin/vendor/remixicon/remixicon.css" rel="stylesheet">
      <link href="<?= base_url() ?>assets/admin/vendor/simple-datatables/style.css" rel="stylesheet">
      <!-- Template Main CSS File --> 
      <link href="<?= base_url() ?>assets/admin/css/style.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>



      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <script type="text/javascript" src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
      
      
      <!-- ======================================================= * Template Name: NiceAdmin * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ * Updated: Apr 20 2024 with Bootstrap v5.3.3 * Author: BootstrapMade.com * License: https://bootstrapmade.com/license/ ======================================================== --> 
   </head>
   <body>
       
       <?php
$current_url = current_url(); // Get the current URL.
?>

      <!-- ======= Header ======= --> 
      <header id="header" class="header fixed-top d-flex align-items-center">
         <div class="d-flex align-items-center justify-content-between">
              <a href="<?=base_url()?>dashboard" class="logo d-flex align-items-center"> <img src="<?= base_url() ?>assets/admin/img/logo.png" alt="">
              <!--<span class="d-none d-lg-block">J Home Furnishings</span>-->
              </a></div>
         <!-- End Logo --> 
         <!--<div class="search-bar">-->
         <!--   <form class="search-form d-flex align-items-center" method="POST" action="#"> <input type="text" name="query" placeholder="Search" title="Enter search keyword"> <button type="submit" title="Search"><i class="bi bi-search"></i></button> </form>-->
         <!--</div>-->
         <!-- End Search Bar --> 
         <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
               <li class="nav-item d-block d-lg-none"> <a class="nav-link nav-icon search-bar-toggle " href="#"> <i class="bi bi-search"></i> </a> </li>
               <!-- End Search Icon--> 
              
              <?php if(isset($this->session->userdata['is_admin_login'])) { ?>
               <li class="nav-item dropdown pe-3">
                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"> 
                  <img src="<?=base_url()?>assets/admin/img/admin_logo.png" alt="Profile" class="rounded-circle">
                  <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span> </a>
                  <!-- End Profile Iamge Icon --> 
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                 <li> <a class="dropdown-item d-flex align-items-center" href="<?=base_url()?>admin/logout"> <i class="bi bi-box-arrow-right"></i> <span>Sign Out</span> </a> </li>
                  </ul>
                  <!-- End Profile Dropdown Items --> 
               </li>
               <?php } ?>
               <!-- End Profile Nav --> 
            </ul>
         </nav>
         <!-- End Icons Navigation --> 
      </header>
            <!-- End Header --> <!-- ======= Sidebar ======= --> 
            <?php if(isset($this->session->userdata['is_admin_login'])) { ?>
      <aside id="sidebar" class="sidebar">
         <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item"> <a class="nav-link <?= strpos($current_url, 'admin') && !strpos($current_url, 'catalogs') && !strpos($current_url, 'category') && !strpos($current_url, 'products')  && !strpos($current_url, 'contact-us') ? '' : 'collapsed' ?>" href="<?=base_url()?>dashboard"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a> </li>
            <!-- End Dashboard Nav --> 
            <li class="nav-item"> <a class="nav-link  <?= strpos($current_url, 'catalogs') ? '' : 'collapsed' ?>" href="<?=base_url()?>catalogs"> <i class="bi bi-file-earmark-pdf"></i><span>Catalogs</span> </a> </li>
            <!-- End Profile Page Nav --> 
            <li class="nav-item"> <a class="nav-link  <?= strpos($current_url, 'category') ? '' : 'collapsed' ?>" href="<?=base_url()?>category"> <i class="bi bi-list"></i> <span>Category</span> </a> </li>
            <li class="nav-item"> <a class="nav-link  <?= strpos($current_url, 'sub_category') ? '' : 'collapsed' ?>" href="<?=base_url()?>sub_category"> <i class="bi bi-list"></i> <span>Sub Category</span> </a> </li>            
             <li class="nav-item"> <a class="nav-link  <?= strpos($current_url, 'products') ? '' : 'collapsed' ?>" href="<?=base_url()?>products"><i class="bi bi-cart4"></i> <span>Products</span> </a> </li>
             <li class="nav-item"> <a class="nav-link  <?= strpos($current_url, 'contact-us') ? '' : 'collapsed' ?>" href="<?=base_url()?>contact-us"> <i class="bi bi-person-vcard"></i> <span>Contact Us</span> </a> </li>
          
         </ul>
      </aside>
       <?php } ?>
      <!-- End Sidebar--> 