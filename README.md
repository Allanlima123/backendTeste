# Como Configurar e Rodar o Projeto com XAMPP e PHP

## Requisitos

Antes de começar, certifique-se de ter os seguintes itens instalados no seu sistema:
- **XAMPP**: Inclui o Apache, MySQL e PHP.
- **Navegador Web**: Para testar o projeto.

## Instalação do XAMPP

1. **Baixe o XAMPP:**
   - Acesse o site oficial: [https://www.apachefriends.org](https://www.apachefriends.org).
   - Escolha a versão compatível com o seu sistema operacional (Windows, macOS ou Linux).

2. **Instale o XAMPP:**
   - Execute o instalador baixado.
   - Siga as instruções do assistente de instalação. Certifique-se de selecionar os componentes Apache, MySQL e PHP.

3. **Inicie o XAMPP:**
   - Abra o "XAMPP Control Panel".
   - Inicie os serviços **Apache** e **MySQL** clicando em "Start".

## Configurando o Ambiente do Projeto

1. Clone ou copie o projeto para o diretório htdocs:

Acesse a pasta do XAMPP:

- Windows: C:\xampp\htdocs\

- Linux/macOS: /opt/lampp/htdocs/

- Execute o comando abaixo no terminal para clonar o repositório diretamente dentro de htdocs:

**git clone <URL_DO_REPOSITORIO>**

- O projeto será clonado, por exemplo, em C:\xampp\htdocs\<nome-do-projeto>.

2. **Configuração do banco de dados (MySQL):** 
   - Acesse o MySQL DownLoad em: https://dev.mysql.com/downloads/installer/.
   - Crie um banco de dados:
     - Abra um novo SQLFile ou "File -> New Query Tab".
     - Insira o nome do banco de dados (ex.: `create database meu_banco`) e clique no Raio acima na página

   - Usar o banco de dados criado
   
      - USE meu_banco;

   - Insira o nome da tabela do banco de dados e clique no Raio acima na página
   
      - ex.:
     
         CREATE TABLE users (
             id INT AUTO_INCREMENT PRIMARY KEY,
             name VARCHAR(255) NOT NULL,
             email VARCHAR(255) UNIQUE NOT NULL,
             password VARCHAR(255) NOT NULL
         );

## Rodando o Projeto

1. **Acesse o projeto no navegador:**
   - Abra o navegador e digite o endereço:
     ```
     http://localhost/
     ```

2. **Configuração adicional (se necessário):**
   - Verifique se o arquivo `db.php` (ou equivalente) contém as configurações corretas para o banco de dados:
     ```php
     <?php
     $host = 'localhost';
     $db = 'meu_banco';
     $user = 'root';
     $password = '';
     $conn = new mysqli($host, $user, $password, $db);

     if ($conn->connect_error) {
         die('Conexão falhou: ' . $conn->connect_error);
     }
     ?>
     ```

3. **Testar as funcionalidades:**
   - Verifique se o projeto está rodando corretamente e faça testes básicos, como acessar páginas ou realizar operações no banco de dados.

## Recursos Adicionais

- **URLS REQUISIÇÕES:**
   **POST:** [http://localhost/backendTeste/crud_user/create.php]
   **GET:** [http://localhost/backendTeste/crud_user/get.php]
   **DELETE:** [http://localhost/backendTeste/crud_user/delete.php]
   **PUT:** [http://localhost/backendTeste/crud_user/update.php]

- **Documentação do PHP:** [https://www.php.net/docs.php](https://www.php.net/docs.php)
- **Documentação do MySQL:** [https://dev.mysql.com/doc/](https://dev.mysql.com/doc/)
- **Tutoriais do XAMPP:** [https://www.apachefriends.org/docs.html](https://www.apachefriends.org/docs.html)

---

Se encontrar problemas, consulte a seção de ajuda do XAMPP ou revise as etapas para garantir que tudo foi configurado corretamente.

