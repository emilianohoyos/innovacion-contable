<form action="{{ route('upload.onedrive') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button type="submit">Upload to OneDrive</button>
</form>

<ul>
    @foreach($files as $item)
    <li><a target="_blank" href="/download?file={{$item}}">{{$item}}</a></li>
    @endforeach
</ul>
