<?php
include_once 'header.php';
$fnameErr = $lnameErr = $emailErr = $username = "";
if(isset($_SESSION['logerror'])){ echo'<br><header class="">Username/email exists.</header>';
unset($_SESSION['logerror']);}

if(isset($_SESSION['usernameerror'])){
$username = "Only letters,numbers and white space allowed";
unset($_SESSION['usernameerror']);}else $username ="";

if(isset($_SESSION['firstnameerror'])){
 $fnameErr = "Only letters and white space allowed";
 unset($_SESSION['firstnamenameerror']);}else $fnameErr ="";

if(isset($_SESSION['lastnameerror'])){
 $lnameErr = "Only letters and white space allowed";
 unset($_SESSION['lastnamenameerror']);}else $lnameErrname ="";

if(isset($_SESSION['failfirstname'])) {
    $test1 = $_SESSION['failfirstname'];
}else{$test1 = "";}
if(isset($_SESSION['faillastname'])) {
    $test2 = $_SESSION['faillastname'];
}else{$test2 = "";}
if(isset($_SESSION['failemail'])) {
    $test3 = $_SESSION['failemail'];
}else{$test3 = "";}
if(isset($_SESSION['failusername'])) {
    $test4 = $_SESSION['failusername'];
}else{$test4 = "";}
 echo'<body>
 <div class="main">
      <div class="one">
        <div class="register">
          <h3>Register</h3>
          <p><span class="error">* required field.</span></p>
          <form  id="reg-form" action="registerUsers.php" method="POST">
            <div>
              <label for="name">FirstName</label>
              <input type="text" id="firstname" name="firstname" placeholder="First Name" value="' . $test1 . '" required/>
              <span class="error">*';?><?php echo $fnameErr;?><?php echo'</span>
            </div>
            <div>
              <label for="name">LastName</label>
              <input type="text" id="lastname" name="lastname" placeholder="Last name" value="' . $test2 . '" required/>
              <span class="error">*';?><?php echo $lnameErr;?><?php echo'</span>
            </div>
            <div>
              <label for="email">Email</label>
              <input type="email" id="email" name="email" onblur="validateEmail(this.value);"  placeholder="email" value="' . $test3 . '" required/>
              <span class="error">*';?><?php echo $emailErr;?><?php echo'</span>
              <span id="correct" style="display: none" class="error2">✔</span>
              <span id="wrong" style="display: none" class="error">✖</span>
            </div>
            <div>
              <label for="username">Username</label>
              <input type="text" id="username" name="username" placeholder="username" value="' . $test4 . '" required />
              <span class="error">*';?><?php echo $username;?><?php echo'</span>
            </div>
            <div>
              <label for="password">Password</label>
              <input type="password" class="password" id="password" name="password" required />
              <span class="error">*</span>
              <div class="passdiv">
            Strength:
            <div class="figure" id="pass_strength">no password</div>
                </div>
            </div>

            <div>
              <label></label>
              <input type="submit" value="Create Account" id="create-account" class="button"/>
            </div>
          </form>

        </div>
      </div>
      </div>
</body>';
if(isset($_SESSION['failfirstname'])) {
    unset($_SESSION['failfirstname']);
}
if(isset($_SESSION['faillastname'])) {
    unset($_SESSION['faillastname']);
}
if(isset($_SESSION['failusername'])) {
    unset($_SESSION['failusername']);
}
if(isset($_SESSION['failemail'])) {
    unset($_SESSION['failemail']);
}

include 'footer.php';
 ?>