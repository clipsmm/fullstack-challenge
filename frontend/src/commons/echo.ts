import Echo from "laravel-echo";
import Pusher from "pusher-js";

export default function useEcho() {
    const pusher = Pusher;

    const laravelEcho = new Echo({
        broadcaster: "pusher",
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
        forceTLS: false,
        encrypted: true,
        disableStats: true,
        enabledTransports: ["ws", "wss"],
    });

    return {
        laravelEcho,
        pusher,
    };
}