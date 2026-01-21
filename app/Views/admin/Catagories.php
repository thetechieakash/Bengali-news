<?= $this->extend('layouts\AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<style>
    .table th,
    .jsgrid .jsgrid-table th,
    .table td,
    .jsgrid .jsgrid-table td {
        vertical-align: middle;
        line-height: 1;
        white-space: nowrap;
        padding: 3px;
        height: unset !important;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card" id="addcatcard">
            <div class="card-body">
                <h4 class="card-title">Add catagories</h4>
                <!-- <p class="card-description">
                    Basic form layout
                </p> -->
                <form class="forms-sample" id="catform" action="<?= base_url('admin/catagories') ?>" method="post">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" name="category" id="category" placeholder="Category Name">
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center gap-2">
                            <label class="toggle-switch mb-0">
                                <input type="checkbox" name="status">
                                <span class="slider"></span>
                            </label>
                            <span>In navbar?</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white me-2">Submit</button>
                </form>

            </div>
        </div>
        <div class="card d-none" id="addsubcatcard">
            <div class="card-body">
                <h4 class="card-title">Add Sub Catagories</h4>
                <!-- <p class="card-description">
                    Basic form layout
                </p> -->
                <form class="forms-sample" id="catform" action="<?= base_url('admin/sub-catagories') ?>" method="post">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" name="category" id="category" placeholder="Category Name">
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center gap-2">
                            <label class="toggle-switch mb-0">
                                <input type="checkbox" name="status">
                                <span class="slider"></span>
                            </label>
                            <span>In navbar?</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white me-2">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($cats)): ?>
                    <h4 class="card-title">All Catagories</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <div id="order-listing_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="order-listing_length">
                                                <label>Show <select name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control">
                                                        <option value="5">5</option>
                                                        <option value="10">10</option>
                                                        <option value="15">15</option>
                                                        <option value="-1">All</option>
                                                    </select> entries
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="order-listing_filter" class="dataTables_filter"><label><input type="search" class="form-control" placeholder="Search" aria-controls="order-listing"></label></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="order-listing" class="table dataTable no-footer" aria-describedby="order-listing_info">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order #: activate to sort column descending" style="width: 66.1094px;">SL #</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Purchased On: activate to sort column ascending" style="width: 110.938px;">Catagory name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Customer: activate to sort column ascending" style="width: 80.5312px;">Active in Navbar</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 71px;">Status</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 65.4844px;">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $sl = 0; ?>
                                                    <?php foreach ($cats as $cat): ?>
                                                        <?php $sl++; ?>
                                                        <tr class="odd">
                                                            <td class="sorting_1"><?= $sl ?></td>
                                                            <td><?= $cat['cat'] ?></td>
                                                            <td>
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <label class="toggle-switch mb-0">
                                                                        <input type="checkbox" name="is_active"
                                                                            class="toggle-is-active"
                                                                            data-id="<?= $cat['id'] ?>"
                                                                            <?= $cat['is_active'] == 1 ? 'checked' : '' ?>>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <label class="toggle-switch mb-0">
                                                                        <input type="checkbox" name="activestatus"
                                                                            class="toggle-status"
                                                                            data-id="<?= $cat['id'] ?>"
                                                                            <?= $cat['status'] == 1 ? 'checked' : '' ?>>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-outline-primary m-0 editBtn" data-id="<?= $cat['id'] ?>"
                                                                    data-name="<?= $cat['cat'] ?>"
                                                                    data-slug="<?= $cat['slug'] ?>"
                                                                    data-status="<?= $cat['status'] ?>"
                                                                    data-navbar="<?= $cat['is_active'] ?>">Edit</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                                                <ul class="pagination">
                                                    <li class="paginate_button page-item previous disabled" id="order-listing_previous"><a aria-controls="order-listing" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a></li>
                                                    <li class="paginate_button page-item active"><a href="#" aria-controls="order-listing" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                                    <li class="paginate_button page-item next disabled" id="order-listing_next"><a aria-controls="order-listing" aria-disabled="true" role="link" data-dt-idx="next" tabindex="-1" class="page-link">Next</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning mb-0" role="alert">
                        Catagories are empty!
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ">
                <input type="hidden" id="cat_id">
                <input type="hidden" id="cat_slug">
                <div class="form-group">
                    <label for="cat_name">Category Name</label>
                    <input type="text" class="form-control" id="cat_name" placeholder="Category Name">
                </div>
                <div class="card">
                    <div class="card-body my-0">
                        <h4 class="card-title">Add new sub catagories</h4>
                        <div class="form-group">
                            <label for="sub_cat_name">Sub Category Name</label>
                            <input type="text" class="form-control" id="sub_cat_name" placeholder="Category Name">
                        </div>
                        <div class="form-group">
                            <div class="d-flex align-items-center gap-2">
                                <label class="toggle-switch mb-0">
                                    <input type="checkbox" name="status">
                                    <span class="slider"></span>
                                </label>
                                <span>In navbar?</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="addSubCatBtn">Add Sub Category</button>
                <button class="btn btn-danger" id="deleteBtn">Delete</button>
                <button class="btn btn-primary" id="updateBtn">Update</button>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/js/dashboard-crm.js"></script>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        const catForm = $('#catform');
        if (catForm) {
            catForm.on('submit', async (e) => {
                e.preventDefault();
                try {
                    // console.log(catForm.attr('action'));
                    const formData = new FormData(catForm[0]);
                    const sendData = await fetch('<?= base_url('admin/catagories') ?>', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    const resp = await sendData.json();
                    console.log(formData);

                    if (!resp.success) {
                        console.log('Error:', resp);
                        if (typeof resp.errors == "object") {
                            Object.values(resp.errors).forEach(key => {
                                showDangerToast(key)
                            })
                            catForm[0].reset();
                        }
                    } else {
                        console.log('Success:', resp);
                        showSuccessToast(resp.message)
                        catForm[0].reset();
                    }
                } catch (error) {
                    console.error('Fetch error', error);
                }
            });
        }
        const catagoryItems = $('.catagory-items');

        catagoryItems.on('click', function(e) {
            e.preventDefault()
            console.log(this);
            $('#addcatcard').addClass('d-none');
            $('#addsubcatcard').removeClass('d-none');
        });

        // Open modal function 
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');
            let name = $(this).data('name');
            let slug = $(this).data('slug');
            let status = $(this).data('status');
            let navbar = $(this).data('navbar');

            $('#cat_id').val(id);
            $('#cat_name').val(name);
            $('#cat_slug').val(slug);
            $('#cat_status').val(status);
            $('#cat_navbar').val(navbar);

            $('#editModal').modal('show');
        });

        // Toggle function

        $('.toggle-is-active').click(async function(e) {
            const element = $(this);
            console.log(element);

            let isActive = true
            let id = $(this).data('id');
            let value = $(this).is(':checked') ? 1 : 0;

            if (!confirm('Are you sure you want to update ?')) {
                e.preventDefault();
                return
            };
            try {
                const sendData = await fetch('<?= base_url('admin/category/update-active') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        value
                    })
                });
                const data = await sendData.json();

                if (data.success) {
                    showSuccessToast(data.message);
                } else {
                    showDangerToast(data.message);
                }

            } catch (error) {
                console.error('Active ajax error', error);
                showDangerToast('Something went wrong, try again later');
            }
        });

        $('.toggle-status').click(async function() {

            let id = $(this).data('id');
            let value = $(this).is(':checked') ? 1 : 0;

            if (!confirm('Are you sure you want to update status?')) {
                e.preventDefault();
                return
            };
            try {
                const sendData = await fetch('<?= base_url('admin/category/update-status') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        value
                    })
                });
                const data = await sendData.json();

                if (data.success) {
                    showSuccessToast(data.message);
                } else {
                    showDangerToast(data.message);
                }

            } catch (error) {
                console.error('Active ajax error', error);
                showDangerToast('Something went wrong, try again later');
            }
        });

        // Update functions 

        $('#updateBtn').click(async function(e) {
            let id = $('#cat_id').val();
            let slug = $('#cat_slug').val();
            let newCatName = $('#cat_name').val();
            if (!confirm('Are you sure you want to update catagory?')) {
                e.preventDefault();
                return;
            }
            try {
                const response = await fetch("<?= base_url('admin/catagory/update') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        slug,
                        newCatName
                    }),
                });
                const data = await response.json();
                if (data.success) {
                    showSuccessToast(data.message);
                } else {
                    showDangerToast(data.message);
                }
            } catch (error) {
                console.error('Update ajax error', error);
                showDangerToast('Something went wrong, try again later');
            }
        })
        // Catagory delete function 

        $('#deleteBtn').click(async function() {
            let id = $('#cat_id').val();
            if (!confirm('Are you sure you want to delete?')) return;
            try {
                const sendData = await fetch("<?= base_url('admin/category/delete') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id
                    })
                });

                const data = await sendData.json();

                if (data.success) {
                    showSuccessToast(data.message);
                    // location.reload(); // optional
                } else {
                    showDangerToast(data.message);
                }

            } catch (error) {
                console.error('Delete ajax error', error);
                showDangerToast('Something went wrong, try again later');
            }
        });
    });
</script>
<?= $this->endSection() ?>