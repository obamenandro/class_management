<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Instructor Model
 *
 */
class Instructor extends AppModel {
    /**
     * Hash password before saved.
     */
    public function beforeSave($options = []) {
        if (isset($this->data['Instructor']['password'])) {
            $this->data['Instructor']['password'] = AuthComponent::password(
                $this->data['Instructor']['password']
            );
        }
        // if (isset($this->data['Instructor']['password'])) {
        //     $passwordHasher = new BlowfishPasswordHasher();
        //     $this->data['Instructor']['password'] = $passwordHasher->hash($this->data['Instructor']['password']);
        // }
        return true;
    }
}
