<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require "functions.php";

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/icons/favicon-16x16.png">
    <link rel="manifest" href="../assets/icons/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <title>Kirim Email - Presentia</title>
</head>
<body class="font-sarabun" style="background-color: #1F2937;">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');

// get id on URL
$id = $_GET["id"];
$halaman = $_GET['halaman'];

// query data perguruan_tinggi by id
$perguruan = query("SELECT * FROM perguruan_tinggi WHERE id=$id")[0];

if (isset($_POST['terima'])) {
    if(empty($_POST['uniqid_client'])) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ID masih kosong!',
                text: 'Silahkan generate terlebih dahulu.',
            }).then(function() {
                window.location = 'index.php?halaman=" . $halaman . "';
            });
        </script>
        ";
    } else {
        $nama = $_POST['nama_pt'];
        $email = $_POST['email'];
        $uidc = $_POST['uniqid_client'];      
        $uidd = $_POST['uniqid_discord'];     

        $mail = new PHPMailer(true);

        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'srv.stmikkomputama.ac.id';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'presentia@stmikkomputama.ac.id';                     //SMTP username
            $mail->Password   = 'sulaimu123abc';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('presentia@stmikkomputama.ac.id', 'Presentia');
            $mail->addAddress($email);     //Add a recipient

        
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Registrasi Presentia Berhasil';
            $mail->Body = '<!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width,initial-scale=1">
              <meta name="x-apple-disable-message-reformatting">
              <style>
                table, td, div, h1, p {
                  font-family: Arial, sans-serif;
                }
                @media screen and (max-width: 530px) {
                  .unsub {
                    display: block;
                    padding: 8px;
                    margin-top: 14px;
                    border-radius: 6px;
                    background-color: #555555;
                    text-decoration: none !important;
                    font-weight: bold;
                  }
                  .col-lge {
                    max-width: 100% !important;
                  }
                }
                @media screen and (min-width: 531px) {
                  .col-sml {
                    max-width: 27% !important;
                  }
                  .col-lge {
                    max-width: 73% !important;
                  }
                }
              </style>
            </head>
            <body style="margin:0;padding:0;word-spacing:normal;background-color:#1F2937;">
              <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#1F2937;">
                <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                  <tr>
                    <td align="center" style="padding:0;">
                      <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                        <tr>
                          <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                            <a href="http://presentia.stmikkomputama.ac.id" style="text-decoration:none;"><img src="http://presentia.stmikkomputama.ac.id/assets/image/email/logo-presentia.png" width="165" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:30px;background-color:#ffffff;">
                            <h1 style="margin-top:0;margin-bottom:16px;font-size:24px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">Selamat, <span style="color:#119DA4"> ' .$nama. ' </span> berhasil terdaftar di Presentia!</h1>
                            <p style="margin:0;">Untuk tahapan selanjutnya, Anda bisa menggunakan kode unik yang ada pada pesan ini untuk melakukan registrasi pada server Discord.</p>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding-right: 30px; padding-left: 30px; background-color:#ffffff;">
                            <img src="http://presentia.stmikkomputama.ac.id/assets/image/email/terima.png" width="50%" style="margin-left:auto; margin-right:auto;width:70%;height:auto;display:block;border:none;text-decoration:none;color:#363636;">
                            <hr style="width: 100%; border: 0; height: 1px; background: #000; opacity: 0.1;">
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:30px;background-color:#ffffff;">
                            <h2>Kode <span style="color:#119DA4">Registrasi</span></h2><br>
                            <p style="margin:0; font-weight: bold; padding-bottom: 10px;">Kode Instansi : <span style="color:#119DA4; font-weight: bold;"> ' .$uidc. ' </span></p>
                            <p style="margin:0; padding-bottom: 30px;">Kode instansi merupakan kode unik yang akan digunakan oleh mahasiswa atau pengguna aplikasi Presentia untuk meregistrasikan perangkatnya pada aplikasi Presentia.</p>
                            <p style="margin:0; font-weight: bold; padding-bottom: 10px;">Kode Discord : <span style="color:#119DA4; font-weight: bold;"> ' .$uidc. ' </span></p>
                            <p style="margin:0; padding-bottom: 30px;">Kode discord merupakan kode unik yang akan digunakan oleh admin atau dosen untuk meregistrasikan server Discord untuk mengelola aplikasi Presentia.</p>
                            <hr style="width: 100%; border: 0; height: 1px; background: #000; opacity: 0.1;">
                            <h4 style="margin:0; padding-top: 30px;">PERHATIAN!!</h4>  
                            <p style="margin:0; padding-top: 10px; padding-bottom: 30px;">Jangan sebarkan kode di atas ke siapapun di luar instansi atau pengguna yang tidak diharapkan.</p> 
                            <hr style="width: 100%; border: 0; height: 1px; background: #000; opacity: 0.1;">
                          </td>
                        </tr>
                        <tr>
                          <td style="padding-right: 30px; padding-left: 30px; background-color:#ffffff;">
                            <p style="margin:0; padding-top: 10px;">Tekan tombol berikut untuk melihat panduan registrasi server Discord Presentia Anda. Panduan registrasi tersebut ada pada panduan Admin.</p> 
                            <p style="margin:0; padding-bottom: 30px; padding-top: 30px; text-align: center;"><a href="presentia.stmikkomputama.ac.id/#panduan" style="background: #0C7489; text-decoration: none; padding: 10px 25px; color: #ffffff; border-radius: 4px; display:inline-block; mso-padding-alt:0; "><span style="mso-text-raise:10pt;font-weight:bold;">Lihat Panduan</span></a></p>
                            <hr style="width: 100%; border: 0; height: 1px; background: #000; opacity: 0.1;">
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:30px;background-color:#ffffff;">
                            <h2>Punya <span style="color:#119DA4">pertanyaan?</span></h2>
                            <p style="margin:0;">Jika Anda memiliki pertanyaan, segera hubungi kami untuk kami bantu dan jawab pertanyaan Anda.</p>
                            <p>Kontak kami: <a style="color: #012;text-decoration: none;">presentia@stmikkomputama.ac.id</a></p>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:30px;font-size:24px;line-height:28px;font-weight:bold;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);">
                            <img src="http://presentia.stmikkomputama.ac.id/assets/image/email/question.png" width="450" alt="" style="width: 100%;height:auto;border:none;text-decoration:none;color:#363636;">
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:30px;background-color:#ffffff;">
                            <p style="margin:0;">Kami mengirimkan pesan ini karena email yang Anda gunakan terdaftar di situs kami, jika Anda merasa tidak ingin menerima pesan dari kami lagi, harap hubungi kami. Terimakasih.</p>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:30px;text-align:center;font-size:12px;background-color:#0C7489;color:#cccccc;">    
                            <p style="margin:0;font-size:14px;line-height:20px;">&reg; Sulaimu, Presentia 2021</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>
            </body>
            </html>';

            $mail->send();
            echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Email Berhasil Dikirimkan',
                        }).then(function() {
                          window.location = 'index.php?halaman=" . $halaman . "';
                        });
                    </script>
                    ";
        } catch (Exception $e) {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Email Gagal Dikirimkan',
                }).then(function() {
                    window.location = 'index.php?halaman=" . $halaman . "';
                });
            </script>";
        }
    }
}

