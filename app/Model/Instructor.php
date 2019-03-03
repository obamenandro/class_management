<?php
App::uses('AppModel', 'Model');
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
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data['Instructor']['password'] = $passwordHasher->hash($this->data['Instructor']['password']);
        }
        return true;
    }
}
