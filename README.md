<p align="center"><img src="https://raw.githubusercontent.com/L-ivel96/crud_api_laravel/master/public/img/img_readme_1.jpg" width="400"></p>

# Introdução
Esta é uma aplicação CRUD de cadastro de cliente e produto, que possui seus métodos em rotas disponibilizadas via API, mas é possivel acessar também por rotas web (possui views para isso).
No quadro do Trello tem as futuras implementações e melhorias deste projeto (Link na seção Links de apoio). as branchs são nomeadas conforme o numero dos chamados (disponivel no trello), é possivel acompanhar o que já foi concluído na coluna "Finalizado"

# Sumário
    1. Informações do sistema
    2. links de apoio
    3. API
    4. Como instalar o projeto

# Informações do sistema
  - Laravel Framework 7.11.0
  - PHP 7.3
  - Apache 2.4
  - MySQL 5.7
  - Bootstrap 4.3
  - JQuery 3.5
  - fontawesome v5.8.1


# links de apoio
Links de documentações e materiais de apoio

  - [Quadro do Trello](https://trello.com/b/IdYj8BoI/crud-laravel)
  - [documentação Laravel](https://laravel.com/docs/7.x)
  - [documentação Jquery](https://api.jquery.com/category/version/3.5/)
  - [documentação Jquery - W3Schools](https://www.w3schools.com/jquERy/default.asp)
  - [documentação Bootstrap](https://getbootstrap.com/docs/4.0/getting-started/introduction/)
  - [Icones Fontawesome](https://fontawesome.com/v5.9/icons)
  - [Sweet Alert](https://sweetalert.js.org/guides/)


# API
**TOKEN** 
<p>Na versão atual, está com uma chave fixa que se baseia em: <br/>
"senha_api@" . Carbon::today()<br/>
<b>OBS:</b> não contém aspas duplas (") na senha, é a concatenação de __senha_api@__ + Carbon::today()
</p><br/>

**AUTENTICAÇÃO JWT**
<p>As rotas com autenticação JWT possuem apenas o caminho "v2" que deve ser posto depois de "api/", exemplo:<br>
<b>Sem Autenticação JWT (S/A):</b> /api/listar_cliente<br>
<b>Com Autenticação JWT (S/A):</b> /api/v2/listar_cliente<br>
<p/>

**Utilizando o Postaman**
Para requisições você pode utilizar o [POSTMAN](https://www.postman.com/downloads/), neste repositório há um pacote do postman com todas as requisições e parametros já configurados, para utilizar, você deve apenas importar o arquivo que está em "postman/crud_laravel.postman_collection.json"
<br><b>OBS:</b> Para adicionar o token JWT, você deve selecionar a aba "Authorization" da requisiçaõ do postman, escolher o type "Barrer token" e add o token no campo de texto 

**Rota de registro**
Para facilitar o uso do JWT, foi disponibilizado a rota "/api/registrar", para que você posso cadastrar um usuário e já receber o token JWT [ ATENÇÃO EM UM AMBIENTE REAL NÃO SE UTILIZA ISSO, APENAS PARA FACILITAR USO E PARA FINS DE DEMONSTRAÇÃO OU DIDATICOS ]

<br><b>Nota:</b> As rotas estarão todas demonstradas sem autenticação JWT, para testar com ela, apenas siga a instrução acima "AUTENTICAÇÃO JWT"<br>
## Clientes
### **Listar**
```
rota: "/api/listar_cliente"
Método:<b> POST
Parametros: {
    token: "df39b97475c3b09b1724a74a36ca7034" [ STRING ]
}
```

### **Cadastrar**
```
rota: "/api/cadastrar_cliente"
Método: POST
Parametros: {
    token: "df39b97475c3b09b1724a74a36ca7034" [ STRING ]
    cpf_cnpj: "123456789" [STRING]
    nome: "Nome Teste" [STRING]
}
```

### **Editar**
```
rota: "/api/editar_cliente"
Método: POST
Parametros: {
    token: "df39b97475c3b09b1724a74a36ca7034" [ STRING ]
    cpf_cnpj: "9999999999" [ STRING ]
    nome: "Nome Teste 2" [ STRING ]
}
```

### **Excluir**
```
rota: "/api/excluir_cliente"
Método: POST
Parametros: {
    token: "df39b97475c3b09b1724a74a36ca7034" [ STRING ]
    id: 1 [ INTEGER ]
}
```

## Produtos
### **Listar**
```
rota: "/api/listar_produto"
Método: POST
Parametros: {
    token: "df39b97475c3b09b1724a74a36ca7034" [ STRING ]
}
```

### **Cadastrar**
```
rota: "/api/cadastrar_produto"
Método: POST
Parametros: {
    token: "df39b97475c3b09b1724a74a36ca7034" [ STRING ]
    produto: "Calça" [ STRING ]
    descricao: "Calça para inverno" [ STRING ]
    valor: 250.46 [ FLOAT ]
}
```

### **Editar**
```
rota: "/api/editar_produto"
Método: POST
Parametros: {
    token: "df39b97475c3b09b1724a74a36ca7034" [ STRING ]
    produto: "Calça" [ STRING ]
    descricao: "Calça para inverno" [ STRING ]
    valor: 250.46 [ FLOAT ]
    id: 1 [ INTEGER ]
}
```

### **Excluir**
```
rota: "/api/excluir_produto"
Método: POST
Parametros: {
    token: "df39b97475c3b09b1724a74a36ca7034" [ STRING ]
    id: 1 [ INTEGER ]
}
```

# Como instalar o projeto

Este guia de instalação não utilizará Docker, para poder configurar o ambiente sugiro o uso do [WAMP](https://www.wampserver.com/en/) / [LAMP](https://rockcontent.com/br/blog/lamp/) / [MAMP](https://www.mamp.info/en/mac/) (dependendo do seu sistema operacional, se estiver usando Windows, de uma olhada no [Laragon](https://laragon.org/) )

Você também precisará instalar:
  - git
  - git bash (Se utilizar Windows)
  - composer

## 1. Baixar dependencias
Você deve realizar a clonagem do projeto execute o seguinte comando:
```
git clone https://github.com/L-ivel96/crud_api_laravel.git
```

Na raiz do projeto, execute o seguinte comando no terminal:
```
composer install
```

## 2. Configurar arquivo .env
1. Você deve criar o banco de dados local.
2. copiar o arquivo env.example, colar na raiz do projeto e renomear para .env
3. no arquivo .env configurar variáveis de banco de dados:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

## 3. Gerar APP_KEY do .env
Na raiz do projeto, execute o seguinte comando no terminal:
```
php artisan key:generate
```

## 4. Configurar virtual Host

**Nota:** estou chamando meu projeto de "api.test" para o virtual host.

**NO Windows**, você deve ir até a pasta { caminho do seu PC }\System32\drivers\etc, no arquivo "hosts" Add linha:
```
127.0.0.1      api.test
```

Você deve localizar o arquivo de virtual host do apache e add as seguintes configurações:
```
# API
<VirtualHost *:80> 
    DocumentRoot "< caminho do projeto>/public/"
    ServerName api.test
    ServerAlias *.api.test
    <Directory "< caminho do projeto>/public/">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Caso queira configurar para acessar com HTTPS
```
# API
<VirtualHost *:443> 
    DocumentRoot "<caminho>/api_laravel_vuejs/api/public/"
    ServerName api.test
    ServerAlias *.api.test
    <Directory "<caminho>/api_laravel_vuejs/api/public/">
        AllowOverride All
        Require all granted
    </Directory>
    SSLEngine on
    SSLCertificateFile      < caminho da chave>/chave.crt
    SSLCertificateKeyFile   < caminho da chave>/chave.key
</VirtualHost>
```

## 5. Populando o banco de dados
Na raiz do projeto, execute o seguinte comando no terminal:
```
php artisan migrate
```

## 6. Populando tabelas do banco de dados (Opcional)
Caso queira iniciar a aplicação já com alguns dados de exemplo, Na raiz do projeto, execute o seguinte comando no terminal:
```
php artisan db:seed
```

## Author: 
**Levi Siqueira**: @L-ivel96 (https://github.com/L-ivel96/)

