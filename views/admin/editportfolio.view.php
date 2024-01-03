<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Portfolio</h4>
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group my-3">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="image-container my-3 text-center">
                        <?php
                            // Rendering all images connected to this portfolio
                            $portfolio_id = intval($context['portfolio']['id']);
                            $portfolio_images = query_fetch("SELECT * FROM portfolio_images WHERE portfolio_id = $portfolio_id");

                            foreach ($portfolio_images as $portfolio_image) {
                                $path = MEDIA_ROOT."/portfolios/".$portfolio_image['image'];
                                echo "<img src=".$path." width=150>";
                            }
                        ?>
                    </div>
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
                        <option  value="<?=$context['portfolio']['service_id']; ?>">Select</option>
                        <?php foreach($context['services'] as $service): ?>
                        <option value=<?=$service['id']; ?>><?=$service['service']; ?></option>
                        <?php endforeach ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Title <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" value="<?=$context['portfolio']['title']; ?>" maxlength="60" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <textarea class="form-control" name="description" rows="4" maxlength="2050" required><?=$context['portfolio']['description']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Repository Link </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="repo_link" value="<?=$context['portfolio']['repo_link']; ?>" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Website </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="website" value="<?=$context['portfolio']['website']; ?>" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Client </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="client" value="<?=$context['portfolio']['client']; ?>" maxlength="60">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="portfolios" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>