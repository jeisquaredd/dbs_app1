<?php

class database{
    function opencon(){
        return new PDO('mysql:host=localhost; dbname=dbs_app', username:'root', password:'');
    }

    function insertUser($email, $password_hash,$is_active){
        $con = $this->opencon();

        try{
            $con->beginTransaction();
            $stmt = $con->prepare('INSERT INTO Users (username ,password_hash,is_active) VALUES (?,?,?)');
            $stmt->execute([$email, $password_hash, $is_active]);
            $user_id = $con->lastInsertId();
            $con->commit();
            return $user_id;
        }catch(PDOException $e){
            if($con->inTransaction()){
                $con->rollBack();
            }
            throw $e;
        }

}

function insertBorrower($firstname, $lastname, $email, $phone, $is_active, $member_since){
    $con = $this->opencon();

    try{
        $con->beginTransaction();
        $stmt = $con->prepare("INSERT INTO Borrowers (borrower_firstname, borrower_lastname, borrower_email, borrower_phone_number, borrower_member_since, is_active) VALUES (?, ?,?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $email, $phone, $member_since, $is_active]);
        $borrower_id = $con->lastInsertId(); // Get the new borrower_id for mapping
        $con->commit();
        return $borrower_id; // Return the new borrower_id
    
        }catch (PDOException $e) {
        if ($con->inTransaction()) {
            $con->rollBack();
        }
        throw $e; // Re-throw the exception after rolling back              
}

}

function insertBorrowerUser($user_id, $borrower_id){
    $con = $this->opencon();

    try{
        $con->beginTransaction();
        $stmt = $con->prepare("INSERT INTO BorrowerUser (borrower_id, user_id) VALUES (?, ?)");
        $stmt->execute([$borrower_id, $user_id]);
        $con->commit();
        return true; // Successfully inserted mapping
    
        }catch (PDOException $e) {
        if ($con->inTransaction()) {
            $con->rollBack();
        }
        throw $e; // Re-throw the exception after rolling back              

}

}

function viewBorrowerUser(){
    $con = $this->opencon();
    return $con->query("SELECT * from Borrowers")->fetchAll();
}



}
