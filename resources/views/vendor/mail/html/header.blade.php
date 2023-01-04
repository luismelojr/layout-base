<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Melo Dev')
<img src="{{asset('assets/images/LogoMail.png')}}" style="width: 55px; height: 55px; max-height: 55px" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
