<div class="modal fade" id="editCatModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cat_name">Category Name</label>
                                <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Category Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cat_slug">Slug</label>
                                <input type="text" class="form-control" id="cat_slug" name="cat_slug" placeholder="Slug Name">
                            </div>
                        </div>
                    </div>
                    <div class="card" id="addsubcatform">
                        <div class="card-body my-0">
                            <h4 class="card-title">Add new sub catagories</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sub_cat_name">Sub Category Name</label>
                                        <input type="text" class="form-control" id="sub_cat_name" name="sub_cat_name" placeholder="Sub Category Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sub_cat_slug">Sub Category Slug</label>
                                        <input type="text" class="form-control" id="sub_cat_slug" name="sub_cat_slug" placeholder="Sub Category Slug">
                                    </div>
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