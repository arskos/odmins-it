<?php
/**********************************************************************************
* TorrentDatabase.php                                                             *
***********************************************************************************
* SMF Torrent                                                                     *
* =============================================================================== *
* Software Version:           SMF Torrent 0.1 Alpha                               *
* Software by:                Niko Pahajoki (http://www.madjoki.com)              *
* Copyright 2008 by:          Niko Pahajoki (http://www.madjoki.com)              *
* Support, News, Updates at:  http://www.madjoki.com                              *
***********************************************************************************
* This program is free software; you may redistribute it and/or modify it under   *
* the terms of the provided license as published by Simple Machines LLC.          *
*                                                                                 *
* This program is distributed in the hope that it is and will be useful, but      *
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY    *
* or FITNESS FOR A PARTICULAR PURPOSE.                                            *
*                                                                                 *
* See the "license.txt" file for details of the Simple Machines license.          *
* The latest version can always be found at http://www.simplemachines.org.        *
**********************************************************************************/

if (!defined('SMF'))
	die('Hacking attempt...');

$tracker_version = '0.1 Alpha';

$addSettings = array(
	'torrentDirectory' => array($boarddir . '/Torrent', false),
	'trackerURL' => array($boardurl . '/announce.php', false),
	'enableTracker' => array(1, false),
	'trackerEnableDHT' => array(0, false),
	'trackerAllowExternal' => array(1, false),
	'enablePasskey' => array(1, false),
	'scrapePasskey' => array(0, false),
	'checkConnectable' => array(0, false),
	'trackerInterval' => array(1200, false),
	'trackerMinInterval' => array(600, false),
	'trackerCleanInterval' => array(8600, false),
);

$permissions = array(

);

$tables = array(
	'members' => array(
		'name' => 'members',
		'smf' => true,
		'columns' => array(
			array(
				'name' => 'passkey',
				'type' => 'varchar',
				'size' => 32,
			),
			array(
				'name' => 'active_leechers',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'active_seeders',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'tracker_connectable',
				'type' => 'int',
				'size' => 1,
				'unsigned' => true,
			),
			array(
				'name' => 'dlrate_max',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'ulrate_max',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'downloaded',
				'type' => 'bigint',
				'size' => 30,
				'unsigned' => true,
			),
			array(
				'name' => 'uploaded',
				'type' => 'bigint',
				'size' => 30,
				'unsigned' => true,
			),
		),
		'indexes' => array(
			array(
				'name' => 'passkey',
				'type' => 'index',
				'columns' => array('passkey')
			),
		)
	),
	'tracker_category' => array(
		'name' => 'tracker_category',
		'columns' => array(
			array(
				'name' => 'id_category',
				'type' => 'int',
				'auto' => true,
				'unsigned' => true,
			),
			array(
				'name' => 'cat_name',
				'type' => 'varchar',
				'size' => 50,
			),
			array(
				'name' => 'cat_order',
				'type' => 'int',
			),
		),
		'indexes' => array(
			array(
				'type' => 'primary',
				'columns' => array('id_category')
			),
		),
	),
	'tracker_downloaders' => array(
		'name' => 'tracker_downloaders',
		'columns' => array(
			array(
				'name' => 'id_torrent',
				'type' => 'int',
				'auto' => true,
				'unsigned' => true,
			),
			array(
				'name' => 'id_member',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'start_time',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'complete_time',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'last_action',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'leech_time',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'seed_time',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'downloaded',
				'type' => 'bigint',
				'size' => 30,
				'unsigned' => true,
			),
			array(
				'name' => 'uploaded',
				'type' => 'bigint',
				'size' => 30,
				'unsigned' => true,
			),
			array(
				'name' => 'download_left',
				'type' => 'bigint',
				'size' => 30,
				'unsigned' => true,
			),
		),
		'indexes' => array(
			array(
				'type' => 'primary',
				'columns' => array('id_torrent', 'id_member')
			),
			array(
				'name' => 'id_member',
				'type' => 'index',
				'columns' => array('id_member')
			),
			array(
				'name' => 'id_torrent',
				'type' => 'index',
				'columns' => array('id_torrent')
			),
		),
	),
	'tracker_torrents' => array(
		'name' => 'tracker_torrents',
		'columns' => array(
			array(
				'name' => 'id_torrent',
				'type' => 'int',
				'auto' => true,
				'unsigned' => true,
			),
			array(
				'name' => 'id_category',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'name',
				'type' => 'varchar',
				'size' => 255,
			),
			array(
				'name' => 'torrentname',
				'type' => 'varchar',
				'size' => 255,
			),
			array(
				'name' => 'torrentfile',
				'type' => 'varchar',
				'size' => 255,
			),
			array(
				'name' => 'description',
				'type' => 'text',
			),
			array(
				'name' => 'info_hash',
				'type' => 'varchar',
				'size' => 60,
			),
			array(
				'name' => 'filesize',
				'type' => 'bigint',
				'size' => 20,
				'unsigned' => true,
			),
			array(
				'name' => 'files',
				'type' => 'text',
			),
			array(
				'name' => 'member_name',
				'type' => 'varchar',
				'size' => 60,
			),
			array(
				'name' => 'id_member',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'added',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'last_action',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'last_seeder',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'seeders',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'leechers',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'downloads',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'transfer',
				'type' => 'bigint',
				'size' => 30,
				'unsigned' => true,
			),
			array(
				'name' => 'is_disabled',
				'type' => 'int',
				'size' => 2,
				'unsigned' => true,
			),
			array(
				'name' => 'is_external',
				'type' => 'int',
				'size' => 2,
				'unsigned' => true,
			),
			array(
				'name' => 'external_tracker',
				'type' => 'varchar',
				'size' => 60,
			),
		),
		'indexes' => array(
			array(
				'type' => 'primary',
				'columns' => array('id_torrent')
			),
			array(
				'name' => 'info_hash',
				'type' => 'unique',
				'columns' => array('info_hash')
			),
		),
	),
	'tracker_peers' => array(
		'name' => 'tracker_peers',
		'columns' => array(
			array(
				'name' => 'peer_id',
				'type' => 'varchar',
				'size' => 60,
			),
			array(
				'name' => 'id_member',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'id_torrent',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'agent',
				'type' => 'varchar',
				'size' => 60,
			),
			array(
				'name' => 'event',
				'type' => 'varchar',
				'size' => 10,
			),
			array(
				'name' => 'last_action',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'ip',
				'type' => 'varchar',
				'size' => 24,
			),
			array(
				'name' => 'port',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'download_left',
				'type' => 'bigint',
				'size' => 20,
				'unsigned' => true,
			),
			array(
				'name' => 'downloaded',
				'type' => 'bigint',
				'size' => 20,
				'unsigned' => true,
			),
			array(
				'name' => 'uploaded',
				'type' => 'bigint',
				'size' => 20,
				'unsigned' => true,
			),
			array(
				'name' => 'dlrate',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'ulrate',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'dlrate_max',
				'type' => 'int',
				'unsigned' => true,
			),
			array(
				'name' => 'ulrate_max',
				'type' => 'int',
				'unsigned' => true,
			),
		),
		'indexes' => array(
			array(
				'type' => 'primary',
				'columns' => array('peer_id', 'id_member', 'id_torrent')
			),
			array(
				'name' => 'id_torrent',
				'type' => 'index',
				'columns' => array('id_torrent')
			)
		),
	),
);

