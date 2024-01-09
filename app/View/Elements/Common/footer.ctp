<footer class="py-3 my-4 container">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
    <?php

        if ($this->Session->read('Auth.User.id')) {

            echo '<li class="nav-item">';
                echo $this->Html->link(
                    'User List',
                    ['controller' => 'users', 'action' => 'index'],
                    array('class' => '"nav-link px-2 text-muted')
                );
            echo '</li>';

            echo '<li class="nav-item">';
                echo $this->Html->link(
                    'Sign Out',
                    ['controller' => 'users', 'action' => 'signOut'],
                    array('class' => '"nav-link px-2 text-muted')
                );
            echo '</li>';

        } else {

            echo '<li class="nav-item">';
                echo $this->Html->link(
                    'Sign In',
                    ['controller' => 'users', 'action' => 'signIn'],
                    array('class' => '"nav-link px-2 text-muted')
                );
            echo '</li>';

            echo '<li class="nav-item">';
                echo $this->Html->link(
                    'Sign Up',
                    ['controller' => 'users', 'action' => 'signUp'],
                    array('class' => '"nav-link px-2 text-muted')
                );
            echo '</li>';
        }
    ?>
    </ul>
    <p class="text-center text-muted">© 2023 Company, Inc</p>
</footer>