<?php
use ComponentProjectManager\classes\Eonet_PM_Member;
use ComponentProjectManager\classes\Eonet_PM_Project;

/**
 * Add the metaboxes that handle the members
 */
function eopm_add_metaboxes() {
	add_meta_box( 'eonet_project_add_members', _x( 'Add New Members', 'project admin edit screen', 'eonet-project-manager' ), 'eonet_project_manager_render_metabox_add_new_members', 'eonet_project', 'normal', 'core' );
	add_meta_box( 'eonet_project_members', _x( 'Manage Members', 'project admin edit screen', 'eonet-project-manager' ), 'eonet_project_manager_render_metabox_members', 'eonet_project', 'normal', 'core' );
}
add_action( 'add_meta_boxes', 'eopm_add_metaboxes' );

/**
 * Output the markup for a single project's Add New Members metabox.
 *
 * @param WP_Post $post The post object where the metabox is applyed
 */
function eonet_project_manager_render_metabox_add_new_members( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'eonet_members_nonce' );
	?>

	<label for="eonet-project-new-members" class="screen-reader-text"><?php
		/* translators: accessibility text */
		_e( 'Add new members', 'eonet-project-manager' );
		?></label>
	<div class="eonet-suggest-user-wrap">
		<input name="eonet-project-new-members" id="eonet-project-new-members" class="eonet-suggest-user"
	       placeholder="<?php esc_attr_e( 'Enter a comma-separated list of user logins.', 'eonet-project-manager' ) ?>"/>
		<input name="eonet-project-new-members-ids" class="eonet-project-new-members-ids" type="hidden"/>
		<ul class="eonet-project-new-members-list"></ul>
	</div>
	<?php
}

/**
 * Renders the Members metabox on single project pages.
 * This Metabox is displayed only on editing of a project, not on creation.
 *
 * @param WP_Post $item The post object where the metabox is applyed
 */
function eonet_project_manager_render_metabox_members( $post ) {

	// Pull up a list of project members, so we can separate out the types
	$roles_available = Eonet_PM_Member::getMemberRolesAvailables();
	$members         = array();

	foreach ( $roles_available as $role ) {
		$members[ $role ] = array();
	}

	$project              = new Eonet_PM_Project( $post->ID );
	$members_assigned_ids = $project->getMembersFromDB();

	//We get all members of the project
	$post_author_id = $post->post_author;
	foreach ( $members_assigned_ids as $id => $member_type ) {

		if ( $id == $post_author_id ) {
			continue;
		}

		array_push( $members[ $member_type ], get_userdata( $id ) );
	}
	//We ensurethat the author of the project is displayed as administrator
	array_push( $members[ Eonet_PM_Member::ROLE_ADMIN_ID ], get_userdata( $post_author_id ) );

	// Echo out the JavaScript variable.
	echo '<script type="text/javascript">var project_id = "' . esc_js( $post->id ) . '";</script>';

	// Loop through each member type.
	foreach ( $members as $member_type => $type_users ) : ?>

		<div class="eonet-project-member-type"
		     id="eonet-project-member-type-<?php echo esc_attr( $member_type ) ?>">

			<h3><?php switch ( $member_type ) :
					case Eonet_PM_Member::ROLE_ADMIN_ID  :
						esc_html_e( 'Administrators', 'eonet-project-manager' );
						break;
					case Eonet_PM_Member::ROLE_MEMBER_ID :
						esc_html_e( 'Members', 'eonet-project-manager' );
						break;
				endswitch; ?></h3>

			<?php if ( ! empty( $type_users ) ) : ?>

				<table class="widefat eonet-project-members">
					<thead>
					<tr>
						<th scope="col"
						    class="uid-column"><?php _ex( 'ID', 'Project member user_id in project admin', 'eonet-project-manager' ); ?></th>
						<th scope="col"
						    class="uname-column"><?php _ex( 'Name', 'Project member name in project admin', 'eonet-project-manager' ); ?></th>
						<th scope="col"
						    class="urole-column"><?php _ex( 'Group Role', 'Project member role in project admin', 'eonet-project-manager' ); ?></th>
					</tr>
					</thead>

					<tbody>

					<?php foreach ( $type_users as $user ) : ?>
						<tr>
							<th scope="row" class="uid-column"><?php echo esc_html( $user->ID ); ?></th>

							<td class="uname-column">
								<?php $avatar = get_avatar( $user->ID, 32 );

								if ( function_exists( 'bp_core_get_user_domain' ) ) {
									$avatar = '<a style="float: left;" href="' . bp_core_get_user_domain( $user->ID ) . '">' . $avatar . '</a>';
								} else {
									$avatar = '<div style="float: left;" >' . $avatar . '</div>';
								}


								echo $avatar;
								?>

								<span
									style="margin: 8px; float: left;"><?php echo $user->first_name . ' ' . $user->last_name . '(' . $user->user_login . ')'; ?></span>
							</td>

							<td class="urole-column">
								<label for="eonet-project-role-<?php echo esc_attr( $user->ID ); ?>"
								       class="screen-reader-text"><?php
									/* translators: accessibility text */
									_e( 'Select group role for member', 'eonet-project-manager' );
									?></label>

								<?php if ( $user->ID == $post_author_id ):
									esc_html_e( 'Administrator', 'eonet-project-manager' );
								else: ?>
									<select class="eonet-project-role"
									        id="eonet-project-role-<?php echo esc_attr( $user->ID ); ?>"
									        name="eonet-project-role[<?php echo esc_attr( $user->ID ); ?>]">
										<optgroup
											label="<?php esc_attr_e( 'Roles', 'eonet-project-manager' ); ?>">
											<option class="admin" value=""
											        disabled="disabled"><?php esc_html_e( 'Administrator', 'eonet-project-manager' ); ?></option>
											<option class="editor" value=""
											        disabled="disabled"><?php esc_html_e( 'Editor', 'eonet-project-manager' ); ?></option>
											<option class="member"
											        value="<?php echo Eonet_PM_Member::ROLE_MEMBER_ID; ?>" <?php selected( Eonet_PM_Member::ROLE_MEMBER_ID, $member_type ); ?>><?php esc_html_e( 'Member', 'eonet-project-manager' ); ?></option>
										</optgroup>
										<optgroup
											label="<?php esc_attr_e( 'Actions', 'eonet-project-manager' ); ?>">
											<option class="remove"
											        value="remove"><?php esc_html_e( 'Remove', 'eonet-project-manager' ); ?></option>
										</optgroup>
									</select>
								<?php endif; ?>

							</td>
						</tr>

					<?php endforeach; ?>

					</tbody>
				</table>

			<?php else : ?>

				<p class="eonet-project-no-members description"><?php esc_html_e( 'No members of this type', 'eonet-project-manager' ); ?></p>

			<?php endif; ?>

		</div><!-- .eonet-project-member-type -->

	<?php endforeach;
}

