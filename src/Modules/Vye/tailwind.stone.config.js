/** @type {import("tailwindcss").Config} */
const tailwindcss = require("tailwindcss");
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    prefix: "tw-",
    content: [
        "./Views/Vue/**/*.blade.php",
        "./Views/Vue/**/*.js",
        "./Views/Vue/**/*.vue",
        "./Views/Vue/**/*.ts",
        "./Views/Vue/**/*.json"
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                lg: "4rem",
                xl: "5rem",
                "2xl": "16rem"
            }
        },
        // colors: {
        //     background: {
        //         primary: "var(--bg-background-primary)",
        //         secondary: "var(--bg-background-secondary)",
        //         tertiary: "var(--bg-background-tertiary)"
        //     },
        //     specify: {
        //         primary: "var(--text-dyn-color-primary)",
        //         secondary: "var(--text-dyn-color-secondary)",
        //         tertiary: "var(--text-dyn-color-tertiary)",
        //         light: "var(--text-dyn-color-light)"
        //     },
        //     "border-color": {
        //         primary: "var(--border-border-color-primary)"
        //     },
        //     "border-shadow": {
        //         primary: "var(--border-shadow-primary)"
        //     },
        //     transparent: "transparent",
        //     black: "#000",
        //     white: "#fff",
        //     ebonyClay: {
        //         100: "#485469",
        //         200: "#434F62",
        //         300: "#3F495B",
        //         400: "#3A4454",
        //         500: "#353E4E",
        //         600: "#303947",
        //         700: "#2C3340",
        //         800: "#272E39",
        //         900: "#222832"
        //     },
        //     dianne: {
        //         100: "#3784A3",
        //         200: "#347E9B",
        //         300: "#327793",
        //         400: "#2F718B",
        //         500: "#2D6B83",
        //         600: "#2A647B",
        //         700: "#275E73",
        //         800: "#25576B",
        //         900: "#225163"
        //     },
        //     lagoon: {
        //         100: "#03D6E1",
        //         200: "#03CBD6",
        //         300: "#03C0CA",
        //         400: "#03B5BF",
        //         500: "#03ABB4",
        //         600: "#02A0A8",
        //         700: "#02959D",
        //         800: "#028A91",
        //         900: "#027F86"
        //     },
        //     jungle: {
        //         100: "#07F49E",
        //         200: "#0CEB9C",
        //         300: "#11E29A",
        //         400: "#16D997",
        //         500: "#1CD195",
        //         600: "#21C893",
        //         700: "#26BF91",
        //         800: "#2BB68E",
        //         900: "#30AD8C"
        //     },
        //     gallery: {
        //         100: "#FFFFFF",
        //         200: "#FCFCFC",
        //         300: "#F9F9F9",
        //         400: "#F6F6F6",
        //         500: "#F3F3F3",
        //         600: "#F0F0F0",
        //         700: "#EDEDED",
        //         800: "#EAEAEA",
        //         900: "#E7E7E7"
        //     }
        // },
        fontFamily: {
            sans: ["\"GT-America\"", ...defaultTheme.fontFamily.sans],
            heading: ["Untitled-Sans", "sans-serif"]
        },
        extend: {}
    },
    plugins: [
        tailwindcss,
        require("postcss-multiple-tailwind"),
        "@tailwindcss/container-queries"
    ]
};
