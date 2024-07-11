<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item"><a id="sidebar_" class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i></a></li>

            <li class="nav-item <?= (session()->get('check_employee') == 'true') ? 'd-none' : '' ?>">
                <a class="nav-link" href="<?= base_url('company-logout') ?>">
                    <i class="bi bi-house-door-fill"></i>
                </a>  
            </li> 
            <!-- company name with bank icon -->
            <?php if(session()->has('CompId')): ?>
                <li class="nav-item">
                    <a href="" class="nav-link text-dark fw-bold">
                        <i class="bi bi-bank"></i> : 
                        <?= get_title('companies', ['id'=>session()->get('CompId')], 'Company_name'); ?> 
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a href="" class="nav-link text-dark fw-bold">
                    <i class="bi bi-person-fill"></i> : 
                    <?= session()->has('user_data') ? session()->get('user_data')['name'] ?? '' : '' ?> 
                </a>
            </li>
            <!-- state name with map-marker icon -->
            <?php if(session()->has('StateId')): ?>
                <li class="nav-item">
                    <a href="" class="nav-link text-dark fw-bold">
                        <i class="bi bi-geo-alt-fill"></i> :
                        <?= get_title('states', ['id'=>session()->get('StateId')], 'name'); ?>
                    </a>
                </li>
            <?php endif; ?>  
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown"><a class="nav-link" data-bs-toggle="dropdown" href="#"><i class="bi bi-calendar-check"></i></a>
            <?php 
            $db = \Config\Database::connect();
            $f_years = $db->table('financial_year')->where('status', 1)->get()->getResult(); 
            ?>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"><span class="dropdown-item dropdown-header">Financial Years</span>
                    <?php foreach($f_years as $f_year_key => $f_year_val): ?>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('admin/set-finance-year/'.$f_year_val->id) ?>" class="dropdown-item">
                            <?= $f_year_val->year ?>
                            <?php if(session()->get('FinancialYear') == $f_year_val->id): ?>
                                <span class="float-end text-primary fs-7"><i class="bi bi-patch-check-fill me-2"></i></span>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="<?= base_url(session()->has('user_data') ? session()->get('user_data')['profile'] ?? 'dist/assets/img/default.jpg  ' : '') ?>" class="user-image rounded-circle shadow" alt="User Image">
                    <span class="d-none d-md-inline"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"><!--begin::User Image-->
                    <li class="user-header text-bg-primary"><img src="<?= base_url(session()->has('user_data') ? session()->get('user_data')['profile'] ?? 'dist/assets/img/default.jpg  ' : '') ?>" class="rounded-circle shadow" alt="User Image">
                        <p>
                            <?= session()->has('user_data') ? session()->get('user_data')['name'] ?? '' : '' ?>
                            <small><?= get_role(session()->get('user_data')['role']) ?></small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <a href="<?= base_url('admin/my-profile') ?>" class="btn btn-default btn-flat">Profile</a>
                        <a href="<?= base_url('logout') ?>" class="btn btn-default btn-flat float-end">Sign out</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>