# Projeto PHP & MySQL - Suits Database

Este projeto consiste em um ambiente de desenvolvimento conteinerizado para gerenciar dados dos personagens da série Suits, utilizando Docker.

## 💻 Ambiente e Tecnologias

*   **Sistema Operacional:** Ubuntu 24.04.4 LTS
*   **Virtualização:** Oracle VirtualBox
*   **Linguagem:** PHP 8.3.26
*   **Banco de Dados:** MySQL 8.0.46 (Community Server - GPL)
*   **Gerenciamento de BD:** phpMyAdmin 5.2.3

## 🏗️ Infraestrutura de Pastas

A estrutura de diretórios foi organizada da seguinte forma:

```text
/compose/
  └── projeto-php-mysql/
      └── docker-compose.yml       # Arquivo de orquestração
/data/
  └── projeto/
      ├── php/
      │   ├── index.php            # Script principal
      │   └── admin/
      │       └── uploads.ini      # Configurações de PHP
      └── mysql/                   # Persistência de dados do banco
```

## 🌐 Mapeamento de Portas

Para acessar os serviços via navegador, utilize as seguintes portas:


| Serviço | Porta Local | Descrição |
| :--- | :--- | :--- |
| **Aplicação PHP** | `4550` | Interface principal do projeto |
| **phpMyAdmin** | `8080` | Administração do banco de dados |

---

## 🚀 Como executar
1. Navegue até a pasta do compose: `cd /compose/projeto-php-mysql`
2. Suba os containers: `docker-compose up -d`
3. Acesse o PHP em: `http://localhost:4550`

## 📸 Demonstração do Projeto

Aqui estão algumas capturas de tela da aplicação e do gerenciamento do banco de dados:


| Interface da Aplicação (PHP) |
| :---: |
| <img width="434" height="442" alt="image" src="https://github.com/user-attachments/assets/84e92be2-8c06-47ac-a297-02c347e3641c" /> | 

| Administração (phpMyAdmin) |
| :---: |
| <img width="1580" height="799" alt="image" src="https://github.com/user-attachments/assets/74da1653-9d6a-4704-9cb4-8b47cab9b6bc" /> |





