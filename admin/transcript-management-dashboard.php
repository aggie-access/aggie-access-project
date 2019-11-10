<?php
include '../assets/admin/connect.php';
$banner_id=$_GET['banner_id'];

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

$sql_transcript = "SELECT subject_abbreviation, course_number, course_title, credit_hours, level_name, g.letter_grade, quality_points*credit_hours AS quality_points
FROM grades g JOIN registration r ON (r.registration_id=g.registration_id) JOIN section s ON (r.crn=s.crn) JOIN course c ON (s.course_id=c.course_id) JOIN course_level l ON (c.level_id=l.level_id) JOIN subject u ON (c.subject_id=u.subject_id) JOIN grading_scale gs ON (g.letter_grade=gs.letter_grade)
WHERE banner_id='$banner_id'
ORDER BY subject_abbreviation ASC, course_number ASC";
$result_transcript = $conn->query($sql_transcript);

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

$sql_points="SELECT SUM(quality_points*credit_hours) AS quality_points
FROM grades g JOIN registration r ON (r.registration_id=g.registration_id) JOIN section s ON (r.crn=s.crn) JOIN course c ON (s.course_id=c.course_id) JOIN grading_scale gs ON (g.letter_grade=gs.letter_grade)
WHERE banner_id='$banner_id' AND g.letter_grade IS NOT NULL";
$result_points = $conn->query($sql_points);
$row_points = $result_points->fetch_assoc();

$quality_points=$row_points['quality_points'];

$gpa=$quality_points/$earned_hours;

?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Transcript Management Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#transcript-management').addClass('active');
  });
  </script>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class='container'>

    <h1>Transcript Management Dashboard</h1>
    <p>Below is a copy of the student's current academic transcript.</p>

    <h3>Student Information</h3>
    <p style="margin-bottom:30px;">This is the student profile information that is included in the university's directory.</p>

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

    <h3>Transcript</h3>

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
    <?php echo number_format($gpa, 3); ?>
  </div>
</div>

</div>
</body>
</html>
