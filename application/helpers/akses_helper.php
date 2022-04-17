<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth/login');
    } else {
        $user = $ci->db->get_where('users', ['email' => $ci->session->userdata('email')])->row();
        $group_id = $ci->db->get_where('users_groups', ['user_id' => $user->id])->row();

        $menu = $ci->uri->segment(2);
        $queryMenu = $ci->db->get('user_menu', ['menu' => $menu])->row();

        $userAkses = $ci->db->get_where('user_access_menu', [
            'group_id' => $group_id->group_id,
            'menu_id' => $queryMenu->id
        ]);

        if ($userAkses->num_rows() > 1) {
            redirect('auth/block');
        }
    }
}

function check_access($group_id, $menu_id)
{

    $ci = get_instance();

    $ci->db->where('group_id', $group_id);
    $ci->db->where('menu_id', $menu_id);

    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
