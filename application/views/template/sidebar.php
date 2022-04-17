<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="<?= base_url() ?>assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"><?= $session->first_name ?></a>
                <div class="dropdown-menu user-pro-dropdown">
                </div>
            </div>
            <p class="text-muted"><?= $session->email ?></p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <?php
                $group_id = $this->db->get_where('users_groups', ['user_id' => $session->id])->row();

                $queryMenu = "SELECT        `user_menu`.`id`, `menu`
                                FROM        `user_menu` JOIN `user_access_menu`
                                ON          `user_menu`.`id` = `user_access_menu`.`menu_id`
                                WHERE       `user_access_menu`.`group_id` = $group_id->group_id
                                ORDER BY    `user_access_menu`.`menu_id`";

                $menu = $this->db->query($queryMenu)->result_array();
                ?>

                <?php foreach ($menu as $m) : ?>
                    <li class="menu-title"><?= $m['menu'] ?></li>

                    <?php
                    $menu_id = $m['id'];

                    $querySubMenu = "SELECT *
                                FROM    `user_sub_menu` JOIN `user_menu`
                                ON      `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                WHERE   `user_sub_menu`.`menu_id` = $menu_id
                                AND     `user_sub_menu`.`is_active` = 1";
                    $submenu = $this->db->query($querySubMenu)->result_array();
                    ?>

                    <?php foreach ($submenu as $sm) : ?>
                        <li>
                            <a href="<?= base_url($sm['url']) ?>">
                                <i class="<?= $sm['icon'] ?>"></i>
                                <span> <?= $sm['title'] ?> </span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endforeach; ?>


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->