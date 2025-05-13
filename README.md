# Gerenciador de Tarefas

Aplicação full stack desenvolvida com Laravel (backend) e Quasar Framework (frontend), que permite gerenciar tarefas com autenticação, listagem, criação, edição, e exclusão.

---

## 🛠️ Tecnologias Utilizadas

### Backend – Laravel 12
- PHP 8.1+
- Laravel Sanctum (autenticação via API)
- Migrations e Seeders
- Testes automatizados com PHPUnit
- API RESTful protegida por middleware

### Frontend – Quasar Framework (Vue.js)
- Vue 3 Composition API
- Quasar UI para layout responsivo
- Integração com Laravel via Fetch API
- Controle de sessão e autenticação no client

---

## 🗂 Estrutura do Projeto

```
gerenciador-tarefas/
├── app_tarefas/              # Backend (Laravel)
├── app_tarefas_frontend/     # Frontend (Quasar Framework)
```

---

## 🔐 Usuário para Testes

Criado via seeder:

- **Email:** `admin@teste.com`  
- **Senha:** `senha123`

---

## ⚙️ Funcionalidades Implementadas

| Funcionalidade                         | Status |
|----------------------------------------|--------|
| Autenticação com Laravel Sanctum       | ✅     |
| Login, Logout e persistência de sessão | ✅     |
| CRUD completo de Tarefas via API       | ✅     |
| Filtros por status                     | ✅     |
| Interface responsiva com Quasar        | ✅     |
| Proteção de rotas                      | ✅     |
| Testes com PHPUnit                     | ✅     |
| Seeders para status e usuário          | ✅     |

---

## ▶️ Como Executar

### Backend

```bash
cd app_tarefas
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Frontend

```bash
cd app_tarefas_frontend
npm install
quasar dev
```

---

## 🧪 Testes Automatizados

Executar:

```bash
php artisan test
```

Todos os testes de criação, listagem, edição e exclusão de tarefas estão implementados e passando com sucesso.

---

## 👤 Autor

Desenvolvido por **Ariel Seta**

- 🔗 [LinkedIn](https://br.linkedin.com/in/arielseta)
- 💻 [Portfólio](https://arielseta.github.io/)

---

## 📝 Licença

Este projeto foi desenvolvido como parte de um desafio técnico. Livre para uso educacional e profissional com os devidos créditos.#   g e r e n c i a d o r - t a r e f a s 
 
 