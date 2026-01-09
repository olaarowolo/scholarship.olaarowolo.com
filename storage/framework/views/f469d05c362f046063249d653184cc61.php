<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Submitted Successfully</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

        .success-icon {
            text-align: center;
            font-size: 60px;
            color: #10b981;
            margin: 20px 0;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎓 OA Foundation Scholarship</h1>
        </div>
        <div class="content">
            <div class="success-icon">✓</div>
            <h2 style="text-align: center; color: #10b981;">Request Submitted Successfully!</h2>
            <p>Dear <?php echo e($request->user->name); ?>,</p>
            <p>Your request has been successfully submitted and our team will review it shortly.</p>
            <div class="info-box">
                <strong>Request ID:</strong> #<?php echo e($request->id); ?><br>
                <strong>Subject:</strong> <?php echo e($request->subject); ?><br>
                <strong>Type:</strong> <?php echo e(ucfirst(str_replace('_', ' ', $request->request_type))); ?><br>
                <strong>Priority:</strong> <?php echo e(ucfirst($request->priority)); ?><br>
                <strong>Status:</strong> <?php echo e(ucfirst($request->status)); ?><br>
                <strong>Submitted:</strong> <?php echo e($request->created_at->format('F d, Y \a\t h:i A')); ?>

            </div>
            <h3>Your Request:</h3>
            <p style="background: #f9fafb; padding: 15px; border-radius: 4px;"><?php echo e($request->description); ?></p>
            <div style="text-align: center;">
                <a href="<?php echo e(url('/scholar/requests/my-requests')); ?>" class="button">View My Requests</a>
            </div>
            <p style="margin-top: 30px;">We will respond to your request as soon as possible. You will receive email
                updates on its progress.</p>
            <p>Best regards,<br><strong>The OA Foundation Team</strong></p>
        </div>
        <div class="footer">
            <p>&copy; <?php echo e(date('Y')); ?> OA Foundation. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
<?php /**PATH /home1/httprapu/scholarship.olaarowolo.com/resources/views/emails/scholar-request-submitted.blade.php ENDPATH**/ ?>