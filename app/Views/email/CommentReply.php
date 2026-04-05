<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <style>
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }

            .padding {
                padding: 20px !important;
            }

            .btn {
                width: 100% !important;
                display: block !important;
            }

            .text-center {
                text-align: center !important;
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:20px 10px;">
        <tr>
            <td align="center">
                <!-- MAIN CONTAINER -->
                <table class="container" width="100%" cellpadding="0" cellspacing="0"
                    style="max-width:600px;background:#ffffff;border-radius:6px;overflow:hidden;">
                    <!-- HEADER -->
                    <tr>
                        <td style="background:#0d6efd;color:#ffffff;padding:18px;text-align:center;font-size:20px;font-weight:bold;">
                            <?= esc($siteName) ?>
                        </td>
                    </tr>
                    <!-- CONTENT -->
                    <tr>
                        <td class="padding" style="padding:30px;text-align:center;">
                            <!-- ICON (fallback emoji instead of svg) -->
                            <div style="font-size:40px;margin-bottom:15px;">🔔</div>
                            <h2 style="margin:0;color:#333;">Hello <?= esc($name) ?>,</h2>
                            <p style="font-size:15px;color:#555;margin-top:10px;">
                                You have a new notification.
                            </p>
                            <p style="font-size:15px;color:#555;line-height:1.6;">
                                The admin has replied to your comment on:
                            </p>
                            <p style="font-size:16px;font-weight:bold;color:#222;">
                                <?= esc($postTitle) ?>
                            </p>
                            <!-- BUTTON -->
                            <table cellpadding="0" cellspacing="0" style="margin-top:25px;">
                                <tr>
                                    <td align="center" bgcolor="#0d6efd" style="border-radius:4px;">
                                        <a href="<?= esc($link) ?>"
                                            style="display:block;width:100%;max-width:250px;padding:12px;text-align:center;color:#fff;text-decoration:none;">View Reply</a>
                                    </td>
                                </tr>
                            </table>
                            <!-- FALLBACK LINK -->
                            <p style="margin-top:25px;font-size:13px;color:#777;">
                                If button doesn’t work:
                            </p>
                            <p style="font-size:12px;color:#0d6efd;word-break:break-all;">
                                <?= esc($link) ?>
                            </p>
                        </td>
                    </tr>
                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#f1f1f1;padding:15px;text-align:center;font-size:12px;color:#777;">
                            © <?= date('Y') ?> <?= esc($siteName) ?>. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>