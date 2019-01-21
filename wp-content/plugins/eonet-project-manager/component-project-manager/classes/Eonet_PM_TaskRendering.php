<?php
namespace ComponentProjectManager\classes;

use Eonet\Core\EonetOptions;

if ( ! defined('ABSPATH') ) die('Forbidden');

/**
 * Class Eonet_PM_TaskRendering
 *
 * Takes care of how we render a task, HTML, form, values...
 *
 * @package ComponentProjectManager\classes
 */


class Eonet_PM_TaskRendering
{

    /**
     * The task that'll be rendered
     * @var Eonet_PM_Task
     */
    private $task;

    /**
     * The assigned members
     * @var array
     */
    private $users_assigned = array();

    /**
     * Eonet_PM_TasksRendering constructor.
     * @param Eonet_PM_Task $task
     */
    public function __construct(Eonet_PM_Task $task = null) {

        $this->task = $task;

    }

    /**
     * Returns the task's title
     * Can be useful to set a default value
     * @return string
     */
    private function getTitle() {
        return (!empty($this->task) && !empty($this->task->post->post_title)) ? $this->task->post->post_title : __('New Task', 'eonet-project-manager');
    }

    /**
     * Returns the task's ID
     * Can be useful to set a random value
     * @return int
     */
    private function getId(){
        return (isset($this->task->post->ID)) ? $this->task->post->ID : 0;
    }

    /**
     * Get assigned members and render them
     * @return string
     */
    private function getAssignedMembers() {
        $html = '';
        if (!empty($task)) {
            $members_assigned_ids = $this->task->getMembersAssigned();
            foreach ($members_assigned_ids as $member) {
                $user = get_userdata($member);
                array_push($this->users_assigned, $user);
                $html .= get_avatar($user->ID, 32);
                $html .= $user->user_firstname . ' ' . $user->last_name . '(' . $user->user_login . ')';
            }
        }
        return $html;
    }

    /**
     * Get an array of ready to use options for the EonetOptions class
     * @return array
     */
    private function getOptions() {

        $task_options = array();

        $task_options[] = array(
            'name' => eopm_get_task_option('id', $this->getId()),
            'type' => 'hidden',
            'val' => $this->getId()
        );

        $task_options[] = array(
            'name' => eopm_get_task_option('title', $this->getId()),
            'type' => 'text',
            'label' => __('Title', 'eonet-project-manager'),
            'val' => $this->getTitle()
        );

        $task_options[] = array(
            'name' => eopm_get_task_option('content', $this->getId()),
            'type' => 'textarea',
            'label' => __('Description', 'eonet-project-manager'),
            'val' => (!empty($this->task) && isset($this->task->post)) ? $this->task->post->post_content : ''
        );

        $task_options[] = array(
            'name' => eopm_get_task_option('done', $this->getId()),
            'type' => 'switch',
            'label' => __('Done', 'eonet-project-manager'),
            'val' => (!empty($this->task)) ? $this->task->getIsDone() : false
        );

        $task_options[] = array(
            'name' => eopm_get_task_option('urgent', $this->getId()),
            'type' => 'switch',
            'label' => __('Urgent', 'eonet-project-manager'),
            'val' => (!empty($this->task)) ? $this->task->getIsUrgent() : false
        );

	    $expiration = '';
	    if(!empty($this->task)) {
		    $expiration_datetime =  $this->task->getExpiration();
		    if($expiration_datetime instanceof \DateTime)
			    $expiration = $expiration_datetime->format('Y-m-d');
	    }

	    $task_options[] = array(
            'name' => eopm_get_task_option('expiration', $this->getId()),
            'type' => 'datepicker',
            'label' => __('Expiration', 'eonet-project-manager'),
            'val' => $expiration
        );

        return $task_options;

    }

