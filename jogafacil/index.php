<!DOCTYPE html>
<html>
<head>


    include_once "util/RequestRouter.php";

    echo json_encode( (new RequestRouter)->route() );

   <form action="control/UsuarioController.php" method="post">

        <input type="text" name="nome" placeholder="Nome" required>
        <input type="text" name="sobrenome" placeholder="Sobrenome" required>
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>

        <input type="submit" value="Cadastrar">
    </form>

</head>
<body>

</body>

</html>