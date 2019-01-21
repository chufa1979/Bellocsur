(function($) {
    "use strict";

    /**
     * Project Manager Tasks Component
     * Handles all js actions related to the tasks
     */
    $.eoTasks = function () {

        var inst = this;

        /**
         * Helper Elements
         */
        inst.tasksList = $('#eopm-tasks-metabox');
        inst.newTaskTrigger = $('#submit-new-task');
        inst.taskTemplate = EONET_PROJECTS.task_template;
        inst.membersAdded = [];

        /**
         * Add new task
         */
        inst.newTask = function () {

            // We append the task at the end:
            inst.tasksList.append(inst.makeUnique(inst.taskTemplate));

            // We get the element:
            var lastTaskEl = inst.tasksList.find('.eopm-tasks-metabox__item').last();

            // We refresh our variable's content
            inst.tasksList = $(inst.tasksList.selector);

            // Accordion
            inst.tasksList.accordion( "refresh" );
            var nextTab= inst.tasksList.find("div.eopm-tasks-metabox__item__header").length - 1;
            inst.tasksList.accordion("option","active", nextTab);

            // Datepicker:
            //lastTaskEl.find('input[name$=\'expiration]\'].eo_field_datepicker').datepicker({ dateFormat: 'yy-mm-dd' });

            // Switch inputs:
            $.eonetForms();

            // Refresh live titles:
            inst.liveTitlesWatcher();

            // Refresh delete watcher
            inst.deleteWatcher();

        };

        /**
         * Live Titles
         * Mirror the title when we're typing the title input
         */
        inst.liveTitlesWatcher = function() {

            inst.tasksList.find('input[name$=\'title]\'].eo_field_text').on('keyup', function() {

                var title = $(this).val(),
                    task = $(this).closest('.eopm-tasks-metabox__item');

                task.find('.eopm-tasks-metabox__item__title h4').html(title);

            });

        };

        /**
         * Delete Task Watcher
         */
        inst.deleteWatcher = function () {

            inst.tasksList.find('.eonet-project-task-remove-button').on('click', function(){

                var response = confirm('Are you sure you want to delete this task?');

                if (response == true) {

                    var task = $(this).closest('.eopm-tasks-metabox__item');

                    task.fadeOut();
                    setTimeout(function () {
                        task.remove();
                    }, 500);

                }

            });

        };

        /**
         * Make the task template unique
         * So we can add some JS plugins (datepicket for instance)
         * and it won't affect other tasks
         */
        inst.makeUnique = function (taskTemplate) {

            var uniqueId = Math.floor(Math.random() * (10000 - 1)) + 1,
                uniqueTaskTemplate = taskTemplate.replace(/[0]/g, "new-"+uniqueId);

            return uniqueTaskTemplate;

        };

        /**
         * Initialize the tasks
         */
        inst.init = function() {

            // Date pickers:
            //inst.tasksList.find('input[name$=\'expiration]\'].eo_field_datepicker').datepicker({ dateFormat: 'yy-mm-dd' });

            // Accordion:
            inst.tasksList.accordion({ header : '.eopm-tasks-metabox__item__header', collapsible : true,  active: false });

            // Sortable Init:
            inst.tasksList.sortable();

            // Live titles:
            inst.liveTitlesWatcher();

            // Delete task watcher
            inst.deleteWatcher();

            // On new task event
            inst.newTaskTrigger.on('click', function(e){
                e.preventDefault();
                inst.newTask();
            });

        };

        /**
         * Dom Update
         * @link http://stackoverflow.com/questions/14090495/how-to-update-a-jquery-object-stored-in-a-variable-after-dom-change
         */
        inst.domRefresh = function(El) {
            var newElements = $(El.selector),i;
            for(i=0;i<newElements.length;i++){
                El[i] = newElements[i];
            }
            for(;i<this.length;i++){
                El[i] = undefined;
            }
            El.length = newElements.length;
            return this;
        };

        /**
         * Add new member to the assigned input:
         */
        inst.add_member_to_list = function ( e, ui ) {

            //Add the user to the visible list
            var $parent = $(e.target).closest('div');

            $parent.find('.eonet-project-new-members-list').first().append('<li data-login="' + ui.item.value + '"><a href="#" class="eonet-project-remove-new-member"><i class="ion-ios-close"></i></a> ' + ui.item.label + '</li>');

            //Add the id of the member to an hidden input
            inst.membersAdded = $parent.find('.eonet-project-new-members-ids').val();
            inst.membersAdded = (!inst.membersAdded.trim()) ? [] : JSON.parse($parent.find('.eonet-project-new-members-ids').val());
            inst.membersAdded.push(ui.item.value);

            $parent.find('.eonet-project-new-members-ids').first().val(JSON.stringify(inst.membersAdded));

        };

        inst.init();

    };

    /**
     * Project Tabs (Frontend)
     * It's the navigation ones
     */
    $.eoTabs = function () {

        var inst = this;

        /**
         * Helper Elements
         * Could be change later to fit in every Eonet component
         */
        inst.tabWrapper = $('.eo-project-content');
        inst.tabNav = $('.eo-project-nav ul');
        inst.tabSelector = '.eo-project-tab';

        /**
         * Set a default active class and hide other tabs
         */
        inst.defaultActive = function() {

            if(inst.tabNav.find('li.is-active').length == 0) {

                inst.tabNav.find('li').first().addClass('is-active');
                inst.tabWrapper.find(inst.tabSelector).first().addClass('is-active');

            }

            inst.tabWrapper.find(inst.tabSelector).each(function () {

               if(!$(this).hasClass('is-active'))
                   $(this).hide()

            });

        };

        /**
         * Toggle a tab after a click on the navigation
         * @param slug string
         */
        inst.toggleTab = function(slug) {

            inst.tabNav.find('li.is-active').removeClass('is-active');
            inst.tabWrapper.find(inst.tabSelector + '.is-active').slideUp();
            inst.tabWrapper.find(inst.tabSelector + '.is-active').removeClass('is-active');

            inst.tabNav.find('a[data-eo-slug="'+slug+'"]').parent().addClass('is-active');
            inst.tabWrapper.find(inst.tabSelector+'-'+slug).addClass('is-active');
            inst.tabWrapper.find(inst.tabSelector+'-'+slug).slideDown();


        };

        /**
         * Initialize the tabs
         */
        inst.init = function() {

            inst.defaultActive();

            inst.tabNav.find('a').on('click', function (e) {

                e.preventDefault();

                inst.toggleTab($(this).data('eo-slug'));

            });

        };

        inst.init();

    };

    /**
     * Handle the autocomplete members for every input field in the page with the right HTML layout and attributes
     */
    $.eoMembersAtuocompleteWatcher = function () {
        var $body = $( 'body' ),
            inst = this;

        inst.init = function() {
            inst.keyDownWatcher();

            inst.removeMemberWatcher();
        };

        /**
         * Listen the keydown of the fields and fetch the suggested members
         */
        inst.keyDownWatcher = function() {
            $body.on('keydown.autocomplete', '.eonet-suggest-user', function() {
                //console.log('Triggered autocomplete members fetcher');
                $(this).autocomplete({
                    source: eopm_ajax_object.ajax_url + '?action=eonet_project_admin_member_autocomplete',
                    delay: 500,
                    minLength: 2,
                    position: ( 'undefined' !== typeof isRtl && isRtl ) ? {
                        my: 'right top',
                        at: 'right bottom'
                    } : {
                        my: 'left top',
                        at: 'left bottom'
                    },
                    open: function () {
                        $(this).addClass('open');
                    },
                    close: function () {
                        $(this).removeClass('open');
                        $(this).val('');
                    },
                    select: function (event, ui) {
                        inst.add_member_to_list(event, ui);
                    }
                });
            });
        };

        /**
         *  Remove a member on 'x' click
         */
        inst.removeMemberWatcher = function() {
            $body.on( 'click', '.eonet-project-new-members-list .eonet-project-remove-new-member', function( e ) {
                e.preventDefault();

                var $parent = $(e.target).closest('.eonet-suggest-user-wrap');

                //Remove the item
                $( $(e.target).closest('li') ).remove();

                //Update the hidden field containing all ids
                var users_to_add = [];
                $parent.find('.eonet-project-new-members-list li').each( function() {
                    users_to_add.push( $(this).data('login' ) );
                } );
                $parent.find('.eonet-project-new-members-ids').first().val('').val(JSON.stringify(users_to_add));

            } );
        };

        /**
         * Add the id of the member to an hidden input field
         *
         * @param e
         * @param ui
         */
        inst.add_member_to_list = function( e, ui ) {
            //Add the user to the visible list
            var $parent = $(e.target).closest('div');

            $parent.find('.eonet-project-new-members-list').first().append('<li data-login="' + ui.item.value + '"><a href="#" class="eonet-project-remove-new-member"><i class="ion-ios-close"></i></a> ' + ui.item.label + '</li>');

            //Add the id of the member to an hidden input
            var members_added = $parent.find('.eonet-project-new-members-ids').val();
            members_added = (!members_added.trim()) ? [] : JSON.parse($parent.find('.eonet-project-new-members-ids').val());
            members_added.push(ui.item.value);

            $parent.find('.eonet-project-new-members-ids').first().val(JSON.stringify(members_added));
        };

        inst.init();
    };

    $.eoFrontendTasksManager = function() {

        var inst = this,
            $tasks_list_container = $('.eopm-tasks-list'),
            project_id = $('#eonet-project').attr('data-project-id');


        inst.init = function() {

            //Show the editing fields for the task
            $tasks_list_container.on('click', '.eopm-single-task .eo-edit-task-trigger', function () {
                //  console.log($(this).closest('.eo-edit-task-wrap').find('.eopm-single-task__editing-fields'));
                $(this).closest('.eopm-single-task').find('.eopm-single-task__editing-fields').slideToggle();
            });

            //Show the details of the task
            $tasks_list_container.on('click', '.eopm-single-task__head__details-trigger', function() {
                $(this).closest('.eopm-single-task').find('.eopm-single-task__details').slideToggle();
            });

            //Init datepicker
            $('body').on('focus',".eo_field_datepicker", function() {
                $(this).datepicker({
                    //TODO add something to filter this
                    dateFormat: 'yy-mm-dd'
                });
            });
            
            //If the tasks list has the right class, make the list sortable
            if ($tasks_list_container.hasClass('sortable')) {
                $tasks_list_container.sortable({
                    'handle': '.handle-drag',
                    stop: function () {

                        inst.updateSortedTasksIntoDB();
                    }
                });

                inst.appendSortHandler();
            } else
                $tasks_list_container.find('.eo_single_task_handle_drag_wrap').remove();

            //Show the section to create a new task
            $('#eo-create-new-task-trigger').click(function(){
                $('.eopm-task-creation__fields').slideToggle();
            });

            inst.createTaskWatcher();

            inst.editTaskWatcher();

            inst.deleteTaskWatcher();

            inst.changeTaskStatusWatcher();


        };

        inst.createTaskWatcher = function() {
            $("#eo-create-task-submit").click(function () {

                var create_project_wrap = $('#eopm-task-creation'),
                    data = {
                        action: 'eo_create_new_task_by_frontend',
                        type: 'post',
                        dataType: 'json',
                        project_id: project_id,
                        task_title: create_project_wrap.find('#eo_field_task_title').val(),
                        task_description: create_project_wrap.find('#eo_field_task_content').val(),
                        task_done: create_project_wrap.find('#eo_field_task_done').is(':checked'),
                        task_urgent: create_project_wrap.find('#eo_field_task_urgent').is(':checked'),
                        task_expiration: create_project_wrap.find('#eo_field_task_expiration').val(),
                        task_members: create_project_wrap.find('.eonet-project-new-members-ids').val()
                    };

                jQuery.post(eopm_ajax_object.ajax_url, data, function (response) {
                    var object = JSON.parse(response);

                    $tasks_list_container.append(object.task_template);

                    if ($tasks_list_container.hasClass('sortable')) {
                        inst.appendSortHandler();
                        //$tasks_list_container.sortable('refresh');
                    }

                    $('.eopm-task-creation__fields').slideToggle();

                    create_project_wrap.find('#eo_field_task_title').val();
                    create_project_wrap.find('#eo_field_task_content').val();
                    create_project_wrap.find('#eo_field_task_done').attr('checked', false);
                    create_project_wrap.find('#eo_field_task_urgent').attr('checked', false);
                    create_project_wrap.find('#eo_field_task_expiration').val();
                    create_project_wrap.find('.eonet-project-new-members-ids').val();

                });

            });
        };

        inst.editTaskWatcher = function() {
            $tasks_list_container.on('click', '.eopm-single-task__actions-buttons .eo-submit-task', function () {

                var $task = $(this).closest('.eopm-single-task'),
                    data = {
                        action: 'eo_edit_task_by_frontend',
                        type: 'post',
                        dataType: 'json',
                        task_id: $task.attr('data-task-id'),
                        task_title: $task.find('.eo_form_field_tasks_assigned_title .eo_field').val(),
                        task_description: $task.find('.eo_form_field_tasks_assigned_content .eo_field').val(),
                        task_done: $task.find('.eo_form_field_tasks_assigned_done .eo_field').is(':checked'),
                        task_urgent: $task.find('.eo_form_field_tasks_assigned_urgent .eo_field').is(':checked'),
                        task_expiration: $task.find('.eo_form_field_tasks_assigned_expiration .eo_field').val(),
                        task_members: $task.find('.eonet-project-new-members-ids').val()
                    };

                jQuery.post(eopm_ajax_object.ajax_url, data, function (response) {
                    var object = JSON.parse(response);

                    inst.updateTaskHTML($task, object.task_template);

                });

            });
        };

        inst.deleteTaskWatcher = function() {
            $tasks_list_container.on('click', '.eo-actions-task-buttons .eo-delete-task-trigger', function () {

                var r = confirm("Are you sure you want to delete this task? The action is not reversible.");
                if (r != true)
                    return;

                var $task = $(this).closest('.eopm-single-task'),
                    data = {
                        action: 'eo_delete_task_by_frontend',
                        type: 'post',
                        dataType: 'json',
                        task_id: $task.attr('data-task-id'),
                    };

                jQuery.post(eopm_ajax_object.ajax_url, data, function (response) {
                    var object = JSON.parse(response);

                    if (object.success) {
                        $task.remove();
                        inst.updateSortedTasksIntoDB();
                    }
                });

            });
        };

        inst.changeTaskStatusWatcher = function() {
            $tasks_list_container.on('click', '.eopm-single-task--done.eo-user-can-check', function () {
                var $task = $(this).closest('.eopm-single-task'),
                    checked = ($(this).find('i').hasClass('ion-android-checkbox')) ? false : true,
                    data = {
                        action: 'eo_change_task_status_by_frontend',
                        type: 'post',
                        dataType: 'json',
                        task_id: $task.attr('data-task-id'),
                        completed: checked
                    };

                $task.eonetLoader({
                   'colored' : true,
                });

                jQuery.post(eopm_ajax_object.ajax_url, data, function (response) {
                    var object = JSON.parse(response);

                    inst.updateTaskHTML($task, object.task_template);
                });

            });
        };

        /**
         * If the list of the task has the "sortable" class, appends a div that handle the sorting
         */
        inst.appendSortHandler = function(){

            if($tasks_list_container.find('.eopm-single-task').length <= 0 || !$tasks_list_container.hasClass('sortable'))
                return;

            $tasks_list_container.find('.eopm-single-task .eo_single_task_handle_drag_wrap').empty().prepend('<div class="handle-drag"><i class="ion-navicon-round"></i></div>');

            $tasks_list_container.sortable('refresh');
        };

        /**
         * Collect the data and send the ajax request to save the new order of the tasks
         */
        inst.updateSortedTasksIntoDB = function() {
            var data = {
                'action' : 'eo_sort_tasks_by_frontend',
                'project_id' : project_id,
                'tasks' : []
            };

            $tasks_list_container.find('.eopm-single-task').each(function(i){
                data.tasks.push({
                    'task_id' : $(this).attr('data-task-id'),
                    'new_position' : i++
                })
            });

            jQuery.post(eopm_ajax_object.ajax_url, data, function(response) {
                console.log(data);
                console.log(response)
            });
        };

        /**
         * Update the layout of a task in frontend
         * @param task_element the element to replace
         * @param new_template the new HTML
         */
        inst.updateTaskHTML = function(task_element, new_template) {
            task_element.html( $(new_template).html() );

            inst.appendSortHandler();
        };

        inst.init();
    };

    /**
     * Start it up:
     */
    $(document).ready( function() {

        $.eoMembersAtuocompleteWatcher();

        $.eoTasks();

        $.eoTabs();

        $.eoFrontendTasksManager();


    });


})(jQuery);
