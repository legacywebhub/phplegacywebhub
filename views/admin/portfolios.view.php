<!-- content-wrapper starts -->
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Portfolio List
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
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
                                    <a class="nav-link" href="addportfolio">
                                        <span class="btn btn-primary">+ Add Portfoio</span>
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="order-listing_filter" class="dataTables_filter">
                                        <label><input type="search" class="form-control" placeholder="Search" aria-controls="order-listing"></label>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($_SESSION['message'])): ?>
                            <div class="form-group my-3">
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
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Title</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Date Uploaded</th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <?php if (empty($context['portfolios']['result'])): ?>
                                                <tr role="row" class="even">
                                                    <td>
                                                        No Portfolios
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach($context['portfolios']['result'] as $portfolio): ?>
                                                <tr role="row" class="even">
                                                    <td><?=$portfolio['id']; ?></td>
                                                    <td><?=fetch_service($portfolio['service_id']) ?></td>
                                                    <td><?=$portfolio['title']; ?></td>
                                                    <td><?=$portfolio['date_uploaded']; ?></td>
                                                    <td>
                                                        <a href="editportfolio?id=<?=$portfolio['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                        <a href="deleteportfolio?id=<?=$portfolio['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
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
                                    <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing Page <b><?=$context['portfolios']['page'] ?></b> Of <b><?=$context['portfolios']['num_of_pages'] ?></b></div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                                        <ul class="pagination">
                                            <?php if ($context['portfolios']['has_previous']): ?>
                                            <li class="paginate_button page-item previous" id="order-listing_previous">
                                                <a href="?page=<?=$context['portfolios']['previous_page'] ?>" class="page-link">Previous</a>
                                            </li>
                                            <?php else: ?>
                                            <li class="paginate_button page-item previous disabled" id="order-listing_previous">
                                                <a href="#" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <?php endif ?>

                                            <li class="paginate_button page-item active">
                                                <a href="javascript:void(0)" class="page-link"><?=$context['portfolios']['page'] ?></a>
                                            </li>

                                            <?php if ($context['portfolios']['has_next']): ?>
                                            <li class="paginate_button page-item next" id="order-listing_next">
                                                <a href="?page=<?=$context['portfolios']['next_page'] ?>" class="page-link">Next</a>
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