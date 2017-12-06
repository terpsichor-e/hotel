<div class="col-md-4 col-sm-12">
    <a href="{{ route('room.view', $room) }}" class="room-card"
       style="background-image: url({{ ('/storage/uploads/'.$room->photos[0]) }})">
        <div class="info">
            <div class="title">{{ $room->title }}
                <div class="price">${{ $room->price }}</div>
            </div>
        </div>
    </a>
</div>