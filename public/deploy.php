<?php



class composerAutoExecute {
		private $terminal;
		private $hasComposerPhar;
		private $characterForLine = 70;

		public function __construct(){

			if(file_exists('composer.phar')){
				$this->setHasComposerPhar(true);
			}else{
				$this->setHasComposerPhar(false);
			}
			$this->process();
		}

		public function process(){

			if(php_sapi_name() != "cli") {
		       $this->setTerminal(false);
		    }else{
		    	header('Content-Type:text/plain');
		    	$this->setTerminal(true);
		    }


			putenv("COMPOSER_HOME=".getcwd());
			if($this->getTerminal()==false){
				echo "
				<style>
					body{ background: #181C20;	text-align: center; padding-top: 30px; }
					*{font-family: monospace; color: #FFF; font-weight: 100; font-size: 14px; }
					.y{ color: #9acd32;}
					.n{ color: #a52a2a;}
				</style><img width='150' src='default/assets/images/load-dwphp.gif'/><br/><br/>"."\n";
			}

			if($this->getHasComposerPhar()==false){
				if(!file_exists(PATH_ROOT."/storage/composer/composer.phar")){

					$this->directoryComposer();

					//exibe mensagem de prepado
					$message	=	"Preparando o download do composer.phar ";
					$this->showMensage($message);

					//inicia o donwload
					$this->downloadComposer();

					if(file_exists(PATH_ROOT."/storage/composer/composer.phar")){
						$this->showMensage(str_pad("> OK", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
					}else{
						$this->showMensage(str_pad("> ERRO", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
					}
				}else{
					$message	=	"Conferindo arquivo composer.phar ";
					$this->showMensage($message);
					$this->showMensage(str_pad("> OK", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
				}
			}

			if($this->getHasComposerPhar()==false){
				$message	=	"Copiando composer.phar para a raiz ";
				$this->showMensage($message);

				if(copy(PATH_ROOT."/storage/composer/composer.phar", PATH_ROOT.'/composer.phar')){
					$this->showMensage(str_pad("> OK", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
				}else{
					$this->showMensage(str_pad("> ERRO", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
				}
			}

			//executando scritp
				if(defined('ENVIRONMENT') && ENVIRONMENT!='development' && ENVIRONMENT!='testing'){
					$message = "Composer definido como '--no-dev' para staging/production";
				}else{
					$message = "Composer definido como 'dev' para development/testing";
				}
				$this->showMensage($message);
				$this->showMensage(str_pad("> OK", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));

				//executando composer install ou update
				$message = (file_exists('vendor')? "Aguarde atualização de dependências Composer ": "Aguarde instalação de dependências Composer ");
				$this->showMensage($message);
				if(defined('ENVIRONMENT') && ENVIRONMENT!='development' && ENVIRONMENT!='testing'){
					$this->executar("php composer.phar update --no-dev ".($this->getTerminal()==false?'2>&1':''));
				}else{
					$this->executar("php composer.phar update ".($this->getTerminal()==false?'2>&1':''));
				}

			$this->showMensage(str_pad((file_exists('vendor')?"> OK":"> ERRO"), ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));


			$message	=	"Removendo arquivos temporários ";
			$this->showMensage($message);

			if(file_exists("cache")){ $this->executar(" rm -rf cache"); }
			if(file_exists("keys.dev.pub")){ $this->executar(" rm keys.dev.pub"); }
			if(file_exists("keys.tags.pub")){ $this->executar(" rm keys.tags.pub"); }
			if(file_exists("composer.phar")){ $this->executar(" rm composer.phar"); }

			if(!file_exists("cache") && !file_exists("keys.dev.pub") && !file_exists("keys.tags.pub") && !file_exists("composer.phar")){
				$this->showMensage(str_pad("> OK", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
			}else{
				$this->showMensage(str_pad("> ERRO", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
			}

			$message	=	"";
			for ($i=0; $i < 3; $i++) {
				$message .= '<br/>.';
			}
			$this->showMensage($message);

			if($this->getTerminal()==true){
				$message	=	"Concluído - OK";
				$this->showMensage($message,2);
			}else{
				$message	=	"<br/><br/>Aguardando redirecionamento... ";
				$this->showMensage($message,2);

				$this->showMensage("<script>location.href = './';</script>");
			}


		}
		public function downloadComposer(){
			chdir(PATH_ROOT.'/storage/composer/');
			$this->executar('php -r "readfile(\'https://getcomposer.org/installer\');" | php');
		}
		public function directoryComposer(){
			if(!file_exists(PATH_ROOT."/storage/composer/")){
				$message	=	"Criando diretório para baixar composer.phar ";
				$this->showMensage($message);
				// Criando pasta
				mkdir(PATH_ROOT."/storage/composer/", 0777, true);
				// Ferifica processo
				if(file_exists(PATH_ROOT."/storage/composer/")){
					$this->showMensage(str_pad("> OK", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
				}else{
					$this->showMensage(str_pad("> ERRO", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
				}


				// Comçando mensagem para usuário
				$message	=	"Definindo permissão de diretórios ";
				$this->showMensage($message);
				// Definindo pemissão
				chmod(PATH_ROOT."/storage/composer/", 0777);
				// Ferifica processo
				if(is_writable(PATH_ROOT."/storage/composer/")){
					$this->showMensage(str_pad("> OK", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
				}else{
					$this->showMensage(str_pad("> ERRO", ($this->getCharacterForLine() - strlen(utf8_decode($message))), ".", STR_PAD_LEFT));
				}

			}
		}

		public function setDirectory($v){
			$this->directory = $v;
		}
		public function getDirectory(){
			return $this->directory;
		}
		public function setHasComposerPhar($v){
			$this->hasComposerPhar = $v;
		}
		public function getHasComposerPhar(){
			return $this->hasComposerPhar;
		}
		public function setCharacterForLine($v){
			$this->characterForLine = $v;
		}
		public function getCharacterForLine(){
			return $this->characterForLine;
		}
		public function setTerminal($v){
			$this->terminal = $v;
		}
		public function getTerminal(){
			return $this->terminal;
		}
		public function showMensage($m,$time=0){
			if($this->getTerminal()==false){
				if($time!=0){
					sleep($time);
				}
			}
			if($this->getTerminal()==true){
				$m=str_replace("<br/>.", "\n", $m);
				if(strpos($m, "OK")!==false){
					$m = "\e[32m".$m."\e[0m \n";
				}else if(strpos($m, "ERRO")!==false){
					$m = "\e[31m".$m."\e[0m \n";
				}
			}else{
				if(strpos($m, "OK")!==false){
					$m = "<b class='y'>".$m."</b><br/><br/>";
				}else if(strpos($m, "ERRO")!==false){
					$m = "<b class='n'>".$m."</b><br/><br/>";
				}
			}
			echo $m;

			if(strpos($m, "ERRO")!==false){
				echo "<style>img{display:none}</style>"; exit();
			}

			if($this->getTerminal()==false){ob_flush();}
			if($this->getTerminal()==false){flush();}

		}
		public function executar($code=''){
			if($code!=''){
				exec($code);
			}

		}
}



if(!defined('PATH_ROOT')){
	define('PATH_ROOT', str_replace("/public","",dirname(__FILE__)));
}
chdir(PATH_ROOT);

if(isset($_GET)){
	$c=0;
	foreach ($_GET as $key => $resultado) {
		if(!empty($key) && $c==0){
			define('KEYHASH',$key);
		}else if(!empty($key) && $c==1){
			define('ENVIRONMENT',$key);
			break;
		}
		$c++;
	}
}

if(defined('KEYHASH') && KEYHASH=='5fa073f7860d74d00d451c8cd05f7c77'){
	new composerAutoExecute();
}