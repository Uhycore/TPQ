<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'views/includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">


        <!-- Main Content -->
        <div class="flex-1 p-20">
            <!-- Formulir Input User -->
            <div class="max-w-md mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Input Roles</h2>
                <form action="index.php?modul=user&fitur=add" method="POST">
                    <!-- Username -->
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                        <input type="text" id="username" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline transition duration-200 ease-in-out hover:border-blue-500" placeholder="Masukkan Username" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                        <input type="text" id="password " name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline transition duration-200 ease-in-out hover:border-blue-500" placeholder="Masukkan password" required>

                        <!-- Role Name -->
                        <div class="mb-4">
                            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role Name:</label>
                            <select id="role" name="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline transition duration-200 ease-in-out hover:border-blue-500" required>
                                <option value="">Pilih Role</option>
                                <?php foreach ($Roles as $rolename) { ?>
                                    <option value="<?php echo htmlspecialchars($rolename->roleId); ?>">
                                        <?php echo htmlspecialchars($rolename->roleNama); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold py-2 px-6 rounded-full transition duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105">
                                Submit
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>