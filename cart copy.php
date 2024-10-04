<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dropdown</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="relative">
        <!-- Profile Icon -->
        <button id="profileButton" class="flex items-center space-x-2 focus:outline-none">
            <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
        </button>
        
        <!-- Dropdown Menu -->
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg">
            <ul>
                <li>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Login</a>
                </li>
            </ul>
        </div>
    </div>

    <script>
        // Toggle dropdown menu visibility
        const profileButton = document.getElementById('profileButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Hide dropdown when clicking outside
        window.addEventListener('click', (e) => {
            if (!profileButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
