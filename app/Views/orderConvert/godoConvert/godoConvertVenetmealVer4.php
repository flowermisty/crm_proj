<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3 class="text-title text-muted">고도몰 변환 프로그램</h3>
                <p class="text-subtitle text-muted"></p>
                <hr style="border-top:2px solid">
            </div>
            <div class="col-12 col-md-12 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">기타설정</a></li>
                        <li class="breadcrumb-item active" aria-current="page">고도몰 변환</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-muted">고도몰 식단</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">* 고도몰에서 다운로드한 원본 파일을 그대로 올려주세요.<br>
                                * 상품 준비중 리스트에서 다운 받은 파일을 올려주시면 됩니다!
                                <code></code>
                            </p>
                            <!-- Basic file uploader -->
                            <input type="file" class="basic-filepond1">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-muted">고도몰 ERP 주문 변경프로그램 Ver4</h5>
                    </div>
                    <div class="card-content  py-3">
                        <div class="card-body ">
                            <p class="card-text">* 고도몰에서 다운로드한 원본 파일을 그대로 올려주세요.<br>
                                * 상품 준비중 리스트에서 다운 받은 파일을 올려주시면 됩니다!
                                <code></code>
                            </p>
                            <!-- Basic file uploader -->
                            <form action="<?= base_url('convert/godo/venetmeal_v4') ?>" method="post"
                                  enctype="multipart/form-data" class="form-row">
                                <input type="file" class="basic-filepond2" name="excel_file" id="excel_file">
                                <input type="submit" class="btn btn-primary" value="upload" style="float: right; margin-top:2%;">

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-muted">홈플러스 온라인몰 ERP 주문 변경 프로그램 Ver1</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">* 홈플러스 온라인몰에서 다운로드한 원본파일을 그대로 올려주세요.<br>
                                * (단, xls파일로 저장되어 있어야 합니다.)
                                <code></code>
                            </p>
                            <!-- Basic file uploader -->
                            <input type="file" class="basic-filepond3">
                        </div>
                    </div>
                </div>
            </div>


            <!--<div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">ImgBB Uploader</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic file uploader up, upload here to see how
                                <code>.imgbb-filepond</code>-based basic file uploader look. You must use
                                <code>name=image</code> or by FormData fieldName for your
                                input <code>type=file</code> to upload in imgBB.
                            </p>
                             imgBB file uploader
                            <input type="file" name="image" class="imgbb-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Multiple Files</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.multiple-files-filepond</code>-based basic file uploader look. You can use
                                <code>allowMultiple</code> or <code>multiple</code> attribute too to implement multiple
                                upload.
                            </p>
                             File uploader with multiple files upload
                            <input type="file" class="multiple-files-filepond" multiple>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">With Validation</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.with-validation-filepond</code>-based basic file uploader look. You can use
                                <a href="https://pqina.nl/filepond/docs/patterns/plugins/file-validate-size/#properties"
                                   target="_blank">see here</a>
                                or <code>required (to make your input required), data-max-file-size (to limit your input
                                    file size),
                                    data-max-files (to limit your uploaded files), etc (start with data-)</code>
                                attribute
                                too to implement validation.
                            </p>
                             File uploader with validation
                            <input type="file" class="with-validation-filepond" required multiple
                                   data-max-file-size="1MB" data-max-files="3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Preview</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.image-preview-filepond</code>-based basic file uploader look. This
                                preview for uploaded or dropped images.
                            </p>
                             File uploader with image preview
                            <input type="file" class="image-preview-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Exif Orientation</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.image-exif-filepond</code>-based basic file uploader look. This
                                helps in correctly orienting photos taken on mobile devices.
                            </p>
                             Auto image crop file uploader
                            <input type="file" class="image-exif-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Auto Crop</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.image-crop-filepond</code>-based basic file uploader look. You can use
                                <code>imageCropAspectRatio</code> or <code>image-crop-aspect-ratio</code> to
                                set aspect ratio.
                            </p>
                             Auto crop image file uploader
                            <input type="file" class="image-crop-filepond" image-crop-aspect-ratio="1:1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Auto Filter</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.image-filter-filepond</code>-based basic file uploader look.
                            </p>
                             Auto filter image file uploader
                            <input type="file" class="image-filter-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Auto Resize</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.image-resize-filepond</code>-based basic file uploader look.
                            </p>
                             Auto resize image file uploader
                            <input type="file" class="image-resize-filepond">
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </section>
</div>

<?php
