<?php include("common/header.php"); ?>
    <style>
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .image-preview-wrapper {
            position: relative;
            display: inline-block;
        }
        .image-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .remove-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            cursor: pointer;
            font-size: 12px;
        }
    </style>

      <main id="main" class="main">
         <div class="pagetitle">
            <h1>Product</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard">Home</a></li>
                  <li class="breadcrumb-item active"><a href="<?=base_url()?>products">Products</a></li>
                  <li class="breadcrumb-item active">Add</li>
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
                    
                        <form action="<?= base_url('products/save_products'); ?>" method="post" enctype="multipart/form-data">
                            <!-- Product Name -->
                            <div class="form-group mb-3">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control mt-1" id="product_name" name="product_name" value="" required>
                            </div>

                            <!-- Multiple Image Upload -->
                            <div class="form-group mb-3">
                                <label for="images">Images (Select multiple)</label>
                                <input type="file" class="form-control mt-1" id="images" name="images[]" accept="image/*" multiple required>
                                <div id="image-preview" class="image-preview-container"></div>
                            </div>

                            <!-- Item Code -->
                            <div class="form-group mb-3">
                                <label for="item_code">Item Code</label>
                                <input type="text" class="form-control mt-1" id="item_code" name="item_code" value="" required>
                            </div>

                            <!-- Size -->
                            <div class="form-group mb-3">
                                <label for="size">Size</label>
                                <input type="text" class="form-control mt-1" id="size" name="size" value="" required>
                            </div>

                            <!-- Material -->
                            <div class="form-group mb-3">
                                <label for="material">Material</label>
                                <input type="text" class="form-control mt-1" id="material" name="material" value="" required>
                            </div>

                            <!-- Finish -->
                            <div class="form-group mb-3">
                                <label for="finish">Finish</label>
                                <input type="text" class="form-control mt-1" id="finish" name="finish" value="" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="category">Category</label>
                                <select class="form-control mt-1" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="dining_room">Dining Room</option>
                                    <option value="bedroom">Bedroom</option>
                                    <option value="occasional">Occasional</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Add Product</button>
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
<script>
        // Image preview and remove functionality
        const input = document.getElementById('images');
        const previewContainer = document.getElementById('image-preview');
        let files = [];

        input.addEventListener('change', function(event) {
            files = Array.from(event.target.files);
            updatePreview();
        });

        function updatePreview() {
            previewContainer.innerHTML = ''; // Clear previous previews

            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('image-preview-wrapper');

                    const img = document.createElement('img');
                    img.classList.add('image-preview');
                    img.src = URL.createObjectURL(file);

                    const removeBtn = document.createElement('button');
                    removeBtn.classList.add('remove-btn');
                    removeBtn.innerHTML = '×';
                    removeBtn.onclick = () => {
                        files.splice(index, 1); // Remove file from array
                        updateFileInput(); // Update file input
                        updatePreview(); // Refresh preview
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    previewContainer.appendChild(wrapper);
                }
            });
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            files.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        }
    </script>
<?php include("common/footer.php"); ?>