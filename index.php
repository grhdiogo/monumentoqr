<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <form method="post" action="controller/loginController.php" id="formlogin" name="formlogin" >
                <fieldset id="fie">
                <input type="hidden" name="metodo" value="logar" />
                <legend>LOGIN</legend><br />
                <label>NOME : </label>
                <input type="text" name="login" id="login"  /><br />
                <label>SENHA :</label>
                <input type="password" name="senha" id="senha" /><br />
                <input type="submit" value="LOGAR  "  />
                </fieldset>
                </form>
    </body>
</html>