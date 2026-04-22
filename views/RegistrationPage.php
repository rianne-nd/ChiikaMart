<?php
    session_start();
?>

<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Join ChiikaMart - Create Your Account</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "background": "#fef8f4",
              "primary": "#4d6076",
              "surface-dim": "#dfd9d5",
              "surface-variant": "#e7e1dd",
              "on-surface": "#1d1b19",
              "primary-container": "#66788f",
              "surface-container-high": "#ede7e3",
              "surface-container": "#f3ede9",
              "surface-bright": "#fef8f4",
              "outline-variant": "#c1c7cb",
              "surface-container-highest": "#e7e1dd",
              "on-primary": "#ffffff",
              "on-surface-variant": "#41484b",
              "surface-container-lowest": "#ffffff",
              "surface": "#fef8f4",
              "secondary-fixed-dim": "#a5ccdf",
              "tertiary": "#50606b",
              "secondary-container": "#bee6f9",
              "on-secondary": "#ffffff",
              "secondary": "#3d6374",
              "on-primary-container": "#ffffff",
              "primary-fixed-dim": "#b5c8e2",
              "outline": "#71787c",
              "secondary-fixed": "#c1e8fc",
              "error": "#ba1a1a",
              "surface-container-low": "#f8f2ee",
              "on-error": "#ffffff",
              "on-secondary-container": "#426878",
              "error-container": "#ffdad6"
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
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      }
      .washi-tape {
        background-color: #bee6f9;
        opacity: 0.4;
        height: 24px;
        width: 80px;
        position: absolute;
        z-index: 10;
      }
      #myTable_wrapper {
        color: #1d1b19;
      }
    </style>
