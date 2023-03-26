/**
 * Defines the API route we are using.
 */
var base_url = '';

switch (process.env.NODE_ENV) {
    case 'development':
        base_url = 'https://chat.test';
        break;
    case 'production':
        base_url = 'https://chat.wobcw.com';
        break;
}

export const CHAT_CONFIG = {
    BASE_URL: base_url,
};
