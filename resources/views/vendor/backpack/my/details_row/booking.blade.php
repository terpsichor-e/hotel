<div class="m-t-10 m-b-10 p-l-20 p-r-20 p-t-10 p-b-10">
    <div class="row">
        <div class="col-md-4">
            <dl>
                <dt>ФИО:</dt>
                <dd>{{ $booking->client_name or 'Не указано' }}</dd>
            </dl>
        </div>
        <div class="col-md-4">
            <dl>
                <dt>Телефон:</dt>
                <dd>{{ $booking->client_phone or 'Не указано' }}</dd>
            </dl>
        </div>
        <div class="col-md-4">
            <dl>
                <dt>E-Mail:</dt>
                <dd>{{ $booking->client_email or 'Не указано' }}</dd>
            </dl>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <dl>
                <dt>Пожелания:</dt>
                <dd>{{ $booking->client_wishes or 'Не указано' }}</dd>
            </dl>
        </div>
    </div>
</div>
