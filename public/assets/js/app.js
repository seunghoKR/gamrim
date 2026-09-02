// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('mobile-menu-btn');
    const panel = document.getElementById('mobile-menu-panel');
    
    if(btn && panel) {
        btn.addEventListener('click', () => {
            panel.classList.toggle('hidden');
        });
    }
});

// PWA Install Prompt Logic
let deferredPrompt;
window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    
    const banner = document.getElementById('pwa-install-banner');
    if(banner) {
        banner.classList.remove('hidden');
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const installBtn = document.getElementById('pwa-install-btn');
    const closeBtn = document.getElementById('pwa-close-btn');
    const banner = document.getElementById('pwa-install-banner');

    if(installBtn) {
        installBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    console.log('User accepted the A2HS prompt');
                }
                deferredPrompt = null;
                if(banner) banner.classList.add('hidden');
            }
        });
    }

    if(closeBtn) {
        closeBtn.addEventListener('click', () => {
            if(banner) banner.classList.add('hidden');
        });
    }
});

// YouTube Modal Logic
function openYouTubeModal() {
    const modal = document.getElementById('youtube-modal');
    const player = document.getElementById('youtube-player');
    if(modal && player) {
        modal.classList.remove('hidden');
        // Example iframe, in production you'd use YouTube Iframe API
        player.innerHTML = `<iframe width="100%" height="100%" src="https://www.youtube.com/embed/live_stream?channel=UC_x5XG1OV2P6uZZ5FSM9Ttw&autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
    }
}

function closeYouTubeModal() {
    const modal = document.getElementById('youtube-modal');
    const player = document.getElementById('youtube-player');
    if(modal && player) {
        modal.classList.add('hidden');
        player.innerHTML = ''; // Stop video
    }
}

// Escape key to close modal
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeYouTubeModal();
    }
});

// Kakao Share Logic
document.addEventListener('DOMContentLoaded', () => {
    const shareBtn = document.getElementById('kakao-share-verse');
    if(shareBtn) {
        shareBtn.addEventListener('click', () => {
            alert('카카오톡 공유 API 호출 (구현 필요)');
            // Kakao.Share.sendDefault({...})
        });
    }
});

// Google Calendar iCal Add
function addToGoogleCalendar(title, location) {
    const baseUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE';
    const text = encodeURIComponent(title);
    const loc = encodeURIComponent(location);
    const details = encodeURIComponent('감림산기도원 일정입니다.');
    
    // Default to today for example
    const d = new Date();
    const dateStr = d.toISOString().replace(/-|:|\.\d\d\d/g,""); 
    // Format: YYYYMMDDTHHmmssZ
    
    const url = `${baseUrl}&text=${text}&dates=${dateStr}/${dateStr}&details=${details}&location=${loc}`;
    window.open(url, '_blank');
}
