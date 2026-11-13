# Atividade – JOIN na Biblioteca da Escola
## Contexto

A biblioteca da escola anota os empréstimos em um caderno, e a bibliotecária não consegue saber com facilidade quem está com cada livro. Para resolver isso, foi montado um pequeno banco de dados com duas tabelas:

- `alunos`: quem pega livros emprestados
- `emprestimos`: qual livro foi emprestado e para qual aluno (guarda o número do aluno em `id_aluno`, e não o nome)

O `JOIN` é usado para descobrir quem está com cada livro.

---

## Parte 1 – Montar o banco

### Criação das tabelas

```sql
CREATE TABLE alunos (
    id   SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE emprestimos (
    id       SERIAL PRIMARY KEY,
    livro    VARCHAR(150) NOT NULL,
    id_aluno INTEGER NOT NULL,
    FOREIGN KEY (id_aluno) REFERENCES alunos(id)
);
```

### Inserção de 15 alunos

```sql
INSERT INTO alunos (nome) VALUES
('Ana Souza'),
('Bruno Lima'),
('Carla Mendes'),
('Daniel Rocha'),
('Eduarda Alves'),
('Felipe Costa'),
('Gabriela Nunes'),
('Henrique Dias'),
('Isabela Martins'),
('João Pereira'),
('Karina Barros'),
('Lucas Ferreira'),
('Mariana Teixeira'),
('Nicolas Ribeiro'),
('Olívia Cardoso');
```

### Inserção de 10 empréstimos

Apenas os alunos de 1 a 10 pegaram livro. Os alunos de 11 a 15 (5 alunos) não estão com nenhum livro.

```sql
INSERT INTO emprestimos (livro, id_aluno) VALUES
('Dom Casmurro', 1),
('O Pequeno Príncipe', 2),
('Harry Potter e a Pedra Filosofal', 3),
('O Hobbit', 4),
('Diário de um Banana', 5),
('Turma da Mônica', 6),
('Capitães da Areia', 7),
('A Culpa é das Estrelas', 8),
('O Cortiço', 9),
('Percy Jackson e o Ladrão de Raios', 10);
```

---

## Parte 2 – Consultas e respostas

### 1) Todos os dados de cada tabela

```sql
SELECT * FROM alunos;
```

| id | nome |
|----|------|
| 1 | Ana Souza |
| 2 | Bruno Lima |
| 3 | Carla Mendes |
| 4 | Daniel Rocha |
| 5 | Eduarda Alves |
| 6 | Felipe Costa |
| 7 | Gabriela Nunes |
| 8 | Henrique Dias |
| 9 | Isabela Martins |
| 10 | João Pereira |
| 11 | Karina Barros |
| 12 | Lucas Ferreira |
| 13 | Mariana Teixeira |
| 14 | Nicolas Ribeiro |
| 15 | Olívia Cardoso |

```sql
SELECT * FROM emprestimos;
```

| id | livro | id_aluno |
|----|-------|----------|
| 1 | Dom Casmurro | 1 |
| 2 | O Pequeno Príncipe | 2 |
| 3 | Harry Potter e a Pedra Filosofal | 3 |
| 4 | O Hobbit | 4 |
| 5 | Diário de um Banana | 5 |
| 6 | Turma da Mônica | 6 |
| 7 | Capitães da Areia | 7 |
| 8 | A Culpa é das Estrelas | 8 |
| 9 | O Cortiço | 9 |
| 10 | Percy Jackson e o Ladrão de Raios | 10 |

---

### 2) INNER JOIN

```sql
SELECT a.nome, e.livro
FROM alunos a
INNER JOIN emprestimos e ON e.id_aluno = a.id;
```

