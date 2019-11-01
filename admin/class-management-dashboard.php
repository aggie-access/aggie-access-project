<?php
include '../assets/admin/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Class Management Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#class-management').addClass('active');
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

  <div class='container'>

    <h1>Class Management Dashboard</h1>
    <p style='margin-bottom:35px;'>You may add, edit, or remove courses from the selected department by clicking the appropriate buttons.</p>

    <button type='button' class='btn btn-success pull-right' data-toggle='modal' data-target='#addNewCourse' style='position:relative; bottom:5px;'>Add <span class='mobile-hide'>New Course</span></button>

    <form action='' method='post'>
      <div class='modal fade' id='addNewCourse' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Course</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Enter the details for the new class you are adding in the <strong>Computer Systems Technology</strong> department below:</p>
              <div class='form-group'>
                <label>Course Number</label>
                <input type='text' class='form-control' name='course' minlength='3' maxlength='3' size='3' required>
              </div>
              <div class='form-group'>
                <label>Course Title</label>
                <input type='text' class='form-control' name='title' required>
              </div>
              <div class='form-group'>
                <label>Course Description</label>
                <textarea class='form-control' name='description' required></textarea>
              </div>
              <div class='form-group'>
                <label>Credit Hours</label>
                <select class='form-control' name='credits' required>
                  <option selected disabled>Select Credit Hours</option>
                  <option value='1'>1.0</option>
                  <option value='2'>2.0</option>
                  <option value='3'>3.0</option>
                  <option value='4'>4.0</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Course Level</label>
                <select class='form-control' name='level' required>
                  <option selected disabled>Select Credit Hours</option>
                  <option value='1'>Undergraduate</option>
                  <option value='2'>Graduate</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Prerequisite Course</label>
                <select class='form-control' name='prerequisite'>
                  <option selected disabled>Select Prerequisite Course</option>
                  <option value='1'>CST 101 - Microcomputer Applications</option>
                  <option value='2'>CST 120 - Fundamentals of Technology</option>
                  <option value='3'>CST 130 - Introduction to Unix/Linux</option>
                  <option value='4'>CST 140 - Introduction to Computer Programming</option>
                  <option value='5'>CST 150 - Introduction to Computer Programming Laboratory</option>
                  <option value='6'>CST 231 - Web Systems</option>
                  <option value='7'>CST 240 - Applied Java Programming</option>
                  <option value='8'>CST 325 - Computer Database Management II</option>
                  <option value='9'>CST 460 - System Integration and Architecture</option>
                  <option value='10'>CST 498 - Senior Project I: A Capstone Experience</option>
                  <option value='11'>CST 499 - Senior Project II: A Capstone Experience</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Corequisite Course</label>
                <select class='form-control' name='prerequisite'>
                  <option selected disabled>Select Prerequisite Course</option>
                  <option value='1'>CST 101 - Microcomputer Applications</option>
                  <option value='2'>CST 120 - Fundamentals of Technology</option>
                  <option value='3'>CST 130 - Introduction to Unix/Linux</option>
                  <option value='4'>CST 140 - Introduction to Computer Programming</option>
                  <option value='5'>CST 150 - Introduction to Computer Programming Laboratory</option>
                  <option value='6'>CST 231 - Web Systems</option>
                  <option value='7'>CST 240 - Applied Java Programming</option>
                  <option value='8'>CST 325 - Computer Database Management II</option>
                  <option value='9'>CST 460 - System Integration and Architecture</option>
                  <option value='10'>CST 498 - Senior Project I: A Capstone Experience</option>
                  <option value='11'>CST 499 - Senior Project II: A Capstone Experience</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Required Textbook ISBN</label>
                <input type='text' class='form-control' name='isbn' minlength='13' maxlength='13' size='13'>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Add Course</button>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <h2 style='margin-bottom:25px; margin-top:35px; border-bottom:1px solid #aaa; padding-bottom:10px;'>Computer Systems Technology</h2>

    <table class='table table-striped'>
      <thead>
        <tr>
          <th>Course</th>
          <th class='mobile-hide' style='width:200px;'>Title</th>
          <th>Credits</th>
          <th class='mobile-hide'>Level</th>
          <th class='mobile-hide'>Prerequisites</th>
          <th class='mobile-hide'>Corequisites</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>CST 101</td>
          <td class='mobile-hide'>Microcomputer Applications</td>
          <td>3.0</td>
          <td class='mobile-hide'>Undergraduate</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>N/A</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editCourse1'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeCourse1'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editCourse1' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit Course</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Edit the details for the selected course in the <strong>Computer Systems Technology</strong> department using the text boxes below:</p>
                  <div class='form-group'>
                    <label>Course Number</label>
                    <input type='text' class='form-control' name='course' value='101' minlength='3' maxlength='3' size='3' required>
                  </div>
                  <div class='form-group'>
                    <label>Course Title</label>
                    <input type='text' class='form-control' name='title' value='Microcomputer Applications' required>
                  </div>
                  <div class='form-group'>
                    <label>Course Description</label>
                    <textarea class='form-control' name='description' required>This course is designed to provide the student with basic computer skills as required in a typical business and technical environment. Emphasis is on business and technical software packages including spreadsheets, database management, word-processing, etc. as run on a Windows platform.</textarea>
                  </div>
                  <div class='form-group'>
                    <label>Credit Hours</label>
                    <select class='form-control' name='credits' required>
                      <option disabled>Select Credit Hours</option>
                      <option value='1'>1.0</option>
                      <option value='2'>2.0</option>
                      <option value='3' selected>3.0</option>
                      <option value='4'>4.0</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Course Level</label>
                    <select class='form-control' name='level' required>
                      <option disabled>Select Credit Hours</option>
                      <option value='1' selected>Undergraduate</option>
                      <option value='2'>Graduate</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Prerequisite Course</label>
                    <select class='form-control' name='prerequisite'>
                      <option selected disabled>Select Prerequisite Course</option>
                      <option value='1'>CST 101 - Microcomputer Applications</option>
                      <option value='2'>CST 120 - Fundamentals of Technology</option>
                      <option value='3'>CST 130 - Introduction to Unix/Linux</option>
                      <option value='4'>CST 140 - Introduction to Computer Programming</option>
                      <option value='5'>CST 150 - Introduction to Computer Programming Laboratory</option>
                      <option value='6'>CST 231 - Web Systems</option>
                      <option value='7'>CST 240 - Applied Java Programming</option>
                      <option value='8'>CST 325 - Computer Database Management II</option>
                      <option value='9'>CST 460 - System Integration and Architecture</option>
                      <option value='10'>CST 498 - Senior Project I: A Capstone Experience</option>
                      <option value='11'>CST 499 - Senior Project II: A Capstone Experience</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Corequisite Course</label>
                    <select class='form-control' name='prerequisite'>
                      <option selected disabled>Select Prerequisite Course</option>
                      <option value='1'>CST 101 - Microcomputer Applications</option>
                      <option value='2'>CST 120 - Fundamentals of Technology</option>
                      <option value='3'>CST 130 - Introduction to Unix/Linux</option>
                      <option value='4'>CST 140 - Introduction to Computer Programming</option>
                      <option value='5'>CST 150 - Introduction to Computer Programming Laboratory</option>
                      <option value='6'>CST 231 - Web Systems</option>
                      <option value='7'>CST 240 - Applied Java Programming</option>
                      <option value='8'>CST 325 - Computer Database Management II</option>
                      <option value='9'>CST 460 - System Integration and Architecture</option>
                      <option value='10'>CST 498 - Senior Project I: A Capstone Experience</option>
                      <option value='11'>CST 499 - Senior Project II: A Capstone Experience</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Required Textbook ISBN</label>
                    <input type='text' class='form-control' name='isbn' minlength='13' maxlength='13' size='13'>
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
          <div class='modal fade' id='removeCourse1' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Course</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following course from the <strong>Computer Systems Technology</strong> department?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 101</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Microcomputer Applications</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Credits</strong></div>
                      <div class='col-sm-8'>3.0</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Level</strong></div>
                      <div class='col-sm-8'>Undergraduate</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Course</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td>CST 140</td>
          <td class='mobile-hide'>Introduction to Computer Programming</td>
          <td>3.0</td>
          <td class='mobile-hide'>Undergraduate</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>CST 150</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editCourse6'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeCourse6'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editCourse6' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit Course</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Edit the details for the selected course in the <strong>Computer Systems Technology</strong> department using the text boxes below:</p>
                  <div class='form-group'>
                    <label>Course Number</label>
                    <input type='text' class='form-control' name='course' value='140' minlength='3' maxlength='3' size='3' required>
                  </div>
                  <div class='form-group'>
                    <label>Course Title</label>
                    <input type='text' class='form-control' name='title' value='Introduction to Computer Programming' required>
                  </div>
                  <div class='form-group'>
                    <label>Course Description</label>
                    <textarea class='form-control' name='description' required>This course gives an introduction to computer programming. Topics include structured program development and the use of a high level programming language to develop software applications.</textarea>
                  </div>
                  <div class='form-group'>
                    <label>Credit Hours</label>
                    <select class='form-control' name='credits' required>
                      <option disabled>Select Credit Hours</option>
                      <option value='1'>1.0</option>
                      <option value='2'>2.0</option>
                      <option value='3' selected>3.0</option>
                      <option value='4'>4.0</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Course Level</label>
                    <select class='form-control' name='level' required>
                      <option disabled>Select Credit Hours</option>
                      <option value='1' selected>Undergraduate</option>
                      <option value='2'>Graduate</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Prerequisite Course</label>
                    <select class='form-control' name='prerequisite'>
                      <option selected disabled>Select Prerequisite Course</option>
                      <option value='1'>CST 101 - Microcomputer Applications</option>
                      <option value='2'>CST 120 - Fundamentals of Technology</option>
                      <option value='3'>CST 130 - Introduction to Unix/Linux</option>
                      <option value='4'>CST 140 - Introduction to Computer Programming</option>
                      <option value='5'>CST 150 - Introduction to Computer Programming Laboratory</option>
                      <option value='6'>CST 231 - Web Systems</option>
                      <option value='7'>CST 240 - Applied Java Programming</option>
                      <option value='8'>CST 325 - Computer Database Management II</option>
                      <option value='9'>CST 460 - System Integration and Architecture</option>
                      <option value='10'>CST 498 - Senior Project I: A Capstone Experience</option>
                      <option value='11'>CST 499 - Senior Project II: A Capstone Experience</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Corequisite Course</label>
                    <select class='form-control' name='prerequisite'>
                      <option disabled>Select Prerequisite Course</option>
                      <option value='1'>CST 101 - Microcomputer Applications</option>
                      <option value='2'>CST 120 - Fundamentals of Technology</option>
                      <option value='3'>CST 130 - Introduction to Unix/Linux</option>
                      <option value='4'>CST 140 - Introduction to Computer Programming</option>
                      <option value='5' selected>CST 150 - Introduction to Computer Programming Laboratory</option>
                      <option value='6'>CST 231 - Web Systems</option>
                      <option value='7'>CST 240 - Applied Java Programming</option>
                      <option value='8'>CST 325 - Computer Database Management II</option>
                      <option value='9'>CST 460 - System Integration and Architecture</option>
                      <option value='10'>CST 498 - Senior Project I: A Capstone Experience</option>
                      <option value='11'>CST 499 - Senior Project II: A Capstone Experience</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Required Textbook ISBN</label>
                    <input type='text' class='form-control' name='isbn' value='9780134543666' minlength='13' maxlength='13' size='13'>
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
          <div class='modal fade' id='removeCourse6' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Course</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following course from the <strong>Computer Systems Technology</strong> department?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 140</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Introduction to Computer Programming</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Credits</strong></div>
                      <div class='col-sm-8'>3.0</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Level</strong></div>
                      <div class='col-sm-8'>Undergraduate</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Course</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td>CST 150</td>
          <td class='mobile-hide'>Introduction to Computer Programming Laboratory</td>
          <td>1.0</td>
          <td class='mobile-hide'>Undergraduate</td>
          <td class='mobile-hide'>N/A</td>
          <td class='mobile-hide'>CST 140</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editCourse7'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeCourse7'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editCourse7' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit Course</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Edit the details for the selected course in the <strong>Computer Systems Technology</strong> department using the text boxes below:</p>
                  <div class='form-group'>
                    <label>Course Number</label>
                    <input type='text' class='form-control' name='course' value='150' minlength='3' maxlength='3' size='3' required>
                  </div>
                  <div class='form-group'>
                    <label>Course Title</label>
                    <input type='text' class='form-control' name='title' value='Introduction to Computer Programming Laboratory' required>
                  </div>
                  <div class='form-group'>
                    <label>Course Description</label>
                    <textarea class='form-control' name='description' required>In this laboratory, students will apply the concepts and practices learned in the programming lecture by completing relevant programs with a practical or information technology focus.</textarea>
                  </div>
                  <div class='form-group'>
                    <label>Credit Hours</label>
                    <select class='form-control' name='credits' required>
                      <option disabled>Select Credit Hours</option>
                      <option value='1' selected>1.0</option>
                      <option value='2'>2.0</option>
                      <option value='3'>3.0</option>
                      <option value='4'>4.0</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Course Level</label>
                    <select class='form-control' name='level' required>
                      <option disabled>Select Credit Hours</option>
                      <option value='1' selected>Undergraduate</option>
                      <option value='2'>Graduate</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Prerequisite Course</label>
                    <select class='form-control' name='prerequisite'>
                      <option selected disabled>Select Prerequisite Course</option>
                      <option value='1'>CST 101 - Microcomputer Applications</option>
                      <option value='2'>CST 120 - Fundamentals of Technology</option>
                      <option value='3'>CST 130 - Introduction to Unix/Linux</option>
                      <option value='4'>CST 140 - Introduction to Computer Programming</option>
                      <option value='5'>CST 150 - Introduction to Computer Programming Laboratory</option>
                      <option value='6'>CST 231 - Web Systems</option>
                      <option value='7'>CST 240 - Applied Java Programming</option>
                      <option value='8'>CST 325 - Computer Database Management II</option>
                      <option value='9'>CST 460 - System Integration and Architecture</option>
                      <option value='10'>CST 498 - Senior Project I: A Capstone Experience</option>
                      <option value='11'>CST 499 - Senior Project II: A Capstone Experience</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Corequisite Course</label>
                    <select class='form-control' name='prerequisite'>
                      <option disabled>Select Prerequisite Course</option>
                      <option value='1'>CST 101 - Microcomputer Applications</option>
                      <option value='2'>CST 120 - Fundamentals of Technology</option>
                      <option value='3'>CST 130 - Introduction to Unix/Linux</option>
                      <option value='4' selected>CST 140 - Introduction to Computer Programming</option>
                      <option value='5'>CST 150 - Introduction to Computer Programming Laboratory</option>
                      <option value='6'>CST 231 - Web Systems</option>
                      <option value='7'>CST 240 - Applied Java Programming</option>
                      <option value='8'>CST 325 - Computer Database Management II</option>
                      <option value='9'>CST 460 - System Integration and Architecture</option>
                      <option value='10'>CST 498 - Senior Project I: A Capstone Experience</option>
                      <option value='11'>CST 499 - Senior Project II: A Capstone Experience</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Required Textbook ISBN</label>
                    <input type='text' class='form-control' name='isbn' value='9780134543666' minlength='13' maxlength='13' size='13'>
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
          <div class='modal fade' id='removeCourse7' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Course</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following course from the <strong>Computer Systems Technology</strong> department?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 150</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Introduction to Computer Programming Laboratory</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Credits</strong></div>
                      <div class='col-sm-8'>1.0</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Level</strong></div>
                      <div class='col-sm-8'>Undergraduate</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Course</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td>CST 240</td>
          <td class='mobile-hide'>Applied Java Programming</td>
          <td>3.0</td>
          <td class='mobile-hide'>Undergraduate</td>
          <td class='mobile-hide'>CST 140</td>
          <td class='mobile-hide'>N/A</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editCourse11'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeCourse11'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editCourse11' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit Course</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Edit the details for the selected course in the <strong>Computer Systems Technology</strong> department using the text boxes below:</p>
                  <div class='form-group'>
                    <label>Course Number</label>
                    <input type='text' class='form-control' name='course' value='240' minlength='3' maxlength='3' size='3' required>
                  </div>
                  <div class='form-group'>
                    <label>Course Title</label>
                    <input type='text' class='form-control' name='title' value='Applied Java Programming' required>
                  </div>
                  <div class='form-group'>
                    <label>Course Description</label>
                    <textarea class='form-control' name='description' required>The course provides a comprehensive overview of basic programming concepts, the Java programming language using an object-oriented approach, and the software development life cycle. The course emphasizes problem solving and good practices for program construction, documentation, testing, and debugging.</textarea>
                  </div>
                  <div class='form-group'>
                    <label>Credit Hours</label>
                    <select class='form-control' name='credits' required>
                      <option disabled>Select Credit Hours</option>
                      <option value='1'>1.0</option>
                      <option value='2'>2.0</option>
                      <option value='3' selected>3.0</option>
                      <option value='4'>4.0</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Course Level</label>
                    <select class='form-control' name='level' required>
                      <option disabled>Select Credit Hours</option>
                      <option value='1' selected>Undergraduate</option>
                      <option value='2'>Graduate</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Prerequisite Course</label>
                    <select class='form-control' name='prerequisite'>
                      <option selected disabled>Select Prerequisite Course</option>
                      <option value='1'>CST 101 - Microcomputer Applications</option>
                      <option value='2'>CST 120 - Fundamentals of Technology</option>
                      <option value='3'>CST 130 - Introduction to Unix/Linux</option>
                      <option value='4' selected>CST 140 - Introduction to Computer Programming</option>
                      <option value='5'>CST 150 - Introduction to Computer Programming Laboratory</option>
                      <option value='6'>CST 231 - Web Systems</option>
                      <option value='7'>CST 240 - Applied Java Programming</option>
                      <option value='8'>CST 325 - Computer Database Management II</option>
                      <option value='9'>CST 460 - System Integration and Architecture</option>
                      <option value='10'>CST 498 - Senior Project I: A Capstone Experience</option>
                      <option value='11'>CST 499 - Senior Project II: A Capstone Experience</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Corequisite Course</label>
                    <select class='form-control' name='prerequisite'>
                      <option selected disabled>Select Prerequisite Course</option>
                      <option value='1'>CST 101 - Microcomputer Applications</option>
                      <option value='2'>CST 120 - Fundamentals of Technology</option>
                      <option value='3'>CST 130 - Introduction to Unix/Linux</option>
                      <option value='4'>CST 140 - Introduction to Computer Programming</option>
                      <option value='5'>CST 150 - Introduction to Computer Programming Laboratory</option>
                      <option value='6'>CST 231 - Web Systems</option>
                      <option value='7'>CST 240 - Applied Java Programming</option>
                      <option value='8'>CST 325 - Computer Database Management II</option>
                      <option value='9'>CST 460 - System Integration and Architecture</option>
                      <option value='10'>CST 498 - Senior Project I: A Capstone Experience</option>
                      <option value='11'>CST 499 - Senior Project II: A Capstone Experience</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Required Textbook ISBN</label>
                    <input type='text' class='form-control' name='isbn' value='9780134462011' minlength='13' maxlength='13' size='13'>
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
          <div class='modal fade' id='removeCourse11' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Course</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following course from the <strong>Computer Systems Technology</strong> department?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Number</strong></div>
                      <div class='col-sm-8'>CST 240</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Title</strong></div>
                      <div class='col-sm-8'>Applied Java Programming</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Credits</strong></div>
                      <div class='col-sm-8'>3.0</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Course Level</strong></div>
                      <div class='col-sm-8'>Undergraduate</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Course</button>
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
