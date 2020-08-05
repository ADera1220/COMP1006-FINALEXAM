<?php require_once('header.php') ?>
<body>
<div class="container">
<?php require_once('navigation.php'); ?>
<h1>Welcome to Cricket Social!</h1>
<h2>Let's get you signed Up!</h2>
<h4>CREATE YOUR ACCOUNT!</h4>
<form action="save-registration.php" method="post" enctype='multipart/form-data'>
    <div class="form-group">
        <label for="username"> Enter A Username </label>
        <input type="text" name="username" class="form-control" id="username">
    </div>
    <div class="form-group">
        <label for="password"> Enter a Password </label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="form-group">
        <label for="confirm"> Confirm Your Password </label>
        <input type="password" name="confirm" class="form-control" id="confirm">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-dark" name="submit" value="Register">
    </div>
</form>
<?php require_once('footer.php') ?>