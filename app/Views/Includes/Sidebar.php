
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="#" class="brand-link bg-light">
            <img src="<?= base_url('Assets/Images/logo.png') ?>" alt="Sunpro Logo" class="brand-image shadow">
            <span class="brand-text fw-light"></span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= current_url(true)->getSegment(2) == 'dashboard' ? 'active' : '' ?>"><i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php
                $this->db = \Config\Database::connect();
                $main_menus = $this->db->table('permissions')->where('parent_id', 0)->get()->getResult();
                $role_has_permission = $this->db->table('role_has_permissions')->where('role_id', session()->get('Role'))->get()->getResult();
                $pers = [];
                foreach ($role_has_permission as $role_has_permission_key => $role_has_permission_value) {
                    $pers[] = $role_has_permission_value->permission_id;
                } 
                foreach ($main_menus as $menu_key => $menu_value) {
                    if (in_array($menu_value->id, $pers)) {
                        $sub_menus = $this->db->table('permissions')->where('parent_id', $menu_value->id)->get()->getResult();
                        $url = [];
                        foreach ($sub_menus as $sub_menu_key => $sub_menu_value) {
                                $url[] = 'admin/' . $sub_menu_value->url;
                        }
                        if (count($sub_menus) > 0) { ?>
                            <li class="nav-item <?= in_array(uri_string(), $url) ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi <?= $menu_value->icon ?>"></i>
                                    <p class="text-capitalize">
                                        <?= $menu_value->name ?>
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php foreach ($sub_menus as $sub_key => $sub_value) {
                                        if (in_array($sub_value->id, $pers)) { ?>
                                            <li class="nav-item">
                                                <a href="<?= base_url('admin/' . $sub_value->url) ?>" class="nav-link <?= current_url(true)->getSegment(2) == $sub_value->url ? 'active' : '' ?>"><i class="nav-icon bi bi-circle"></i>
                                                    <p class="text-capitalize"><?= $sub_value->name ?></p>
                                                </a>
                                            </li>
                                    <?php }
                                    } ?>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a href="<?=base_url('admin/' . $menu_value->url) ?>" class="nav-link <?= current_url(true)->getSegment(2) == $menu_value->url ? 'active' : '' ?>">
                                    <i class="nav-icon bi <?= $menu_value->icon ?>"></i>
                                    <p class="text-capitalize"><?= $menu_value->name ?></p>
                                </a>
                            </li>
                <?php }
                    }
                } ?>
                </li>
            </ul>
        </nav>
    </div>
</aside>