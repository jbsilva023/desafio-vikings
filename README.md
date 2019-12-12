# P21 - Desafio Vikings

 **Requisitos do servidor**
 - PHP >= 7.2.25
 
 **Instalar dependências**
 - Comando de execução:<br/> _composer install_
 
 **Banco de dados SQL de script**
  - Script para criar banco de dados:<br/> _app/config/banco.sql_
  
 **Configurar conexão com o banco de dados**
 - Remova a extensão **.example** do arquivo **.env** <br/> e insira as informações do seu banco de dados:<br/>
 _DB_CONNECTION=mysql_ <br/>
 _DB_HOST=yourhost_ <br/>
 _DB_DATABASE=yourdatabasename_ <br/>
 _DB_USERNAME=yourusername_ <br/>
 _DB_PASSWORD=yourpassowrd_
 
 **Configurar envio de e-mail(s)**
 - Para testar, adicionar configurações do mailtrap: <br/>
 _MAIL_DRIVER=smtp_ <br/>
 _MAIL_HOST=smtp.mailtrap.io_<br/>
 _MAIL_PORT=2525_<br/>
 _MAIL_USERNAME=yourusername_<br/>
 _MAIL_FROM=youremail_<br/>
 _MAIL_PASSWORD=yourpassord_
 
 **Arquivos necessários**
  - <a href='https://github.com/p21sistemas/vikings/blob/master/Cart%C3%B3rios.xlsx'>Planilha excel</a> - Planilha atualizada com a lista de cartórios
  - <a href='https://github.com/p21sistemas/vikings/blob/master/Cart%C3%B3rios-CNJ.xml'>Arquivo XML</a> - Arquivo XML para importação