/**
 * Saves the custom meta input
 *
 * @param int $post_id
 */
function eonet_project_manager_save_new_members_metabox( $post_id ) {

	// Checks save status
	$is_autosave    = wp_is_post_autosave( $post_id );
	$is_revision    = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['eonet_members_nonce'] ) && wp_verify_nonce( $_POST['eonet_members_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	// Checks for input and sanitizes/saves if needed
	if ( ! isset( $_POST['eonet-project-new-members-ids'] ) || ! is_string( $_POST['eonet-project-new-members-ids'] ) ) {
		return;
	}

	$members_ids = json_decode( $_POST['eonet-project-new-members-ids'] );

	if ( empty( $members_ids ) ) {
		return;
	}

	$project = new Eonet_PM_Project();
	$project->getMembersFromDB();

	foreach ( $members_ids as $id ) {
		$project->membersCollection->updateMember( $id );
	}

	$project->updateMembersIntoDB();

}
add_action( 'save_post_'.Eonet_PM_Project::POST_TYPE, 'eonet_project_manager_save_new_members_metabox' );

/**
 * Handle the action on members already present in the project
 *
 * @param int $post_id
 */
function eonet_project_manager_update_members_roles( $post_id ) {
	//TODO: add nounce
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );

	if ( $is_autosave || $is_revision ) {
		return;
	}

	// Checks for input and sanitizes/saves if needed
	//if( !isset( $_POST[ 'eonet-project-new-members-ids' ] ) || !is_string($_POST[ 'eonet-project-new-members-ids' ]) ) {
	if ( ! isset( $_POST['eonet-project-role'] ) ) {
		return;
	}

	$new_members_actions = $_POST['eonet-project-role'];

	$project = new Eonet_PM_Project( $post_id );

	//Load the members from the db
	$project->getMembersFromDB();

	foreach ( $new_members_actions as $id => $action ) {
		if ( $action == 'remove' ) {
			$project->membersCollection->remove( $id );
		}
	}

	//Save the new members in the db
	$project->updateMembersIntoDB();

}
add_action( 'save_post_'.Eonet_PM_Project::POST_TYPE, 'eonet_project_manager_update_members_roles' );