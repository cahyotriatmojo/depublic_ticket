const defaultConfig = require("tailwindcss/defaultConfig");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
        "./src/**/*.{html,js}",
    ],
    theme: {
        extend: {
            colors: {
                transparent: "transparent",
                current: "currentColor",
                white: "#ffffff",
                purple: {
                    50: "#F5F0F6",
                    100: "#ECCDF6",
                    200: "#EOABF0",
                    300: "#D081E9",
                    500: "#A103D3",
                    700: "#6B028D",
                    900: "#360146",
                },
                surface: {
                    900: "#FEF6E5",
                    700: "#FCF6E8",
                    500: "#FDF9F0",
                },
            },
            height: {
                '100': '12em',
                '128': '30rem',
              }
        },
    },
    plugins: [require("flowbite/plugin")],
};
