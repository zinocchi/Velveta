    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Velveta - Premium Coffee Experience</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://unpkg.com/scrollreveal"></script>
        <style>
            body {
                font-family: 'Lato', sans-serif;
                @apply bg-white text-gray-900;
            }

            .logo-img {
                transition: all 0.3s ease;
            }

            .logo-img:hover {
                transform: rotate(15deg);
            }

            .menu-item {
                position: relative;
            }

            .menu-item::after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                bottom: -5px;
                left: 0;
                @apply bg-red-700;
                transition: width 0.3s ease;
            }

            .menu-item:hover::after {
                width: 100%;
            }

            .hero-btn {
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }

            .hero-btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .social-icon {
                transition: all 0.3s ease;
            }

            .social-icon:hover {
                transform: scale(1.2) translateY(-3px);
            }

            .footer-link {
                position: relative;
            }

            .footer-link::after {
                content: '';
                position: absolute;
                width: 0;
                height: 1px;
                bottom: -2px;
                left: 0;
                @apply bg-gray-600;
                transition: width 0.3s ease;
            }

            .footer-link:hover::after {
                width: 100%;
            }

            .floating {
                animation: floating 3s ease-in-out infinite;
            }

            @keyframes floating {
                0% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-10px);
                }

                100% {
                    transform: translateY(0px);
                }
            }
        </style>
    </head>
    @extends('layout.layout')

    <body class="overflow-x-hidden">


        <section class="mt-20 md:mt-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 rounded-xl overflow-hidden">
                <div
                    class="bg-red-700 text-white px-6 py-16 md:py-24 lg:py-32 flex flex-col justify-center items-center text-center animate__animated animate__fadeInLeft">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 font-montserrat">The Spring Edit</h1>
                    <p class="text-xl md:text-2xl mb-8 max-w-md mx-auto">Fresh flavors, familiar joy.</p>
                    <button
                        class="px-8 py-3 border-2 border-white rounded-full font-semibold hover:bg-white hover:text-red-700 transition-colors">
                        View the menu
                    </button>
                </div>

                <div class="h-64 md:h-auto bg-cover bg-center animate__animated animate__fadeInRight"
                    style="background-image: url('https://content-prod-live.cert.starbucks.com/binary/v2/asset/137-97315.jpg')">
                </div>
            </div>

            <div class="absolute top-1/4 left-10 w-8 h-8 rounded-full bg-amber-800 opacity-30 floating"
                style="animation-delay: 0.2s;"></div>
            <div class="absolute top-1/3 right-20 w-6 h-6 rounded-full bg-amber-600 opacity-40 floating"
                style="animation-delay: 0.4s;"></div>
            <div class="absolute bottom-1/4 left-1/4 w-5 h-5 rounded-full bg-amber-900 opacity-30 floating"
                style="animation-delay: 0.6s;"></div>
        </section>
        <section class="my-16 md:my-24 max-w-7xl mx-auto px-4">
            <div
                class="grid grid-cols-1 md:grid-cols-2 rounded-xl overflow-hidden shadow-xl transform transition-all hover:scale-[1.01] duration-500">
                <div class="h-64 md:h-auto bg-cover bg-center"
                    style="background-image: url('https://i.pinimg.com/736x/fe/dd/69/fedd693b88559124917599d42495b61e.jpg')">
                </div>
                <div
                    class="bg-amber-800 text-white px-8 py-12 md:py-16 lg:py-20 flex flex-col justify-center items-center text-center">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-6 font-montserrat">It's a great day for
                        free coffee</h2>
                    <p class="text-lg mb-8 max-w-md">
                        Start your Velveta<sup>®</sup> Rewards journey with a coffee on us. Join now and enjoy a free
                        handcrafted drink with a qualifying purchase during your first week.*
                    </p>
                    <button
                        class="px-8 py-3 border-2 border-white rounded-full font-semibold hover:bg-white hover:text-amber-800 transition-colors duration-300">
                        Join now
                    </button>
                </div>
            </div>
        </section>

        <section class="my-16 md:my-24 max-w-7xl mx-auto px-4">
            <div
                class="grid grid-cols-1 md:grid-cols-2 rounded-xl overflow-hidden shadow-xl transform transition-all hover:scale-[1.01] duration-500">
                <div
                    class="order-2 md:order-1 bg-gray-700 text-white px-8 py-12 md:py-16 lg:py-20 flex flex-col justify-center items-center text-center">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-6 font-montserrat">Nondairy milk, no extra
                        charge</h2>
                    <p class="text-lg mb-8 max-w-md">
                        Customize your drink with your favorite nondairy milk—like soy, coconut, almond or oat—for no
                        additional charge.
                    </p>
                    <button
                        class="px-8 py-3 border-2 border-white rounded-full font-semibold hover:bg-white hover:text-gray-700 transition-colors duration-300">
                        Order now
                    </button>
                </div>
                <div class="order-1 md:order-2 h-64 md:h-auto bg-cover bg-center"
                    style="background-image: url('https://content-prod-live.cert.starbucks.com/binary/v2/asset/137-97469.jpg')">
                </div>
            </div>
        </section>

        <section class="my-16 md:my-24 max-w-7xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-montserrat">Our Signature Blends</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-2">
                    <div class="h-64 bg-cover bg-center"
                        style="background-image: url('https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Velveta Black</h3>
                        <p class="text-gray-600 mb-4">Our signature dark roast with notes of chocolate and caramel.</p>
                        <button class="text-red-700 font-semibold hover:underline">Learn more</button>
                    </div>
                </div>
                <div
                    class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-2">
                    <div class="h-64 bg-cover bg-center"
                        style="background-image: url('https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Caramel Cloud</h3>
                        <p class="text-gray-600 mb-4">Creamy caramel meets our premium espresso in this fan favorite.
                        </p>
                        <button class="text-red-700 font-semibold hover:underline">Learn more</button>
                    </div>
                </div>
                <div
                    class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-2">
                    <div class="h-64 bg-cover bg-center"
                        style="background-image: url('https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Spring Bloom</h3>
                        <p class="text-gray-600 mb-4">Limited edition floral notes with a hint of citrus.</p>
                        <button class="text-red-700 font-semibold hover:underline">Learn more</button>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">Velveta Coffee</h3>
                        <p class="text-gray-400">Creating special moments with every cup of coffee since 2015.</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li>📍 Jalan Gajah mada No 12, Jakarta</li>
                            <li>📞 +62 851-6359-9066</li>
                            <li>✉️ Velveta.Coffe@gmail.com</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>© 2020 Velveta Coffee. All rights reserved.</p>
                </div>
            </div>
        </footer>


        <script>
            const scrollReveal = ScrollReveal({
                origin: 'bottom',
                distance: '30px',
                duration: 1000,
                delay: 200,
                rotate: {
                    x: 0,
                    y: 0,
                    z: 2
                },
                opacity: 0,
                scale: 0.95,
                easing: 'cubic-bezier(0.5, 0, 0, 0.1)',
                mobile: true,
                reset: false,
                viewFactor: 0.2,
                viewOffset: {
                    top: 0,
                    right: 0,
                    bottom: 50,
                    left: 0
                }
            });

            scrollReveal.reveal('.animate__animated', {
                interval: 100,
                beforeReveal: (el) => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0) rotateZ(0)';
                    el.style.filter = 'blur(0)';
                },
                beforeReset: (el) => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(30px) rotateZ(2deg)';
                    el.style.filter = 'blur(2px)';
                }
            });

            scrollReveal.reveal('section:nth-child(odd)', {
                origin: 'left',
                rotate: {
                    z: -2
                }
            });

            scrollReveal.reveal('section:nth-child(even)', {
                origin: 'right',
                rotate: {
                    z: 2
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                const sections = document.querySelectorAll('section');
                const options = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -100px 0px'
                };

                const sectionObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.transition = 'all 0.8s cubic-bezier(0.22, 1, 0.36, 1)';
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0) scale(1)';
                            entry.target.style.filter = 'blur(0)';

                            entry.target.style.boxShadow = '0 0 30px rgba(155, 17, 30, 0.2)';
                            setTimeout(() => {
                                entry.target.style.boxShadow = 'none';
                            }, 1000);

                            observer.unobserve(entry.target);
                        }
                    });
                }, options);

                sections.forEach(section => {
                    section.style.opacity = '0';
                    section.style.transform = 'translateY(40px) scale(0.98)';
                    section.style.filter = 'blur(2px)';
                    section.style.willChange = 'opacity, transform, filter';
                    section.style.backfaceVisibility = 'hidden';
                    sectionObserver.observe(section);
                });

                const logo = document.querySelector('.logo-img');
                if (logo) {
                    logo.addEventListener('mouseenter', () => {
                        logo.style.transition = 'all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55)';
                        logo.style.transform = 'rotate(15deg) scale(1.1)';

                        const pulse = () => {
                            logo.style.transform = 'rotate(15deg) scale(1.15)';
                            setTimeout(() => {
                                logo.style.transform = 'rotate(15deg) scale(1.1)';
                            }, 300);
                        };

                        setTimeout(pulse, 150);
                    });

                    logo.addEventListener('mouseleave', () => {
                        logo.style.transform = 'rotate(0) scale(1)';
                    });
                }

                const buttons = document.querySelectorAll('button, .btn, a[role="button"]');
                buttons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const rect = button.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;

                        const ripple = document.createElement('span');
                        ripple.className = 'ripple-effect';
                        ripple.style.left = `${x}px`;
                        ripple.style.top = `${y}px`;

                        button.appendChild(ripple);

                        setTimeout(() => {
                            ripple.remove();
                        }, 600);
                    });

                    button.addEventListener('mouseenter', () => {
                        button.style.transition = 'all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                        button.style.transform = 'translateY(-3px)';
                        button.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.15)';

                        if (button.classList.contains('cta-button') || button.classList.contains(
                            'join')) {
                            button.style.boxShadow = '0 10px 25px rgba(155, 17, 30, 0.3)';
                        }
                    });

                    button.addEventListener('mouseleave', () => {
                        button.style.transform = 'translateY(0)';
                        button.style.boxShadow = 'none';
                    });
                });

                const floaters = document.querySelectorAll('.floating-element');
                floaters.forEach((floater, index) => {
                    const duration = 3000 + (index * 500);
                    floater.style.animation = `float ${duration}ms ease-in-out infinite ${index * 200}ms`;
                });

                window.addEventListener('scroll', () => {
                    const parallaxElements = document.querySelectorAll('.parallax');
                    parallaxElements.forEach(el => {
                        const speed = parseFloat(el.getAttribute('data-speed')) || 0.3;
                        const yPos = -(window.pageYOffset * speed);
                        el.style.transform = `translate3d(0, ${yPos}px, 0)`;
                    });
                });
            });

            const style = document.createElement('style');
            style.textContent = `
        @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
        }
        .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.7);
        transform: scale(0);
        animation: ripple 600ms linear;
        pointer-events: none;
        }
        @keyframes ripple {
        to { transform: scale(4); opacity: 0; }
        }
    `;
            document.head.appendChild(style);
        </script>
    </body>

    </html>
