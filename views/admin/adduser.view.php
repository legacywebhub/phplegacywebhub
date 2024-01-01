<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New User</h4>
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group my-3">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="my-3 text-center">
                        <img class="rounded-circle image-preview col-3" src="<?=STATIC_ROOT; ?>/default.png" alt="profile image">
                    </div>
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Select Profile Picture</label>
                        <div class="col-sm-9">
                        <input type="file" class="form-control" name="profile_picture" onchange="displayImageEdit(this.files[0]);">
                        <small class="ml-2 text-danger">Allowed extensions - (jpeg, jpg, png) / Maximum file size - 2mb</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Full Name </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="fullname" minlength="3" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="username" minlength="3" maxlength="20" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" maxlength="60" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Role  </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="role" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="password" class="form-control" name="password1" maxlength="60" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="password" class="form-control" name="password2" maxlength="60" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Is Staff <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <select class="form-control form-control-lg" name="is_staff" required>
                        <option value="">Select</option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Is Superuser <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <select class="form-control form-control-lg" name="is_superuser" required>
                        <option value="">Select</option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                        </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="#" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>