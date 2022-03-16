<!-- الملف الخاص بتسجيل الدخول  يتم عرض الواجهة مع برمجتها -->

<!--كود البي اتش بي الخاص بالتحقق من عملية تسجيل الدخول -->
<?php
//يتم الاتصال بلمف الكونفيج الخاص بالاتصال بقاعدة البيانات
require('config.php');
// يتم بدأ السيشن لتسهيل تخزين بيانات المستخدم وكل البيانات اللازمة خلال التنقل بين الصفحات
session_start();
// تعريف تغير لتخزين اسم الايرور التي تظهر 
$errormsg = "";
// يتم التحقق من حقل النص يحتوي فارغ أم لا
if (isset($_POST['email'])) {
// دالة لازالة علامة التنصيص من النص الخارج من حقل الايميل
  $email = stripslashes($_REQUEST['email']);
  // دالة لجعل النص المكتوب في حقل الايميل صالح للتعامل معه الداتا بيز 
  $email = mysqli_real_escape_string($con, $email);
  // دالة لازالة علامة التنصيص من النص الخارج من حقل كلمة المرور
  $password = stripslashes($_REQUEST['password']);
    // دالة لجعل النص المكتوب في حقل كلمة المرور صالح للتعامل معه الداتا بيز 
  $password = mysqli_real_escape_string($con, $password);
  // جملة الاستعلام عن وجود المستخدم الذي يحمل الايميل وكلمة المرور
  $query = "SELECT * FROM `users` WHERE email='$email'and password='" . md5($password) . "'";
  // تنفيذ جملة الاستعلام واذا كان المستخدم موجود في قاعدة البيانات أم لا
  $result = mysqli_query($con, $query) or die(mysqli_error($con));
/*    جملة للتحقق اذا كان هناك صف يضم بيانات المستخدم،
   حيث اذا كان هناك يوز يتم يكون الناتج واحدواذا كان لا يكون الناتج 0 */
  $rows = mysqli_num_rows($result);
  if ($rows == 1) {
    // اذا كان نعم قم بتخزين الايميل الخاص به في السيشن وقم باظهار الصفحة الرئيسية في الموقع
    $_SESSION['email'] = $email;
    header("Location: index.php");
  } else {
  //اذا كان لا قم بتخزين نوع الايرور في المتغير الذي تم تعريفه سابقا للايرورز
    $errormsg  = "Wrong";
  }
} else {
}

?>
<!-- كود الاتش تي ام ال الخاص بعرض واجهة تسجيل الدخول -->
<!DOCTYPE html>
<html lang="en">
<!-- بداية الهيدر -->
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>تسجيل الدخول</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- بداية  كود السي اسس الخاص بتنسيق كود الاتش تي ام ال -->
  <style>
    .login-form {
      width: 340px;
      margin: 50px auto;
      font-size: 15px;
    }

    .login-form form {
      margin-bottom: 15px;
      background: #fff;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      padding: 30px;
      border: 1px solid #ddd;
    }

    .login-form h2 {
      color: #636363;
      margin: 0 0 15px;
      position: relative;
      text-align: center;
    }

    .login-form h2:before,
    .login-form h2:after {
      content: "";
      height: 2px;
      width: 30%;
      background: #d4d4d4;
      position: absolute;
      top: 50%;
      z-index: 2;
    }

    .login-form h2:before {
      left: 0;
    }

    .login-form h2:after {
      right: 0;
    }

    .login-form .hint-text {
      color: #999;
      margin-bottom: 30px;
      text-align: center;
    }

    .login-form a:hover {
      text-decoration: none;
    }

    .form-control,
    .btn {
      min-height: 38px;
      border-radius: 2px;
    }

    .btn {
      font-size: 15px;
      font-weight: bold;
    }
  </style>
    <!-- نهاية  كود السي اسس الخاص بتنسيق كود الاتش تي ام ال -->

</head>
<!-- نهاية الهيدر -->

<body>
  <div class="login-form">
    <!-- الفورم الذي يتم من خلاله كتابة الايميل وكلمة المرور -->
    <form action="" method="POST" autocomplete="off">
      <h2 class="text-center">نظام المصاريف اليومية</h2>
      <p class="hint-text">لوحة الدخول</p>
      <div class="form-group">
        <input type="text" name="email" class="form-control" placeholder="البريد الالكتروني" required="required">
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="كلمة السر" required="required">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success btn-block" style="border-radius:0%;">تسجيل الدخول </button>
      </div>
      <div class="clearfix">
        <label class="float-left form-check-label"><input type="checkbox"> ذكرني</label>
        
      </div>
    </form>
    <p class="text-center">هل لديك حساب ؟<a href="register.php" class="text-danger"> انشاء حساب</a></p>
  </div>
</body>
<!-- Bootstrap core JavaScript -->
<!-- استدعاء مكتبة البوتسراب المستخدمة في تصميم الواجهات -->
<script src="js/jquery.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Menu Toggle Script -->
<script>
  // كود جي كويري في حال الضغط على العنصر الذي يحتوي اسم الكلام منيو توجل لتنفيذ كود معين  
  $("#menu-toggle").click(function(e) {
    // الغاء تحديث الصفحة عند تتنفيذ الأمر
    e.preventDefault();
    // يتم تغير اضافة اسم الكلاس أو حذفه عند تنفيذ الدالة
    $("#wrapper").toggleClass("toggled");
  });
</script>
<script>
  // مكتبة فيذر للايقونات
  feather.replace()
</script>

</html>