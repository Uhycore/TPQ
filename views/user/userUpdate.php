<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'views/includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">

        <!-- Main Content -->
        <div class="flex-1 p-20">
            <!-- Formulir Input Role -->
            <div class="max-w-lg mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl transform hover:shadow-2xl transition-all duration-300">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Input Role</h2>
                <form action="index.php?modul=role&fitur=update" method="POST" class="space-y-6">
                    <input type="hidden" id="userId" name="userId" value="<?php echo htmlspecialchars($objUsers->userId); ?>">

                    <!-- Nama Role -->
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                        <input type="text" id="username" name="username"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required
                            value="<?php echo isset($objUsers->username) ? htmlspecialchars($objUsers->username) : ''; ?>"
                            placeholder="Masukkan username">
                    </div>

                    <!-- Nama Role -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                        <input type="text" id="password" name="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required
                            value="<?php echo isset($objUsers->password) ? htmlspecialchars($objUsers->password) : ''; ?>"
                            placeholder="Masukkan password">
                    </div>


                    <!-- Role Status -->
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Nama Role</label>

                        <select id="role" name="role"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                            <option value="">Pilih Role</option>
                            <?php foreach ($listRoleName as $ListRoleName) { ?>
                                <option value="<?php echo htmlspecialchars($ListRoleName->roleId); ?>"
                                    <?php echo (isset($objUsers->role->roleNama) && $objUsers->role->roleNama == $ListRoleName->roleNama) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($ListRoleName->roleNama); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transition-all duration-300 hover:shadow-2xl transform hover:scale-105">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>