# CS Theme 1 — prévia estática

Esta pasta é uma representação navegável da homepage do tema filho de Christoph Wimmersberger para revisão visual no GitHub Pages.

## Fonte da prévia

- `index.html` foi derivado do HTML aprovado em `references/CLAUDE 2 - Bewegungscoach – Christoph Wimmersberger (v2).html`.
- `assets/css/preview.css` e `assets/js/preview.js` mantêm, respectivamente, os estilos e o comportamento interativo da referência.
- As fontes públicas em `assets/fonts/` são cópias dos mesmos arquivos tipográficos do tema WordPress, necessárias porque o GitHub Pages publica somente `docs/`.
- A paleta e os tokens correspondem ao `themes/cs-theme-1/theme.json` e à composição em `themes/cs-theme-1-christoph/assets/css/homepage.css`.

## Atualização futura

Quando a homepage oficial mudar, atualize primeiro o HTML/CSS/JS da implementação WordPress ou a referência aprovada; depois replique a mudança nesta prévia e valide os mesmos breakpoints. A adaptação específica desta versão é apenas a troca de URLs WordPress por âncoras locais e o carregamento de fontes sem PHP.

## GitHub Pages

Nas configurações do repositório, selecione `Deploy from a branch`, branch `main` e pasta `/docs`. A URL esperada é `https://carolinaciolin.github.io/cs-theme-1/`.
