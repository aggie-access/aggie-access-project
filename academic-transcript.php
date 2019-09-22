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
WHERE banner_id='$banner_id' AND registration.registration_id=grades.registration_id AND section.course_id=course.course_id AND registration.crn=section.crn AND grades.letter_grade=grading_scale.letter_grade AND grades.letter_grade IS NOT NULL";
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

    <table class="table table-striped" style="margin-bottom:35px;">
      <thead>
        <tr>
          <th>Course</th>
          <th>Title</th>
          <th>Credits</th>
          <th>Level</th>
          <th>Grade</th>
          <th>Quality Points</th>
        </tr>
      </thead>
      <tbody>

        <?php
        while($row_transcript = $result_transcript->fetch_assoc()) {
          echo "<tr>" .
          "<td>" . $row_transcript['subject_abbreviation'] . " " . $row_transcript['course_number'] . "</td>" .
          "<td>" . $row_transcript['course_title'] . "</td>" .
          "<td>" . $row_transcript['credit_hours'] . "</td>" .
          "<td>" . $row_transcript['level_name']. "</td>" .
          "<td>" . $row_transcript['letter_grade']. "</td>" .
          "<td>" . $row_transcript['quality_points']. "</td>" .
          "</tr>";
        }
        ?>

      </tbody>
    </table>

    <h4 style="margin-bottom:15px;">Transcript Summary</h4>
    <table class="table table-striped" style="margin-bottom:35px;">
      <thead>
        <tr>
          <th>Attempted Credit Hours</th>
          <th>Earned Credit Hours</th>
          <th>Quality Points</th>
          <th>Overall Grade Point Average</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $attempted_hours; ?></td>
          <td><?php echo $earned_hours; ?></td>
          <td><?php echo $quality_points; ?></td>
          <td><?php echo $gpa; ?></td>
        </tr>
      </tbody>
    </table>

  </div>
</body>
</html>
