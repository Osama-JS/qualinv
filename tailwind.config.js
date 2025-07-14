import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Tajawal', 'system-ui', '-apple-system', 'sans-serif'],
                arabic: ['Tajawal', 'Inter', 'system-ui', '-apple-system', 'sans-serif'],
                english: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                'arabic-light': ['Tajawal', 'Inter', 'system-ui', 'sans-serif'],
                'arabic-normal': ['Tajawal', 'Inter', 'system-ui', 'sans-serif'],
                'arabic-medium': ['Tajawal', 'Inter', 'system-ui', 'sans-serif'],
                'arabic-bold': ['Tajawal', 'Inter', 'system-ui', 'sans-serif'],
            },
            fontWeight: {
                'arabic-light': '300',
                'arabic-normal': '400',
                'arabic-medium': '500',
                'arabic-bold': '700',
            },
            lineHeight: {
                'arabic-tight': '1.4',
                'arabic-normal': '1.6',
                'arabic-relaxed': '1.8',
                'arabic-loose': '2.0',
            },
            letterSpacing: {
                'arabic-tight': '0.01em',
                'arabic-normal': '0.02em',
                'arabic-wide': '0.03em',
            },
            colors: {
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                },
            },
        },
    },
    plugins: [],
};
