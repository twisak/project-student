<?php
    include('../../../config/connect.php');
    include('../../../config/constant.php');

    $username= $_SESSION['username'];

    $sql ="SELECT * FROM account_login WHERE username = '".$username."' ";
    $query = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        $person_id = $row['person_id'];
    }

    $sql1 ="SELECT * FROM tb_person WHERE person_id = '".$person_id."' ";
    $query1 = mysqli_query($conn,$sql1);
    while($row1 = mysqli_fetch_array($query1,MYSQLI_ASSOC))
    {
        $prefix = $row1['prefix'];
        $firtname = $row1['firtname'];
        $lastname = $row1['lastname'];
        $person_id = $row1['person_id'];
        // $prefix = $row1['prefix'];
    }//echo $prefix;
?>
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
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo ROOT_PROJECT_FRONTEND; ?>/assets/images/favicon.png">
    <title>AdminWrap - Easy to Customize Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo ROOT_PROJECT_FRONTEND; ?>/assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo ROOT_PROJECT_FRONTEND; ?>/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo ROOT_PROJECT_FRONTEND; ?>/css/colors/default.css" id="theme" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
    <link href="<?php echo ROOT_PROJECT_FRONTEND; ?>/css/google_fonts/fonts_prompt.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border fix-sidebar">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Wrap</p>
        </div>
    </div>
    <div id="main-wrapper">
        <?php include '../../mamu/manu_admin.php'; ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">เอกสารสัญญายืม</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">เอกสารสัญญายืม</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="../lend/add_action.php" name="insertlend" method="post">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <label>
                                                        <h4><b><u>กรอกเอกสารสัญญายืม</u></b></h4>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        $sql = "Select Max(substr(doc_id,3)+1) as MaxID from tb_lend ";
                                        $query = mysqli_query($conn,$sql);
                                        $table_id = mysqli_fetch_assoc($query);
                                        $testid = $table_id['MaxID'];
                                                if($testid=='')
                                                {
                                                    $id="L001";
                                                }else
                                                {
                                                    $id="L".sprintf("%03d",$testid);
                                                }
                                    ?>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>รหัสเอกสารสัญญายืม</b></label>
                                                <input type="text" value="<?=$id?>" readonly class="form-control form-control-line">
                                                <input type="hidden" name="doc_id" value="<?=$id?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>เริ่มต้นวันที่</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="date" class="form-control form-control-line" name="str_date" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>สิ้นสุดวันที่</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="date" class="form-control form-control-line" name="stp_date" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php
                                            $sql_person = "select * from tb_person";
                                            $query_person = mysqli_query($conn,$sql_person);
                                            ?>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><b>ชื่อบุคลากร</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <select name="person_id" class="form-control" required>
                                                    <option value="">-- เลือกรายชื่อบุคลากร --</option>
                                                    <?php
                                                        $sql = "SELECT * FROM tb_person";
                                                        $query = mysqli_query($conn, $sql);
                                                        while($result = mysqli_fetch_assoc($query)):
                                                    ?>
                                                    <option value="<?=$result['person_id']?>"><?=$result['prefix']?><?=$result['firtname']?>&nbsp;&nbsp;<?=$result['lastname']?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <?php
                                            $sql_teacher = "select * from tb_teacher";
                                            $query_teacher = mysqli_query($conn,$sql_teacher);
                                            ?>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><b>ชื่ออาจารย์</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <select class="form-control" name="teacher_id" required>
                                                    <option value="">-- เลือกรายชื่ออาจารย์ --</option>
                                                    <?php
                                                        while($result_teacher=mysqli_fetch_array($query_teacher))
                                                        {
                                                        ?>
                                                    <option value='<?php echo $result_teacher['teacher_id'];?>'><?php echo $result_teacher['t_firstname'];?>&nbsp;&nbsp;<?php echo $result_teacher['t_lastname'];?></option>
                                                    <?php
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><b>โครงการ</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <select name="project_id" id="project" class="form-control" required> 
                                                    <option value="">-- เลือกชื่อโครงการ --</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tb_project";
                                                    $query = mysqli_query($conn, $sql);
                                                    while($result = mysqli_fetch_assoc($query)):
                                                ?>
                                                    <option value="<?=$result['project_id']?>"><?=$result['project_name']?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="activity"><b>ชื่อกิจกรรม</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <select name="activity_id" id="activity" class="form-control" required>
                                                    <option value="">-- เลือกชื่อกิจกรรม --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <script language="javascript">
                                        function IsNumeric(sText, obj) {
                                            var ValidChars = "0123456789/";
                                            var IsNumber = true;
                                            var Char;
                                            for (i = 0; i < sText.length && IsNumber == true; i++) {
                                                Char = sText.charAt(i);
                                                if (ValidChars.indexOf(Char) == -1) {
                                                    IsNumber = false;
                                                }
                                            }
                                            if (IsNumber == false) {
                                                alert("(ตัวเลข เท่านั้น)");
                                                obj.value = sText.substr(0, sText.length - 1);
                                            }
                                        }
                                    </script>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label><b>ค่าเบี้ยเลี้ยง</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="text" class="form-control form-control-line" name="allowance" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>ราคา</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="text" class="form-control form-control-line" required name="allowance_price" onKeyUp="IsNumeric(this.value,this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label><b>ค่าที่พัก</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="text" class="form-control form-control-line" name="rest" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>ราคา</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="text" class="form-control form-control-line" required name="rest_price" onKeyUp="IsNumeric(this.value,this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label><b>พาหนะ</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="text" class="form-control form-control-line" name="vehicle" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>ราคา</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="text" class="form-control form-control-line" required name="vehicle_price" onKeyUp="IsNumeric(this.value,this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label><b>ค่าลงทะเบียน/บาท</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="text" class="form-control form-control-line" name="regis" required onKeyUp="IsNumeric(this.value,this)">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>จำนวน/คน</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="number" class="form-control form-control-line" required name="regis_num">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label><b>พาหนะ</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="text" class="form-control form-control-line" required name="other">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><b>ราคา</b></label>&nbsp;<label class="text-danger"><b>*</b></label>
                                                <input type="text" class="form-control form-control-line" required name="other_price" onKeyUp="IsNumeric(this.value,this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><h5><b><u>รายการส่งใช้เงินยืม</u></b></h5></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-info" id="createRows" value="Add">เพิ่มหัวข้อย่อย</button>&nbsp;&nbsp;
                                                <button type="button" class="btn btn-warning" id="deleteRows" value="Del">ลบหัวข้อย่อย</button>&nbsp;&nbsp;
                                                <button type="button" class="btn btn-danger" id="clearRows" value="Clear">ลบทั้งหมด</button>
                                            </div>
                                        </div>
                                    </div>

                                    <table width="100%" border="0" id="myTable">

                                        <thead>
                                        </thead>

                                        <tbody></tbody>
                                    </table>


                                    <br />
                                    <center>
                                        <br>
                                        <input type="hidden" id="hdnCount" name="hdnCount">
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
                                                <button type="button" class="btn btn-danger btn-block" onClick="JavaScript:history.back();">ยกเลิก</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
            <footer class="footer">
                © 2018 Adminwrap by wrappixel.com
            </footer>
        </div>
    </div>
    <script src="<?php echo ROOT_PROJECT_FRONTEND; ?>/assets/node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo ROOT_PROJECT_FRONTEND; ?>/assets/node_modules/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo ROOT_PROJECT_FRONTEND; ?>/assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo ROOT_PROJECT_FRONTEND; ?>/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo ROOT_PROJECT_FRONTEND; ?>/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo ROOT_PROJECT_FRONTEND; ?>/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo ROOT_PROJECT_FRONTEND; ?>/js/custom.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {

        var rows = 1;
        $("#createRows").click(function () {


            var tr = "<tr>";
            tr = tr + "<td><div class='row'><div class='col-md-2'><div class='form-group'><label><b>วัน/เดือน/ปี</b></label></label><input type='date' required class='form-control p_input' name='date_list[]" + rows + "'></div></div><div class='col-md-2'><div class='form-group'><label><b>การชำระ</b></label><select class='form-control' required name='pay_type[]" + rows + "'><option>เงินสด</option><option>ใบสำคัญ</option></select></div></div><div class='col-md-2'><div class='form-group'><label><b>ราคา</b></label></label><input type='text' class='form-control p_input' onKeyUp='IsNumeric(this.value,this)' required name='price_list[]" + rows + "'></div></div><div class='col-md-2'><div class='form-group'><label><b>ยอดคงค้าง</b></label><input type='text' class='form-control p_input' onKeyUp='IsNumeric(this.value,this)' required name='balance[]" + rows + "'></div></div></div></td>";
            tr = tr + "</tr>";
            $('#myTable > tbody:last').append(tr);

            $('#hdnCount').val(rows);
            rows = rows + 1;
        });

        $("#deleteRows").click(function () {
            if ($("#myTable tr").length != 1) {
                $("#myTable tr:last").remove();
            }
        });

        $("#clearRows").click(function () {
            rows = 1;
            $('#hdnCount').val(rows);
            $('#myTable > tbody:last').empty(); // remove all
        });

    });
    </script>
    <!-- listbox 2 ชั้น -->
    <script src="jquery-1.11.1.min.js" type="text/javascript"></script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#project').change(function () {
                            $.ajax({
                                type: 'POST',
                                data: {
                                    project: $(this).val()
                                },
                                url: '../select_activity.php',
                                success: function (data) {
                                    $('#activity').html(data);
                                }
                            });
                            return false;
                        });
                    });
    </script>
    <!-- listbox 2 ชั้น -->
</body>

</html>