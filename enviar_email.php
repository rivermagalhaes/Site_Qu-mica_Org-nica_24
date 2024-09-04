if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitiza os dados do formulário
    $nome = htmlspecialchars(strip_tags(trim($_POST['nome'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $mensagem = htmlspecialchars(strip_tags(trim($_POST['mensagem'])));

    // Valida os dados
    if (empty($nome) || empty($email) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Configurações de e-mail
    $para = "rivermagalhaes@gmail.com";
    $assunto = "Nova mensagem de $nome via formulário de contato";
    
    // Corpo do e-mail
    $corpo = "Nome: $nome\n";
    $corpo .= "E-mail: $email\n\n";
    $corpo .= "Mensagem:\n$mensagem\n";

    // Cabeçalhos do e-mail
    $cabecalhos = "From: $nome <$email>\r\n";
    $cabecalhos .= "Reply-To: $email\r\n";
    $cabecalhos .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Envia o e-mail
    if (mail($para, $assunto, $corpo, $cabecalhos)) {
        echo "Sua mensagem foi enviada com sucesso!";
        echo "<script>setTimeout(function(){ window.location.reload(); }, 2000);</script>";
    } else {
        echo "Houve um erro ao enviar sua mensagem. Por favor, tente novamente mais tarde.";
        // Opcional: Exibe detalhes do erro
        // $error = error_get_last()['message'];
        // echo "Erro: $error";
    }
} else {
    echo "Método de envio inválido.";
}

