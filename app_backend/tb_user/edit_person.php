<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
        include '../../administrator/connect.php';

        $id = $_POST['id'];
        $person_id = $_POST['person_id'];
        $prefix = $_POST['prefix'];
        $firtname = $_POST['firtname'];
        $lastname = $_POST['lastname'];
        $idcard = $_POST['idcard'];
        $position_id = $_POST['position_id'];
        $house_num = $_POST['house_num'];
        $province_id = $_POST['province_id'];
        $districts_id = $_POST['districts_id'];
        $amphures_id = $_POST['amphures_id'];

        $sql= "UPDATE tb_person SET person_id     = '".$person_id."',
                                    prefix        = '".$prefix."',
                                    firtname      = '".$firtname."',
                                    lastname      = '".$lastname."',
                                    idcard        = '".$idcard."',
                                    position_id   = '".$position_id."',
                                    house_num     = '".$house_num."',
                                    province_id   = '".$province_id."',
                                    districts_id  = '".$districts_id."',
                                    amphures_id   = '".$amphures_id."'
                              WHERE id = '".$id."'";
        //echo $sql;
        $db_query = mysqli_query($conn,$sql);
        //echo '<br>';
        //echo $db_query;
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อย')</script>";
        echo "<script>window.location='tb_user.php'</script>";
    ?>

  </body>
</html>