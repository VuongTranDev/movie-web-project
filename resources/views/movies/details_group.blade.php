<div class="mt-4">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link nav-link-tab active" id="pills-home-tab" data-bs-toggle="pill"
                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                aria-selected="true">DANH SÁCH TẬP</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link nav-link-tab" id="pills-profile-tab" data-bs-toggle="pill"
                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                aria-selected="false">THÔNG TIN PHIM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link nav-link-tab" id="pills-contact-tab" data-bs-toggle="pill"
                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                aria-selected="false">DIỄN VIÊN</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
            tabindex="0">
            <ul class="episode-servers mt-3">
                @foreach ($movie['episodes'] as $server)
                    <li class="server-item">
                        <strong class="server-name">{{ $server['server_name'] }}</strong>
                        <ul class="d-flex flex-wrap mt-3">
                            @foreach ($server['items'] as $episode)
                                <li
                                    class="episode-list me-2 mb-2 
                            {{ isset($currentEpisode) && $currentEpisode == $episode['slug'] && $server['server_name'] == $currentServer ? 'active' : '' }}">
                                    <a href="{{ route('movie.watch', ['slug' => $movie['slug'], 'episode' => $episode['slug'], 'server_name' => $server['server_name']]) }}"
                                        data-server="{{ $server['server_name'] }}" class="episode-link">
                                        Tập {{ $episode['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>

        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
            tabindex="0">
            <strong class="server-name">MÔ TẢ</strong>
            <div class="ps-3 pt-2">
                <p>{{ $movie['description'] }}</p>
                <p>Đạo diễn: {{ $movie['director'] }}</p>
                <p>Số tập: {{ $movie['total_episodes'] }}</p>
                <p>Thời lượng: {{ $movie['time'] }}</p>
                <p>Chất lượng: {{ $movie['quality'] }}</p>
                <p>Ngôn ngữ: {{ $movie['language'] }}</p>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
            tabindex="0">
            <div class="ps-3 pt-2">
                <p>Các diễn viên: {{ $movie['casts'] }}</p>
            </div>
        </div>
    </div>
    <input type="hidden" id="server-name-input" name="server_name">
</div>
<style>
    .episode-list.active {
        background-color: #ec8f00;
    }
</style>
<script>
    $(document).ready(function() {
        $('.episode-link').on('click', function(e) {
            // e.preventDefault();

            var serverName = $(this).data('server');

            console.log(serverName);

            $('#server-name-input').val(serverName);

            $.ajax({
                url: '/watch/' + slug + '/' + episode,
                type: 'GET',
                data: {
                    server_name: serverName
                },
                success: function(response) {
                    console.log('Success:', response);
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
</script>
