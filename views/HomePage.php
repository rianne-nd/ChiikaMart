<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&amp;family=Caveat:wght@400;700&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "background": "#fef8f4",
              "primary": "#4d6076",
              "on-tertiary-fixed": "#0d1d27",
              "on-tertiary-fixed-variant": "#394953",
              "on-error-container": "#93000a",
              "surface-dim": "#dfd9d5",
              "tertiary-fixed-dim": "#b8c9d6",
              "on-secondary-fixed-variant": "#244c5b",
              "surface-variant": "#e7e1dd",
              "primary-fixed": "#d1e4ff",
              "on-background": "#1d1b19",
              "on-primary-fixed-variant": "#36485d",
              "on-surface": "#1d1b19",
              "primary-container": "#66788f",
              "inverse-surface": "#32302e",
              "surface-container-high": "#ede7e3",
              "tertiary-fixed": "#d4e5f2",
              "surface-container": "#f3ede9",
              "on-secondary-fixed": "#001f29",
              "tertiary-container": "#697985",
              "surface-tint": "#4e6076",
              "on-tertiary": "#ffffff",
              "on-tertiary-container": "#00060b",
              "surface-bright": "#fef8f4",
              "outline-variant": "#c1c7cb",
              "surface-container-highest": "#e7e1dd",
              "on-primary": "#ffffff",
              "on-surface-variant": "#41484b",
              "surface-container-lowest": "#ffffff",
              "inverse-on-surface": "#f6f0ec",
              "on-primary-fixed": "#081d30",
              "secondary-fixed-dim": "#a5ccdf",
              "surface": "#fef8f4",
              "tertiary": "#50606b",
              "secondary-container": "#bee6f9",
              "on-secondary": "#ffffff",
              "secondary": "#3d6374",
              "inverse-primary": "#b5c8e2",
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
              "label": ["Plus Jakarta Sans"],
              "handwritten": ["Indie Flower", "cursive"],
              "playful": ["Caveat", "cursive"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
          },
        },
      }
    </script>
