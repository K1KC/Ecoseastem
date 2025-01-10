@if(session('message') || session('status'))
<div id="popup-message" 
     class="fixed bottom-4 right-4 bg-green-500 text-white text-sm font-medium px-4 py-2 rounded shadow-lg opacity-0 transform transition duration-300">
    {{ $message }}
</div>
@elseif(session('error'))
<div id="popup-message" 
     class="fixed bottom-4 right-4 bg-red-700 text-white text-sm font-medium px-4 py-2 rounded shadow-lg opacity-0 transform transition duration-300">
    {{ $message }}
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const popup = document.getElementById('popup-message');
        if (popup) {
            // Fade in the popup
            popup.classList.remove('opacity-0', 'translate-y-4');
            popup.classList.add('opacity-100', 'translate-y-0');

            // Fade out after 5 seconds
            setTimeout(() => {
                popup.classList.remove('opacity-100', 'translate-y-0');
                popup.classList.add('opacity-0', 'translate-y-4');
            }, 5000);
        }
    });
</script>
