<div id="notification-toast"
    class="
        @if (session('type') === 'success') 
            bg-green-500
        @elseif(session('type') === 'error') 
            bg-red-500 @endif 
        text-white p-4 rounded-md mb-4 transition-opacity duration-1000">
    {{ session('notify') }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var notification = document.getElementById('notification-toast');

        if (notification) {
            setTimeout(function() {
                notification.style.opacity = '0';
            }, 3500);

            notification.addEventListener('transitionend', function() {
                notification.style.display = 'none';
            });
        }
    });
</script>