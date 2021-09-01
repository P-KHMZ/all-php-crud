<h2>Login</h2>
<form action="login.php" method="POST">
    <p>
        <label for="email" class="label">Username</label>
        <input type="email" id="email" placeholder="enter your email" name="email" size="30" maxlength="60"
        value="<?php if(isset($_POST['email'])) echo $_POST['email']?>">
    </p>
    <p>
        <label for="pass" class="label">Credidentials</label>
        <input type="password" id="pass" placeholder="enter your password" name="pass" size="12" maxlength="12"
        value="<?php if(isset($_POST['pass'])) echo $_POST['pass']?>">
    </p>
    <span>&nbsp;Between 8 and 12 characters.</span></p><br>
    <p>&nbsp;</p><p><input id="submit" type="submit" name="submit" value="Login"></p>
</form>