    /**
     * Members fetcher option
     * Could be merged in EonetOptions later
     * @return string
     */
    private function getMembersFetcher() {

        $members_assigned_ids = (!empty($this->task)) ? $this->task->getMembersAssigned() : array();
        $members_assigned_string_ids = implode(',', $members_assigned_ids);
        $option_name = 'eo_field_'. eopm_get_task_option('members', $this->getId());

	    $members_assigned = ($this->task instanceof Eonet_PM_Task) ? $this->task->getMembersAssigned() : array();

        $html = '';
        $html .= '<div class="eo_form_field eonet-suggest-user-wrap">';
	        $html .= '<div class="eo_field_wrapper">';
	            $html .= '<label class="eo_field_label" for="'.$option_name.'">'. __('Assign user(s)', 'eonet-project-manager') .'</label>';
	            $html .= '<div class="eo_field_container">';
	                $html .= '<input class="eonet-project-new-members-of-task eonet-suggest-user eo_field eo_field_text" type="text"
	                                               placeholder="' . esc_attr__('Enter a comma-separated list of user logins.', 'eonet-project-manager') . '"/>';
	                $html .= '<input name="' .$option_name. '" class="eonet-project-new-members-ids" type="hidden" value="[' . $members_assigned_string_ids . ']"/>';
	                $html .= '<ul class="eonet-project-new-members-list">';
	                foreach ($members_assigned as $user_id) {
		                $user = get_userdata($user_id);
	                    $html .= '<li data-login="' . $user->ID . '"><a href="javascript:void(0)" class="eonet-project-remove-new-member"><i class="ion-ios-close"></i></a> ' . $user->last_name . '(' . $user->user_login . ')' . '</li>';
	                }
	                $html .= '</ul>';
	            $html .= '</div>';
	        $html .= '</div>';
        $html .= '</div>';

        return $html;

    }

	/**
	 * Get the frontend layout for the instanced task
	 *
	 * @return string
	 */
	public function getFrontendLayout() {
		$this->task->loadAllMetaValues();

		$task_done_class = ($this->task->getIsDone()) ? 'ion-android-checkbox' : 'ion-android-checkbox-outline-blank';
		$expiration_string = ($this->task->getExpirationToString()) ? '<i class="ion-ios-calendar-outline"></i>'.$this->task->getExpirationToString() : '';
		$is_urgent_string = ($this->task->getIsUrgent()) ? '<i class="ion-alert"></i>' . esc_html_x('Urgent', 'Description of the flag in single task frontend', 'eonet-{{COMPONENT-GULP}}') : '';
		ob_start();

		?>
		<div class="eopm-single-task" data-task-id="<?php echo $this->task->post->ID; ?>" >

			<div class="eopm-single-task__head eo_clearfix">
				<ul class="eopm-single-task__head__title-wrap">
	                <?php $user_can_check = ($this->task->permissions()->userCanCheck()) ? 'eo-user-can-check' : ''; ?>
					<li class="eopm-single-task--done <?php echo $user_can_check; ?>">
						<i class="<?php echo $task_done_class ?>"></i>
					</li>
					<li class="eopm-single-task__title">
						<?php echo $this->task->post->post_title; ?>
					</li>
				</ul>

				<div class="eo_pull_right eo_clearfix">
					<?php
					if(!empty($this->task->post->post_content)) {
					echo '<div><a href="javascript:void(0)" class="eopm-single-task__head__details-trigger"><i class="ion-document-text"></i></a></div>';
					}
					?>

					<?php
					$task_members = $this->task->getMembersAssigned();
					if(!empty($task_members) && is_array($task_members)) {
						echo '<div><ul class="eopm-single-task__head__members-list eo_clearfix">';
						foreach ($task_members as $id) {
							$user_link = (function_exists('bp_core_get_user_domain')) ? bp_core_get_user_domain($id) : '';
							$user = get_userdata($id);
							echo '<li class="eo_project_single_task_member eo_tooltip"><span class="eo_tooltip_text">'.$user->display_name.'</span>';

							if( $user_link )
								echo '<a href="'.$user_link.'">';

							echo get_avatar($id, 32);

							if( $user_link )
								echo '</a>';

							echo '</li>';
						}
						echo '</ul></div>';
					}
					?>
					
					<div class="eo_single_task_handle_drag_wrap">
						
					</div>
				</div>
			</div>

			<div class="eopm-single-task__primary-details">
				<ul>
					<?php
					if(!empty($is_urgent_string)) {
						echo '<li class="eopm-single-task__urgent-string">';
						echo $is_urgent_string;
						echo '</li>';
					}
					if(!empty($expiration_string)) {
						echo '<li class="eopm-single-task__expiration-time">';
						echo $expiration_string;
						echo '</li>';
					}
					?>
				</ul>

			</div>

			<?php
			$task_content = $this->task->post->post_content;
			if(!empty($task_content)) :
				echo '<div class="eopm-single-task__details">';
				echo '<div class="eopm-single-task__details__title">'. __('Details:', 'eonet-project-manager') . '</div>';

				//TODO add created by, created on, and more details

				if(!empty($task_content)) {
					echo '<p>', $task_content, '</p>';
				}
				echo '</div> <!-- .eopm-single-task__details -->';
			endif;

			echo $this->getActionButtonsLayout();

			?>

		</div>

		<?php

		return ob_get_clean();
	}

