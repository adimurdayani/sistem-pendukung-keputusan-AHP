<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Submenu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_menu');
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            // show_error('You must be an administrator to view this page.');
            redirect('auth/block');
        } else {
            $data['title'] = 'Sub Menu';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_submenu'] = $this->m_menu->get_submenu();
            $data['get_menu'] = $this->db->get('user_menu')->result();

            $this->form_validation->set_rules('title', 'nama sub menu', 'trim|required');
            $this->form_validation->set_rules('icon', 'nama icon', 'trim|required');
            $this->form_validation->set_rules('url', 'nama url', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/head', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('backend/submenu/index', $data, FALSE);
                $this->load->view('template/footer', $data, FALSE);
            } else {
                $data = [
                    'menu_id'       => $this->input->post('menu_id'),
                    'title'         => $this->input->post('title'),
                    'icon'          => $this->input->post('icon'),
                    'url'           => $this->input->post('url'),
                    'is_active'     => 1
                ];

                $this->db->insert('user_sub_menu', $data);

                $this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>Sub menu berhasil dibuat</div>');

                redirect('backend/submenu', 'refresh');
            }
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('title', 'nama sub menu', 'trim|required');
        $this->form_validation->set_rules('icon', 'nama icon', 'trim|required');
        $this->form_validation->set_rules('url', 'nama url', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            redirect('backend/submenu', 'refresh');
        } else {
            $id = $this->input->post('id');

            $data = [
                'menu_id'       => $this->input->post('menu_id'),
                'title'         => $this->input->post('title'),
                'icon'          => $this->input->post('icon'),
                'url'           => $this->input->post('url'),
                'is_active'     => $this->input->post('is_active')
            ];

            $this->db->where('id', $id);
            $this->db->update('user_sub_menu', $data);

            $this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Sub menu berhasil diubah</div>');

            redirect('backend/submenu', 'refresh');
        }
    }

    public function hapus($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata(
            'success',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>User berhasil dihapus</div>'
        );
        redirect('backend/submenu', 'refresh');
    }
}

/* End of file Dashboard.php */
