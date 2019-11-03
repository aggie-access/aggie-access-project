<?php
include '../assets/financial-aid-officer/connect.php';

$sql_year = "SELECT * FROM school_year ORDER BY school_year_name DESC";
$result_year = $conn->query($sql_year);

$year_id='';
$result_aid='';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $year_id=$_POST['award-year'];
  $sql_requirements = "SELECT fund_title, requirement_title, requirement_description, requirement_url, completion_status
  FROM award a JOIN fund f ON (a.fund_id=f.fund_id) JOIN fund_requirements r ON (f.fund_id=r.fund_id) JOIN award_requirement_status s ON (a.award_id=s.award_id AND r.requirement_id=s.requirement_id)
  WHERE banner_id='$banner_id' AND school_year_id='$year_id' AND (fall_amount_accepted!=0 OR fall_amount_accepted IS NULL) AND (spring_amount_accepted!=0 OR spring_amount_accepted IS NULL);";
  $result_requirements = $conn->query($sql_requirements);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Requirement Assignment Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#manage-requirements").addClass("active");
  });
  </script>

  <style>
  th, td {
    vertical-align:middle!important;
  }
  .btn {
    margin-bottom:5px;
  }
  </style>
</head>

<body>

  <?php include '../assets/financial-aid-officer/navbar.php'; ?>

  <div class="container">

    <button class='btn btn-success pull-right' type='button' style='position:relative; top:20px;' data-toggle='modal' data-target='#newAward'>Add <span class='mobile-hide'>New Award Requirement</span></button>

    <h1>Requirement Assignment Dashboard</h1>
    <p style='margin-bottom:35px;'>Assign award requirements for <strong>Aggie</strong> for the selected Award Year.</p>

    <form action='' method='post'>
      <div class='modal fade' id='newAward' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Assign New Financial Aid Award Requirement</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Fill in the form below to add a new financial aid award requirement to  <strong>Aggie</strong>:</p>
              <div class='form-group'>
                <label>Fund Title</label>
                <select class='form-control' name='fund title' required>
                  <option selected disabled>Select Fund</option>
                  <option value='1'>Federal Pell Grant</option>
                  <option value='2'>UNC Need Based Grant</option>
                  <option value='3'>Campus Based Tuition Fund</option>
                  <option value='4'>Direct Subsidized Loan</option>
                  <option value='5'>Direct Unsubsidized Loan</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Requirement Type</label>
                <select class='form-control' name='Requirement Type' required>
                  <option selected disabled>Select Requirement Type</option>
                  <option value='1'>Loan Entrance Counseling</option>
                  <option value='2'>Master Promissory Note</option>
                </select>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Assign Award Requirement</button>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>


    <table class='table table-striped'>
      <thead>
        <tr>
          <th>Fund Title</th>
          <th>Requirement Type</th>
          <th class='mobile-hide'>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Direct Subsidized Loan</td>
          <td>Loan Entrance Counseling</td>
          <td class='mobile-hide'>Complete</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editRequirement'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeRequirement'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editRequirement' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit Assigned Requirements</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Edit the Required Award Assignments for this student:</p>
                  <div class='modal-data'>
                    <div class='form-group row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='Fund Title' value='Direct Subsidized Loan' disabled>
                      </div>
                    </div>
                    <div class='form-group row'>
                      <div class='col-sm-4'><strong>Requirement Type</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='requirement type' value='Loan Entrance Counseling' minlength='1' maxlength='255' required>
                      </div>
                    </div>
                    <div class='form-group row'>
                      <div class='col-sm-4'><strong>Status</strong></div>
                      <div class='col-sm-8'>
                        <select class='form-control' name='status' required>
                          <option disabled>Select Requirement Status</option>
                          <option value='C' selected>Completed</option>
                          <option value='N'>Not Completed</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-primary'>Submit</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <form action='' method='post'>
          <div class='modal fade' id='removeRequirement' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Requirement</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following requirement from this student?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>Direct Subsidized Loan</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement Title</strong></div>
                      <div class='col-sm-8'>Loan Entrance Counseling</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Requirement</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td>Direct UnSubsidized Loan</td>
          <td>Master Promissory Note</td>
          <td class='mobile-hide'>Not Completed</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editRequirementUnsubsidized'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeRequirementUnsubsidized'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editRequirementUnsubsidized' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit Assigned Requirements</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Edit the Required Award Assignments for this student:</p>
                  <div class='modal-data'>
                    <div class='form-group row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='Fund Title' value='Direct UnSubsidized Loan' disabled>
                      </div>
                    </div>
                    <div class='form-group row'>
                      <div class='col-sm-4'><strong>Requirement Type</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='requirement type' value='Master Promissory Note' minlength='1' maxlength='255' required>
                      </div>
                    </div>
                    <div class='form-group row'>
                      <div class='col-sm-4'><strong>Status</strong></div>
                      <div class='col-sm-8'>
                        <select class='form-control' name='status' required>
                          <option disabled>Select Requirement Status</option>
                          <option value='C'>Completed</option>
                          <option value='N' selected>Not Completed</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-primary'>Submit</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <form action='' method='post'>
          <div class='modal fade' id='removeRequirementUnsubsidized' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Requirement</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following requirement from this student?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>Direct UnSubsidized Loan</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement Title</strong></div>
                      <div class='col-sm-8'>Master Promissory Note</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Requirement</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </tbody>
    </thead>
  </table>
</div>
</body>
</html>
