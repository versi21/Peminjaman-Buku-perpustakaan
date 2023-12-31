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
                    <h2>HOME PERPUSTAKAAN UNIVERSITAS ISLAM NAHDLATUL ULAMA JEPARA</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- isinya disini -->
                    <center><img width="500" height="500" src="assets/images/SDN.jpg" alt="" title="UNISNU" class="img-responsive"></center>

                  <!-- /isi -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include 'layout/footer.php' ?>