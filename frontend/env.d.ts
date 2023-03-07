/// <reference types="vite/client" />
interface ImportMetaEnv {
    readonly VITE_PUSHER_APP_KEY: string;
    readonly VITE_PUSHER_HOST: string;
    readonly VITE_PUSHER_PORT: string;
    // more env variables...
}

interface ImportMeta {
    readonly env: ImportMetaEnv;
}