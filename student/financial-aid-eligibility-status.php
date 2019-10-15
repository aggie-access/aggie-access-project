<?php
include '../assets/student/connect.php';

$banner_id=$_SESSION['username'];

$sql_holds = "SELECT holds FROM student WHERE banner_id='$banner_id';";
$result_holds = $conn->query($sql_holds);
$row_holds = $result_holds->fetch_assoc();

$sql_level = "SELECT s.level_id
FROM student s JOIN course_level l ON (s.level_id=l.level_id)
WHERE banner_id='$banner_id';";
$result_level = $conn->query($sql_level);
$row_level = $result_level->fetch_assoc();

$sql_attempted="SELECT SUM(credit_hours) AS attempted_hours
FROM grades g JOIN registration r ON (r.registration_id=g.registration_id) JOIN section s ON (r.crn=s.crn) JOIN course c ON (s.course_id=c.course_id) JOIN grading_scale gs ON (g.letter_grade=gs.letter_grade)
WHERE banner_id='$banner_id' AND g.letter_grade IS NOT NULL";
$result_attempted = $conn->query($sql_attempted);
$row_attempted = $result_attempted->fetch_assoc();

$attempted_hours=$row_attempted['attempted_hours'];

$sql_earned="SELECT SUM(credit_hours) AS earned_hours
FROM grades g JOIN registration r ON (r.registration_id=g.registration_id) JOIN section s ON (r.crn=s.crn) JOIN course c ON (s.course_id=c.course_id) JOIN grading_scale gs ON (g.letter_grade=gs.letter_grade)
WHERE banner_id='$banner_id' AND g.letter_grade IS NOT NULL AND gs.quality_points IS NOT NULL";
$result_earned = $conn->query($sql_earned);
$row_earned = $result_earned->fetch_assoc();

$earned_hours=$row_earned['earned_hours'];

$degree_rate=($earned_hours/$attempted_hours)*100;

$sql_points="SELECT SUM(quality_points*credit_hours) AS quality_points
FROM grades g JOIN registration r ON (r.registration_id=g.registration_id) JOIN section s ON (r.crn=s.crn) JOIN course c ON (s.course_id=c.course_id) JOIN grading_scale gs ON (g.letter_grade=gs.letter_grade)
WHERE banner_id='$banner_id' AND g.letter_grade IS NOT NULL";
$result_points = $conn->query($sql_points);
$row_points = $result_points->fetch_assoc();

$quality_points=$row_points['quality_points'];

$gpa=$quality_points/$earned_hours;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Financial Aid Eligibility Status</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#financial-aid").addClass("active");
  });
  </script>

</head>

