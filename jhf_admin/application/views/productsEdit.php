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
    .remove-btn, .remove-existing-btn {
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
    .existing-image {
        opacity: 0.8;
    }
</style>

<main id="main" class="main">
    <div class="pag-title">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('products') ?>">Products</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert <?= $this->session->flashdata('message_type') === 'success' ? 'alert-success' : 'alert-danger' ?>">
                <?= $this->session->flashdata('message') ?>
            </div>
        <?php endif; ?>

        <?php if (!isset($product) || empty($product)): ?>
            <div class="alert alert-danger">
                Product not found.
            </div>
            <a href="<?= base_url('products') ?>" class="btn btn-secondary">Back to Products</a>
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="my-listing-table-wrapper">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="active" role="tabpanel" aria-labelledby="active-tab">
                                <form action="<?= base_url('products/update_products/' . $product->id) ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="product_id" value="<?= $product->id ?>">

                                    <div class="form-group mb-3">
                                        <label for="name">Product Name</label>
                                        <input type="text" class="form-control mt-1" id="name" name="name" value="<?= htmlspecialchars($product->name) ?>" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Existing Images</label>
                                        <div id="existing-image-preview" class="image-preview-container">
                                            <?php if (!empty($product_images)): ?>
                                                <?php foreach ($product_images as $image): ?>
                                                    <div class="image-preview-wrapper">
                                                        <img src="<?= base_url('uploads/products/' . $image->image) ?>" class="image-preview existing-image" alt="Existing product image">
                                                        <button type="button" class="remove-existing-btn" data-image="<?= $image->image ?>" onclick="removeExistingImage(this)" aria-label="Remove existing image">×</button>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                        <input type="hidden" name="removed_images" id="removed_images" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="images">Add New Images (Select multiple, max 5)</label>
                                        <input type="file" class="form-control mt-1" id="images" name="images[]" accept="image/*" multiple>
                                        <div id="image-preview" class="image-preview-container"></div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="item_code">Item Code</label>
                                        <input type="text" class="form-control mt-1" id="item_code" name="item_code" value="<?= htmlspecialchars($product->item_code) ?>" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="size">Size</label>
                                        <input type="text" class="form-control mt-1" id="size" name="size" value="<?= htmlspecialchars($product->size) ?>" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="material">Material</label>
                                        <input type="text" class="form-control mt-1" id="material" name="material" value="<?= htmlspecialchars($product->material) ?>" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="finish">Finish</label>
                                        <input type="text" class="form-control mt-1" id="finish" name="finish" value="<?= htmlspecialchars($product->finish) ?>" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary">Update Product</button>
                                        <a href="<?= base_url('products') ?>" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <script>
        const input = document.getElementById('images');
        const previewContainer = document.getElementById('image-preview');
        let files = [];

        input.addEventListener('change', function(event) {
            if (event.target.files.length > 5) {
                alert('Maximum 5 images allowed.');
                input.value = '';
                files = [];
                updatePreview();
                return;
            }
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
                    img.alt = 'New product image preview';
                    img.onload = () => URL.revokeObjectURL(img.src); // Free memory

                    const removeBtn = document.createElement('button');
                    removeBtn.classList.add('remove-btn');
                    removeBtn.innerHTML = '×';
                    removeBtn.setAttribute('aria-label', 'Remove new image');
                    removeBtn.onclick = () => {
                        files.splice(index, 1);
                        updateFileInput();
                        updatePreview();
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

        let removedImages = [];
        function removeExistingImage(button) {
            const imageName = button.getAttribute('data-image');
            removedImages.push(imageName);
            document.getElementById('removed_images').value = JSON.stringify(removedImages);
            button.parentElement.remove();
        }

        // Client-side form validation
        document.querySelector('form').addEventListener('submit', function(event) {
            const submitBtn = document.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Updating...';
        });
    </script>
<?php include("common/footer.php"); ?>