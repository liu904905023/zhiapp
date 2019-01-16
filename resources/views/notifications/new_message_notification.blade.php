<li class="notifications {{$notification->unread()? 'unread':""}}">
    <a href="notifications/{{$notification->id}}?redirect_url=/inbox/{{$notification->data['dialog_id']}}">{{$notification->data['name']}}给您发了一条信息！
    </a>
</li>