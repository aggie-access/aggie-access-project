<?php
include 'assets/connect.php';

$banner_id=$_SESSION['username'];

$sql_personal="SELECT first_name, middle_initial, last_name, address, birth_date, phone_number, student_email, graduation_year FROM student WHERE banner_id='$banner_id'";
$result_personal = $conn->query($sql_personal);
$row_personal = $result_personal->fetch_assoc();

$first_name=$row_personal["first_name"];
$middle_initial=$row_personal["middle_initial"];
$last_name=$row_personal["last_name"];
$address=$row_personal["address"];
$birth_date=date('M j, Y', strtotime($row_personal["birth_date"]));
$phone_number=$row_personal["phone_number"];
$student_email=$row_personal["student_email"];
$graduation_year=$row_personal["graduation_year"];

$sql_student="SELECT level_name, classification_title, college_name, degree_title, major_title
FROM student, course_level, classification, college, degree, major
WHERE banner_id='$banner_id' AND student.level_id=course_level.level_id AND student.classification_id=classification.classification_id AND student.college_id=college.college_id AND student.degree_id=degree.degree_id AND student.major_id=major.major_id";
$result_student = $conn->query($sql_student);
$row_student = $result_student->fetch_assoc();
$level_name=$row_student["level_name"];
$classification_title=$row_student["classification_title"];
$college_name=$row_student["college_name"];
$degree_title=$row_student["degree_title"];
$major_title=$row_student["major_title"];
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
            <p style="margin-bottom:20px;">This is you personal profile information that is included in the university's directory.</p>

            <table class="table table-striped" style="margin-bottom:35px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Birth Date</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $first_name . " " . $middle_initial . ". " . $last_name; ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $birth_date; ?></td>
                        <td>
                            <?php
                            $phone_1 = substr($phone_number, 0, 3);
                            $phone_2 = substr($phone_number, 3, 3);
                            $phone_3 = substr($phone_number, 6, 4);
                            echo $phone_1 . "-" . $phone_2 . "-" . $phone_3;
                        ?>
                        </td>
                        <td><?php echo $student_email; ?></td>
                    </tr>
                </tbody>
            </table>

            <h3>Student Information</h3>
            <p style="margin-bottom:20px;">This is your student profile information that is included in the university's directory.</p>

            <table class="table table-striped" style="margin-bottom:35px;">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Classification</th>
                        <th>College Affiliation</th>
                        <th>Degree Type</th>
                        <th>Major</th>
                        <th>Graduation Year</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $level_name; ?></td>
                        <td><?php echo $classification_title; ?></td>
                        <td><?php echo $college_name; ?></td>
                        <td><?php echo $degree_title; ?></td>
                        <td><?php echo $major_title; ?></td>
                        <td><?php echo $graduation_year; ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </body>
</html>