	/**
	 * Get layout of the fields to create a new task
	 *
	 * @return string
	 */
	public static function getCreatingLayout() {

		$new_static = new Eonet_PM_TaskRendering();
		ob_start();
		?>
		<div id="eopm-task-creation">
		    <button id="eo-create-new-task-trigger" class="eo_btn eo_btn_default eo-create-task-trigger"><?php esc_html_e('Create new task', 'eonet-project-manager'); ?></button>

		    <div class="eopm-task-creation__fields eopm-task-fields">

				<div class="eo-create-task-fields eo-create-task-fields">

					<?php echo $new_static->getCreatingFields(); ?>

					<?php echo $new_static->getSubmit( array('id' => 'eo-create-task-submit') ); ?>

				</div>

			    </div> <!-- .eopm-task-creation__fields -->
			</div> <!-- .eopm-task-creation -->
		<?php

		return ob_get_clean();
	}

    /**
     * Get the backend layout for the instanced task (used in wp dashboard)
     *
     * @return string HTML markup
     */
    public function getBackendLayout()
    {

        $html = '';

        $html .= '<div class="eopm-tasks-metabox__item">';

            $html .= '<div class="eopm-tasks-metabox__item__header eo_clearfix">';

                $html .= '<div class="eopm-tasks-metabox__item__title"><h4>' . $this->getTitle() . '</h4></div>';

                $html .= '<div class="eopm-tasks-metabox__item__members">';

                    $html .= $this->getAssignedMembers();

                $html .= '</div>';

                $html .= '<div class="eopm-tasks-metabox__item__remove-button"><a class="eonet-project-task-remove-button" href="javascript:void(0)"><i class="ion-ios-close-outline"></i></a></div>';

            $html .= '</div>';

            $html .= '<div class="eopm-tasks-metabox__item__body eo_clearfix">';

			$html .= $this->getEditingFields();

            $html .= '</div>';

        $html .= '</div>';

        return $html;

    }

