# 🏥 PrimaryCare CRUD - Sistema de Gestão de Pacientes

Bem-vindo ao **PrimaryCare CRUD**, um sistema de gerenciamento de pacientes com Design Moderno e Responsivo e Arquitetura Limpa (S.O.L.I.D). 

Este projeto foi construído utilizando as ferramentas mais modernas do ecossistema PHP.

## 🚀 Tecnologias Utilizadas

- **Backend:** Laravel 12 (PHP 8.2+)
- **Banco de Dados:** MySQL (utilizando Eloquent ORM)
- **Frontend:** Laravel Blade + Tailwind CSS (com compilação via Vite)
- **Javascript Interativo:** Alpine.js
- **Testes de Qualidade:** Pest (Feature Testing)

---

## ⚙️ Como Instalar e Rodar o Projeto

Siga os passos abaixo para testar a aplicação em seu ambiente local (assumindo Windows com XAMPP):

### Pré-requisitos
- PHP 8.2 ou superior.
- Composer.
- Node.js e NPM.
- Servidor MySQL.

### Passo a Passo

1. **Clone o repositório e acesse a pasta:**
   ```bash
   git clone git@github.com:luizamaro11/Aten-o-B-sica---Teste-T-cnico-AISphere.git
   ```

2. **Instale as dependências do Backend:**
   ```bash
   composer install
   ```

3. **Instale as dependências do Frontend (Tailwind/Vite):**
   ```bash
   npm install
   npm run build
   ```

4. **Configuração de Ambiente:**
   Copie o arquivo `.env.example` para `.env` e configure o banco de dados. No MySQL, crie o banco chamado `primarycare`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=primarycare
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Gere a Chave da Aplicação:**
   ```bash
   php artisan key:generate
   ```

6. **Rode as Migrations e os Seeders (Para popular com usuários e pacientes falsos):**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Ligue o Armazenamento de Imagens (Storage):**
   ```bash
   php artisan storage:link
   ```

8. **Inicie o Servidor:**
   ```bash
   php artisan serve
   ```

---

## 🔑 Credenciais de Acesso (Geradas no Seed)

Se você executou o `php artisan migrate:fresh --seed`, um administrador e 5 pacientes fictícios foram criados no banco de dados para testes.

- **E-mail (Admin):** `admin@admin.com`
- **Senha:** `password`

---

## 🧪 Suíte de Testes (TDD/Feature)

O projeto possui rigorosa cobertura de código nas funcionalidades críticas e autenticação.
A ferramenta utilizada é o **Pest**. Para rodar as asserções de qualidade, basta digitar o seguinte comando:

```bash
php artisan test
```

A saída exibirá a verificação (Asserts) testando redirecionamentos, proteção de rotas privadas, e criação e exclusão lógica de pacientes no banco de dados.

