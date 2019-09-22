<?php
include 'assets/connect.php';

$banner_id=$_SESSION['username'];

$sql_year = "SELECT * FROM school_year ORDER BY school_year_name DESC";
$result_year = $conn->query($sql_year);

$year_id='';
$result_aid='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $year_id=$_POST['award-year'];
  $sql_aid = "SELECT fund_title, fall_amount, spring_amount, (fall_amount+spring_amount) AS total_amount
  FROM award JOIN fund ON (award.fund_id=fund.fund_id)
  WHERE banner_id='$banner_id' AND school_year_id='$year_id'";
  $result_aid = $conn->query($sql_aid);

  $sql_holds = "SELECT holds FROM student WHERE banner_id='$banner_id';";
  $result_holds = $conn->query($sql_holds);
  $row_holds = $result_holds->fetch_assoc();

  $sql_level = "SELECT student.level_id
  FROM student JOIN course_level ON (student.level_id=course_level.level_id)
  WHERE banner_id='$banner_id';";
  $result_level = $conn->query($sql_level);
  $row_level = $result_level->fetch_assoc();

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

  $degree_rate=($earned_hours/$attempted_hours)*100;

  $sql_points="SELECT SUM(quality_points*credit_hours) AS quality_points
  FROM grades, registration, section, course, grading_scale
  WHERE banner_id='$banner_id' AND registration.registration_id=grades.registration_id AND section.course_id=course.course_id AND registration.crn=section.crn AND grades.letter_grade=grading_scale.letter_grade AND grades.letter_grade IS NOT NULL";
  $result_points = $conn->query($sql_points);
  $row_points = $result_points->fetch_assoc();

  $quality_points=$row_points['quality_points'];

  $gpa=$quality_points/$earned_hours;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Financial Aid</title>
  <?php include 'assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#financial-aid").addClass("active");
  });
  </script>

</head>

