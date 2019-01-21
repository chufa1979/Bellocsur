<?php
/**
 * Let's init the component properly :
 * We load the classes :
 */

if(defined('Eonet')) {

    add_action('plugins_loaded', 'eonet_component_init_project_manager');

    function eonet_component_init_project_manager()
    {

        // Classes to load :
        $component_classes = array(
            'ComponentProjectManager\EonetProjectManager',
	        'ComponentProjectManager\classes\Eonet_PM_PermissionInterface',
            'ComponentProjectManager\classes\Eonet_PM_TemplateLoader',
            'ComponentProjectManager\classes\Eonet_PM_Security',
	        'ComponentProjectManager\classes\Eonet_PM_Project',
	        'ComponentProjectManager\classes\Eonet_PM_ProjectPermission',
	        'ComponentProjectManager\classes\Eonet_PM_MembersCollection',
	        'ComponentProjectManager\classes\Eonet_PM_Member',
	        'ComponentProjectManager\classes\Eonet_PM_Task',
	        'ComponentProjectManager\classes\Eonet_PM_TasksCollection',
	        'ComponentProjectManager\classes\Eonet_PM_TaskPermission',
	        'ComponentProjectManager\classes\Eonet_PM_TaskBelongsToProject',
	        'ComponentProjectManager\classes\Eonet_PM_TaskRendering',
	        'ComponentProjectManager\classes\Eonet_PM_AjaxManager'
        );
        // Load them :
        foreach ($component_classes as $class) {
            eonet_autoload($class);
        }
        // Fire it !
	    eonet_project_manager();


	    // Hook it
        do_action('eonet_component_after_init_project_manager');

    }

	if(!function_exists('eonet_project_manager')) {
		/**
		 * Return the static instance of the class, in this way the class is instanced only one time and ae avoided actions doubled
		 *
		 * @return \ComponentProjectManager\EonetProjectManager
		 */
		function eonet_project_manager() {
			return \ComponentProjectManager\EonetProjectManager::instance();
		}
	}

}
