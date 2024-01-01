<!-- content-wrapper starts -->
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Users List
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <div id="order-listing_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <a class="nav-link" href="adduser">
                                        <span class="btn btn-primary">+ Add User</span>
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="order-listing_filter" class="dataTables_filter">
                                        <label><input type="search" class="form-control" placeholder="Search" aria-controls="order-listing"></label>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($_SESSION['message'])): ?>
                            <div class="form-group">
                                <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                                    <?=$_SESSION['message']; ?>
                                </h6>
                            </div>
                            <?php endif ?>
                            <div class="row my-4">
                                <div class="col-sm-12">
                                    <table id="order-listing" class="table table-bordered no-footer" role="grid" aria-describedby="order-listing_info">
                                        <thead>
                                            <tr role="row">
                                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Date Joined</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Profile Picture</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Email</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Role</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Is Admin</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Is Superuser</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Is Blocked</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (empty($context['users']['result'])): ?>
                                            <tr role="row" class="even">
                                                <td>
                                                    No Users
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach($context['users']['result'] as $user): ?>
                                            <tr role="row" class="even">
                                                <td><?=$user['date_joined']; ?></td>
                                                <td class="text-center">
                                                    <?php if (empty($user['profile_pic'])): ?>
                                                        <img class="" src="<?=STATIC_ROOT; ?>/no_image.png" alt="no image">
                                                    <?php else: ?>
                                                        <img class="my-1" src="<?=MEDIA_ROOT; ?>/users/<?=$user['profile_pic']; ?>" alt="image">
                                                    <?php endif ?>
                                                </td>
                                                <td><a href="edituser?id=<?=$user['id']; ?>"><?=$user['username']; ?></a></td>
                                                <td><a href="edituser?id=<?=$user['id']; ?>"><?=$user['email']; ?></a></td>
                                                <td><?=$user['role']; ?></td>
                                                <td class="text-center">
                                                    <?php if ($user['is_staff'] == 1): ?>
                                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                                    <?php else: ?>
                                                        <span class="text-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($user['is_superuser'] == 1): ?>
                                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                                    <?php else: ?>
                                                        <span class="text-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($user['is_blocked'] == 1): ?>
                                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                                    <?php else: ?>
                                                        <span class="text-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <a href="edituser?id=<?=$user['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="deleteuser?id=<?=$user['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing Page <b><?=$context['users']['page'] ?></b> Of <b><?=$context['users']['num_of_pages'] ?></b></div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                                        <ul class="pagination">
                                            <?php if ($context['users']['has_previous']): ?>
                                            <li class="paginate_button page-item previous disabled" id="order-listing_previous">
                                                <a href="?page=<?=$context['users']['previous_page'] ?>" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <?php else: ?>
                                            <li class="paginate_button page-item previous disabled" id="order-listing_previous">
                                                <a href="#" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <?php endif ?>

                                            <li class="paginate_button page-item active">
                                                <a href="javascript:void(0)" class="page-link"><?=$context['users']['page'] ?></a>
                                            </li>

                                            <?php if ($context['users']['has_next']): ?>
                                            <li class="paginate_button page-item next disabled" id="order-listing_next">
                                                <a href="?page=<?=$context['users']['next_page'] ?>" aria-controls="order-listing" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                            </li>
                                            <?php else: ?>
                                            <li class="paginate_button page-item next disabled" id="order-listing_next">
                                                <a href="#" aria-controls="order-listing" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                            </li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->