<body>

  <?php include '../assets/student/navbar.php'; ?>

  <div class="container">

    <h1>Financial Aid Eligibility Status</h1>
    <p style="margin-bottom:35px;">You can view your eligibility status for financial aid below, which is based on your academic progress. In order to be eligible for financial aid, you must have no financial aid holds on your record and you must be meeting satisifactory academic progress standards.</p>

    <h3>Holds</h3>

    <?php
    if ($row_holds['holds']==='0') {
      echo "<p style='margin-bottom:35px;'>You do not have any holds placed on your record that will affect your financial aid award.</p>";
    } elseif ($row_holds['holds']==='1') {
      echo "<p style='margin-bottom:35px;'>You have a hold placed on your record that may affect your financial aid award.</p>";
    }
    ?>

    <h3>Satisfactory Academic Progess Standards</h3>

    <?php
    if ($row_level['level_id']==='1') {
      if ($gpa>=2.0) {
        echo "<p style='margin-bottom:35px;'>There are several factors that are involved in calculating your federally required Satisfactory Academic Progress Standards, including your cumulative GPA, degree program completion rate, and the total amount of credit hours you have attempted. Based on your academic transcript, you are <strong>meeting satisifactory academic progress standards</strong>. Your eligibility will be assessed at the end of each semester based on your academic performance, so check back after each semester to determine your current standing.</p>";
      } else {
        echo "<p style='margin-bottom:35px;'>There are several factors that are involved in calculating your federally required Satisfactory Academic Progress Standards, including your cumulative GPA, degree program completion rate, and the total amount of credit hours you have attempted. Based on your academic transcript, you are <strong>not meeting satisifactory academic progress standards</strong>. Your eligibility will be assessed at the end of each semester based on your academic performance, so check back after each semester to determine your current standing.</p>";
      }
    } elseif ($row_level['level_id']==='2') {
      if ($gpa>=3.0) {
        echo "<p style='margin-bottom:35px;'>There are several factors that are involved in calculating your federally required Satisfactory Academic Progress Standards, including your cumulative GPA, degree program completion rate, and the total amount of credit hours you have attempted. Based on your academic transcript, you are <strong>meeting satisifactory academic progress standards</strong>. Your eligibility will be assessed at the end of each semester based on your academic performance, so check back after each semester to determine your current standing.</p>";
      } else {
        echo "<p style='margin-bottom:35px;'>There are several factors that are involved in calculating your federally required Satisfactory Academic Progress Standards, including your cumulative GPA, degree program completion rate, and the total amount of credit hours you have attempted. Based on your academic transcript, you are <strong>not meeting satisifactory academic progress standards</strong>. Your eligibility will be assessed at the end of each semester based on your academic performance, so check back after each semester to determine your current standing.</p>";
      }
    }
    ?>

    <h4>Cumulative GPA</h4>
    <p>To remain eligible for financial aid, your cumulative GPA must remain at least a 2.0 if you are an undergraduate and a 3.0 if you are a graduate.</p>

    <?php
    if ($row_level['level_id']==='1') {
      if ($gpa>=2.0 AND $degree_rate>=67 AND $attempted_hours<=186) {
        echo "<p style='margin-bottom:35px;'>Congratulations, your current cumulative GPA is <strong>" . number_format($gpa, 3) . "</strong>. Keep up the good work!</p>";
      } else {
        echo "<p style='margin-bottom:35px;'>Your current cumulative GPA is <strong>" . number_format($gpa, 3) . "</strong>.</p>";
      }
    } elseif ($row_level['level_id']==='2') {
      if ($gpa>=3.0 AND $degree_rate>=67 AND $attempted_hours<=54) {
        echo "<p style='margin-bottom:35px;'>Congratulations, your current cumulative GPA is <strong>" . number_format($gpa, 3) . "</strong>. Keep up the good work!</p>";
      } else {
        echo "<p style='margin-bottom:35px;'>Your current cumulative GPA is <strong>" . number_format($gpa, 3) . "</strong>.</p>";
      }
    }
    ?>

    <h4>Degree Program Completion Rate</h4>
    <p>You must be progressing toward completion of your degree program at a satisfactory rate as demonstrated by passing at least 67% of all attempted hours.</p>

    <?php
    if ($degree_rate>=67) {
      echo "<p style='margin-bottom:35px;'>Congratulations, your percentage completion rate is <strong>" . number_format($degree_rate, 2) . "%</strong>. Keep up the good work!</p>";
    } else {
      echo "<p style='margin-bottom:35px;'>Your percentage completion rate is <strong>" . number_format($degree_rate, 2) . "%</strong>.</p>";
    }
    ?>

    <h4>Total Attempted Credit Hours</h4>
    <p>Your total attempted hours must not exceed 150% of your degree program's length. Undergraduates must complete their programs within 186 hours attempted and graduate students must complete their program within 54 attempted hours.</p>

    <?php
    echo "<p style='margin-bottom:35px;'>You have attempted <strong>" . $attempted_hours . "</strong> hours in your current degree program, and you have earned <strong>" . $earned_hours . "</strong>.</p>";
    ?>

  </div>

</body>

</html>
