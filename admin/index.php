<!DOCTYPE html>
<html>
<head>
    <title>Dados CHATBOT Mega API</title>
</head>
<body>
<?php
$host = $instance_key = $token = $telefone = '';
$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = $_POST["host"];
    $instance_key = $_POST["instance_key"];
    $token = $_POST["token"];
    $telefone = $_POST["telefone"];

    if (empty($host) || (!filter_var($host, FILTER_VALIDATE_IP) && (!filter_var($host, FILTER_VALIDATE_URL) && (!filter_var("http://" . $host, FILTER_VALIDATE_URL))))) {
        $erro = "O campo Host deve ser um IP válido ou uma URL não vazia.";
    } elseif (empty($instance_key) || empty($token)) {
        $erro = "Os campos Instance Key e Token não podem estar vazios.";
    } elseif (empty($telefone)) {
        $erro = "O campo Telefone deve estar no formato +55 ddd e números, podendo conter hífens.";
    } else {
        $conteudo = "Host: $host\nInstance Key: $instance_key\nToken: $token\nTelefone: $telefone";
        file_put_contents("properties.txt", $conteudo);
        echo "Dados salvos com sucesso!";
    }
}

if (file_exists("properties.txt")) {
    $conteudo = file_get_contents("properties.txt");
    $linhas = explode("\n", $conteudo);
    foreach ($linhas as $linha) {
        list($chave, $valor) = explode(": ", $linha);
        if ($chave == "Host") {
            $host = $valor;
        } elseif ($chave == "Instance Key") {
            $instance_key = $valor;
        } elseif ($chave == "Token") {
            $token = $valor;
        } elseif ($chave == "Telefone") {
            $telefone = $valor;
        }
    }
}
?>

<h2>Dados CHATBOT Mega API</h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    Host (IP ou URL): <input type="text" name="host" value="<?php echo $host; ?>"><br><br>
    Instance Key: <input type="text" name="instance_key" value="<?php echo $instance_key; ?>"><br><br>
    Token: <input type="text" name="token" value="<?php echo $token; ?>"><br><br>
    Telefone (+55 ddd e números sem hífen ou espaços): <input type="text" name="telefone" value="<?php echo $telefone; ?>"><br><br>
    <input type="submit" name="submit" value="Salvar">
</form>

<?php
if (!empty($erro)) {
    echo "<p style='color: red;'>$erro</p>";
}
?>
</body>
</html>

