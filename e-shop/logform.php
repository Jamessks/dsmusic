<?php
echo '
<body>
  <div class="main">
      <div class="one">
        <div class="register">
          <h3>Login</h3>
          <form id="reg-form" action="login.php" method="POST">



            <div>
              <label for="username">Username</label>
              <input type="text" id="username" name="username" placeholder="username" />
            </div>
            <div>
              <label for="password">Password</label>
              <input type="password" id="password" name="password" placeholder="password" />
            </div>

            <div>
              <label></label>
              <input type="submit" value="Login" id="create-account" class="button"/>
            </div>
          </form>
           <div class="sep">
            <span class="or">OR</span>
          </div>
          <div class="connect">
            <form action="http://steiakakis.students.acg.edu/coursework/regform.php">
            <input type="submit" class="button" value="Create a new account">
          </form>
        </div>
        </div>
      </div>
      </div>

      </body>';
