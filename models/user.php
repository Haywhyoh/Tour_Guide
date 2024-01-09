require_once('db.php');

class User {
    private $user_id;
    private $username;
    private $password;
    private $email;
    private $role;
    
    public function __construct($user_id, $username, $password, $email, $role) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
    }

    public function get_user_id() {
        return $this->user_id;
    }
}