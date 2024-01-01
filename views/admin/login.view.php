<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Melody Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/dashboard/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=STATIC_ROOT; ?>/dashboard/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="<?=STATIC_ROOT; ?>/dashboard/images/logo.svg" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="post">
              <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                <div class="form-group">
                  <input type="email" name="email" maxlength="60" class="form-control form-control-lg" placeholder="Email"required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" maxlength="60" class="form-control form-control-lg" placeholder="Password" required>
                </div>
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group my-3">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium">SIGN IN</button>
                </div>
                <div class="my-2 text-center">
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=STATIC_ROOT; ?>/dashboard/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/off-canvas.js"></script>
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/hoverable-collapse.js"></script>
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/misc.js"></script>
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/settings.js"></script>
  <script src="<?=STATIC_ROOT; ?>/dashboard/js/todolist.js"></script>
  <!-- endinject -->
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
</html>
