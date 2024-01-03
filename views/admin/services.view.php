<!-- content-wrapper starts -->
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Services
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Services</li>
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
                                    <a class="nav-link" href="addservice">
                                        <span class="btn btn-primary">+ Add Service</span>
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
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">ID</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Service</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($context['services']['result'])): ?>
                                                <tr role="row" class="even">
                                                    <td>
                                                        No Services
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach($context['services']['result'] as $service): ?>
                                                <tr role="row" class="even">
                                                    <td><?=$service['id']; ?></td>
                                                    <td><?=$service['service']; ?></td>
                                                    <td>
                                                        <a href="editservice?id=<?=$service['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                        <a href="deleteservice?id=<?=$service['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
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
                                    <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing Page <b><?=$context['services']['page'] ?></b> Of <b><?=$context['services']['num_of_pages'] ?></b></div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                                        <ul class="pagination">
                                            <?php if ($context['services']['has_previous']): ?>
                                            <li class="paginate_button page-item previous" id="order-listing_previous">
                                                <a href="?page=<?=$context['services']['previous_page'] ?>" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <?php else: ?>
                                            <li class="paginate_button page-item previous disabled" id="order-listing_previous">
                                                <a href="#" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <?php endif ?>

                                            <li class="paginate_button page-item active">
                                                <a href="javascript:void(0)" class="page-link"><?=$context['services']['page'] ?></a>
                                            </li>

                                            <?php if ($context['services']['has_next']): ?>
                                            <li class="paginate_button page-item next" id="order-listing_next">
                                                <a href="?page=<?=$context['services']['next_page'] ?>" aria-controls="order-listing" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
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