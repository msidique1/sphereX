<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    <section>
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">
                   Hello, <span class="text-blue-600">{{ Auth::user()->username }}</span>!
                </h1>
                <p class="text-xl text-gray-600">Welcome to your personal student dashboard.</p>
            </div>

            <div class="bg-white flex flex-col lg:flex-row items-center justify-between rounded-lg shadow-xl p-6 my-5">
                <h2 class="text-2xl font-semibold text-gray-800">Current Time</h2>
                <div class="flex items-start">
                    <x-fas-clock class="w-7 h-7 relative top-1 text-blue-600 mr-4" />
                    <p id="current-time" class="text-3xl font-bold text-blue-600"></p>
                </div>
            </div>
    
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div class="bg-white rounded-lg shadow-xl p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Quick Links</h2>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-blue-500 hover:text-blue-700 transition duration-300">📚 My Courses</a></li>
                        <li><a href="#" class="text-blue-500 hover:text-blue-700 transition duration-300">📅 Upcoming Assignments</a></li>
                        <li><a href="#" class="text-blue-500 hover:text-blue-700 transition duration-300">📊 Grade Overview</a></li>
                        <li><a href="#" class="text-blue-500 hover:text-blue-700 transition duration-300">🏆 Achievements</a></li>
                    </ul>
                </div>
                <div class="bg-white rounded-lg shadow-xl p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Today's Schedule</h2>
                    <ul class="space-y-2">
                        <li class="flex justify-between"><span>Mathematics</span><span>09:00 AM</span></li>
                        <li class="flex justify-between"><span>Computer Science</span><span>11:00 AM</span></li>
                        <li class="flex justify-between"><span>Literature</span><span>02:00 PM</span></li>
                        <li class="flex justify-between"><span>Physics Lab</span><span>04:00 PM</span></li>
                    </ul>
                </div>
            </div>
    
            <div class="bg-blue-600 text-white rounded-lg shadow-xl p-8 text-center">
                <h2 class="text-3xl font-bold mb-4">Ready to surf deeper?</h2>
                <p class="text-lg mb-10">Access your study materials and start learning now!</p>
                <a href="#" class="bg-white text-blue-600 py-2 px-6 rounded-md font-semibold hover:bg-blue-700 hover:text-white transition duration-300">Start Learning</a>
            </div>
        </div>    
    </section>

    <script src="/js/currentTime.js"></script>
</x-app-layout>
