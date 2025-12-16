{{-- File: resources/views/notifications/_bell.blade.php --}}
{{-- Include this in your app.blade.php navbar --}}

<div x-data="bellNotification()" x-init="init()" class="relative">
    <!-- Bell Button -->
    <button 
        @click="toggleDropdown()"
        class="relative p-2 rounded-full hover:bg-gray-100 transition-colors"
    >
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        
        <!-- Badge -->
        <span 
            x-show="unreadCount > 0" 
            x-text="unreadCount"
            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center animate-pulse"
        ></span>
    </button>

    <!-- Dropdown -->
    <div 
        x-show="showDropdown" 
        @click.away="showDropdown = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-96 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 max-h-96 overflow-hidden"
        style="display: none;"
    >
        <!-- Header -->
        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="font-bold text-gray-800">Notifikasi Terbaru</h3>
            <button 
                x-show="unreadCount > 0"
                @click="markAllAsRead()"
                class="text-xs text-green-600 hover:text-green-700 font-semibold"
            >
                Tandai Semua
            </button>
        </div>

        <!-- Notifications List -->
        <div class="overflow-y-auto max-h-80">
            <template x-if="notifications.length === 0">
                <div class="p-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <p class="text-sm">Tidak ada notifikasi</p>
                </div>
            </template>

            <template x-for="notif in notifications" :key="notif.id">
                <div 
                    @click="markAsRead(notif.id)"
                    class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors"
                    :class="{ 'bg-green-50': !notif.read_at }"
                >
                    <div class="flex gap-3">
                        <!-- Icon -->
                        <div 
                            class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                            :class="{
                                'bg-green-100 text-green-600': notif.type === 'order',
                                'bg-yellow-100 text-yellow-600': notif.type === 'review',
                                'bg-blue-100 text-blue-600': notif.type === 'message',
                                'bg-purple-100 text-purple-600': notif.type === 'promo',
                                'bg-red-100 text-red-600': notif.type === 'stock'
                            }"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm text-gray-800 truncate" x-text="notif.title"></p>
                            <p class="text-xs text-gray-600 line-clamp-2" x-text="notif.message"></p>
                            <p class="text-xs text-gray-400 mt-1" x-text="notif.time_ago"></p>
                        </div>

                        <!-- Unread Indicator -->
                        <div x-show="!notif.read_at" class="w-2 h-2 bg-green-500 rounded-full flex-shrink-0 mt-2"></div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Footer -->
        <div class="p-3 border-t border-gray-200 text-center">
            <a 
                href="{{ route('notifications.index') }}"
                class="text-sm text-green-600 hover:text-green-700 font-semibold"
            >
                Lihat Semua Notifikasi
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function bellNotification() {
    return {
        showDropdown: false,
        notifications: [],
        unreadCount: 0,

        init() {
            this.fetchNotifications();
            // Poll every 30 seconds
            setInterval(() => {
                this.fetchNotifications();
            }, 30000);
        },

        toggleDropdown() {
            this.showDropdown = !this.showDropdown;
            if (this.showDropdown) {
                this.fetchNotifications();
            }
        },

        fetchNotifications() {
            fetch('{{ route("notifications.recent") }}')
                .then(response => response.json())
                .then(data => {
                    this.notifications = data.notifications.map(n => ({
                        ...n,
                        time_ago: this.timeAgo(n.created_at)
                    }));
                    this.unreadCount = data.unread_count;
                })
                .catch(error => console.error('Error fetching notifications:', error));
        },

        markAsRead(notifId) {
            fetch(`/notifications/${notifId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(() => {
                this.fetchNotifications();
            });
        },

        markAllAsRead() {
            fetch('{{ route("notifications.read-all") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(() => {
                this.fetchNotifications();
            });
        },

        timeAgo(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const seconds = Math.floor((now - date) / 1000);

            if (seconds < 60) return 'Baru saja';
            if (seconds < 3600) return Math.floor(seconds / 60) + ' menit yang lalu';
            if (seconds < 86400) return Math.floor(seconds / 3600) + ' jam yang lalu';
            if (seconds < 2592000) return Math.floor(seconds / 86400) + ' hari yang lalu';
            return date.toLocaleDateString('id-ID');
        }
    }
}
</script>
@endpush