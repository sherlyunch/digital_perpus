<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {

  public function get_all() {
    return $this->db->get('buku')->result();
  }

  public function get_by_id($id) {
    return $this->db->get_where('buku', ['id' => $id])->row();
  }

  public function insert() {
    $data = [
      'judul'    => $this->input->post('judul'),
      'penulis'  => $this->input->post('penulis'),
      'tahun'    => $this->input->post('tahun'),
      'kategori' => $this->input->post('kategori')
    ];
    $this->db->insert('buku', $data);
  }

  public function update($id) {
    $data = [
      'judul'    => $this->input->post('judul'),
      'penulis'  => $this->input->post('penulis'),
      'tahun'    => $this->input->post('tahun'),
      'kategori' => $this->input->post('kategori')
    ];
    $this->db->where('id', $id);
    $this->db->update('buku', $data);
  }

  public function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('buku');
  }

  public function search($keyword) {
    $this->db->like('judul', $keyword);
    $this->db->or_like('penulis', $keyword);
    return $this->db->get('buku')->result();
    }

public function get_all_limit($limit, $start) {
  return $this->db->get('buku', $limit, $start)->result();
}

public function count_all() {
  return $this->db->count_all('buku');
}

public function search_limit($keyword, $limit, $start) {
  $this->db->from('buku');
  $this->db->group_start();
    $this->db->like('judul', $keyword);
    $this->db->or_like('penulis', $keyword);
  $this->db->group_end();
  $this->db->limit($limit, $start);
  return $this->db->get()->result();
}

public function count_search($keyword) {
  $this->db->from('buku');
  $this->db->group_start();
    $this->db->like('judul', $keyword);
    $this->db->or_like('penulis', $keyword);
  $this->db->group_end();
  return $this->db->count_all_results();
}


}
