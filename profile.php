<!-- ملف خاص بواجهات البروفايل وبرمجته -->
<!-- بدء كود البي اتش بي الخاص ببرمجة واجهة البروفايل -->
<?php
/* استدعاء ملف الكونفيج الخاص بالاتصال بقاعدة البيانات */
include("session.php");
/* جملة استعلام عن البيانات الخاص باليوزر الذي قد سجل دخوله عن طريق الاي دي */
$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");
/* عند الضغط على حفظ البيانات يتم عمل الاتي  */
if (isset($_POST['save'])) {
    /* يتم جلب الاسم الاول والاسم الاخير من الحقول الخاصة بهم في الفورم وتخزينها في متغير */
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    /* جملة كويري لتعديل الاسم الاول والاسم الاخير الخاصان باليوزر في قاعدة البيانات */
    $sql = "UPDATE users SET firstname = '$fname', lastname='$lname' WHERE user_id='$userid'";
    /* فحص اذا تمت عملية تحديث البيانات بنجاح أم لا */
    if (mysqli_query($con, $sql)) {
        /* في حال تمت يتم اظهار رسالة تفيد نجاح العملية */
        echo "تم التحديث.";
    } else {
        /* في حال لم تتم يتم طباعة المشكلة التي تمت مواجهتها */
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    /* جملة للانتقال لصفحة البروفايل أي تحديث الصفحة بعد نجاح العملية */
    header('location: profile.php');
}
/* في حال تم الضغط على زر اضافة صورة */
if (isset($_POST['but_upload'])) {
/* يتم تخزين الصورة في متغير مع اسمها */
    $name = $_FILES['file']['name'];
    /* متغيران بتخزين المسار الذي سيتم حفظ الصورة فيه */
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    /* يتم تخزين الصورة المراد رفعها في المتغير التالي */
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    /* تخصيص أنواع معينة يجب أن تكون الصورة المراد رفها ضمنها */
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    // Check extension
    /* يتم فحص نوع الملف المرفوع هل يوجد بين الأنواع التي تم تحديدها سابقا ، أي في المتغير أعلاه */
    if (in_array($imageFileType, $extensions_arr)) {

        // Insert record
        /* جملة كويري لإضافة عنوان الصورة ولأي مستخدم في الداتا بيز */
        $query = "UPDATE users SET profile_path = '$name' WHERE user_id='$userid'";
        /* تنفيذ الأمر في الداتا بيز */
        mysqli_query($con, $query);

        // Upload file
        /* نقل الصورة في ملف الابديتس الموجود في المشروع */
        move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name);
/* عملية تحديث للصفحة */
        header("Refresh: 0");
    }
}

?>
<!-- نهاية كود البي اتش بي الخاص ببرمجة واجهة البروفايل -->
<!-- بدداية الكود الاتش تي أم ال الخاص بالتصميم -->
<!DOCTYPE html>
<html lang="en">
<!-- بداية الهيدر الخاص بصفحة الاتش تي ام ال -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>الملف الشخصي</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

</head>
<!-- نهاية الهيدر الخاص بصفحة الاتش تي ام ال -->

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>
            <div class="sidebar-heading">ادارة</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span> لوحة التحكم</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> اضافة المصاريف</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span>ادارة جميع المصاريف</a>
            </div>
            <div class="sidebar-heading">اعدادات </div>
            <div class="list-group list-group-flush">
                <a href="profile.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="user"></span> ملفي الشخصي</a>
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> تسجيل خروج</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.php">ملفي الشخصي</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">تسجيل الخروج</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                    <h3 class="mt-4 text-center">تحديث الحساب</h3>
                    <hr>
                        <form class="form" method="post" action="" enctype='multipart/form-data'>
                            <div class="text-center mt-3">
                                <img src="<?php echo $userprofile; ?>" class="text-center img img-fluid rounded-circle avatar" width="120" alt="Profile Picture">
                            </div>
                            <div class="input-group col-md mb-3 mt-3">
                                <div class="custom-file">
                                    <input type="file" name='file' class="custom-file-input" id="profilepic" aria-describedby="profilepicinput">
                                    <label class="custom-file-label" for="profilepic">تغير الصورة</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit" name='but_upload' id="profilepicinput">رفع الصورة</button>
                                </div>
                            </div>


                        </form>


                        
                        <form class="form" action="" method="post" id="registrationForm" autocomplete="off">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">

                                        <div class="col-md">
                                            <label for="first_name">
                                                الاسم الاول
                                            </label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="الاسم الاول" value="<?php echo $firstname; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">

                                        <div class="col-md">
                                            <label for="last_name">
                                             اسم الاب
                                            </label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $lastname; ?>" placeholder="اسم الاب">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-md">
                                    <label for="email">
                                       البريد الالكتروني 
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $useremail; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md">
                                    <br>
                                    <button class="btn btn-block btn-md btn-success" style="border-radius:0%;" name="save" type="submit">حفظ التغيرات</button>
                                </div>
                            </div>
                        </form>
                        <!--/tab-content-->

                    </div>
                    <!--/col-9-->
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <!-- استدعاء الملفات الهامة الخاصة بمكتبة البوتسراب -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace()
    </script>
    <script type="text/javascript">
        /* الكود الخاص بزر رفع الصورة */
        $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function() {
                readURL(this);
            });
        });
    </script>

</body>
<!-- نهاية الكود الاتش تي أم ال الخاص بالتصميم -->

</html>