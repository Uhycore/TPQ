<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased leading-normal tracking-normal h-full">
    <!-- Navbar -->
    <nav class="shadow-sm bg-white mb-1">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>

    <div class="flex justify-center items-center min-h-screen h-full">
        <!-- Logo Lingkaran -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <!-- Circle 1 -->
            <a href="index.php?modul=role&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-list"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-700">List Role</p>
                </div>
            </a>
            <!-- Circle 2 -->
            <a href="index.php?modul=role&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-plus"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-700">Add Role</p>
                </div>
            </a>
            <!-- Circle 3 -->
            <a href="index.php?modul=user&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-700">List User</p>
                </div>
            </a>
            <!-- Circle 4 -->
            <a href="index.php?modul=user&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-plus"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Users</p>
                </div>
            </a>

        </div>
    </div>

</body>

</html>