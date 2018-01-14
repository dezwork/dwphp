<?php
namespace App\Models;
use DwPhp\Symfony\Component\Yaml\Yaml;
//namespace Vendor;
	/*
		## Dezwork Digital ##
		Date Last update: 06.04.2016


		OBS: A imagem setada em setImg() não poderá ser mais apagada do servidor remoto

		#### EXEMPLO

		//iniciando objeto
			$email = new baseMail();
				//setando infomações visuais
			$email->setTitle('Confirmação de cadastro');
			$email->setText('Olá <b>Cleberson</b>, <br/> Você acabou de se cadastrar em nosso site. Obrigado!');
			$email->setImg('/assets/images/logo-da-empresa.png');
				//setando Assunto,email e nome do destinatátio
			$email->setSubject('Cadastro Dezwork');
			$email->setMailFrom('cleberson@dezwork.com');
			$email->setNameFrom('Cleberson');
				//pode visualizar o e-mail antes do envio com
			echo $email->getViewEmail(); exit;
				//para enviar o e-mail
			$envio=$mail->sendMail();
				//exibe o erro do e-mail e para o código
			if($envio==false){
				echo $email->getAllError();
			}
	*/

	class BaseMail{
		public $title; 				//titulo do e-mail
		public $text;				//texto do e-mail
		public $img;				//logo do e-mail
		public $footer;				//descrição do rodapé
		public $allError;			//Armazena os erros encontrados
		public $subject;			//Assunto do e-mail
		public $linkOnline; 		//link para visualizar online
		public $linkLogo; 			//link da imagem do logo


		//dados para envio autenticado
		public $accountSmtpServer;	//Endereço do servidor smtp
		public $accountSmtpPort;	//Porta do servidor SMTP
		public $accountMail;		//Email para autenticação
		public $accountPassword;	//Senha para autenticação
		public $accountName;		//E-mail que fará o envio
		public $mailFrom;			//E-mail que deve receber
		public $nameFrom;			//Nome do e-mail que deve receber
		public $mailCcFrom;			//E-mail que receberá em cópia
		public $nameCcFrom;			//Nome do e-mail que receberá em cópia
		public $mailBccFrom;		//E-mail que receberá em cópia oculta
		public $nameBccFrom;		//Nome do e-mail que receberá em cópia oculta

		function __construct(){
			$this->subject		=	"E-mail do Website";
			if(isset($GLOBALS['f'])){
				$this->img			=	$GLOBALS['f']->fileVersion('/assets/images/icon_mail.png');
			}
			$this->footer		=	"Esta mensagem foi enviada em ".date("d/m/Y").", às ".date("H:i:s")." pelo do website da Branvo!<br/>Caso você tenha recebido esta mensagem indevidamente, simplesmente ignore esse e-mail.";
			if(isset($GLOBALS['f'])){
				$this->linkLogo		=	$GLOBALS['f']->getPathBaseHref();
			}
		}

		//retornará true para e-mail enviado ou false para email não enviado
		public function sendMail($replyTo = '', $replyToNome = ''){

			if($this->getText()==''){
				$this->setAllError('Você deve setar setText com tem conteúdo para o e-mail');
			}
			if($this->getTitle()==''){
				$this->setAllError('Você deve setar setTitle com um título para o e-mail');
			}
			if($this->getSubject()==''){
				$this->setAllError('Você deve setar getSubject com o assunto do e-mail');
			}

			if(
				($this->getAccountSmtpServer()!='') ||
				($this->getAccountSmtpPort()!='') ||
				($this->getAccountMail()!='') ||
				($this->getAccountPassword()!='') ||
				($this->getAccountName()!='') ||
				($this->getMailFrom()!='') ||
				($this->getNameFrom()!='')
			){
				$this->setConfigsByYml();
			}


			$mailer = new \PHPMailer();


			$mailer->IsSMTP(1);
			$mailer->SMTPDebug = 0;
			$mailer->Port = $this->getAccountSmtpPort();
			$mailer->Host = $this->getAccountSmtpServer();
			$mailer->SMTPAuth = true;
			$mailer->Username = $this->getAccountMail();
			$mailer->Password = $this->getAccountPassword();
			$mailer->FromName = $this->getAccountName();
			$mailer->From = $this->getMailFrom();
			$mailer->AddAddress($this->getMailFrom(), $this->getNameFrom());

			if($this->getMailCcFrom()!=''){
				$mailer->AddCC($this->getMailCcFrom(),$this->getNameCcFrom()); // Cópia
			}
			if($this->getMailBccFrom()!=''){
				$mailer->AddBCC($this->getMailBccFrom(),$this->getNameBccFrom()); // Cópia Oculta
			}

			$mailer->IsHTML(true);
			$mailer->Subject = ($this->getSubject());
			$mailer->Body = ($this->getViewEmail());

			if($mailer->smtpConnect()){
				if($mailer->Send()){
					return true;
				}else{
					return false;
				}
			    $mailer->smtpClose();
			}

		//	//$mailer->ClearAllRecipients();

		//	if(isset($enviado)){
		//		return true;
		//	}else{
		//		$this->setAllError($mailer->ErrorInfo);
		//		return false;
		//	}
		}

		public function setConfigsByYml(){
				if(file_exists(PATH_ROOT.'/config.yml')){
					$conf = Yaml::parse(file_get_contents(PATH_ROOT.'/config.yml'));
				}

				$conf['mail_default'] = array_map('utf8_decode', $conf['mail_default']);

				if(!empty($conf['mail_default']['account_smtp_server'])){
					$this->setAccountSmtpServer($conf['mail_default']['account_smtp_server']);
				}
				if(!empty($conf['mail_default']['account_smtp_port'])){
					$this->setAccountSmtpPort($conf['mail_default']['account_smtp_port']);
				}
				if(!empty($conf['mail_default']['account_mail'])){
					$this->setAccountMail($conf['mail_default']['account_mail']);
				}
				if(!empty($conf['mail_default']['account_password'])){
					$this->setAccountPassword($conf['mail_default']['account_password']);
				}
				if(!empty($conf['mail_default']['account_name'])){
					$this->setAccountName($conf['mail_default']['account_name']);
				}
				if(!empty($conf['mail_default']['mail_from'])){
					$this->setMailFrom($conf['mail_default']['mail_from']);
				}
				if(!empty($conf['mail_default']['name_from'])){
					$this->setNameFrom(utf8_encode($conf['mail_default']['name_from']));
				}
				if(!empty($conf['mail_default']['mail_cc_from'])){
					$this->setMailCcFrom($conf['mail_default']['mail_cc_from']);
				}
				if(!empty($conf['mail_default']['name_cc_from'])){
					$this->setNameCcFrom(utf8_encode($conf['mail_default']['name_cc_from']));
				}
				if(!empty($conf['mail_default']['mail_bcc_from'])){
					$this->setMailBccFrom($conf['mail_default']['mail_bcc_from']);
				}
				if(!empty($conf['mail_default']['name_bcc_from'])){
					$this->setNameBccFrom(utf8_encode($conf['mail_default']['name_bcc_from']));
				}
		}

		public function getViewEmail(){
			$html='<html>'."\n";
			$html.='<head>'."\n";
			$html.='	<style type="text/css">'."\n";
			$html.='		*{ font-size: 13px; color:#333333; }'."\n";
			$html.='		h2{ font-size: 15px;}'."\n";
			$html.='		body{ margin: 0px; padding: 10px 0px; font-family: Arial; background-color:#fafafa;}'."\n";
			$html.='		i{ color:#029FAC; }'."\n";
			$html.='		hr { border-top: 1px dashed #029FAC;border-bottom: 0px;}'."\n";
			$html.='		.btn { color:#FFF; background:#FF6600; padding:5px; text-decoration: none}'."\n";
			$html.='	</style>'."\n";
			$html.='	<meta http-equiv="Content-Type" content="text/html charset=iso-8859-1">'."\n";
			$html.='</head>'."\n";
			$html.='<body>'."\n";

			$html.='			<table width="700" align="center" cellspacing="0" cellpadding="0" border="0">'."\n";
		  	$html.='				<tbody>'."\n";
		  	$html.='					<tr>'."\n";
			$html.='						<td colspan="3" height="100" align="center">'."\n";
			$html.='						</td>'."\n";
			$html.='					</tr>'."\n";

			$html.='				</tbody>'."\n";
			$html.='			</table>'."\n";

			$html.='			<table width="700" align="center" cellspacing="0" cellpadding="0" border="0" style="border: 1px solid #EEEEEE;">'."\n";
			$html.='				<tbody>'."\n";
			$html.='					<tr height="70" bgcolor="#FFFFFF">'."\n";
			$html.='						<td width="40"></td>'."\n";
			$html.='						<td><p style="font-size:30px; color:#562EB4">'.$this->getTitle().'</p></td>'."\n";
			$html.='						<td align="right">'."\n";
			$html.='							<a href="'.$this->getLinkLogo().'">'."\n";
			$html.='								<img src="'.$this->getLinkLogo().'" border="0" style="margin:10px;" />'."\n";
			$html.='							</a>'."\n";
			$html.='						</td>'."\n";
			$html.='						<td width="40"></td>'."\n";
			$html.='					</tr>'."\n";
			$html.='					<tr bgcolor="#EFEFEF">'."\n";
			$html.='						<td></td>'."\n";
			$html.='						<td style="padding:55px 0px;">'."\n";
			$html.='							<p style="color: #333333; font-weigth:900; font-size:16px;">'.$this->getText().'</p>'."\n";
			$html.='						</td>'."\n";
			$html.='						<td valign="bottom" align="right" width="250px">'."\n";
			$html.='						</td>'."\n";
			$html.='						<td></td>'."\n";
			$html.='					</tr>'."\n";
			$html.='				</tbody>'."\n";
			$html.='			</table>'."\n";

			$html.=' 			<table width="700" cellspacing="0" cellpadding="0" border="0" align="center">'."\n";
			$html.=' 				<tbody>'."\n";
			$html.=' 					<tr>'."\n";
			$html.=' 						<td>'."\n";
			$html.=' 							<p style="color: #333333; margin:20px 0px; font-size:12px;">'."\n";
			if($this->getLinkOnline()!=''){
			$html.=utf8_decode('								Se estiver com problemas para visualizar acesse o histórico <a href="'.$this->getLinkOnline().'">aqui.</a><br/><br/>')."\n";
			}
			$html.=' 								'.$this->getFooter()."\n";
			$html.=' 							</p>'."\n";
			$html.=' 						</td>'."\n";
			$html.=' 					</tr>'."\n";
			$html.=' 				</tbody>'."\n";
			$html.=' 			</table>'."\n";
			$html.='	</body>'."\n";
			$html.='</html>'."\n";

			return ($html);
		}

		#### CORPO DO E-MAIL
		//get e set para imagem
		public function setImg($v=''){
			$this->img=$v;
		}
		public function getImg(){
			return $this->img;
		}
		public function setSubject($v=''){
			$this->subject=$v;
		}
		public function getSubject(){
			return $this->subject;
		}
		//get e set para title
		public function setTitle($v=''){
			$this->title=$v;
		}
		public function getTitle(){
			return $this->title;
		}
		//get e set para descrição do texto
		public function setText($v=''){
			$this->text=$v;
			return $this;
		}
		public function getText(){
			return $this->text;
		}
		public function setFooter($v=''){
			$this->footer=$v;
		}
		public function getFooter(){
			return $this->footer;
		}

		#### DADOS DO ENVIO
		//get e set para nome de quem envia o e-mail
	    public function getAccountSmtpServer(){
	        return $this->accountSmtpServer;
	    }

	    public function setAccountSmtpServer($accountSmtpServer){
	        $this->accountSmtpServer = $accountSmtpServer;

	        return $this;
	    }

	    public function getAccountSmtpPort(){
	        return $this->accountSmtpPort;
	    }

	    public function setAccountSmtpPort($accountSmtpPort){
	        $this->accountSmtpPort = $accountSmtpPort;

	        return $this;
	    }

	    public function getAccountMail(){
	        return $this->accountMail;
	    }

	    public function setAccountMail($accountMail){
	        $this->accountMail = $accountMail;

	        return $this;
	    }

	    public function getAccountPassword(){
	        return $this->accountPassword;
	    }

	    public function setAccountPassword($accountPassword){
	        $this->accountPassword = $accountPassword;

	        return $this;
	    }

	    public function getAccountName(){
	        return $this->accountName;
	    }

	    public function setAccountName($accountName){
	        $this->accountName = $accountName;

	        return $this;
	    }

	    public function getMailFrom(){
	        return $this->mailFrom;
	    }

	    public function setMailFrom($mailFrom){
	        $this->mailFrom = $mailFrom;

	        return $this;
	    }

	    public function getNameFrom(){
	        return $this->nameFrom;
	    }

	    public function setNameFrom($nameFrom){
	        $this->nameFrom = $nameFrom;

	        return $this;
	    }

	    public function getMailCcFrom(){
	        return $this->mailCcFrom;
	    }

	    public function setMailCcFrom($mailCcFrom){
	        $this->mailCcFrom = $mailCcFrom;

	        return $this;
	    }

	    public function getNameCcFrom(){
	        return $this->nameCcFrom;
	    }

	    public function setNameCcFrom($nameCcFrom){
	        $this->nameCcFrom = $nameCcFrom;

	        return $this;
	    }

	    public function getMailBccFrom(){
	        return $this->mailBccFrom;
	    }

	    public function setMailBccFrom($mailBccFrom){
	        $this->mailBccFrom = $mailBccFrom;

	        return $this;
	    }

		//get e set para link de ver online
		public function setLinkOnline($v=''){
			if(substr($v, 0, 4)!='http'){
				return false;
			}else{
				$this->linkOnline=$v;
			}
		}
		public function getLinkOnline(){
			return $this->linkOnline;
		}
		//get e set para link do logo
		public function setLinkLogo($v=''){
			if(
				substr($v, 0, 4)!='http' ||
				( 	(substr($v,-4)!='.jpg') &&
					(substr($v,-4)!='.png') &&
					(substr($v,-4)!='.gif') &&
					(substr($v,-4)!='jpeg')
				)
			){
				return false;
			}else{
				$this->linkOnline=$v;
			}
			$this->linkLogo=$v;
		}
		public function getLinkLogo(){
			return $this->linkLogo;
		}


		###ERROS
		//CONTROLE DE ALL ERROR
		public function setAllError($v=''){
			$tmp=array();
			$tmp=$this->getAllError('array');
			$tmp[]=$v;
			$this->allError=$tmp;
		}
		//RETORNA TODOS OS ERROS
		// parametro('text') - Retorna lista de erros
		// parametro('array') - Retorna tabela HTML de erros
		public function getAllError($t='text'){
			$tmp='';
			if(count($this->allError)>0){
				$tmp='<table>';
				for ($i=0; $i < count($this->allError); $i++) {
					$tmp.='<tr>';
					$tmp.='	<td width="100">#ERRO N&deg; '.($i+1).'</td>';
					$tmp.='	<td><i>'.$this->allError[$i].'</i></td>';
					$tmp.='<tr> <td colspan="2" height="15"></td></tr>';
				}
				$tmp.='</table>';
			}
			if($t=='array'){
				return $this->allError;
			}else{
				return $tmp;
			}
		}


	}