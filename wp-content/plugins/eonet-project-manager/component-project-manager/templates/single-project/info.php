<?php
/**
 * Single project section: Info
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/single-project/info.php.
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

global $project;
?>

<div class="eo-project-tab eo-project-tab-info">

    <div class="eo-project-info-box">
        <h4><?php _e('Project Details', 'eonet-project-manager') ?></h4>
        <div class="eo-project-info-box-content">
            <ul>
                <li><?php echo __('Starting date:', 'eonet-project-manager') . ' <strong>' . $project->getStartingDateToString() . '</strong>'; ?></li>
                <li><?php echo __('Ending date:', 'eonet-project-manager') . ' <strong>' . $project->getEndingDateToString() . '</strong>'; ?></li>
                <li><?php echo __('Progress tracking:', 'eonet-project-manager') . ' <strong>' . ucfirst($project->getProgressType()) . '</strong>'; ?></li>
                <li><?php echo __('Visibility:', 'eonet-project-manager') . ' <strong>' . $project->getVisibilityPermissions() . '</strong>'; ?></li>
                <li><?php echo __('Editing:', 'eonet-project-manager') . ' <strong>' . $project->getEditingPermissions() . '</strong>'; ?></li>
                <li>
                    <?php echo __('Tasks:', 'eonet-project-manager'); ?>
                    <?php if($project->getTasksEnabled()) : ?>
                        <strong><?php _e('Enabled', 'eonet-project-manager'); ?></strong>
                    <?php else : ?>
                        <strong><?php _e('Disabled', 'eonet-project-manager'); ?></strong>
                    <?php endif; ?>
                </li>
                <li><?php echo __('Categories:', 'eonet-project-manager') . ' <strong>' . get_the_term_list( $project->post->ID, 'project-category', '', ', ') . '</strong>'; ?></li>
                <li><?php echo __('Created:', 'eonet-project-manager') . ' <strong>' . date(get_option('date_format'), strtotime($project->post->post_date)) . '</strong>'; ?></li>
                <li><?php echo __('Modified:', 'eonet-project-manager') . ' <strong>' . date(get_option('date_format'), strtotime($project->post->post_modified)) . '</strong>'; ?></li>
            </ul>
        </div>
    </div>

    <?php if(count($project->getMembersFromDB()) > 0) : ?>
        <div class="eo-project-info-box">
            <h4><?php _e('Project Members', 'eonet-project-manager') ?></h4>
            <div class="eo-project-info-box-content">
                <?php eopm_project_members(false, true); ?>
            </div>
        </div>
    <?php endif; ?>

</div>
