<?php
$error = false;
$success = false;
require "./particial/_dbconnect.php";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $sql = "SELECT *FROM `registration` WHERE `Email`='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row == 1) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $gmail = $rows['Email'];
            $password = $rows['Password'];
            // echo $password;
            $to_email = $gmail;
            $subject = "farco?forgot password";
            //         $htmlContent = '
            // <html>
            // <head>
            //     <title>Welcome to CodexWorld</title>
            // </head>
            // <body>
            //     <h1>Thanks you for joining with us!</h1>
            //     <p style="padding:5px;display:block;background:rgba(0,250,0,.7);color:black;">Your username : ' . $gmail . '</p>
            //     <p style="padding:5px;display:block;background:rgba(0,250,0,.7);color:black;">Click here to reset your password : http://farco.atwebpages.com/farco/reset_password.php?token=' . $password . '</p>
            //     </body>
            // </html>';
            $htmlContent = '<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <!-- NAME: 1 COLUMN -->
    <!--[if gte mso 15]>
      <xml>
        <o:OfficeDocumentSettings>
          <o:AllowPNG/>
          <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
      </xml>
    <![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Your Lingo Password</title>
    <!--[if !mso]>
      <!-- -->
    <link href="https://fonts.googleapis.com/css?family=Asap:400,400italic,700,700italic" rel="stylesheet" type="text/css">
    <!--<![endif]-->
    <style type="text/css">
        @media only screen and (min-width:768px) {
            .templateContainer {
                width: 600px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            body,
            table,
            td,
            p,
            a,
            li,
            blockquote {
                -webkit-text-size-adjust: none !important;
            }

        }

        @media only screen and (max-width: 480px) {
            body {
                width: 100% !important;
                min-width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {
            #bodyCell {
                padding-top: 10px !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnImage {
                width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            .mcnCaptionTopContent,
            .mcnCaptionBottomContent,
            .mcnTextContentContainer,
            .mcnBoxedTextContentContainer,
            .mcnImageGroupContentContainer,
            .mcnCaptionLeftTextContentContainer,
            .mcnCaptionRightTextContentContainer,
            .mcnCaptionLeftImageContentContainer,
            .mcnCaptionRightImageContentContainer,
            .mcnImageCardLeftTextContentContainer,
            .mcnImageCardRightTextContentContainer {
                max-width: 100% !important;
                width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnBoxedTextContentContainer {
                min-width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnImageGroupContent {
                padding: 9px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            .mcnCaptionLeftContentOuter .mcnTextContent,
            .mcnCaptionRightContentOuter .mcnTextContent {
                padding-top: 9px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            .mcnImageCardTopImageContent,
            .mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent {
                padding-top: 18px !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnImageCardBottomImageContent {
                padding-bottom: 9px !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnImageGroupBlockInner {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnImageGroupBlockOuter {
                padding-top: 9px !important;
                padding-bottom: 9px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            .mcnTextContent,
            .mcnBoxedTextContentColumn {
                padding-right: 18px !important;
                padding-left: 18px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            .mcnImageCardLeftImageContent,
            .mcnImageCardRightImageContent {
                padding-right: 18px !important;
                padding-bottom: 0 !important;
                padding-left: 18px !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcpreview-image-uploader {
                display: none !important;
                width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
      @tab Mobile Styles
      @section Heading 1
      @tip Make the first-level headings larger in size for better readability
   on small screens.
      */
            h1 {
                /*@editable*/
                font-size: 20px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
      @tab Mobile Styles
      @section Heading 2
      @tip Make the second-level headings larger in size for better
   readability on small screens.
      */
            h2 {
                /*@editable*/
                font-size: 20px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
      @tab Mobile Styles
      @section Heading 3
      @tip Make the third-level headings larger in size for better readability
   on small screens.
      */
            h3 {
                /*@editable*/
                font-size: 18px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
      @tab Mobile Styles
      @section Heading 4
      @tip Make the fourth-level headings larger in size for better
   readability on small screens.
      */
            h4 {
                /*@editable*/
                font-size: 16px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
      @tab Mobile Styles
      @section Boxed Text
      @tip Make the boxed text larger in size for better readability on small
   screens. We recommend a font size of at least 16px.
      */
            .mcnBoxedTextContentContainer .mcnTextContent,
            .mcnBoxedTextContentContainer .mcnTextContent p {
                /*@editable*/
                font-size: 16px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
      @tab Mobile Styles
      @section Preheader Visibility
      @tip Set the visibility of the email s preheader on small screens. You
   can hide it to save space.
      */
            #templatePreheader {
                /*@editable*/
                display: block !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
      @tab Mobile Styles
      @section Preheader Text
      @tip Make the preheader text larger in size for better readability on
   small screens.
      */
            #templatePreheader .mcnTextContent,
            #templatePreheader .mcnTextContent p {
                /*@editable*/
                font-size: 12px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
      @tab Mobile Styles
      @section Header Text
      @tip Make the header text larger in size for better readability on small
   screens.
      */
            #templateHeader .mcnTextContent,
            #templateHeader .mcnTextContent p {
                /*@editable*/
                font-size: 16px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
      @tab Mobile Styles
      @section Body Text
      @tip Make the body text larger in size for better readability on small
   screens. We recommend a font size of at least 16px.
      */
            #templateBody .mcnTextContent,
            #templateBody .mcnTextContent p {
                /*@editable*/
                font-size: 16px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
      @tab Mobile Styles
      @section Footer Text
      @tip Make the footer content text larger in size for better readability
   on small screens.
      */
            #templateFooter .mcnTextContent,
            #templateFooter .mcnTextContent p {
                /*@editable*/
                font-size: 12px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }
    </style>
</head>

<body style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 background-color: #fed149; height: 100%; margin: 0; padding: 0; width: 100%">
    <center>
        <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" id="bodyTable" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; background-color: #fed149; height: 100%; margin: 0; padding: 0; width:
 100%" width="100%">
            <tr>
                <td align="center" id="bodyCell" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-top: 0;
 height: 100%; margin: 0; padding: 0; width: 100%" valign="top">
                    <!-- BEGIN TEMPLATE // -->
                    <!--[if gte mso 9]>
              <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                <tr>
                  <td align="center" valign="top" width="600" style="width:600px;">
                  <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" class="templateContainer" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; max-width:
 600px; border: 0" width="100%">
                        <tr>
                            <td id="templatePreheader" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #fed149;
 border-top: 0; border-bottom: 0; padding-top: 16px; padding-bottom: 8px" valign="top">
                                <table border="0" cellpadding="0" cellspacing="0" class="mcnTextBlock" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 min-width:100%;" width="100%">
                                    <tbody class="mcnTextBlockOuter">
                                        <tr>
                                            <td class="mcnTextBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%" valign="top">
                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnTextContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; min-width:100%;" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td class="mcnTextContent" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; word-break: break-word;
 color: #2a2a2a; font-family: "Asap", Helvetica, sans-serif; font-size: 12px;
 line-height: 150%; text-align: left; padding-top:9px; padding-right: 18px;
 padding-bottom: 9px; padding-left: 18px;" valign="top">
                                                                <a href="https://www.lingoapp.com" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #2a2a2a;
 font-weight: normal; text-decoration: none" target="_blank" title="Lingo is the
 best way to organize, share and use all your visual assets in one place -
 all on your desktop.">
                                                                    <img align="none" alt="Lingo is the best way to
 organize, share and use all your visual assets in one place - all on your desktop." height="62" src="https://i.ibb.co/2tNMfRB/logo.png" style="-ms-interpolation-mode: bicubic; border: 0; outline: none;
 text-decoration: none; height: auto; width: 107px; height: 42px; margin: 0px;" width="107" />
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td id="templateHeader" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f7f7ff;
 border-top: 0; border-bottom: 0; padding-top: 16px; padding-bottom: 0" valign="top">
                                <table border="0" cellpadding="0" cellspacing="0" class="mcnImageBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 min-width:100%;" width="100%">
                                    <tbody class="mcnImageBlockOuter">
                                        <tr>
                                            <td class="mcnImageBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding:0px" valign="top">
                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; min-width:100%;" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td class="mcnImageContent" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-right: 0px;
 padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;" valign="top">
                                                                <a class="" href="https://www.lingoapp.com" style="mso-line-height-rule:
 exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color:
 #f57153; font-weight: normal; text-decoration: none" target="_blank" title="">
                                                                    <a class="" href="https://www.lingoapp.com/" style="mso-line-height-rule:
 exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color:
 #f57153; font-weight: normal; text-decoration: none" target="_blank" title="">
                                                                        <img align="center" alt="Forgot your password?" class="mcnImage" src="https://static.lingoapp.com/assets/images/email/il-password-reset@2x.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none;
 text-decoration: none; vertical-align: bottom; max-width:1200px; padding-bottom:
 0; display: inline !important; vertical-align: bottom;" width="600"></img>
                                                                    </a>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td id="templateBody" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f7f7ff;
 border-top: 0; border-bottom: 0; padding-top: 0; padding-bottom: 0" valign="top">
                                <table border="0" cellpadding="0" cellspacing="0" class="mcnTextBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width:100%;" width="100%">
                                    <tbody class="mcnTextBlockOuter">
                                        <tr>
                                            <td class="mcnTextBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%" valign="top">
                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnTextContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; min-width:100%;" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td class="mcnTextContent" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; word-break: break-word;
 color: #2a2a2a; font-family: "Asap", Helvetica, sans-serif; font-size: 16px;
 line-height: 150%; text-align: center; padding-top:9px; padding-right: 18px;
 padding-bottom: 9px; padding-left: 18px;" valign="top">

                                                                <h1 class="null" style="color: #2a2a2a; font-family: "Asap", Helvetica,
 sans-serif; font-size: 32px; font-style: normal; font-weight: bold; line-height:
 125%; letter-spacing: 2px; text-align: center; display: block; margin: 0;
 padding: 0"><span style="text-transform:uppercase">Forgot</span></h1>


                                                                <h2 class="null" style="color: #2a2a2a; font-family: "Asap", Helvetica,
 sans-serif; font-size: 24px; font-style: normal; font-weight: bold; line-height:
 125%; letter-spacing: 1px; text-align: center; display: block; margin: 0;
 padding: 0"><span style="text-transform:uppercase">your password?</span></h2>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" class="mcnTextBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace:
 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 min-width:100%;" width="100%">
                                    <tbody class="mcnTextBlockOuter">
                                        <tr>
                                            <td class="mcnTextBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%" valign="top">
                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnTextContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; min-width:100%;" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td class="mcnTextContent" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; word-break: break-word;
 color: #2a2a2a; font-family: "Asap", Helvetica, sans-serif; font-size: 16px;
 line-height: 150%; text-align: center; padding-top:9px; padding-right: 18px;
 padding-bottom: 9px; padding-left: 18px;" valign="top">Not to worry, we got you! Let’s get you a new password.
                                                                <br></br>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" class="mcnButtonBlock" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 min-width:100%;" width="100%">
                                    <tbody class="mcnButtonBlockOuter">
                                        <tr>
                                            <td align="center" class="mcnButtonBlockInner" style="mso-line-height-rule:
 exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 padding-top:18px; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0" class="mcnButtonBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width:100%;" width="100%">
                                                    <tbody class="mcnButtonBlockOuter">
                                                        <tr>
                                                            <td align="center" class="mcnButtonBlockInner" style="mso-line-height-rule:
 exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top">
                                                                <table border="0" cellpadding="0" cellspacing="0" class="mcnButtonContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 border-collapse: separate !important;border-radius: 48px;background-color:
 #F57153;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" class="mcnButtonContent" style="mso-line-height-rule:
 exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 font-family: "Asap", Helvetica, sans-serif; font-size: 16px; padding-top:24px;
 padding-right:48px; padding-bottom:24px; padding-left:48px;" valign="middle">
                                                                                <a class="mcnButton " href="http://farco.atwebpages.com/farco/reset_password.php?token=' . $password . '" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; display: block; color: #f57153;
 font-weight: normal;padding:5px; text-decoration: none; font-weight: normal;letter-spacing:
 1px;line-height: 100%;text-align: center;text-decoration: none;color:
 #FFFFFF; text-transform:uppercase;" target="_blank" title="Review Lingo kit
 invitation">Reset password</a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" class="mcnImageBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width:100%;" width="100%">
                                    <tbody class="mcnImageBlockOuter">
                                        <tr>
                                            <td class="mcnImageBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding:0px" valign="top">
                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; min-width:100%;" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td class="mcnImageContent" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-right: 0px;
 padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;" valign="top"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td id="templateFooter" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #fed149;
 border-top: 0; border-bottom: 0; padding-top: 8px; padding-bottom: 80px" valign="top">
                                <table border="0" cellpadding="0" cellspacing="0" class="mcnTextBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width:100%;" width="100%">
                                    <tbody class="mcnTextBlockOuter">
                                        <tr>
                                            <td class="mcnTextBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%" valign="top">
                                                <table align="center" bgcolor="#F7F7FF" border="0" cellpadding="32" cellspacing="0" class="card" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; background:#F7F7FF; margin:auto; text-align:left; max-width:600px;
 font-family: "Asap", Helvetica, sans-serif;" text-align="left" width="100%">

                                                </table>
                                                <!-- <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width:100%;" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; padding-top: 24px; padding-right: 18px;
 padding-bottom: 24px; padding-left: 18px; color: #7F6925; font-family: "Asap",
 Helvetica, sans-serif; font-size: 12px;" valign="top">
                                                                <div style="text-align: center;">Made with
                                                                    <a href="https://thenounproject.com/" style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; color: #f57153; font-weight: normal; text-decoration:
 none" target="_blank">
                                                                        <img align="none" alt="Heart icon" height="10" src="https://static.lingoapp.com/assets/images/email/made-with-heart.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none;
 text-decoration: none; width: 10px; height: 10px; margin: 0px;" width="10" />
                                                                    </a>by
                                                                    <a href="https://thenounproject.com/" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #f57153;
 font-weight: normal; text-decoration: none; color:#7F6925;" target="_blank" title="Noun Project - Icons for Everything">Noun Project</a>in Culver City, CA 90232
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <tbody></tbody>
                                    </tbody>
                                </table> -->
                                <table align="center" border="0" cellpadding="12" style="border-collapse:
 collapse; mso-table-lspace: 0; mso-table-rspace: 0; -ms-text-size-adjust:
 100%; -webkit-text-size-adjust: 100%; ">
                                    <tbody>
                                        <tr>
                                            <td style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%">
                                                <a href="#" style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; color: #f57153; font-weight: normal; text-decoration: none" target="_blank">
                                                    <img alt="twitter" height="32" src="https://static.lingoapp.com/assets/images/email/twitter-ic-32x32-email@2x.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none; text-decoration:
 none" width="32" />
                                                </a>
                                            </td>
                                            <td style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%">
                                                <a href="#" style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; color: #f57153; font-weight: normal; text-decoration:
 none" target="_blank">
                                                    <img alt="Instagram" height="32" src="https://static.lingoapp.com/assets/images/email/instagram-ic-32x32-email@2x.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none;
 text-decoration: none" width="32" />
                                                </a>
                                            </td>
                                            <td style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%">
                                                <a href="#" style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; color: #f57153; font-weight: normal; text-decoration: none" target="_blank">
                                                    <img alt="medium" height="32" src="https://static.lingoapp.com/assets/images/email/medium-ic-32x32-email@2x.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none; text-decoration: none" width="32" />
                                                </a>
                                            </td>
                                            <td style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%">
                                                <a href="#" style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; color: #f57153; font-weight: normal; text-decoration: none" target="_blank">
                                                    <img alt="facebook" height="32" src="https://static.lingoapp.com/assets/images/email/facebook-ic-32x32-email@2x.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none;
 text-decoration: none" width="32" />
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if gte mso 9]>
                  </td>
                </tr>
              </table>
            <![endif]-->
        <!-- // END TEMPLATE -->
        </td>
        </tr>
        </table>
    </center>
</body>

</html>';

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From:replay.farco.in@gmail.com";
            if (mail($to_email, $subject, $htmlContent, $headers)) {
                $success = true;
            } else {
                $errorMessage = error_get_last()['message'];
                echo "   " . $errorMessage . "error";
            }
        }
    } else {
        $error = true;
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="./image/icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/_scroll.css">
    <title>forgot_password</title>
</head>

<body>
    <?php
    require "./particial/_navbar.php";
    ?>
    <?php
    if ($success) {
        echo '<div class="alert alert-true alert-dismissible fade show" role="alert">
    <strong style="font-size:25px">Success!</strong>
    <span style="font-size:20px;">we have been sent forgot password link on you gmail Account</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    }
    if ($error) {
        echo '<div class="alert alert-error alert-dismissible fade show" role="alert">
    <strong style="font-size:25px">Error!</strong>
    <span style="font-size:20px;">your username and password is invalid!</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    }
    ?>


    <!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->
    <?php
    include "html/scrollbar.html";
    ?>
    <!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->

    <h1>Forgot Password</h1>

    <div class="container my-4">
        <form action="" method="POST">
            <div class="form-group">
                <small id="emailHelp" class="form-text text-muted"><span style="color:green;font-size:15px;font-family:Arial, Helvetica, sans-serif">We get it, stuff happens. Just enter your email address below and we'll send your password!</span></small>
                <label for="username"><i class="fa fa-envelope" aria-hidden="true"></i> Email <span style="color:red">
                        *</span></label>
                <input type="email" class="form-control bg-nue" id="username" name="email" placeholder="Enter registered email address" required aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted"><span style="color:green;font-size:15px;font-family:Arial, Helvetica, sans-serif">We'll never share your email
                        with anyone else.</span></small>
            </div>
            <button type="submit" name="submit" class="btn-login btn-block my-4">Login</button>
        </form>
    </div>

    <br><br>




    <!-- -----------------------------------------------------script for scrollbar------------------------------------------- -->
    <script type="text/javascript">
        let progress = document.getElementById('progressbar');
        let totalHeight = document.body.scrollHeight - window.innerHeight;
        window.onscroll = function() {
            let progressHeight = (window.pageYOffset / totalHeight) * 100;
            progress.style.height = progressHeight + "%";
        }
    </script>

</body>

</html>