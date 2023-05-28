
import Echo from './echo.js';
import {Pusher} from './pusher.js';
window.Pusher = Pusher;

window.VolcatorEcho =  new Echo({
    broadcaster: 'pusher',
    key: window.PUSHER_APP_KEY,
    cluster: window.PUSHER_APP_CLUSTER,
    forceTLS: !!window.PUSHER_STONE_FORCE_TLS,
    wsHost: window.PUSHER_STONE_WS_HOST,
    wsPort: window.PUSHER_STONE_WS_PORT,
    wssPort: window.PUSHER_STONE_WSS_PORT,
    encrypted: !!window.PUSHER_STONE_ENCRYPTED,
    enabledTransports: ['ws', 'wss']
});
toastr.options = {
    "closeButton": true,
    "debug": false,
    "positionClass": "toast-bottom-right",
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
    iconClasses: {
        error: 'fas fa-trash',
        info: 'fa fa-info',
        success: 'fe fe-bell',
        warning: 'something',
    },
};

window.VolcatorEcho.channel('notification.'+window.currentUserId).listen('.notifyNotification', (event) => {
    toastr.success('<a href="'+event['action']+'"  target="'+event['target']+'" class="toast-space-line">'+event['message']+'</a>', event['title']);
    window.sound = new Howl({
        src: [window.SOUND_NOTIFY],
        volume: 0.5,
        html: true
    });
    window.context = new AudioContext();
    window.context.resume();
    window.sound.muted = true;
    window.sound.play();
});
