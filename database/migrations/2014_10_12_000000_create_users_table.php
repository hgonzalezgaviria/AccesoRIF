<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('USERS', function (Blueprint $table) {
			$table->increments('USER_ID')
				->comment('Valor autonumérico, llave primaria de la tabla USERS.');
			$table->string('name')
				->comment('Nombre completo del usuario.');
			$table->string('username')->unique()
				->comment('Cuenta del usuario, con la cual realizará la autenticación. Valor único en la tabla');
			$table->string('email')
				->comment('Correo electrónico del usuario.');
			$table->string('password')
				->comment('Contraseña del usuario cifrada.');
			$table->unSignedInteger('ROLE_ID')
				->comment('Campo foráneo de la tabla ROLES.');
			$table->rememberToken();

			//Traza
			$table->string('USER_CREADOPOR')
				->comment('Usuario que creó el registro en la tabla');
			$table->timestamp('USER_FECHACREADO')
				->comment('Fecha en que se creó el registro en la tabla.');
			$table->string('USER_MODIFICADOPOR')->nullable()
				->comment('Usuario que realizó la última modificación del registro en la tabla.');
			$table->timestamp('USER_FECHAMODIFICADO')->nullable()
				->comment('Fecha de la última modificación del registro en la tabla.');
			$table->string('USER_ELIMINADOPOR')->nullable()
				->comment('Usuario que eliminó el registro en la tabla.');
			$table->timestamp('USER_FECHAELIMINADO')->nullable()
				->comment('Fecha en que se eliminó el registro en la tabla.');

			//Relaciones
			$table->foreign('ROLE_ID')
			->references('ROLE_ID')
			->on('ROLES');
		});


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('USERS');
	}
}
