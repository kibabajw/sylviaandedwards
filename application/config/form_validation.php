<?php 

$config = array(
        'admin_controller/register' => array(
                array(
                        'field' => 'reg_admin_name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'reg_admin_email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email'
                ),
                array(
                        'field' => 'reg_admin_password',
                        'label' => 'Password',
                        'rules' => 'trim|required|min_length[4]'
                )
        ),
        'admin_controller/login' => array(
                array(
                        'field' => 'adm_login_name',
                        'label' => 'Admin name',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'adm_login_password',
                        'label' => 'Password',
                        'rules' => 'required'
                )
        ),
    'Auth_Writer_Controller/register' => array(
        array(
            'field' => 'reg_member_name',
            'label' => 'Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'reg_member_phone_number',
            'label' => 'phone-number',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'reg_member_email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
        ),
        array(
            'field' => 'reg_member_password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[8]|callback_check_email'
        )
    ),
    'dashboard_controller/create_new_task' => array(
        array(
            'field' => 'new_task_id',
            'label' => 'order id',
            'rules' => 'required'
        ),
        array(
            'field' => 'new_task_handler',
            'label' => 'handler',
            'rules' => 'required'
        ),
        array(
            'field' => 'new_task_due_time',
            'label' => 'due time',
            'rules' => 'trim|required|valid_email'
        ),
        array(
            'field' => 'new_task_instructions',
            'label' => 'instructions',
            'rules' => 'required'
        ),
        array(
            'field' => 'userfile',
            'label' => 'task file',
            'rules' => 'required'
        )
    ),
    'Auth_Writer_Controller/login' => array(
        array(
            'field' => 'writer_login_name',
            'label' => 'Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'writer_login_password',
            'label' => 'Password',
            'rules' => 'trim|required'
        )
    ),
    'Writer_Dashboard_Controller/submit_order' => array(
        array(
            'field' => 'file_order_submit',
            'label' => 'Order file',
            'rules' => 'required'
        ),
        array(
            'field' => 'txt_order_submit',
            'label' => 'Order comments',
            'rules' => 'required'
        )
    ),
    'Auth_Writer_Controller/reset_password' => array(
        array(
            'field' => 'writer_reset_email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        )
    ),
    'Admin_controller/reset_password' => array(
        array(
            'field' => 'admin_reset_email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        )
    ),
    'Dashboard_controller/create_new_revision' => array(
        array(
            'field' => 'new_revision_id',
            'label' => 'Order id',
            'rules' => 'required'
        ),
        array(
            'field' => 'new_revision_time',
            'label' => 'New due date',
            'rules' => 'required'
        ),
        array(
            'field' => 'new_revision_instructions',
            'label' => 'Revision instructions',
            'rules' => 'required'
        )
    )         
);