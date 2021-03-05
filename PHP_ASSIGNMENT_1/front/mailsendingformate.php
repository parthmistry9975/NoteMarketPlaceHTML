<!DOCTYPE html>
                                        <html lang="en">

                                        <head>
                                            <meta charset="UTF-8">
                                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
                                            <title>Notes Market Place-Email verification</title>

                                            <!-- Google Fonts -->
                                            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
                                        </head>

                                        <body style="background: #6255a5;">
                                            <table style="height:40%;width: 40%; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);font-family:Open Sans !important;background: #fff;border-radius: 3px;padding-left: 2%;padding-right: 2%;">
                                                <thead>
                                                    <th>
                                                        <img src="../images/logo/top-logo1.png" alt="logo" style="margin-top: 5%;">
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    <tr style="height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;">
                                                        <td class="text-1">Email Verification</td>
                                                    </tr>
                                                    <tr style="height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;">
                                                        <td class="text-2">Dear '.$FirstName.' '.$LastName.',</td>
                                                    </tr>
                                                    <tr style="height: 60px;">
                                                        <td class="text-3">
                                                            Thanks for Signing up! <br>
                                                            Simply click below for email verification.
                                                        </td>
                                                    </tr>
                                                    <tr style="height: 120px;font-size: 16px;font-weight: 400;line-height: 22px;color: #333333;margin-bottom: 50px;">
                                                        <td style="text-align: center;">
                                                            <a href="localhost/NoteMarketPlaceHTML/front/emailverification.php?id='.$EmailID.'">
                                                            <button class="btn btn-verify" style="width: 100% !important;height:50px;font-family: Open Sans; font-size: 18px;font-weight: 600;line-height: 22px;color: #fff;background-color: #6255a5;border-radius: 3px;">VERIFY EMAIL ADDRESS</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </body>

                                        </html>