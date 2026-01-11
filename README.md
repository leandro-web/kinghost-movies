# Catálogo de Filmes - Teste Técnico Full Stack

Aplicação web para busca e gerenciamento de filmes favoritos, integrando a API do TMDB com backend Laravel e frontend Vue.js.

## 🚀 Tecnologias Utilizadas

- **Backend:** Laravel 10+, PHP 8.2, MySQL 8.0
- **Frontend:** Vue.js 3 (Composition API), Vite, TailwindCSS
- **Infraestrutura:** Docker & Docker Compose

---

## 🔧 Pré-requisitos

Certifique-se de ter instalado em sua máquina:

- [Docker](https://www.docker.com/) e Docker Compose
- [Git](https://git-scm.com/)

---

## 📥 Instalação e Execução

Siga os passos abaixo para rodar o projeto completo em ambiente de desenvolvimento.

### 1. Clone o repositório

```bash
git clone <LINK_DO_SEU_REPOSITORIO_AQUI>
cd teste-tecnico-filmes
```

### 2. Configuração de Ambiente (Backend)

Copie o arquivo de exemplo e configure as variáveis:

```bash
cd backend
cp .env.example .env
```

Edite o arquivo .env gerado e insira sua chave da API do TMDB que está em .env.example caso a mesma não tenha sido clonada:

```bash
TMDB_API_KEY=sua_chave_api_tmdb_aqui
```

### 3. Configuração de Ambiente (Frontend)

Copie o arquivo de exemplo e configure as variáveis:

```bash
cd frontend
cp .env.example .env
```

```bash
VITE_API_BASE_URL=http://localhost:8000/api
```

### 4. Subindo os Containers (Docker)

Volte para a raiz do projeto e inicie os serviços:

```bash
cd ..
docker-compose up -d --build
```

### 5. Instalação de Dependências e Migrations

Com os containers rodando, execute os comandos de configuração:

```bash
# Instalar dependências do Backend
docker-compose exec backend composer install

# Gerar chave da aplicação Laravel
docker-compose exec backend php artisan key:generate

# Rodar migrações do Banco de Dados
docker-compose exec backend php artisan migrate

# Instalar dependências do Frontend
docker-compose exec frontend npm install

# Rodar o frontend
docker-compose exec frontend npm run dev
```

## Acesso à Aplicação

Após finalizar os passos acima:

Frontend (Aplicação): http://localhost:5173

Backend (API): http://localhost:8000

## Estrutura do Projeto e CRUD

# Backend (Laravel)

O CRUD de favoritos foi implementado seguindo o padrão REST.

Controller: backend/app/Http/Controllers/FavoriteController.php

Model: backend/app/Models/Favorite.php

Rotas: backend/routes/api.php

Migration: backend/database/migrations/xxxx_create_favorites_table.php

# Frontend (Vue.js)

Views:

frontend/src/views/HomeView.vue: Busca na API do TMDB e salva no Laravel.

frontend/src/views/FavoritesView.vue: Lista favoritos do Laravel, filtra por gênero e remove.

Services: frontend/src/services/api.js (Configuração do Axios).

## Testes Automatizados

Volte para a raiz do projeto e inicie os serviços:

```bash
cd ..
docker-compose exec backend php artisan test
```

## Configuração da API do TMDB

Para que o sistema funcione, você precisará de uma chave de API (v3).

1. Crie uma conta gratuita no [The Movie Database (TMDB)](https://www.themoviedb.org/signup).
2. Acesse [Configurações da API](https://www.themoviedb.org/settings/api).
3. Gere uma **API Key**. Você usará essa chave na configuração do Backend.

---
