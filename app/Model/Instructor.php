<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Instructor Model
 *
 */
class Instructor extends AppModel {

    public $validate = [
        'first_name' => [
            'notBlank' => [
                'rule' => ['notBlank'],
                'message' => 'First name cannot be blank'
            ],
            'alphaNumeric' => [
                'rule' => ['alphaNumeric'],
                'message' => 'First name can only contain letters and numbers'
            ],
        ],
        'last_name' => [
            'notBlank' => [
                'rule' => ['notBlank'],
                'message' => 'Last name cannot be blank'
            ],
            'alphaNumeric' => [
                'rule' => ['alphaNumeric'],
                'message' => 'First name can only contain letters and numbers'
            ],
        ],
        'username' => [
            'notBlank' => [
                'rule' => ['notBlank'],
                'message' => 'Username cannot be blank'
            ],
            'alphaNumeric' => [
                'rule' => ['alphaNumeric'],
                'message' => 'Username can only contain letters and numbers'
            ],
            'unique' => [
                'rule' => 'isUniqueUsername',
                'message' => 'Username is already in use',
            ]
        ],
        'password' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Password is required'
            ],
            'alphaNumeric' => [
                'rule' => 'alphaNumeric',
                'message' => 'Please enter the password in alphanumeric characters'
            ],
            'length' => [
                'rule' => ['lengthBetween', 8,32],
                'message' => 'Please enter the password within 8 to 32 characters'
            ],
        ],
        'confirm_password' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Confirm password is required'
            ],
            'length' => [
                'rule' => ['lengthBetween', 8,32],
                'message' => 'Please enter the confirm password within 8 to 32 characters'
            ],
            'alphaNumeric' => [
                'rule' => 'alphaNumeric',
                'message' => 'Please enter the password in alphanumeric characters'
            ],
            'equal' => [
                'rule' => ['equaltofield','password'],
                'message' => 'Password and Confirm password must be same'
            ]
        ]
    ];

    public function isUniqueUsername($username) {
        return ($this->hasAny(['Instructor.username' => $username, 'Instructor.deleted' => 0])) ? false: true;
    }

    public function equaltofield($check, $otherfield) {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value) {
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }


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
