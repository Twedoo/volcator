<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                {{--<img src="{{ }}" class="logo" alt="Twedoo Volcator Logo">--}}
                <img src="data:image/png;base64,{{base64_encode(file_get_contents('http://'.request()->getHost().'/resources/views/back/volcator/assets/images/volcator-logo.png' ))}}" class="logo" alt="Twedoo Volcator Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
