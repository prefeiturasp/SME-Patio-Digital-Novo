<?php
class Banco
{
	public static $objetosDeConexao;

	public function conectar()
	{
		//echo '<hr>Conectando ao Banco<hr>';
		self::$objetosDeConexao++;
	}
}




$banco = new Banco();
$banco->conectar();

$banco2=new Banco();
$banco2->conectar();

$banco3=new Banco();
$banco3->conectar();
echo '<h4>Total de Conexoes ao Banco: '.Banco::$objetosDeConexao . '</h4>';

echo '<hr>';
