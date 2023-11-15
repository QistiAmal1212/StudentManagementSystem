@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
            {{-- <img src="{{ asset('Images/LogoSystem.png') }}" alt="Student-Management-System" /> --}}
            @else
            {{ $slot }}
            @endif
        </a>
    </td>
</tr>
