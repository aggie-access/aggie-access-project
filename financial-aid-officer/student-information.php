<?php
include '../assets/financial-aid-officer/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Student Information</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#student-information").addClass("active");
  });
  </script>
</head>

<body>

  <?php include '../assets/financial-aid-officer/navbar.php'; ?>

  <div class="container">

    <h1>Student Information</h1>
    <p style='margin-bottom:35px;'>Enter a student's banner ID to view their personal information and eligibility status.</p>

    <form action='../financial-aid-officer/student-information.php' method='post' style='margin-bottom:30px;' id='form'>

      <div class='row'>
        <div class='col-sm-6'>
          <div class='form-group'>
            <label>Banner ID</label>
            <input type='text' class='form-control' name='bannerID' minlength='9' maxlength='9' size='9' required>
          </div>
        </div>
      </div>

      <button type='submit' class='btn btn-default'>Submit</button>

    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $banner_id=$_POST['bannerID'];

      $sql_user="SELECT user_type_title
      FROM users u JOIN user_type t ON (u.user_type_id=t.user_type_id)
      WHERE banner_id='$banner_id'";
      $result_user = $conn->query($sql_user);
      $row_user = $result_user->fetch_assoc();

      if ($result_user->num_rows > 0) {
        if ($row_user['user_type_title']==='Student') {
          $sql_student="SELECT banner_id, first_name, middle_initial, last_name, street, city, state, zip, birth_date, phone_number, student_email, level_name, classification_title, college_name, degree_title, major_title, graduation_year, holds
          FROM student s JOIN course_level l ON (s.level_id=l.level_id) JOIN classification f ON (s.classification_id=f.classification_id) JOIN college g ON (s.college_id=g.college_id) JOIN degree d ON (s.degree_id=d.degree_id) JOIN major m ON (s.major_id=m.major_id)
          WHERE banner_id='$banner_id'";
          $result_student = $conn->query($sql_student);
          $row_student = $result_student->fetch_assoc();

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

          $degree_rate=($earned_hours/$attempted_hours)*100;

          echo "<h3 style='margin-top:35px;'>Personal Information</h3>
          <p style='margin-bottom:30px;'>This is the student's personal profile information that is included in the university's directory.</p>

          <div class='row row-no-gutters profile-grid first-row'>
          <div class='col-sm-3'>
          <strong>Banner ID</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['banner_id'] . "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>Name</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['first_name'] . " " . $row_student['middle_initial'] . ". " . $row_student['last_name'] . "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>Address</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['street'] . "<br>" . $row_student['city'] . ", " . $row_student['state'] . " " . $row_student['zip'] . "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>Birth Date</strong>
          </div>
          <div class='col-sm-9'>" . date('F j, Y', strtotime($row_student['birth_date'])) . "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>Phone</strong>
          </div>
          <div class='col-sm-9'>" . substr($row_student['phone_number'], 0, 3) . "-" . substr($row_student['phone_number'], 3, 3) . "-" . substr($row_student['phone_number'], 6, 4) . "</div>
          </div>

          <div class='row row-no-gutters profile-grid last-row'>
          <div class='col-sm-3'>
          <strong>Email</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['student_email'] . "</div>
          </div>

          <h3>Student Information</h3>
          <p style='margin-bottom:30px;'>This is the student's profile information that is also included in the university's directory.</p>

          <div class='row row-no-gutters profile-grid first-row'>
          <div class='col-sm-3'>
          <strong>Level</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['level_name'] . "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>Classification</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['classification_title'] . "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>College Affiliation</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['college_name'] . "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>Degree Type</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['degree_title'] . "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>Major</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['major_title'] . "</div>
          </div>

          <div class='row row-no-gutters profile-grid last-row'>
          <div class='col-sm-3'>
          <strong>Graduation Year</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['graduation_year'] . "</div>
          </div>

          <h3>Eligibility Status Information</h3>
          <p style='margin-bottom:30px;'>This is the student's financial aid eligibility status information as determined by their academic progress.</p>

          <div class='row row-no-gutters profile-grid first-row'>
          <div class='col-sm-3'>
          <strong>Holds</strong>
          </div>
          <div class='col-sm-9'>";

          if ($row_student['holds']==='0') {
            echo "The student does not have any holds placed on their record that will affect their financial aid award.";
          } elseif ($row_student['holds']==='1') {
            echo "The student does have a hold placed on their record that will affect their financial aid award.";
          }

          echo "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>Cumulative GPA</strong>
          </div>
          <div class='col-sm-9'>" . number_format($gpa, 3) . "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>Degree Program Completion Rate</strong>
          </div>
          <div class='col-sm-9'>" . number_format($degree_rate, 2) . "%</div>
          </div>

          <div class='row row-no-gutters profile-grid last-row'>
          <div class='col-sm-3'>
          <strong>Total Attempted Credit Hours</strong>
          </div>
          <div class='col-sm-9'>The student has attempted <strong>" . $attempted_hours . "</strong> hours in their current degree program, and they have earned <strong>" . $earned_hours . "</strong>.</div>
          </div>";

        } else {
          echo "<div class='alert alert-danger'><strong>Error: </strong>The banner ID you have entered does not belong to a student. Please enter a valid student banner ID.</div>";
        }
      } else {
        echo "<div class='alert alert-danger'><strong>Error: </strong>The banner ID you have entered does not exist. Please enter a valid student banner ID.</div>";
      }
    }
    ?>

  </div>
</body>
</html>
