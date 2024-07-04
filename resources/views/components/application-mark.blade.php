<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <!-- Fond circulaire avec dégradé -->
    <defs>
        <radialGradient id="grad1" cx="50%" cy="50%" r="50%" fx="50%" fy="50%">
            <stop offset="0%" style="stop-color:#F0C419;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#F0C419;stop-opacity:0.8" />
        </radialGradient>
    </defs>
    <circle cx="50" cy="50" r="50" fill="url(#grad1)"/>

    <!-- Texte "aProH" stylisé -->
    <text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" font-family="Verdana, Geneva, sans-serif" font-size="28" font-weight="bold" fill="#222222">
        aProH
    </text>

    <!-- Bulles stylisées autour du texte -->
    <circle cx="30" cy="20" r="5" fill="#ffffff" opacity="0.8"/>
    <circle cx="70" cy="30" r="4" fill="#ffffff" opacity="0.7"/>
    <circle cx="50" cy="15" r="3" fill="#ffffff" opacity="0.6"/>
    <circle cx="80" cy="50" r="6" fill="#ffffff" opacity="0.9"/>
    <circle cx="20" cy="60" r="5" fill="#ffffff" opacity="0.5"/>
    <circle cx="60" cy="80" r="4" fill="#ffffff" opacity="0.4"/>
    <circle cx="40" cy="70" r="3" fill="#ffffff" opacity="0.7"/>
</svg>
