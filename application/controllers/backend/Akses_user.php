<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Akses_user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_menu');
        is_logged_in();
    }


    public function get_akses($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            // show_error('You must be an administrator to view this page.');
            $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            // var_dump($user->id);
            $group_id = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
            $menu = $this->uri->segment(1);
            $queryMenu = $this->db->get('user_menu', ['menu' => $menu])->row();
            $userAkses = $this->db->get_where('user_access_menu', [
                'group_id' => $group_id->group_id,
                'menu_id' => $queryMenu->id,
            ]);

            if ($userAkses->num_rows() < 1) {
                echo 'akses blog';
            }
        } else {
            $data['title'] = 'Akses User';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            // $this->db->where('id !=', 1);
            $data['get_menu'] = $this->db->get('user_menu')->result();
            $data['get_akses'] = $this->db->get_where('groups', ['id' => $id])->row();

            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/user/akses_user', $data, FALSE);
            // $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function ubah_akses()
    {
        $menu_id = $this->input->post('menu_id');
        $group_id = $this->input->post('group_id');

        $data = [
            'group_id' => $group_id,
            'menu_id' => $menu_id,
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows()  < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        // $this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //             <span aria-hidden="true">&times;</span>
        //         </button>Akses user telah diubah!</div>');
    }
}

/* End of file Akses_user.php */
