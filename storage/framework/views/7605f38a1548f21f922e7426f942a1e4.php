<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accept Terms and Cookies</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/styles.css')); ?>">
</head>
<body>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Accept Terms and Cookies</h1>
        <p class="mb-6">Please read and accept our terms and cookies policy to continue using the website.</p>

        <form action="<?php echo e(route('terms.accept')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label for="device" class="block text-sm font-medium text-gray-700">Device Information</label>
                <input type="text" id="device" name="device" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" id="location" name="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="credentials" class="block text-sm font-medium text-gray-700">Credentials</label>
                <input type="text" id="credentials" name="credentials" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="btn-primary px-4 py-2 rounded">Accept</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php /**PATH /Users/olasunkanmiarowolo/scholarship.olaarowolo.com/resources/views/terms-acceptance.blade.php ENDPATH**/ ?>