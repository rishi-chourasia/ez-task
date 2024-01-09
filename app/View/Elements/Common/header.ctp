<header class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php

                        if ($this->Session->read('Auth.User.id')) {

                            echo $this->Html->link(
                                'User List',
                                ['controller' => 'users', 'action' => 'index'],
                                array('class' => 'nav-link')
                            );

                            echo $this->Html->link(
                                'Sign Out',
                                ['controller' => 'users', 'action' => 'signOut'],
                                array('class' => 'nav-link')
                            );
                        } else {

                            echo $this->Html->link(
                                'Sign In',
                                ['controller' => 'users', 'action' => 'signIn'],
                                array('class' => 'nav-link')
                            );

                            echo $this->Html->link(
                                'Sign Up',
                                ['controller' => 'users', 'action' => 'signUp'],
                                array('class' => 'nav-link')
                            );
                        }

                    ?>

                </div>
            </div>
        </div>
    </nav>
</header>