## 👨‍💻 Autor

<div align="center">
  <img src="https://avatars.githubusercontent.com/ninomiquelino" width="100" height="100" style="border-radius: 50%">
  <br>
  <strong>Onivaldo Miquelino</strong>
  <br>
  <a href="https://github.com/ninomiquelino">@ninomiquelino</a>
</div>

---

# ✅ PHP Flat-File Todo List (CRUD with JSON)

![Made with PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![Frontend JavaScript](https://img.shields.io/badge/Frontend-JavaScript-F7DF1E?logo=javascript&logoColor=black)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-38B2AC?logo=tailwindcss&logoColor=white)
![License MIT](https://img.shields.io/badge/License-MIT-green)
![Status Stable](https://img.shields.io/badge/Status-Stable-success)
![Version 1.0.0](https://img.shields.io/badge/Version-1.0.0-blue)
![GitHub stars](https://img.shields.io/github/stars/NinoMiquelino/flat-file-todo-list?style=social)
![GitHub forks](https://img.shields.io/github/forks/NinoMiquelino/flat-file-todo-list?style=social)
![GitHub issues](https://img.shields.io/github/issues/NinoMiquelino/flat-file-todo-list)

Este projeto serve como um excelente exercício para entender como o PHP pode ser usado para gerenciar persistência de dados sem depender de um banco de dados relacional (como MySQL). Ele implementa todas as operações CRUD em um arquivo JSON simples.

---

## 💾 Recursos Principais

* **Persistência JSON:** Todas as tarefas são armazenadas e recuperadas de um único arquivo `src/data.json`.
* **CRUD Completo:** O backend PHP implementa rotas para Criar (POST), Ler (GET), Atualizar (PUT) e Excluir (DELETE) tarefas.
* **Métodos HTTP:** O JavaScript utiliza a API `fetch` para interagir com o PHP usando os métodos HTTP apropriados, seguindo uma arquitetura RESTful simples.
* **Manipulação de Arquivo em PHP:** Uso de `file_get_contents`, `file_put_contents`, `json_decode`, e `json_encode` para gerenciar o "banco de dados".

---

## 🧠 Tecnologias utilizadas

* **Backend:** PHP 7.4+ (Focado em I/O de arquivos e manipulação de arrays).
* **"Banco de Dados":** Arquivo JSON simples (`data.json`).
* **Frontend:** HTML5, JavaScript Vanilla e `fetch` API.
* **Estilização:** Tailwind CSS (via CDN).

---

## 🧩 Estrutura do Projeto

```
flat-file-todo-list/
├── index.html
├── api.php
├── README.md
├── .gitignore
├── LICENSE
└── data.json
```
---

## ⚙️ Configuração e Instalação

### Pré-requisitos

1.  Um ambiente de servidor web com PHP.
2.  **Permissão de escrita** na pasta `src/`.

### 1. Estrutura e Arquivo de Dados

1.  Crie a estrutura de pastas conforme o diagrama.
2.  **Crie o arquivo de dados:** Crie o arquivo `src/data.json` vazio.

    ```bash
    touch src/data.json
    # Ou crie-o manualmente e garanta que o conteúdo inicial seja [] (um array vazio)
    ```

3.  **Defina as permissões:** Garanta que a pasta `src/` e o arquivo `src/data.json` tenham permissão de escrita para o usuário do servidor web (ex: `chmod 666 src/data.json` e `chmod 755 src/`).

### 2. Executar o Servidor

Utilize o servidor embutido do PHP para testes (a partir da raiz do projeto):

```bash
php -S localhost:8001
```

- Acesse: O frontend estará disponível em http://localhost:8001/public/index.html.
​
---

## 📝 Instruções de Uso
​Acesse a aplicação no navegador.
​Adicionar: Digite uma tarefa e clique em "Adicionar" (POST). O PHP adicionará um novo objeto ao data.json.
​Visualizar: A lista será recarregada automaticamente (GET).
​Concluir: Clique na caixa de seleção para marcar/desmarcar a tarefa (PUT).
​Excluir: Clique no botão "Excluir" (DELETE).
​Inspecione o arquivo src/data.json no seu editor de texto após cada operação para ver como o PHP está manipulando e persistindo os dados em tempo real.

---

## 🤝 Contribuições
Contribuições são sempre bem-vindas!  
Sinta-se à vontade para abrir uma [*issue*](https://github.com/NinoMiquelino/flat-file-todo-list/issues) com sugestões ou enviar um [*pull request*](https://github.com/NinoMiquelino/flat-file-todo-list/pulls) com melhorias.

---

## 💬 Contato
📧 [Entre em contato pelo LinkedIn](https://www.linkedin.com/in/onivaldomiquelino/)  
💻 Desenvolvido por **Onivaldo Miquelino**

---
