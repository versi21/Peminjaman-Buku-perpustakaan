<?php include 'layout/header.php'; ?>
<?php 
  include('system/fungsi.php');

  $make = new Core();
  $make->check_session('admin');
?>
<?php include 'layout/menu.php' ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title">
                    <h2>Pengembalian buku</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- isinya disini -->
                    <div class="row">
                    <div class="col-md-7">
                    <h4>Masukan barcode Anggota dan Buku</h4>
                     <form class="form-inline">
                      <div class="form-group">
                        <input type="text" id="uid_ang" class="form-control" placeholder="ID Anggota">
                        <input type="hidden" id="anggota_id" name="anggota_id">
                      </div>
                      <div class="form-group">
                        <input type="text" id="uid_buku" class="form-control" placeholder="ID Buku">
                        <input type="hidden" id="buku_id" name="buku_id">
                      </div>
                      <button id="btnCariPinjaman" type="button" class="btn btn-success btn-sm">Cari</button>
                    </form>
                    </div>
                    
                    </div>

                    <!-- tabel -->
                    <div id="munculkandata"></div>
                  <!-- /isi -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include 'layout/footer.php' ?>
<script type="text/javascript">
  $(document).ready(function() {
    // keyup uid anggota
    $('#uid_ang').keyup(function(event) {
      /* Act on the event */
      uid_ang = $('#uid_ang').val();
      $.getJSON('getDataPeminjaman.php', {uid_ang: uid_ang, type: 'anggota'}, function(json, textStatus) {
          /*optional stuff to do after success */
          // console.log('json',json);
          $('#anggota_id').val(json.id_anggota);
          // $('#nama_ang').html('Nama anggota : <b><u>'+json.nama+'</u></b>');
          // $('#uid_buku').removeAttr('disabled');
      });
    });
    // keyup uid buku
    $('#uid_buku').keyup(function(event) {
      /* Act on the event */
      uid_buku = $('#uid_buku').val();
      $.getJSON('getDataPeminjaman.php', {uid_buku: uid_buku, type: 'buku'}, function(json, textStatus) {
          /*optional stuff to do after success */
          // console.log('json',json);
          $('#buku_id').val(json.id_buku);
          // $('#nama_buku').html('Nama Buku : <b><u>'+json.judul+'</u></b> | Stok : '+json.stok);
      });
    });

    // dataTable
    // dt = $('#tabelku').DataTable({
    //   'prosessing': true,
    //   "serverSide": true,
    //   "ajax": "system/scripts/server_processing_daftarpeminjaman.php"
    // });

    // btn simpan klik
    $('#btnCariPinjaman').click(function(event) {
      // console.log('yeh');
      var dataInput = {
        anggota_id: $('#anggota_id').val(),
        buku_id :$('#buku_id').val(),
        // tgl_pinjam: (new Date()).toISOString().substring(0,10),
      }

      $.ajax({
        url: 'getDataPinjamBuku.php',
        type: 'GET',
        dataType: 'html',
        data: dataInput,
      })
      .success(function(res){

        $('#munculkandata').html(res);
      }).error(function(er) {

        alert(er);
        return false;
      });;
      
    });

  });
  // function opencekdenda
  function aksiPengembalian(id, jenis)
  {
    // alert(id);
    if (jenis == 'kembalikan') {
      confirm('Yakin ingin mengembalikan buku?');
    }
    $.getJSON('aksiCheckPengembalian.php', {id: id, aksi: jenis}, function(json, textStatus) {
      var js = json;
      if(js.berhasil == 'update_stok'){
        location.reload(true);
        return false;
      }
      alert('Jumlah hari telat : '+js.jml_hari_telat+ ' & Total denda : Rp '+js.total_denda);
    });
  }
</script>