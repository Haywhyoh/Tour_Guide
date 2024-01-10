<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Tabe=le(name='users')
 */
class User
{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int|null $id = null;

    /**
     * @ORM\Column(type='string')
     * @var string
     */
    private $firstName;

     /**
     * @ORM\Column(type='string', nullable=false)
     * @var string
     */
    private $lastName;

     /**
      * @ORM\Column(type='string', length=60, unique=true, nullable=false, options={"collation":"ascii_general_ci"})
      * @var string
      */
     private $username;
    
     /**
     * @ORM\Column(type='string', nullable=false)
     */
    private $passwordHash;

     /**
     * @ORM\Column(type='string')
     *  @var string
     */
    private $email;

     /**
      * @var string 
     * @ORM\Column(type='string')
     */
    private $role;

    public function __construct()
    {
        // Initialize the role to 'user' by default
        $this->role = 'user';
    }
    
    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function validate(): bool
    {
        // Implement email format validation
        // Return true if the email is in the right format, false otherwise
        $email = $this->getEmail();
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function authenticate(callable $verify_password, string $password) : bool
    {
        //This function should verify a password hash
        return $verify_password($password, this->passwordHash);

    }

    public function saveToDatabase(): void
    {
        // Add logic to save user data to the database using Doctrine ORM
        // For example, use Doctrine's EntityManager to persist the user entity
        // Consider handling potential errors or exceptions during the database operation
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($this);
        $entityManager->flush();
    }

    public function loadFromDatabase(int $userId): void
    {
        // Add logic to load user data from the database based on the user ID
        // For example, use SQL queries to retrieve user data by ID
    }

    public function __toString(): string
    {
        // Add logic to return a string representation of the user object
        // For example, return a formatted string with user details
        return "User ID: " . $this->id . ", First Name: " . $this->firstName . ", Last Name: " . $this->lastName;
    }

    public function __get(string $name)
    {
        // Add logic to handle property retrieval
        // For example, implement dynamic property retrieval based on the property name
    }

    public function __set(string $name, $value)
    {
        // Add logic to handle property assignment
        // For example, implement dynamic property assignment based on the property name and value
    }
    
}

?>