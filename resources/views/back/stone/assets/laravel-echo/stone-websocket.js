
import Echo from './echo.js';
import {Pusher} from './pusher.js';
window.Pusher = Pusher;

window.StoneEcho =  new Echo({
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
    "timeOut": "511000",
    "extendedTimeOut": "111000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
    // iconClasses: {
    //     error: 'fas fa-trash',
    //     info: 'fa fa-info',
    //     success: 'fe fe-bell',
    //     warning: 'something',
    // },
}
window.StoneEcho.channel('notification.'+window.currentUserId).listen('.notifyNotification', (event) => {
    toastr.success('Hé, <b>ça marche !</b>', '<a href="javascript: void(0);" class="btn btn-outline-primary mb-1">View history</a>');
    console.log(event);
});

