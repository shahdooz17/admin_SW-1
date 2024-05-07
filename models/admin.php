<?php
include'user.php';
class Admin extends User
{
    public function __construct()
    {
        parent::__construct();
    }
    public function addUser($firstname, $lastname, $phonenumber, $email, $role)
    {
        $randompassword = $this->generatePassword();
        $this->signUp($firstname, $lastname, $phonenumber, $email, $role, $randompassword);
        $username = $this->generateUsername($firstname, $lastname);
        $this->SendMail($email, $firstname, $username, $randompassword);
        header("Location: ../views/admin/admindashboard.php");
    }

    public function removeUser($id)
    {
        $sql = "DELETE FROM User WHERE UserID = '$id'";
        $this->db->delete($sql);    
    }

    public function generateUsername($firstname, $lastname)
    {
        $row = $this->db->getLastRecordData('User' , 'id');
        $username = $firstname . "_" . $lastname . "#" . ($row['id']);

        $sql = "UPDATE User SET Username = '$username' WHERE UserID = '".$row['id']."'";
        $this->db->update($sql);
        return $username;
    }

    public function generatePassword($length = 8)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $password;
    }
    public function acceptAppointment($appointment_id) 
    {
        $sql = "UPDATE Appointments SET Status = 'Confirmed' WHERE AppointmentID = '$appointment_id'";
        $this->db->update($sql);

    }
    public function updateAppointment($appointment_time,$appointment_id)
    {
        $sql= "UPDATE Appointments SET AppointmentTime = '$appointment_time' WHERE AppointmentID = '$appointment_id'";
        $this->db->update($sql);
    }

    public function removeAppointment($appointment_id)
    {
        $sql = "DELETE FROM Appointments WHERE AppointmentID = '$appointment_id'";
        $this->db->delete($sql); 
    }

    public function SendMail($email, $name, $username, $password)
    {
        include '../emails__admin/send.php';

        $mailer->setFrom("shahdalsayed20042017@gmail.com", "Doc Admin");    // the sender
        $mailer->addAddress($email, $name);

        $mailer->Subject = "sending username and password";

        $mailer->isHTML(true);

        $mailer->Body = "hello $name <br>this is the <strong>$username</strong> and <strong>$password</strong>";
        $mailer->AltBody = "hello $name this is the $username and $password";

        $mailer->send();
    }

    public function displayUsers(){
        $sql = "SELECT * FROM User";
        $data = $this->db->display($sql);
        return $data;
    }

    public function displayAppointments(){
        $sql = "SELECT * FROM Appointment";
        $data = $this->db->display($sql);
        return $data;
    }

    
}