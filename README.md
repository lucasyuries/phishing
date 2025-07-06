# Simulação de Phishing: Conscientização e Logs

Este projeto educacional simula um ataque de phishing para demonstrar suas mecânicas e registrar interações de usuários (sem coletar dados sensíveis).

---

## Funcionalidades Principais

* **Simulação Visual BMG:** Uma página (HTML/CSS/JS) que imita um portal bancário do Banco BMG para coletar dados (apenas para demonstração).
* **Conscientização:** Após a interação, o usuário é redirecionado para uma página com dicas detalhadas sobre como identificar e evitar phishing.
* **Coleta de Logs (Local):** Registra o IP de acesso e o tipo de interação do usuário (abriu a página, clicou sem preencher, ou tentou preencher o formulário) em um banco de dados MySQL local. **Nenhum dado pessoal preenchido é armazenado.**

---

## Tecnologias Utilizadas

* **Frontend:**
    * **HTML5:** Estrutura das páginas web.
    * **CSS3:** Estilização para replicar o visual do Banco BMG e tornar as páginas mais atraentes.
    * **JavaScript:** Para controle da navegação, envio assíncrono dos logs e detecção do tipo de interação do usuário.
* **Backend (para Logs Locais):**
    * **PHP:** Linguagem de script do lado do servidor para processar as requisições de log.
    * **MySQL:** Sistema de gerenciamento de banco de dados para armazenar os logs de interação.
    * **XAMPP:** Ambiente de desenvolvimento local que fornece Apache (servidor web) e MySQL.

---

## Como Rodar o Projeto (Localmente)

Para que a funcionalidade de coleta de logs funcione, você precisará configurar um ambiente local com XAMPP. A simulação visual pode ser hospedada em plataformas como o Vercel.

### 1. Pré-requisitos

* **XAMPP:** Baixe e instale o XAMPP (Apache, MySQL, PHP) em sua máquina.
    * [Download XAMPP](https://www.apachefriends.org/index.html)

### 2. Configuração do Banco de Dados

1.  **Inicie o XAMPP Control Panel:** Certifique-se de que os módulos **Apache** e **MySQL** estejam "Running".
2.  **Acesse o phpMyAdmin:** Abra seu navegador e vá para `http://localhost/phpmyadmin/`.
3.  **Crie o Banco de Dados:**
    * Nomeie o banco de dados como `phishing_logs`.
    * Clique em "Criar".
4.  **Crie a Tabela `interacoes`:**
    * Selecione o banco `phishing_logs` recém-criado.
    * Na seção "Criar tabela", nomeie-a como `interacoes` com **4 colunas**.
    * Configure as colunas da seguinte forma:
        | `id`             
        | `ip_origem`      
        | `tipo_interacao`
        | `timestamp_log`  


### 3. Configuração dos Arquivos do Projeto

1.  **Clone este repositório** ou baixe os arquivos do projeto para o seu computador.
2.  **Mova a pasta do projeto:** Coloque a pasta raiz do seu projeto (ex: `phishing/`) dentro do diretório `htdocs` da sua instalação do XAMPP. Exemplo: `C:\xampp\htdocs\phishing\`.
3.  **Verifique a Logo:** Certifique-se de que o arquivo da logo do BMG (`logo-bmg.png`) esteja dentro da pasta `phishing/` (ou ajuste o `src` no `index.html` se o nome/caminho for diferente).

### 4. Executando a Simulação Localmente

1.  **Inicie Apache e MySQL no XAMPP Control Panel.**
2.  **Acesse a simulação no navegador:**
    * Vá para `http://localhost/phishing/index.html`

### 5. Visualizando os Logs

1.  Após interagir com a simulação (abrindo a página, clicando no botão, preenchendo campos), vá para `http://localhost/phpmyadmin/`.
2.  Selecione o banco `phishing_logs` e clique na tabela `interacoes`.
3.  Você verá os registros das interações (IP, tipo de interação, data/hora) sendo adicionados.

