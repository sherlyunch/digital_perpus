<h3><?= $judul ?></h3>

<?php if ($this->session->flashdata('success')): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '<?= $this->session->flashdata('success') ?>',
      timer: 2000,
      showConfirmButton: false
    });
  </script>
<?php endif; ?>

<a href="<?= base_url('index.php/buku/tambah') ?>" class="btn btn-success mb-3">
  <i class="fas fa-plus"></i> Tambah Buku
</a>

<table class="table table-bordered table-striped">
  <thead class="table-primary">
    <tr>
      <th>No</th>
      <th>Judul</th>
      <th>Penulis</th>
      <th>Tahun</th>
      <th>Kategori</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 1; foreach ($buku as $b): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $b->judul ?></td>
        <td><?= $b->penulis ?></td>
        <td><?= $b->tahun ?></td>
        <td><?= $b->kategori ?></td>
        <td>
          <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $b->id ?>">Edit</a>
          <a href="#" class="btn btn-danger btn-sm btn-hapus" data-id="<?= $b->id ?>">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
    <form method="get" action="<?= base_url('index.php/buku') ?>" class="mb-3">
    <div class="input-group">
        <input type="text" name="keyword" class="form-control" placeholder="Cari judul / penulis..." value="<?= $this->input->get('keyword') ?>">
        <button type="submit" class="btn btn-primary">Cari</button>
        <?php if ($this->input->get('keyword')): ?>
        <a href="<?= base_url('index.php/buku') ?>" class="btn btn-secondary">Reset</a>
        <?php endif; ?>
    </div>
    </form>

</table>
<script>
  document.querySelectorAll('.btn-hapus').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.getAttribute('data-id');
      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "<?= base_url('index.php/buku/hapus/') ?>" + id;
        }
      })
    });
  });
</script>
<script>
  document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.getAttribute('data-id');
      Swal.fire({
        title: 'Edit Data?',
        text: "Kamu akan diarahkan ke halaman edit data ini.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, lanjutkan',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "<?= base_url('index.php/buku/edit/') ?>" + id;
        }
      });
    });
  });
</script>
<div class="mt-3">
  <?= $pagination ?>
</div>
