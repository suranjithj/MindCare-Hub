

<div class="flex items-center gap-2">
    <svg class="w-[40px] h-[40px]" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="brainMusicGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#4FD1C5;" />
                <stop offset="33%" style="stop-color:#63B3ED;" />
                <stop offset="66%" style="stop-color:#8A2BE2;" />
                <stop offset="100%" style="stop-color:#A78BFA;" />
            </linearGradient>
            <filter id="subtleGlow" x="-50%" y="-50%" width="200%" height="200%">
                <feGaussianBlur stdDeviation="2.5" result="blur"/>
                <feMerge>
                    <feMergeNode in="blur"/>
                    <feMergeNode in="SourceGraphic"/>
                </feMerge>
            </filter>
        </defs>

        <path d="M25 60
                    C10 45, 15 25, 40 22
                    S70 15, 75 35
                    C80 55, 65 65, 60 75"
                fill="none"
                stroke="url(#brainMusicGradient)"
                stroke-width="10" stroke-linecap="round"
                filter="url(#subtleGlow)" />

        <circle cx="60" cy="78" r="12" fill="#8A2BE2" filter="url(#subtleGlow)" />
        <path d="M60 74 Q60 76 60 78" stroke="#8A2BE2" stroke-width="10" stroke-linecap="round" filter="url(#subtleGlow)" />


        <path d="M73 33
                    L73 8" stroke="#63B3ED" stroke-width="7" stroke-linecap="round" />

        <path d="M73 10
                    C88 13, 85 28, 73 25
                    Z"
                fill="#4FD1C5" />
        <circle cx="22" cy="32" r="2.5" fill="rgba(255,255,255,0.25)" />
        <circle cx="42" cy="16" r="2" fill="rgba(255,255,255,0.2)" />
    </svg>

    <div class="text-center sm:text-left">
        <span class="text-xl text-white font-semibold"><span class="text-sky-400">MindCare</span>Hub</span>
    </div>
</div>