	/**
	 * Get HTML layout for the actions available on the current task from the current user
	 *
	 * @return string
	 */
	protected function getActionButtonsLayout() {

		$user_can_edit = $this->task->permissions()->userCanEdit();
		$user_can_delete = $this->task->permissions()->userCanDelete();

		if(!$user_can_edit && !$user_can_delete)
			return '';

		ob_start();

		echo '<div class="eopm-single-task__actions-buttons">';

		echo '<div class="eo-actions-task-buttons">';

		if($user_can_edit) {
//			echo '<button class="eo_btn eo_btn_default eo_btn_extrasmall eo-edit-task-trigger"><i class="ion-edit"></i> ' . esc_html__('Edit', 'eonet-project-manager') . '</button>';
			echo '<button class="eo_btn eo_btn_default eo_btn_extrasmall eo-edit-task-trigger"><i class="ion-edit"></i></button>';
		}

		if($user_can_delete) {
//			echo '<button class="eo_btn eo_btn_default eo_btn_extrasmall eo-delete-task-trigger"><i class="ion-trash-a"></i> ' . esc_html__('Delete', 'eonet-project-manager') . '</button>';
			echo '<button class="eo_btn eo_btn_default eo_btn_extrasmall eo-delete-task-trigger"><i class="ion-trash-a"></i></button>';
		}

		echo '</div> <!-- .eo-actions-task-buttons -->';

		echo '<div class="eo-actions-task-body">';

		if($user_can_edit) {
			echo '<div class="eopm-single-task__editing-fields eopm-task-fields">';
			echo $this->getEditingFields();
			echo $this->getSubmit();
			echo '</div>';
		}

		echo '</div> <!-- .eo-actions-task-body -->';

		echo '</div> <!-- .eopm-single-task__actions-buttons -->';

		return ob_get_clean();
	}

	/**
	 * Get the fields of the form to edit a task
	 *
	 * @return string
	 */
	protected function getEditingFields(){
		ob_start();

		echo EonetOptions::renderForm($this->getOptions());

		echo $this->getMembersFetcher();

		return ob_get_clean();
	}

	/**
	 * Get the fields of the form to create a new task
	 *
	 * @return string
	 */
	protected function getCreatingFields(){
		ob_start();

		$creating_options = $this->prepareOptionsForCreation($this->getOptions());
		echo EonetOptions::renderForm($creating_options);

		echo $this->getMembersFetcher();

		return ob_get_clean();
	}

	/**
	 * Return the layout of the checkbox to change the status of a task (completed/not completed) in the frontend
	 *
	 * @param bool $checked
	 *
	 * @return string
	 */
	protected function getCompleteCheckbox($checked = null){

		if(is_null($checked))
			$checked = $this->task->getIsDone();

		ob_start();
		?>
		<div class="eonet-project-complete-task-wrap">
			<input
				id="eo-task-check-status-<?php echo $this->task->post->ID; ?>"
				name="eo-task-check-status-<?php echo $this->task->post->ID; ?>"
				type="checkbox" value="1"
				class="eo-task-check-status" <?php checked($checked) ?>>

			<label for="eo-task-check-status-<?php echo $this->task->post->ID; ?>"><?php echo esc_html_x('Completed', 'Label of the checkbox', 'eonet-project-manager')?></label>

		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Return the HTML of a button
	 *
	 * @param array $args [id, class, name, text,data-task-id]
	 *
	 * @return string
	 */
	protected function getSubmit( $args = array()) {

		$defaults = array(
			'id' => '',
			'class' => '',
			'name' => 'submit-task',
			'text' => esc_html__('Save task', 'eonet-project-manager'),
		);
		$settings = wp_parse_args( $args, $defaults );

		$data_task_id_attr = (!empty($settings['data-task-id'])) ? 'data-task-id="'.$settings['data-task-id'].'"' : '';
		$id_attr = (!empty($settings['id'])) ? 'id="'.$settings['id'].'"' : '';

		return '<button '.$id_attr.' name="' . $settings['name'] . '" ' . $data_task_id_attr.' class="eo_btn eo_btn_default eo-submit-task '.$settings['class'].'">'.$settings['text'].'</button>';
	}

	/**
	 * Parse the options for the task fields and change the id attributes,
	 * in order to have a valid form for the creation of a new task
	 *
	 * @param $options
	 *
	 * @return mixed
	 */
	protected function prepareOptionsForCreation( $options ) {
		foreach ($options as &$option) {
			$option = str_replace('s_assigned[0][', '_', $option);
			$option = str_replace(']', '', $option);
		}

		return $options;
	}
}