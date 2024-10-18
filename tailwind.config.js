import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php",
    ],

    darkMode: "class",

    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
            },
            colors: {
                primary: "#0B592D",
                "primary-gray": "#E5E6E1",
                "primary-yellow": "#FED206",
                "primary-brown": "#6C4441",
                "dark-primary": "#000000"
            },
        },
    },

    plugins: [forms],
};