if (isset($_POST['tolak'])) {
    $nama = $_POST['nama_pt'];
    $email = $_POST['email'];    

    $mail = new PHPMailer(true);

    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'srv.stmikkomputama.ac.id';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'presentia@stmikkomputama.ac.id';                     //SMTP username
        $mail->Password   = 'sulaimu123abc';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('presentia@stmikkomputama.ac.id', 'Presentia');
        $mail->addAddress($email);     //Add a recipient

    
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Registrasi Presentia Belum Berhasil';
        $mail->Body = '<!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width,initial-scale=1">
          <meta name="x-apple-disable-message-reformatting">
          <style>
            table, td, div, h1, p {
              font-family: Arial, sans-serif;
            }
            @media screen and (max-width: 530px) {
              .unsub {
                display: block;
                padding: 8px;
                margin-top: 14px;
                border-radius: 6px;
                background-color: #555555;
                text-decoration: none !important;
                font-weight: bold;
              }
              .col-lge {
                max-width: 100% !important;
              }
            }
            @media screen and (min-width: 531px) {
              .col-sml {
                max-width: 27% !important;
              }
              .col-lge {
                max-width: 73% !important;
              }
            }
          </style>
        </head>
        <body style="margin:0;padding:0;word-spacing:normal;background-color:#1F2937;">
          <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#1F2937;">
            <table role="presentation" style="width:100%;border:none;border-spacing:0;">
              <tr>
                <td align="center" style="padding:0;">
                  <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                    <tr>
                      <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                        <a href="http://presentia.stmikkomputama.ac.id" style="text-decoration:none;"><img src="http://presentia.stmikkomputama.ac.id/assets/image/email/logo-presentia.png" width="165" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-right: 30px; padding-left: 30px; padding-top: 30px;background-color:#ffffff;">
                        <h1 style="margin-top:0;margin-bottom:16px;font-size:24px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">Maaf, Pendaftaran <span style="color:#119DA4"> ' .$nama. ' </span> belum berhasil terdaftar di Presentia!</h1>
                        <p style="margin:0;">Terdapat beberapa alasan mengapa kami menolak pendaftaran yang Anda kirimkan kepada kami. Salah satunya adalah ketidakvalidan data yang Anda kirimkan.</p>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-right: 30px; padding-left: 30px; background-color:#ffffff;">
                        <img src="presentia.stmikkomputama.ac.id/assets/image/email/cek.png" width="50%" style="margin-left:auto; margin-right:auto;width:100%;height:auto;display:block;border:none;text-decoration:none;color:#363636;">
                        <hr style="width: 100%; border: 0; height: 1px; background: #000; opacity: 0.1;">
                      </td>
                    </tr>
                    <tr>
                      <td style="padding:30px;background-color:#ffffff;">
                        <p style="margin:0;">Kami meminta maaf apabila terdapat kesalahan dalam pengecekan data yang Anda kirimkan. Lakukan pendaftaran ulang dan segera hubungi kami agar data Anda bisa kami periksa kembali.</p>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-right: 30px; padding-left: 30px; background-color:#ffffff;">
                        <p style="margin:0; padding-top: 10px;">Tekan tombol berikut untuk mendaftarkan ulang kampus Anda di Presentia.</p> 
                        <p style="margin:0; padding-bottom: 30px; padding-top: 30px; text-align: center;"><a href="http://presentia.stmikkomputama.ac.id/#registrasi" style="background: #0C7489; text-decoration: none; padding: 10px 25px; color: #ffffff; border-radius: 4px; display:inline-block; mso-padding-alt:0; "><span style="mso-text-raise:10pt;font-weight:bold;">Registrasi Ulang</span></a></p>
                        <hr style="width: 100%; border: 0; height: 1px; background: #000; opacity: 0.1;">
                      </td>
                    </tr>
                    <tr>
                      <td style="padding:30px;background-color:#ffffff;">
                        <h2>Punya <span style="color:#119DA4">pertanyaan?</span></h2>
                        <p style="margin:0;">Jika Anda memiliki pertanyaan, segera hubungi kami untuk kami bantu dan jawab pertanyaan Anda.</p>
                        <p>Kontak kami: <a style="color: #012;text-decoration: none;">presentia@stmikkomputama.ac.id</a></p>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding:30px;font-size:24px;line-height:28px;font-weight:bold;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);">
                        <img src="presentia.stmikkomputama.ac.id/assets/image/email/question.png" width="450" alt="" style="width: 100%;height:auto;border:none;text-decoration:none;color:#363636;">
                      </td>
                    </tr>
                    <tr>
                      <td style="padding:30px;background-color:#ffffff;">
                        <p style="margin:0;">Kami mengirimkan pesan ini karena email yang Anda gunakan terdaftar di situs kami, jika Anda merasa tidak ingin menerima pesan dari kami lagi, harap hubungi kami. Terimakasih.</p>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding:30px;text-align:center;font-size:12px;background-color:#0C7489;color:#cccccc;">    
                        <p style="margin:0;font-size:14px;line-height:20px;">&reg; Sulaimu, Presentia 2021</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
        </body>
        </html>';

        $mail->send();
        echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Email Berhasil Dikirimkan',
                    }).then(function() {
                      window.location = 'index.php?halaman=" . $halaman . "';
                    });
                </script>
                ";
    } catch (Exception $e) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Email Gagal Dikirimkan',
            }).then(function() {
                window.location = 'index.php?halaman=" . $halaman . "';
            });
        </script>";
    }
}

