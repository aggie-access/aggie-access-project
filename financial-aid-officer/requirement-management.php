<?php
include '../assets/financial-aid-officer/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Requirement Management</title>
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

    <form action='' method='post'>
      <div class='modal fade' id='newAward' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Financial Aid Award Requirement</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Fill in the form below to add a new financial aid award requirements to the system:</p>
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
                <input type='text' class='form-control' name='requirement title' required>
              </div>
              <div class='form-group'>
                <label>Requirement Description</label>
                <textarea class='form-control' name='requirement description' required></textarea>
              </div>
              <div class='form-group'>
                <label>Requirement URL</label>
                <input type='url' class='form-control' name='requirement url' required>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Add New Requirement</button>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <h1>Requirement Management</h1>
    <p style='margin-bottom:35px;'>Add, Edit or Delete award requirements to the system by choosing the correct buttons.</p>

    <table class='table table-striped'>
      <thead>
        <tr>
          <th>Fund Title</th>
          <th>Requirement Title</th>
          <th class='mobile-hide'>Requirement Description</th>
          <th class='mobile-hide'>Requirement URL</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr style="font-size:70%">
          <td>Direct Subsidized Loan</td>
          <td>Loan Entrance Counseling</td>
          <td class='mobile-hide'>The federal government requires that all students who have accepted a Direct Subsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</td>
          <td class='mobile-hide'>https://studentloans.gov/myDirectLoan/counselingInstructions.action?counselingType=entrance</td>
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
                  <h4 class='modal-title'>Edit Award Requirement</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the following Award Requirement:</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='Fund Title' value='Direct Subsidized Loan' disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement Type</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='requirement type' value='Loan Entrance Counseling' minlength='1' maxlength='255' required>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Description</strong></div>
                      <div class='col-sm-8'>
                        <textarea class='form-control' name='Requirement Description' required>The federal government requires that all students who have accepted a Direct Subsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</textarea>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement URL</strong></div>
                      <div class='col-sm-8'>
                        <input type='url' class='form-control' name='Requirement URL' value='https://studentloans.gov/myDirectLoan/counselingInstructions.action?counselingType=entrance' >
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
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following requirement from the system</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>Direct Subsidized Loan</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement Title</strong></div>
                      <div class='col-sm-8'>Loan Entrance Counseling</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Description</strong></div>
                      <div class='col-sm-8'>The federal government requires that all students who have accepted a Direct Subsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</div>
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



        <tr style="font-size:70%">
          <td>Direct UnSubsidized Loan</td>
          <td>Loan Entrance Counseling</td>
          <td class='mobile-hide'>The federal government requires that all students who have accepted a Direct Subsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</td>
          <td class='mobile-hide'>https://studentloans.gov/myDirectLoan/counselingInstructions.action?counselingType=entrance</td>
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
                  <h4 class='modal-title'>Edit Award Requirement</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the following Award Requirement:</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='Fund Title' value='Direct UnSubsidized Loan' disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement Type</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='requirement type' value='Loan Entrance Counseling' minlength='1' maxlength='255' required>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Description</strong></div>
                      <div class='col-sm-8'>
                        <textarea class='form-control' name='Requirement Description' required>The federal government requires that all students who have accepted a Direct Subsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</textarea>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement URL</strong></div>
                      <div class='col-sm-8'>
                        <input type='url' class='form-control' name='Requirement URL' value='https://studentloans.gov/myDirectLoan/counselingInstructions.action?counselingType=entrance' >
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
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following requirement from the system</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>Direct UnSubsidized Loan</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement Title</strong></div>
                      <div class='col-sm-8'>Loan Entrance Counseling</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Description</strong></div>
                      <div class='col-sm-8'>The federal government requires that all students who have accepted a Direct Subsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</div>
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



        <tr style="font-size:70%">
          <td>Direct Subsidized Loan</td>
          <td>Master Promissory Note</td>
          <td class='mobile-hide'>The federal government requires that all students who have accepted a Direct Unsubsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</td>
          <td class='mobile-hide'>https://studentloans.gov/myDirectLoan/counselingInstructions.action?counselingType=entrance</td>
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
                  <h4 class='modal-title'>Edit Award Requirement</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the following Award Requirement:</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='Fund Title' value='Direct Subsidized Loan' disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement Type</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='requirement type' value='Master Promissory Note' minlength='1' maxlength='255' required>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Description</strong></div>
                      <div class='col-sm-8'>
                        <textarea class='form-control' name='Requirement Description' required>The federal government requires that all students who have accepted a Direct Unsubsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</textarea>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement URL</strong></div>
                      <div class='col-sm-8'>
                        <input type='url' class='form-control' name='Requirement URL' value='https://studentloans.gov/myDirectLoan/counselingInstructions.action?counselingType=entrance' >
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
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following requirement from the system</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>Direct Subsidized Loan</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement Title</strong></div>
                      <div class='col-sm-8'>Master Promissory Note</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Description</strong></div>
                      <div class='col-sm-8'>The federal government requires that all students who have accepted a Direct Unsubsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</div>
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



        <tr style="font-size:70%">
          <td>Direct UnSubsidized Loan</td>
          <td>Loan Entrance Counseling</td>
          <td class='mobile-hide'>The federal government requires that all students who have accepted a Direct Subsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</td>
          <td class='mobile-hide'>https://studentloans.gov/myDirectLoan/counselingInstructions.action?counselingType=entrance</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editRequirementUnSubsidized'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeRequirementUnSubsidized'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editRequirementUnSubsidized' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit Award Requirement</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the following Award Requirement:</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='Fund Title' value='Direct UnSubsidized Loan' disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement Type</strong></div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control' name='requirement type' value='Loan Entrance Counseling' minlength='1' maxlength='255' required>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Description</strong></div>
                      <div class='col-sm-8'>
                        <textarea class='form-control' name='Requirement Description' required>The federal government requires that all students who have accepted a Direct Subsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</textarea>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement URL</strong></div>
                      <div class='col-sm-8'>
                        <input type='url' class='form-control' name='Requirement URL' value='https://studentloans.gov/myDirectLoan/counselingInstructions.action?counselingType=entrance' >
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
          <div class='modal fade' id='removeRequirementUnSubsidized' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Requirement</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following requirement from the system</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Fund Title</strong></div>
                      <div class='col-sm-8'>Direct UnSubsidized Loan</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Requirement Title</strong></div>
                      <div class='col-sm-8'>Loan Entrance Counseling</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Description</strong></div>
                      <div class='col-sm-8'>The federal government requires that all students who have accepted a Direct Subsidized Loan must complete loan entrance counseling to ensure that you understand the responsibilities and obligations of the loan.</div>
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
