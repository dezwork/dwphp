<?php
use PHPUnit_Framework_TestCase as PHPUnit;
//use UnitaryTests\models\BaseMail;
namespace App\Models;
use App\Models\BaseMail;

//importa arquivos do composer
require_once "start.php";

class BaseMailTest extends PHPUnit{
        public function setUp(){
                $this->objDefault = new BaseMail();

        }

        public function tearDown(){
                // executado apos cada um dos testes dessa classe
        }


        public function test_setImg(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setImg($t);
            $this->assertEquals($t, $this->objDefault->getImg());
        }


        public function test_setTitle(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setTitle($t);
            $this->assertEquals($t, $this->objDefault->getTitle());
        }


        public function test_setText(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setText($t);
            $this->assertEquals($t, $this->objDefault->getText());
        }


        public function test_setFooter(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setFooter($t);
            $this->assertEquals($t, $this->objDefault->getFooter());
        }


        public function test_setSubject(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setSubject($t);
            $this->assertEquals($t, $this->objDefault->getSubject());
        }


        public function test_setLinkOnline(){
            $t = "http://www.google.com";
            $this->objDefault->setLinkOnline($t);
            $this->assertEquals($t, $this->objDefault->getLinkOnline());
        }

        public function test_setLinkLogo(){
            $t = "https://www.branvo.com/default/assets/images/logo_top.png";
            $this->objDefault->setLinkLogo($t);
            $this->assertEquals($t, $this->objDefault->getLinkLogo());
        }

        public function test_setAllError(){
            $this->assertEmpty($this->objDefault->getAllError());
            $this->assertEmpty($this->objDefault->getAllError('array'));
        }

        public function test_setAccountSmtpServer(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setAccountSmtpServer($t);
            $this->assertEquals($t, $this->objDefault->getAccountSmtpServer());
        }

        public function test_setAccountSmtpPort(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setAccountSmtpPort($t);
            $this->assertEquals($t, $this->objDefault->getAccountSmtpPort());
        }

        public function test_setAccountMail(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setAccountMail($t);
            $this->assertEquals($t, $this->objDefault->getAccountMail());
        }

        public function test_setAccountPassword(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setAccountPassword($t);
            $this->assertEquals($t, $this->objDefault->getAccountPassword());
        }

        public function test_setAccountName(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setAccountName($t);
            $this->assertEquals($t, $this->objDefault->getAccountName());
        }

        public function test_setMailFrom(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setMailFrom($t);
            $this->assertEquals($t, $this->objDefault->getMailFrom());
        }

        public function test_setNameFrom(){
            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setNameFrom($t);
            $this->assertEquals($t, $this->objDefault->getNameFrom());
        }


        public function test_setConfigsByYml(){
            $this->assertFileExists('vendor/autoload.php');
            $this->objDefault->setAccountSmtpServer("smtp.teste.net");
            $this->objDefault->setAccountSmtpPort(123);
            $this->objDefault->setAccountMail("nome@mail.com");
            $this->objDefault->setAccountPassword("nome@mail.com");
            $this->objDefault->setAccountName("nome@mail.com");
            $this->objDefault->setMailFrom("enviarpara@mail.com");
            $this->objDefault->setNameFrom("Nome");

            $this->objDefault->setConfigsByYml();

            $this->assertNotEquals("smtp.teste.net", $this->objDefault->getAccountSmtpServer());
            $this->assertNotEquals(123, $this->objDefault->getAccountSmtpPort());
            $this->assertNotEquals("nome@mail.com", $this->objDefault->getAccountMail());
            $this->assertNotEquals("nome@mail.com", $this->objDefault->getAccountPassword());
            $this->assertNotEquals("nome@mail.com", $this->objDefault->getAccountName());
            $this->assertNotEquals("enviarpara@mail.com", $this->objDefault->getMailFrom());
            $this->assertNotEquals("Nome", $this->objDefault->getNameFrom());
        }



        public function test_sendMail(){

            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 30);
            $this->objDefault->setImg($t);


            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 15);
            $this->objDefault->setTitle($t);


            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 250);
            $this->objDefault->setText($t);

            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã     ", 5)), 0, 150);
            $this->objDefault->setFooter($t);

            $t = "cleberson@dezwork.com";
            $this->objDefault->setMailFrom($t);

            $t = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzáéíóúã.     ", 5)), 0, 10);
            $this->objDefault->setSubject($t);

            $t = "http://www.google.com";
            $this->objDefault->setLinkOnline($t);

            $t = "https://www.branvo.com/default/assets/images/logo_top.png";
            $this->objDefault->setLinkLogo($t);

            $this->objDefault->setConfigsByYml();

            $this->assertEquals(true,$this->objDefault->sendMail(), "Dados de acesso ao servidor de e-mail inválidos");
        }

}