?>

    <!-- navbar -->
    <div class="container mx-auto py-8">
        <div class="float-right text-white">
            <button class="border-2 border-white rounded-full font-bold text-white px-6 
            py-2 transition duration-50 ease-out hover:bg-white hover:text-black mr-6">
                <a href="logout.php">Logout</a>
            </button>
        </div>
        <div class="float-left text-white">
            <button class="border-2 border-white rounded-full font-bold text-white px-6 
            py-2 transition duration-50 ease-out hover:bg-white hover:text-black ml-6">
                <a href='index.php?halaman=<?= $halaman ?>'>Kembali</a>
            </button>
        </div>
        <div>
        <!-- end navbar -->

        <!-- title -->
        <div class=" container w-full flex flex-wrap flex-col items-center text-center content-center pt-10">
            <h1 class="font-bold text-4xl md:text-5xl max-w-xl leading-tiyght">
                <span class="outliner"> Kirim Email</span>
            </h1>
        </div>
        <!-- end title -->

        <!-- form ubah -->
        <div class="pt-10 container w-full grid justify-items-center">
            <form action="" method="POST">
                <label for="nama_pt" class="block pb-5">
                    <span class="text-white">Nama Perguruan Tinggi</span>
                    <input readonly type="text" class="mt-2 block p-2 w-80 rounded-md border-gray-500 shadow-sm 
                    focus:border-gray-500 focus:ring focus:ring-gray-500 
                    focus:ring-opacity-50" placeholder="" name="nama_pt" id="nama_pt" 
                    value="<?= $perguruan["nama_pt"]; ?>" autocomplete="off" required />
                </label>

                <label for="email" class="block pb-5">
                    <span class="text-white">Email Unit</span>
                    <input readonly type="email" class="mt-2 block p-2 w-80 rounded-md border-gray-500 shadow-sm 
                    focus:border-gray-500 focus:ring focus:ring-gray-500 
                    focus:ring-opacity-50" placeholder="" name="email" id="email" 
                    value="<?= $perguruan["email"]; ?>" autocomplete="off" required />
                </label>

                <label for="uniqid_client" class="block pb-5">
                    <span class="text-white">Unique ID Client</span>
                    <input readonly type="text" class="mt-2 block p-2 w-80 rounded-md border-gray-500 shadow-sm 
                    focus:border-gray-500 focus:ring focus:ring-gray-500 
                    focus:ring-opacity-50" placeholder="" name="uniqid_client" id="uniqid_client" 
                    value="<?= $perguruan["uniqid_client"]; ?>" autocomplete="off" required />
                </label>

                <label for="uniqid_discord" class="block">
                    <span class="text-white">Unique ID Discord</span>
                    <input readonly type="text" class="mt-2 block p-2 w-80 rounded-md border-gray-500 shadow-sm 
                    focus:border-gray-500 focus:ring focus:ring-gray-500 
                    focus:ring-opacity-50" placeholder="" name="uniqid_discord" id="uniqid_discord" 
                    value="<?= $perguruan["uniqid_discord"]; ?>" autocomplete="off" required />
                </label>

                <label for="" class="grid items-center mt-10">
                    <button type="submit" name="terima" class="border-2 border-white 
                    rounded-full font-bold text-white px-6 py-2 transition duration-50 
                    ease-out hover:bg-white hover:text-black">Terima
                    </button>
                </label>

                <label for="" class="grid items-center mt-4">
                    <button type="submit" name="tolak" class="border-2 border-white 
                    rounded-full font-bold text-white px-6 py-2 transition duration-50 
                    ease-out hover:bg-white hover:text-black">Tolak
                    </button>
                </label>
            </form>
        </div>
        <!-- end form -->

        <!-- footer -->
        <div class="pt-4">
            <footer class="flex flex-wrap items-center justify-between p-3 m-auto">
                <div class="container mx-auto flex flex-col flex-wrap items-center justify-between">
                    <div class="flex mx-auto text-white text-center font-semibold">
                        Presented by. Sulaimu
                    </div>
                </div>
            </footer>
        </div>
        <!-- end footer -->

        <script src="../js/index.js"></script>
</body>
</html>
