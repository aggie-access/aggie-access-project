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
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class="container">

  <h1>Section Management Dashboard</h1>
    <p style='margin-bottom:35px;'>You may add or remove course sections by clicking the appropriate buttons.</p>

    <h2 style='margin-bottom:0; margin-top:35px;'>Spring 2020 | Computer Science</h2>

    <button type='button' class='btn btn-success pull-right' data-toggle='modal' data-target='#addNewStudent' style='position:relative; bottom:5px;'>Add <span class='mobile-hide'>New Section</span></button>

    <form action='' method='post'>
      <div class='modal fade' id='addNewStudent' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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

    <table class='table table-striped'>
      <thead>
        <tr>
          <th class='mobile-hide'>CRN</th>
          <th>Course No.</th>
          <th>Course Title</th>
          <th>Course Section</th>
          <th>Meeting Days</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Location</th>
          <th>Seats</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class='mobile-hide'>20928</td>
          <td>101</td>
          <td>MicroComputer Applications</td>
          <td>001</td>
          <td>MWF</td>
          <td>10:00</td>
          <td>10:50</td>
          <td>Smith 4001</td>
          <td>40</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection20928'>Remove</button></td>
        </tr>
        <form action='' method='post'>
          <div class='modal fade' id='removeSection20928' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>20928</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>101</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>MicroComputer Applications</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>MWF</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'>10:00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'>10:50</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>Smith 4001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>21672</td>
          <td>101</td>
          <td>MicroComputer Applications</td>
          <td>05A</td>
          <td></td>
          <td></td>
          <td></td>
          <td>BlackBoard</td>
          <td>35</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21672'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection21672' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21672</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>101</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>MicroComputer Applications</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>BlackBoard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>20929</td>
          <td>120</td>
          <td>Fundamentals of Technology</td>
          <td>001</td>
          <td>MWF</td>
          <td>14:00</td>
          <td>14:50</td>
          <td>Smith 2014</td>
          <td>100</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection20929'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection20929' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>20929</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>120</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Fundamentals of Technology</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>MWF</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'>14:00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'>14:50</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>Smith 2014</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>21102</td>
          <td>120</td>
          <td>Fundamentals of Technology</td>
          <td>002</td>
          <td>TR</td>
          <td>09:30</td>
          <td>10:45</td>
          <td>Smith 2014</td>
          <td>100</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21102'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection21102' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21102</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>120</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Fundamentals of Technology</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section</strong></div>
                      <div class='col-sm-8'>002</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>TR</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'>09:30</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'>10:45</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>Smith 2014</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>21674</td>
          <td>130</td>
          <td>Introduction to Unix/Linux</td>
          <td>05A</td>
          <td></td>
          <td></td>
          <td></td>
          <td>BlackBoard</td>
          <td>45</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21674'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection21674' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21674</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>130</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Introduction to Unix/Linux</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>BlackBoard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>21676</td>
          <td>231</td>
          <td>Web Systems</td>
          <td>05A</td>
          <td></td>
          <td></td>
          <td></td>
          <td>BlackBoard</td>
          <td>1</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21676'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection21676' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21676</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>231</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Web Systems</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>BlackBoard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>20933</td>
          <td>240</td>
          <td>Applied Java Programming</td>
          <td>001</td>
          <td>TR</td>
          <td>18:00</td>
          <td>19:15</td>
          <td>Smith 4008</td>
          <td>28</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection20933'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection20933' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>20933</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>240</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Applied Java Programming</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>TR</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'>18:00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'>19:15</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>Smith 4008</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>21239</td>
          <td>240</td>
          <td>Applied Java Programming</td>
          <td>002</td>
          <td>TR</td>
          <td>13:30</td>
          <td>14:45</td>
          <td>Smith 4001</td>
          <td>45</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21239'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection21239' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21239</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>240</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Applied Java Programming</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>002</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>TR</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'>13:30</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'>14:45</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>Smith 4001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>21675</td>
          <td>240</td>
          <td>Applied Java Programming</td>
          <td>05A</td>
          <td></td>
          <td></td>
          <td></td>
          <td>BlackBoard</td>
          <td>40</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21675'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection21675' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21675</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>240</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Applied Java Programming</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>BlackBoard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>21186</td>
          <td>325</td>
          <td>Computer Database Management II</td>
          <td>05A</td>
          <td></td>
          <td></td>
          <td></td>
          <td>BlackBoard</td>
          <td>40</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21186'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection21186' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21186</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>325</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Computer Database Management II</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>BlackBoard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>22088</td>
          <td>325</td>
          <td>Computer Database Management II</td>
          <td>05A</td>
          <td></td>
          <td></td>
          <td></td>
          <td>BlackBoard</td>
          <td>25</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection22088'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection22088' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>22088</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>325</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Computer Database Management II</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>BlackBoard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>21654</td>
          <td>460</td>
          <td>System Integration and Architecture</td>
          <td>001</td>
          <td>TR</td>
          <td>09:30</td>
          <td>10:45</td>
          <td>Price 201-B</td>
          <td>35</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection21654'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection21654' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>21654</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>460</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>System Integration and Architecture</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>TR</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'>09:30</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'>10:45</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>Price 201-B</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>20938</td>
          <td>498</td>
          <td>Senior Project I: A Capstone Experience</td>
          <td>001</td>
          <td>TR</td>
          <td>11:00</td>
          <td>12:15</td>
          <td>Smith 4001</td>
          <td>40</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection20938'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection20938' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>20938</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>498</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Senior Project I: A Capstone Experience</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'>TR</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'>11:00<strong>Start Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'>12:15</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>Smith 4001</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>22089</td>
          <td>498</td>
          <td>Senior Project I: A Capstone Experience</td>
          <td>05A</td>
          <td></td>
          <td></td>
          <td></td>
          <td>BlackBoard</td>
          <td>25</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection22089'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection22089' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>22089</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>498</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Senior Project I: A Capstone Experience</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>BlackBoard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
        <td class='mobile-hide'>22448</td>
          <td>499</td>
          <td>Senior Project II: A Capstone Experience</td>
          <td>05A</td>
          <td></td>
          <td></td>
          <td></td>
          <td>BlackBoard</td>
          <td>30</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection22448'>Remove</button></td>        </tr>

          <form action='' method='post'>
          <div class='modal fade' id='removeSection22448' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Section</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from <strong>Spring 2020</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>CRN</strong></div>
                      <div class='col-sm-8'>22448</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course No.</strong></div>
                      <div class='col-sm-8'>499</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Senior Project II: A Capstone Experience</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Section No.</strong></div>
                      <div class='col-sm-8'>05A</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Meeting Days</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Start Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>End Time</strong></div>
                      <div class='col-sm-8'></div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Location</strong></div>
                      <div class='col-sm-8'>BlackBoard</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Seats</strong></div>
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
