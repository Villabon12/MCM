<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form action="https://www.pruebas.myconnectmind.com/plantillas/wp-admin/user-new.php/create-user" method="post">
    <input name="user_login" type="text" id="user_login" placeholder="usuario" value="" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60">
    <input name="email" type="email" id="email" value="" placeholder="email">
    <input name="first_name" type="text" id="first_name" value="" placeholder="nombre">
    <input name="last_name" type="text" id="last_name" value="" placeholder="apellido">
    <input name="url" type="url" id="url" class="code" value="" placeholder="web">
    <select name="locale" id="locale"><option value="site-default" data-installed="1" selected="selected">Predeterminado del sitio</option>
    <input type="text" name="pass1" id="pass1" placeholder="contraseña" class="regular-text strong" autocomplete="new-password" data-reveal="1" data-pw="7f&amp;o6KBUdswSWNS&amp;B^l^TztH" aria-describedby="pass-strength-result">
    <input type="checkbox" name="send_user_notification" id="send_user_notification" value="1" checked="checked">
    <select name="role" id="role">
			
	<option selected="selected" value="subscriber">Suscriptor</option>
	<option value="contributor">Colaborador</option>
	<option value="author">Autor</option>
	<option value="editor">Editor</option>
	<option value="administrator">Administrador</option>			</select>
    <button type="submit">Submit</button>
    </form>
</body>
</html>