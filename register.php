<!-- ملف يحتوي واجهة انشاء حساب وبرمجتها -->
<!-- بدء كود البي اتش بي الخاص ببرمجة الواجهة -->
<?php
//  استدعاء ملف الاتصال بقاعدة البيانات
require('config.php');
// كود للتحقق من حقول الفورم التي يقوم الشخص بإدخال البيانات الخاصة به فيها
// هل الاسم الاول ليس فارغ 
if (isset($_REQUEST['firstname'])) {
  // هل كلمة المرور تساوي اعادة كلمة المرور 
  if ($_REQUEST['password'] == $_REQUEST['confirm_password']) {
// دالة لازالة علامة التنصيص من النص الخارج من حقل الاسم الاول
$firstname = stripslashes($_REQUEST['firstname']);
  // دالة لجعل النص المكتوب في حقل الاسم الاول صالح للتعامل معه الداتا بيز 
    $firstname = mysqli_real_escape_string($con, $firstname);
// دالة لازالة علامة التنصيص من النص الخارج من حقل الاسم الاخير
$lastname = stripslashes($_REQUEST['lastname']);
  // دالة لجعل النص المكتوب في حقل الاسم الاخير صالح للتعامل معه الداتا بيز 
  $lastname = mysqli_real_escape_string($con, $lastname);
// دالة لازالة علامة التنصيص من النص الخارج من حقل الايميل
$email = stripslashes($_REQUEST['email']);
  // دالة لجعل النص المكتوب في حقل الايميل صالح للتعامل معه الداتا بيز 
  $email = mysqli_real_escape_string($con, $email);


// دالة لازالة علامة التنصيص من النص الخارج من حقل كلمة المرور
    $password = stripslashes($_REQUEST['password']);
      // دالة لجعل النص المكتوب في حقل كلمة المرور صالح للتعامل معه الداتا بيز 

    $password = mysqli_real_escape_string($con, $password);

// متغير لتسجيل الوقت الحالي الذي يتم انشاء الحساب فيه
// باستخدام فورمات معين سنة شعر يوم ساعة دقيقة ثانية
    $trn_date = date("Y-m-d H:i:s");
// استعلام لتخزين البيانات الخاص بالمستخدم الجديد في الداتا بيز 
    $query = "INSERT into `users` (firstname, lastname, password, email, trn_date) VALUES ('$firstname','$lastname', '" . md5($password) . "', '$email', '$trn_date')";
    // ارسال الاستعلام لقاعدة البيانات وتخزين الاستجابة في متغير
    $result = mysqli_query($con, $query);
    // فحص للتحقق هل تم انشاء الحساب أم هناك مشكلة
    if ($result) {
      // في حالة تم انشاء الحساب بنجاح يتم التحويل لواجهة تسجيل الدخول
      header("Location: login.php");
    }
  } else {
    // لو لم يتم تسجيل بيانات المستخدم في قاعدة البيانات في قاعدة البيانات يتم اظهار رسالة تفيد أن كلمة المرور خاطئة
    echo ("خطأ: الرجاء التاكد من كلمة المرور");
  }
}
?>
<!-- بدء كود الاتش تي ام ال الخاص بالواجهات  -->
<!DOCTYPE html>
<html lang="en">
<!-- بدء الهيدر  -->
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>تسجيل حساب جديد</title>

  <!-- Bootstrap core CSS -->
  <!-- استدعاء ملف مكتبة البوتسراب الخاصة بالتصميم -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- بدء كود ال سي اس اس الخاص بتنسيق الصفحة -->
  <style>
    body {
      color: #000;
      background: #fff;
      font-family: 'Roboto', sans-serif;
    }

    .form-control {
      height: 40px;
      box-shadow: none;
      color: #969fa4;
    }

    .form-control:focus {
      border-color: #5cb85c;
    }

    .form-control,
    .btn {
      border-radius: 3px;
    }

    .signup-form {
      width: 450px;
      margin: 0 auto;
      padding: 30px 0;
      font-size: 15px;
    }

    .signup-form h2 {
      color: #636363;
      margin: 0 0 15px;
      text-align: center;
    }

    .signup-form h2:before,
    .signup-form h2:after {
      content: "";
      height: 2px;
      width: 30%;
      background: #d4d4d4;
      position: absolute;
      top: 50%;
      z-index: 2;
    }

    .signup-form h2:before {
      left: 0;
    }

    .signup-form h2:after {
      right: 0;
    }

    .signup-form .hint-text {
      color: #999;
      margin-bottom: 30px;
      text-align: center;
    }

    .signup-form form {
      color: #999;
      border-radius: 3px;
      margin-bottom: 15px;
      background: #fff;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      padding: 30px;
      border: 1px solid #ddd;
    }

    .signup-form .form-group {
      margin-bottom: 20px;
    }

    .signup-form input[type="checkbox"] {
      margin-top: 3px;
    }

    .signup-form .btn {
      font-size: 16px;
      font-weight: bold;
      min-width: 140px;
      outline: none !important;
    }

    .signup-form .row div:first-child {
      padding-right: 10px;
    }

    .signup-form .row div:last-child {
      padding-left: 10px;
    }

    .signup-form a:hover {
      text-decoration: none;
    }

    .signup-form form a {
      color: #5cb85c;
      text-decoration: none;
    }

    .signup-form form a:hover {
      text-decoration: underline;
    }
  </style>
    <!-- نهاية كود ال سي اس اس الخاص بتنسيق الصفحة -->

</head>
<!-- نهاية الهيدر -->
<body>
  <!-- الفورم الذي يقوم المستخدم بإضافة بياناته فيه -->
  <div class="signup-form">
    <form action="" method="POST" autocomplete="off">
      <h2> تسجيل حساب جديد</h2>
      <div class="form-group">
        <div class="row">
          <div class="col"><input type="text" class="form-control" name="firstname" placeholder="الاسم الاول" required="required"></div>
          <div class="col"><input type="text" class="form-control" name="lastname" placeholder="اسم الاب" required="required"></div>
        </div>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="البريد الالكتروني" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="كلمة المرور " required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="confirm_password" placeholder="تاكيد كلمة المرور" required="required">
      </div>
      <div class="form-group">
        <label class="form-check-label"><input type="checkbox" required="required"> أوافق على <a href="https://tech-code24.net/">شروط الاستخدام </a><a href="https://tech-code24.net/">وسياسة الخصوصية</a></label>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-danger btn-lg btn-block" style="border-radius:0%;">تسجيل</button>
      </div>
    </form>
    <div class="text-center">اذهب لتسجيل الدخول من <a class="text-success" href="login.php">هنا</a></div>
  </div>
</body>
<!-- Bootstrap core JavaScript -->
<!-- استدعاء مكتبة البوتسراب المستخدمة في تصميم الواجهات -->

<script src="js/jquery.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Croppie -->
<script src="js/profile-picture.js"></script>
<!-- Menu Toggle Script -->
<script>
        /* فانكشن خاصة بالقائمة الجانبية من حيث الاظهار والاخفاء */

  $("#menu-toggle").click(function(e) {

    e.preventDefault();

    $("#wrapper").toggleClass("toggled");
  });
</script>
<script>
    //استدعاء مكتبة فيذر للايقونات

  feather.replace()
</script>

</html>