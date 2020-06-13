<!-- <?php session_start();
if($_SESSION['position'] == 'admin')
{
}
elseif($_SESSION['position'] == 'staff')
{
}
else
{
    echo "<script>";
    echo "alert(\"คุณไม่มีสิทธิ์เข้าสู่ระบบ\");";
    echo "</script>";
    echo "<meta http-equiv='refresh' content='0;url=../../administrator/logout.php'>";
}
?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>AdminWrap - Easy to Customize Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Wrap</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
    <?php include '../mamu/manu_admin.php'; ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">เพิ่มโครงการ</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">เพิ่มโครงการ</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="https://wrappixel.com/templates/adminwrap/" class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down"> Upgrade to Pro</a>
                    </div>
                </div>

                <script src="http://code.jquery.com/jquery-latest.js"></script>


                <div class="row">

                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                            <?php
                                        include '../../administrator/connect.php';
                                        $sql = "Select Max(substr(project_id,3)+1) as MaxID from tb_project ";
                                        $query = mysqli_query($conn,$sql);
                                        $table_id = mysqli_fetch_assoc($query);
                                        $testid = $table_id['MaxID'];
                                                if($testid=='')
                                                {
                                                    $id="P001";
                                                }else
                                                {
                                                    $id="P".sprintf("%03d",$testid);
                                                }

                            ?>
                                <form class="form-horizontal form-material" action="insert_project.php" name="form_user" method="post">


<div class="row">
  <div class="col-md-2">
  <div class="form-group">
  <label>รหัสโครงการ</label>
<input type="text" name="project_id" value="<?=$id?>" placeholder="" class="form-control form-control-line">
  </div>
  </div>

  <div class="col-md-4">
  <div class="form-group">
  <label>ชื่อโครงการ</label>
  <input type="text" name="project_name" placeholder="" class="form-control form-control-line">
  </div>
  </div>

  <div class="col-md-2">
  <div class="form-group">
  <label>ปีงบประมาณ</label>
  <select class="form-control" name="fiscal_year" id="fiscal_year">
  <?php
  $xYear=date('Y'); // เก็บค่าปีปัจจุบันไว้ในตัวแปร
          echo '<option value="'.$xYear.'">'.$xYear.'</option>'; // ปีปัจจุบัน
  for($i=1;$i<=30;$i++){
  echo '<option value="'.($xYear-$i).'">'.($xYear-$i).'</option>';
    }
  ?>
  </select>

  </div>
  </div>
</div>

<div class="row">

  <?php
  $sql_budget_type = "select * from tb_budget_type";
  $query_budget_type = mysqli_query($conn,$sql_budget_type);
  ?>

  <div class="col-md-3">
  <div class="form-group">
  <label>ประเภทงบประมาณ</label>
  <select class="form-control" name="budget_id">
              <option value="">-- เลือกประเภทงบประมาณ --</option>
      <?php
      while($result_budget_type=mysqli_fetch_array($query_budget_type))
      {
      ?>
           <option value='<?php echo $result_budget_type['budget_id'];?>'><?php echo $result_budget_type['budget_name'];?></option>
      <?php
      }
       ?>
              </select>
  </div>
  </div>


  <?php
  $sql_product = "select * from tb_product";
  $query_product = mysqli_query($conn,$sql_product);
  ?>

  <div class="col-md-3">
  <div class="form-group">
  <label>ผลผลิต</label>
  <select class="form-control" name="product_id">
              <option value="">-- เลือกผลผลิต --</option>
      <?php
      while($result_product=mysqli_fetch_array($query_product))
      {
      ?>
           <option value='<?php echo $result_product['product_id'];?>'><?php echo $result_product['product_name'];?></option>
      <?php
      }
       ?>
              </select>
  </div>
  </div>

  <?php
  $sql_mission = "select * from tb_mission";
  $query_mission = mysqli_query($conn,$sql_mission);
  ?>

  <div class="col-md-3">
  <div class="form-group">
  <label>พันธกิจ</label>
  <select class="form-control" name="mission_id">
              <option value="">-- เลือกพันธกิจ --</option>
      <?php
      while($result_mission=mysqli_fetch_array($query_mission))
      {
      ?>
           <option value='<?php echo $result_mission['mission_id'];?>'><?php echo $result_mission['mission_name'];?></option>
      <?php
      }
       ?>
              </select>
  </div>
  </div>

  <?php
  $sql_strategic = "select * from tb_strategic";
  $query_strategic = mysqli_query($conn,$sql_strategic);
  ?>

  <div class="col-md-3">
  <div class="form-group">
  <label>ยุทธศาสตร์</label>
  <select class="form-control" name="strategic_id">
              <option value="">-- เลือกยุทธศาสตร์ --</option>
      <?php
      while($result_strategic=mysqli_fetch_array($query_strategic))
      {
      ?>
           <option value='<?php echo $result_strategic['strategic_id'];?>'><?php echo $result_strategic['strategic_name'];?></option>
      <?php
      }
       ?>
              </select>
  </div>
  </div>
