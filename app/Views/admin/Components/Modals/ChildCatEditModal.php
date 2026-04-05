<div class="modal fade" id="editChildCatModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Child Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="childCatUpdate">
                    <?= csrf_field() ?>
                    <!-- Hidden ID -->
                    <input type="hidden" id="edit_child_id">
                    <div class="form-group mb-3">
                        <label for="edit_category_id">Select Category</label>
                        <select class="form-control" id="edit_category_id" name="edit_category_id">
                            <option value="">Select Category</option>
                            <?php foreach ($allCats as $cat): ?>
                                <option value="<?= $cat['id'] ?>">
                                    <?= esc($cat['cat']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_subcategory_id">Select Sub Category</label>
                        <select class="form-control" id="edit_subcategory_id" name="edit_subcategory_id">
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>
                    <!-- Child Category Name -->
                    <div class="form-group mb-3">
                        <label for="edit_child_cat_name">Child Category Name</label>
                        <input type="text" class="form-control" id="edit_child_cat_name" name="edit_child_cat_name">
                    </div>
                    <!-- Slug -->
                    <div class="form-group mb-3">
                        <label for="edit_child_cat_slug">Slug</label>
                        <input type="text" class="form-control" id="edit_child_cat_slug" name="edit_child_cat_name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateChildCatBtn">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>