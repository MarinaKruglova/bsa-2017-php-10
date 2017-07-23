<?php

namespace App\Request;

use App\Entity\User;
use App\Request\Contract\SaveUserRequest as SaveUserRequestContract;

class SaveUser implements SaveUserRequestContract
{
    protected $user;
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->data['first_name'];
    }

    /**
     * @return string|null
     */
    public function getLastName()
    {
        return $this->data['last_name'] ?? "";
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->data['email'];
    }

    /**
     * @return bool
     */
    public function getIsAdmin(): bool
    {
        return isset($this->data['is_admin']) && $this->data['is_admin'] === 'on';

    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->data['password'] ?? "";
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return isset($this->data['is_active']) && $this->data['is_active'] === 'on';
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        if ($this->user){
            return $this->user;
        } else {
            return new User;
        }
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }
}