<div class="modal fade" id="editAdsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-body">
                    <form id="editAdForm" class="ad-form" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Ad Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <!-- Ad Type -->
                        <div class="mb-3">
                            <label class="form-label">Ad Type</label>
                            <select name="ad_type" id="ad_type" class="form-select select-type edit-ad-type" required>
                                <option value="image" selected>Image</option>
                                <option value="script">Script</option>
                            </select>
                        </div>
                        <div class="image-wrapper mb-3">
                            <label class="form-label">Ad Image</label>
                            <input type="file"
                                class="dropify"
                                id="updateimage"
                                name="image"
                                accept="image/*">
                        </div>
                        <div class="script-wrapper mb-3 d-none">
                            <label class="form-label">Ad Script</label>
                            <textarea name="script" class="form-control" rows="4"
                                placeholder="Paste ad script here..."></textarea>
                        </div>
                        <div class="url-wrapper mb-3">
                            <label class="form-label">Redirect URL (optional)</label>
                            <input type="url" name="redirect_url" class="form-control" placeholder="https://example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Show On Pages</label>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="home" id="uhomePage">
                                <label for="uhomePage">Home Page</label>
                            </div>
                            <div class=" form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="category" id="uCategoryPage">
                                <label for="uCategoryPage">Category Page</label>
                            </div>
                            <div class=" form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="sub_category" id="uSubCategoryPage">
                                <label for="uSubCategoryPage">Sub Category Page</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="post" id="uPostPage">
                                <label for="uPostPage">Post Page</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="tag" id="uTagPage">
                                <label for="uTagPage">Tag Page</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="search" id="uSearchPage">
                                <label for="uSearchPage">Search Page</label>
                            </div>
                        </div>
                        <div class="position-wrapper mb-3">
                            <label class="form-label d-block">Position</label>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="position[]" value="block" id="uPosBlock">
                                <label for="uPosBlock">Block</label>
                            </div>
                            <div class=" form-check-inline">
                                <input class="form-check-input" type="checkbox" name="position[]" value="top" id="uPosTop">
                                <label for="uPosTop">Top</label>
                            </div>
                            <div class=" form-check-inline">
                                <input class="form-check-input" type="checkbox" name="position[]" value="left" id="uPosLeft">
                                <label for="uPosLeft">Left Side</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="position[]" value="right" id="uPosRight">
                                <label for="uPosRight">Right Side</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="position[]" value="bottom" id="uPosBottom">
                                <label for="uPosBottom">Bottom</label>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <button type="submit" class="btn btn-secondary">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>