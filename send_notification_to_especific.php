<?PHP
	function send_to_onesignal(){
		
		$content = array(            
			"en" => 'Mensagem a ser mostrada na notificação exemplo [Nova venda] Cinco pilares da vida plena',
			
			);
		
		$fields = array(
			//Aqui passamos o APP ID do Eduzz no One Signal,
			//O eduzz já esta registrado no OneSignal e o número é exatamente este na linha a baixo.
            'app_id' => "app_id esta no documento com as especificações",
			/*
			* O atributo 'included_segments' é usado para enviar push notifications para categorias de usuários
			* "Active User" esta string é usada para para enviar um push para todos os usuários ativos
            * "Inactive Users" manda para todos os usuários inativos
			* Um usuário inativo é um usuário que não usou o aplicativo por um determinado tempo que pode ser definido no painel			
			* 'All' é usado para enviar um Push para todos os usuários
			/*'included_segments' => array('All'),
			/*
			* O atributo 'include_player_ids' é usado para enviar push notifications para usuários especificos
			* È só passar um array com todos os tokens do onesignal do usuário que se quer enviar o push
			* Logo é necessário guardar o token do OneSignal, ele será enviado na requisição de login
			* da mesma forma que é enviado o outro token
			* este é um player id qualquer, de teste só para mostrar como é feito
			*/
			'include_player_ids' => array('8663046a-8d67-410c-b885-129a6821c4c1'),
			
						
            //Este é o array com os dados enviados
            'data' => array(
				"message"   => "Nova Venda de teste para mostrar o OneSignal", 
				"sound"     => "sound6.wav",
				"soundName" => "sound6.wav",				
				"largeIcon" => "ic_launcher",
				"smallIcon" => "ic_notification",
				"color"     => "#ffcd2c"
			),
            //Aqui é possível definir o tipo de conteúdo
			'contents' => $content
		);
		/*
		* Agora é só realizar uma request no url https://onesignal.com/api/v1/notifications
		* Passando o REST APIKEY no campo Authorization como abaixo
		* esta é a REST APIKEY DO EDUZZ -> Basic YzEzMGUyYjgtOTMyNS00ZmYxLThiYjUtMWE2MmUyOWI1ODU4
		* Neste exemplo uso a função curl pra fazer a request mas pode ser feito do jeito que vcs usam.
		*/
		$fields = json_encode($fields);
		echo '<pre>';		
    	print_r("\n############### JSON SENT ###########################################:\n");
		print_r($fields);
		print_r("\n############### JSON SENT ###########################################:\n");
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
								  'Authorization: esta chave está no documento'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
		
	$return["allresponses"] = send_to_onesignal();
	$return = json_encode($return);
	
	echo '<pre>';		
	print_r("\n############### JSON RESPONSE ###########################################:\n");
	print_r($return);
	print_r("\n############### JSON RESPONSE ###########################################:\n");
?>
