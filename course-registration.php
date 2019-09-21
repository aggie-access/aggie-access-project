<?php
include 'assets/connect.php';

$sql_semester = "SELECT semester_id, semester_title FROM semester WHERE start_date>=CURDATE() ORDER BY start_date DESC";
$result_semester = $conn->query($sql_semester);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Registration</title>
				<?php include 'assets/header.php'; ?>
				<script type="text/javascript">
				$(document).ready(function(){
					$("#course-registration").addClass("active");
				});
				</script>
    </head>

    <body>

        <?php include 'assets/navbar.php'; ?>

        <div class="container">

            <h1>Registration</h1>
            <p style="margin-bottom:35px;">Enter the course reference number (CRN) for each of your selections below. You must provide your registration PIN that was given to you by your advisor in order to register for the upcoming semester.</p>

            <form action="registration-confirmation.php" method="post">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control" name="semester" required>
                              <option disabled selected value>Select Semester</option>
                              <?php
                              while($row_semester = $result_semester->fetch_assoc()) {
                                  echo "<option value='" . $row_semester[semester_id] . "'>" . $row_semester[semester_title] . "</option>";
                              }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Registration PIN</label>
                            <input type="text" class="form-control" name="pin" minlength="6" maxlength="6" size="6" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Enter up to six distinct course reference numbers (CRNs) below for each of your course selections.</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-1" minlength="5" maxlength="5" size="5" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-2" minlength="5" maxlength="5" size="5">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-3" minlength="5" maxlength="5" size="5">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-4" minlength="5" maxlength="5" size="5">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-5" minlength="5" maxlength="5" size="5">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-6" minlength="5" maxlength="5" size="5">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>

            </form>

        </div>

    </body>

</html>
