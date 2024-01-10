<?php

    function create_hash(string $password): string {
        return password_hash($password, PASSWORD_DEFAULT );
    }

    function verify_password(string $password, string $hashed_password): bool {
        return password_verify($password, $hashed_password);
    }

?>