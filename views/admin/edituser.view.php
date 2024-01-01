<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group my-3">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="text-center my-3">
                        <?php if (empty($context['user']['profile_pic'])): ?>
                            <img class="rounded-circle image-preview col-3" src="<?=STATIC_ROOT; ?>/default.png" alt="profile image">
                        <?php else: ?>
                            <img class="rounded-circle image-preview col-3" src="<?=MEDIA_ROOT; ?>/users/<?=$context['user']['profile_pic']; ?>" alt="profile image">
                        <?php endif ?>
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
                        <input type="text" class="form-control" name="fullname" value="<?=$context['user']['fullname']; ?>" minlength="3" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="username" value="<?=$context['user']['username']; ?>" minlength="3" maxlength="20" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email </label>
                        <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" value="<?=$context['user']['email']; ?>" maxlength="60" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Role </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="role" value="<?=$context['user']['role']; ?>" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password </label>
                        <div class="col-sm-9">
                        <input type="password" class="form-control" name="password1" value="<?=$context['user']['password']; ?>" maxlength="255" required>
                        <small class="text-danger ml-3">Skip to use former password</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Confirm Password </label>
                        <div class="col-sm-9">
                        <input type="password" class="form-control" name="password2" value="<?=$context['user']['password']; ?>" maxlength="255" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Is Staff </label>
                        <div class="col-sm-9">
                        <select class="form-control form-control-lg" name="is_staff" value="<?=$context['user']['is_staff']; ?>">
                        <option value=<?=$context['user']['is_staff']; ?>>Select</option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Is Superuser</label>
                        <div class="col-sm-9">
                        <select class="form-control form-control-lg" name="is_superuser">
                        <option value=<?=$context['user']['is_superuser']; ?>>Select</option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Is Blocked</label>
                        <div class="col-sm-9">
                        <select class="form-control form-control-lg" name="is_blocked">
                        <option value=<?=$context['user']['is_blocked']; ?>>Select</option>
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