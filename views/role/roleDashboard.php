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
        <div class="grid grid-cols-5 gap-6 mb-8">
            <!-- Role List -->
            <a href="index.php?modul=role&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-list"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-700">List Role</p>
                </div>
            </a>
            <!-- Role Add -->
            <a href="index.php?modul=role&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-plus"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-700">Add Role</p>
                </div>
            </a>
            <!-- User List -->
            <a href="index.php?modul=user&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-700">List User</p>
                </div>
            </a>
            <!-- User Add -->
            <a href="index.php?modul=user&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-plus"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Users</p>
                </div>
            </a>
            <!-- Santri List -->
            <a href="index.php?modul=santri&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-user"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">List Santri</p>
                </div>
            </a>
            <!-- Santri Add -->
            <a href="index.php?modul=santri&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-plus"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Santri</p>
                </div>
            </a>
            <!-- Santri Nilai -->
            <a href="index.php?modul=user&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Nilai Santri</p>
                </div>
            </a>
            <!-- Mapel List -->
            <a href="index.php?modul=mapel&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-book"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">List Mapel</p>
                </div>
            </a>
            <!-- Mapel Add -->
            <a href="index.php?modul=mapel&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-plus"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Mapel</p>
                </div>
            </a>

        </div>
    </div>

</body>

</html>