/**
 * Creates tables based on array
 *
 * @param array $tables Array containing descriptions for tables
 * @param array $columnRename Array containing column renames
 * @return array Log of changes
 *
 * @since 0.1
 */
function doTables($tables, $columnRename = array())
{
	global $smcFunc, $db_prefix, $db_type, $db_show_debug;

	$log = array();
	$existingTables = $smcFunc['db_list_tables']();

	foreach ($tables as $table)
	{
		$table_name = $table['name'];

		$tableExists = in_array($db_prefix . $table_name, $existingTables);

		// Create table
		if (!$tableExists && empty($table['smf']))
			$smcFunc['db_create_table']('{db_prefix}' . $table_name, $table['columns'], $table['indexes']);
		// Update table
		else
		{
			$currentTable = $smcFunc['db_table_structure']('{db_prefix}' . $table_name);

			// Renames in this table?
			if (!empty($table['rename']))
			{
				foreach ($currentTable['columns'] as $column)
				{
					if (isset($table['rename'][$column['name']]))
					{
						$old_name = $column['name'];
						$column['name'] = $table['rename'][$column['name']];

						$smcFunc['db_change_column']('{db_prefix}' . $table_name, $old_name, $column);
					}
				}
			}

			// Global renames? (should be avoided)
			if (!empty($columnRename))
			{
				foreach ($currentTable['columns'] as $column)
				{
					if (isset($columnRename[$column['name']]))
					{
						$old_name = $column['name'];
						$column['name'] = $columnRename[$column['name']];
						$smcFunc['db_change_column']('{db_prefix}' . $table_name, $old_name, $column);
					}
				}
			}

			// Check that all columns are in
			foreach ($table['columns'] as $id => $col)
			{
				$exists = false;

				// TODO: Check that definition is correct
				foreach ($currentTable['columns'] as $col2)
				{
					if ($col['name'] === $col2['name'])
					{
						$exists = true;
						break;
					}
				}

				// Add missing columns
				if (!$exists)
					$smcFunc['db_add_column']('{db_prefix}' . $table_name, $col);
			}

			// Remove any unnecassary columns
			foreach ($currentTable['columns'] as $col)
			{
				$exists = false;

				foreach ($table['columns'] as $col2)
				{
					if ($col['name'] === $col2['name'])
					{
						$exists = true;
						break;
					}
				}

				if (!$exists && isset($table['upgrade']['columns'][$col['name']]))
				{
					if ($table['upgrade']['columns'][$col['name']] == 'drop')
						$smcFunc['db_remove_column']('{db_prefix}' . $table_name, $col['name']);
				}
				elseif (!$exists && !empty($db_show_debug) && empty($table['smf']))
					$log[] = sprintf('Table %s has non-required column %s', $table_name, $col['name']);
			}

			// Check that all indexes are in and correct
			foreach ($table['indexes'] as $id => $index)
			{
				$exists = false;

				foreach ($currentTable['indexes'] as $index2)
				{
					// Primary is special case
					if ($index['type'] == 'primary' && $index2['type'] == 'primary')
					{
						$exists = true;

						if ($index['columns'] !== $index2['columns'])
						{
							$smcFunc['db_remove_index']('{db_prefix}' . $table_name, 'primary');
							$smcFunc['db_add_index']('{db_prefix}' . $table_name, $index);
						}

						break;
					}
					// Make sure index is correct
					elseif (isset($index['name']) && isset($index2['name']) && $index['name'] == $index2['name'])
					{
						$exists = true;

						// Need to be changed?
						if ($index['type'] != $index2['type'] || $index['columns'] !== $index2['columns'])
						{
							$smcFunc['db_remove_index']('{db_prefix}' . $table_name, $index['name']);
							$smcFunc['db_add_index']('{db_prefix}' . $table_name, $index);
						}

						break;
					}
				}

				if (!$exists)
					$smcFunc['db_add_index']('{db_prefix}' . $table_name, $index);
			}

			// Remove unnecassary indexes
			foreach ($currentTable['indexes'] as $index)
			{
				$exists = false;

				foreach ($table['indexes'] as $index2)
				{
					// Primary is special case
					if ($index['type'] == 'primary' && $index2['type'] == 'primary')
						$exists = true;
					// Make sure index is correct
					elseif (isset($index['name']) && isset($index2['name']) && $index['name'] == $index2['name'])
						$exists = true;
				}

				if (!$exists)
				{
					if (isset($table['upgrade']['indexes']))
					{
						foreach ($table['upgrade']['indexes'] as $index2)
						{
							if ($index['type'] == 'primary' && $index2['type'] == 'primary' && $index['columns'] === $index2['columns'])
								$smcFunc['db_remove_index']('{db_prefix}' . $table_name, 'primary');
							elseif (isset($index['name']) && isset($index2['name']) && $index['name'] == $index2['name'] && $index['type'] == $index2['type'] && $index['columns'] === $index2['columns'])
								$smcFunc['db_remove_index']('{db_prefix}' . $table_name, $index['name']);
							elseif (!empty($db_show_debug))
								$log[] = $table_name . ' has Unneeded index ' . var_dump($index);
						}
					}
					elseif (!empty($db_show_debug))
						$log[] = $table_name . ' has Unneeded index ' . var_dump($index);
				}
			}
		}
	}

	if (!empty($log))
		log_error(implode('<br />', $log));

	return $log;
}

