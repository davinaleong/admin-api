<?php defined('BASEPATH') OR exit('No direct script access allowed');
/* Migration version: 
 * 07 Dec 2017, 05:41AM
 * 20171207054106
 */
class Migration_Initial_setup extends CI_Migration
{
	// Public Functions ----------------------------------------------------------------
	public function up()
	{
		$this->load->model('Script_runner_model');
		$output = $this->Script_runner_model->run_script($this->_up_script())['output_str'];
	
		$this->load->model('User_model');
		$admin = array(
			'username' => 'admin',
			'name' => 'Default Admin',
			'password_hash' => password_hash('password', PASSWORD_DEFAULT),
			'access' => 'A',
			'account_status' => 'Active'
		);
		$admin['user_id'] = $this->User_model->insert($admin);
	
		if(ENVIRONMENT !== 'testing')
		{
			echo '<html lang="en"><head><title>Admin API - Migrations</title></head><body>';
			echo '<h1>Migrations</h1>';
			echo '<code>' . $output . '</code><hr/>';
			echo $admin['user_id'] > 0 ? '<p>Default Admin account created.</p>' : '<p>Failed to create Default Admin account.</p>';
			echo '</body></html>';
		}
	}
	
	public function down()
	{
		$this->load->model('Script_runner_model');
		echo $this->Script_runner_model->run_script($this->_down_script())['output_str'];
	}
	
	// Private Functions ---------------------------------------------------------------
	private function _up_script()
	{
		$sql = "
			CREATE TABLE `ci_sessions` (
				`id` VARCHAR(40) NOT NULL,
				`ip_address` VARCHAR(45) NOT NULL,
				`TIMESTAMP` INT(10) UNSIGNED NOT NULL DEFAULT '0',
				`data` blob NOT NULL,
				KEY `ci_sessions_TIMESTAMP` (`TIMESTAMP`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			
			CREATE TABLE `user` (
				`user_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
				`username` VARCHAR(64) DEFAULT NULL,
				`name` VARCHAR(64) DEFAULT NULL,
				`password_hash` VARCHAR(128) DEFAULT NULL,
				`access` VARCHAR(8) DEFAULT NULL,
				`account_status` VARCHAR(64) DEFAULT NULL,
				`timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				`last_updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY (`user_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			CREATE TABLE `user_log` (
				`user_log_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
				`user_id` INT(11) UNSIGNED DEFAULT NULL,
				`log` VARCHAR(64) DEFAULT NULL,
				`timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (`user_log_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			
			CREATE TABLE `access_right` (
				`access_right_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
				`ar_name` VARCHAR(64) DEFAULT NULL,
				`ar_value` VARCHAR(8) DEFAULT NULL,
				`ar_color` VARCHAR(64) DEFAULT NULL,
				`timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				`last_updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY (`access_right_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;

			CREATE TABLE `account_status` (
				`account_status_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
				`as_name` VARCHAR(64) DEFAULT NULL,
				`as_color` VARCHAR(64) DEFAULT NULL,
				`as_description` VARCHAR(128) DEFAULT NULL,
				`timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				`last_updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY (`account_status_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;


			INSERT INTO `access_right` (`ar_value`, `ar_name`, `ar_color`)
			VALUES ('S', 'Super Admin', 'danger'),
				('A', 'Admin', 'primary')
				('U', 'User', 'secondary');

			INSERT INTO `account_status` (`as_name`, `as_color`, `as_description`)
			VALUES ('Unverified', 'warning', 'Denotes if the email tied to this account has been verified.'),
				('Active', 'success', 'Account has usage to the system as his/her access rights allow.'),
				('Suspended', 'danger', 'Account has been temporarily disabled.'),
				('Deactivated', 'secondary', 'Account is no longer in use.');
		";
		return $sql;
	}
	
	private function _down_script()
	{
		$sql = "
			DROP TABLE IF EXISTS `ci_sessions`;
			DROP TABLE IF EXISTS `user`;
			DROP TABLE IF EXISTS `user_log`;
			DROP TABLE IF EXISTS `access_right`;
			DROP TABLE IF EXISTS `account_status`;
		";
		return $sql;
	}
	
} // end 20171207054106_initial_setup class