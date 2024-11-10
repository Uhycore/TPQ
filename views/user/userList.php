<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama User</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="shadow-sm bg-white mb-1">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>

    <!-- Main container -->
    <div class="flex min-h-screen">
        <!-- Main Content -->
        <div class="flex-1 p-10">
            <div class="container mx-auto">
                <!-- Heading and Insert Button -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-700">User Management</h1>
                    <a href="index.php?modul=user&fitur=input" class="bg-blue-600 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-300 ease-in-out shadow-lg hover:shadow-2xl transform hover:scale-105">
                        + Insert New User
                    </a>
                </div>

                <!-- User Table -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full table-fixed">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-2 uppercase font-medium text-sm text-center border-r">User ID</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Username</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Password</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Role Name</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Role Description</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Role Status</th>
                                <th class="py-3 px-2 uppercase font-medium text-sm text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php if (!empty($users)) {
                                foreach ($users as $index => $user) { ?>
                                    <tr class="border-t border-b transition-all duration-300 ease-in-out <?php echo $index % 2 == 1 ? 'bg-gray-200' : ''; ?>">
                                        <td class="py-4 px-2 text-center font-bold text-black-500"><?php echo htmlspecialchars($user->userId); ?></td>
                                        <td class="py-4 px-6 text-center border border-gray-300""><?php echo htmlspecialchars($user->username); ?></td>
                                        <td class=" py-4 px-6 text-center border border-gray-300""><?php echo htmlspecialchars($user->password); ?></td>
                                        <td class="py-4 px-6 text-center border border-gray-300""><?php echo htmlspecialchars($user->role->roleNama); ?></td>
                                        <td class=" py-4 px-6 text-center border border-gray-300""><?php echo htmlspecialchars($user->role->roleDeskripsi); ?></td>
                                        <td class="py-4 px-2 font-medium text-center border-r border-gray-300">
                                            <span class="inline-block px-2 py-1 font-semibold leading-tight text-white rounded-full <?php echo $user->role->roleStatus ? 'bg-green-500' : 'bg-red-500'; ?>">
                                                <?php echo $user->role->roleStatus ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td class=" py-4 px-6 flex justify-center space-x-2 border-gray-300">
                                            <form action="index.php?modul=user&fitur=edit&userId=<?= $user->userId ?>" method="POST" class="inline">
                                                <button type="submit" class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-edit text-green-500 hover:text-green-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                            <form action="index.php?modul=user&fitur=delete" method="POST" class="inline">
                                                <input type="hidden" name="userId" value="<?php echo $user->userId; ?>">
                                                <button type="submit" class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-trash-alt text-red-500 hover:text-red-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">No users found.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>