<body bgcolor="grey">

    <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <input type="submit" name="ok">
    </form>
</body>
