@php
echo memory_get_usage() . " octets <br><br>";
$grandTableau = range(1, 100000);
echo memory_get_usage() . " octets après allocation";

@endphp