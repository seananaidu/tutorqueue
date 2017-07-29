<!doctype html>
<html>
<head>
  <title>QSC Tutor Queue</title>
  <meta charset="utf-8">
  <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
  <link rel="icon" href="data:;base64,=">

  <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
  <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/bootstrap.min.css" />

  <script src="<?php echo Config::get('URL'); ?>js/jquery-latest.min.js"></script> <!--  <script src="<?php echo Config::get('URL'); ?>js/jquery-1.11.3.min.js"></script> -->
  <script src="<?php echo Config::get('URL'); ?>js/bootstrap.min.js"></script>
</head>
<body>

  <!-- wrapper, to center website -->
  <div class="wrapper">

    <!-- navigation -->
    <ul class="navigation">

      <?php if (Session::userIsLoggedIn()) { ?>

        <!-- Admins -->
        <?php if (Session::get("user_account_type") == 7) : ?>
          <li <?php if (View::checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>admin/index">Admin Home</a>
          </li>
          <li <?php if (View::checkForActiveController($filename, "greeter")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>greeter/index">Greeter Home</a>
          </li>
          <li <?php if (View::checkForActiveController($filename, "student")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>student/index">Student Home</a>
          </li>
        <?php endif; ?>

        <!-- Greeters -->
        <?php if (Session::get("user_account_type") == 3) : ?>
          <li <?php if (View::checkForActiveController($filename, "greeter")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>greeter/index">Greeter Home</a>
          </li>
        <?php endif; ?>

        <!-- Students -->
        <!-- Should not have header shown as students stay on one page and do not need to log in or out -->

      <?php } else { ?>

        <!-- for not logged in users -->
        <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
        </li>

      <?php } ?>

    </ul>

    <?php if (Session::userIsLoggedIn()) { ?>
      <div class="panel panel-header">
<!--        Logged in as: <?php echo Session::get("user_name"); ?>, Table Number = <?php echo Session::get("table_number"); ?> -->
        Logged in as: <?php echo Session::get("user_name"); ?>, Table Number =
        <?php
          $val = Session::get("table_number");
          if (gettype($val) == "integer") {
            echo Session::get("table_number");
          } else if (gettype($val) == "array") {
            echo Session::get("table_number")[0];
          }
        ?>
      </div>
    <?php } ?>





    <div class="container">
      <h1>Greeter [Student Setup] View</h1>
      <div class="box">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div class="text-center">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">

                <div class="panel-heading">Greeter Setup Device Table Number Panel</div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-default">

                      <div class="panel-body">
                        <div class="table-responsive">
                          <form method="post" onsubmit="return verifySubmit();" autocomplete="off">
<!--
                          <form method="post" onsubmit="return verifySubmit();" action="<?php echo Config::get('URL'); ?>HelpRequest/create">
-->
                            <input type="hidden" id="hidden_val">

                            <div class="col-xs-4 col-xs-offset-4">
                              <input type="text" class="form-control" id="input_text_field" name="" placeholder="Device table #" required>
                            </div>

                            <!--
                            <?php foreach (StudentModel::getSubjects() as $subj) { ?>
                              <option value="<?= $subj->name; ?>"><?= $subj->name; ?></option>
                            <?php } ?>
                            -->

                            <br>

                            <div class="col-xs-12">
<!--
                              <button type="button" class="btn btn-default" title="Submit the table number for this device.">
-->
                              <a class="btn btn-default" href="<?php echo Config::get('URL'); ?>student/updateTableSetup" title="Submit the table number for this device.">
                                Enter
                              </a>

                            </div>

                          </form>

                        </div> <!-- End "table-responsive" -->
                      </div> <!-- End "panel-body" -->

                    </div> <!-- end "panel panel-default" -->
                  </div> <!-- end "col-lg-12" -->
                </div> <!-- end "row" -->

              </div> <!-- end "panel panel-default" -->
            </div> <!-- end "col-lg-12" -->
          </div> <!-- end "row" -->
        </div> <!-- end "text-center" -->

      </div> <!-- end "box" -->
    </div> <!-- end "container" -->

    <div class="container">
      <p style="display: block; font-size: 11px; color: #999;">
        <div class="footer" align="center">
          <img src="https://www.washington.edu/home/graphics/blockw.gif" width="53" height="37" alt="UW Logo"></a>
          <br>
        </div>
      </p>
    </div>

  </div><!-- close class="wrapper" -->

<script type="text/javascript">
  function verifySubmit() {

    // check if number already exists in DB

    var val = document.getElementById('input_text_field').value;
    var n = parseInt(val);
    if (n < 0) {
      alert('no table values less than 0 accepted.');
      return false;
    }

    return true;
  }
</script>

<!--
    <?php foreach (StudentModel::getSubSubjects($idNo) as $ss) { ?>
      var opt = document.createElement("option");
      document.getElementById("sub_subj_DD").appendChild(opt);
    <?php } ?>
-->

</body>
</html>
