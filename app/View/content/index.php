	<main>
		<h1>Olá Mundo</h1>
		<h2><?=$msg?></h2>
	<?php
		if ($resultSet) {
			
			foreach ( $resultSet as $idx => $value ) {
				echo "$idx = " . $value['nome'] . "<br>";
				
			}
		}
	?>
		<form method="post" action="<?=BASE_URL?>home/insert">
			<input type="text" name="nome" placeholder="Nome:" required><br>
			<input type="email" name="email" placeholder="E-mail" required><br>
			<input type="password" name="pass" placeholder="Senha" required><br>
			<?=$csrf?>
			<button type="submit">Cadastrar</button>
		</form>
	</main>