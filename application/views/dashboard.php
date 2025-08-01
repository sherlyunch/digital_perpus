<div class="card shadow mb-4">
  <div class="card-body">
    <h4>Selamat datang, <strong><?= $this->session->userdata('username'); ?></strong> 👋</h4>
    <p>Aplikasi ini adalah sistem manajemen perpustakaan digital sederhana.</p>

    <div class="row mt-4">
      <div class="col-md-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <h5 class="text-primary"><i class="fas fa-book"></i> Total Buku</h5>
            <h3><?= $total_buku ?? 0; ?></h3>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
