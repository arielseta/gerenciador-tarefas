# Gerenciador de Tarefas

Aplicação full stack desenvolvida com Laravel (backend) e Quasar Framework (frontend), que permite gerenciar tarefas com autenticação, listagem, criação, edição, e exclusão.

## 🗂 Estrutura do Projeto

O repositório é dividido em dois diretórios principais:

```
gerenciador-tarefas/
├── app_tarefas/              # Backend (Laravel)
├── app_tarefas_frontend/     # Frontend (Quasar Framework)
```

---

## ⚙️ Requisitos

- PHP >= 8.1
- Composer
- Node.js >= 16
- NPM ou Yarn
- Laravel 12
- Quasar CLI

---

## 🚀 Como rodar o projeto

### 🔧 Backend (Laravel)

1. Acesse o diretório:

```bash
cd app_tarefas
```

2. Instale as dependências:

```bash
composer install
```

3. Copie o arquivo `.env` e configure:

```bash
cp .env.example .env
```

4. Gere a chave da aplicação:

```bash
php artisan key:generate
```

5. Execute as migrações e seeders:

```bash
php artisan migrate --seed
```

6. Inicie o servidor:

```bash
php artisan serve
```

---

### 🎨 Frontend (Quasar)

1. Acesse o diretório:

```bash
cd app_tarefas_frontend
```

2. Instale as dependências:

```bash
npm install
# ou
yarn
```

3. Inicie a aplicação:

```bash
quasar dev
```

> A aplicação frontend estará disponível em `http://localhost:9000`.

---

## 🔐 Usuário para Testes

Usuário padrão criado via seeder para testes:

- **Email**: `admin@teste.com`
- **Senha**: `senha123`

---

## ✅ Funcionalidades

- Autenticação via Laravel Sanctum
- Criação, edição, listagem e exclusão de tarefas
- Filtros por status
- Layout responsivo com Quasar Framework
- Proteção de rotas e verificação de sessão
- Testes automatizados com PHPUnit

---

## 🧪 Testes

Para rodar os testes (Laravel):

```bash
php artisan test
```

---

## 👤 Autor

Desenvolvido por **Ariel Seta**

- 🔗 [LinkedIn](https://br.linkedin.com/in/arielseta)
- 💻 [Portfólio](https://arielseta.github.io/)

---

## 📝 Licença

Este projeto foi desenvolvido como parte de um desafio técnico. Livre para uso educacional e profissional com os devidos créditos.#   g e r e n c i a d o r - t a r e f a s 
 
 