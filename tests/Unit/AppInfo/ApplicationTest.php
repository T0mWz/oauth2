<?php
/**
 * @author Lukas Biermann
 * @author Nina Herrmann
 * @author Wladislaw Iwanzow
 * @author Dennis Meis
 * @author Jonathan Neugebauer
 *
 * @copyright Copyright (c) 2016, Project Seminar "PSSL16" at the University of Muenster.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 */

namespace OCA\OAuth2\Tests\Unit\Controller;

use OCA\OAuth2\AppInfo\Application;
use OCA\OAuth2\Hooks\UserHooks;
use PHPUnit_Framework_TestCase;

class ApplicationTest extends PHPUnit_Framework_TestCase {

	/** @var Application $application */
	private $application;

	public function setUp() {
		$this->application = new Application();
	}

	public function testRegisterService() {
		$app = new Application();
		$c = $app->getContainer();
		$c->registerService('UserHooks', function($c){
			return new UserHooks(
				$c->query('ServerContainer')->getUserManager(),
				$c->query('OCA\OAuth2\Db\AccessTokenMapper'),
				$c->query('OCA\OAuth2\Db\AuthorizationCodeMapper'),
				$c->query('OCA\OAuth2\Db\RefreshTokenMapper')
			);
		});
	}

	public function testRegisterSettings() {
		$this->application->registerSettings();
	}

}