/**
 * Add settings based on array
 *
 * @param array $addSettings Array of settings to add
 * @return void
 *
 * @since 0.1
 */
function doSettings($addSettings)
{
	global $smcFunc, $modSettings;

	$update = array();

	foreach ($addSettings as $variable => $value)
	{
		list ($value, $overwrite) = $value;

		if ($overwrite || !isset($modSettings[$variable]))
			$update[$variable] = $value;
	}

	if (!empty($update))
		updateSettings($update);
}

/**
 * Add permissions based on array
 *
 * @param array $permissions Permissions to add
 * @return void
 *
 * @since 0.1
 */
function doPermission($permissions)
{
	global $smcFunc;

	$perm = array();

	foreach ($permissions as $permission => $default)
	{
		$result = $smcFunc['db_query']('', '
			SELECT COUNT(*)
			FROM {db_prefix}permissions
			WHERE permission = {string:permission}',
			array(
				'permission' => $permission
			)
		);

		list ($num) = $smcFunc['db_fetch_row']($result);

		if ($num == 0)
		{
			foreach ($default as $grp)
				$perm[] = array($grp, $permission);
		}
	}

	if (empty($perm))
		return;

	$smcFunc['db_insert']('insert',
		'{db_prefix}permissions',
		array(
			'id_group' => 'int',
			'permission' => 'string'
		),
		$perm,
		array()
	);
}

/**
 * Enables or disabled core features.
 *
 * @param string $item Feature
 * @param boolean $enabled Whatever to enable or disable feature
 * @return boolean Returns true on success
 *
 * @since 0.1
 */
function updateAdminFeatures($item, $enabled = false)
{
	global $modSettings;

	$admin_features = isset($modSettings['admin_features']) ? explode(',', $modSettings['admin_features']) : array('cd,cp,k,w,rg,ml,pm');

	if (!is_array($item))
		$item = array($item);

	if ($enabled)
		$admin_features = array_merge($admin_features, $item);
	else
		$admin_features = array_diff($admin_features, $item);

	updateSettings(array('admin_features' => implode(',', $admin_features)));

	return true;
}

?>