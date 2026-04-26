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
		$status_conexao = "Conectado com sucesso via PDO (OO)!";

		// Inicializa o repositório e busca os dados
		$repo = new PessoaRepository($pdo);
		$listaPessoas = $repo->listarTodos();

	} catch (PDOException $e) {
		$status_conexao = "Erro: " . $e->getMessage();
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Exemplo PHP OO com PDO</title>
		<style>
			.pessoa-card { border-bottom: 1px solid #eee; padding: 5px; }
		</style>
	</head>
	<body>
		<h3>Versão Atual do PHP: <?php echo phpversion(); ?></h3>
		<p><strong>Status:</strong> <?php echo $status_conexao; ?></p>

		<hr>

		<?php if (isset($listaPessoas) && !empty($listaPessoas)): ?>
			<?php foreach ($listaPessoas as $p): ?>
				<div class="pessoa-card">
					<?php 
						// Usando os métodos do objeto Pessoa
						echo htmlspecialchars($p->getNome()) . " | " . 
							 htmlspecialchars($p->getCidade()) . " | R$ " . 
							 number_format($p->getSalario(), 2, ',', '.'); 
					?>
				</div>
			<?php endforeach; ?>
		<?php elseif (isset($pdo)): ?>
			<p>Nenhum registro encontrado na tabela.</p>
		<?php endif; ?>

	</body>
</html>
