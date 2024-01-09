<?php

App::uses('AppModel', 'Model');

/**
 * User model for App.
 *
 */
class User extends AppModel
{

    /**
     * function to check email is already exists
     *
     * @param email | string
     * @param id | numeric
     * @return boolean
     */
    function checkUserEmail($email, $id = null)
    {

        $conditions = [
            'User.email' => $email,
            'User.is_deleted' => 0,
        ];

        if (!empty($id)) {
            $conditions['User.id !='] = $id;
        }

        $user = $this->find('first', [
            'conditions' => $conditions
        ]);

        if (!empty($user)) {
            return true;
        }

        return false;

    }//end checkUserEmail()

}//end User