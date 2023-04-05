/**
 * Defines the API route we are using.
 */
var base_url = '';
var qrcode = '';

switch (process.env.NODE_ENV) {
    case 'development':
        base_url = 'http://chat.test';
        qrcode = 'images/official_account.png';
        break;
    case 'production':
        base_url = 'https://chat.wobcw.com';
        qrcode = 'images/qrcode.jpg';

        break;
}

export const CHAT_CONFIG = {
    BASE_URL: base_url,
    QRCODE: qrcode,
};
