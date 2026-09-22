# Web Service de Livros

## Nome do curso

Técnico em Informática para Internet Integrado ao Ensino Médio

## Unidade Curricular

Desenvolver Serviços Web

## Nome do aluno

Davi Salvador Schubert

## Sobre o projeto

Web service desenvolvido em PHP utilizando o Slim Framework para realizar operações CRUD com livros.

O projeto possui os métodos GET, POST, PUT e DELETE.

## Endpoints

### GET /status

Verifica o status do serviço.

**Retorno:**

```json
{
    "status": "ok"
}
```

### GET /status/xml

Retorna o status do serviço em XML.

**Retorno:**

```xml
<status>ok</status>
```

### GET /status/plain

Retorna o status do serviço em texto simples.

**Retorno:**

```text
Status: ok
```

### GET /livros/{id}

Busca um livro pelo ID.

**Exemplo:**

```text
GET /livros/1
```

**Retorno:**

```json
{
    "id": 1,
    "nome": "1984"
}
```

Caso o livro não exista:

```json
{
    "erro": "Livro não encontrado"
}
```

### POST /livros

Adiciona um novo livro.

**Exemplo de body:**

```json
{
    "nome": "Dom Casmurro"
}
```

**Retorno:**

```json
{
    "id": 4,
    "nome": "Dom Casmurro"
}
```

### PUT /livros/{id}

Atualiza o nome de um livro existente.

**Exemplo:**

```text
PUT /livros/2
```

**Body:**

```json
{
    "nome": "Dom Casmurro"
}
```

**Retorno:**

```json
{
    "id": 2,
    "nome": "Dom Casmurro"
}
```

Caso o livro não exista, retorna erro 404.

### DELETE /livros/{id}

Remove um livro pelo ID.

**Exemplo:**

```text
DELETE /livros/2
```

Se o livro existir, retorna o status `204 No Content`.

Caso o livro não exista, retorna `404`.

## Como instalar o projeto

1. Instale o PHP.
2. Instale o Composer.
3. Abra o terminal na pasta do projeto.
4. Execute:

```bash
composer install
```

5. Entre na pasta `public`:

```bash
cd public
```

6. Inicie o servidor:

```bash
php -S localhost:8080
```

## Como testar

O projeto pode ser testado utilizando o Postman ou Insomnia.

Servidor:

```text
http://localhost:8080
```

Exemplos:

```text
GET http://localhost:8080/status
GET http://localhost:8080/livros/1
POST http://localhost:8080/livros
PUT http://localhost:8080/livros/1
DELETE http://localhost:8080/livros/1
```

Para POST e PUT, enviar o body no formato JSON.

## CRUD

| Método | Endpoint       | Função          |
| ------ | -------------- | --------------- |
| GET    | `/livros/{id}` | Consultar livro |
| POST   | `/livros`      | Criar livro     |
| PUT    | `/livros/{id}` | Atualizar livro |
| DELETE | `/livros/{id}` | Excluir livro   |

<img width="1430" height="561" alt="image" src="https://github.com/user-attachments/assets/2f36caa8-68f7-43af-b44a-18b6d36b34c7" />

<img width="1448" height="779" alt="image" src="https://github.com/user-attachments/assets/a6bb5a8d-9cca-4fe1-a232-9f6efb50626f" />

