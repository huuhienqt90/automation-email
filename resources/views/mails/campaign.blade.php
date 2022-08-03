<div style="padding: 2rem;">
    <div class="mail-content">
    {!! nl2br(str_replace(['%first_name%', '%last_name%'], [$contact->first_name, $contact->last_name], $campaign->description)) !!}
    </div>
    Thanks, <br>
    {{ config('app.name') }}
</div>

