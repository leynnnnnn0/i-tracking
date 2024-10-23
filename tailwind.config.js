import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [require("./vendor/tallstackui/tallstackui/tailwind.config.js")],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php",
        "./vendor/tallstackui/tallstackui/src/**/*.php",
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
                "dark-primary": "#1E293B",
                "dark-secondary": "#64748B",
                dark: "#475569",
            },
        },
    },

    plugins: [forms],
};
