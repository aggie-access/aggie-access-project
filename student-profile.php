<?php
include 'assets/connect.php';

$banner_id=$_SESSION['username'];

$sql_personal="SELECT first_name, middle_initial, last_name, street, city, state, zip, birth_date, phone_number, student_email, graduation_year FROM student WHERE banner_id='$banner_id'";
$result_personal = $conn->query($sql_personal);
$row_personal = $result_personal->fetch_assoc();

$first_name=$row_personal['first_name'];
$middle_initial=$row_personal['middle_initial'];
$last_name=$row_personal['last_name'];
$street=$row_personal['street'];
$city=$row_personal['city'];
$state=$row_personal['state'];
$zip=$row_personal['zip'];
$birth_date=date('F j, Y', strtotime($row_personal['birth_date']));
$phone_number=$row_personal['phone_number'];
$student_email=$row_personal['student_email'];
$graduation_year=$row_personal['graduation_year'];

$sql_student="SELECT level_name, classification_title, college_name, degree_title, major_title
FROM student s JOIN course_level l ON (s.level_id=l.level_id) JOIN classification f ON (s.classification_id=f.classification_id) JOIN college g ON (s.college_id=g.college_id) JOIN degree d ON (s.degree_id=d.degree_id) JOIN major m ON (s.major_id=m.major_id)
WHERE banner_id='$banner_id'";
$result_student = $conn->query($sql_student);
$row_student = $result_student->fetch_assoc();
$level_name=$row_student['level_name'];
$classification_title=$row_student['classification_title'];
$college_name=$row_student['college_name'];
$degree_title=$row_student['degree_title'];
$major_title=$row_student['major_title'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Student Profile</title>
  <?php include 'assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#student-profile").addClass("active");
  });
  </script>
</head>

<body>

  <?php include 'assets/navbar.php'; ?>

  <div class="container">

    <h1>Student Profile</h1>
    <p style="margin-bottom:35px;">Your student profile is where you can view all of your personal records, including your current academic status, your class schedule, and your academic transcript.</p>

    <h3>Personal Information</h3>
    <p style="margin-bottom:30px;">This is your personal profile information that is included in the university's directory.</p>

    <div class="row row-no-gutters profile-grid first-row">
      <div class="col-sm-3">
        <strong>Name</strong>
      </div>
      <div class="col-sm-9">
        <?php echo $first_name . " " . $middle_initial . ". " . $last_name; ?>
      </div>
    </div>

    <div class="row row-no-gutters profile-grid">
      <div class="col-sm-3">
        <strong>Address</strong>
      </div>
      <div class="col-sm-9">
        <?php
        echo $street . "<br>";
        echo $city . ", " . $state . " " . $zip;
        ?>
      </div>
    </div>

    <div class="row row-no-gutters profile-grid">
      <div class="col-sm-3">
        <strong>Birth Date</strong>
      </div>
      <div class="col-sm-9">
        <?php echo $birth_date; ?>
      </div>
    </div>

    <div class="row row-no-gutters profile-grid">
      <div class="col-sm-3">
        <strong>Phone</strong>
      </div>
      <div class="col-sm-9">
        <?php
        $phone_1 = substr($phone_number, 0, 3);
        $phone_2 = substr($phone_number, 3, 3);
        $phone_3 = substr($phone_number, 6, 4);
        echo $phone_1 . "-" . $phone_2 . "-" . $phone_3;
        ?>
      </div>
    </div>

    <div class="row row-no-gutters profile-grid last-row">
      <div class="col-sm-3">
        <strong>Email</strong>
      </div>
      <div class="col-sm-9">
        <?php echo $student_email; ?>
      </div>
    </div>

    <h3>Student Information</h3>
    <p style="margin-bottom:30px;">This is your student profile information that is included in the university's directory.</p>

    <div class="row row-no-gutters profile-grid first-row">
      <div class="col-sm-3">
        <strong>Level</strong>
      </div>
      <div class="col-sm-9">
        <?php echo $level_name; ?>
      </div>
    </div>

    <div class="row row-no-gutters profile-grid">
      <div class="col-sm-3">
        <strong>Classification</strong>
      </div>
      <div class="col-sm-9">
        <?php echo $classification_title; ?>
      </div>
    </div>

    <div class="row row-no-gutters profile-grid">
      <div class="col-sm-3">
        <strong>College Affiliation</strong>
      </div>
      <div class="col-sm-9">
        <?php echo $college_name; ?>
      </div>
    </div>

    <div class="row row-no-gutters profile-grid">
      <div class="col-sm-3">
        <strong>Degree Type</strong>
      </div>
      <div class="col-sm-9">
        <?php echo $degree_title; ?>
      </div>
    </div>

    <div class="row row-no-gutters profile-grid">
      <div class="col-sm-3">
        <strong>Major</strong>
      </div>
      <div class="col-sm-9">
        <?php echo $major_title; ?>
      </div>
    </div>

    <div class="row row-no-gutters profile-grid last-row">
      <div class="col-sm-3">
        <strong>Graduation Year</strong>
      </div>
      <div class="col-sm-9">
        <?php echo $graduation_year; ?>
      </div>
    </div>

  </div>
</body>
</html>
