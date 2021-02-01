<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Pelajaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelajaran_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'pelajaran/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'pelajaran/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'pelajaran/index.html';
                    $config['first_url'] = base_url() . 'pelajaran/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Pelajaran_model->total_rows($q);
                $pelajaran = $this->Pelajaran_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'pelajaran_data' => $pelajaran,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Pelajaran';

                $this->load->view('templates/header', $data);
                $this->load->view('pelajaran/pelajaran_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Pelajaran_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_pelajaran' => $row->id_pelajaran,
		'nama_pelajaran' => $row->nama_pelajaran,
	    );

                $data['judul'] = 'Detail Pelajaran';

                $this->load->view('templates/header', $data);
                $this->load->view('pelajaran/pelajaran_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('pelajaran'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('pelajaran/create_action'),
	    'id_pelajaran' => set_value('id_pelajaran'),
	    'nama_pelajaran' => set_value('nama_pelajaran'),
	);

                $data['judul'] = 'Tambah Pelajaran';

                $this->load->view('templates/header', $data);
                $this->load->view('pelajaran/pelajaran_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'nama_pelajaran' => $this->input->post('nama_pelajaran',TRUE),
	    );

                        $this->Pelajaran_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('pelajaran'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Pelajaran_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('pelajaran/update_action'),
		'id_pelajaran' => set_value('id_pelajaran', $row->id_pelajaran),
		'nama_pelajaran' => set_value('nama_pelajaran', $row->nama_pelajaran),
	    );

                        $data['judul'] = 'Ubah Pelajaran';

                        $this->load->view('templates/header', $data);
                        $this->load->view('pelajaran/pelajaran_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('pelajaran'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_pelajaran', TRUE));
                            } else {
                                $data = array(
		'nama_pelajaran' => $this->input->post('nama_pelajaran',TRUE),
	    );

                                $this->Pelajaran_model->update($this->input->post('id_pelajaran', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('pelajaran'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Pelajaran_model->get_by_id($id);

                            if ($row) {
                                $this->Pelajaran_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('pelajaran'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('pelajaran'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nama_pelajaran', 'nama pelajaran', 'trim|required');

	$this->form_validation->set_rules('id_pelajaran', 'id_pelajaran', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Pelajaran.php */
                        /* Location: ./application/controllers/Pelajaran.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2021-02-01 16:04:59 */
                        /* http://harviacode.com */