| nome | livro |
|------|-------|
| Ana Souza | Dom Casmurro |
| Bruno Lima | O Pequeno Príncipe |
| Carla Mendes | Harry Potter e a Pedra Filosofal |
| Daniel Rocha | O Hobbit |
| Eduarda Alves | Diário de um Banana |
| Felipe Costa | Turma da Mônica |
| Gabriela Nunes | Capitães da Areia |
| Henrique Dias | A Culpa é das Estrelas |
| Isabela Martins | O Cortiço |
| João Pereira | Percy Jackson e o Ladrão de Raios |

**Quais alunos NÃO apareceram? Por quê?**

Não apareceram os alunos 11 a 15: Karina Barros, Lucas Ferreira, Mariana Teixeira, Nicolas Ribeiro e Olívia Cardoso.

O `INNER JOIN` só devolve as linhas que têm correspondência nas duas tabelas. Como esses alunos não possuem nenhum registro em `emprestimos`, eles ficam de fora do resultado.

---

### 3) LEFT JOIN

```sql
SELECT a.nome, e.livro
FROM alunos a
LEFT JOIN emprestimos e ON e.id_aluno = a.id;
```

| nome | livro |
|------|-------|
| Ana Souza | Dom Casmurro |
| Bruno Lima | O Pequeno Príncipe |
| Carla Mendes | Harry Potter e a Pedra Filosofal |
| Daniel Rocha | O Hobbit |
| Eduarda Alves | Diário de um Banana |
| Felipe Costa | Turma da Mônica |
| Gabriela Nunes | Capitães da Areia |
| Henrique Dias | A Culpa é das Estrelas |
| Isabela Martins | O Cortiço |
| João Pereira | Percy Jackson e o Ladrão de Raios |
| Karina Barros | NULL |
| Lucas Ferreira | NULL |
| Mariana Teixeira | NULL |
| Nicolas Ribeiro | NULL |
| Olívia Cardoso | NULL |

**O que apareceu na coluna livro para quem não pegou nenhum livro?**

Apareceu `NULL` (valor vazio).

O `LEFT JOIN` mantém todas as linhas da tabela da esquerda (`alunos`). Quando não existe correspondência na tabela da direita (`emprestimos`), as colunas dela são preenchidas com `NULL`.

---

### 4) Alunos que NUNCA pegaram livro

```sql
SELECT a.id, a.nome
FROM alunos a
LEFT JOIN emprestimos e ON e.id_aluno = a.id
WHERE e.id IS NULL;
```

| id | nome |
|----|------|
| 11 | Karina Barros |
| 12 | Lucas Ferreira |
| 13 | Mariana Teixeira |
| 14 | Nicolas Ribeiro |
| 15 | Olívia Cardoso |

A consulta usa o `LEFT JOIN` e filtra as linhas em que o empréstimo não existe (`e.id IS NULL`), restando apenas os alunos sem livro.

Alternativa com `NOT EXISTS`, que devolve o mesmo resultado:

```sql
SELECT a.id, a.nome
FROM alunos a
WHERE NOT EXISTS (
    SELECT 1 FROM emprestimos e WHERE e.id_aluno = a.id
);
```

---

### 5) Empréstimo para um aluno que não existe

```sql
INSERT INTO emprestimos (livro, id_aluno) VALUES ('Turma da Mônica', 50);
```

**O que aconteceu? Por quê?**

O banco recusou o `INSERT` e retornou um erro de chave estrangeira:

```
ERROR:  insert or update on table "emprestimos" violates foreign key constraint "emprestimos_id_aluno_fkey"
DETAIL:  Key (id_aluno)=(50) is not present in table "alunos".
```

Isso aconteceu por causa da `FOREIGN KEY` na coluna `id_aluno`, que obriga todo `id_aluno` de `emprestimos` a existir na tabela `alunos`. Como só existem alunos de 1 a 15, o aluno 50 não existe e o banco impede o registro.

Dessa forma, a **integridade referencial** é mantida: não ficam empréstimos "órfãos", ligados a um aluno inexistente. Sem a `FOREIGN KEY`, o `INSERT` seria aceito e o banco ficaria inconsistente.