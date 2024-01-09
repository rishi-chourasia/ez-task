<div class="form-section">
    <h3>Edit User</h3>
    <hr>

    <?php

        echo $this->Form->create('User', [
            'id' => 'UserEditForm',
            'data-email-check-url' => Router::url(['controller' => 'users', 'action' => 'checkEmail'])
        ]);

        echo $this->Form->input('id', [
            'type' => 'hidden'
        ]);

        echo $this->Form->input('first_name', [
            'label' => [
                'class' => 'form-label',
                'text' => 'First Name'
            ],
            'class' => 'form-control',
            'div' => 'mb-3',
            'required' => true,
        ]);

        echo $this->Form->input('last_name', [
            'label' => [
                'class' => 'form-label',
                'text' => 'Last Name'
            ],
            'class' => 'form-control',
            'div' => 'mb-3',
            'required' => true,
        ]);

        echo $this->Form->input('contact_number', [
            'label' => [
                'class' => 'form-label',
                'text' => 'Contact Number'
            ],
            'type' => 'text',
            'class' => 'form-control',
            'div' => 'mb-3',
            'required' => true,
        ]);

        echo $this->Form->input('email', [
            'label' => [
                'class' => 'form-label',
                'text' => 'Enter Email'
            ],
            'type' => 'email',
            'class' => 'form-control',
            'div' => 'mb-3',
            'required' => true,
        ]);

        echo $this->Form->input('address', [
            'label' => [
                'class' => 'form-label',
                'text' => 'Enter Address'
            ],
            'type' => 'textarea',
            'class' => 'form-control',
            'div' => 'mb-3',
            'required' => true,
        ]);

        echo $this->Form->input('state', [
            'label' => [
                'class' => 'form-label',
                'text' => 'Indian State'
            ],
            'type' => 'select',
            'class' => 'form-control',
            'div' => 'mb-3',
            'options' => Configure::read('IndianStates'),
            'empty' => '-- Select State --',
            'required' => true,
        ]);

        echo $this->Form->input('is_admin', [
            'label' => [
                'class' => 'form-label',
                'text' => 'Is Admin'
            ],
            'type' => 'checkbox',
            'value' => 1,
        ]);

        echo $this->Form->end([
            'label' => 'Submit',
            'class' => 'btn btn-primary',
            'id' => 'EditUserSubmit'
        ]);

    ?>

</div>

<?php echo $this->Html->script('Users/edit'); ?>
