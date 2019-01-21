<?php
	$settings = array(
		'title' => esc_html__('Project Options', 'eonet-project-manager'),
		'type' => \ComponentProjectManager\classes\Eonet_PM_Project::POST_TYPE,
		'options' => array(
			array(
				'name'      => 'pm_starting_date',
				'type'      => 'datepicker',
				'label'     => __('Project starting date', 'eonet-project-manager'),
				'val'       => ''
			),
			array(
				'name'      => 'pm_ending_date',
				'type'      => 'datepicker',
				'label'     => __('Project ending date', 'eonet-project-manager'),
				'val'       => ''
			),
			array(
				'name'      => 'pm_progress_type',
				'type'      => 'select',
				'label'     => __('Calculate project progress by', 'eonet-project-manager'),
				'choices'  => array(
					'nothing'     => __('Nothing', 'eonet-project-manager'),
					'date'     => __('Date', 'eonet-project-manager'),
					'tasks'     => __('Tasks Completed', 'eonet-project-manager'),
				),
				'val'       => 'date'
			),
			array(
				'name'      => 'pm_tasks_enabled',
				'type'      => 'switch',
				'label'     => __('Enable tasks', 'eonet-project-manager'),
				'val'       => true
			),
			array(
				'name'      => 'pm_visibility_permissions',
				'type'      => 'select',
				'label'     => __('Who can see this project?', 'eonet-project-manager'),
				'choices'  => array(
					'default'     => __('Default', 'eonet-project-manager'),
					'project-members'     => __('Project Members', 'eonet-project-manager'),
					'everyone'     => __('Everyone', 'eonet-project-manager'),
				),
				'val'       => 'default'
			),
			array(
				'name'      => 'pm_editing_permissions',
				'type'      => 'select',
				'label'     => __('Who can edit the project?', 'eonet-project-manager'),
				'desc'     => __('(Project editing by frontend is still in BETA version and it needs the plugin Eonet Frontend Publisher)', 'eonet-project-manager'),
				'choices'  => array(
					'default'     => __('Default', 'eonet-project-manager'),
					'author'     => __('Only the author', 'eonet-project-manager'),
					'project-members'     => __('Project Members', 'eonet-project-manager'),
					'everyone'     => __('Everyone', 'eonet-project-manager'),
				),
				'val'       => 'default'
			),
		)
	);