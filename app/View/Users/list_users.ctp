<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Role</th>
            <th scope="col">Address</th>
            <th scope="col">State</th>
            <?php if (AuthComponent::user('is_admin')) { ?>
                <th scope="col">Action</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>

        <?php
        if (!empty($users)) {

            $indianStates = Configure::read('IndianStates');

            foreach ($users as $user) {
                $user = $user['User'];
        ?>

            <tr>
                <td scope="col">#</td>
                <td scope="col"><?= $user['first_name'] ?></td>
                <td scope="col"><?= $user['last_name'] ?></td>
                <td scope="col"><?= $user['email'] ?></td>
                <td scope="col"><?= $user['contact_number'] ?></td>
                <td scope="col"><?= !empty($user['is_admin']) ? 'Admin' : 'User' ?></td>
                <td scope="col"><address><?= $user['address'] ?></address></td>
                <td scope="col"><?= $indianStates[$user['state']]; ?></td>
                <?php if (AuthComponent::user('is_admin')) { ?>
                <td scope="col">

                    <?php
                        echo $this->Html->link(
                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                          </svg> Edit',
                            ['controller' => 'users', 'action' => 'edit',  $user['id']],
                            ['escape' => false, 'class' => 'btn btn-primary']
                        );

                        echo "&nbsp;";

                        echo $this->Html->link(
                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                          </svg> Delete',
                            '#',
                            ['escape' => false, 'class' => 'btn btn-danger delete-user-link', 'data-id' => $user['id'], 'data-delete-url' => Router::url(['controller' => 'users', 'action' => 'delete',  $user['id']])]
                        );
                    ?>

                </td>
                <?php } ?>
            </tr>

        <?php
            }

        } else { ?>

        <tr>
            <th colspan="6">No User Found</th>
        </tr>

        <?php } ?>
    </tbody>
</table>

<?= $this->element('Common/pagination') ?>