<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Portfolio</h4>
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group my-3">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="image-container my-3 text-center"></div>
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Select Porfolio Images</label>
                        <div class="col-sm-9">
                        <input type="file" class="form-control" name="portfolio_images[]" multiple onchange="previewImages(this.files)">
                        <small class="ml-2 text-danger">Allowed extensions - (jpeg, jpg, png) / Maximum file size - 5mb</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Service <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <select class="form-control form-control-lg" name="service" required>
                        <option value="">Select</option>
                        <?php foreach($context['services'] as $service): ?>
                        <option value=<?=$service['id']; ?>><?=$service['service']; ?></option>
                        <?php endforeach ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Title <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" maxlength="60" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <textarea class="form-control" name="description" rows="4" maxlength="2500" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Repository Link </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="repo_link" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Website </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="website" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Client </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="client" maxlength="60">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="portfolios" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>