<div class="modal fade" id="createChildCatModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Child Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="childCatUpdate">
                    <?= csrf_field() ?>
                    <input type="hidden" id="sub_cat_id">
                    <div class="form-group mb-3">
                        <label for="child_cat_name">Child Category Name</label>
                        <input type="text" class="form-control" id="child_cat_name" name="child_cat_name">
                    </div>
                    <!-- Slug -->
                    <div class="form-group mb-3">
                        <label for="child_cat_slug">Child Category Slug</label>
                        <input type="text" class="form-control" id="child_cat_slug" name="child_cat_name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="createChildCatBtn">
                    Create
                </button>
            </div>
        </div>
    </div>
</div>