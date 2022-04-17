<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        is_logged_in();
    }


    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $data['title'] = 'User Manajemen';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            //list the users
            $data['users'] = $this->ion_auth->users()->row();
            $this->db->where('id!=', 6);
            $data['get_user'] = $this->ion_auth->users()->result();
            $data['get_grup'] = $this->ion_auth->groups()->result_array();
            $data['get_user_grup'] = $this->db->get('users_groups')->result();
            $data['get_all_grup'] = $this->db->get('groups')->result();

            foreach ($data['get_user'] as $k => $user) {
                $data['get_user'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            }

            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/user/index', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function create_user()
    {
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'phone', 'trim');
        $this->form_validation->set_rules('company', 'company', 'trim');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'password confirm', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'error',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>User baru gagal dibuat!</div>'
            );

            redirect('backend/user', 'refresh');
        } else {

            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'email' => $this->input->post('email'),
                'active' => 1,
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            ];

            $this->db->insert('users', $data);
            $this->session->set_flashdata(
                'success',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>User baru berhasil dibuat</div>'
            );
            redirect('backend/user', 'refresh');
        }
    }

    public function edit_user()
    {
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('phone', 'phone', 'trim');
        $this->form_validation->set_rules('company', 'company', 'trim');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'password confirm', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Data user gagal diubah!</div>');

            redirect('backend/user', 'refresh');
        } else {
            $id = $this->input->post('id');

            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'email' => $this->input->post('email'),
                'active' => 1,
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            ];

            // Only allow updating groups if user is admin
            if ($this->ion_auth->is_admin()) {
                // Update the groups user belongs to
                $this->ion_auth->remove_from_group('', $id);

                $groupData = $this->input->post('groups');
                if (isset($groupData) && !empty($groupData)) {
                    foreach ($groupData as $grp) {
                        $this->ion_auth->add_to_group($grp, $id);
                    }
                }
            }

            $this->db->where('id', $id);
            $this->db->update('users', $data);
            $this->session->set_flashdata(
                'success',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>User baru berhasil dibuat</div>'
            );
            redirect('backend/user', 'refresh');
        }
    }

    public function hapus($id)
    {
        $this->db->delete('users', ['id' => $id]);
        $this->session->set_flashdata(
            'success',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>User berhasil dihapus</div>'
        );
        redirect('backend/user', 'refresh');
    }

    public function hapus_all()
    {
        $id = $_POST['id'];
        $this->m_user->delete($id);
        $this->session->set_flashdata(
            'success',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>User berhasil dihapus</div>'
        );
        redirect('backend/user');
    }

    public function tampil_groupkan($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $data['title'] = 'Gropkan user';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            //list the users
            $data['users'] = $this->ion_auth->users()->row();
            $data['get_user'] = $this->db->get_where('users', ['id' => $id])->row();
            $data['get_user_grup'] = $this->db->get_where('users_groups', ['user_id' => $id])->row();
            $data['get_all_grup'] = $this->db->get('groups')->result();

            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/user/groupkan', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function groupkan()
    {
        $this->form_validation->set_rules('id_group', 'group', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Data user gagal diubah!</div>');
            redirect('backend/user');
        } else {
            $data = [
                'user_id' => $this->input->post('id'),
                'group_id' => $this->input->post('group_id')

            ];

            $this->db->insert('users_groups', $data);
            $this->session->set_flashdata(
                'success',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>User berhasil diubah</div>'
            );
            redirect('backend/user');
        }
    }
}

/* End of file Dashboard.php */
