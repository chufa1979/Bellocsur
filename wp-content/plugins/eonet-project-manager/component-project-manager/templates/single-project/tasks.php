<?php
/**
 * Single project section: Tasks
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/single-project/tasks.php.
 *
 * IMPORTANT: We will try to update this template file as little as possible,
 * but on occasion it will happens, above all in the early versions. When this happens,
 * you (the theme developer) will need to copy the new files to your theme to maintain compatibility.
 * If you want to avoid this, we strongly suggest you to use hooks when you can,
 * instead of override whole template files
 *
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="eo-project-tab eo-project-tab-tasks">

    <?php

        eopm_render_project_tasks_list();
	
		eopm_render_new_task_button();
	?>

</div>
