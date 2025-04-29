<aside id="sidebar-menu" class="bg-gradient-to-r from-green-700 to-green-900 w-70 p-6 shadow-xl fixed top-0 left-0 h-screen transform -translate-x-full transition-transform duration-300 md:translate-x-0 md:relative z-50">
    <div class="flex items-center space-x-2 mb-6">
        <i class="fas fa-tachometer-alt text-white text-2xl"></i>
        <h2 class="text-2xl font-bold text-white">Admin Dashboard</h2>
    </div>
    <ul class="space-y-2">
        <li>
            <a class="flex items-center p-3 rounded text-white hover:bg-green-600 transition duration-200"
                href="{{route('admin/statistics')}}">
                <i class="fas fa-chart-bar w-6 mr-2 text-lg"></i>Statistics
            </a>
        </li>
        <li>
            <a class="flex items-center p-3 rounded text-white hover:bg-green-600 transition duration-200"
                href="{{route('admin.manageusers')}}">
                <i class="fas fa-users w-6 mr-2 text-lg"></i>Manage Users
            </a>
        </li>
        <li>
            <a class="flex items-center p-3 rounded text-white hover:bg-green-600 transition duration-200"
                href="{{route('admin.tournaments')}}">
                <i class="fas fa-trophy w-6 mr-2 text-lg"></i>Manage Tournaments
            </a>
        </li>
        <li>
            <a class="flex items-center p-3 rounded text-white hover:bg-green-600 transition duration-200"
                href="#">
                <i class="fas fa-flag w-6 mr-2 text-lg"></i>Manage Teams
            </a>
        </li>
        <li>
            <a class="flex items-center p-3 rounded text-white hover:bg-green-600 transition duration-200"
                href="#">
                <i class="fas fa-running w-6 mr-2 text-lg"></i>Manage Players
            </a>
        </li>
        <li>
            <a class="flex items-center p-3 rounded text-white hover:bg-green-600 transition duration-200"
                href="#">
                <i class="fas fa-gamepad w-6 mr-2 text-lg"></i>Manage Matches
            </a>
        </li>
        <li>
            <a class="flex items-center p-3 rounded text-white hover:bg-green-600 transition duration-200"
                href="#">
                <i class="fas fa-cog w-6 mr-2 text-lg"></i>Manage Settings
            </a>
        </li>
    </ul>
</aside>