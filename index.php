<?php
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
	header('Content-Type: text/html; charset=utf-8');

	abstract class EntidadeBase {
		protected string $dataProcessamento;
		public function __construct() {
			$this->dataProcessamento = date('Y-m-d H:i:s');
		}
	}

	class Pessoa extends EntidadeBase {
		public function __construct(
			private string $nome,
			private string $cidade,
			private float $salario
		) {
			parent::__construct();
		}

		public function getNome(): string { return $this->nome; }
		public function getCidade(): string { return $this->cidade; }
		public function getSalario(): float { return $this->salario; }
	}

	class PessoaRepository {
		public function __construct(private PDO $db) {}

		public function listarTodos(): array {
			$stmt = $this->db->query("SELECT nome, cidade, salario FROM personagens_suits");
			$resultados = [];
			
			// Transforma linhas do banco em Objetos da classe Pessoa
			while ($row = $stmt->fetch()) {
				$resultados[] = new Pessoa($row['nome'], $row['cidade'], (float)$row['salario']);
			}
			return $resultados;
		}
	}

	// --- Configuração da Conexão ---
	$servername = "db"; 
	$username   = "root";
	$password   = "Senha123";
	$database   = "projetodb";


	try {
		$dsn = "mysql:host=$servername;dbname=$database;charset=utf8mb4";
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		$pdo = new PDO($dsn, $username, $password, $options);
		$repo = new PessoaRepository($pdo);
		$listaPessoas = $repo->listarTodos();
		$status_conexao = ["success", "Conexão estabelecida com sucesso."];
	} catch (PDOException $e) {
		$status_conexao = ["danger", "Erro de conexão: " . $e->getMessage()];
		$listaPessoas = [];
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard | Suits Cast</title>
		
		<!-- Google Fonts -->
		<link href="https://googleapis.com" rel="stylesheet">
		
		<!-- IMPORTANTE: Chama o arquivo CSS externo -->
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<!-- O restante do seu código HTML/PHP continua igual -->
		<div class="container">
			<header>
				<div>
					<h1>Personagens Suits</h1>
					<small>Versão Atual do PHP<?php echo phpversion(); ?></small>
				</div>
				<span class="badge <?php echo $status_conexao[0]; ?>">
					<?php echo $status_conexao[1]; ?>
				</span>
			</header>

			<?php if (!empty($listaPessoas)): ?>
				<table>
					<thead>
						<tr>
							<th>Nome</th>
							<th>Cidade</th>
							<th>Salário</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($listaPessoas as $p): ?>
							<tr>
								<td><strong><?php echo htmlspecialchars($p->getNome()); ?></strong></td>
								<td><?php echo htmlspecialchars($p->getCidade()); ?></td>
								<td class="salario">R$ <?php echo number_format($p->getSalario(), 2, ',', '.'); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<div class="empty-state">
					<p>Nenhum registro encontrado na base de dados.</p>
				</div>
			<?php endif; ?>
		</div>
	</body>
</html>