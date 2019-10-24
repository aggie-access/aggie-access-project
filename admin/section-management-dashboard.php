<?php
include '../assets/admin/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Section Management Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#section-management").addClass("active");
  });
  </script>

  <style>
  th, td {
    vertical-align:middle!important;
  }
  .form-control {
    margin-bottom:10px;
  }
  </style>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class="container">

    <h1>Section Management Dashboard</h1>
    <p style='margin-bottom:35px;'>You may add, edit, or remove course sections by clicking the appropriate buttons.</p>

    <h2 style='margin-bottom:0; margin-top:35px;'>Computer Systems Technology</h2>

    <button type='button' class='btn btn-success pull-right' data-toggle='modal' data-target='#addNewSection' style='position:relative; bottom:5px;'>Add <span class='mobile-hide'>New Section</span></button>

    <form action='' method='post'>
      <div class='modal fade' id='addNewSection' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Section</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Enter the CRN of the course you are adding a section for <strong>Spring 2020</strong> in the text box below.</p>
              <div class='form-group'>
                <label>CRN</label>
                <input type='text' class='form-control' minlength='5' maxlength='5' size='5' required>
                <label>Course No.</label>
                <input type='text' class='form-control' minlength='3' maxlength='3' size='3' required>
                <label>Course Title</label>
                <input type='text' class='form-control' minlength='5' maxlength='150' size='150' required>
                <label>Course Section</label>
                <input type='text' class='form-control' minlength='3' maxlength='3' size='3' required>
                <label>Meeting Days</label>
                <input type='text' class='form-control' minlength='' maxlength='5' size='5' required>
                <label>Start Times</label>
                <input type='text' class='form-control' minlength='' maxlength='6' size='6' required>
                <label>End Times</label>
                <input type='text' class='form-control' minlength='' maxlength='6' size='6' required>
                <label>Location</label>
                <input type='text' class='form-control' minlength='2' maxlength='20' size='20' required>
                <label>Seats</label>
                <input type='text' class='form-control' minlength='1' maxlength='5' size='5' required>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Add Section</button>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <h3 style='margin-top:5px; margin-bottom:25px; border-bottom:1px solid #aaa; padding-bottom:10px;'>Spring 2020</h3>

    <table class='table table-striped'>
      <thead>
        <tr>
          <th>CRN</th>
          <th>Course</th>
          <th class='mobile-hide'>Section</th>
          <th class='mobile-hide' style='width:200px;'>Title</th>
          <th class='mobile-hide'>Instructor</th>
          <th class='mobile-hide'>Days</th>
          <th class='mobile-hide'>Times</th>
          <th class='mobile-hide'>Location</th>
          <th class='mobile-hide'>Seats</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>20928</td>
          <td>CST 101</td>
          <td class='mobile-hide'>001</td>
          <td class='mobile-hide'>Microcomputer Applications</td>
          <td class='mobile-hide'>Mariama Sidibe</td>
          <td class='mobile-hide'>MWF</td>
          <td class='mobile-hide'>10:00 AM - 10:50 AM</td>
          <td class='mobile-hide'>Smith 4001</td>
          <td class='mobile-hide'>40</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSection20928'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection20928'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editSection20928' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the following class section below:</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="crn" value="20928" disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="course" value="CST 101" disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="section" value="001" disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="title" value="Microcomputer Applications" disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>
                        <select class="form-control" name="instructor" required>
                          <option disabled>Select Instructor</option>
                          <option value='1'>Dewayne Brown</option>
                          <option value='2'>Gina Bullock</option>
                          <option value='3'>Karreem Hogan</option>
                          <option value='4'>Anthony Joyner</option>
                          <option value='5'>Catina Lynch</option>
                          <option value='6'>Kathryn Moland</option>
                          <option value='7'>Rahmira Rufus</option>
                          <option selected value='8'>Mariama Sidibe</option>
                          <option value='9'>Evelyn Sowells</option>
                          <option value='10'>Li-Shiang Tsay</option>
                          <option value='11'>Peter Udo</option>
                          <option value='12'>Qingan Zeng</option>
                        </select>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>
                        <select class="form-control" name="type" required>
                          <option disabled>Select Course Type</option>
                          <option value='1' selected>On-Campus</option>
                          <option value='2'>Online</option>
                        </select>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8' style='margin-bottom:10px;'>
                        <input type="checkbox" name="days" value="M" checked> Monday<br>
                        <input type="checkbox" name="days" value="T"> Tuesday<br>
                        <input type="checkbox" name="days" value="W" checked> Wednesday<br>
                        <input type="checkbox" name="days" value="R"> Thursday<br>
                        <input type="checkbox" name="days" value="F" checked> Friday
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'>
                        <input type="time" class="form-control" name="start" value="10:00">
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'>
                        <input type="time" class="form-control" name="end" value="10:50">
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="location" value="Smith 4001" required>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="seats" value="40" required>
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
          <div class='modal fade' id='removeSection20928' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>20928</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 101</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Microcomputer Applications</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Mariama Sidibe</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>On-Campus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>MWF</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>10:00 AM - 10:50 AM</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Smith 4001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>40</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td>21672</td>
          <td>CST 101</td>
          <td class='mobile-hide'>05A</td>
          <td class='mobile-hide'>Microcomputer Applications</td>
          <td class='mobile-hide'>Mariama Sidibe</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>Blackboard</td>
          <td class='mobile-hide'>35</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSection21672'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21672'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editSection21672' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the following class section below:</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="crn" value="21672" disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="course" value="CST 101" disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="section" value="05A" disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="title" value="Microcomputer Applications" disabled>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>
                        <select class="form-control" name="instructor" required>
                          <option disabled>Select Instructor</option>
                          <option value='1'>Dewayne Brown</option>
                          <option value='2'>Gina Bullock</option>
                          <option value='3'>Karreem Hogan</option>
                          <option value='4'>Anthony Joyner</option>
                          <option value='5'>Catina Lynch</option>
                          <option value='6'>Kathryn Moland</option>
                          <option value='7'>Rahmira Rufus</option>
                          <option selected value='8'>Mariama Sidibe</option>
                          <option value='9'>Evelyn Sowells</option>
                          <option value='10'>Li-Shiang Tsay</option>
                          <option value='11'>Peter Udo</option>
                          <option value='12'>Qingan Zeng</option>
                        </select>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>
                        <select class="form-control" name="type" required>
                          <option disabled>Select Course Type</option>
                          <option value='1'>On-Campus</option>
                          <option value='2' selected>Online</option>
                        </select>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8' style='margin-bottom:10px;'>
                        <input type="checkbox" name="days" value="M"> Monday<br>
                        <input type="checkbox" name="days" value="T"> Tuesday<br>
                        <input type="checkbox" name="days" value="W"> Wednesday<br>
                        <input type="checkbox" name="days" value="R"> Thursday<br>
                        <input type="checkbox" name="days" value="F"> Friday
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'>
                        <input type="time" class="form-control" name="start">
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'>
                        <input type="time" class="form-control" name="end">
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="location" value="Blackboard" required>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>
                        <input type="text" class="form-control" name="seats" value="35" required>
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
          <div class='modal fade' id='removeSection21672' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21672</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 101</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Microcomputer Applications</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Mariama Sidibe</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>Online</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Blackboard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>35</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td>20929</td>
          <td>CST 120</td>
          <td class='mobile-hide'>001</td>
          <td class='mobile-hide'>Fundamentals of Technology</td>
          <td class='mobile-hide'>Dewayne Brown</td>
          <td class='mobile-hide'>MWF</td>
          <td class='mobile-hide'>2:00 PM - 2:50 PM</td>
          <td class='mobile-hide'>Smith 2014</td>
          <td class='mobile-hide'>100</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection20929'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection20929' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>20929</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 120</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Fundamentals of Technology</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Dewayne Brown</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>On-Campus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>MWF</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>2:00 PM - 2:50 PM</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Smith 2014</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>100</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td>21102</td>
          <td>CST 120</td>
          <td class='mobile-hide'>002</td>
          <td class='mobile-hide'>Fundamentals of Technology</td>
          <td class='mobile-hide'>Dewayne Brown</td>
          <td class='mobile-hide'>TR</td>
          <td class='mobile-hide'>9:30 AM - 10:45 AM</td>
          <td class='mobile-hide'>Smith 2014</td>
          <td class='mobile-hide'>100</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21102'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection21102' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21102</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 120</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>002</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Fundamentals of Technology</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Dewayne Brown</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>On-Campus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>TR</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>9:30 AM - 10:45 AM</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Smith 2014</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>100</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td>21674</td>
          <td>CST 130</td>
          <td class='mobile-hide'>05A</td>
          <td class='mobile-hide'>Introduction to Unix/Linux</td>
          <td class='mobile-hide'>Catina Lynch</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>Blackboard</td>
          <td class='mobile-hide'>45</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21674'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection21674' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21674</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 130</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Introduction to Unix/Linux</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Catina Lynch</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>Online</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Blackboard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>45</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <tr>
          <td>21676</td>
          <td>CST 231</td>
          <td class='mobile-hide'>05A</td>
          <td class='mobile-hide'>Web Systems</td>
          <td class='mobile-hide'>Anthony Joyner</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>Blackboard</td>
          <td class='mobile-hide'>1</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21676'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection21676' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21676</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 231</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Web Systems</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Anthony Joyner</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>Online</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Blackboard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>1</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <tr>
          <td>20933</td>
          <td>CST 240</td>
          <td class='mobile-hide'>001</td>
          <td class='mobile-hide'>Applied Java Programming</td>
          <td class='mobile-hide'>Anthony Joyner</td>
          <td class='mobile-hide'>TR</td>
          <td class='mobile-hide'>6:00 PM - 7:15 PM</td>
          <td class='mobile-hide'>Smith 4008</td>
          <td class='mobile-hide'>28</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection20933'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection20933' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>20933</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 240</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Applied Java Programming</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Anthony Joyner</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>On-Campus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>TR</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>6:00 PM - 7:15 PM</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Smith 4008</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>28</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <tr>
          <td>21239</td>
          <td>CST 240</td>
          <td class='mobile-hide'>002</td>
          <td class='mobile-hide'>Applied Java Programming</td>
          <td class='mobile-hide'>Peter Udo</td>
          <td class='mobile-hide'>TR</td>
          <td class='mobile-hide'>1:30 PM - 2:45 PM</td>
          <td class='mobile-hide'>Smith 4001</td>
          <td class='mobile-hide'>45</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21239'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection21239' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21239</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 240</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>002</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Applied Java Programming</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Peter Udo</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>On-Campus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>TR</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>1:30 PM - 2:45 PM</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Smith 4001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>45</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <tr>
          <td>21675</td>
          <td>CST 240</td>
          <td class='mobile-hide'>05A</td>
          <td class='mobile-hide'>Applied Java Programming</td>
          <td class='mobile-hide'>Anthony Joyner</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>Blackboard</td>
          <td class='mobile-hide'>40</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21675'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection21675' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21675</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 240</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Applied Java Programming</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Anthony Joyner</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>Online</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Blackboard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>40</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <tr>
          <td>21186</td>
          <td>CST 325</td>
          <td class='mobile-hide'>05A</td>
          <td class='mobile-hide'>Computer Database Management II</td>
          <td class='mobile-hide'>Rahmira Rufus</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>Blackboard</td>
          <td class='mobile-hide'>40</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21186'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection21186' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21186</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 325</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Computer Database Management II</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Rahmira Rufus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>Online</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Blackboard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>40</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <tr>
          <td>22088</td>
          <td>CST 325</td>
          <td class='mobile-hide'>05A</td>
          <td class='mobile-hide'>Computer Database Management II</td>
          <td class='mobile-hide'>Rahmira Rufus</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>Blackboard</td>
          <td class='mobile-hide'>25</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection22088'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection22088' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>22088</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 325</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Computer Database Management II</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Rahmira Rufus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>Online</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Blackboard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>25</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <tr>
          <td>21654</td>
          <td>CST 460</td>
          <td class='mobile-hide'>001</td>
          <td class='mobile-hide'>System Integration and Architecture</td>
          <td class='mobile-hide'>Karreem Hogan</td>
          <td class='mobile-hide'>TR</td>
          <td class='mobile-hide'>9:30 AM - 10:45 AM</td>
          <td class='mobile-hide'>Price 201-B</td>
          <td class='mobile-hide'>35</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21654'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection21654' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21654</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 460</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>System Integration and Architecture</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Karreem Hogan</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>On-Campus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>TR</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>9:30 AM - 10:45 AM</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Price 201-B</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>35</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <tr>
          <td>20938</td>
          <td>CST 498</td>
          <td class='mobile-hide'>001</td>
          <td class='mobile-hide'>Senior Project I: A Capstone Experience</td>
          <td class='mobile-hide'>Evelyn Sowells</td>
          <td class='mobile-hide'>TR</td>
          <td class='mobile-hide'>11:00 AM - 12:15 PM</td>
          <td class='mobile-hide'>Smith 4001</td>
          <td class='mobile-hide'>40</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection20938'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection20938' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>20938</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 498</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Senior Project I: A Capstone Experience</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Evelyn Sowells</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>On-Campus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>TR</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>11:00 AM - 12:15 PM</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Smith 4001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>40</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <tr>
          <td>22089</td>
          <td>CST 498</td>
          <td class='mobile-hide'>05A</td>
          <td class='mobile-hide'>Senior Project I: A Capstone Experience</td>
          <td class='mobile-hide'>Rahmira Rufus</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>Blackboard</td>
          <td class='mobile-hide'>25</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection22089'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection22089' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>22089</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 498</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Senior Project I: A Capstone Experience</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Rahmira Rufus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>Online</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Blackboard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>25</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <tr>
          <td>22448</td>
          <td>CST 499</td>
          <td class='mobile-hide'>05A</td>
          <td class='mobile-hide'>Senior Project II: A Capstone Experience</td>
          <td class='mobile-hide'>Rahmira Rufus</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>Blackboard</td>
          <td class='mobile-hide'>30</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSectionTBD'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection22448'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeSection22448' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>Computer Systems Technology</strong> department during the <strong>Spring 2020</strong> semester?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>22448</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 499</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Section</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Senior Project II: A Capstone Experience</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Instructor</strong></div>
                      <div class='col-sm-8'>Rahmira Rufus</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Type</strong></div>
                      <div class='col-sm-8'>Online</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Times</strong></div>
                      <div class='col-sm-8'>N/A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Location</strong></div>
                      <div class='col-sm-8'>Blackboard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seat Capacity</strong></div>
                      <div class='col-sm-8'>30</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Section</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

      </tbody>
    </table>

  </div>
</body>
</html>
