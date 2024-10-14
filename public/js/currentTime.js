document.addEventListener('DOMContentLoaded', function() {
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        document.getElementById('current-time').textContent = timeString;
    }

    // requestAnimationFrame untuk smooth update
    function update() {
        updateTime();
        requestAnimationFrame(update);
    }
    
    update();
});
