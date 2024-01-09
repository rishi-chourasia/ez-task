<div class="form-section">
    <h3>Sign In</h3>
    <hr>

    <?php

        echo $this->Form->create('User', ['id' => 'SingInForm', 'class' => '']);

        echo $this->Form->input('email', [
            'label' => [
                'class' => 'form-label',
                'text' => 'Enter Email'
            ],
            'type' => 'email',
            'class' => 'form-control',
            'div' => 'mb-3'
        ]);

        echo $this->Form->input('password', [
            'label' => [
                'class' => 'form-label',
                'text' => 'Enter Password'
            ],
            'type' => 'password',
            'class' => 'form-control',
            'div' => 'mb-3'
        ]);

        echo $this->Form->end([
            'label' => 'Sign In',
            'class' => 'btn btn-primary',
        ]);

    ?>

</div>

<?php echo $this->Html->script('Users/sign-in'); ?>