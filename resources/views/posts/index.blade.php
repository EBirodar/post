<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            @foreach($datas as $data)

                <div class="card-body">
                    @foreach ($data->posts as $item)
                        @if($loop->index==0)
                            @if(!$item->id==null)
                                <h4 class="card-title">{{$data->name}}</h4>
                            @endif
                        @endif
                    @endforeach

                    <div class="table-responsive">
                        <table class="table mb-3">
                            @if($loop->index==0)
                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Posts Name</th>
                                    <th>Created Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            @endif
                            <tbody>

                            @foreach ($data->posts as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>

                                    <td>{{ $item->name }}</td>
                                    <td>{{$item->created_at->diffInMinutes(\Carbon\Carbon::now())}} minutes ago
                                    </td>
                                    <td>
                                        {{--                                            @php dd($item->id) @endphp--}}
                                        <a href="{{route('post.edit',['post'=>$item->id])}}">
                                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                        </a>
                                        <form method="post" action="{{route('post.destroy',['post'=>$item->id])}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">

                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            </button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{--            {{ $datas->links() }}--}}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <div class="col-lg-6">
        <h1>{{auth()->user()->name}}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(!isset($post))

            <form  action="{{route('post.store')}}" method="post">
                {{--                    @php dd('salom');@endphp--}}
                @csrf
                <input type="text" class="hidden" name="user_id" value="{{auth()->user()->id}}">
                <input type="text" class="col-8 mt-2" name="name" >
                <button type="submit" class="btn btn-primary">Add post</button>
            </form>
        @endif


        @if(isset($post))

            <form  action="{{route('post.update',$post->id)}}" method="post">

                @method('PUT')
                @csrf
                <input type="text" class="hidden" name="user_id" value="{{auth()->user()->id}}">
                <input type="text" class="col-8 mt-2" name="name" value="{{$post->name}}">
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        @endif



    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
