
<div style="background-color: #F8F8FF; color: rgb(28 31 36); padding: 15px; border-radius: 15px;">
  <div style="padding: 15px; text-align: center; border-bottom: 1px solid #A9A9A9">
    <p>
      <a href="https://www.soffia.co/" alt="Logo da empresa Soffia" target="_blank">
        <img src="https://www.soffia.co/assets/logo.svg">
      </a>
    </p>
  </div>

  <section style= "text-align: center;">
    <h2>Sobre</h2>
    <p>Esta API REST Foi desenvolvida, como resposta ao desafio proposto pela <a href="https://www.soffia.co/">Soffia</a>. Onde sua principal função é gerenciar o fluxo de postagens, cada postagem deve conter um título, um autor, o conteúdo da postagens e uma ou mais tags.</p>
    </ul>
  </section>
</div>


## Pré-resquisitos
[PHP](https://www.php.net/docs.php) >= 8.1.2<br>
[Composes](https://getcomposer.org/) >= 2.7.2<br>
[MySql](https://www.mysql.com/) >= 8.0<br>

## Instalação do projeto

### **1** - Clonagem do repositório

```bash
$ git clone https://github.com/arthurrocha-dev/pa-desafio-back-end.git
```

### **2** - Criar as variâveis ambiente
Na pasta do projeto execute o seguinte comando.

```bash
$ cp .env.example .env
```

Em seguida, no arquivo .env configure as variâveis de ambiente de acordo com asuas informações, conforme o exemplo abaixo.

```env
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
### **3** - Download das dependencias

```bash
$ composer install
```

### **3** - Gerar chave da aplicação

```bash
$ php artisan key:generate
```

### **4** - Execução das "migrations"

```bash
$ php artisan migrate
```
### **5** - Geração da Documetação Swagger
```bash
php artisan l5-swagger:generate 
```

### **5** - Inicialização do servidor em ambinte local
```bash
php artisan server 
```

## Acessar a API

Pra a realização do de teste manuais na API, você pode utilizar um "Client API", como o [Insominia](https://insomnia.rest/download), ou pode acessar adocumentação da API no Swagger. Para isso basta, estando com o servidor em estado de execução, acessar em seu navegador a URL http://127.0.0.1:8000/api/documentation

## Autor

| [<img src="https://avatars.githubusercontent.com/u/94405748?s=400&u=e322404a295ecdf9311fec369f6b97964a6c7527&v=4" width="150"><br><sub>@arthurrocha-dev</sub>](https://github.com/arthurrocha-dev) |
| :---: |