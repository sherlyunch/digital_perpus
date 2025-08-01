<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if (!$this->session->userdata('logged_in')) {
      redirect('auth');
    }
    $this->load->model('Buku_model');
    $this->load->library('pagination');
  }

  public function index() {
    $data['judul'] = 'Data Buku';

    $keyword = $this->input->get('keyword');
    $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $config['base_url'] = site_url('buku/index');
    $config['per_page'] = 5;
    $config['uri_segment'] = 3;

    if (!empty($keyword)) {
      $config['total_rows'] = $this->Buku_model->count_search($keyword);
      $config['suffix'] = '?keyword=' . urlencode($keyword);
      $config['first_url'] = $config['base_url'] . '?keyword=' . urlencode($keyword);
      $data['buku'] = $this->Buku_model->search_limit($keyword, $config['per_page'], $start);
    } else {
      $config['total_rows'] = $this->Buku_model->count_all();
      $data['buku'] = $this->Buku_model->get_all_limit($config['per_page'], $start);
    }

    // Bootstrap 5 Pagination Styling
    $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav>';
    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '&raquo;';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo;';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close'] = '</span></li>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['attributes'] = ['class' => 'page-link'];

    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();

    $this->load->view('layout/header', $data);
    $this->load->view('layout/sidebar');
    $this->load->view('buku/index', $data);
    $this->load->view('layout/footer');
  }

  public function tambah() {
    $data['judul'] = 'Tambah Buku';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('judul', 'Judul', 'required');
    $this->form_validation->set_rules('penulis', 'Penulis', 'required');
    $this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric');
    $this->form_validation->set_rules('kategori', 'Kategori', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('buku/form', $data);
      $this->load->view('layout/footer');
    } else {
      $this->Buku_model->insert();
      $this->session->set_flashdata('success', 'Data buku berhasil ditambahkan.');
      redirect('buku');
    }
  }

  public function edit($id) {
    $data['judul'] = 'Edit Buku';
    $data['buku'] = $this->Buku_model->get_by_id($id);

    if ($this->input->post()) {
      $this->Buku_model->update($id);
      $this->session->set_flashdata('success', 'Data buku berhasil diupdate.');
      redirect('buku');
    }

    $this->load->view('layout/header', $data);
    $this->load->view('layout/sidebar');
    $this->load->view('buku/form', $data);
    $this->load->view('layout/footer');
  }

  public function hapus($id) {
    $this->Buku_model->delete($id);
    $this->session->set_flashdata('success', 'Data buku berhasil dihapus.');
    redirect('buku');
  }
}
