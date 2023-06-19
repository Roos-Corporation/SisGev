
# Sistema de Gestao de Evento
Setup Docker Laravel 10 com PHP 8.1


### Passo a passo
Clone Repositório
```sh
git clone -b https://github.com/Roos-Corporation/sisgev.git sisgev
```
```sh
cd sisgev
```


Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=sisgev
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=nome_usuario
DB_PASSWORD=senha_aqui

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```


Gere as migrations
```sh
php artisan migrate
```


Dependencia front-end
```sh
npm install
npm install vue-loader@next vue@next vue-router@next --force
npm install @vitejs/plugin-vue --force
npm install --save-dev sass
npm install @vue/compiler-sfc babel-loader @babel/core @babel/preset-env

npm run dev
```


Acesse o projeto
[http://localhost:8989](http://localhost:8989)



