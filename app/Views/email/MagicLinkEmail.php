<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('Auth.magicLinkSubject') ?></title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:40px 0;">
        <tr>
            <td align="center">

                <!-- EMAIL CARD -->
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.08);overflow:hidden;">

                    <!-- HEADER -->
                    <tr>
                        <td style="background:#0d6efd;padding:25px;text-align:center;color:#ffffff;font-size:22px;font-weight:bold;">
                            Admin Magic Login
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:35px;color:#333333;font-size:15px;line-height:1.6;">

                            <p>Hello <strong><?= esc($user->username) ?></strong>,</p>

                            <p>You requested a secure login to your admin account. Click the button below to sign in instantly.</p>

                            <!-- BUTTON -->
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding:25px 0;">
                                        <a href="<?= url_to('verify-magic-link') ?>?token=<?= $token ?>"
                                            style="
background:#0d6efd;
color:#ffffff;
text-decoration:none;
padding:14px 30px;
border-radius:6px;
font-weight:bold;
font-size:16px;
display:inline-block;
">
                                            <?= lang('Auth.login') ?>
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="color:#666;">This magic login link will expire soon for security reasons.</p>

                        </td>
                    </tr>

                    <!-- LOGIN DETAILS -->
                    <tr>
                        <td style="background:#f8f9fa;padding:25px;border-top:1px solid #eeeeee;">

                            <table width="100%" style="font-size:14px;color:#444;">
                                <tr>
                                    <td style="padding:6px 0;"><strong><?= lang('Auth.username') ?>:</strong></td>
                                    <td><?= esc($user->username) ?></td>
                                </tr>

                                <tr>
                                    <td style="padding:6px 0;"><strong><?= lang('Auth.emailIpAddress') ?>:</strong></td>
                                    <td><?= esc($ipAddress) ?></td>
                                </tr>

                                <tr>
                                    <td style="padding:6px 0;"><strong><?= lang('Auth.emailDevice') ?>:</strong></td>
                                    <td><?= esc($userAgent) ?></td>
                                </tr>

                                <tr>
                                    <td style="padding:6px 0;"><strong><?= lang('Auth.emailDate') ?>:</strong></td>
                                    <td><?= esc($date) ?></td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="padding:20px;text-align:center;font-size:12px;color:#999;border-top:1px solid #eeeeee;">

                            If you did not request this login, you can safely ignore this email.

                            <br><br>

                            © <?= date('Y') ?> Your News Portal

                        </td>
                    </tr>

                </table>
                <!-- END CARD -->

            </td>
        </tr>
    </table>

</body>

</html>