<div class="page-header">
    <h3 class="page-title">
        Edit Comment
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Comment</li>
        </ol>
    </nav>
</div>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Comment</h4>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="form-group my-3">
                <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                    <?=$_SESSION['message']; ?>
                </h6>
            </div>
        <?php endif ?>
        
        <form class="forms-sample mt-5" method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
        <div class="form-group">
            <label>Post ID </label>
            <input type="text" class="form-control" name="post_id" maxlength="10" value="<?=$context['comment']['post_id']; ?>" onkeypress="return onlyNumberKey(event)">
        </div>
        <div class="form-group">
            <label>User ID </label>
            <input type="text" class="form-control" name="user_id" maxlength="10" value="<?=$context['comment']['user_id']; ?>" onkeypress="return onlyNumberKey(event)">
        </div>
        <div class="form-group">
            <label>Name </label>
            <input type="text" class="form-control" name="name" maxlength="30" value="<?=$context['comment']['name']; ?>">
        </div>
        <div class="form-group">
            <label>Email </label>
            <input type="email" class="form-control" name="email" maxlength="30" value="<?=$context['comment']['email']; ?>">
        </div>
        <div class="form-group">
            <label>Comment <span class="text-danger">*</span></label>
            <textarea cols="30" rows="15" class="form-control" name="comment" maxlength="1050" required><?=$context['comment']['comment']; ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="posts" class="btn btn-light">Cancel</a>
        </form>
    </div>
    </div>
</div>
  
<!-- Custom js for this page-->