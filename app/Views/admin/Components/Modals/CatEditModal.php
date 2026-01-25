<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ">
                <form id="newSubCat">
                    <?= csrf_field() ?>
                    <input type="hidden" id="cat_id">
                    <input type="hidden" id="cat_slug">
                    <div class="form-group">
                        <label for="cat_name">Category Name</label>
                        <input type="text" class="form-control" id="cat_name" placeholder="Category Name">
                    </div>
                    <div class="card" id="addsubcatform">
                        <div class="card-body my-0">
                            <h4 class="card-title">Add new sub catagories</h4>
                            <div class="form-group">
                                <label for="sub_cat_name">Sub Category Name</label>
                                <input type="text" class="form-control" id="sub_cat_name" name="sub_cat_name" placeholder="Category Name">
                            </div>
                            <div class="form-group">
                                <div class="d-flex align-items-center gap-2">
                                    <label class="toggle-switch mb-0">
                                        <input type="checkbox" name="sub_cat_status" id="sub_cat_status">
                                        <span class="slider"></span>
                                    </label>
                                    <span>In navbar?</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="addSubCatBtn">Add Sub Category</button>
                <button class="btn btn-primary" id="updateBtn">Update</button>
            </div>

        </div>
    </div>
</div>