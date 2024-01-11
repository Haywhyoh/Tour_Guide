<?php

use Doctrine\ORM\Mapping as ORM;
require_once "bootstrap.php";
require_once "includes/functions.php";

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
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
     * @ORM\Column(type="string")
     * @var string
     */
    private $firstName;

     /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=60, unique=true, nullable=false, options={"collation":"ascii_general_ci"})
     * @var string
     */
    private $username;
    
     /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $passwordHash;

     /**
     * @ORM\Column(type="string")
     *  @var string
     */
    private $email;

     /**
      * @var string 
     * @ORM\Column(type="string")
     */
    private $role;

    public function __construct()
    {
        // Initialize the role to "user" by default
        $this->role = "user";
    }
    
    public function usernameExists(string $username): bool
    {
        // Add logic to check if a username exists in the database
        global $entityManager; // Add this line to access the $entityManager variable
        $user = $entityManager->getRepository(User::class)->findBy(['username' => $username]);
        return $user !== null;

    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function validate(string $email): bool
    {
        // Implement email format validation
        // Return true if the email is in the right format, false otherwise
       
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function setUsername(string $username): void
    {
        if (!$this->usernameExists($username)) {
            // Handle the case when the username already exists
            throw new \InvalidArgumentException("Username already Exist");
        } else {
            $this->username = $username;
            echo "Username is available";
        }
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    private function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function getEmail(): null
    {
        return $this->email;
    }

    private function setEmail(string $email): void
    {
        if (!$this->validate($email)) {
            // Handle the case when the email is invalid
            throw new \InvalidArgumentException("Invalid email format.");
        } else {
            $this->email = $email;
        }
    }

    public function isAdmin(): bool
    {
        return $this->role === "admin";
    }

    public function getRole(): string
    {
        return $this->role;
    }

    private function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    private function setFirstName(string $firstName): void
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



    public function authenticate(callable $verify_password, string $password) : bool
    {
        //This function should verify a password hash
        return $verify_password($password, $this->passwordHash);

    }


    public function saveToDatabase(array $user): void
    {
        // Add logic to save user data to the database using Doctrine ORM
            $this->setFirstName($user['firstName']);
            $this->setLastName($user['lastName']);
            $this->setUsername($user['username']);
            $this->setEmail($user['email']);
            if (strlen($user['password']) < 8) {
                // Handle the case when the password is too short
                throw new \InvalidArgumentException("Password must be at least 8 characters long.");
            } else {
                $this->setPasswordHash(create_hash($user['password']));
            }

            if (isset($user['role'])) {
                $this->setRole($user['role']);
            }
            global $entityManager;

            $entityManager->persist($this);
            $entityManager->flush();

            
    }

    public function loadFromDatabase(string $username): array
    {
        // Add logic to load user data from the database based on the user ID
        $user = $entityManager->getRepository(User::class)->findBy(['username' => $username]);
        return $user;
    }

    // public function __toString(): string
    // {
    //     // Add logic to return a string representation of the user object
    //     // For example, return a formatted string with user details
    //     return "User ID: " . $this->id . ", First Name: " . $this->firstName . ", Last Name: " . $this->lastName;
    // }

    public function __get(string $name)
    {
        // Add logic to handle property retrieval
        switch ($name) {
            case 'firstName':
                return $this->getFirstName();
            case 'lastName':
                return $this->getLastName();
            case 'email':
                return $this->getEmail();
            case 'username':
                return $this->getUsername();
            case 'passwordHash':
                return $this->getPasswordHash();
            case 'role':
                return $this->getRole();
            default:
                throw new \InvalidArgumentException("Invalid property name: $name");

        }
    }

    public function __set(string $name, $value)
    {
        // Add logic to handle property assignment
        switch ($name) {
            case 'firstName':
                $this->setFirstName($value);
                break;
            case 'lastName':
                $this->setLastName($value);
                break;
            case 'email':
                $this->setEmail($value);
                break;
            case 'username':
                $this->setUsername($value);
                break;
            case 'passwordHash':
                $this->setPasswordHash($value);
                break;
            case 'role':
                $this->setRole($value);
                break;
            default:
                throw new \InvalidArgumentException("Invalid property name: $name");
        }
    }
    
}

?>