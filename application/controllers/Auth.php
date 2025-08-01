<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('User_model');
  }

  public function index() {
    if ($this->session->userdata('logged_in')) {
      redirect('buku');
    }
    $this->load->view('auth/login');
  }

  public function login() {
    $username = $this->input->post('username');
    $password = md5($this->input->post('password'));
    $user = $this->User_model->check_login($username, $password);

    if ($user) {
      $this->session->set_userdata([
        'username' => $user->username,
        'logged_in' => TRUE
      ]);
      redirect('dashboard');
    } else {
      $this->session->set_flashdata('error', 'Username atau password salah');
      redirect('auth');
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    redirect('auth');
  }
}

