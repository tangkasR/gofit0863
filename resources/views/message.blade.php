@if ($errors->any())
    <div class="alert alert-danger alert-dismissible animate_animated animate_fadeInDown no-print"
        style="width: fit-content; position:sticky" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        {{-- <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
@endif
@if (Session::get('success'))
    <div class="alert alert-success alert-dismissible animate_animated animate_fadeInDown no-print"style="width: fit-content; position:sticky"
        role="alert">
        {{ Session::get('success') }}
        {{-- <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
@endif
@if (Session::get('error'))
    <div class="alert alert-danger alert-dismissible animate_animated animate_fadeInDown no-print"
        style="width: fit-content; position:sticky" role="alert">
        {{ Session::get('error') }}
        {{-- <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
@endif
