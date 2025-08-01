<h3><?= $judul ?></h3>

<?php if ($this->session->flashdata('success')): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '<?= $this->session->flashdata('success') ?>',
      showConfirmButton: false,
      timer: 2000
    });
  });
</script>
<?php endif; ?>

<form id="formBuku" method="post" action="">
  <div class="mb-3">
    <label>Judul Buku</label>
    <input type="text" name="judul" class="form-control" 
      value="<?= set_value('judul', isset($buku) ? $buku->judul : '') ?>">
    <?= form_error('judul', '<small class="text-danger">', '</small>') ?>
  </div>

  <div class="mb-3">
    <label>Penulis</label>
    <input type="text" name="penulis" class="form-control" 
      value="<?= set_value('penulis', isset($buku) ? $buku->penulis : '') ?>">
    <?= form_error('penulis', '<small class="text-danger">', '</small>') ?>
  </div>

  <div class="mb-3">
    <label>Tahun Terbit</label>
    <input type="number" name="tahun" class="form-control" 
      value="<?= set_value('tahun', isset($buku) ? $buku->tahun : '') ?>">
    <?= form_error('tahun', '<small class="text-danger">', '</small>') ?>
  </div>

  <div class="mb-3">
    <label>Kategori</label>
    <select name="kategori" class="form-control">
        <option value="">-- Pilih Kategori --</option>
        <?php
        $daftar_kategori = ['Fiksi', 'Nonfiksi', 'Teknologi', 'Edukasi', 'Komik'];
        $kategori_terpilih = set_value('kategori', isset($buku) ? $buku->kategori : '');
        foreach ($daftar_kategori as $kategori) {
            $selected = ($kategori == $kategori_terpilih) ? 'selected' : '';
            echo "<option value='$kategori' $selected>$kategori</option>";
        }
        ?>
    </select>
    <?= form_error('kategori', '<small class="text-danger">', '</small>') ?>
  </div>

  <button type="button" id="btn-konfirmasi" class="btn btn-primary">
    <?= isset($buku) ? 'Update' : 'Simpan' ?>
  </button>
  <a href="<?= base_url('index.php/buku') ?>" class="btn btn-secondary">Kembali</a>
</form>

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('btn-konfirmasi').addEventListener('click', function () {
  Swal.fire({
    title: 'Simpan Data?',
    text: "Pastikan data sudah benar.",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Ya, simpan',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('formBuku').submit();
    }
  });
});
</script>
