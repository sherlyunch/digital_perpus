<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if (!$this->session->userdata('logged_in')) {
      redirect('auth');
    }
    $this->load->database();
  }

  public function index() {
    $data['judul'] = 'Dashboard';
    $data['total_buku'] = $this->db->count_all('buku');

    $this->load->view('layout/header', $data);
    $this->load->view('layout/sidebar');
    $this->load->view('dashboard', $data);
    $this->load->view('layout/footer');
  }
}
