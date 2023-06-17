@extends('desa/layout/app')

@section('title','Data User Pengaju')

@section('content')

<div class="page-heading">

    <section class="section">
        <div class="card">
            <div class="card-header">
                Table Pengaju
            </div>
            <div class="card-body" style="overflow-x:scroll;">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama User</th>
                            <th>Email User</th>
                            <th>Nim</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($data as $pgn)
                        <tr>
                            <th><?=$no; ?>. </th>
                            <td>
                                @if($pgn->name==NULL)
                                <span class="text text-danger">Tambahkan Nama?</span>
                                @endif
                                @if($pgn->name!==NULL)
                                {{$pgn->name}}
                                @endif
                            </td>
                            <td>{{$pgn->email}}</td>
                            <td>{{$pgn->nim}}</td>
                            <td>
                                @if($pgn->level=="Pengaju")
                                <span class="badge bg-primary">{{$pgn->level}}</span>
                                @else
                                <span class="badge bg-success">{{$pgn->level}}</span>
                                @endif
                            </td>
                            <td align="center">
                                <!-- <a href="" class="btn btn-sm btn-danger rounded-pill"><i class="icon dripicons-trash"></i></a> -->
                                <a href="{{route('cek_user',['title'=>Auth::user()->title_user,'id'=>$pgn->id])}}" class="btn btn-sm btn-primary rounded-pill"><i class="icon dripicons-preview"></i></a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
