<h1>Compila il questionario 2010</h1>

<p>Dopo aver fatto clic sul pulsante qui sotto, dovrai entrare nel corso (<em>Attività generiche...</em>) e selezionare il Questionario (in alto a sinistra)</p>

<form action="http://www.mattiussilab.net/moodle/login/index.php" method="post" id="login">
<input type="hidden" name="username" id="username" size="15" value="<?php echo $sf_user->getUsername() ?>" />
<input type="hidden" name="password" id="password" size="15" value="<?php echo $sf_user->getProfile()->getFakePassword() ?>" />
<input type="submit" value="Login" />
<input type="hidden" name="testcookies" value="1" />
</form>
