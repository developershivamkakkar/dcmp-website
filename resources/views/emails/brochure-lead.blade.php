<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Brochure Lead</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f9fc; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center" style="padding: 30px 15px;">
                <!-- Outer Card -->
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">

                    <!-- Header with Logo -->
                    <tr>
                        <td align="center" style="background: #004085; padding: 20px;">
                            <img src="https://dassandbrownschool.com/storage/assets/dbs-logo.webp" alt="School Logo"
                                width="120" style="display:block; margin:0 auto;">
                            <h2 style="color:#ffffff; margin:15px 0 0; font-size:22px; font-weight:normal;">New Brochure
                                Lead</h2>
                        </td>
                    </tr>

                    <!-- Lead Details -->
                    <tr>
                        <td style="padding: 30px; color: #333;">
                            <p style="font-size: 16px; margin: 0 0 15px;">You’ve received a new brochure enquiry from
                                Website . Here
                                are the details:</p>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="font-size: 15px; line-height: 1.6;">
                                <tr>
                                    <td width="120"><strong>Name:</strong></td>
                                    <td>{{ $data['name'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $data['email'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $data['phone'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>City:</strong></td>
                                    <td>{{ $data['city'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background: #f1f4f9; padding: 15px; text-align: center; font-size: 12px; color: #777;">
                            This lead was captured from the <strong>school website brochure download form</strong>.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
