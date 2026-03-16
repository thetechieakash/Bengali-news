<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>New Comment Reply Notification</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:30px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:6px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,0.08);">

                    <tr>
                        <td style="background:#0d6efd;color:#ffffff;padding:18px 25px;font-size:20px;font-weight:bold;">
                            <?= esc($siteName) ?>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:30px;text-align:center">

                            <!-- Notification Icon -->

                            <div style="margin-bottom:15px;">
                                <svg width="60" height="60" viewBox="0 0 24 24" fill="#0d6efd" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 22a2 2 0 0 0 2-2h-4a2 2 0 0 0 2 2zm6-6V11a6 6 0 1 0-12 0v5l-2 2v1h16v-1l-2-2z" />
                                </svg>
                            </div>

                            <h2 style="margin:0;color:#333;">Hello <?= esc($name) ?>,</h2>

                            <p style="font-size:15px;color:#555;margin-top:10px;">
                                You have a new notification.
                            </p>

                            <p style="font-size:15px;color:#555;line-height:1.6;">
                                The admin has replied to your comment on the article:
                            </p>

                            <p style="font-size:16px;font-weight:bold;color:#222;">
                                <?= esc($postTitle) ?>
                            </p>

                            <div style="margin-top:25px;">
                                <a href="<?= esc($link) ?>"
                                    style="background:#0d6efd;color:#ffffff;text-decoration:none;padding:12px 25px;border-radius:4px;font-size:15px;font-weight:bold;display:inline-block;">
                                    View Reply
                                </a>
                            </div>

                            <p style="margin-top:30px;font-size:13px;color:#777;">
                                If the button above doesn't work, copy and paste this link into your browser:
                            </p>

                            <p style="font-size:12px;color:#0d6efd;word-break:break-all;">
                                <?= esc($link) ?>
                            </p>

                        </td>
                    </tr>

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