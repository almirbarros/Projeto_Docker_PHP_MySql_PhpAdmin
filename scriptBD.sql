CREATE TABLE personagens_suits (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    cidade VARCHAR(50),
    salario DECIMAL(10, 2)
);


--Almir
INSERT INTO personagens_suits (nome, cidade, salario) 
VALUES ('Almir Barros', 'Rio de Janeiro', 250000.00);

-- Harvey Specter: Sócio Sênior/Gerente em NYC
INSERT INTO personagens_suits (nome, cidade, salario) 
VALUES ('Harvey Specter', 'Nova York', 150000.00);

-- Mike Ross: Associado (com o segredo de não ter diploma)
INSERT INTO personagens_suits (nome, cidade, salario) 
VALUES ('Mike Ross', 'Nova York', 45000.00);

-- Jessica Pearson: Sócia Majoritária
INSERT INTO personagens_suits (nome, cidade, salario) 
VALUES ('Jessica Pearson', 'Nova York', 200000.00);

-- Louis Litt: Sócio e especialista financeiro
INSERT INTO personagens_suits (nome, cidade, salario) 
VALUES ('Louis Litt', 'Nova York', 120000.00);

-- Donna Paulsen: A melhor secretária executiva/COO
INSERT INTO personagens_suits (nome, cidade, salario) 
VALUES ('Donna Paulsen', 'Nova York', 85000.00);

-- Rachel Zane: Assistente Jurídica (paralegal)
INSERT INTO personagens_suits (nome, cidade, salario) 
VALUES ('Rachel Zane', 'Nova York', 35000.00);
