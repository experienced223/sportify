<!DOCTYPE html>


<script type="text/javascript">
  var array_italy_id = [];
  var array_italy_url = [];
  var array_italy_threshold = [];
  var array_international_id = [];
  var array_international_url = [];
  var array_international_threshold = [];
<?php
  //including the database connection file
  include_once("./php/config.php");
  //fetching data in descending order (lastest entry first)
  //$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
  $result_italy = mysqli_query($mysqli, "SELECT * FROM italy ORDER BY id ASC"); // using mysqli_query instead
  while($res_italy = mysqli_fetch_array($result_italy)) {
?>
    array_italy_id.push("<?php echo $res_italy['id']?>");
    array_italy_url.push("<?php echo $res_italy['url']?>");
    array_italy_threshold.push("<?php echo $res_italy['threshold']?>");
    
<?php
  }
?>
<?php
  $result_international = mysqli_query($mysqli, "SELECT * FROM international ORDER BY id ASC"); // using mysqli_query instead
  while($res_international = mysqli_fetch_array($result_international)) {
?>
    array_international_id.push("<?php echo $res_international['id']?>");
    array_international_url.push("<?php echo $res_international['url']?>");
    array_international_threshold.push("<?php echo $res_international['threshold']?>");

<?php
  }
?>
</script>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Playlist Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="./plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="./dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="./dist/css/playlist.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="./dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="./plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            PLAYLISTS FOLLOWERS WEB DASHBOARD
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h1 class="box-title">
                  ITALY
                  <small>IT</small>
                  </h1>
                  <a data-toggle="collapse" href="#box-body1"><i class="fa fa-angle-down pull-right"></i></a>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive collapse in" id="box-body1">
                  <table id="italy" class="table table-bordered table-hover table table-striped col-xs-12 col-md-12">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th class="noExport">SEL</th>
                        <th onclick="sortTable(2, 'italy')">NAME</th>
                        <th onclick="sortTable(3, 'italy')">LINK</th>
                        <th onclick="sortTable(4, 'italy')">LIVE NOW</th>
                        <th onclick="sortTable(5, 'italy')">THRESHOLD</th>
                        <th onclick="sortTable(6, 'italy')">AMOUNT TO REFILL</th>
                        <th class="noExport">EDIT</th>
                        <th class="noExport">REMOVE</th>
                      </tr>
                    </thead>
                    <tbody id="italy_tb">
                      
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box">
                <div class="box-header">
                  <h1 class="box-title">INTERNATIONAL
                    <small>US</small>
                  </h1>
                  <a data-toggle="collapse" href="#box-body2"><i class="fa fa-angle-down pull-right"></i></a>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive  collapse in" id="box-body2">
                  <table id="international" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th class="noExport">SEL</th>
                        <th onclick="sortTable(2, 'international')">NAME</th>
                        <th onclick="sortTable(3, 'international')">LINK</th>
                        <th onclick="sortTable(4, 'international')">LIVE NOW</th>
                        <th onclick="sortTable(5, 'international')">THRESHOLD</th>
                        <th onclick="sortTable(6, 'international')">AMOUNT TO REFILL</th>
                        <th class="noExport">EDIT</th>
                        <th class="noExport">REMOVE</th>
                      </tr>
                    </thead>
                    <tbody id="international_tb">
                      
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box">
                <div class="box-body row">
                  <div class="col-md-3 col-xs-12"><button class="btn btn-block btn-success btn-lg" id="all_convert">EXPORT ALL PLAYLISTS</button></div>
                  <div class="col-md-3 col-xs-12"><button class="btn btn-block btn-success btn-lg" id="selected_convert">EXPORT SELECTED PLAYLISTS</button></div>
                  <div class="col-md-3 col-xs-12"><button class="btn btn-block btn-success btn-lg" id="below_threshold_convert">EXPORT PLAYLIST BELOW THRESHOLD</button></div>
                  <div class="col-md-3 col-xs-12"><button class="btn btn-block btn-success btn-lg" id="add_playlist" data-toggle="modal" data-target="#add_playlist_modal">ADD PLAYLIST</button></div>
                </div>
              </div>

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2020-2021</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- Modal -->
    <div id="remove_tr" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete Playlist</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete your playlist?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="delete_tr">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>

      </div>
    </div>


    <div id="add_playlist_modal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Playlist</h4>
          </div>
          <div class="modal-body">
              <div class="radio">
                <label><input type="radio" name="optradio" checked value="italy">Italy Playlist</label>
              </div>
              <div class="radio">
                <label><input type="radio" name="optradio" value="international">International Playlist</label>
              </div>
              <div class="form-group">
                <label>URL:</label>
                <input type="text" class="form-control" name="url" id="url">
              </div>
              <div class="form-group">
                <label>Threshold:</label>
                <input type="text" class="form-control" name="threshold" id="threshold">
              </div>
              
          </div>
          <div class="modal-footer">
            <button type="submit" name="Submit" class="btn btn-default" data-dismiss="modal" id="add_playlist_confirm">Add</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>

      </div>
    </div>

    <div id="edit_tr" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">EDIT Playlist</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label>URL:</label>
                <input type="text" class="form-control" name="edit_url" id="edit_url">
              </div>
              <div class="form-group">
                <label>Threshold:</label>
                <input type="text" class="form-control" name="edit_threshold" id="edit_threshold">
              </div>
              
          </div>
          <div class="modal-footer">
            <button type="submit" name="Submit" class="btn btn-default" data-dismiss="modal" id="edit_confirm">EDIT</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>

      </div>
    </div>


    <!-- jQuery 2.1.3 -->
    <script src="./plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="./bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./dist/js/playlist.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="./plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="./plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="./plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='./plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    
    <!-- page script -->
    <!-- iCheck 1.0.1 -->
    <script src="./plugins/iCheck/icheck.min.js" type="text/javascript"></script>

    <script src="http://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

    <script type="text/javascript">
      $(function () {
        $("#international").dataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": false
        });
        $('#italy').dataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": false
        });
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
      });
      
    </script>
  </body>
</html>
