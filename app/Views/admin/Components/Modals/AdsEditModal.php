<div class="modal fade" id="editAdsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="card">
                <div class="card-body">

                    <form id="editAdForm" enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <input type="hidden" name="id" id="editAdId">

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Ad Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <!-- Ad Type -->
                        <div class="mb-3">
                            <label class="form-label">Ad Type</label>

                            <select name="edit-ad-type" class="form-select edit-ad-type" required>
                                <option value="image">Image</option>
                                <option value="script">Script</option>
                            </select>
                        </div>
                        <!-- Pages -->
                        <div class="mb-3 pages-wrapper">

                            <label class="form-label d-block">Show On Pages</label>

                            <label class="me-3">
                                <input type="checkbox" name="pages[]" value="home"> Home
                            </label>

                            <label class="me-3">
                                <input type="checkbox" name="pages[]" value="category"> Category
                            </label>

                            <label class="me-3">
                                <input type="checkbox" name="pages[]" value="sub_category"> Sub Category
                            </label>

                            <label class="me-3">
                                <input type="checkbox" name="pages[]" value="child_category"> Child Category
                            </label>

                            <label class="me-3">
                                <input type="checkbox" name="pages[]" value="post"> Post
                            </label>

                            <label class="me-3">
                                <input type="checkbox" name="pages[]" value="tag"> Tag
                            </label>

                            <label class="me-3">
                                <input type="checkbox" name="pages[]" value="search"> Search
                            </label>

                        </div>

                        <!-- Position -->
                        <div class="position-wrapper mb-3">

                            <label class="form-label d-block">Position</label>

                            <label class="me-3">
                                <input type="checkbox" class="edit-position-check" value="block"> Block
                            </label>

                            <label class="me-3">
                                <input type="checkbox" class="edit-position-check" value="top"> Top
                            </label>

                            <label class="me-3">
                                <input type="checkbox" class="edit-position-check" value="left"> Left
                            </label>

                            <label class="me-3">
                                <input type="checkbox" class="edit-position-check" value="right"> Right
                            </label>

                            <label class="me-3">
                                <input type="checkbox" class="edit-position-check" value="bottom"> Bottom
                            </label>

                        </div>
                        <!-- Script -->
                        <div class="script-wrapper mb-3 d-none">
                            <label class="form-label">Ad Script</label>
                            <textarea name="script" class="form-control" rows="4"></textarea>
                        </div>
                        <!-- Dynamic images -->
                        <div id="editPositionImages"></div>

                        <button type="submit" class="btn btn-primary">
                            Update Ad
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>