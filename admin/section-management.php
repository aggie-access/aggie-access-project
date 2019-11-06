<?php
include '../assets/admin/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Section Management</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#section-management').addClass('active');
  });
  </script>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class='container'>

    <h1>Section Management</h1>
    <p style='margin-bottom:35px;'>Select a semester and a department to see the class sections being offered during a particular semester.</p>

    <form action='section-management-dashboard.php' method='get' style='margin-bottom:30px;' id='form'>

      <div class='row'>
        <div class='col-sm-6'>
          <div class='form-group'>
            <label>Semester</label>
            <select class='form-control' name='semester' required>
              <option disabled selected value>Select Semester</option>
              <option value='8'>Summer II 2020</option>
              <option value='7'>Summer I 2020</option>
              <option value='6'>Spring 2020</option>
            </select>
          </div>
        </div>
        <div class='col-sm-6'>
          <div class='form-group'>
            <label>Department</label>
            <select class='form-control' name='department' required>
              <option disabled selected value>Select Department</option>
              <option value='11'>Accounting and Finance</option>
              <option value='16'>Administration and Instructional Services</option>
              <option value='1'>Agribusiness, Applied Economics and Agriscience Education</option>
              <option value='2'>Animal Sciences</option>
              <option value='31'>Applied Engineering Technology</option>
              <option value='36'>Applied Science and Technology</option>
              <option value='32'>Biology</option>
              <option value='33'>Built Environment</option>
              <option value='12'>Business Education</option>
              <option value='21'>Chemical, Biological and Bio Engineering</option>
              <option value='34'>Chemistry</option>
              <option value='20'>Civil, Architectural and Environmental Engineering</option>
              <option value='23'>Computational Science and Engineering</option>
              <option value='22'>Computer Science</option>
              <option value='35'>Computer Systems Technology</option>
              <option value='17'>Counseling</option>
              <option value='9'>Criminal Justice</option>
              <option value='13'>Economics</option>
              <option value='18'>Educator Preparation</option>
              <option value='24'>Electrical and Computer Engineering</option>
              <option value='5'>English</option>
              <option value='3'>Family and Consumer Sciences</option>
              <option value='37'>Graphic Design Technology</option>
              <option value='6'>History and Political Science</option>
              <option value='27'>Human Performance and Leisure Studies</option>
              <option value='25'>Industrial and Systems Engineering</option>
              <option value='7'>Journalism and Mass Communication</option>
              <option value='19'>Leadership Studies and Adult Education</option>
              <option value='8'>Liberal Studies</option>
              <option value='14'>Management</option>
              <option value='15'>Marketing and Supply Chain Management</option>
              <option value='38'>Mathematics</option>
              <option value='26'>Mechanical Engineering</option>
              <option value='40'>Nanoengineering</option>
              <option value='4'>Natural Resources and Environmental Design</option>
              <option value='39'>Physics</option>
              <option value='29'>Psychology</option>
              <option value='28'>School of Nursing</option>
              <option value='30'>Social Work and Sociology</option>
              <option value='10'>Visual and Performing Arts</option>
            </select>
          </div>
        </div>
      </div>

      <button type='submit' class='btn btn-default'>Submit</button>

    </form>

  </div>
</body>
</html>
