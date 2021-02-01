<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Guru extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Guru_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'guru/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'guru/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'guru/index.html';
                    $config['first_url'] = base_url() . 'guru/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Guru_model->total_rows($q);
                $guru = $this->Guru_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'guru_data' => $guru,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Guru';

                $this->load->view('templates/header', $data);
                $this->load->view('guru/guru_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Guru_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_guru' => $row->id_guru,
		'nama_guru' => $row->nama_guru,
		'nip' => $row->nip,
		'alamat' => $row->alamat,
		'no_telepon' => $row->no_telepon,
		'email' => $row->email,
	    );

                $data['judul'] = 'Detail Guru';

                $this->load->view('templates/header', $data);
                $this->load->view('guru/guru_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('guru'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('guru/create_action'),
	    'id_guru' => set_value('id_guru'),
	    'nama_guru' => set_value('nama_guru'),
	    'nip' => set_value('nip'),
	    'alamat' => set_value('alamat'),
	    'no_telepon' => set_value('no_telepon'),
	    'email' => set_value('email'),
	);

                $data['judul'] = 'Tambah Guru';

                $this->load->view('templates/header', $data);
                $this->load->view('guru/guru_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'nama_guru' => $this->input->post('nama_guru',TRUE),
		'nip' => $this->input->post('nip',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telepon' => $this->input->post('no_telepon',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

                        $this->Guru_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('guru'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Guru_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('guru/update_action'),
		'id_guru' => set_value('id_guru', $row->id_guru),
		'nama_guru' => set_value('nama_guru', $row->nama_guru),
		'nip' => set_value('nip', $row->nip),
		'alamat' => set_value('alamat', $row->alamat),
		'no_telepon' => set_value('no_telepon', $row->no_telepon),
		'email' => set_value('email', $row->email),
	    );

                        $data['judul'] = 'Ubah Guru';

                        $this->load->view('templates/header', $data);
                        $this->load->view('guru/guru_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('guru'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_guru', TRUE));
                            } else {
                                $data = array(
		'nama_guru' => $this->input->post('nama_guru',TRUE),
		'nip' => $this->input->post('nip',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telepon' => $this->input->post('no_telepon',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

                                $this->Guru_model->update($this->input->post('id_guru', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('guru'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Guru_model->get_by_id($id);

                            if ($row) {
                                $this->Guru_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('guru'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('guru'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nama_guru', 'nama guru', 'trim|required');
	$this->form_validation->set_rules('nip', 'nip', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telepon', 'no telepon', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');

	$this->form_validation->set_rules('id_guru', 'id_guru', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Guru.php */
                        /* Location: ./application/controllers/Guru.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2021-02-01 16:05:08 */
                        /* http://harviacode.com */