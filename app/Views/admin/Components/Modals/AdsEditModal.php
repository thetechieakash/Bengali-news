<div class="modal fade" id="editAdsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-body">
                    <form id="adForm" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
        
                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Ad Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
        
                        <!-- Ad Type -->
                        <div class="mb-3">
                            <label class="form-label">Ad Type</label>
                            <select name="ad_type" id="ad_type" class="form-select select-type" required>
                                <option value="image" selected>Image</option>
                                <option value="script">Script</option>
                            </select>
                        </div>
                        <div id="image-wrapper" class="mb-3">
                            <label class="form-label">Ad Image</label>
                            <input type="file"
                                class="dropify"
                                id="adimage"
                                name="image"
                                accept="image/*">
                        </div>
                        <div id="script-wrapper" class="mb-3 d-none">
                            <label class="form-label">Ad Script</label>
                            <textarea name="script" class="form-control" rows="4"
                                placeholder="Paste ad script here..."></textarea>
                        </div>
                        <div class="mb-3" id="url-wrapper">
                            <label class="form-label">Redirect URL (optional)</label>
                            <input type="url" name="redirect_url" class="form-control" placeholder="https://example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Show On Pages</label>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="home" id="homePage">
                                <label for="homePage">Home Page</label>
                            </div>
                            <div class=" form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="category" id="categoryPage">
                                <label for="categoryPage">Category Page</label>
                            </div>
                            <div class=" form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="sub_category" id="subCategoryPage">
                                <label for="subCategoryPage">Sub Category Page</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="post" id="postPage">
                                <label for="postPage">Post Page</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="tag" id="tagPage">
                                <label for="tagPage">Tag Page</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pages[]" value="search" id="searchPage">
                                <label for="searchPage">Search Page</label>
                            </div>
                        </div>
                        <div class="mb-3" id="position-wrapper">
                            <label class="form-label d-block">Position</label>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="position[]" value="block" id="posBlock">
                                <label for="posBlock">Block</label>
                            </div>
                            <div class=" form-check-inline">
                                <input class="form-check-input" type="checkbox" name="position[]" value="top" id="posTop">
                                <label for="posTop">Top</label>
                            </div>
                            <div class=" form-check-inline">
                                <input class="form-check-input" type="checkbox" name="position[]" value="left" id="posLeft">
                                <label for="posLeft">Left Side</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="position[]" value="right" id="posRight">
                                <label for="posRight">Right Side</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="position[]" value="bottom" id="posBottom">
                                <label for="posBottom">Bottom</label>
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