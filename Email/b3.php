<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <input type="submit" name="send">
    </form>

    <?php
        $mysqli = new mysqli("localhost", "root", "", "test");

        if($mysqli->connect_errno){
            echo "Kết nối không thành công";
            exit();
        }


        require('../PHPMailer/src/PHPMailer.php');
        require('../PHPMailer/src/Exception.php');
        require('../PHPMailer/src/SMTP.php');
        use PHPMailer\PHPMailer\PHPMailer;


        if(isset($_GET['send'])){

            $sql = mysqli_query($mysqli, "SELECT * FROM tbl_email");
            while($row = mysqli_fetch_array($sql)){
                $mail = new PHPMailer();

                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->SMTPDebug = 1;                
                $mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                     // Enable SMTP authentication
                $mail->Username = 'kttravel06@gmail.com'; // your email id
                $mail->Password = 'bhbncdlurpnldamu'; // your password
                $mail->SMTPSecure = 'tls';                  
                $mail->Port = 587;     //587 is used for Outgoing Mail (SMTP) Server.
                $mail->setFrom('kttravel06@gmail.com', 'KT TRAVEL');
                $mail->addAddress($row['email']);   // Add a recipient
                $mail->isHTML(true);  // Set email format to HTML
            
            
                $mail->Subject = 'TEST';
                $mail->Body    = 'HELLO WORLD!';
                if(!$mail->send()) {
                echo 'Message was not sent.';
                echo 'Mailer error: ' . $mail->ErrorInfo;
                } else {
                echo 'Message has been sent.';
                }
            }
        }
    
    ?>

</body>
</html>