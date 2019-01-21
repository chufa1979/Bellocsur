<?php
$pages = get_pages();

$choices = array('0' => 'Select Page...');
foreach( $pages as $page) {
	$choices[$page->ID] = $page->post_title;
}

$settings = array(
	array(
		'name'      => 'pm_projects_page_id',
		'type'      => 'select',
		'label'     => __('Projects Loop Page', 'eonet-project-manager'),
		'desc'      => __('After changin this option, you have to refresh your permalinks in Settings > Permalinks.', 'eonet-project-manager'),
		'choices'  => $choices,
		'val'       => '0'
	),
	array(
		'name'      => 'pm_general_visibility_permissions',
		'type'      => 'select',
		'label'     => __('Who can see the projects?', 'eonet-project-manager'),
		'desc'      => __('This permission can be changed in every single project.', 'eonet-project-manager'),
		'choices'  => array(
			'project-members'     => __('Project Members', 'eonet-project-manager'),
			'everyone'     => __('Everyone', 'eonet-project-manager'),
		),
		'val'       => 'project-members'
	),
	array(
		'name'      => 'pm_general_editing_permissions',
		'type'      => 'select',
		'label'     => __('Who can edit the projects?', 'eonet-project-manager'),
		'desc'      => __('(Project editing by frontend is still in BETA version and it needs the plugin Eonet Frontend Publisher)', 'eonet-project-manager') . __('This permission can be changed in every single project.', 'eonet-project-manager'),
		'choices'  => array(
			'author'     => __('Only the author', 'eonet-project-manager'),
			'project-members'     => __('Project Members', 'eonet-project-manager'),
			'everyone'     => __('Everyone', 'eonet-project-manager'),
		),
		'val'       => 'author'
	),
	array(
		'name'      => 'pm_general_create_tasks_permissions',
		'type'      => 'select',
		'label'     => __('Who can create a new task?', 'eonet-project-manager'),
		'choices'  => array(
			'author'     => __('Only the author', 'eonet-project-manager'),
			'project-members'     => __('Project Members', 'eonet-project-manager'),
			'everyone'     => __('Everyone', 'eonet-project-manager'),
		),
		'val'       => 'author'
	),
	array(
		'name'      => 'pm_general_check_tasks_permissions',
		'type'      => 'select',
		'label'     => __('Who can mark the tasks as completed?', 'eonet-project-manager'),
		'choices'  => array(
			'author'     => __('Only the author', 'eonet-project-manager'),
			'task-members'     => __('Members assigned to the task', 'eonet-project-manager'),
			'project-members'     => __('Project Members', 'eonet-project-manager'),
			'everyone'     => __('Everyone', 'eonet-project-manager'),
		),
		'val'       => 'task-members'
	),
);