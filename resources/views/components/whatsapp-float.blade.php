<!-- Floating WhatsApp Widget -->
<div id="whatsapp-widget" class="fixed bottom-6 right-6 z-50">
    <!-- Main WhatsApp Button -->
    <div id="wa-main-btn" class="relative">
        <button onclick="toggleWhatsAppMenu()" 
                class="bg-green-500 hover:bg-green-600 text-white rounded-full p-4 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 animate-pulse">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.516"/>
            </svg>
        </button>
    </div>

    <!-- WhatsApp Menu Options -->
    <div id="wa-menu" class="absolute bottom-20 right-0 bg-white rounded-2xl shadow-2xl border border-gray-200 p-4 w-72 transform scale-0 origin-bottom-right transition-all duration-300 opacity-0">
        <!-- Header -->
        <div class="flex items-center mb-4 pb-3 border-b border-gray-100">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.516"/>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-800">{{ env('WHATSAPP_BUSINESS_NAME', 'Sisbar Hairstudio') }}</h3>
                <p class="text-sm text-gray-600">Customer Service</p>
            </div>
        </div>

        <!-- Menu Options -->
        <div class="space-y-3">
            <!-- Konsultasi Option -->
            <button onclick="openWhatsAppConsultation()" 
                    class="w-full flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors group">
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-left">
                    <h4 class="font-semibold text-gray-800">Konsultasi</h4>
                    <p class="text-xs text-gray-600">Tanya tentang layanan kami</p>
                </div>
            </button>

            <!-- Keluhan Option -->
            <button onclick="openWhatsAppComplaint()" 
                    class="w-full flex items-center p-3 bg-red-50 hover:bg-red-100 rounded-xl transition-colors group">
                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="text-left">
                    <h4 class="font-semibold text-gray-800">Keluhan</h4>
                    <p class="text-xs text-gray-600">Laporkan masalah atau saran</p>
                </div>
            </button>
        </div>

        <!-- Footer -->
        <div class="mt-4 pt-3 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-500">Klik untuk chat langsung</p>
        </div>
    </div>
</div>

<!-- WhatsApp Widget JavaScript -->
<script>
let isMenuOpen = false;

function toggleWhatsAppMenu() {
    const menu = document.getElementById('wa-menu');
    const mainBtn = document.getElementById('wa-main-btn');
    
    if (isMenuOpen) {
        // Close menu
        menu.classList.remove('scale-100', 'opacity-100');
        menu.classList.add('scale-0', 'opacity-0');
        mainBtn.querySelector('button').classList.add('animate-pulse');
        isMenuOpen = false;
    } else {
        // Open menu
        menu.classList.remove('scale-0', 'opacity-0');
        menu.classList.add('scale-100', 'opacity-100');
        mainBtn.querySelector('button').classList.remove('animate-pulse');
        isMenuOpen = true;
    }
}

function openWhatsAppConsultation() {
    const phoneNumber = '{{ env("WHATSAPP_NUMBER", "6281572794699") }}';
    const businessName = '{{ env("WHATSAPP_BUSINESS_NAME", "Sisbar Hairstudio") }}';
    const message = encodeURIComponent(`Halo min, mau konsultasi dong 😊\n\nSaya ingin tanya tentang layanan di ${businessName}.`);
    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
    
    window.open(whatsappUrl, '_blank');
    toggleWhatsAppMenu(); // Close menu after click
}

function openWhatsAppComplaint() {
    const phoneNumber = '{{ env("WHATSAPP_NUMBER", "6281572794699") }}';
    const businessName = '{{ env("WHATSAPP_BUSINESS_NAME", "Sisbar Hairstudio") }}';
    const message = encodeURIComponent(`Halo min, mau lapor keluhan nih 😔\n\nSaya ingin menyampaikan keluhan terkait layanan di ${businessName}.`);
    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
    
    window.open(whatsappUrl, '_blank');
    toggleWhatsAppMenu(); // Close menu after click
}

// Close menu when clicking outside
document.addEventListener('click', function(event) {
    const widget = document.getElementById('whatsapp-widget');
    if (!widget.contains(event.target) && isMenuOpen) {
        toggleWhatsAppMenu();
    }
});

// Auto-show widget after page load
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        const mainBtn = document.getElementById('wa-main-btn');
        mainBtn.classList.add('animate-bounce');
        
        // Stop bounce after 3 seconds
        setTimeout(() => {
            mainBtn.classList.remove('animate-bounce');
        }, 3000);
    }, 2000);
});
</script>

<!-- WhatsApp Widget Styles -->
<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

#whatsapp-widget {
    animation: float 3s ease-in-out infinite;
}

#wa-menu {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Responsive adjustments */
@media (max-width: 640px) {
    #wa-menu {
        width: 280px;
        right: -10px;
    }
}
</style>