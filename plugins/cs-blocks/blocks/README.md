# Blocos Gutenberg

Cada bloco futuro terá seu próprio subdiretório em `blocks/`, com um arquivo
`block.json` e os recursos declarados nele. Use o namespace `cs-blocks/` no
campo `name` do manifesto. No hook `init`, o plugin registra os manifestos com
`register_block_type()`. Para aparecer no editor, um bloco também precisa
fornecer sua implementação cliente ou outra estratégia de edição suportada.

A versão 1.0.0 vem com o diretório preparado para receber os primeiros blocos.