<body>

  <?php include 'assets/navbar.php'; ?>

  <div class="container">

    <h1>Financial Aid</h1>
    <p style="margin-bottom:35px;">Select an award year below to view your financial aid information. This will include any grants, loans, and scholarships that you may have received. Additionally, you can also view your eligibility status for financial aid, which is based on your academic progress.</p>

    <form method="post">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Award Year</label>
            <select id='award-year' class='form-control' name='award-year' onchange='this.form.submit();'>
              <option disabled selected value>Select Award Year</option>
              <?php
              while($row_year = $result_year->fetch_assoc()) {
                echo "<option ";
                if ($year_id == $row_year['school_year_id'] ) {
                  echo 'selected ';
                }
                echo "value='" . $row_year['school_year_id'] . "'>" . $row_year['school_year_name'] . " Award Year</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    </form>

    <?php
    if ($result_aid->num_rows > 0) {
      echo "<h2>Award</h2>";
      echo "<p style='margin-bottom:35px;'>Your financial aid award for the selected school year is displayed below. This information includes the types of awards you received, the status of those awards, the amount each award will apply towards the fall semester, the amount each award will apply towards the spring semester, and the total award package you received for the school year from each fund.</p>";
      echo "<table class='table table-striped' style='margin-bottom:35px;'>";
      echo "<thead>";
      echo "<tr>";
      echo "</tr>";
      echo "<th>Fund</th>";
      echo "<th>Status</th>";
      echo "<th>Fall Award Package</th>";
      echo "<th>Spring Award Package</th>";
      echo "<th>Total Award Package</th>";
      echo "</thead>";
      echo "<tbody>";

      while($row_aid = $result_aid->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_aid['fund_title'] . "</td>";
        echo "<td>Accepted</td>";
        echo "<td>$" . number_format($row_aid['fall_amount'], 2) . "</td>";
        echo "<td>$" . number_format($row_aid['spring_amount'], 2) . "</td>";
        echo "<td>$" . number_format($row_aid['total_amount'], 2) . "</td>";
        echo "</tr>";
      }

      echo "</tbody>";
      echo "</table>";
      echo "<h2>Eligibility Status</h2>";
      echo "<p style='margin-bottom:35px;'>Below are the details of your financial aid eligibility status. In order to be eligible for financial aid, you must have no financial aid holds on your record and you must be meeting satisifactory academic progress standards.</p>";
      echo "<h3>Holds</h3>";

      if ($row_holds['holds']==='0') {
        echo "<p style='margin-bottom:35px;'>You do not have any holds placed on your record that will affect your financial aid award.</p>";
      } elseif ($row_holds['holds']==='1') {
        echo "<p style='margin-bottom:35px;'>You have a hold placed on your record that may affect your financial aid award.</p>";
      }

      echo "<h3>Satisfactory Academic Progess Standards</h3>";

      if ($row_level['level_id']==='1') {
        if ($gpa>=2.0) {
          echo "<p style='margin-bottom:35px;'>Based on your academic transcript, you are <strong>meeting satisifactory academic progress standards</strong>. Your eligibility will be assessed at the end of each semester based on your academic performance, so check back after each semester to determine your current standing.</p>";
        } else {
          echo "<p style='margin-bottom:35px;'>Based on your academic transcript, you are <strong>not meeting satisifactory academic progress standards</strong>. Your eligibility will be assessed at the end of each semester based on your academic performance, so check back after each semester to determine your current standing.</p>";
        }
      } elseif ($row_level['level_id']==='2') {
        if ($gpa>=3.0) {
          echo "<p style='margin-bottom:35px;'>Based on your academic transcript, you are <strong>meeting satisifactory academic progress standards</strong>. Your eligibility will be assessed at the end of each semester based on your academic performance, so check back after each semester to determine your current standing.</p>";
        } else {
          echo "<p style='margin-bottom:35px;'>Based on your academic transcript, you are <strong>not meeting satisifactory academic progress standards</strong>. Your eligibility will be assessed at the end of each semester based on your academic performance, so check back after each semester to determine your current standing.</p>";
        }
      }

      echo "<h3>Student Eligibility Progress</h3>";
      echo "<p style='margin-bottom:35px;'>There are several factors that are involved in calculating your federally required Satisfactory Academic Progress Standards, including your cumulative GPA, degree program completion rate, and the total amount of credit hours you have attempted.</p>";

      echo "<h4>Cumulative GPA</h4>";
      echo "<p>To remain eligible for financial aid, your cumulative GPA must remain at least a 2.0 if you are an undergraduate and a 3.0 if you are a graduate.</p>";

      if ($row_level['level_id']==='1') {
        if ($gpa>=2.0 AND $degree_rate>=67 AND $attempted_hours<=186) {
          echo "<p style='margin-bottom:35px;'>Congratulations, your current cumulative GPA is <strong>" . $gpa . "</strong>. Keep up the good work!</p>";
        } else {
          echo "<p style='margin-bottom:35px;'>Your current cumulative GPA is <strong>" . $gpa . "</strong>.</p>";
        }
      } elseif ($row_level['level_id']==='2') {
        if ($gpa>=3.0 AND $degree_rate>=67 AND $attempted_hours<=54) {
          echo "<p style='margin-bottom:35px;'>Congratulations, your current cumulative GPA is <strong>" . $gpa . "</strong>. Keep up the good work!</p>";
        } else {
          echo "<p style='margin-bottom:35px;'>Your current cumulative GPA is <strong>" . $gpa . "</strong>.</p>";
        }
      }

      echo "<h4>Degree Program Completion Rate</h4>";
      echo "<p>You must be progressing toward completion of your degree program at a satisfactory rate as demonstrated by passing at least 67% of all attempted hours.</p>";

      if ($degree_rate>=67) {
        echo "<p style='margin-bottom:35px;'>Congratulations, your percentage completion rate is <strong>" . number_format($degree_rate, 2) . "%</strong>. Keep up the good work!</p>";
      } else {
        echo "<p style='margin-bottom:35px;'>Your percentage completion rate is <strong>" . number_format($degree_rate, 2) . "%</strong>.</p>";
      }

      echo "<h4>Total Attempted Credit Hours</h4>";
      echo "<p>Your total attempted hours must not exceed 150% of your degree program's length. Undergraduates must complete their programs within 186 hours attempted and graduate students must complete their program within 54 attempted hours.</p>";
      echo "<p style='margin-bottom:35px;'>You have attempted <strong>" . $attempted_hours . "</strong> hours in your current degree program, and you have earned <strong>" . $earned_hours . "</strong>.</p>";
    }
    ?>

  </div>

</body>

</html>
