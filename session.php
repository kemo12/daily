<!-- كود بدء السيشن الخاص بالموقع يتم من خلاله تسجيل البيانات المطلوبة ا ثناء التنقل بين الواجهات -->
<?php
// استدعاء ملف الكونفيج الذي يحوي كود الاتصال بقاعدة البيانات
include("config.php");
// بدء السيشن
session_start();
// التحقق من وجود الايميل الخاص بالمستخدم بالسيشن ليتم عرض الصفحة
if(!isset($_SESSION["email"])){
  // اذا لم يكن هناك ايميل في السيشن يتم التحويل لصفحة تسجيل الدخول
header("Location: login.php");
// اغلاق السيشن
exit();
}
//تخزين ايميل المستخدم في متغير من السيشن
$sess_email = $_SESSION["email"];
// استعلام خاص بجلب بيانات المستخدم المسجل لدخوله عن طريق الايميل الخاص به 
$sql = "SELECT user_id, firstname, lastname, email, profile_path FROM users WHERE email = '$sess_email'";
// استخدام اوامر اس كيو ال لجلب البيانات
$result = $con->query($sql);
// فحص اذا كان هناك صف في قاعدة البيانات يحتوي بيانات المستخدم أم لا
if ($result->num_rows > 0) {
  // اذا كان هناك بيانات قم بتخزينهم في السيشن لتسهيل استخدامهم في صفحات الموقع
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $userid=$row["user_id"];
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $username =$row["firstname"]." ".$row["lastname"];
    $useremail=$row["email"];
    $userprofile="uploads/".$row["profile_path"];
  }
} else {
  // اذا كان لا قم بتخزين بيانات افتراضية 
    $userid="GHX1Y2";
    $username ="Jhon Doe";
    $useremail="mailid@domain.com";
    $userprofile="Uploads/default_profile.png";
}
?>