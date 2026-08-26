# Sistema de Academia — Projeto Integrador
 
Projeto integrador da turma de Programador Web, desenvolvido em **Laravel** (PHP), rodando em ambiente **Docker** (Apache + PHP 8.3 + MySQL 8).
 
O sistema é uma plataforma que conecta usuários (clientes) e profissionais de educação física, nutrição e avaliação física, permitindo:
 
- Cadastro de usuários e profissionais.
- Ficha esportiva e avaliações do usuário.
- Anúncios pagos de profissionais (destaque na busca).
- Cadastro e execução de treinos (fornecidos pela academia, pelo sistema ou por um profissional).
- Busca, contratação e avaliação de profissionais.
Cada aluno da turma é responsável por um módulo do sistema, desenvolvido em sua própria branch e integrado via Pull Request na branch `develop`.
 
## Estrutura do repositório
 
```
projeto-academia/
├── docker-compose.yml       # orquestra os containers (app + banco)
├── Dockerfile                # imagem PHP + Apache com as extensões do Laravel
├── apache/
│   └── 000-default.conf      # configuração do VirtualHost do Apache
└── src/                       # código-fonte do Laravel
```
 
## Tecnologias
 
- PHP 8.3 + Laravel
- Apache (servidor web)
- MySQL 8.0
- Docker / Docker Compose
---
 
## Como clonar e subir o projeto (passo a passo)
 
### Pré-requisitos
 
Antes de começar, você precisa ter instalado na sua máquina:
 
- **Docker Desktop** (Windows/Mac) ou `docker` + `docker compose` (Linux)
- **Git**
Não é necessário instalar PHP, Composer ou MySQL na máquina — tudo roda dentro dos containers.
 
> **Usuários de Windows:** recomenda-se usar o **WSL2** (terminal Linux integrado ao Windows) para rodar os comandos abaixo, evitando problemas de permissão de arquivo.
 
### 1. Clonar o repositório
 
```bash
git clone https://github.com/Jricardossilva/projeto-academia.git
cd projeto-academia
```
 
### 2. Mudar para a branch develop
 
Todo o trabalho da turma acontece a partir da branch `develop` (a `main` só recebe código já revisado e pronto).
 
```bash
git checkout develop
git pull origin develop
```
 
### 3. Buildar a imagem Docker
 
Este comando lê o `Dockerfile` e monta a imagem com PHP, Apache e as extensões necessárias para o Laravel funcionar.
 
```bash
docker compose build
```
 
Isso pode levar alguns minutos na primeira vez.
 
### 4. Subir os containers
 
```bash
docker compose up -d
```
 
O `-d` faz os containers rodarem em segundo plano (você continua usando o terminal normalmente).
 
**Conferir se subiu certo:**
```bash
docker compose ps
```
Você deve ver dois containers com status `Up`:
- `academia_app` (PHP + Apache)
- `academia_db` (MySQL)
### 5. Instalar as dependências do Laravel
 
```bash
docker compose exec app composer install
```
 
Esse comando roda o Composer **dentro do container**, então não é preciso ter Composer instalado na máquina.
 
### 6. Configurar o arquivo `.env`
 
```bash
cp src/.env.example src/.env
```
 
Abra o arquivo `src/.env` no seu editor de código e confira/ajuste estas linhas:
 
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=academia
DB_USERNAME=academia
DB_PASSWORD=academia
```
 
> **Por que `DB_HOST=db` e não `localhost`?** Porque dentro da rede do Docker, o container `app` enxerga o banco pelo nome do serviço definido no `docker-compose.yml` (`db`), não pelo endereço da sua máquina.
 
### 7. Gerar a chave da aplicação
 
```bash
docker compose exec app php artisan key:generate
```
 
### 8. Rodar as migrations (criar as tabelas no banco)
 
```bash
docker compose exec app php artisan migrate
```
 
### 9. Acessar a aplicação
 
Abra no navegador: **[http://localhost:8000](http://localhost:8000)**
 
Se aparecer a tela padrão do Laravel, o ambiente está funcionando corretamente.
 
### 10. Criar sua branch de trabalho
 
Antes de começar a desenvolver sua tarefa, crie uma branch própria a partir da `develop`:
 
```bash
git checkout -b feature/nome-do-modulo-seunome
```
 
Exemplos:
```bash
git checkout -b feature/exercicios-martinho
git checkout -b feature/usuarios-rafael
git checkout -b feature/profissionais-adrian
git checkout -b feature/fichas-esportivas-isaque
```
 
---
 
## Comandos do dia a dia
 
Todos os comandos do Laravel/Composer rodam **dentro do container**, nunca direto na máquina:
 
| Ação | Comando |
|---|---|
| Subir o ambiente | `docker compose up -d` |
| Parar o ambiente | `docker compose down` |
| Ver logs da aplicação | `docker compose logs -f app` |
| Criar uma migration | `docker compose exec app php artisan make:migration create_xxx_table` |
| Rodar as migrations | `docker compose exec app php artisan migrate` |
| Criar um model | `docker compose exec app php artisan make:model Xxx` |
| Criar um controller | `docker compose exec app php artisan make:controller XxxController` |
| Rodar o composer | `docker compose exec app composer <comando>` |
| Acessar o MySQL via terminal | `docker compose exec db mysql -u academia -p academia` (senha: `academia`) |
| Entrar no shell do container | `docker compose exec app bash` |
 
## Fluxo de trabalho (Git)
 
1. Sempre trabalhe na sua branch (`feature/seu-modulo-seunome`), nunca direto em `main` ou `develop`.
2. Ao terminar uma tarefa:
```bash
   git add .
   git commit -m "Descrição do que foi feito"
   git push -u origin feature/seu-modulo-seunome
```
3. Abra um **Pull Request** no GitHub apontando para a branch `develop`.
4. Aguarde a revisão do professor antes do merge.
## Observações
 
- A porta do MySQL no host é `3307` (evita conflito com um MySQL local já instalado na máquina do aluno). Isso **não** afeta o `.env` do Laravel, que usa a porta interna `3306` (`DB_HOST=db`, `DB_PORT=3306`).
- Os dados do banco ficam salvos no volume `db_data`. Rodar `docker compose down` não apaga o banco; `docker compose down -v` apaga.
- Se a porta 8000 já estiver em uso na sua máquina, altere para `"8001:80"` no `docker-compose.yml`.
- **Não crie foreign keys nas migrations.** Os relacionamentos entre tabelas devem ser feitos apenas nos Models (`belongsTo`, `hasMany`, etc.).
