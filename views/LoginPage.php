<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login | ChiikaMart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "outline-variant": "#c1c7cb",
              "surface-container-highest": "#e7e1dd",
              "primary": "#4d6076",
              "surface-bright": "#fef8f4",
              "on-primary": "#ffffff",
              "secondary-container": "#bee6f9",
              "secondary": "#3d6374",
              "surface-container-low": "#f8f2ee",
              "surface-container": "#f3ede9",
              "surface-dim": "#dfd9d5",
              "surface": "#fef8f4",
              "on-background": "#1d1b19",
              "background": "#fef8f4",
              "on-surface-variant": "#41484b",
              "on-surface": "#1d1b19",
              "primary-container": "#66788f"
            },
            fontFamily: {
              "headline": ["Plus Jakarta Sans"],
              "body": ["Plus Jakarta Sans"],
              "label": ["Plus Jakarta Sans"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"}
          }
        }
      }
    </script>
    <style>
      .dot-grid {
        background-image: radial-gradient(#e7e1dd 1px, transparent 1px);
        background-size: 24px 24px;
      }
      .washi-tape {
        mask-image: url("data:image/svg+xml,%3Csvg width='100' height='20' viewBox='0 0 100 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0H100V20H0V0Z' fill='black'/%3E%3Cpath d='M0 0L5 5L0 10L5 15L0 20' stroke='white' stroke-width='4'/%3E%3Cpath d='M100 0L95 5L100 10L95 15L100 20' stroke='white' stroke-width='4'/%3E%3C/svg%3E");
      }
      .watercolor-wash {
        background: radial-gradient(circle at 20% 30%, rgba(209, 228, 255, 0.2) 0%, transparent 40%),
                    radial-gradient(circle at 80% 70%, rgba(193, 232, 252, 0.2) 0%, transparent 40%);
      }
    </style>
</head>
<body class="bg-surface font-body text-on-surface overflow-x-hidden">
<main class="min-h-screen w-full dot-grid watercolor-wash flex items-center justify-center p-4 md:p-12 relative overflow-hidden">
    <div class="absolute top-10 left-10 opacity-20 -rotate-12 pointer-events-none">
        <span class="material-symbols-outlined text-7xl text-primary">pets</span>
    </div>
    <div class="absolute bottom-20 right-10 opacity-20 rotate-12 pointer-events-none">
        <span class="material-symbols-outlined text-8xl text-secondary">favorite</span>
    </div>
    <div class="absolute top-1/4 right-20 opacity-10 -rotate-45 pointer-events-none">
        <span class="material-symbols-outlined text-6xl text-primary-container">auto_awesome</span>
    </div>
    <div class="absolute bottom-1/4 left-32 opacity-15 rotate-6 pointer-events-none">
        <span class="material-symbols-outlined text-5xl text-secondary-container">potted_plant</span>
    </div>

    <div class="max-w-6xl w-full flex flex-col md:flex-row items-center justify-center gap-8 md:gap-16 relative z-10">
        <div class="relative group rotate-[-2deg] transition-transform hover:rotate-0 duration-500">
            <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-32 h-8 bg-secondary-container/60 washi-tape z-20 backdrop-blur-sm shadow-sm"></div>
            <div class="bg-surface-container-lowest p-4 pb-12 shadow-2xl rounded-sm transform transition-all">
                <div class="aspect-square w-64 md:w-80 overflow-hidden rounded-sm relative">
                    <img alt="Cute plush character" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBi1Y_og_TGckuCUJkq8GMNLx9fFdKRyCwPuyH5O6mj3qKEs5SbebKJYVnfWu4tZeGKR14fjKsWGaTXP1ZwE3QRUxF5Aoo4_oExGn9BFN1oBA0IYM8pegcf14k9pZEam21o6I2KYpfCO0bpGIg5piZlZR4TaK9yFCztL6Urcg_UXPLg53gwmpUt4cTPdZME9H7pvc29jC8ph9gO_eLQI9uES-kKmxvDrD66YoVE7pBlnxh2NnnzKP4SBua8Xrvq4XjYLAugTuqfIKg"/>
                    <div class="absolute inset-0 border-2 border-dashed border-secondary/30 pointer-events-none"></div>
                </div>
                <div class="mt-6 text-center">
                    <p class="text-on-surface-variant font-medium tracking-tight text-lg italic opacity-70">"Best Day Ever"</p>
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 w-16 h-16 bg-white rounded-full shadow-md flex items-center justify-center rotate-12 border-4 border-surface-container">
                <span class="material-symbols-outlined text-3xl text-red-500">favorite</span>
            </div>
        </div>

        <div class="relative w-full max-w-md rotate-[1deg] transition-transform hover:rotate-0 duration-500">
            <div class="absolute -top-6 right-12 w-8 h-16 border-4 border-outline-variant rounded-full opacity-40 z-20"></div>
            <div class="bg-surface p-8 md:p-10 shadow-xl rounded-xl relative overflow-hidden border-4 border-dashed border-primary/40">
                <div class="mb-10 text-center">
                    <h1 class="text-4xl font-extrabold text-primary tracking-tighter mb-2">ChiikaMart</h1>
                    <p class="text-on-surface-variant text-sm font-medium tracking-wide uppercase opacity-60">Welcome back, collector</p>
                </div>

                <form class="space-y-6" onsubmit="event.preventDefault(); return false;">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold tracking-widest text-primary uppercase ml-1" for="txtLoginEmail">Email Address</label>
                        <input id="txtLoginEmail" class="w-full bg-surface-container-high border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-secondary/50 transition-all text-on-surface placeholder:text-gray-400" placeholder="hello@chiika.love" type="email" required/>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="block text-xs font-bold tracking-widest text-primary uppercase ml-1" for="txtLoginPassword">Password</label>
                            <a class="text-xs font-semibold text-secondary hover:underline underline-offset-4" href="#" onclick="return false;">Forgot?</a>
                        </div>
                        <input id="txtLoginPassword" class="w-full bg-surface-container-high border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-secondary/50 transition-all text-on-surface placeholder:text-gray-400" placeholder="********" type="password" required/>
                    </div>
                    <button class="w-full text-white font-bold py-4 rounded-full shadow-lg transform active:scale-95 transition-all text-sm uppercase tracking-widest" style="background-color: #4d6076;" type="button" onclick="loginFunc();">
                        Sign In to Shop
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-dashed border-outline-variant/30 text-center">
                    <p class="text-on-surface-variant text-sm font-medium">
                        Do not have an account?
                        <a class="text-primary font-bold hover:text-secondary transition-colors underline decoration-secondary-container decoration-4 underline-offset-[-2px]" href="#" onclick="redirectFunc(3); return false;">Join the family</a>
                    </p>
                </div>

                <div class="absolute -bottom-2 -left-4 px-4 py-1 bg-secondary text-white text-[10px] font-bold tracking-widest uppercase -rotate-3 shadow-sm rounded-sm">
                    Guest Checkout Available
                </div>
            </div>
            <div class="absolute -bottom-3 -left-10 w-24 h-6 bg-primary-container/40 washi-tape -rotate-12 z-0"></div>
        </div>
    </div>

    <footer class="absolute bottom-8 left-0 w-full px-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="text-[10px] font-bold text-on-surface-variant/40 tracking-[0.2em] uppercase">
            Copyright 2024 ChiikaMart
        </div>
        <div class="flex gap-6">
            <a class="text-[10px] font-bold text-on-surface-variant/40 hover:text-primary transition-colors tracking-[0.2em] uppercase" href="#" onclick="return false;">Privacy Policy</a>
            <a class="text-[10px] font-bold text-on-surface-variant/40 hover:text-primary transition-colors tracking-[0.2em] uppercase" href="#" onclick="return false;">Terms of Service</a>
        </div>
    </footer>
</main>
<script src="../scripts/Service.js?v=20260401a"></script>
</body>
</html>