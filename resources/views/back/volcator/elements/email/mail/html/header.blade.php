<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://prestais.com/resources/views/front/growbusiness/assets/img/prestais.png" class="logo" alt="PrestAIs" style="width: 133px; height: 75px">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
