<div class="page-header">
    <h3 class="page-title">
        Update Post
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Post</li>
        </ol>
    </nav>
</div>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Post</h4>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="form-group my-3">
                <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                    <?=$_SESSION['message']; ?>
                </h6>
            </div>
        <?php endif ?>
        
        <form class="forms-sample mt-5" method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
        <div class="form-group row">
            <label>Category </label>
            <select class="form-control form-control-lg" name="category">
            <option value=<?=$context['post']['category_id']; ?>><?=fetch_post_category($context['post']['category_id']); ?></option>
            <?php foreach($context['categories'] as $category): ?>
            <option value=<?=$category['id']; ?>><?=$category['category']; ?></option>
            <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label>Image </label>
            <div class="image-container"></div>
            <input type="text" class="form-control" name="image" placeholder="Insert image address" maxlength="2050" value="<?=$context['post']['image']; ?>" onchange="previewPostImage(this.value)">
        </div>
        <div class="form-group">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" value="<?=$context['post']['title']; ?>" required>
        </div>
        <div class="form-group">
            <label>Content <span class="text-danger">*</span></label>
            <textarea cols="30" rows="15" class="form-control" id="summernoteExample" name="content" maxlength="50500" required>
            <?=$context['post']['content']; ?>
            </textarea>
        </div>
        <div class="form-group">
            <label>Document </label>
            <input type="file" class="form-control" name="document">
        </div>
        <div class="form-group">
            <label>Quote </label>
            <textarea class="form-control" name="quote" cols="30" rows="10">
            <?=$context['post']['quote']; ?>
            </textarea>
        </div>
        
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="posts" class="btn btn-light">Cancel</a>
        </form>
    </div>
    </div>
</div>
  
<!-- Custom js for this page-->