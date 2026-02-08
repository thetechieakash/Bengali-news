<div class="modal fade" id="userEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ">
                <form class="pt-3" id="updateUser">
                    <?= csrf_field() ?>
                    <input type="hidden" id="user_id" name="userId">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" name="username" id="username"
                            placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" id="email">
                    </div>
                    <div class="form-group">
                        <select class="form-select form-select-lg" name="role" placeholder="Email" placeholder="Select role">
                            <option selected>Select role</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="admin">Admin</option>
                            <option value="author">Author</option>
                            <option value="user">user</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="New Password">
                    </div>
                    <div class="mt-3 d-grid gap-2">
                        <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit" id="updateBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>