</div>

<div class="row">
<<<<<<< HEAD
  <div class="col-md-8">
  <div class="form-group">
  <div class="col-md-7"><div class="form-group"><button type="button" class="btn btn-info" id="createRows_activity" value="Add">เพิ่มกิจกรรม</button>&nbsp;&nbsp;<button type="button" class="btn btn-warning" id="deleteRows_activity" value="Del">ลบกิจกรรม</button>&nbsp;&nbsp;<button type="button" class="btn btn-danger" id="clearRows_activity" value="Clear">ลบทั้งหมด</button></div></div>
=======
  <div class="col-md-3">
  <div class="form-group">
  <label>หลักการและเหตุผล</label>
<input type="text" name="principle"  class="form-control form-control-line">
  </div>
  </div>

  <div class="col-md-3">
  <div class="form-group">
  <label>งบประมาณ</label>
  <input type="text" name="budget"  class="form-control form-control-line">
>>>>>>> 5e22eedc7eeb6b8a4daf8d8f361dfbadd7bb085e
  </div>
  </div>
</div>
<table width="100%" border="0" id="myTable_activity">

<thead>
</thead>

<tbody></tbody>
</table>
<br/>
<center>
<br>
<input type="hidden" id="hdnCount_activity" name="hdnCount_activity">
</center>

<div class="row">
<div class="col-md-3">
</div>
<div class="col-md-3">
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block">บันทึก</button>
    </div>
</div>

<div class="col-md-3">
<div class="form-group">
<button type="button" class="btn btn-danger btn-block">ยกเลิก</button>
    </div>
</div>

</div>


<div class="row">
<div class="col-md-3">
</div>
<div class="col-md-3">
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block">บันทึก</button>
    </div>
</div>

<div class="col-md-3">
<div class="form-group">
<button type="button" class="btn btn-danger btn-block">ยกเลิก</button>
    </div>
</div>

</div>







                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2018 Adminwrap by wrappixel.com
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/node_modules/bootstrap/js/popper.min.js"></script>
    <script src="../assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../js/custom.min.js"></script>

</body>

</html>
<script type="text/javascript">
$(document).ready(function(){

    var rows = 1;
    $("#createRows_activity").click(function(){


        var tr = "<tr>";
tr = tr + "<td><div class='row'><div class='col-md-4'><div class='form-group'><label>หัวข้อกิจกรรม</label><input type='text' class='form-control p_input'  name='activity"+rows+"'></div></div></td>";
        tr = tr + "</tr>";
        $('#myTable_activity > tbody:last').append(tr);

        $('#hdnCount_activity').val(rows);
        rows = rows + 1;
    });

    $("#deleteRows_activity").click(function(){
        if ($("#myTable_activity tr").length != 1) {
            $("#myTable_activity tr:last").remove();
        }
    });

    $("#clearRows_activity").click(function(){
        rows = 1;
        $('#hdnCount_activity').val(rows);
        $('#myTable_activity > tbody:last').empty(); // remove all
    });

});
</script>