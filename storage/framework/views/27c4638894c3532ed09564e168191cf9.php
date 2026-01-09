<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Scholar Request</title>
    <style>
        body {
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px 20px;
        }

        .alert-box {
            background: #fee2e2;
            border-left: 4px solid #dc2626;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .info-box {
            background: #f0f9ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .details-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .details-table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .details-table td:first-child {
            font-weight: bold;
            color: #4b5563;
            width: 40%;
        }

        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🚨 New Scholar Request</h1>
        </div>
        <div class="content">
            <h2>New Request Submitted</h2>
            <p>A scholar has submitted a new request that requires your attention.</p>
            <div class="alert-box">
                <strong>Priority:</strong> <?php echo e(ucfirst($request->priority)); ?>

            </div>
            <table class="details-table">
                <tr>
                    <td>Request ID:</td>
                    <td>#<?php echo e($request->id); ?></td>
                </tr>
                <tr>
                    <td>Scholar:</td>
                    <td><?php echo e($request->user->name); ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo e($request->user->email); ?></td>
                </tr>
                <tr>
                    <td>Type:</td>
                    <td><?php echo e(ucfirst(str_replace('_', ' ', $request->request_type))); ?></td>
                </tr>
                <tr>
                    <td>Subject:</td>
                    <td><?php echo e($request->subject); ?></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><?php echo e(ucfirst($request->status)); ?></td>
                </tr>
                <tr>
                    <td>Submitted:</td>
                    <td><?php echo e($request->created_at->format('F d, Y \a\t h:i A')); ?></td>
                </tr>
            </table>
            <h3>Request Description:</h3>
            <p style="background: #f9fafb; padding: 15px; border-radius: 4px; white-space: pre-wrap;">
                <?php echo e($request->description); ?></p>
            <div style="text-align: center;">
                <a href="<?php echo e(url('/admin/scholar-requests/' . $request->id)); ?>" class="button">View & Respond</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; <?php echo e(date('Y')); ?> OA Foundation Admin Panel</p>
        </div>
    </div>
</body>

</html>
<?php /**PATH /home1/httprapu/scholarship.olaarowolo.com/resources/views/emails/admin-scholar-request-notification.blade.php ENDPATH**/ ?>