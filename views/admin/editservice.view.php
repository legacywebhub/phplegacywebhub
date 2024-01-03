<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Service</h4>
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>
                <form class="forms-sample my-3" method="post">
                    <div class="form-group row">
                        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                        <label class="col-sm-3 col-form-label">Service <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="service" value="<?=$context['service']['service']; ?>" required>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="services" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>