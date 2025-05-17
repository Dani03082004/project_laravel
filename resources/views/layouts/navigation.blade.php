<nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
    <div>
        <a href="/" class="font-bold text-lg">InmoGest</a>
    </div>

    <div id="user-info" class="flex items-center space-x-4">
    </div>
</nav>

<script>
    const userInfoDiv = document.getElementById('user-info');
    const token = localStorage.getItem('api_token');

    if(token){
        userInfoDiv.innerHTML = `
            <button id="logout-btn" class="px-3 py-1 bg-red-600 rounded hover:bg-red-700">Logout</button>
        `;

        document.getElementById('logout-btn').addEventListener('click', () => {
            localStorage.removeItem('api_token');
            localStorage.removeItem('user_email');
            window.location.href = '/dashboard'; 
        });
    } else {
        userInfoDiv.innerHTML = ``; 
    }
</script>
