<!DOCTYPE html>

<html>

<head>

    <title>Laravel Image Upload (Single + Multiple)</title>
    <style>

    </style>
</head>

<body>
    <h1>Single Image Upload</h1>

    <form action="{{ route('photos.store.single') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required>
        <button type="submit">Upload</button>
    </form>

    <h1>Multiple Images Upload</h1>

    <form action="{{ route('photos.store.multiple') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="images[]" multiple required>

        <button type="submit">Upload</button>
    </form>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h2>Uploaded Images</h2>

    @if ($photos->isEmpty())
        <p>No images uploaded yet.</p>
    @else
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            @foreach ($photos as $photo)
                <div style="
                 display: flex;
                flex-direction: column;
                ">
                    <div>
                        <img src="{{ asset('images/' . $photo->image) }}" alt="Uploaded photo"
                            style="
                        width: 180px; 
                        height: 180px; 
                        object-fit: cover; 
                        border: 1px solid #ccc;">
                    </div>
                    <form action="{{ route('photos.delete', $photo->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
        <div 
        style="
        width: 100px;
        height: 100px;
        display: flex;
        flex-direction: row
        "
        >{{ $photos->links() }}
    </div>
    @endif
</body>

</html>
