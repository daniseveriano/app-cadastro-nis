# Sistema de Consulta e Cadastro NIS

![primeira](https://i.ibb.co/FWbMkQf/primeiro.png)

![segunda](https://i.ibb.co/RcsKtsn/segundo.png)

![terceira](https://i.ibb.co/M6SLdZz/terceiro.png)

Versões das ferramentas utilizadas para inicialização deste projeto:

- Composer 2.7.2
- WSL 2.1.5.0
- Docker 25.0.3
- Docker Compose 2.24.6
- PHP 8.1.10
- Symfony CLI 5.8.14
- Programa para acesso ao Banco de Dados (sugestão: DBeaver)
- Editor de Código (sugestão: VSCode)

## Passo 1
Clonar o repositório para uma pasta local (comando `git clone` + link do repositório);

## Passo 2
Acessar a pasta do repositório `app-cadastro-nis`;

## Passo 3
Criar um arquivo `.env` baseado nas configurações do arquivo `.env.test` existente no repositório, preenchendo as variáveis de ambiente da seguinte forma:

- POSTGRES_DB=NOME_DO_BANCO_DE_DADOS
- POSTGRES_USER=SEU_USUARIO
- POSTGRES_PASSWORD=SUA_SENHA
- DATABASE_URL="postgresql://SEU_USUARIO:SUA_SENHA@db:5432/NOME_DO_BANCO_DE_DADOS?serverVersion=16&charset=utf8"

## Passo 4
Acrescentar no final do arquivo hosts de sua máquina a seguinte linha, para obter uma URL mais amigável:<br>
`127.0.0.1      app-cadastro-nis.online`

## Passo 5
Rodar o comando `docker-compose up -d` para criação dos containers;

## Passo 6
Rodar o comando `docker-compose exec php composer install` para instalação das dependências do projeto;

## Passo 7
Acesse a aplicação em uma aba de seu navegador através do link: <br>
http://app-cadastro-nis.online <br>

ou http://localhost:80

## Passo 8
Rodar o comando `docker-compose exec php bin/console make:migration` para criar uma nova migração para o banco de dados (se este comando apresentar muitos problemas, pule para o passo 10);

## Passo 9
Rodar o comando `docker-compose exec php bin/console make:migration` para criar a migration da entidade;

## Passo 10
Acesse o seu banco de dados com as credenciais criadas neste arquivo, e coloque para rodar a query presente no arquivo `query.sql` da raiz deste repositório, a saber:
`CREATE TABLE people_registered (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    nis BIGINT NOT NULL
);`

