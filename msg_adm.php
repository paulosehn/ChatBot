$numero = '555184052252';
$conteudo = 'Cliente Solicita Contato com Setor Administrativo! Nome =>'.$nome." Fone => ".$telefone;
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api5.megaapi.com.br/rest/sendMessage/megaapi-MA4O7PsdkDXBIQ2DyjlAKQHUCq/text');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"messageData\": {\n    \"to\": \"$numero\",\n    \"text\": \"$conteudo\"\n  }\n}");

$headers = array();
$headers[] = 'Accept: */*';
$headers[] = 'Authorization: Bearer MA4O7PsdkDXBIQ2DyjlAKQHUCq';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);