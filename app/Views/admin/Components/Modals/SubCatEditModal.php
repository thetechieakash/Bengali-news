<div class="modal fade" id="editSubCatModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ">
                <form id="newSubCat">
                    <?= csrf_field() ?>
                    <input type="hidden" id="sub_cat_id">
                    <input type="hidden" id="cat_id">
                    <input type="hidden" id="cat_slug">
                    <div class="form-group">
                        <label for="sub_cat_name">Category Name</label>
                        <input type="text" class="form-control" id="sub_cat_name" name="sub_cat_name" placeholder="Category Name">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" id="updateSubCatBtn">Update</button>
            </div>

        </div>
    </div>
</div>