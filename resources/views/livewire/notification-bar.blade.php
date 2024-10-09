<div id="notificationArea" class="bg-black/10 min-h-screen absolute inset-0 flex justify-end z-10">
    <button id="hideNotificationEl" class="absolute top-3 right-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
        </svg>
    </button>
    <div class="flex flex-col w-60 bg-white shadow-l-lg h-full p-3 gap-3">
        <h1 class="font-bold">Notifications</h1>
        <x-notification-container />
    </div>
</div>
