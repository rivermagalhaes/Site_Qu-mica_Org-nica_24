<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário e remove espaços desnecessários
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $mensagem = trim($_POST['mensagem']);

    // Valida os dados do formulário
    if (empty($nome) || empty($email) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Define o destinatário e o assunto do e-mail
    $to = 'rivermagalhaes@gmail.com'; // Substitua pelo seu e-mail
    $subject = 'Novo Contato do Formulário';
    
    // Define o corpo do e-mail
    $body = "Nome: $nome\n";
    $body .= "E-mail: $email\n";
    $body .= "Mensagem:\n$mensagem\n";

    // Define os headers do e-mail
    $headers = "From: $email";

    // Envia o e-mail
    if (mail($to, $subject, $body, $headers)) {
        echo "Obrigado! Sua mensagem foi enviada com sucesso.";
    } else {
        echo "Ocorreu um erro ao enviar sua mensagem. Tente novamente mais tarde.";
    }
} else {
    echo "Método de solicitação inválido.";
}
?>

