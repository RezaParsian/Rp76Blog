/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./modules/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors:{
                rp: {
                    900: '#024E7B',
                    800: '#025687',
                    700: '#025F94',
                    600: '#0268A3',
                    500: '#0272B3',
                    400: '#117BB8',
                    300: '#2083BC',
                    200: '#3E94C5',
                    100: '#79B5D7',
                    50: '#F0F7FB',
                }
            }
        },
    },
    plugins: [],
}