<style>
        .dot-grid {
            background-image: radial-gradient(#e7e1dd 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .watercolor-blob {
            filter: blur(60px);
            opacity: 0.25;
            z-index: -1;
        }
        .brush-separator {
            height: 16px;
            background-image: url("data:image/svg+xml,%3Csvg width='1000' height='20' viewBox='0 0 1000 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3%3Cpath d='M0 10C50 5 100 15 150 10C200 5 250 15 300 10C350 5 400 15 450 10C500 5 550 15 600 10C650 5 700 15 750 10C800 5 850 15 900 10C950 5 1000 15 1000 10' stroke='%23a5ccdf' stroke-width='4' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
            background-position: center;
        }
        .floral-accent {
            position: absolute;
            pointer-events: none;
            opacity: 0.6;
            z-index: 10;
        }
        .washi-tape-teal {
            background-color: #bee6f999;
            height: 28px;
            width: 90px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .washi-tape-beige {
            background-color: #ede7e3cc;
            height: 28px;
            width: 90px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .dashed-outline {
            outline: 2px dashed #3d6374;
            outline-offset: -8px;
        }
        .sticker {
            position: absolute;
            pointer-events: none;
            z-index: 0;
            opacity: 0.1;
            filter: grayscale(0.2) contrast(0.9);
            transform: rotate(var(--rotation, 0deg));
        }
        .paperclip-accent {
            position: absolute;
            z-index: 30;
            color: #71787c;
            transform: rotate(-15deg);
        }
        .sticker-outline {
            filter: drop-shadow(4px 4px 0 white) drop-shadow(-4px -4px 0 white) drop-shadow(4px -4px 0 white) drop-shadow(-4px 4px 0 white) drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        }
        .polaroid-frame {
            background: white;
            padding: 1rem 1rem 3.5rem 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .layered-paper {
            position: absolute;
            z-index: -1;
            background: #fff;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }
    </style>
</head>
<body class="bg-background font-body text-on-background selection:bg-secondary-container selection:text-on-secondary-container relative dot-grid">
<!-- Watercolor Blobs -->
<div class="fixed top-20 left-[-10%] w-[500px] h-[500px] bg-secondary-fixed rounded-full watercolor-blob"></div>
<div class="fixed bottom-20 right-[-10%] w-[600px] h-[600px] bg-tertiary-fixed rounded-full watercolor-blob"></div>
<div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-primary-fixed opacity-[0.15] rounded-full watercolor-blob"></div>
<!-- Background Stickers -->
<div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
<span class="material-symbols-outlined sticker text-8xl top-40 -left-4" style="--rotation: -15deg;">sentiment_very_satisfied</span>
<span class="material-symbols-outlined sticker text-9xl top-[60%] -right-8" style="--rotation: 20deg;">flash_on</span>
<span class="material-symbols-outlined sticker text-7xl bottom-20 left-10" style="--rotation: 10deg;">potted_plant</span>
<span class="material-symbols-outlined sticker text-8xl top-[30%] right-[10%]" style="--rotation: -5deg;">ac_unit</span>
</div>
<!-- TopAppBar -->
<header class="fixed top-0 left-0 right-0 z-50 bg-[#fef8f4]/80 dark:bg-slate-900/80 backdrop-blur-md">
<nav class="flex justify-between items-center w-full px-8 py-4 max-w-7xl mx-auto">
<div class="text-2xl font-bold text-[#2F4156] dark:text-[#fef8f4] tracking-tighter flex items-center gap-2">
<span class="material-symbols-outlined text-secondary">collections_bookmark</span>
                ChiikaMart
            </div>
<div class="hidden md:flex items-center space-x-8 font-['Plus_Jakarta_Sans'] font-medium tracking-tight">
<a class="text-[#4d6076] dark:text-[#bee6f9] border-b-2 border-dashed border-[#3d6374] pb-1 hover:opacity-80 transition-opacity duration-200" href="../views/HomePage.php">Home</a>
<a class="text-[#41484b] dark:text-slate-400 hover:text-[#2F4156] transition-opacity duration-200" href="#" onclick="redirectFunc(3); return false;">Catalog</a>
<a class="text-[#41484b] dark:text-slate-400 hover:text-[#2F4156] transition-opacity duration-200" href="#" onclick="redirectFunc(2); return false;">Dashboard</a>
<a class="text-[#41484b] dark:text-slate-400 hover:text-[#2F4156] transition-opacity duration-200" href="#" onclick="redirectFunc(1); return false;">Logout</a>
</div>
<div class="flex items-center space-x-4">
<button class="text-[#2F4156] hover:opacity-80 transition-opacity active:scale-95" onclick="redirectFunc(3)">
<span class="material-symbols-outlined">shopping_cart</span>
</button>
<button class="text-[#2F4156] hover:opacity-80 transition-opacity active:scale-95" onclick="redirectFunc(2)">
<span class="material-symbols-outlined">person</span>
</button>
<button class="px-4 py-2 bg-primary text-on-primary rounded-full font-semibold text-sm flex items-center gap-2 hover:opacity-90 transition-opacity active:scale-95" onclick="redirectFunc(1)">
<span class="material-symbols-outlined text-[18px]">logout</span>
<span class="hidden sm:inline">Log Out</span>
</button>
</div>
</nav>
<div class="bg-[#f3ede9] dark:bg-slate-800 h-[1px] w-full"></div>
</header>
<main class="pt-24 relative z-10 overflow-hidden">
<!-- Floral Accent Top Right -->
<div class="floral-accent top-32 right-8 hidden lg:block">
<svg fill="none" height="60" viewbox="0 0 60 60" width="60" xmlns="http://www.w3.org/2000/svg">
<path d="M30 10C30 10 35 25 30 25C25 25 30 10 30 10Z" stroke="#4d6076" stroke-width="1.5"></path>
<path d="M30 50C30 50 25 35 30 35C35 35 30 50 30 50Z" stroke="#4d6076" stroke-width="1.5"></path>
<path d="M10 30C10 30 25 35 25 30C25 25 10 30 10 30Z" stroke="#4d6076" stroke-width="1.5"></path>
<path d="M50 30C50 30 35 25 35 30C35 35 50 30 50 30Z" stroke="#4d6076" stroke-width="1.5"></path>
<circle cx="30" cy="30" fill="#50606b" r="4"></circle>
</svg>
</div>
<!-- Hero Section -->
<section class="relative px-6 py-12 md:py-20 max-w-7xl mx-auto">
<div class="flex flex-col lg:flex-row items-center gap-12">
<div class="w-full lg:w-1/2 space-y-8 z-10 text-center lg:text-left relative">
<div class="absolute -top-12 -left-8 washi-tape-teal rotate-[-8deg] opacity-50 hidden lg:block"></div>
<div class="inline-block px-4 py-1 bg-primary text-on-primary rounded-full transform rotate-1 text-xs font-bold tracking-widest uppercase relative shadow-sm">
                        Welcome to our Adoption Center
                    </div>
<h1 class="text-5xl md:text-7xl font-extrabold text-primary tracking-tighter leading-tight">
                        Your New Best <br/><span class="text-secondary italic">Friends</span> Await
                    </h1>
<p class="text-lg text-on-surface-variant max-w-md mx-auto lg:mx-0 leading-relaxed">
                        Step into our cozy scrapbook corner and find a tiny companion to join your daily adventures. Every plush has a story, and every story needs a home.
                    </p>
<div class="flex flex-wrap justify-center lg:justify-start gap-4">
<button class="px-8 py-4 bg-gradient-to-br from-secondary to-secondary-container text-on-secondary-container rounded-full font-bold shadow-lg hover:shadow-xl transition-all active:scale-95" onclick="redirectFunc(3)">
                            Start Adopting
                        </button>
<button class="px-8 py-4 bg-surface-container-highest text-primary rounded-full font-bold hover:bg-surface-variant transition-all" onclick="redirectFunc(2)">
                            Learn More
                        </button>
</div>
</div>
<div class="w-full lg:w-1/2 relative">
<div class="absolute -top-6 -right-6 washi-tape-teal z-20 transform rotate-12 opacity-80"></div>
<div class="absolute -bottom-4 -left-8 washi-tape-beige z-20 transform -rotate-6 opacity-80"></div>
<div class="relative bg-surface-container-lowest p-4 rounded-[2.5rem] shadow-2xl -rotate-2 dashed-outline">
<img alt="Cute Chiikawa, Hachiware, and Usagi sitting together on a train seat" class="w-full aspect-[3/2] object-cover rounded-3xl" src="../images/chiikawa%20Train.jpg"/>
</div>
<div class="absolute -bottom-8 -right-4 bg-white/90 backdrop-blur p-4 rounded-2xl shadow-lg border border-surface-variant max-w-[180px] rotate-3 hidden md:block">
<p class="text-xs italic text-on-surface-variant text-center">"Traveling together to their forever homes..."</p>
</div>
</div>
</div>
</section>
<!-- Section Separator -->
<div class="max-w-4xl mx-auto my-12 brush-separator opacity-60"></div>
<!-- Spotlight Product Section: Redesigned as Polaroid Sticker Sheet -->
<section class="relative px-6 py-20 md:py-32 max-w-7xl mx-auto overflow-visible">
<div class="flex flex-col md:flex-row items-center gap-16">
<div class="w-full md:w-5/12 space-y-6 z-20">
<div class="inline-block px-5 py-1.5 bg-secondary-container text-on-secondary-container rounded-lg transform -rotate-3 text-xs font-black tracking-[0.2em] uppercase shadow-sm sticker-outline">
                        ✨ Sticker Sheet Favorite ✨
                    </div>
<h2 class="text-6xl md:text-8xl font-playful text-primary leading-none -rotate-1 font-bold">
                        Ultra Soft <br/><span class="text-secondary">Usagi</span>
</h2>
<p class="text-2xl font-handwritten text-on-surface-variant leading-relaxed max-w-sm">
                        This limited edition jumbo plushie is basically a cloud you can hold. Look at those cheeks! 
                    </p>
<div class="pt-4 flex flex-col gap-6">
<div class="flex items-center gap-4">
<span class="text-5xl font-handwritten text-secondary font-bold sticker-outline bg-white px-4 py-2 rounded-full rotate-2">$89.00</span>
<div class="h-1 w-12 border-t-4 border-dotted border-primary/30"></div>
</div>
<button class="w-fit px-10 py-5 bg-primary text-on-primary rounded-xl font-handwritten text-2xl shadow-xl hover:shadow-2xl transition-all active:scale-95 sticker-outline -rotate-2">
                            Add to Scrapbook
                        </button>
</div>
</div>
<div class="w-full md:w-7/12 relative flex justify-center items-center">
<!-- Layered Paper Textures -->
<div class="layered-paper w-[440px] h-[520px] rotate-[-5deg] opacity-40"></div>
<div class="layered-paper w-[460px] h-[540px] rotate-[3deg] opacity-30"></div>
<!-- Decorative Stickers from SCREEN_53 -->
<div class="absolute top-0 right-10 sticker-outline transform rotate-12 z-40 bg-white p-2 rounded-lg">
<span class="material-symbols-outlined text-yellow-400 text-5xl fill-current">star</span>
</div>
<div class="absolute bottom-10 left-0 sticker-outline transform -rotate-12 z-40 bg-white p-2 rounded-lg">
<span class="material-symbols-outlined text-red-400 text-5xl fill-current">favorite</span>
</div>
<div class="absolute top-1/2 -right-4 sticker-outline transform rotate-45 z-40 bg-white p-2 rounded-lg">
<span class="material-symbols-outlined text-orange-400 text-5xl fill-current">nutrition</span>
</div>
<div class="absolute -top-10 left-20 sticker-outline transform -rotate-6 z-40 bg-white p-2 rounded-lg">
<span class="material-symbols-outlined text-blue-400 text-5xl fill-current">auto_awesome</span>
</div>
<!-- Polaroid Wrapper from SCREEN_45 -->
<div class="relative transform rotate-2 hover:rotate-0 transition-transform duration-500 z-20">
<!-- Washi Tapes -->
<div class="absolute -top-8 -left-8 washi-tape-teal rotate-[-15deg] z-30 shadow-sm opacity-90"></div>
<div class="absolute -bottom-6 -right-6 washi-tape-beige rotate-[10deg] z-30 shadow-sm opacity-90"></div>
<!-- Paperclip Accent -->
<span class="material-symbols-outlined paperclip-accent text-6xl -top-12 -right-6 z-50">attach_file</span>
<!-- The Polaroid -->
<div class="polaroid-frame rounded-sm border border-surface-variant/20">
<img alt="Jumbo Usagi Plush" class="w-[450px] aspect-square object-cover grayscale-[0.02]" src="../images/usagiBigFeatured.webp"/>
<div class="mt-6 text-center font-handwritten text-on-surface-variant/60 text-lg">
            Captured in the Wild 📸 05.2024
        </div>
</div>
</div>
</div>
</div>
</section>
<!-- Section Separator -->
<div class="max-w-4xl mx-auto my-12 brush-separator opacity-60"></div>
<!-- Quick Filter / Scrapbook Explore -->
<section class="bg-surface-container/60 backdrop-blur-sm py-16 relative overflow-hidden">
<div class="absolute top-0 left-0 w-full h-full opacity-5 bg-[url('https://www.transparenttextures.com/patterns/natural-paper.png')] pointer-events-none"></div>
<div class="max-w-7xl mx-auto px-6 relative z-10">
<div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
<div class="relative">
<div class="absolute -top-8 -left-4 washi-tape-teal rotate-[-5deg] opacity-40"></div>
<h2 class="text-3xl font-bold text-primary tracking-tight mb-2">Explore the Scrapbook</h2>
<p class="text-on-surface-variant">Find your perfect companion by character or size.</p>
</div>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
<div class="group cursor-pointer">
<div class="bg-surface-container-lowest p-4 rounded-3xl transition-transform group-hover:scale-105 group-hover:-rotate-2 shadow-sm relative border border-surface-variant/50"><div class="absolute -top-3 left-1/2 -translate-x-1/2 washi-tape-beige w-12 h-6 rotate-2 opacity-60"></div><div class="aspect-square bg-secondary-container/20 rounded-2xl flex items-center justify-center mb-4 overflow-hidden p-2"><img alt="Keychain" class="w-full h-full object-contain" src="../images/Chiikawa_keychain.png" style="filter: drop-shadow(0px 0px 3px white) drop-shadow(0px 0px 3px white) drop-shadow(0px 0px 3px white);"/></div><span class="text-center block font-bold text-primary">Keychain</span></div>
</div>
<div class="group cursor-pointer">
<div class="bg-surface-container-lowest p-4 rounded-3xl transition-transform group-hover:scale-105 group-hover:rotate-2 shadow-sm relative border border-surface-variant/50"><div class="absolute -top-3 left-1/2 -translate-x-1/2 washi-tape-teal w-12 h-6 -rotate-2 opacity-60"></div><div class="aspect-square bg-secondary-container/20 rounded-2xl flex items-center justify-center mb-4 overflow-hidden p-2"><img alt="Small" class="w-full h-full object-contain" src="../images/Chiikawa_small2.png" style="filter: drop-shadow(0px 0px 3px white) drop-shadow(0px 0px 3px white) drop-shadow(0px 0px 3px white);"/></div><span class="text-center block font-bold text-primary">Small</span></div>
</div>
<div class="group cursor-pointer">
<div class="bg-surface-container-lowest p-4 rounded-3xl transition-transform group-hover:scale-105 group-hover:-rotate-2 shadow-sm relative border border-surface-variant/50"><div class="absolute -top-3 left-1/2 -translate-x-1/2 washi-tape-beige w-12 h-6 rotate-1 opacity-60"></div><div class="aspect-square bg-secondary-container/20 rounded-2xl flex items-center justify-center mb-4 overflow-hidden p-2"><img alt="Medium" class="w-full h-full object-contain" src="../images/Hachiware_medium.png" style="filter: drop-shadow(0px 0px 3px white) drop-shadow(0px 0px 3px white) drop-shadow(0px 0px 3px white);"/></div><span class="text-center block font-bold text-primary">Medium</span></div>
</div>
<div class="group cursor-pointer">
<div class="bg-surface-container-lowest p-4 rounded-3xl transition-transform group-hover:scale-105 group-hover:rotate-2 shadow-sm relative border border-surface-variant/50"><div class="absolute -top-3 left-1/2 -translate-x-1/2 washi-tape-teal w-12 h-6 -rotate-1 opacity-60"></div><div class="aspect-square bg-secondary-container/20 rounded-2xl flex items-center justify-center mb-4 overflow-hidden p-2"><img alt="Jumbo" class="w-full h-full object-contain" src="../images/Usagi_jumbo.png" style="filter: drop-shadow(0px 0px 3px white) drop-shadow(0px 0px 3px white) drop-shadow(0px 0px 3px white);"/></div><span class="text-center block font-bold text-primary">Jumbo</span></div>
</div>
</div>
</div>
</section>
<!-- Featured Cuties Grid -->
<section class="max-w-7xl mx-auto px-6 py-24 relative">
<div class="floral-accent bottom-20 -left-10 hidden xl:block opacity-30 scale-150">
<svg fill="none" height="100" viewbox="0 0 40 100" width="40" xmlns="http://www.w3.org/2000/svg">
<path d="M20 100 C20 100 20 60 20 40 C20 20 10 10 10 10 M20 40 C20 40 30 20 30 10" stroke="#4d6076" stroke-linecap="round" stroke-width="1.5"></path>
<ellipse cx="10" cy="8" fill="#a5ccdf" rx="4" ry="6"></ellipse>
<ellipse cx="30" cy="8" fill="#a5ccdf" rx="4" ry="6"></ellipse>
</svg>
</div>
<div class="flex items-center gap-4 mb-12">
<h2 class="text-4xl font-extrabold text-primary tracking-tighter">Featured Cuties</h2>
<div class="h-[2px] flex-grow border-t-2 border-dashed border-primary/20 relative">
<span class="absolute right-0 -top-2 text-primary/40">★</span>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
<!-- Product 1 -->
<div class="relative group">
<div class="bg-surface-container-lowest p-6 rounded-[2.5rem] dashed-outline transition-transform duration-500 group-hover:-translate-y-2 relative">
<div class="absolute -top-2 -right-2 washi-tape-teal w-16 h-8 rotate-12 opacity-80 z-20"></div>
<div class="absolute top-4 right-4 z-10 bg-secondary text-white text-[10px] font-black px-2 py-1 rounded shadow-sm rotate-6">NEW</div>
<img alt="chiikawa plush" class="w-full aspect-square object-cover rounded-2xl mb-6" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjRkwEAaaUM6QXyjpsfHHEag00vFT1CjWrm7oPausajUGmOMcCTNI776WuLVIL9QHwaeqvKS0MLtvGCq7dWJLibEwjismia_HK3PFa67r11eR08bNpsWDQObwQ3Q7jFh4TG_G1OOhIbblgMlnS5QJKbVBefnvaV96MYiaAZnfGMKwRQ7mCSe5nwDEbWRelJEjamVUyYXyUnyHtFqhtZGNESo6NqZ9qX8SCQUG1S16l8QteUmfHi6C6GMckF7lHmvN6f0awok3cXkE"/>
<h3 class="text-xl font-bold text-primary mb-1">Pajama Party Chiikawa</h3>
<p class="text-sm text-on-surface-variant mb-6">Medium • Soft Cotton</p>
<div class="flex items-center justify-between mt-auto">
<span class="text-2xl font-black text-secondary">$34.00</span>
<button class="p-3 bg-primary text-on-primary rounded-full hover:bg-primary-container transition-colors active:scale-90 shadow-lg">
<span class="material-symbols-outlined">add_shopping_cart</span>
</button>
</div>
</div>
</div>
<!-- Product 2 -->
<div class="relative group mt-8 lg:mt-0">
<div class="bg-surface-container-lowest p-6 rounded-[2.5rem] dashed-outline transition-transform duration-500 group-hover:-translate-y-2 rotate-1 relative">
<div class="absolute -top-3 -left-2 washi-tape-beige w-16 h-8 -rotate-12 opacity-80 z-20"></div>
<img alt="hachiware plush" class="w-full aspect-square object-cover rounded-2xl mb-6" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD00F6lrvYLdrcQxQwvCPYwZey8_PsJmn8RsIRSHj4EjMTXlVTQ6KlLJ8MUOnE23lhEsMxL6ud5ylmlOI3WTRy85QDAu7L0E55CJomTdpxSGVLJJhTbRVC6Wgp9RnzrhdSh0q0XgiFhSG5qOXnpmjDeTqvZk4CqTdGHKP8HhXDewWHWYs16Bw6yz6JZi6s88sM2m-VVBBQh3VLMq1irb7VNbEdSHOF7Ew481pJoSVOvm56Wbqrmen_1iRxLFOdnVAT7Vi3KqiveUKU"/>
<h3 class="text-xl font-bold text-primary mb-1">Classic Hachiware</h3>
<p class="text-sm text-on-surface-variant mb-6">Small • Premium Fleece</p>
<div class="flex items-center justify-between">
<span class="text-2xl font-black text-secondary">$28.00</span>
<button class="p-3 bg-primary text-on-primary rounded-full hover:bg-primary-container transition-colors active:scale-90 shadow-lg">
<span class="material-symbols-outlined">add_shopping_cart</span>
</button>
</div>
</div>
</div>
<!-- Product 3 -->
<div class="relative group">
<div class="bg-surface-container-lowest p-6 rounded-[2.5rem] dashed-outline transition-transform duration-500 group-hover:-translate-y-2 -rotate-1 relative">
<span class="material-symbols-outlined paperclip-accent text-3xl top-[-10px] right-[20px]">attach_file</span>
<div class="absolute -bottom-2 -right-2 washi-tape-teal w-16 h-8 -rotate-6 opacity-80 z-20"></div>
<img alt="momonga plush" class="w-full aspect-square object-cover rounded-2xl mb-6" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCb_SapEYgO3DOGKLbtLkQLo8I2EuDBtlPP9A5F9K2HF2GpRn9K2ZWyosH70R9Jvcm92qUhJ1fub9aeX_CKUg0pyNt2Owxi-OOvu92EqE0qBf9GAIkx4h_dKINpP52e1F8j-gcg1QRhTgkJewwX_cE4bch7fbkzHDSIMj3v9Gv9M-cjJliTOMI91aKCwrdbbt_VReh5M0PWRezz7MPYfYV-Pz8LtJaX-A4MJ5edvvGtMp9QlhFdbOpJfCBTuLWPJVc2CnwJnOaaeSU"/>
<h3 class="text-xl font-bold text-primary mb-1">Momonga</h3>
<p class="text-sm text-on-surface-variant mb-6">Medium • Extra Fluffy</p>
<div class="flex items-center justify-between">
<span class="text-2xl font-black text-secondary">$42.00</span>
<button class="p-3 bg-primary text-on-primary rounded-full hover:bg-primary-container transition-colors active:scale-90 shadow-lg">
<span class="material-symbols-outlined">add_shopping_cart</span>
</button>
</div>
</div>
</div>
<!-- Product 4 -->
<div class="relative group mt-8 lg:mt-0">
<div class="bg-surface-container-lowest p-6 rounded-[2.5rem] dashed-outline transition-transform duration-500 group-hover:-translate-y-2 relative">
<div class="absolute -top-4 -left-4 washi-tape-beige opacity-60 rotate-[-15deg] z-20 h-8 w-20"></div>
<img alt="usagi keychain" class="w-full aspect-square object-cover rounded-2xl mb-6" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBWU1zhzJa7D06x6MkvpdCSU1to5gpXw36v7Ct-0TmiR3LyHqzx5PuHFDohgF8MepYUGBLYyto4YLwNJ9VyHGxSodlGVNDwOu1nJdEyp-0vkRizPLNDB6k_7XzAKPEWROJiRv51mHYOGsDd5C9_ggA7QBRuJa971fsWhOau3ILfYOhn9qKVFtShK9twpqBJZq9xdRwY2_sm028u21Iy50Zgh5tEu1Ga8IGmPtFs-iQppbgPC07qvjD-XHMPPLicnY0Tsn00tzqbDAM"/>
<h3 class="text-xl font-bold text-primary mb-1">Usagi Travel Keychain</h3>
<p class="text-sm text-on-surface-variant mb-6">Mini • Keyring Clip</p>
<div class="flex items-center justify-between">
<span class="text-2xl font-black text-secondary">$18.00</span>
<button class="p-3 bg-primary text-on-primary rounded-full hover:bg-primary-container transition-colors active:scale-90 shadow-lg">
<span class="material-symbols-outlined">add_shopping_cart</span>
</button>
</div>
</div>
</div>
</div>
</section>
<!-- Newsletter Section -->
<section class="max-w-5xl mx-auto px-6 mb-24 relative">
<div class="absolute -top-12 -right-8 w-24 h-24 bg-tertiary-fixed-dim/20 rounded-full blur-2xl"></div>
<div class="bg-secondary-container/20 backdrop-blur-md border border-white/50 rounded-[3rem] p-12 text-center relative overflow-hidden shadow-xl dashed-outline">
<div class="absolute top-4 left-4 washi-tape-teal rotate-[-5deg] opacity-30"></div>
<div class="absolute bottom-4 right-4 washi-tape-beige rotate-[-5deg] opacity-30"></div>
<div class="absolute top-0 right-0 p-8 text-secondary opacity-10">
<span class="material-symbols-outlined text-9xl">mail</span>
</div>
<h2 class="text-3xl font-extrabold text-primary mb-4 relative inline-block">
                    Join the Collector's Club
                    <div class="absolute -bottom-2 left-0 w-full brush-separator h-2 opacity-40"></div>
</h2>
<p class="text-on-secondary-container mb-8 max-w-lg mx-auto">Get early access to restocks and exclusive digital scrapbook wallpapers for your phone!</p>
<div class="flex flex-col sm:flex-row gap-4 justify-center relative z-10">
<input class="px-6 py-4 rounded-full border-none ring-2 ring-primary/10 focus:ring-secondary w-full sm:w-80 bg-surface-container-lowest/80 backdrop-blur" placeholder="Your email address" type="email"/>
<button class="px-8 py-4 bg-primary text-on-primary rounded-full font-bold hover:bg-secondary transition-all shadow-md hover:shadow-lg">Subscribe</button>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-[#f3ede9]/80 backdrop-blur-md dark:bg-slate-950 w-full rounded-t-[3rem] mt-12 overflow-hidden relative">
<div class="absolute top-0 left-1/2 -translate-x-1/2 washi-tape-teal w-32 h-8 -translate-y-1/2 rotate-1 opacity-50"></div>
<div class="absolute top-0 left-0 w-full h-full opacity-5 bg-[url('https://www.transparenttextures.com/patterns/natural-paper.png')] pointer-events-none"></div>
<div class="flex flex-col items-center justify-center w-full py-12 px-6 space-y-6 relative z-10">
<div class="flex space-x-8 font-['Plus_Jakarta_Sans'] text-sm tracking-wide">
<a class="text-[#41484b] dark:text-slate-500 hover:text-[#3d6374] dark:hover:text-[#bee6f9] transition-colors duration-300" href="#">Shipping</a>
<a class="text-[#41484b] dark:text-slate-500 hover:text-[#3d6374] dark:hover:text-[#bee6f9] transition-colors duration-300" href="#">Returns</a>
<a class="text-[#41484b] dark:text-slate-500 hover:text-[#3d6374] dark:hover:text-[#bee6f9] transition-colors duration-300" href="#">Privacy Policy</a>
</div>
<div class="flex space-x-6 text-primary">
<span class="material-symbols-outlined cursor-pointer hover:scale-110 transition-transform">public</span>
<span class="material-symbols-outlined cursor-pointer hover:scale-110 transition-transform">share</span>
<span class="material-symbols-outlined cursor-pointer hover:scale-110 transition-transform">favorite</span>
</div>
<p class="text-[#2F4156] dark:text-[#bee6f9] font-['Plus_Jakarta_Sans'] text-sm tracking-wide text-center">
                © 2024 ChiikaMart Adoption Center. Handcrafted with love.
            </p>
</div>
</footer>
<script src="../scripts/Service.js"></script>
</body></html>