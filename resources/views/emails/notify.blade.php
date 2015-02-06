<strong>Hi Dear {{ $entity->getFirstName() }}</strong>
<br><br>
@if(is_null($to))
    The Alexa Status of site <a href="{{ $site }}">{{ $site }}</a> has been initialized to be watched.
    <br>The country rank is currently : {{ $from }}
@else
    The Alexa Rank of site <a href="{{ $site }}">{{ $site }}</a> has been changed from "{{ $from }}" to "{{ $to }}".<br>
@endif
<br><br>
-- Sent with <b><a href="http://github.com/bigsinoos/alexa-watcher">AlexaWatcher</a></b>
<br>-- Thank for your notation enjoy the fucking world!
