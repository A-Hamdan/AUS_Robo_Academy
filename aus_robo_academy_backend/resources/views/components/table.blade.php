<table id="example2" class="table table-striped table-sm table-hover">
    <thead>
        <tr>
            @foreach ($headers as $header)
                <th>{{ $header }}</th>
            @endforeach

        </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>
