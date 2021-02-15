<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jurusan_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'jurusan/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'jurusan/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'jurusan/index.html';
                    $config['first_url'] = base_url() . 'jurusan/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Jurusan_model->total_rows($q);
                $jurusan = $this->Jurusan_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'jurusan_data' => $jurusan,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Jurusan';

                $this->load->view('templates/header', $data);
                $this->load->view('jurusan/jurusan_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Jurusan_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_jurusan' => $row->id_jurusan,
		'nama_jurusan' => $row->nama_jurusan,
	    );

                $data['judul'] = 'Detail Jurusan';

                $this->load->view('templates/header', $data);
                $this->load->view('jurusan/jurusan_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('jurusan'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('jurusan/create_action'),
	    'id_jurusan' => set_value('id_jurusan'),
	    'nama_jurusan' => set_value('nama_jurusan'),
	);

                $data['judul'] = 'Tambah Jurusan';

                $this->load->view('templates/header', $data);
                $this->load->view('jurusan/jurusan_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'nama_jurusan' => $this->input->post('nama_jurusan',TRUE),
	    );

                        $this->Jurusan_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('jurusan'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Jurusan_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('jurusan/update_action'),
		'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
		'nama_jurusan' => set_value('nama_jurusan', $row->nama_jurusan),
	    );

                        $data['judul'] = 'Ubah Jurusan';

                        $this->load->view('templates/header', $data);
                        $this->load->view('jurusan/jurusan_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('jurusan'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_jurusan', TRUE));
                            } else {
                                $data = array(
		'nama_jurusan' => $this->input->post('nama_jurusan',TRUE),
	    );

                                $this->Jurusan_model->update($this->input->post('id_jurusan', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('jurusan'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Jurusan_model->get_by_id($id);

                            if ($row) {
                                $this->Jurusan_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('jurusan'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('jurusan'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nama_jurusan', 'nama jurusan', 'trim|required');

	$this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Jurusan.php */
                        /* Location: ./application/controllers/Jurusan.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2021-02-01 16:04:35 */
                        /* http://harviacode.com */