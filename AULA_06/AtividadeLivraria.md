## Atividade - lIVROS


Início:

-Crie um novo banco de dados para armazenar a tabela de livros
-Crie uma tabela com as colunas (id,nome,autor,preco,genero,estoque,ano_publicacao)
-Lembre-se de escolher as variáveis adequadas!


Bloco 1 — Reconhecimento da base

Objetivo: aprender a visualizar uma base de dados

 

1. Exiba todos os dados da tabela, mas limitando o resultado aos 10 primeiros registros.

2. Exiba apenas as colunas titulo, autor e preco de todos os livros.

3. Liste os gêneros distintos existentes na base, em ordem alfabética.

4. Descubra quantos autores diferentes existem.

5. Liste os 5 livros mais caros da base (título e preço).

6. Liste os 5 livros com menor estoque (título e estoque).

 

Bloco 2 — Filtros numéricos

Objetivo: dominar os operadores de comparação e o BETWEEN.

7. Mostre titulo e estoque de todos os livros do gênero Técnico.

8. Mostre titulo e preco dos livros que custam mais de R$ 200,00.

9. Mostre titulo e preco dos livros com preço entre R$ 40,00 e R$ 70,00.

10. Mostre os livros com estoque abaixo de 5 unidades (situação de reposição urgente).

11. Liste os livros publicados antes de 1900, ordenados do mais antigo para o mais recente.

12. Liste os livros publicados entre 2010 e 2020, mostrando título, ano e gênero.

---

Vamos criar um novo banco de dados

```sql 

CREATE DATABASE livros;
```

criação da tabela para livros:

```sql
CREATE TABLE produtos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    autor VARCHAR(50) NOT NULL,
    preco DECIMAL (10,2) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    estoque INTEGER NOT NULL,
    ano_publicacao INTEGER NOT NULL
);
```
>depois adicionado os 200 livros 
---

depois para que Exiba todos os dados da tabela, mas limitando o resultado aos 10 primeiros registros
usamos:

```sql
SELECT * FROM produtos LIMIT 10; 
```
---

depois para que Exiba apenas as colunas titulo, autor e preco de todos os livros:
usamos:
```sql
SELECT nome,preco,livros
FROM produtos
```
---

Liste os gêneros distintos existentes na base, em ordem alfabética:
```sql
SELECT DISTINCT genero FROM produtos
ORDER BY genero;
```
---

Descubra quantos autores diferentes existem:

```sql
SELECT DISTINCT autor FROM produtos
ORDER BY autor;
```
---

Liste os 5 livros mais caros da base (título e preço):

```sql
SELECT titulo, preco
FROM titulos
ORDER BY preco DESC
LIMIT 5;
```

 Liste os 5 livros com menor estoque (título e estoque):
 ```sql
SELECT titulo, estoque
FROM titulos
ORDER BY estoque ASC
LIMIT 5;
```

