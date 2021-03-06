<?php

echo <<<_END
<div class="d-flex justify-content-center align-content-center">
      <form action="login/auth" method="post" class="form-signin" onsubmit="return validate(this, '#errorMessage')"
novalidate>
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="inputRemember" value="remember-me"> Remember me
          </label>
        </div>
        <p id="errorMessage">$errorMessage</p>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
</div>
_END

?>