<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Permission;

class MenuTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$orderMenuLeft = 0;
		$orderMenuTop = 0;


		$orderItem = 0;
		$parent = Menu::create([
			'MENU_LABEL' => 'Admin',
			'MENU_ICON' => 'fa-cogs',
			'MENU_ORDER' => $orderMenuLeft++,
		]);
			Menu::create([
				'MENU_LABEL' => 'Menú',
				'MENU_URL' => 'app/menu',
				'MENU_ICON' => 'fa-bars',
				'MENU_PARENT' => $parent->MENU_ID,
				'MENU_ORDER' => $orderItem++,
				'MENU_ENABLED' => true,
				'PERM_ID' => $this->getPermission('app-menu'),
			]);
			Menu::create([
				'MENU_LABEL' => 'Parametrizaciones generales',
				'MENU_URL' => 'app/parameters',
				'MENU_ICON' => 'fa-cog',
				'MENU_PARENT' => $parent->MENU_ID,
				'MENU_ORDER' => $orderItem++,
				'PERM_ID' => $this->getPermission('app-parameters'),
		   ]);
			Menu::create([
				'MENU_LABEL' => 'Carga másiva',
				'MENU_URL' => 'app/upload',
				'MENU_ICON' => 'fa-cog',
				'MENU_PARENT' => $parent->MENU_ID,
				'MENU_ORDER' => $orderItem++,
				'PERM_ID' => $this->getPermission('app-upload'),
			]);

		$orderItem = 0;
		$parent = Menu::create([
			'MENU_LABEL' => 'Usuarios y roles',
			'MENU_ICON' => 'fa-user-circle-o',
			'MENU_ORDER' => $orderMenuLeft++,
		]);
			Menu::create([
				'MENU_LABEL' => 'Usuarios',
				'MENU_URL' => 'auth/usuarios',
				'MENU_ICON' => 'fa-user',
				'MENU_PARENT' => $parent->MENU_ID,
				'MENU_ORDER' => $orderItem++,
				'PERM_ID' => $this->getPermission('user-index'),
			]);
			Menu::create([
				'MENU_LABEL' => 'Roles',
				'MENU_URL' => 'auth/roles',
				'MENU_ICON' => 'fa-male',
				'MENU_PARENT' => $parent->MENU_ID,
				'MENU_ORDER' => $orderItem++,
				'PERM_ID' => $this->getPermission('role-index'),
			]);
			Menu::create([
				'MENU_LABEL' => 'Permisos',
				'MENU_URL' => 'auth/permisos',
				'MENU_ICON' => 'fa-address-card-o',
				'MENU_PARENT' => $parent->MENU_ID,
				'MENU_ORDER' => $orderItem++,
				'PERM_ID' => $this->getPermission('permission-index'),
			]);

		
		//TOP
		Menu::create([
			'MENU_LABEL' => 'Propietarios',
			'MENU_URL' => 'core/propietarios',
			'MENU_ICON' => 'fa-address-card',
			'MENU_ORDER' => $orderMenuTop++,
			'MENU_POSITION' => 'TOP',
			'PERM_ID' => $this->getPermission('propietario-index'),
		]);
		Menu::create([
			'MENU_LABEL' => 'Tarjetas',
			'MENU_URL' => 'core/tarjetas',
			'MENU_ICON' => 'fa-credit-card-alt',
			'MENU_ORDER' => $orderMenuTop++,
			'MENU_POSITION' => 'TOP',
			'PERM_ID' => $this->getPermission('tarjeta-index'),
		]);

			$orderItem = 0;
			$parent = Menu::create([
			'MENU_LABEL' => 'Accesos',
			'MENU_ICON' => 'fa-tripadvisor',
			'MENU_ORDER' => $orderMenuTop++,
			'MENU_POSITION' => 'TOP',
			]);
					Menu::create([
						'MENU_LABEL' => 'Detalle Accesos',
							'MENU_URL' => 'core/accesos',
							'MENU_ICON' => 'fa-500px',
						'MENU_PARENT' => $parent->MENU_ID,
						'MENU_ORDER' => $orderMenuTop++,
						'MENU_POSITION' => 'TOP',
						'PERM_ID' => $this->getPermission('acceso-index'),
					]);

					Menu::create([
					'MENU_LABEL' => 'Intentos',
					'MENU_URL' => 'core/intentosfallidos',
					'MENU_ICON' => 'fa-low-vision',
					'MENU_PARENT' => $parent->MENU_ID,
					'MENU_ORDER' => $orderMenuTop++,
					'MENU_POSITION' => 'TOP',
					'PERM_ID' => $this->getPermission('intentofallido-index'),
					]);

		Menu::create([
			'MENU_LABEL' => 'Horarios',
			'MENU_URL' => 'core/horarios',
			'MENU_ICON' => 'fa-calendar-plus-o',
			'MENU_ORDER' => $orderMenuTop++,
			'MENU_POSITION' => 'TOP',
			'PERM_ID' => $this->getPermission('horario-index'),
		]);

		/*Menu::create([
			'MENU_LABEL' => 'Tickets',
			'MENU_URL' => 'cnfg-tickets/tickets',
			'MENU_ICON' => 'fa-id-badge',
			'MENU_ORDER' => $orderMenuTop++,
			'MENU_POSITION' => 'TOP',
			'PERM_ID' => $this->getPermission('ticket-index'),
		]);

		$orderItem = 0;
		$parent = Menu::create([
			'MENU_LABEL' => 'Gestión Humana',
			'MENU_ICON' => 'fa-users',
			'MENU_ORDER' => $orderMenuTop++,
			'MENU_POSITION' => 'TOP',
		]);
			Menu::create([
				'MENU_LABEL' => 'Contratos',
				'MENU_URL' => 'gestion-humana/contratos',
				'MENU_ICON' => 'fa-handshake-o',
				'MENU_PARENT' => $parent->MENU_ID,
				'MENU_ORDER' => $orderMenuTop++,
				'MENU_POSITION' => 'TOP',
				'PERM_ID' => $this->getPermission('contrato-index'),
			]);
			*/

   
	}

	//??
	private function getPermission($namePermission)
	{
		$perm = Permission::where('name', $namePermission)->get()->first();
		if(isset($perm))
			return $perm->id;
		return null;
	}
}
