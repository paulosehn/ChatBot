$array = json_decode(file_get_contents('php://input'), true);
$fromMe  = $array["key"]["fromMe"];//Mensagem recebida ou enviada (true -> Enviada / false -> Recebida)
$type    = $array["messageType"];//Tipo de mensagem recebida
//
$phoneConect    = explode("@", $array["jid"])[0];//Telefone conectado na api
$chatid         = explode("@", $array["key"]["remoteJid"])[0];//Contato cliente
$name           = $array['pushName'];// Nome Cadastrado no Fone Celular Cliente
$body           = $data['messages'][0]['body'];// o que o cliente respondeu
/**
 * Validação se é uma mensagem recebida ou enviada
 */

if($fromMe == false){
	switch ($type){
		case 'conversation'://Tipo chat
			$instance       = $array["instance_key"];//Instancia
			$body           = $array["message"]["conversation"];//Mensagem do chat
			$message = 'Ola seja bem-vindo ao nosso *Atendimento Virtual*, eu me chamo *ROBOT* e vou auxilia-lo durante sua *experiencia conosco!* - Favor Escolher Uma das Opcoes Correspondentes - \nPedido: \nFinenceiro: \nAdministrativo:';
			$time           = $array["messageTimestamp"];//Hora e data que foi enviada
			enviar_mensagem($chatid, $message);
			if(strtoupper($body) == "PEDIDO"){
				$message = 'Estamos Iniciando Seu Pedido';
				enviar_mensagem($chatid, $message);
				$message = 'Informe na ordem solicitada as seguintes orientações:';
				enviar_mensagem($chatid, $message);
				$message = 'Quatidade: \nCor: \nTamanho: \nMarca';
			    enviar_mensagem($chatid, $message);
				msg_pedido($chatid, $message);
			}
			if(strtoupper($body) == "FINANCEIRO"){
				msg_financeiro($name, $chatid);
			}
			if(strtoupper($body) == "ADMINISTRATIVO"){
				msg_adm($name, $chatid);
			}
			break;
		case 'extendedTextMessage':// Tipo chat , porem, IOA
			$instance       = $array["instance_key"];//Instancia
			$body           = $array["message"]["conversation"];//Mensagem do chat
			$message = 'Ola seja bem-vindo ao nosso *Atendimento Virtual*, eu me chamo *ROBOT* e vou auxilia-lo durante sua *experiencia conosco!* - Favor Escolher Uma das Opcoes Correspondentes - \nPedido: \nFinenceiro: \nAdministrativo:';
			$time           = $array["messageTimestamp"];//Hora e data que foi enviada
			enviar_mensagem($chatid, $message);
			if(strtoupper($body) == "PEDIDO"){
				$message = 'Estamos Iniciando Seu Pedido';
				enviar_mensagem($chatid, $message);
				$message = 'Informe na ordem solicitada as seguintes orientações:';
				enviar_mensagem($chatid, $message);
				$message = 'Quatidade: \nCor: \nTamanho: \nMarca';
			    enviar_mensagem($chatid, $message);
				msg_pedido($chatid, $message);
			}
			if(strtoupper($body) == "FINANCEIRO"){
				msg_financeiro($name, $chatid);
			}
			if(strtoupper($body) == "ADMINISTRATIVO"){
				msg_adm($name, $chatid);
			}
			$time           = $array["messageTimestamp"];//Hora e data que foi enviada
			enviar_mensagem($chatid, $message);

			break;
	}
	exit;
}
else{
	echo "From True => ".$fromMe."<br>";
}