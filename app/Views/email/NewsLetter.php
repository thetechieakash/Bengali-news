<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Comment Reply Notification</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:6px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,0.08);">
                    <tr>
                        <td style="background:#0d6efd;color:#ffffff;padding:18px 25px;font-size:20px;text-align:center;font-weight:bold;">
                            <?= esc($siteName) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;text-align:center">
                            <div style="margin-bottom:15px;">
                                <svg width="60" height="60" viewBox="0 0 24 24" fill="#0d6efd" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 22a2 2 0 0 0 2-2h-4a2 2 0 0 0 2 2zm6-6V11a6 6 0 1 0-12 0v5l-2 2v1h16v-1l-2-2z" />
                                </svg>
                            </div>
                            <h2 style="margin:0;color:#333;">New news posted, Read now</h2>
                            <div style="text-align:left; margin:0px 10px">
                                <ul style="list-style-type:none;">
                                    <?php foreach ($news as $n): ?>
                                        <li style="margin:5px 0px;">
                                            <a href="<?= base_url('news/' . $n['slug']) ?>" style="font-size:16px;font-weight:600;color:#222; text-decoration:none;">
                                                <?= esc($n['headline']) ?>
                                            </a>
                                            <svg width="20px" height="20px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0 0h48v48H0z" fill="none" />
                                                <g id="Shopicon">
                                                    <polygon points="8,26 33.172,26 19.172,40 22,42.828 40.828,24 22,5.172 19.172,8 33.172,22 8,22 	" />
                                                </g>
                                            </svg>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div style="margin-top:25px;">
                                <p style="margin-top:20px;font-size:12px;color:#777;">
                                    If you no longer want emails,
                                    <a href="<?= $unsubscribe ?>" style="color:#222;">unsubscribe</a>
                                </p>
                            </div>
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