<?php namespace AlexaWatcher\Entities;

class Pushable {

    /**
     * Female gender
     *
     * @var integer
     */
    const FEMALE = 0;

    /**
     * Male gender
     *
     * @var integer
     */
    const MALE = 1;

    /**
     * Other genders
     *
     * @var integer
     */
    const OTHER = 2;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var
     */
    protected $lastName;

    /**
     * @var integer
     */
    protected $gender;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        foreach($attributes as $key => $value)
        {
            $this->$key = $value;
        }
    }

    /**
     * Get first name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Create entity from array
     *
     * @param array $attributes
     * @return static
     */
    public function createFromArray(array $attributes)
    {
        return new static($attributes);
    }

    /**
     * Get the user email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the concatenated user name
     *
     * @return string
     */
    public function name()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getGender()
    {
        return $this->gender;
    }
}