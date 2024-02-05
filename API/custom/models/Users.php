<?php
class User
{
    private $users;

    public function __construct()
    {
        // Establish database connection
        $this->users = array(
            array(
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => "john@123",
                'age' => 30,
                'address' => array(
                    'street' => '123 Main St',
                    'city' => 'Anytown',
                    'country' => 'USA'
                ),
                'interests' => array('programming', 'hiking', 'photography')
            ),
            array(
                'name' => 'Bob',
                'email' => 'bob@example.com',
                'password' => "bob@123",
                'age' => 32,
                'address' => array(
                    'street' => '789 Oak St',
                    'city' => 'Othertown',
                    'country' => 'UK'
                ),
                'interests' => array('gardening', 'music', 'sports')
            ),
            array(
                'name' => 'Eva',
                'email' => 'eva@example.com',
                'password' => "eva@123",
                'age' => 28,
                'address' => array(
                    'street' => '101 Pine St',
                    'city' => 'Anycity',
                    'country' => 'Australia'
                ),
                'interests' => array('painting', 'yoga', 'photography')
            )
        );
    }

    public function getUser()
    {
        return $this->users;
    }
}
