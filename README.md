<div style="background-color: #F8F8FF; color: rgb(28 31 36); padding: 15px; border-radius: 15px;">
  <div style="padding: 15px; text-align: center; border-bottom: 1px solid #A9A9A9">
    <p>
      <a href="https://www.soffia.co/" alt="Logo da empresa Soffia" target="_blank">
        <img src="https://www.soffia.co/assets/logo.svg">
      </a>
    </p>
  </div>

  <section style="text-align: center;">
    <h2>Sobre</h2>
    <p>Esta API REST foi desenvolvida como resposta ao desafio proposto pela <a href="https://www.soffia.co/">Soffia</a>. Sua principal função é gerenciar o fluxo de postagens. Cada postagem deve conter um título, um autor, o conteúdo da postagem e uma ou mais tags.</p>
  </section>
</div>

## Pré-requisitos
[PHP](https://www.php.net/docs.php) >= 8.1.2<br>
[Composer](https://getcomposer.org/) >= 2.7.2<br>
[MySQL](https://www.mysql.com/) >= 8.0<br>

## Instalação do projeto

### **1** - Clonagem do repositório
```bash
git clone https://github.com/arthurrocha-dev/pa-desafio-back-end.git
```

### **2** - Criar as variáveis de ambiente
```bash
cp .env.example .env
```

Em seguida, no arquivo .env, configure as variáveis de ambiente de acordo com suas informações, conforme o exemplo abaixo:

```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### **3** - Download das dependências
```bash
composer install
```

### **4** - Gerar chave da aplicação
```bash
php artisan key:generate
```

### **5** -  Execução das "migrations"
```bash
php artisan migrate
```

### **6** - Geração da documentação Swagger
```bash
php artisan l5-swagger:generate
```

### *7** - Inicialização do servidor em ambiente local
```bash
php artisan serve
```

## CI/CD
Este projeto utiliza o GitHub Actions para realizar a integração e deploy automáticos no Heroku. Para fazer isso, basta realizar um push para a branch main.

## Acesso a documentação da API
Para realizar testes manuais na API, você pode utilizar um "Client API" como o Insomnia ou acessar a documentação da API no Swagger. Para isso, estando com o servidor em execução, acesse em seu navegador a URL desafio-soffia-backend.arthurrocha.dev.br/api/documentation.

## Autor
<img src="https://avatars.githubusercontent.com/u/94405748?s=400&u=e322404a295ecdf9311fec369f6b97964a6c7527&v=4" width="150"><br><sub>@arthurrocha-dev</sub>