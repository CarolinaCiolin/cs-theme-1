# Pré-visualização no GitHub Codespaces

Esta configuração cria uma instalação WordPress isolada para desenvolvimento. O tema pai, o tema-filho e o plugin são montados diretamente do workspace; portanto, alterações em `themes/` e `plugins/` ficam disponíveis no próximo carregamento da página, sem gerar ZIPs.

## Criar e abrir

1. No GitHub, abra o repositório privado `CarolinaCiolin/cs-theme-1` e escolha **Code → Codespaces → Create codespace on ...**.
2. Aguarde a construção do `.devcontainer`. O primeiro arranque baixa as imagens Docker e o WordPress.
3. Quando a porta `8080` for encaminhada, abra a notificação **Open in Browser** ou a aba **Ports** e clique no endereço da porta `8080`.
4. A porta está marcada como **Private**. Não altere essa visibilidade para compartilhar o preview.

Abra sempre a URL HTTPS apresentada pelo Codespaces para a porta `8080`; não use `localhost` no navegador. O `wp-config.php` calcula o host recebido pelo proxy e reconhece `X-Forwarded-Proto`, fazendo com que links internos, login, editor Gutenberg e assets usem a URL encaminhada.

O utilizador administrativo é `csadmin`; a password é gerada somente na primeira criação da instalação e exibida no terminal do container. Ela também fica temporariamente em `/tmp/cs-theme-1-wp-admin-password`, fora do workspace.

## O que é inicializado

- `themes/cs-theme-1` é montado como tema pai.
- `themes/cs-theme-1-christoph` é montado como tema-filho e ativado automaticamente.
- `plugins/cs-blocks` é montado e ativado quando houver blocos válidos.
- Uma página `Demo Homepage` é criada com o padrão Gutenberg `cs-theme-1-christoph/homepage` e definida como página inicial.
- O banco MariaDB e o núcleo do WordPress ficam em volumes Docker nomeados, fora do Git.
- O `postCreateCommand` espera o `wp-config.php` e uma resposta válida de `wp db check` antes de instalar ou configurar o WordPress.

## Parar, retomar e recriar

Para apenas parar o ambiente, use **Codespaces → Stop codespace**. Para retomar, abra o mesmo Codespace pelo GitHub; os volumes preservam o banco, configurações e uploads locais.

No terminal do Codespace, os comandos úteis são:

```bash
docker compose -f .devcontainer/docker-compose.yml ps
docker compose -f .devcontainer/docker-compose.yml restart wordpress
docker compose -f .devcontainer/docker-compose.yml logs -f wordpress
```

Não use `docker compose down -v` se quiser preservar o banco e a instalação. Esse comando remove os volumes nomeados e exige uma nova instalação.

## Segurança e escopo

O banco usa o utilizador `root` sem password apenas dentro da rede Docker privada do ambiente descartável de desenvolvimento. Não é uma configuração de produção. Não há URLs de produção, dados pessoais, credenciais da hospedagem, uploads de teste ou dumps de banco neste repositório.

O workflow não altera a instalação WordPress da Hostinger e não faz commit nem push. Antes de commitar, confira `git status --short` e mantenha qualquer `.env`, dump, upload e arquivo temporário fora do Git.

## Limitações da validação

Foi verificada a estrutura dos arquivos, os caminhos dos mounts, a sintaxe JSON e a coerência dos comandos. A execução real do GitHub Codespaces não pode ser comprovada neste ambiente local: ela depende de autenticação no GitHub, disponibilidade do Docker durante o build, download das imagens, permissões do repositório privado e encaminhamento de portas da conta. A primeira criação pode demorar enquanto as imagens são baixadas.
