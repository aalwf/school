<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eloquent Relationships : Relasi One to Many</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css"
        referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="text-center"><a href="https://github.com/aalwf">Alwafey</a></h3>
                <h5 class="text-center my-4">Laravel Eloquent Relationship : One To Many</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Judul Post</th>
                            <th>Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>
                                    @foreach ($post->comments()->get() as $comment)
                                        <div class="card shadow-sm mb-2">
                                            <div class="card-body">
                                                <i class="fa fa-comments"></i> {{ $comment->comment }}
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
