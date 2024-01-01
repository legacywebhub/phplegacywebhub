<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Setting</h4>
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group my-3">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" maxlength="30" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Domain <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="domain" maxlength="30" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email1  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="email" class="form-control" name="email1" maxlength="60" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email2  </label>
                        <div class="col-sm-9">
                        <input type="email" class="form-control" name="email2" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone1 <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="phone1" maxlength="30" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone2 </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="phone2" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="address" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Whatsapp Link </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="whatsapp_link" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Facebook Link </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="facebook_link" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Instagram Link </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="instagram_link" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">X Link </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="x_link" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Thread Link </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="thread_link" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Youtube Link </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="youtube_link" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Linkedin Link </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="linkedin_link" maxlength="60">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="settings" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>