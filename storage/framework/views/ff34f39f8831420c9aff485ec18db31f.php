<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Status Update</title>
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

        .status-icon {
            text-align: center;
            font-size: 60px;
            margin: 20px 0;
        }

        .status-pending { color: #f59e0b; }
        .status-in_progress { color: #3b82f6; }
        .status-resolved { color: #10b981; }
        .status-closed { color: #6b7280; }
        .status-rejected { color: #ef4444; }

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
            <?php
                $statusIcon = match($request->status) {
                    'pending' => '⏳',
                    'under_review' => '🔍',
                    'in_progress' => '🔄',
                    'resolved' => '✅',
                    'closed' => '🔒',
                    'rejected' => '❌',
                    default => '📝'
                };
                $statusClass = 'status-' . $request->status;
            ?>
            <div class="status-icon <?php echo e($statusClass); ?>"><?php echo e($statusIcon); ?></div>
            <h2 style="text-align: center;">Request Status Update</h2>
            <p>Dear <?php echo e($request->user->name); ?>,</p>
            <p>Your scholar request status has been updated to: <strong><?php echo e(ucfirst($request->status)); ?></strong></p>
            <div class="info-box">
                <strong>Request ID:</strong> #<?php echo e($request->id); ?><br>
                <strong>Subject:</strong> <?php echo e($request->subject); ?><br>
                <strong>Type:</strong> <?php echo e(ucfirst(str_replace('_', ' ', $request->request_type))); ?><br>
                <strong>Priority:</strong> <?php echo e(ucfirst($request->priority)); ?><br>
                <strong>Status:</strong> <?php echo e(ucfirst($request->status)); ?><br>
                <strong>Last Updated:</strong> <?php echo e($request->updated_at->format('F d, Y \a\t h:i A')); ?>

            </div>
            <h3>Your Request:</h3>
            <p style="background: #f9fafb; padding: 15px; border-radius: 4px;"><?php echo e($request->description); ?></p>
            <?php if($request->admin_notes): ?>
                <h3>Admin Notes:</h3>
                <p style="background: #fef3c7; padding: 15px; border-radius: 4px; border-left: 4px solid #f59e0b;"><?php echo e($request->admin_notes); ?></p>
            <?php endif; ?>
            <div style="text-align: center;">
                <a href="<?php echo e(url('/scholar/requests/my-requests')); ?>" class="button">View My Requests</a>
            </div>
            <p style="margin-top: 30px;">If you have any questions about this update, please don't hesitate to contact us.</p>
            <p>Best regards,<br><strong>The OA Foundation Team</strong></p>
        </div>
        <div class="footer">
            <p>&copy; <?php echo e(date('Y')); ?> OA Foundation. All rights reserved.</p>
        </div>
    </div>
</body>

</html><?php /**PATH C:\Users\user\OneDrive\tech.olaarowolo.com\Dev\OAScholarshipLiveApp01092026\resources\views/emails/scholar-request-status-update.blade.php ENDPATH**/ ?>