</head>
<body class="bg-background font-body text-on-surface min-h-screen selection:bg-secondary-container">
<main class="min-h-screen flex items-center justify-center p-4 md:p-8">
    <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-0 overflow-hidden rounded-[3rem] bg-surface-container shadow-2xl relative">
        <section class="hidden lg:flex flex-col justify-center p-12 relative bg-surface-container-highest overflow-hidden">
            <div class="absolute -top-10 -left-10 w-40 h-40 rounded-full bg-secondary-container/30 blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-64 h-64 rounded-full bg-primary-fixed-dim/20 blur-3xl"></div>
            <div class="relative z-10">
                <div class="inline-block mb-6 px-4 py-1 bg-secondary text-on-primary rounded-lg -rotate-2 shadow-sm font-label text-xs tracking-widest uppercase">
                    Our Community
                </div>
                <h1 class="text-5xl font-headline font-extrabold text-primary tracking-tighter leading-tight mb-8">
                    Join the <br/><span class="text-secondary italic">Community</span>
                </h1>
                <div class="space-y-6">
                    <div class="group flex items-start space-x-4 p-5 rounded-2xl bg-surface-container-lowest border-2 border-dashed border-outline-variant/30 hover:border-secondary transition-colors cursor-default">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-secondary-container flex items-center justify-center text-on-secondary-container group-hover:rotate-6 transition-transform">
                            <span class="material-symbols-outlined">book_2</span>
                        </div>
                        <div>
                            <h3 class="font-headline font-bold text-on-surface">Digital Scrapbook</h3>
                            <p class="text-on-surface-variant text-sm mt-1">Document every moment with your new companions in a personalized digital journal.</p>
                        </div>
                    </div>
                    <div class="group flex items-start space-x-4 p-5 rounded-2xl bg-surface-container-lowest border-2 border-dashed border-outline-variant/30 hover:border-secondary transition-colors cursor-default translate-x-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-secondary-fixed flex items-center justify-center text-on-secondary-container group-hover:-rotate-6 transition-transform">
                            <span class="material-symbols-outlined">favorite</span>
                        </div>
                        <div>
                            <h3 class="font-headline font-bold text-on-surface">Character Favorites</h3>
                            <p class="text-on-surface-variant text-sm mt-1">Keep track of the characters you love and get notified when new versions arrive.</p>
                        </div>
                    </div>
                    <div class="group flex items-start space-x-4 p-5 rounded-2xl bg-surface-container-lowest border-2 border-dashed border-outline-variant/30 hover:border-secondary transition-colors cursor-default">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-primary-fixed-dim flex items-center justify-center text-on-secondary-container group-hover:rotate-3 transition-transform">
                            <span class="material-symbols-outlined">local_shipping</span>
                        </div>
                        <div>
                            <h3 class="font-headline font-bold text-on-surface">Track Arrivals</h3>
                            <p class="text-on-surface-variant text-sm mt-1">Exclusive first-look access to limited edition drops and local adoption events.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 relative w-full h-48 rounded-2xl overflow-hidden border-2 border-dashed border-secondary rotate-1">
                <div class="washi-tape -top-2 -left-4 -rotate-12"></div>
                <div class="washi-tape top-2 -right-4 rotate-45"></div>
                <img alt="Cute plushies arranged on a desk" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDgLM_JnkYPdMpxaA0YuyTUJP7rkpQKsRSstBl4vUcZu1ZDIM_AmiKL1SVKR3YQa7S4ZjED5TBx2VJAdJlXt9YdQ5ji2Kt8m_156YvORC8lh0cegO2f2TCG5_IhECUfpqSZQhoRzVt0_Q_eov3kagRtCzv1zum4kyNV2iz2sNd2dwmZLGJl7vHIzJHB99h6Di6bJZ0bPYT5HPBtkSJDAxm5uRHxHDKWIE-5OfVNnBszBL9Afb44zQz7Q2oht8gdT9li9ROQDY2cUQM"/>
            </div>
        </section>

        <section class="bg-surface-container-lowest p-8 md:p-12 lg:p-16 flex flex-col justify-center relative overflow-y-auto max-h-[90vh] lg:max-h-none">
            <div class="lg:hidden mb-8 text-center">
                <span class="text-3xl font-extrabold text-primary tracking-tighter">ChiikaMart</span>
            </div>
            <div class="max-w-md mx-auto w-full">
                <header class="mb-8 text-center lg:text-left">
                    <h2 class="text-3xl font-headline font-bold text-on-surface tracking-tight">Create your account</h2>
                    <p class="text-on-surface-variant mt-2 text-sm">Begin your journey into the world of ChiikaMart today.</p>
                </header>

                <form class="space-y-4" onsubmit="event.preventDefault(); addFunc();">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtFirstname">First Name</label>
                            <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtFirstname" placeholder="Chiika" required type="text"/>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtLastname">Last Name</label>
                            <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtLastname" placeholder="Hachi" required type="text"/>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtSuffix">Suffix (Optional)</label>
                        <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtSuffix" placeholder="Jr., III, etc." type="text"/>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtBirthday">Birthday</label>
                            <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtBirthday" type="date"/>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtPhoneNumber">Phone Number</label>
                            <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtPhoneNumber" placeholder="09XX XXX XXXX" required type="tel"/>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtEmail">Email Address</label>
                        <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtEmail" placeholder="hello@chiikamart.com" required type="email"/>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtPassword">Password</label>
                            <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtPassword" placeholder="********" required type="password"/>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtConfirmPassword">Confirm</label>
                            <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtConfirmPassword" placeholder="********" required type="password"/>
                        </div>
                    </div>

                    <div class="pt-4 pb-2">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="h-px flex-1 bg-outline-variant/30"></div>
                            <span class="text-[10px] font-label font-bold text-outline uppercase tracking-[0.2em]">Shipping Address</span>
                            <div class="h-px flex-1 bg-outline-variant/30"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="space-y-1.5">
                                <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtStreet">Street / House No.</label>
                                <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtStreet" placeholder="123 Sakura St." required type="text"/>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtBarangay">Barangay</label>
                                    <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtBarangay" placeholder="Barangay 1" required type="text"/>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtCity">City / Muni</label>
                                    <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtCity" placeholder="Metro City" required type="text"/>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtProvince">Province</label>
                                    <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtProvince" placeholder="Central Province" required type="text"/>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-label font-bold text-on-surface-variant tracking-wider uppercase ml-1" for="txtZipCode">Zip Code</label>
                                    <input class="w-full px-4 py-3 bg-surface-container-low border-0 focus:ring-2 focus:ring-primary focus:ring-inset rounded-xl transition-all placeholder:text-outline text-sm text-on-surface" id="txtZipCode" placeholder="1000" required type="text"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="w-full py-4 px-6 text-white font-headline font-bold rounded-full shadow-lg hover:opacity-90 transition-all transform active:scale-[0.98] mt-4 flex items-center justify-center space-x-2" style="background-color: #4d6076;" type="submit">
                        <span>Create My Account</span>
                        <span class="material-symbols-outlined text-xl">arrow_forward</span>
                    </button>
                </form>

                <footer class="mt-8 text-center pb-4">
                    <p class="text-on-surface-variant text-sm">
                        Already a member?
                        <a class="text-primary font-bold hover:text-secondary transition-colors underline decoration-secondary-container decoration-4 underline-offset-4" href="#" onclick="redirectFunc(1); return false;">Sign in here</a>
                    </p>
                </footer>
            </div>

            <div class="absolute top-8 right-8 hidden md:block">
                <div class="bg-secondary text-on-primary px-3 py-1 text-[10px] font-label font-bold tracking-widest uppercase rotate-12 shadow-md">
                    Limited Access
                </div>
            </div>
        </section>
    </div>
</main>

<div class="fixed top-0 left-0 w-full h-full pointer-events-none z-[-1] opacity-50">
    <div class="absolute top-10 left-[10%] w-24 h-24 border-2 border-dashed border-outline-variant/20 rounded-full"></div>
    <div class="absolute bottom-20 right-[5%] w-48 h-48 border-2 border-dashed border-outline-variant/20 rounded-3xl rotate-45"></div>
    <div class="absolute top-1/2 left-[50%] w-0.5 h-32 bg-outline-variant/10 -rotate-12"></div>
</div>

<script src="../scripts/Service.js?v=20260401a"></script>
</body>
</html>
