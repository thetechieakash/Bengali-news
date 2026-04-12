<script>
    $(document).ready(function() {

        $('#ads-listing').DataTable();

        $('.select-type').select2({
            theme: 'bootstrap',
            minimumResultsForSearch: Infinity
        });

        const positionSizes = {
            block: "500x500",
            top: "1100x180",
            left: "180x1100",
            right: "180x1100",
            bottom: "1100x180"
        };


        function toggleAdType(type) {

            if (type === "script") {

                $('.script-wrapper').removeClass('d-none');
                $('#positionImageContainer').html('');
                $('.position-wrapper').addClass('d-none');

            } else {

                $('.script-wrapper').addClass('d-none');
                $('.position-wrapper').removeClass('d-none');

            }

        }


        toggleAdType($('#ad_type').val());


        $('#ad_type').on('change', function() {
            toggleAdType($(this).val());
        });



        $(document).on('change', '.position-check', function() {

            let pos = $(this).val();
            let container = $("#positionImageContainer");

            if ($(this).is(':checked')) {

                let size = positionSizes[pos];

                let html = `

                    <div class="card mb-1 position-image border-bottom-1" data-pos="${pos}">
                        <div class="card-body">
                            <label class="form-label">
                            Ad Image for ${pos.toUpperCase()} (${size})
                            </label>

                            <input type="file"
                            name="position_images[${pos}]"
                            class="dropify"
                            accept="image/*">

                            <input type="hidden" name="position[]" value="${pos}">
                            <div class="my-3">
                                <label class="form-label">Redirect Url for ${pos.toUpperCase()}</label>
                                <input type="text" name="${pos}_redirect_url" class="form-control">
                            </div>
                        </div>
                    </div>
                    `;

                container.append(html);

                container.find('.dropify').last().dropify();

            } else {

                container.find('[data-pos="' + pos + '"]').remove();

            }

        });

        $('#adForm').on('submit', function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({

                url: "<?= base_url('admin/ads/store') ?>",

                type: "POST",

                data: formData,

                contentType: false,
                processData: false,

                success: function(res) {

                    if (res.success) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        setTimeout(() => location.reload(), 1500);

                    }

                    if (res.errors) {

                        Object.values(res.errors).forEach(msg => {
                            Swal.fire('Error', msg, 'error');
                        });

                    }

                },

                error: function() {
                    Swal.fire('Error', 'Server error', 'error');
                }

            });

        });

        $(document).on('change', '.toggle-status', function() {

            let checkbox = $(this);
            let adId = checkbox.data('id');
            let isChecked = checkbox.is(':checked');

            checkbox.prop('checked', !isChecked);

            Swal.fire({
                title: 'Change Status?',
                icon: 'warning',
                showCancelButton: true
            }).then(result => {

                if (result.isConfirmed) {

                    $.post("<?= base_url('admin/ads/toggle-status') ?>", {
                        id: adId,
                        <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                    }, function(res) {

                        if (res.success) {
                            checkbox.prop('checked', isChecked);
                        }

                    });

                }

            });

        });

        $(document).on('click', '.deletebtn', function() {

            let adId = $(this).data('id');
            let row = $(this).closest('tr');

            Swal.fire({
                title: 'Delete Ad?',
                icon: 'warning',
                showCancelButton: true
            }).then(result => {

                if (result.isConfirmed) {

                    $.post("<?= base_url('admin/ads/delete') ?>", {
                        id: adId,
                        <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                    }, function(res) {

                        if (res.success) {
                            row.remove();
                        }

                    });

                }

            });

        });

        $(document).on("click", ".editBtn", function() {

            let id = $(this).data("id");

            $.get("<?= base_url('admin/ads') ?>/" + id, function(res) {

                if (!res.success) return;

                let ad = res.data; // FIRST define

                $("#editAdId").val(ad.id);
                $("#editAdForm [name=title]").val(ad.title);

                $("#editAdForm [name=edit-ad-type]").val(ad.ad_type);
                $("#editAdForm [name=edit-ad-type]").prop("disabled", true);

                // RESET UI
                $("#editPositionImages").html("");
                $(".edit-position-check").prop("checked", false);
                $(".edit-position-check").prop("disabled", true);
                $("#editAdForm input[name='pages[]']").prop("checked", false);

                // HANDLE TYPE UI
                if (ad.ad_type === "script") {

                    $(".script-wrapper").removeClass("d-none");
                    $(".position-wrapper").addClass("d-none");

                } else {

                    $(".script-wrapper").addClass("d-none");
                    $(".position-wrapper").removeClass("d-none");

                }

                // PAGES
                if (ad.pages) {
                    const pages = JSON.parse(ad.pages);
                    pages.forEach(page => {
                        $("#editAdForm input[name='pages[]'][value='" + page + "']")
                            .prop("checked", true);
                    });
                }

                // IMAGE AD
                if (ad.ad_type === "image" && ad.position) {

                    $(".edit-position-check[value='" + ad.position + "']")
                        .prop("checked", true)
                        .prop("disabled", true); // 🔥 lock position

                    createEditImageInput(
                        ad.position,
                        ad.image ?? null,
                        ad.url ?? null
                    );
                }

                // SCRIPT AD
                if (ad.ad_type === "script") {
                    $("#editAdForm textarea[name=script]").val(ad.script);
                }

                $("#editAdsModal").modal("show");

            });

        });

        function createEditImageInput(pos, existing = null, url) {

            let html = `
                <div class="mb-3 edit-pos-image" data-pos="${pos}">

                <label class="form-label">
                Image for ${pos.toUpperCase()} (${positionSizes[pos]})
                </label>

                <input type="file"
                name="position_images[${pos}]"
                class="dropify"
                data-default-file="${existing ? '<?= base_url('') ?>' + existing : ''}"
                accept="image/*">

                <input type="hidden" name="position[]" value="${pos}">
                    <div class="my-3">
                        <label class="form-label">Redirect Url for ${pos.toUpperCase()}</label>
                        <input type="text" name="${pos}_redirect_url" class="form-control" value="${url??''}">
                    </div>

                </div>
                `;

            $("#editPositionImages").append(html);

            $('.dropify').dropify();

        }

        $("#editAdForm").submit(function(e) {

            e.preventDefault();

            let id = $("#editAdId").val();

            let formData = new FormData(this);

            $.ajax({

                url: "<?= base_url('admin/ads/update/') ?>" + id,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        $("#editAdsModal").modal("hide");
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showDangerToast(res.message);
                    }

                }

            });

        });
    });
</script>