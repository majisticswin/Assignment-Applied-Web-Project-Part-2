<!DOCTYPE html>
<html lang="en">
<head>
	<title>Booking Confirmation</title>
	<meta charset="utf-8">
	<meta name="description" content="job interest form" >
	<meta name="keywords"    content="stuff" >
	<meta name="author"      content="Samuel Moore-Coulson " />
</head>
<body>

<?php
        function sanitise_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $jobref = sanitise_input($_POST["jobref"]);
            $firstname = sanitise_input($_POST["firstname"]);
            $lastname = sanitise_input($_POST["lastname"]);
            $dob = sanitise_input($_POST["dob"]);
            $gender = sanitise_input($_POST["gender"]);
            $street = sanitise_input($_POST["street"]);
            $suburb = sanitise_input($_POST["suburb"]);                         
            $state = sanitise_input($_POST["state"]);
            $postcode = sanitise_input($_POST["postcode"]);     
            $email = sanitise_input($_POST["email"]);
            $phone = sanitise_input($_POST["phone"]);
            $skills = isset($_POST["skills"]) ? $_POST["skills"] : [];
            $otherskills = sanitise_input($_POST["otherskills"]);
            
            if (empty($jobref)) {
                echo "Job Reference number is required.<br>";}
            if (!preg_match("/^[A-Za-z0-9]{5}$/", $jobref)) {
                echo "invalid characters used.<br>";}
            
            if (empty($firstname)) {
                echo "firstname is required.<br>";}
            if (!preg_match("/^[A-Za-z]{1,20}$/", $firstname)) {
                echo "invalid characters used.<br>";}

            if (empty($lastname)) {
                echo "lastname is required.<br>";}
            if (!preg_match("/^[A-Za-z]{1,20}$/", $lastname)) {
                echo "invalid characters used.<br>";}

            if (empty($dob)) {
                echo "Date of Birth is required.<br>";}
           

            if (empty($street)) {
                echo "Street is required.<br>";}
            if (!preg_match("/^[A-Za-z0-9]{1,40}$/", $firstname)) {
                echo "Street - invalid characters used.<br>";}

            if (empty($suburb)) {
                echo "Suburb is required.<br>";}
            if (!preg_match("/^[A-Za-z]{1,40}$/", $suburb)) {
                echo "Suburb - invalid characters used.<br>";}

            if (empty($postcode)) {
                echo "Postcode is required.<br>";}
            if (!preg_match("/^[0-9]{4}$/", $postcode)) {
                echo "Please use 4 numbers for your postcode.<br>";}

            if (empty($email)) {
                echo "Email is required.<br>";}
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format.<br>";}

            if (empty($phone)) {
                echo "Phnoe Number is required.<br>";}
            if (!preg_match("/^\+?(\d{1,3})?[\s.-]?\(?(\d{3})\)?[\s.-]?(\d{3})[\s.-]?(\d{4})$/", $phone));        //found from google


            echo ("$jobref");
            echo ("$firstname");
            echo ("$lastname");
            echo ("$dob");
            echo ("$gender");
           echo ("$street");
           echo ("$suburb");                    
            echo ("$state");
           echo ("$postcode");   
            echo ("$email");
            echo ("$phone");
            echo ("$skills");
          echo ("$otherskills");


        }
    ?>
</body>