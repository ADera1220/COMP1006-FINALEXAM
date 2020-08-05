<?php require_once('header.php'); ?>
<main class="container login">
<?php require_once('navigation.php'); ?>
    <h1> Log in! </h1>
    <form action="validate.php" method="post">
        <fieldset>
            <label for="username"> Please Enter Your Username </label>
            <input type="text" name="username" id="username" class="form-control">
        </fieldset>
        <fieldset>
            <label for="password"> Please Enter Your Password </label>
            <input type="password" name="password" id="password" class="form-control">
        </fieldset>
        <input type="submit" value="Log In!" name="submit">
    </form>
    <a href="register.php"> Not a Member? Sign up NOW! </a>
</main>
<?php require_once('footer.php'); ?>