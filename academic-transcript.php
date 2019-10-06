<?php
include 'assets/connect.php';

$banner_id=$_SESSION['username'];

$sql_transcript = "SELECT subject_abbreviation, course_number, course_title, credit_hours, level_name, grades.letter_grade, quality_points*credit_hours AS quality_points
FROM grades, registration, section, course, course_level, subject, grading_scale
WHERE banner_id='$banner_id' AND registration.registration_id=grades.registration_id AND section.course_id=course.course_id AND registration.crn=section.crn AND course.level_id=course_level.level_id AND course.subject_id=subject.subject_id AND grades.letter_grade=grading_scale.letter_grade
ORDER BY subject_abbreviation ASC, course_number ASC";
$result_transcript = $conn->query($sql_transcript);

$sql_attempted="SELECT SUM(credit_hours) AS attempted_hours
FROM grades, registration, section, course, grading_scale
WHERE banner_id='$banner_id' AND registration.registration_id=grades.registration_id AND section.course_id=course.course_id AND registration.crn=section.crn AND grades.letter_grade=grading_scale.letter_grade AND grades.letter_grade IS NOT NULL";
$result_attempted = $conn->query($sql_attempted);
$row_attempted = $result_attempted->fetch_assoc();

$attempted_hours=$row_attempted['attempted_hours'];

$sql_earned="SELECT SUM(credit_hours) AS earned_hours
FROM grades, registration, section, course, grading_scale
WHERE banner_id='$banner_id' AND registration.registration_id=grades.registration_id AND section.course_id=course.course_id AND registration.crn=section.crn AND grades.letter_grade=grading_scale.letter_grade AND grades.letter_grade IS NOT NULL AND grading_scale.quality_points IS NOT NULL";
$result_earned = $conn->query($sql_earned);
$row_earned = $result_earned->fetch_assoc();

$earned_hours=$row_earned['earned_hours'];

$sql_points="SELECT SUM(quality_points*credit_hours) AS quality_points
FROM grades, registration, section, course, grading_scale
WHERE banner_id='$banner_id' AND registration.registration_id=grades.registration_id AND section.course_id=course.course_id AND registration.crn=section.crn AND grades.letter_grade=grading_scale.letter_grade AND grades.letter_grade IS NOT NULL";
$result_points = $conn->query($sql_points);
$row_points = $result_points->fetch_assoc();

$quality_points=$row_points['quality_points'];

$gpa=$quality_points/$earned_hours;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Academic Transcript</title>
  <?php include 'assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#academic-transcript").addClass("active");
  });
  </script>
</head>

<body>

  <?php include 'assets/navbar.php'; ?>

  <div class="container">

    <h1>Academic Transcript</h1>
    <p style="margin-bottom:35px;">Below is an unofficial copy of your current academic transcript.</p>

    <div class="row row-no-gutters transcript-grid first-row">
      <div class="col-xs-3">
        <strong>Course</strong>
      </div>
      <div class="col-xs-4">
        <strong>Title</strong>
      </div>
      <div class="col-xs-2">
        <strong>Credits</strong>
      </div>
      <div class="col-xs-2 mobile-hide">
        <strong>Level</strong>
      </div>
      <div class="col-xs-1">
        <strong>Grade</strong>
      </div>
    </div>

    <?php
    while($row_transcript = $result_transcript->fetch_assoc()) {
      echo "<div class='row row-no-gutters transcript-grid'>
        <div class='col-xs-3'>" . $row_transcript['subject_abbreviation'] . " " . $row_transcript['course_number'] . "</div>
        <div class='col-xs-4'>" . $row_transcript['course_title'] . "</div>
        <div class='col-xs-2'>" . $row_transcript['credit_hours'] . "</div>
        <div class='col-xs-2 mobile-hide'>" . $row_transcript['level_name'] . "</div>
        <div class='col-xs-1'>" . $row_transcript['letter_grade'] . "</div>
      </div>";
    }
    ?>

    <h3 style="margin-bottom:30px; margin-top:50px;">Transcript Summary</h3>

    <div class="row row-no-gutters transcript-totals-grid first-row">
      <div class="col-sm-4">
        <strong>Attempted Credit Hours</strong>
      </div>
      <div class="col-sm-8">
        <?php echo $attempted_hours; ?>
      </div>
    </div>

    <div class="row row-no-gutters transcript-totals-grid">
      <div class="col-sm-4">
        <strong>Earned Credit Hours</strong>
      </div>
      <div class="col-sm-8">
        <?php echo $earned_hours; ?>
      </div>
    </div>

    <div class="row row-no-gutters transcript-totals-grid">
      <div class="col-sm-4">
        <strong>Quality Points</strong>
      </div>
      <div class="col-sm-8">
        <?php echo $quality_points; ?>
      </div>
    </div>

    <div class="row row-no-gutters transcript-totals-grid last-row">
      <div class="col-sm-4">
        <strong>Overall Grade Point Average</strong>
      </div>
      <div class="col-sm-8">
        <?php echo $gpa; ?>
      </div>
    </div>

  </div>
</body>
</html>
