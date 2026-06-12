# Mamute Store

Aplicação web em Laravel para gestão de lojas e produtos, desenvolvida para o teste técnico prático da Mamute Africano.

## Tecnologias

- PHP 8.3+
- Laravel 12
- MySQL
- Laravel Breeze
- Laravel Blade
- Tailwind CSS
- Eloquent ORM
- Migrations
- Form Requests
- Policies
- Factories e Seeders
- PHPUnit

## Pré-requisitos

- PHP 8.3 ou superior
- Composer
- Node.js e npm
- MySQL

## Instalação

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

## Ambiente de desenvolvimento

Copie o ficheiro `.env.example` para `.env` e configure as variáveis necessárias.

Configure a ligação MySQL:

```env
APP_NAME="Mamute Store"
APP_LOCALE=pt
APP_FAKER_LOCALE=pt_PT

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mamute_store
DB_USERNAME=seu_utilizador
DB_PASSWORD=sua_senha

FILESYSTEM_DISK=public

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=0e2735df175e3b
MAIL_PASSWORD=aa675dac448dbb
MAIL_ENCRYPTION=null
```

Crie a base de dados antes de executar as migrations:

```sql
CREATE DATABASE mamute_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## Base de dados

Recriar e popular a base de dados:

```bash
php artisan migrate:fresh --seed
```

Executar apenas migrations e seeders:

```bash
php artisan migrate --seed
```

O seeder cria:

- 3 utilizadores
- 10 lojas
- 100 produtos

Utilizador aleatório pra teste:

```text
Email: test@example.com
Senha: password
```

## Upload de imagens

Crie o link público do storage:

```bash
php artisan storage:link
```

As fotos dos produtos são armazenadas em `storage/app/public/products`.

## Servidor de desenvolvimento

Em terminais separados:

```bash
php artisan serve
npm run dev
```

Ou use o script do Laravel:

```bash
composer run dev
```

## Testes

```bash
php artisan test
```

## Build frontend

```bash
npm run build
```

## Funcionalidades

- Autenticação com registo, login e logout
- CRUD de lojas
- CRUD de produtos
- Upload opcional de foto do produto
- Filtros combinados na listagem de produtos
- Dashboard com total de lojas, total de produtos e valor total do stock
- Mensagens de feedback para criação, actualização, eliminação e validações
- Autorização por Policies para proteger dados de cada utilizador

## Decisões técnicas

- Laravel Breeze foi usado para autenticação por ser simples, leve e adequado ao escopo do teste.
- Blade foi usado no frontend para manter o projecto directo e aderente às convenções Laravel.
- Tailwind CSS foi usado para a interface por já integrar bem com Breeze.
- MySQL foi escolhido como base de dados relacional.
- Form Requests concentram as validações de lojas, produtos, perfil e login.
- Policies garantem que utilizadores só podem gerir os próprios registos.
- Queries de produtos usam eager loading com `with('store')` para evitar N+1 na listagem.
- Mailtrap foi utilizado para simular o envio de emails em ambiente de desenvolvimento, especialmente no fluxo de recuperação de palavra-passe, evitando o envio de emails para utilizadores reais.