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

                    <h2>Anggota Perpus</h2> ---
                    <!-- <button class="btn btn-info btn-xs" type="button" data-target="#modalAdd" data-toggle="modal">Tambah</button> -->
                    <button class="btn btn-info btn-xs" type=button id="openmodal">Tambah</button>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- isinya disini -->
                    <?php 
                      // include('system/php-mysqli/MysqliDb.php');
                      $db = new MysqliDb();
                     
                      ?>
                      <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Tgl daftar</th>
                            <th>Tgl berakhir</th>
                            <th>UID</th>
                            <th>Aktif / Tdk</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        
                          
                      </table>
                    <!-- <div id="content"></div> -->
                  <!-- /isi -->
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- modal add -->
        <div class="modal fade modal-wide" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"></h4>
              </div>
              <div class="modal-body">
                <form id="formAdd" class="form-horizontal form-label-left" accept-charset="utf-8">
                  <input type="hidden" name="type" id="type" value="">
                  <input type="hidden" name="id_ang" id="id_ang" value="">
                  <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label">TTL</label>
                    <input class="form-control" type="text" name="ttl" id="ttl" placeholder="TTL" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Tgl daftar</label>
                    <input class="form-control" id="tgl_daftar" type="text" name="tgl_daftar" placeholder="Tgl daftar" required>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label">Tgl Berakhir</label>
                    <input class="form-control" id="tgl_berakhir" type="text" name="tgl_berakhir" placeholder="Tgl berakhir" required="">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Status Aktif</label>
                    <select class="form-control" name="status_aktif" id="status_aktif">
                      <option value="1">Aktif</option>
                      <option value="0">Tdk Aktif</option>
                    </select>
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger  btn-round btn-sm" data-dismiss="modal">Close</button>
                <button type="button" id="btnSubmit" class="btn btn-primary btn-round btn-sm"></button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /modal add -->
        <!-- /page content -->
<?php include 'layout/footer.php' ?>


<script type="text/javascript">
  $(document).ready(function() {

      dt = $('#tabelku').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "system/scripts/server_processing_anggota.php"
    });

    // tgl daftar
    $('#tgl_daftar').datepicker({
      format: 'yyyy-mm-dd',
      
    }).on('changeDate', function(e){
      $(this).datepicker('hide');
    });
    // tgl berakhir
    $('#tgl_berakhir').datepicker({
      format: 'yyyy-mm-dd',
      
    }).on('changeDate', function(e){
      $(this).datepicker('hide');
    });

    // click modal
    $('#openmodal').click(function(event) {
      // console.log('aaa');
      // tambah type
      $('#formAdd')[0].reset();
      $('#type').val('new');
      $('#myModalLabel2').html('Tambah Anggota');
      $('#btnSubmit').html('Simpan');
      $('#modalAdd').modal('show');
    });
    // submit form
    $('#btnSubmit').click(function(event) {
      // event.preventDefault();
      // validasi input
      // $('#formAdd').valid();
      // kumpulkan data inputan
      dataInput = {
        type: $('#type').val(),
        id_ang: $('#id_ang').val(),
        nama: $('#nama').val(),
        ttl: $('#ttl').val(),
        tgl_daftar: $('#tgl_daftar').val(),
        tgl_berakhir: $('#tgl_berakhir').val(),
        status_aktif: $('#status_aktif').val()
      };

      console.log(dataInput);
      $.ajax({
        url: 'proses_anggota.php',
        type: 'POST',
        dataType: 'json',
        data: dataInput,
      })
      .success(function(res){
        console.log(res);
        $.notify(res.pesan, res.type);
        $('#modalAdd').modal('hide');
        $('#formAdd')[0].reset();
        // $('#modalAdd').remove();
        dt.ajax.reload();
      });
      
    });

  });

  // function edit
  function editModal(id_ang)
  {
    if (id_ang)
    {
      $.ajax({
        url: 'getEditAnggota.php',
        type: 'GET',
        dataType: 'json',
        data: {id_ang: id_ang},
      })
      .success(function(res) {
        console.log(res);
        // dat.nama.val(res.nama);
        $('#type').val('edit');
        $('#id_ang').val(res.id_anggota);
        $('#nama').val(res.nama);
        $('#ttl').val(res.ttl);
        $('#tgl_daftar').val(res.tgl_daftar);
        $('#tgl_berakhir').val(res.tgl_berakhir);
        $('#status_aktif').val(res.status_aktif);
        // show atribut modal
        $('#myModalLabel2').html('Edit Anggota');
        $('#btnSubmit').html('Edit');
        $('#modalAdd').modal('show');
      })
      .error(function(er) {
        console.log(er);
      });;
      
    }else{
      alert('id anggota kosong');
    }
  }
  // function delete
  function deleteModal(id_ang)
  {
    if (id_ang)
    {
      var conf = confirm('Yakin ingin menghapus?');
      if (conf)
      {
        $.ajax({
          url: 'hapus.php',
          type: 'POST',
          dataType: 'json',
          data: {id: id_ang, type: 'anggota'},
        })
        .success(function(response) {
          console.log(response);
          $.notify(response, 'success');
          dt.ajax.reload();
        });
      }
    }
    else {
      alert('Gagal hapus');
    }
  }
  // cetka kartu
  function cetakKartu(id_ang)
  {
    if (id_ang)
      {
        var left = (screen.width/2) - (800/2);
        var right = (screen.height/2) - (640/2);

        var url = 'getKartuAnggota.php?uid='+id_ang;

        window.open(url, '', 'width=800, height=640, scrollbars=yes, left='+left+', top='+top+'');
      } else {
        alert('UID tidak diketahui');
      }
    
  }
  
</script>